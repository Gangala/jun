<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/14
 * Time: 13:52
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class RoleModel extends Model
{
    /**
     * 自动验证
     */
    protected $_validate =[
      ['name','require','角色名称不能为空'],
    ];
    /**
     * 角色索引页
     * @param array $conf 搜索条件
     * @return false or array
     */
    public function selectPageResult(array $conf){
        //查询数据总条数
         $countPage = $this->where($conf)->count();
        //创建分页工具条
        $page = new Page($countPage,C('PAGE.SIZE'));
        $page ->setConfig('theme',C('PAGE.THEME'));
        $page_html = $page->show();

        //查询分页数据
        $rows = $this ->where($conf)->order('sort')->page(I('get.p'),C('PAGE.SIZE'))->select();

        //返回分页结果和工具条
        return compact('page_html','rows');
    }


    /**
     * 添加角色
     * @return bool
     */
    public function addRole(){

        //开启事务
        $this ->startTrans();

        //存储角色表
        if (($id = $this->add()) === false) {
            $this ->rollback();
            return false;
        }

        //获取权限id
        $data=I('post.permission_id');

        //判断是否添加无权限的角色
        if (empty($data)) {
            $this->commit();
            return true;
        }

        //创建批量添加数组
        $dataList=[];
        for($i=0;$i<count($data);$i++){
            $dataList[]=[
                'role_id'=>$id,
                'permission_id'=>$data[$i]];
        }

        //存储角色与权限关联表
        if (M('RolePermission')->addAll($dataList) === false) {
            $this->error='角色关联表添加失败';
            $this ->rollback();
            return false;
        }

        $this ->commit();
        //保存成功
        return true ;
    }

    /**
     * 获取角色信息
     * @param $id
     */
    public function getRoleInfo($id){
        //获取角色的基本信息
        $row = $this->find($id);
        //获取角色的权限id
        $row['permission_id'] = json_encode(M('RolePermission') ->where(['role_id'=>$id])->getField('permission_id',true));
        //返回结果
        return $row;
    }


    /**
     * 编辑角色信息
     *     先删除角色信息
     *      再重新添加一个角色信息
     * @param $id int
     * @return bool
     */
    public function saveEdit($id){
        //开启事务
        $this ->startTrans();

        //删除角色的信息
        if ($this ->delete($id) ===false) {
            $this ->rollback();
            return false;
        }

        //删除角色权限关联信息
        if ((M('RolePermission')->where(['role_id'=>$id])->delete()) === false) {
            $this ->rollback();
            return false;
        }
        //获取权限id
        $data=I('post.permission_id');

        //判断是否添加无权限的角色
        if (empty($data)) {
            $this->commit();
            return true;
        }

        //存储角色表
        if (($id = $this->add()) === false) {
            $this ->rollback();
            return false;
        }

        //创建批量上传数组
        $dataList=[];
        for($i=0;$i<count($data);$i++){
            $dataList[]=[
                'role_id'=>$id,
                'permission_id'=>$data[$i]];
        }

        //存储角色与权限关联表
        if (M('RolePermission')->addAll($dataList) === false) {
            $this->error='角色关联表添加失败';
            $this ->rollback();
            return false;
        }

        $this ->commit();
        //保存成功
        return true ;
    }

    public function role_remove($id){
        //开启事务
        $this ->startTrans();

        //删除角色的信息
        if ($this ->delete($id) ===false) {
            $this ->rollback();
            return false;
        }

        //删除角色权限关联信息
        if ((M('RolePermission')->where(['role_id'=>$id])->delete()) === false) {
            $this ->rollback();
            return false;
        }

        //删除成功
        $this->commit();
        return true;
    }
}