<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/17
 * Time: 16:47
 */

namespace Home\Model;

use Org\Util\String;
use Think\Model;
use Think\Verify;

class UserModel extends Model
{

    //开启批量验证
    protected $patchValidate = true;

    /**
     * 自动验证
     */
    protected  $_validate =[
        ['username','require','用户名必填'],
//        ['username','3，20','用户名必须是3到20个字符长度',self::EXISTS_VALIDATE,'length','reg'],
        ['username','','用户名已存在',self::EXISTS_VALIDATE,'unique','reg'],
        ['password','require','密码必填'],
        ['repassword','require','确认密码必填',self::EXISTS_VALIDATE],
        ['repassword','password','两次密码输入不一致',self::EXISTS_VALIDATE,'confirm'],
        ['email','require','邮箱不能为空'],
        ['email','email','邮箱格式不正确'],
        ['email','','邮箱已存在',self::EXISTS_VALIDATE,'unique'],
        ['tel','require','手机不能为空'],
        ['tel','/^1[34578]\d{9}$/','手机格式不正确',self::EXISTS_VALIDATE],
        ['tel','','手机号码已存在',self::EXISTS_VALIDATE,'unique'],
        ['captcha','require','手机验证码必填',self::MUST_VALIDATE,'','reg'],
        ['captcha','checkTelCode','手机验证码不正确',self::MUST_VALIDATE,'callback','reg'],
//        ['checkcode','require','验证码必填',self::MUST_VALIDATE],
//        ['checkcode','checkCode','验证码不正确',self::MUST_VALIDATE,'callback'],

    ];

    /**
     * 自动完成
     */

    protected  $_auto =[
        ['add_time',NOW_TIME,'reg'],
        ['salt','Org\Util\String::randString','reg','function'],
        ['token','Org\Util\String::randString','reg','function'],
        ['last_login_time',NOW_TIME,'reg'],
    ];

    /**
     * 获取当前的ip并转换成整型数据
     * @return int
     */

    protected function _getNowIp(){
        $ip = get_client_ip();
        return ip2long($ip);
    }


    public function checkTelCode(){
        //获取用户输入的手机号码和验证码
        $tel = I('post.tel');
        $telcode = I('post.captcha');
        //获取发送的验证码
        $data = session('TEL_CODE');
        //判断用户是否发送了短信，未发送
        if(empty($data)){
            return false;
        }
        //判断用户提交的信息
        if ($tel !==$data['tel']) {
            return false;
        }
        if ($telcode !==$data['code']) {
            return false;
        }
        //清空验证码
        session('TEL_CODE',null);
        return true ;
    }

    /**
     * 验证验证码是否正确
     */

    public function checkCode(){
        //获取验证码
        $code = I('post.checkcode');
        $verify = new Verify();
        return $verify ->check($code);
    }


    /**
     * 添加新用户
     * @return mixed
     */
    public function add_new_user(){
        $this ->data['last_login_ip'] =$this->_getNowIp();
        //对密码进行加盐加密
        $this->data['password'] =md5(md5($this->data['password']).$this->data['salt']);
        $this->data['active_token'] = String::randString(32);

        //获取用户的邮箱
        $email = $this ->data['email'];
        $token = $this->data['active_token'];
        //添加数据
         $re = $this ->add();
        //判断添加数据结果
        if($re){
            $title="欢迎注册啊咿呀哟";
            $url = U('User/active',['token'=>$token,'email'=>$email],'',true);
            $content ="<p>欢迎注册哎咿呀哟商城，请点击<a href=''.$url.''>激活连接</a> 激活账号，如果不能点击请复制地址".$url."在浏览器中打开</p>";
            //发送邮件
            SendEmail($email,$title,$content);
        }else{
            return false;
        }
    }

//    public function _mkEmailUrl(){
//        //获取用户的邮箱
//        $email = $this->data['email'];
//        //获取用户的邮箱格式
//        $emailaddress =preg_match('/@.+\./',$email);
//    }

    /**
     *  验证用户登录
     *      用户名不存在  返回 -1
     *      用户密码错误  返回-2
     *      验证通过    返回用户信息
     */
    public function checkUser(){
        //记录用户输入的用户名和密码
        $username = $this ->data['username'];
        $password = $this ->data['password'];
        //验证用户名是否存在
        if (($user_info = $this ->where(['username'=>$username])->find()) === null) {
           $this ->error = '用户名不存在';
            return false;
        }
        //判断用户密码是否正确
        if (md5(md5($password).$user_info['salt']) !== $user_info['password']) {
            $this ->error = '用户名或密码错误';
            return false;
        }
        //用户验证通过
        //更新token
        $token =String::randString(32);
        $this->where(['id'=>$user_info['id']])->setField('token',$token);
        $user_info['token'] = $token;
        //记录session值
        session('USER_INFO',$user_info);
        return $user_info;
    }


    //自动登录
    public function _auto_login(){
        //获取cookie值
        $cookie = cookie('show_home');
        //验证cookie的值是否为空
        if (empty($cookie)) {
            return false;
        }
        //如果cookie不为空则验证数据
        //通过自动验证
        if ($user_info = $this->where($cookie)->find()) {
            //保存token
            $this->_savetoken($user_info,true);
            //保存用户信息到session中
            session('USER_INFO',$user_info);
            //记录用户的登录时间和ip
            $this ->_saveIpTime($user_info);
            return true;
        }
        //未通过自动验证
        return false;
    }

    /**
     *  更新token并保存token
     * @param $user_info 用户信息
     * @param bool|false $remember 是否勾选记住登录状态
     */
    public function _savetoken($user_info,$remember=false){
        if($remember){

            //更新token
            $token =String::randString(32);
            $data=[
                'id' => $user_info['id'],
                'token' => $token
            ];
            if ($this->save($data)) {
                //保存token到cookie中
                cookie('show_home',$data,604800);
            }
        }
    }

    /**
     *  保存用户的登录ip和登录时间
     * @param $user_info 用户信息
     */
    public function _saveIpTime($user_info){
        //获取ip
        $ip =get_client_ip();
        $data['id'] =$user_info['id'];
        $data['last_login_ip']=ip2long($ip);
        $data['last_login_time'] =NOW_TIME;
        $this->save($data);
    }
}