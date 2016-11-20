<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/10
 * Time: 9:42
 */

namespace Admin\Model;


use Org\Util\String;
use Think\Model;

class AdminModel extends  Model
{
    /**
     * 自动验证
     */

    protected  $_validate =[
      ['username','require','用户名不能为空'],
      ['username','unique','用户名已存在','',self::MUST_VALIDATE ,'reg'],
      ['password','require','密码不能为空'],
      ['email','require','邮箱不能为空'],
      ['email','email','邮箱格式错误'],
    ];

    /**
     * 查询所有的管理员
     */
    public function selectAllAdmin($keyword){
        //创建搜索条件
        $conf = [];
        //判断是否有搜索条件
        if($keyword){
            $conf['username'] = ['like','%'.$keyword.'%'];
        }
        //获取搜索后的结果
        $rows = $this -> where($conf) -> select();
        for($i = 0;$i<count($rows);$i++){
            $rows[$i]['last_login_time'] = date('Y-m-d H:m:s',$rows[$i]['last_login_time']);
            $rows[$i]['last_login_ip'] = long2ip($rows[$i]['last_login_ip']);
            $rows[$i]['add_time'] = date('Y-m-d H:m:s',$rows[$i]['add_time']);
        }
        return $rows;
    }

    /**
     * 添加管理员
     */
    public function addData(){
        //添加字段
        $salt = $this ->_mksalt();
        $this ->data['salt'] = $salt;
        $this ->data['password'] = md5(md5($this->data['password']).$salt);
        $this-> data['add_time'] = NOW_TIME;
        $this-> data['last_login_time'] = NOW_TIME;
        $this-> data['last_login_ip'] = ip2long(get_client_ip());
        //开启事务
        $this->startTrans();
        //存admin表
        if (($id = $this -> add()) ===false) {
            $this->rollback();
            return false;
        }
        //获取角色id
        $role_id=I('post.role_id');
        $admin_id = $id;
        //创建数组
        $data=[];
        foreach($role_id as $v){
            $data[]=[
                'admin_id' => $admin_id,
                'role_id' => $v
            ];
        }
        //存admin_role表
        if (M('AdminRole')->addAll($data) === false) {
            $this->rollback();
            return false;
        }
        //写入成功
        $this ->commit();
        return true;

    }

    /**
     * 查询用户信息
     * @param $id
     */
    public function select_info($id){
        return $this->find($id);
    }

    /**
     * 登录方法
     *      用户名不存在返回 -1
     *      密码不正确返回 -2
     *      验证通过返回用户信息
     */
    public function Login(){
        $username = $this ->data['username'];
        $password = $this ->data['password'];

        //验证用户是否存在
        $admin_info = $this -> getByUsername($username);
        if ($admin_info === null) {
            return -1;
        }

        //验证用户密码是否正确
        $salt =$admin_info['salt'];
        if ((md5(md5($password).$salt)) != $admin_info['password']) {
            return -2;
        }else{
            $remember =I('post.remember');
            if($remember !=1){
                $remember = false;
            }else{
                $remember = true;
            }
            //保存用户的登录状态到session中
            session('ADMIN_INFO',$admin_info);
            //生成token并保存到cookie和数据库中
            $this->_saveToken($admin_info,$remember);
            $this->_savePermission();
            return $admin_info;
        }

    }

    /**
     *  在用户登录的时候，保存用户的权限列表，用于授权使用
     */
    protected function _savePermission(){
        $admin_info = session('ADMIN_INFO');
        //获取当前用户所拥有的权限
        $permissions = M('AdminRole')->alias('ar')->field('p.id,path')->join('__ROLE_PERMISSION__ as rp using(`role_id`)')->join('__PERMISSION__ as p ON rp.`permission_id`=p.`id`')->where(['ar.admin_id'=>$admin_info['id']])->select();
//        dump($permissions);exit;
        //将权限保存到数组中
        $paths =$permission_ids=[];
        foreach($permissions as $v){
            $paths[]=$v['path'];
            $permission_ids[]=$v['id'];
        }
        //将权限数组保存到session中
        session('ADMIN_PATH',$paths);
        session('ADMIN_PID',$permission_ids);

    }

    /**
     * 产生随机的盐
     */

    public function _mksalt(){
        //取得所有的数字和字母
        $arr=array_merge(range(0,9),range("a","z"),range("A","Z"));

        $str=implode("",$arr);
        //打乱字符串
        $str=str_shuffle($str);
        //取出4个
        $str=substr($str,0,4);
        return $str;
    }

    /**
     * 生成token令牌，并保存到cookie和db中
     */
    private function _saveToken($admin_info,$is_remeber=false){
        //勾选记住密码，自动生成token
        if($is_remeber){

            //产生32位随机字符串
            $token = String::randString(32);
            //将id和token保存到数组中
            $data=[
                'id' =>$admin_info['id'],
                'token' =>$token
            ];
            //保存token到cookie中
            cookie('shop_admin',$data,604800);

            //将token保存到数据库中
            $this ->save($data);
        }
    }

    public function auto_login(){
        //获取cookie的值
        $cookie = cookie('shop_admin');
        //判断cookie是否为空
        if (empty($cookie)) {
            return false;
        }
        //检测cookie的值
        if ($admin_info  = $this ->where($cookie)->find()) {
            //跟新到令牌
            $this -> _saveToken();
            //保存用户信息
            session('ADMIN_INFO',$admin_info);
            return $admin_info;
        }else{
            return false;
        }
    }


    public function saveEdit($id){
        //获取角色信息
        $data['role_id'] = I('post.role_id');
        $data['admin_id'] = $this->data['id'];
        //开启事务
        $this->startTrans();
        //保存用户信息
        if ($this->save() === false) {
            $this ->rollback();
            return false;
        }

        //构建批量保存数组
        $dataList = [];
        foreach($data['role_id'] as $v){
            $dataList[]=[
                'admin_id' => $data['admin_id'],
                'role_id' => $v,
             ];
        }

        //删除用户的admin_id和role_id
        if (M('AdminRole')->where(['admin_id' =>$data['admin_id']])->delete() ===false) {
            $this ->rollback();
            return false;
        }
        //保存用户的admin_id和role_id
        if (M('AdminRole')->addAll($dataList) === false) {
            $this->rollback();
            $this->error='保存失败';
            return false;
        }

        //修改成功
        $this ->commit();
        return true;

    }
}