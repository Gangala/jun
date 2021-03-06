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
    <span class="action-span"><a href="<?php echo U('add');?>">添加新商品</a></span>
    <span class="action-span1"><a href="<?php echo U();?>">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品列表 </span>
    <div style="clear:both"></div>
</h1>
<div class="form-div">
    <form action="<?php echo U();?>" method="get">
        <input type="text" name="searce" size="15" value="<?php echo I('get.searce');?>"/>
        <input type="submit" value=" 搜索 " class="button" />
    </form>
</div>

<!-- 商品列表 -->
<div class="list-div" id="listDiv">
    <table cellpadding="3" cellspacing="1">
        <tr>
            <th>品牌名称</th>
            <th>品牌描述</th>
            <th>排序</th>
            <th>是否显示</th>
            <th>操作</th>
        </tr>
        <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><tr>
            <td align="center"><?php echo ($row["name"]); ?></td>
            <td align="center"><?php echo ($row["intro"]); ?></td>
            <td align="center"><?php echo ($row["sort"]); ?></td>
            <td align="center"><img src="http://admin.shop.com/Public/images/<?php echo ($row["status"]); ?>.gif" /></td>
            <td align="center">
                <a href="<?php echo U('edit',['id'=>$row['id']]);?>">编辑</a>  |
                <a href="<?php echo U('remove',['id'=>$row['id']]);?>">移除</a>
            </td>
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

<div id="footer">
共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>