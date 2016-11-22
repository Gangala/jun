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


    /**
     *      添加收货地址
     */
    public function add_address(){
        if (IS_POST) {
            //收集数据
            $data=I('post.');
            //获取用户id
            $data['member_id'] = _isLogin();
            //保存用户的地址
            if (D('Address')->save_address($data) === false) {
                $this ->error('添加失败');
            }
            $this -> success('保存成功',U('add_address'));
        }else{
            //获取用户的发货地址
            $addres_msg = D('Address')->getList();
            //获取省级列表
            $rows = D('Locations') -> getCityMsg();
            //分配数据并选择视图
            $this ->assign('addres_msg',$addres_msg);
            $this ->assign('rows',$rows);
            $this->display('address');
        }
    }


    public function edit_address($id){
        if (IS_POST) {
            //收集数据
            $data = I('post.');

            //将修改保存到数据表中
            if (D('Address')->saveEdit($data) === false) {
                $this ->error('修改失败');
            }
            $this -> success('修改成功',U('Index/add_address'));
        }else{
            //获取当前地址信息
            $now_address = D('Address') -> get_this_address($id);
            //获取省级列表
            $province_rows = D('Locations') -> getCityMsg();
            //获取城市列表
            $city_rows = D('Locations') -> getCityMsg($now_address['province_id']);
            //获取区县列表
            $area_rows = D('Locations') -> getCityMsg($now_address['city_id']);
            //分配数据并选择视图
            $this ->assign('now_address',$now_address);
            $this ->assign('city_rows',$city_rows);
            $this ->assign('area_rows',$area_rows);
            $this ->assign('province_rows',$province_rows);
            $this -> display('address_edit');
        }
    }


    public function remove_address($id){
        //删除用户地址
        if (D('Address') ->delete($id) === false) {
            $this ->error('删除失败');
        }
        $this ->success('删除成功',U('Index/add_address'));
    }


   /* public function change_default_address($id){
        $data =[
            'id'=>$id,
            'is_default' =>1
        ];
        //修改用户的默认地址
        if (D('Address')->save($data) === false) {
            $this ->error('设置失败');
        }

        $this ->success('设置成功',U(''))
    }*/
}