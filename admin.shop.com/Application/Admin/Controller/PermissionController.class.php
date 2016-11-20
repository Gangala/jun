<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/14
 * Time: 14:32
 */

namespace Admin\Controller;


use Think\Controller;

class PermissionController extends Controller
{
    private $_model;
    protected function _initialize(){
        $this ->_model = D('Permission');
    }
    public function index(){
        //查询列表
        $rows = $this ->_model->getList();
        //分配数据
        $this -> assign('rows',$rows);
        $this -> display();
    }

    /**
     * 添加权限
     */
    public function add(){
        if (IS_POST) {
            //收集数据
            if ($this -> _model->create() === false) {
                $this ->error(get_error($this->_model));
            }
            //添加数据

            if ($this ->_model ->addPermission() === false) {
                $this ->error(get_error($this->_model));
            }

            //判断添加结果
            $this ->success('添加成功',U('index'));
        }else{
            $permissions = $this ->_model->getList();
            //添加顶级权限
            array_unshift($permissions,['id'=>0,'name'=>'顶级权限']);
            //分配数据并选择视图
            $this -> assign('permissions',json_encode($permissions));
            $this -> display();
        }
    }

    public function edit($id){
        if (IS_POST) {
            //收集数据并验证
            if ($this ->_model->create() === false) {
                $this ->error(get_error($this->_model));
            }
            //修改数据
            if ($res = $this ->_model -> saveEdit() === false) {
                $this -> error(get_error($this->_model));
            }
            //修改成功
            $this ->success('修改成功',U('index'));
        }else{
            //查询权限
            $row = $this ->_model->find($id);
            //分配数据和选择视图
            $this ->assign('row',$row);
            //获取所有的分类
            $this ->get_permission();
            $this -> display();
        }
    }

    public function remove($id){
        if ($this ->_model ->removePermission($id) === false) {
            $this ->error(get_error($this->_model));
        }else{
            $this ->success('删除成功',U('index'));
        }
    }

    public function get_permission(){
        //查询权限数据
        $rows = $this -> _model ->getList();
        //添加顶级权限选项
        array_unshift($rows,['id'=>'0','name'=>'顶级权限']);
        //返回数据
        $this->assign('permission',json_encode($rows));
    }
}