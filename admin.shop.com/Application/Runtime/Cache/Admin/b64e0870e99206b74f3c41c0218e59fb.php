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
    <span class="action-span"><a href="<?php echo U('index');?>">取消编辑</a></span>
    <span class="action-span1"><a href="<?php echo U('index');?>">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 编辑信息 </span>
    <div style="clear:both"></div>
</h1>

<div>
    <form action="<?php echo U();?>" method="post">
        <table cellspacing="0" cellpadding="0" style="margin-top:100px" align="center">
            <tr>
                <td style="padding-left: 50px">
                    <table>
                        <input type="hidden" name="id" value="<?php echo I('get.id');?>">
                        <tr>
                            <td>用户名：</td>
                            <td>
                                <input type="text" name="username" value="<?php echo ($row["username"]); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>邮箱：</td>
                            <td>
                                <input type="text" name="email" value="<?php echo ($row["email"]); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>角色：</td>
                            <td>
                                <?php if(is_array($rows)): foreach($rows as $key=>$rows): ?><label><input type="checkbox" name="role_id[]" value="<?php echo ($rows["id"]); ?>" <?php if(in_array($rows['id'],$admin_role)): ?>checked="checked"<?php endif; ?>/><?php echo ($rows["name"]); ?></label><?php endforeach; endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                <input type="submit" value="提交修改" class="button" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
</div>


<div id="footer">
    共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>


</body>
</html>