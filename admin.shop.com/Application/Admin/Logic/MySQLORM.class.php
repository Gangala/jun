<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/8
 * Time: 20:30
 */

namespace Admin\Logic;


class MySQLORM implements Orm
{
    public function connect()
    {


//        dump($data);exit;
        echo '<pre>';
        echo __METHOD__ . '<br />';
        var_dump(func_get_args());
        echo '<hr />';
    }

    public function disconnect()
    {
        echo '<pre>';
        echo __METHOD__ . '<br />';
        var_dump(func_get_args());
        echo '<hr />';
    }

    public function free($result)
    {
        echo '<pre>';
        echo __METHOD__ . '<br />';
        var_dump(func_get_args());
        echo '<hr />';
    }

    /**
     * 修改操作
     * @param string $sql
     * @param array $args
     * @return false|int
     */
    public function query($sql, array $args = array())
    {
        //获取所以数据
        $data = func_get_args();
        //获取SQL语句
        $sql = $this -> _mkSql($data);
        //执行语句
        return M()->execute($sql);

    }

    public function insert($sql, array $args = array())
    {
        //获取所以数据
        $table = func_get_arg(1);
        $data = func_get_arg(2);
        $data['id']='null';

       //执行
        return M()->table($table)->add($data);
    }

    public function update($sql, array $args = array())
    {
        echo '<pre>';
        echo __METHOD__ . '<br />';
        var_dump(func_get_args());
        echo '<hr />';
    }

    public function getAll($sql, array $args = array())
    {
        echo '<pre>';
        echo __METHOD__ . '<br />';
        var_dump(func_get_args());
        echo '<hr />';
    }

    public function getAssoc($sql, array $args = array())
    {
        echo '<pre>';
        echo __METHOD__ . '<br />';
        var_dump(func_get_args());
        echo '<hr />';
    }

    public function getRow($sql, array $args = array())
    {
        $data = func_get_args();
        $sql = $this ->_mkSql($data);
        //返回结果
        return array_pop(M()->query($sql));
}

    public function getCol($sql, array $args = array())
    {
        echo '<pre>';
        echo __METHOD__ . '<br />';
        var_dump(func_get_args());
        echo '<hr />';
    }

    /**
     * 获取第一行的第一列
     * @param string $sql
     * @param array $args
     * @return mixed
     */
    public function getOne($sql, array $args = array())
    {

        //接收数据
        $data = func_get_args();
        //获取sql语句
        $sql = $this-> _mkSql($data);
        //执行语句
        $re = M()->query($sql);
        //获取第一行
        $row = array_pop($re);
        //获取第一行的第一列
        $file = array_pop($row);
        //返回第一行第一列
        return $file;
    }


    /**
     * 组装SQL语句
     * @param array $args
     * @return mixed|string
     */
    private function _mkSql(array $args){
        //获取字符串
        $sql = array_shift($args);
        //将字符串切割成数组
        $sqls = preg_split('/\?[FNT]/',$sql);
        //删除多余的元素
        array_pop($sqls);
        $sql = '';
        //遍历数组 拼接字符串
        foreach($args as $k =>$v){
            $sql .= $sqls[$k].$v;
        }
        return $sql;
    }

}