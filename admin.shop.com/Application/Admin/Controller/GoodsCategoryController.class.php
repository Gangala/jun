<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/8
 * Time: 17:34
 */

namespace Admin\Controller;


use Think\Controller;

class GoodsCategoryController extends Controller
{
    /**
     * @var \Admin\Model\GoodsCategoryModel
     */
    private $_model;
    public function _initialize(){
        $this ->_model = D('GoodsCategory');
    }
    /**
     * 获取分类列表
     *
     */
    public function index(){
        $rows = $this->_model ->order('lft')->getList();
        $this -> assign('rows',$rows);
        $this -> display();
    }

    /**
     * 添加方法
     */
    public function add(){
        if (IS_POST) {
            //收集数据
            if ($this->_model->create() ===false) {
                $this ->error($this->_model->getError());
            }
            //保存数据
            if ($this ->_model ->addCategory() ===false) {
                $this -> error($this->_model->getError());
            }
            //判断结果
            $this ->success('添加成功',U('index'));
        }else{
            //查询结果并回显
            $categories = $this ->_mkTree_view();
            $this -> assign('categories',$categories);
            $this -> display();

        }
    }

    /**
     * 修改方法
     * @param $id
     */
    public function edit($id){
        if (IS_POST) {

            //接收并验证数据
            if ($this ->_model->create() === false) {
                $this -> error($this->_model->getError());
            }
            //保存修改后的数据
            if ($this ->_model->saveCategory() === false) {
                $this ->error($this -> _model->getError());
            }
            //保存成功
            $this ->success('修改成功',U('index'));

        }else{
            //查询商品数据数据
            $goods_row = $this->_model -> find($id);
            //查询商品分类数据
            $this -> assign('goods_row',$goods_row);//商品信息回显
            //回显
            $categories = $this ->_mkTree_view();
            $this -> assign('categories',$categories);//商品分类下拉框回显
            $this -> display('add');
        }

    }

    /**
     * 删除方法
     * @param $id
     */
    public function remove($id){
        if ($this ->_model ->deleteCategory($id) ===false) {
            $this ->error($this->_model->getError());
        }
        $this ->success('删除成功',U('index'));
    }

    private function _mkTree_view(){
        $rows = $this->_model->order('lft') ->getList();
        array_unshift($rows,['id'=>0,'name'=>'顶级分类']);
        $categories = json_encode($rows);
        return $categories;
    }

}