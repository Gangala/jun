<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/14
 * Time: 13:42
 */

namespace Admin\Controller;


use Think\Controller;

class RoleController extends Controller
{
    private $_model;

    protected function _initialize(){
        $this ->_model = D('Role');
    }
    public function index(){
        //获取关键词
        $keyword = trim(I('get.keyword'));
        //构建查询条件
        $conf = [];
        if ($keyword) {
            $conf['name'] = ['like','%'.$keyword.'%'];
        }
        //查询角色数据
        $rows = $this ->_model -> selectPageResult($conf);
        //分配数据
        $this ->assign($rows);
        $this -> display();
    }

    public function add(){
        if (IS_POST) {
            //收集数据
            if ($this -> _model ->create() === false) {
                $this ->error($this ->_model->getError());
            }
            //添加数据
            if ($this ->_model ->addRole() === false) {
                $this ->error($this ->_model->getError());
            }
            //判断结果
            $this ->success('添加成功',U('index'));
        }else{
            //查询权限列表
            $permissions = M('Permission')->select();
            //分配数据并选择视图
            $this -> assign('permissions',json_encode($permissions));
            $this -> display();
        }
    }

    public function edit($id){
        if (IS_POST) {
            //收集并验证数据
            if ($this->_model->create() === false) {
                $this->error(get_error($this->_model));
            }
            //保存数据
            if ($this ->_model ->saveEdit($id) === false) {
                $this ->error(get_error($this->_model));
            }
            //判断结果
            $this ->success('修改成功',U('index'));
        }else{
            //查询角色数据
            $row = $this->_model->getRoleInfo($id);
            //获取权限列表
            $permission_rows = M('Permission')->order('lft')->select();
            //分配数据并选择视图
            $this->assign('row',$row);
            $this->assign('permission_rows',json_encode($permission_rows));
            $this -> display();
        }
    }

    public function remove($id){
        if ($this->_model->role_remove($id) === false) {
            $this->error(get_error($this->_model));
        }else{
            $this->success('删除成功',U('index'));
        }

    }
}