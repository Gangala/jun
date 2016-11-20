<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/8
 * Time: 17:58
 */

namespace Admin\Model;


use Admin\Logic\MySQLORM;
use Admin\Logic\NestedSets;
use Think\Model;

class GoodsCategoryModel extends Model
{
    /**
     * 自动验证
     */
    protected $_validate =[
        ['name','require','用户名不能为空'],
    ];

    /**
     * 查询分类列表
     */
    public function getList(){
        return $this ->select();
    }

    /**
     * 添加分类
     */
    public function addCategory(){
        //创建集合对象
        $orm = new MySQLORM();
        $NestedSets = new NestedSets($orm,$this->getTableName(),'lft','rght','parent_id','id','level');
        $NestedSets ->insert($this->data['parent_id'],$this -> data ,'bottom');
    }

    /**
     * 修改分类
     *      1、判断是否移动了分类
     *      2、判断是否移动到了自己和后代中
     *      3、保存数据
     *
     */
    public function saveCategory(){

        //获取原来的父亲类
        $parent_id = $this ->where(['id'=>$this->data['id']])->getField('parent_id');
        //判断是否修改了父亲类
        if($parent_id !== $this->data['parent_id']){
            //修改需要重新计算层级所以要使用nestedsets
            $orm = new MySQLORM();
            $NestedSets = new NestedSets($orm,$this->getTableName(),'lft','rght','parent_id','id','level');
            if($NestedSets ->moveUnder($this->data['id'],$this->data['parent_id'],'bottom') ==false){
                $this ->error='不允许移动到后代类中';
                return false;
            };
        }
            //保存
            return $this ->save();
    }

    /**
     *      移除数据
     *
     */

    public function deleteCategory($id){
        //删除分类，需要重新计算层级
        $orm = new MySQLORM();
        $NestedSets = new NestedSets($orm,$this->getTableName(),'lft','rght','parent_id','id','level');
        //执行删除操作
        if ($NestedSets ->delete($id) === false) {
            $this ->error ="删除失败";
            return false;
        }
        return true;
    }
}