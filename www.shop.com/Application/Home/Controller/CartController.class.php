<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/20
 * Time: 20:50
 */

namespace Home\Controller;


use Think\Controller;

class CartController extends Controller
{
    /**
     * @var \Home\Model\CartModel
     */
    private $_model;
    protected function _initialize(){
        $this ->_model = D('Cart');
    }
    //添加购物车
    public function addToCart(){
        $goods_id=I('post.goods_id');
        $amount =I('post.amount');
        //判断用户是否已登录
        $user_info =session('USER_INFO');
        if ($user_info) { //已登录
            //从数据库获取商品数据
            $row = $this ->_model ->where(['member_id'=>$user_info['id'],'goods_id'=>$goods_id])->find();
            //如果存在该商品，则数量增加
            if ($row) {
                $amount = $amount + $row['amount'];
                $this ->_model->where(['member_id'=>$user_info['id'],'goods_id'=>$goods_id])->setInc(['amount' =>$amount]);
            }else{
                //如果不存在该商品，则创建记录
                $data =[
                    'goods_id' =>   $goods_id,
                    'amount'    =>  $amount,
                    'member_id' =>  $user_info['id'],
                ];
                $this ->_model -> add($data);
            }
        }else{  //未登录
            //获取cookie中是否存在该商品
            $cart = cookie('CART_INFO');
            if(isset($cart[$goods_id]) ){
                //如果存在就 数量增加
                $cart[$goods_id] += $amount;
            }else{
                //不存在就 创建该商品
                    $cart[$goods_id] = $amount;
            }
                //将数据保存到cookie中
                cookie('CART_INFO',$cart,604800);
        }
        $this->success('添加成功', U('flow1'));
    }
    public function flow1(){
            $rows = $this->_model->getCartList();
            //分配数据并选择视图
            $this ->assign($rows);
            $this ->display();
    }

    /**
     *      用户订单提交页
     *          确认 收货地址  送货方式  支付方式  商品清单
     *
     */
    public function flow2(){
        //判断用户是否已经登录
        $user_info = _isLogin();
        if ($user_info === false) {  //用户未登录
            cookie('come_url',__SELF__);
            $this -> error('请先登录',U('User/login'));
        }
        //获取用户的地址
        $addresses = D('Address')->getList();
        //获取购物车信息
        $cart_rows = $this ->_model-> getCartList();

        //分配数据并选择视图
        $this ->assign('addresses',$addresses);
        $this ->assign($cart_rows);
        $this ->display();
    }

    public function flow3(){
        if (IS_POST) {
            //收集数据
            $data = I('post.');
        }else{
            $this ->display();
        }
    }
}