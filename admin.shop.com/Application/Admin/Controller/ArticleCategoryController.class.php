<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/6
 * Time: 14:19
 */

namespace Admin\Controller;


use Think\Controller;

class ArticleCategoryController extends Controller
{
    /**
     * 分类列表
     */
    public function index(){
        //接收搜索关键词
        $code = trim(I('get.searce'))?trim(I('get.searce')):'';
        //判断关键词是否存在
        $conf =[];
        if ($code) {
            $conf['name'] = ['like','%'.$code.'%'];
        }
        //创建模型
        $article_categoryModel = D('ArticleCategory');
        //分页显示
        $rows = $article_categoryModel -> getPageResult($conf);

        //分配数据 选择视图
        $this->assign($rows);
        $this->display();
    }

    /**
     * 添加分类
     */
    public function add(){
        if (IS_POST) {
            //收集数据
            $article_categoryModel = D('ArticleCategory');
            if ($article_categoryModel ->create() == false) {
                $this ->error($article_categoryModel->getError());
                return;
            }
            //插入数据
            if ($article_categoryModel ->add() == false) {
                $this ->error($article_categoryModel->getError());
            }else{
                $this ->success('添加成功',U('index'));
            }
            //判断结果
        }else{
            $this ->assign('metaenmu','分类列表');
            $this ->assign('metatitle','添加分类');
            $this -> display();
        }
    }

    /**
     * 修改分类
     * @param int $id
     */

    public function edit($id=0){
        $article_categoryModel = D('ArticleCategory');
        if (IS_POST) {
            //收集数据
            if ($article_categoryModel ->create() ==false) {
                $this->error($article_categoryModel->getError());
            }
            //保存数据
            if ($article_categoryModel->save() ==false) {
                $this ->error($article_categoryModel->getError());
            }
            //判断结果
            $this ->success('修改成功',U('index'));
        }else{
            //查询数据
            $row = $article_categoryModel ->find($id);
//            dump($row);exit;
            //分配数据 选择视图
            $this ->assign('row',$row);
            $this ->assign('metaenmu','分类列表');
            $this ->assign('metatitle','编辑分类');
            $this -> display('add');
        }

    }

    public function remove($id = 0){
        $article_categoryModel = D('ArticleCategory');
        //逻辑删除字段
        $re = $article_categoryModel ->where("id=$id")->setField('status',0);
        //判断结果
        if ($re) {
            $this->success('删除成功',U('index'));
        }else{
            $this ->error('删除失败');
        }
    }
}