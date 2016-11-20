<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index(){
        //查询菜单栏信息
        $rows = M("GoodsCategory")->select();
        //查询文章分类及文章信息
        $articlecategory_rows = M('ArticleCategory')->select();
        $article_rows = M('Article')->select();
        //查询热销 新品 精品商品
        $goods_info = M('Goods')->select();
        //分配数据并选择视图
        $this->assign('goods_info',$goods_info);
        $this->assign('article_rows',$article_rows);
        $this->assign('articlecategory_rows',$articlecategory_rows);
        $this ->assign('rows',$rows);
        $this ->display();
    }
}