<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/22
 * Time: 15:32
 */

namespace Home\Model;


use Think\Model;

class AddressModel extends Model
{
    //获取用户的收货地址列表
    public function getList(){
        return $this->order('is_default desc')->select();
    }

    //保存用户新添加的收货地址
    public function save_address($data){
        //判断is_default的值,如果存在 则将数据库中的默认值改为0
        if(isset($data['is_default'])){
            $this->where(['member_id'=>$data['member_id']])->setField('is_default',0);
            $data['is_default'] =1;
        }
        //将数据保存到数据库
        return $this->add($data);
    }

    //通过id获取一条收货地址
    public function get_this_address($id){
        return $this->find($id);
    }

    /**
     *      保存用户编辑的收货地址
     * @param $data
     */
    public function saveEdit($data){
        //修改默认地址
        if(isset($data['is_default'])){
            $data['is_default']=1;
            //将该用户的默认地址取消掉
            $this ->where(['member_id'=>$data['member_id'],'is_default'=>1])->setField('is_default',0);
        }

        //保存用户修改后的信息
        return $this ->save($data);

    }
}