<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/20
 * Time: 21:53
 */

namespace Home\Model;


use Think\Model;

class CartModel extends Model
{
    public function getCartList(){
        //初始化商品总价
        $total_price = 0.00;
        $user_id = _isLogin();
        //判断是否登录
        if ($user_id) { //用户已登录
            $cart = $this->where(['member_id'=>$user_id])->getField('goods_id , amount',true);
        }else{  //用户未登录
            //获取cookie 中的数据
            $cart = cookie('CART_INFO');
        }
        //获取商品id
        $goods_ids = array_keys($cart);  //返回一个由原数组的键名组成的一个新数组
        //判断是否为空
        if (empty($goods_ids)) {
            $goods_detail =[];
        }else{
            //查询商品信息
            $goods_detail = D('Goods') ->getCartListInfoByIds($goods_ids);
            //遍历商品信息
            $goods_count = count($goods_detail);
            foreach($goods_detail as $k => $v){
                $v['amount'] = $cart[$k];//商品数量
                $v['sub_total'] = money_format($v['amount'] * $v['shop_price']);//格式化商品小计
                $goods_detail[$k] = $v;//将数据封装到goods_detail中
                $total_price = $total_price +$v['sub_total'];//计算商品总价
            }
        }
        //格转换货币格式
        $total_price = money_format($total_price);
        return [
            'total_price' => $total_price,
            'goods_count'   =>$goods_count,
            'goods_detail' =>$goods_detail,
        ];
    }




}