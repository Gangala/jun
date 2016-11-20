<?php
return array(
	//'配置项'=>'配置值'
    'URL_MODEL'=>2,
    //网站路径
    'ROOT_PATH' => 'http://admin.shop.com',
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'php0813_shop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'admin',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'shop_',    // 数据库表前缀
    'DB_PARAMS'          	=>  array(), // 数据库连接参数
    'DB_DEBUG'  			=>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8

    //设置样式路径
    'TMPL_PARSE_STRING' => [
        '__CSS__' => ROOT_PATH.'Public/css',
        '__JS__'  => ROOT_PATH.'Public/js',
        '__IMG__' => ROOT_PATH.'Public/images',
        '__LAYER__' => ROOT_PATH.'Public/ext/layer',
        '__ZTREE__' => ROOT_PATH.'Public/ext/ztree',
        '__VALIDATION__' => ROOT_PATH.'Public/ext/validation',
    ],

    //开启调试模式
    'SHOW_PAGE_TRACE' =>true,
);