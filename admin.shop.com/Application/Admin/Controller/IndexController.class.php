<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index()
    {
        $this ->display();
    }

    public function top(){

        $this ->display();
    }

    public function menu(){
        //获取所有的菜单
        $menu_rows = D('Menu') -> getVisbleMenu();
        //分配数据并选择视图
        $this ->assign('menu_rows',$menu_rows);
        $this ->display();
    }

    public function main(){

        $this ->display();
    }
}