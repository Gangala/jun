<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/23
 * Time: 0:09
 */

namespace Home\Controller;


use Think\Controller;

class OrderController extends Controller
{
    public function create_order(){
        $data =I('post.');
        dump($data);exit;
    }
}