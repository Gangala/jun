<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/5
 * Time: 17:08
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class BrandModel extends Model
{

    /**
     * 自动验证
     */

    protected $_validate = [
        ['name','require','品牌名称不能为空']
    ];


    /**
     * 获取分页数据
     */

    function getPageResult(array $cond=[]){
        //（按搜索条件）显示上架品牌
        $cond = array_merge(['status'=>['neq',-1]],$cond);
//        dump($cond);exit;
        //获取数据总条数
        $count = $this -> where($cond)->count();
//        dump($count);exit;
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


    public function edit(){
        if (IS_POST) {

        }else{
            $this ->display('add');
        }
    }

}