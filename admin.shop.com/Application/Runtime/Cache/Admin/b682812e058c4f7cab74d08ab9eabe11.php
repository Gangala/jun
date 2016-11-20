<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 商品列表 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://admin.shop.com/Public/css/general.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.shop.com/Public/css/main.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.shop.com/Public/css/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('Admin/out_login');?>">注销</a></span>
    <span class="action-span"><a href="<?php echo U('reg');?>">添加管理员</a></span>
    <span class="action-span1"><a href="<?php echo U('index');?>">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 管理员列表 </span>
    <div style="clear:both"></div>
</h1>
<div class="form-div">
    <form action="<?php echo U('index');?>" name="searchForm" >
        <img src="http://admin.shop.com/Public/images/icon_search.gif" width="26" height="22" border="0" alt="search" />
        <!-- 关键字 -->
        关键字 <input type="text" name="keyword" size="15" value="<?php echo I('get.keyword');?>"/>
        <input type="submit" value=" 搜索 " class="button" />
    </form>
</div>

<!-- 商品列表 -->
<form method="post" action="" name="listForm" onsubmit="">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>用户名</th>
                <th>邮箱</th>
                <th>添加时间</th>
                <th>最后登录时间</th>
                <th>最后登录ip</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($rows)): foreach($rows as $key=>$rows): ?><tr>
                    <td align="center"><?php echo ($rows["username"]); ?></td>
                    <td align="center" class="first-cell"><?php echo ($rows["email"]); ?></td>
                    <td align="center"><?php echo ($rows["add_time"]); ?></td>
                    <td align="center"><?php echo ($rows["last_login_time"]); ?></td>
                    <td align="center"><?php echo ($rows["last_login_ip"]); ?></td>
                    <td align="center">
                        <a href="<?php echo U('edit',['id'=>$rows['id']]);?>" > 编辑 </a> |
                        <a href="<?php echo U('remove',['id'=>$rows['id']]);?>" > 移除 </a></td>
                </tr><?php endforeach; endif; ?>
        </table>

        <!-- 分页开始 -->
        <table id="page-table" cellspacing="0">
            <tr>
                <td align="right" nowrap="true" colspan="6">
                    <div id="turn-page" class='page'>
                        <?php echo ($page_html); ?>
                    </div>
                </td>
            </tr>
        </table>
        <!-- 分页结束 -->
    </div>
</form>

<div id="footer">
    共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

<script>
    $(function(){

    })
</script>
</body>
</html>