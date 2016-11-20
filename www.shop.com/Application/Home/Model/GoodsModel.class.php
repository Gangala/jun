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
}