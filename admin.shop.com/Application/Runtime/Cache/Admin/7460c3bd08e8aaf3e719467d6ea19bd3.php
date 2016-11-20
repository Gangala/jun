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
    <span class="action-span1"><a href="<?php echo U('index');?>">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品列表 </span>
    <div style="clear:both"></div>
</h1>
<div class="form-div">
    <form action="<?php echo U('index');?>" name="searchForm" >
        <img src="http://admin.shop.com/Public/images/icon_search.gif" width="26" height="22" border="0" alt="search" />
        <!-- 分类 -->
        <select name="goods_category_id">
            <option value="0">所有分类</option>
            <?php if(is_array($goods_category_data)): foreach($goods_category_data as $key=>$goods_category_rows): ?><option value="<?php echo ($goods_category_rows["id"]); ?>"><?php echo ($goods_category_rows["name"]); ?></option><?php endforeach; endif; ?>
        </select>
        <!-- 品牌 -->
        <select name="brand_id">
            <option value="">所有品牌</option>
            <?php if(is_array($brand_rows)): foreach($brand_rows as $key=>$brand_rows): ?><option value="<?php echo ($brand_rows["id"]); ?>"><?php echo str_repeat('&nbsp;',($brand_rows['level']-1)*2); echo ($brand_rows["name"]); ?></option><?php endforeach; endif; ?>
        </select>
        <!-- 推荐 -->
        <select name="goods_status">
            <option value="">全部</option>
            <option value="1">精品</option>
            <option value="2">新品</option>
            <option value="4">热销</option>
        </select>
        <!-- 上架 -->
        <select name="is_on_sale">
            <option value=''>全部</option>
            <option value="1">上架</option>
            <option value="0">下架</option>
        </select>
        <!-- 关键字 -->
        关键字 <input type="text" name="keyword" size="15" />
        <input type="submit" value=" 搜索 " class="button" />
    </form>
</div>

<!-- 商品列表 -->
<form method="post" action="" name="listForm" onsubmit="">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>编号</th>
                <th>商品名称</th>
                <th>商品分类</th>
                <th>货号</th>
                <th>价格</th>
                <th>上架</th>
                <th>精品</th>
                <th>新品</th>
                <th>热销</th>
                <th>推荐排序</th>
                <th>库存</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($rows)): foreach($rows as $key=>$rows): ?><tr>
                <td align="center"><?php echo ($rows["id"]); ?></td>
                <td align="center" class="first-cell"><span><?php echo ($rows["name"]); ?></span></td>
                <td align="center"><?php echo ($goods_category_data[$rows[goods_category_id]][name]); ?></td>
                <td align="center"><?php echo ($rows["sn"]); ?></td>
                <td align="center"><?php echo ($rows["shop_price"]); ?></td>
                <td align="center"><img src="http://admin.shop.com/Public/images/<?php echo ($rows["is_on_sale"]); ?>.gif"/></td>
                <td align="center"><img src="http://admin.shop.com/Public/images/<?php echo ($rows["is_best"]); ?>.gif"/></td>
                <td align="center"><img src="http://admin.shop.com/Public/images/<?php echo ($rows["is_new"]); ?>.gif"/></td>
                <td align="center"><img src="http://admin.shop.com/Public/images/<?php echo ($rows["is_hot"]); ?>.gif"/></td>
                <td align="center"><span>100</span></td>
                <td align="center"><span><?php echo ($rows["stock"]); ?></span></td>
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