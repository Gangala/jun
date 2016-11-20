<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/15
 * Time: 23:14
 */

namespace Admin\Model;


use Admin\Logic\MySQLORM;
use Admin\Logic\NestedSets;
use Think\Model;

class MenuModel extends Model
{

    protected $_validate =[
        ['name','require','菜单名不能为空'],
//        ['path','require','路径不能为空'],
        ['parent_id','require','父类菜单不能为空'],
    ];


    /**
     * 获取菜单列表
     * @return mixed
     */
    public function getList(){
        return $this ->order('lft')->select();
    }

    /**
     * 获取可见的菜单
     */
    public function getVisbleMenu()
    {
        //  select
        //      distinct m.id,m.name,m.parent_id  m.path
        // from
        //      shop_menu_permission mp join shop_menu m
        // on mp.menu_id = m.id
        //      join shop_permission p
        // on mp.permission_id = p.id
        // where
        //      permission_id in (1,2,3,4,5);
        //查看列表 如果是超级管理员则可以看到所有的列表
        $user_info = session('ADMIN_INFO');
        if($user_info['username'] != 'admin'){
            $pids = session('ADMIN_PID');
            return $this->distinct(true)->field('m.id,m.name,m.path,m.parent_id')->alias('m')->join('__MENU_PERMISSION__ as mp ON mp.menu_id = m.id')->where(['permission_id' => ['in', $pids]])->select();
        }else{
            return $this->distinct(true)->field('m.id,m.name,m.path,m.parent_id')->alias('m')->select();
        }
    }

    public function addMenu(){
        //开启事务
        $this->startTrans();
        //插入菜单表
        //计算层级和节点
        $orm = new MySQLORM();
        $netedsets = new NestedSets($orm,$this->getTableName(),'lft','rght','parent_id','id','level');
        if (($menu_id = $netedsets ->insert($this->data['parent_id'],$this->data,'bottom')) === false) {
            $this ->error ='添加失败';
            $this->rollback();
            return false;
        }

        //插入菜单权限表关联表
        //收集数据
        $data=I('post.');
        $dataList=[];
        //循环构建数组
        foreach($data['permission_id'] as $v){
            $dataList[] = [
                'menu_id' => $menu_id,
                'permission_id' =>$v
            ];
        }

        if (M('MenuPermission')->addAll($dataList) === false) {
            $this ->error ='添加失败';
            $this->rollback();
            return false;
        }

        //插入成功
        $this ->commit();
        return true;
    }


    /**
     * 查询要编辑的菜单的详情，并查询所有的菜单数据
     * @param $id
     * @return mixed
     */
    public function getEditMenu($id){
        //查询菜单数据
        $rows = $this ->find($id);
        //查询菜单数据
        $rows['menu'] =json_encode($this->getList());
        //返回结果
        return $rows;
    }

    /**
     * 编辑菜单
     * @param $id int
     * @return bool
     */
    public function saveEditMenu($id){

        //开启事务
        $this ->startTrans();

        //获取父级菜单id
        $parent_id = $this ->where(['id'=>$id])->getField('parent_id');

        //判断是否需要重新计算节点和层级关系
        if ($parent_id != $this ->data['parent_id']) {
            $orm =new MySQLORM();
            $nestedsets = new NestedSets($orm,$this->getTableName(),'lft','rght','parent_id','id','level');
            if ($nestedsets ->moveUnder($id,$this->data['parent_id'],'bottom')  ===false) {
                $this->error = '不能移动到后代菜单中';
                $this ->rollback();
                return false;
            }
        }
        if ($this ->save() === false) {
            $this ->error='修改失败';
            $this->rollback();
            return false;
        }

        //删除原有权限菜单关联表
        if (M('MenuPermission')->where(['menu_id'=>$id])->delete() === false) {
            $this ->error='修改失败';
            $this->rollback();
            return false;
        }

        //保存权限和菜单关联表
        $permission_ids = I('post.permission_id');
        //构建插入数组
        $dataList=[];
        foreach($permission_ids as $permission_id){
            $dataList[] = [
                'menu_id' => $id,
                'permission_id' => $permission_id,
            ];
        }
        if (M('MenuPermission')->addAll($dataList)  === false) {
            $this ->error='修改失败';
            $this->rollback();
            return false;
        }

        //保存成功,提交事务
        $this -> commit();
        return true;
    }

    /**
     * 删除菜单操作
     * @param $id
     */
    public function deleteMenuPermission($id){
        //开启事务
        $this ->startTrans();
        //删除菜单表数据,需要重新计算节点和层级
        $orm = new MySQLORM();
        $nestedsets = new NestedSets($orm,$this->getTableName(),'lft','rght','parent_id','id','level');
        if ($nestedsets ->delete($id) === false) {
            $this->error ='删除失败';
            $this->rollback();
            return false;
        }

        //删除菜单权限表数据
        if (M('MenuPermission')->where(['menu_id'=>$id])->delete() === false) {
            $this->error ='删除失败';
            $this->rollback();
            return false;
        }

        //删除成功，提交事务
        $this ->commit();
        return true;

    }
}