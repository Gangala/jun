<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/6
 * Time: 11:46
 */

namespace Admin\Controller;


use Think\Controller;

class ArticleController extends Controller
{
    /**
     * 文章列表
     */
    public function index(){
        //获取搜索关键词
        $keywords =trim(I('get.searce'))?trim(I('get.searce')):'';
        //dump($keywords);
        $cond=[];
        if($keywords){
              $cond['name'] = ['like','%'.$keywords.'%'];
            //$cond['intro'] = ['like','%'.$keywords.'%'];  如何使用才能查询出文章名称和简介中包含关键词
        }

        //查询分页数据
        $articleModel = D('Article');
        $rows = $articleModel ->getPageResult($cond);
//        dump($rows);
        //分配数据引入视图
        $this ->assign('metaenmu','文章列表');
        $this ->assign('metatitle','添加文章');
        $this ->assign($rows);
        $this -> display();
    }

    /**
     * 添加文章
     */
    public function add(){
        if (IS_POST) {
            //创建模型
            $article_detailModel = M('ArticleDetail');
            $articleModel = D('Article');
            //接收数据并验证数据
            $data =I('post.');
            //验证字段
            if ($data['name'] == "") {
                $this ->error('文章题目不能为空');
                return ;
            }
            //写入数据
                //开启事务
                $articleModel ->startTrans();
                //写入数据
                $id = $articleModel ->add($data);

                if ($id == false) {
                    $articleModel ->rollback();
                    $this ->error('操作失败');
                    return;
                }

                //存入文章id
                $data['article_id'] = $id;

                //写入文章内容
                if ($article_detailModel ->add($data) ===false) {
                    $articleModel ->rollback();
//                    $this ->error($article_detailModel->getError());
                    $this ->error('操作失败');
                    return;
                }
                //提交事务
                $articleModel ->commit();
                //判断写入结果 成功则提交 否则回滚
                $this -> success('添加成功',U('index'));
        }else{
            $article_categoryModel = M('ArticleCategory');
            $rows = $article_categoryModel ->select();
            $this ->assign('metaenmu','文章列表');
            $this ->assign('metatitle','添加文章');
            $this ->assign('res',$rows);
            $this ->display();
        }
    }

    /**
     * 编辑文章
     */
    public function edit($id){
        //创建模型
        $articleModel = D('Article');
        $article_detail = M('ArticleDetail');
        if (IS_POST) {
            $data = I('post.');
            //接收数据
            $articleModel->id=$data['id'];
            $articleModel->name=$data['name'];
            $articleModel->article_category_id=$data['article_category_id'];
            $articleModel->intro=$data['intro'];
            $articleModel->sort=$data['sort'];
            $articleModel->status=$data['status'];
            $articleModel->content=$data['content'];
            $article_detail->article_id =$data['id'];
            $article_detail->content=$data['content'];
            //开启事务
           $articleModel -> startTrans();
            //写入文章表
            $re = $articleModel -> save();
            //判断结果
            if ($re ===false) {
                $articleModel->rollback();
                $this ->error("修改失败");
            }
            //写入文章内容
            $res =$article_detail ->save();
            if ($res ===false) {
                $articleModel ->rollback();
                $this ->error('修改失败');
            }
            $articleModel ->commit();
            $this ->success('修改成功',U('index'));
        }else{
            //查询文章分类信息
            $article_categoryModel = M('ArticleCategory');
            $res = $article_categoryModel ->select();
            //查询文章基本数据
            $row = $articleModel ->find($id);
            //查询文章内容数据
            $row['content']=$article_detail->where("article_id=$id")->getField('content');
            //回显数据
            $this ->assign('metaenmu','文章列表');
            $this ->assign('metatitle','修改文章');
            $this ->assign('res',$res);
            $this ->assign('row',$row);
            $this ->display('add');
        }



    }


    /**
     * 移除文章
     */
    public function remove($id){
        //创建模型
        $articleModel = D('Article');
        //逻辑删除文章
        $re = $articleModel ->where("id=$id")->setField('status',0);
        //判断删除结果
        if ($re) {
            $this ->success('删除成功',U('index'));
        }else{
            $this ->error('删除失败');
        }
    }
}