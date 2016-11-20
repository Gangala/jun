<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/17
 * Time: 13:37
 */

namespace Home\Controller;


use Org\Util\String;
use Think\Controller;

class UserController extends Controller
{
    /**
     * @var \Home\Model\UserModel
     */
    private  $_model;
    protected function _initialize(){
        $this ->_model = D('User');
    }
    public function index(){

        $this -> display();
    }

    public function reg(){
        if (IS_POST) {
            //收集并验证数据
            if ($this ->_model->create('','reg') === false) {
                $this ->error(get_error($this->_model));
            }
            //添加数据
            if ($this ->_model ->add_new_user() === false) {
                $this ->error(get_error($this->_model));
            }
            //注册成功
            $this ->success('注册成功，请通过邮箱激活账号',U('Index\index'));
        }else{
            $this -> display();
        }
    }

    /**
     *  用户登录
     *      返回  -1 用户名不存在
     *      返回 -2 用户密码错误
     *      验证成功 返回数组
     */
    public function login(){
        if (IS_POST) {
            //收集数据并自动验证数据
            if ($this->_model->create() === false) {
                $this ->error(get_error($this->_model));
            }

            //查询用户
            if (($user_info = $this->_model->checkUser()) === false) {
                $this ->error(get_error($this->_model));
            }

            //用户名和密码均正确，判断用户是否已激活账号
            if ($user_info['status'] ===0) {
                $this ->error('您的账户还未激活，请先前往邮箱激活账号！');
            }

            //登录成功
            $rememeber = I('post.remember');
            //更新令牌
            $this->_model->_savetoken($user_info,$rememeber);
            //记录用户session
            session('HOME_INFO',$user_info);
            //记录用户的登录时间和ip
            $this->_model->_saveIpTime($user_info);
            $this->success('登录成功',U('Index/index'));
        }else{
            //调用自动登录
            if ($this->_model->_auto_login() === false) { //自动登录失败
                $this -> display();
            }else{
                $this->success('登录成功',U('Index/index'));
            }
        }
    }

    public function login_out(){
        $this -> display();
    }


    /**
     * 发送手机验证码
     * @param $tel 手机号码
     * @param $name 用户名
     */
    public  function SendMsg($tel,$name){
        if (IS_AJAX) {
            vendor('Alidayu.TopSdk');
            date_default_timezone_set('Asia/Shanghai');
            $c = new \TopClient;
            $c ->appkey = '23534027' ;
            $c ->secretKey = 'af9a5d96d661747e6878f4b42443a3c7' ;
            $req = new \AlibabaAliqinFcSmsNumSendRequest;
            $req ->setExtend( "" );
            $req ->setSmsType( "normal" );
            $req ->setSmsFreeSignName( "俊丿帅测试" );
            $code = String::randNumber(1000,9999);
            $data=[
                'tel' => $tel,
                'code' =>$code
            ];
            //将验证码存放到session中
            session('TEL_CODE',$data);
            $req ->setSmsParam( "{name:'$name',code:'$code'}" );
            $req ->setRecNum( "$tel" );
            $req ->setSmsTemplateCode( "SMS_26070305" );
            $resp = $c ->execute( $req );
            //判断短信发送结果
            if($resp->result->success){ //发送成功
                $this->ajaxReturn(true);
            }
        }
        //发送失败！可能是账户缺钱、接口速度流限制或者非ajax请求
        $this->ajaxReturn(false);
    }

    /**
     *  发送邮件
     * @param $token 确保连接的唯一性标识
     * @param $email 验证邮箱
     */

    public function active($token,$email){
        $res =$this ->_model-> where(['email'=>$email,'active_token'=>$token]) ->save(['status'=>1]);
        //判断结果
        if($res){
            //记录session
            $this->success('激活成功！',U('Index\index'));
        }else{
            $this->error('激活失败！');
        }
    }


    /**
     * 验证手机号码，邮箱，用户名的唯一性方法
     */
    public function checkByParam(){
        $cond = I('get.');
        $res = $this->_model->where($cond)->count();
        //判断结果
        if($res){
            $this->ajaxReturn(false);
        }else{
            $this->ajaxReturn(true);
        }
    }

}