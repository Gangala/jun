<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/9
 * Time: 15:09
 */

namespace Admin\Controller;


use Think\Controller;

class GoodsController extends Controller
{
    /**
     * @var \Admin\Model\AdminModel
     *
     */
    //创建模型
    private  $_model;
    protected  function _initialize(){
        $this ->_model = D('Goods');
    }
    public function index(){

        //查询商品分类
        $goods_category_model = M('GoodsCategory');
        $goods_category_data = $goods_category_model->getField('id,id,name');

        //查询品牌分类
        $brand_model = M('Brand');
        $brand_rows = $brand_model->select();

        //接收搜索数据
        $data = I('get.');

        //查询商品列表
        $goodsModel = D('Goods');

        //获取分页结果
        $rows = $goodsModel ->getPageResult($data);

        //分配数据
        $this -> assign('goods_category_data',$goods_category_data);
        $this -> assign('brand_rows',$brand_rows);
        $this -> assign($rows);
        $this -> display();
    }

    /**
     * 添加新商品
     */
    public function add(){
        if (IS_POST) {
            //收集并验证数据
            if ($this->_model->create() === false) {
                $this->error(get_error($this->_model));
            }
            //添加数据
            if ($this ->_model ->addData() === false) {
                $this->error(get_error($this->_model));
            }
            //判断添加结果
            $this->success('添加成功',U('index'));
        }else{
            //查询商品分类
            $goods_category_model = M('GoodsCategory');
            $goods_category_rows = $goods_category_model->order('lft')->select();
            //查询品牌分类
            $brand_model = M('Brand');
            $brand_rows = $brand_model->select();

            //分配数据及选择视图
            $this -> assign('goods_category_rows',$goods_category_rows);
            $this -> assign('brand_rows',$brand_rows);
            $this ->display();
        }
    }

    /**
     * 修改商品
     */
    public function edit($id){
        $goods_model = D('Goods');
        if (IS_POST) {
            //接收数据
            $data =I('post.');
            //保存修改
            $res = $goods_model->savedata($data);
            //判断保存结果
            if (!$res) {
                $this ->error('修改失败');
            }else{
                $this ->success('修改成功',U('index'));
            }

        }else{
            //查询数据
            $goods_info = $goods_model -> find($id);
            $goods_detail_info =M('GoodsDetail')->where(['id'=>$id])->getField('content');
            $goods_gallery_info['path'] = M('GoodsGallery')->where(['goods_id' =>$id])->getField('path');

            //勾选复选框状态
            $goods_info['is_best'] = (int)$goods_info['goods_status'] & 1 ? 1:0;
            $goods_info['is_new'] = (int)$goods_info['goods_status'] & 2 ? 1:0;
            $goods_info['is_hot'] = (int)$goods_info['goods_status'] & 4 ? 1:0;

            //转换图片路径
            $path = explode(',',$goods_gallery_info['path']);
            $goods_gallery_info =$path;

            //查询商品分类
            $goods_category_model = M('GoodsCategory');
            $goods_category_rows = $goods_category_model->select();

            //查询品牌分类
            $brand_model = M('Brand');
            $brand_rows = $brand_model->select();

            //回显数据
            $this -> assign('goods_category_rows',$goods_category_rows);
            $this -> assign('brand_rows',$brand_rows);
            $this -> assign('goods_info',$goods_info);
            $this -> assign('goods_detail_info',$goods_detail_info);
            $this -> assign('goods_gallery_info',$goods_gallery_info);
            $this ->display('edit');
        }
    }

    /**
     * 删除商品
     */
    public function remove($id){
        $goods_model = D('Goods');
        $res = $goods_model -> where(['id'=>$id])->save(['status'=>0]);
        //判断结果
        if ($res === false) {
            $this -> error($goods_model->getError());
        }
        $this -> success('删除成功',U('index'));
    }

}