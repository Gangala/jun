<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/15
 * Time: 22:52
 */

namespace Admin\Controller;


use Think\Controller;

class MenuController extends Controller
{
    /**
     * @var \Admin\Model\MenuModel
     */
    private  $_model ;
    protected function _initialize(){
        $this ->_model = D('Menu');
    }

    public function index(){
        //获取数据
        $rows = $this ->_model ->getList();
        //分配数据并选择视图
        $this ->assign('menu_rows',$rows);
        $this ->display();
    }
    public function add(){
        if (IS_POST) {
            //收集并验证数据
            if ($this->_model->create() === false) {
                $this ->error(get_error($this->_model));
            }
            //添加数据
            if ($this ->_model->addMenu() === false) {
                $this ->error(get_error($this->_model));
            }
            //判断添加结果
            $this ->success('添加成功',U('index'));

        }else{
            //获取菜单列表
            $rows = $this ->_model->getList();
            array_unshift($rows,['id'=>0,'name'=>'顶级菜单']);

            //获取所有权限
            $permission = D('Permission')->getList();
            //分配数据并选择视图
            $this ->assign('permission',json_encode($permission));
            $this ->assign('menu_list',json_encode($rows));
            $this ->display();
        }
    }
    public function edit($id){
        if (IS_POST) {
            //收集并验证数据
            if ($this->_model->create() === false) {
                $this ->error(get_error($this->_model));
            }
            //写入数据
            if ($this->_model->saveEditMenu($id) === false) {
                $this ->error(get_error($this->_model));
            }
            //判断写入结果
            $this ->success('修改成功',U('index'));
        }else{
            //获取菜单及父类菜单数据
            $rows = $this ->_model->getEditMenu($id);

            //获取所有权限
            $permission = D('Permission')->getList();
            //获取当前菜单权限
            $now_menu_permission = M('MenuPermission')->where(['menu_id'=>$id])->getField('permission_id',true);
            //分配数据及选择视图
            $this ->assign('now_menu_permission',json_encode($now_menu_permission));
            $this ->assign('permission',json_encode($permission));
            $this ->assign('row',$rows);
            $this ->display();
        }
    }
    public function remove($id){
        if ($this ->_model ->deleteMenuPermission($id) === false) {
            $this ->error(get_error($this->_model));
        }
        $this ->success('删除成功',U('index'));
    }

}