<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/10
 * Time: 9:17
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Verify;

class AdminController extends Controller
{
    public function index(){
        //接收搜索关键词
        $keyword = I('get.keyword');
        //查询数据
        $rows = D('Admin')->selectAllAdmin($keyword);
        //分配数据并选择视图
        $this ->assign('rows',$rows);
        $this ->display();
    }

    /**
     * 添加管理员
     */

    public function reg(){
        if (IS_POST) {
            //收集并验证数据
            $admin_model = D('Admin');
            if ($admin_model ->create('','reg') === false) {
                $this -> error($admin_model->getError());
            }

            //添加
            if ($res = $admin_model -> addData() ===false) {
                $this ->error($admin_model ->getError());
            }

            //判断结果
            $this -> success('添加成功',U('index'));
        }else{
            //获取角色列表
            $role_list = D('Role')->order('sort')->select();
            $this->assign('row',$role_list);
            $this -> display();
        }
    }

    /**
     * 用户登录
     */
    public function login(){
        if (IS_POST) {
            //验证验证码
            $code = I('post.captcha');
            $varify = new Verify();
            $re = $varify ->check($code);
            //判断验证结果
            if ($re ===false) {
                $this ->error('验证码不正确');
            }
            //自动验证和自动完成
            $admin_model = D('Admin');
            if ($admin_model ->create() === false) {
                $this ->error($admin_model->getError());
            }

            /**
             * 验证登录
             *      用户名不存在 返回-1
             *      用户密码错误  返回-2
             *      登录成功返回 用户信心
             */
            $res = $admin_model ->Login();
            if (!is_array($res)) {
                switch($res){
                    case -1 : $errorMeg = '用户名不存在！';break;
                    case -2 : $errorMeg = '密码不正确！';break;
                }
                $this ->error($errorMeg);
            }else{
                //保存用户的ip地址和最后登录时间
                $msg['last_login_ip'] = ip2long($_SERVER['REMOTE_ADDR']);
                $msg['last_login_time'] = NOW_TIME;


                //产生token令牌并保存至数据库
                $msg['token'] = $admin_model -> _mksalt();
                $msg['token_create_time'] = NOW_TIME;

                //保存ip和token以及对相应的创建时间
                $admin_model ->where(['id'=>$res['id']])->save($msg);
                $this ->success('登录成功',U('Index/index'));
            }
        }else{
            $this -> display();
        }
    }

    /**
        退出登录
     */
    public function out_login(){
        cookie('shop_admin',null);
        session('ADMIN_INFO',null);
        $url = U('login');
        $this->redirect($url);
    }


    /**
     * 管理员信息编辑
     */
    public function edit($id){
        if (IS_POST) {
            $admin_model = D('Admin');
            //手机并验证数据
            if ($admin_model ->create() === false) {
                $this->error(get_error($admin_model));
            }
            //保存数据
            if ($admin_model ->saveEdit($id) === false) {
                $this->error(get_error($admin_model));
            }

            //保存成功
            $this ->success('保存成功',U('index'));
        }else{
            //查询用户信息
            $row = D('Admin') -> select_info($id);
            //获取角色列表
            $role_list = D('Role')->order('sort')->select();
            //获取管理员角色对应表
            $admin_row_info = M('AdminRole')->where(['admin_id'=>$id])->getField('role_id',true);

            //分配数据和选择视图
            $this->assign('admin_role',$admin_row_info);
            $this->assign('rows',$role_list);
            $this -> assign('row',$row);
            $this -> display();
        }
    }

    public function remove($id){
        if (D('Admin') -> delete($id) ===false) {
            $this->error('移除失败');
        }else{
            $this->success('移除成功',U('index'));
        }
    }

}