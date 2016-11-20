<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/6
 * Time: 14:23
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class ArticleCategoryModel extends Model
{

    protected $_validate = [
      ['name','require','分类名称不能为空'],
    ];
    /**
     * 获取分页数据
     */

    function getPageResult(array $cond=[]){

        //显示上架品牌
        $cond = array_merge(['status'=>['neq',0]],$cond);
//        dump($cond);exit;
        //获取数据总条数
        $count = $this -> where($cond)->count();
        //获取分页工具条
        $page = new Page($count,C('PAGE.SIZE'));
        $page -> setConfig('theme',C('PAGE.THEME'));
        $page_html = $page->show();
        //获取分页数据
        $rows = $this -> where($cond)->page(I('get.p'),C('PAGE.SIZE'))->order('sort')->select();
        //返回数据
        return [
            'page_html'=>$page_html,
            'rows'=>$rows
        ];
    }
}