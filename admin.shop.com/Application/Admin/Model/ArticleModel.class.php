<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/6
 * Time: 12:26
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class ArticleModel extends Model
{


    /**
     * 自动验证
     */

    protected $_validate =[
        ['name','require','文章名称不能为空']
    ];
    /**
     *  获取分页结果
     * @param array $cond 文章查找关键字
     * @return array
     */
    public function getPageResult(array $cond=[]){
        //合并数组
        $cond = array_merge(['status'=>['gt',0]],$cond);
//        dump($cond);exit;
        //获取数据总条数
        $total = $this ->where($cond)->count();
//        dump($total);exit
        //获取分页工具条
        $page = new Page($total,C('PAGE.SIZE'));
//        dump($page);exit;
        //设置分页样式
        $page ->setConfig('theme',C('PAGE.THEME'));
        //生成page页面
        $page_html = $page ->show();
        //获取分页数据
        $rows = $this ->where($cond)->page(I('get.p'),C("PAGE.SIZE"))->order('sort')->select();
        //返回数据
        return [
            'page_html' =>$page_html,
            'rows' =>$rows
        ];
    }
}