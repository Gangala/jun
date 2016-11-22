<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/19
 * Time: 21:42
 */

namespace Home\Controller;


use Think\Controller;

class GoodsController extends Controller
{
    /**
     * @var \Home\Model\GoodsModel
     */
    private $_model;
    protected function _initialize(){
        $this->_model =D('Goods');
    }
    public function index($id){
        //查询商品数据
        $row =$this->_model->getTheRow($id);
        //分配数据并选择视图
        $this->assign('row',$row);
        $this ->display();
    }
}