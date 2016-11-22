<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/22
 * Time: 17:21
 */

namespace Home\Model;


use Think\Model;

class LocationsModel extends Model
{
    /**
     *  通过parent_id 获取相应的列表
     * @param int $parent_id
     * @return mixed
     */
    public function getCityMsg($parent_id = 0){
        return $this ->where(['parent_id'=>$parent_id])->select();
    }
}