<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/14
 * Time: 14:44
 */

namespace Admin\Model;


use Admin\Logic\MySQLORM;
use Admin\Logic\NestedSets;
use Think\Model;

class PermissionModel extends Model
{

    //开启批量验证
    protected $patchValidate = true;
    //自动验证
    protected $_validate = [
        ['name', 'require', '权限名称不能为空'],
        ['parent_id', 'require', '父级不能为空'],
    ];

    public function getList()
    {
        return $this->order('lft')->select();
    }

    public function addPermission()
    {

        //重新计算节点和层级
        $orm = new MySQLORM();
        $nestedsets = new NestedSets($orm, $this->getTableName(), 'lft', 'rght', 'parent_id', 'id', 'level');
        if ($nestedsets->insert($this->data['parent_id'], $this->data, 'bottom') === false) {
            $this->error('添加失败');
            return false;
        } else {
            return true;
        }
    }


    /**
     * 保存编辑
     * @param $id
     * @return bool
     */
    public function saveEdit()
    {
        //判断是否需要重新计算节点和层级
        $parent_id = $this->where(['id' => $this->data['id']])->getField('parent_id');
        if ($parent_id !== $this->data['parent_id']) {
            //重新计算层级和节点
            $orm = new MySQLORM();
            $nestedsets = new NestedSets($orm, $this->getTableName(), 'lft', 'rght', 'parent_id', 'id', 'level');
            if ($nestedsets->moveUnder($this->data['id'], $this->data['parent_id'], 'bottom') === false) {
                $this->error = '不能移动到自身及子类中';
            }
        }
        return $this->save();
    }


    /**
     * 删除权限
     * @param $id
     */
    public function removePermission($id)
    {
        //查询该节点的左右节点值
        $row = $this -> find($id);
        $row_lft = $row['lft'];
        $row_rght = $row['rght'];
        $row_width =$row_rght-$row_lft+1;
        //开启事务
        $this ->startTrans();
        //删除该节点及其内部节点
        $sql = "DELETE FROM shop_permission WHERE lft BETWEEN $row_lft AND $row_rght";
        if ($this ->execute($sql) === false) {
            $this->rollback();
            $this ->error = '删除失败';
            return false;
        }

        $sql = "UPDATE shop_permission SET rght = rght - $row_width WHERE rght > $row_rght";
        if ($this->execute($sql) ===false) {
            $this->rollback();
            $this ->error = '删除失败';
            return false;
        }

        $sql = "UPDATE shop_permission SET lft = lft - $row_width WHERE lft > $row_rght";
        if ($this->execute($sql) ===false) {
            $this->rollback();
            $this ->error = '删除失败';
            return false;
        }

        $this ->commit();
        return true;
    }

}