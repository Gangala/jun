<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/9
 * Time: 19:01
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class GoodsModel extends Model
{
    /**
     * 自动验证
     */
    protected  $_validate = [
        ['name','require','商品名称不能为空'],
        ['goods_category_id','require','分类必须选择'],
        ['brand_id','require','品牌必须选择'],
        ['brand_id','require','品牌必须选择'],
        ['logo','require','商品LOGO必须上传'],
        ['logo','require','商品LOGO必须上传'],
    ];

    /**
     * 搜索结果
     * @param $data
     */
    public function getPageResult($data){

        //去掉无用的搜索条件
        if($data['category_id'] == ''){
            unset($data['goods_category_id']);
        }

        if ($data['brand_id'] == "") {
            unset($data['brand_id']);
        }

        if ($data['goods_status'] == '') {
            unset($data['goods_status']);
        }

        if($data['status'] == ''){
            unset($data['status']);
        }

        $conf = [];
        if ($data['keyword']) {
            $conf['name'] =['like','%'.$data['keyword'].'%'];
        }

        //查询上架商品
        $cond = array_merge(['status'=>['neq',0]],$conf);
        //获取总记录数
        $count = $this ->where($cond)->count();
        //获取分页工具
        $page = new Page($count,C('PAGE.SIZE'));
        //设置分页样式
        $page ->setConfig('theme',C('PAGE.THEME'));
        //生成分页工具
        $page_html = $page -> show();
        //获取分页后的结果
        $rows = $this ->where($cond)->page(I('get.p'),C('PAGE.SIZE'))->order('sort')->select();

        //判断商品状态
        $num = count($rows);
        for($i = 0 ;$i <$num;$i++){
            $rows[$i]['is_best'] = (int)$rows[$i]['goods_status'] & 1 ? 1:0;
            $rows[$i]['is_new'] = $rows[$i]['goods_status'] & 2 ? 1:0;
            $rows[$i]['is_hot'] = $rows[$i]['goods_status'] & 4 ? 1:0;
        }

        //返回分页数据
        return [
            'page_html' => $page_html,
            'rows' =>$rows
        ];
    }

    public function addData(){
        //获取生成的货号 存入data属性中
        $this->data['sn'] = $this->_mkGoodsInfo();
        //写入创建时间
        $this->data['inputtime']=NOW_TIME;
        //商品状态
        $this->data['status'] =1;
        //将商品销售状态求和
        $this->data['goods_status'] = array_sum($this->data['goods_status']);

        //接收内容和图片路径
        $data['content']=I('post.content');
        $data['path']=I('post.path');

        //开启事务
        $this->startTrans();
        //插入goods表数据
        if (($id =$this->add()) ===false) {
            $this->error="添加失败";
            $this ->rollback();
            return false;
        }
        $data['goods_id'] =$id;
        //插入goods_detail表数据
        if (M('GoodsDetail')->add($data) === false) {
            $this->error="添加失败";
            $this ->rollback();
            return false;
        }

        $dataList = [];
        //构建图片路径数组
        foreach($data['path'] as $v){
            $dataList[] =[
                'goods_id'=>$id,
                'path' =>$v
            ];
        }
        //添加图片路径
        if (M('GoodsGallery')->addAll($dataList) === false) {
            $this->error="添加失败";
            $this ->rollback();
            return false;
        }

        //添加成功
        $this ->commit();
        //将商品统计表数据加1
        //判断今天是否有添加商品记录
        $date =date('Y-m-d',NOW_TIME);
        //有则增加1个商品统计
        if ($num = M('GoodsDayCount')->where(['day'=>$date])->find()) {
            $count = $num['count']+1;
            M('GoodsDayCount')->setField('count',$count);
        }else{
            $data=[
              'day'=>$date,
                'count' =>1,
            ];

            /**
             * TODO:未做完
             */
            M('GoodsDayCount')->add($data);
        }
        //没有则添加一条记录
        return true;
    }


    public function _mkGoodsInfo(){
        //查询当日创建的商品数量
        $res = M('GoodsDayCount')->where(['day'=>date('Ymd',NOW_TIME)])->getField('count');
        $str_num = strlen($res)+1;
        //补全位数
        switch($str_num){
            case 1:$str ='0000'.$res;break;
            case 2:$str ='000'.$res;break;
            case 3:$str ='00'.$res;break;
            case 4:$str ='0'.$res;break;
        }
        return 'SN'.date('Ymd',NOW_TIME).$str;
    }


    //
    public function savedata($data){
        //验证数据
        if ($data['name'] == "") {
            $this -> data['error'] = '用户名不能为空';
            return false;
        }

        //处理图片路径
        $data['path'] = implode(',',$data['path']);

        //处理商品销售状态
        $data['goods_status'] = array_sum($data['goods_status']);
        //添加goods_id 字段
        $data['goods_id']=$data['id'];

        //开启事务
        $this->startTrans();

        //保存goods表
        if ($this ->save($data) === false) {
            $this ->rollback();
            return false;
        }
        //保存goods_detail表
        if (M('GoodsDetail')->save($data) ===false) {
            $this ->rollback();
            return false;
        }

        //保存goods_gallery表
        if (D('GoodsGallery')->save($data) ===false) {
            $this ->rollback();
            echo 22;
            return false;
        }

        //保存成功
        $this ->commit();
        return true;

    }
}