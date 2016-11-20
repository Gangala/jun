<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/12
 * Time: 21:24
 */

namespace Common\Behaviors;


use Think\Behavior;

class CheckPermissionBehavior extends Behavior
{
    public function run(&$params)
    {
        //排除某些行为不验证
        $ignores =C('RBAC.IGNORE');
        //当前路径
        $url = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
        if(in_array($url,$ignores)){
            return true;
        }
        //检测用户是否登录
        if (!$admin_info = session('ADMIN_INFO')) {
            //尝试自动登录
            if (!D('Admin')->auto_login()) {
                //没有登录则跳转到登录界面
                $url = U('Admin/login');
                redirect($url);
            }
        }
        //创建已登录用户的忽略列表
        $user_ignores =C('RBAC.USER_IGNORE');
        if(in_array($url,$user_ignores)){
           return true;
        }

        //判断是否为超级管理员
        if ($admin_info['username'] == 'admin') {
            return true;
        }
        //获取RBAC权限
        $permissions = session('ADMIN_PATH');
        //判断用户是否有权限
        if(in_array($url,$permissions)){
            return true;
        }else{
            echo '<script type="text/javascript">alert("你无权访问");history.back();</script>';
            exit;
        }
    }
}