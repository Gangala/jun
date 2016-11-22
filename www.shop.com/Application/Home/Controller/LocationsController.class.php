<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/22
 * Time: 17:38
 */

namespace Home\Controller;


use Think\Controller;

class LocationsController extends Controller
{
    private  $_model;
    protected  function _initialize(){
        $this ->_model = D('Locations');
    }
    //获取省市县三级联动列表
    public function getListById($id){
        $result = $this ->_model ->getCityMsg($id);
        $this ->ajaxReturn($result);
    }

}