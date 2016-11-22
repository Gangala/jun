<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/19
 * Time: 21:43
 */

namespace Home\Model;


use Think\Model;

class GoodsModel extends Model
{

    public function getTheRow($id){
        //查询商品数据
        $row =$this ->find($id);
        $row['inputtime'] =date('Y-m-d',$row['inputtime']);
        //查询商品详情
        $row['content'] = M('GoodsDetail')->where(['goods_id'=>$id])->getField('content');
        //查询商品图片
        $row['path'] =M('GoodsGallery')->where(['goods_id'=>$id])->getField('path',true);
        //
        //返回商品数据
        return $row;
    }

    /**
     * 查询购物车列表数据
     * @param array $goods_ids 商品的id数组
     * @return mixed
     */
    public function getCartListInfoByIds(array $goods_ids){
          return $this ->where(['id'=>['in',$goods_ids],'status'=>1,'is_on_sale'=>1])->getField('id,name,logo,shop_price');
    }
}