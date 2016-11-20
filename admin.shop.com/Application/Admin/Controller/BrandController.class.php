<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/5
 * Time: 17:02
 */

namespace Admin\Controller;


use Think\Controller;

class BrandController extends Controller
{

    /**
     * 显示商品品牌列表
     */

    public function index(){ //品牌列表
        //创建模型
        $brandModel = D('Brand');
        //获取搜索条件
//        $search = I('get.searce');
        $search_word =trim(I('get.searce'))?trim(I('get.searce')):'';
        $cond =[];
        //判断搜索条件是否为空
        if($search_word){
            $cond['name'] = ['like' , '%'.$search_word.'%'];
        }
        //读取列表
        $rows = $brandModel -> getPageResult($cond);
        //分配数据
        $this ->assign($rows);
        $this ->display();
    }

    /**
     * 添加商品品牌
     */

    public function add(){
        if (IS_POST) { //提交数据
            //收集数据
            $brandModel = D('Brand');
            //自动验证数据
            if ($brandModel -> create() == false) { //验证失败
                $this -> error($brandModel->getError());
                return;
            }

            //添加数据
            if ( $brandModel ->add() == false) { //添加失败
                $this -> error($brandModel -> getError());
                return ;
            }

            $this -> success('添加成功',U('index'));

        }else{ //非提交数据
            $this -> display();
        }
    }

    /**
     * 编辑商品品牌
     */

    public function edit($id=0){

        $brand_model = D('Brand');
        if (IS_POST) {
            //获取数据
            $data = I('post.');
//            var_dump($data);exit;
            //验证数据
            if ($brand_model->create($data) ===false) {
                $this -> error($brand_model->getError());
            }
            //修改失败
            if ($brand_model ->save() ===false) {
                $this -> error($brand_model->getError());
            }
            //修改成功
            $this ->success('修改成功',U('index'));
        }else{
            //查询数据
            $row = $brand_model -> find($id);
//        dump($row);
            //分配数据、引入视图
            $this -> assign('row',$row);
            $this -> display('add');
        }
    }

    /**
     * 移除商品品牌
     */

    public function remove($id=0){
        //创建模型
        $brand_model = D('Brand');
        $re = $brand_model -> where(['id'=>$id])->setField('status',-1);
        //判断结果
        if($re ===false){
            $this->error($brand_model->getError());
        }else{
            $this->success('删除成功',U('index'));
        }
    }

}
