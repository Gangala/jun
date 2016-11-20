<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - <?php echo ($metatitle); ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://admin.shop.com/Public/css/general.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.shop.com/Public/css/main.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.shop.com/Public/ext/uploadify/common.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://admin.shop.com/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/ext/uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/ext/layer/layer.js"></script>

</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>"><?php echo ($metaenmu); ?></a>
    </span>
    <span class="action-span1"><a href="<?php echo U('index');?>">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo ($metatitle); ?> </span>
    <div style="clear:both"></div>
</h1>

<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="general-tab">通用信息</span>
        </p>
    </div>

    <div id="tabbody-div">
        <form  action="<?php echo U();?>" method="post">
            <input type="hidden" name="id" value="<?php echo ($row["id"]); ?>">
            <table width="90%" id="general-table" align="center">
                <tr>
                    <td class="label">分类名称：</td>
                    <td><input type="text" name="name" value="<?php echo ($row["name"]); ?>" size="30" />
                        <span class="require-field">*</span></td>
                </tr>

                <tr>
                    <td class="label">分类介绍： </td>
                    <td>
                        <input type="text" name="intro" value="<?php echo ($row["intro"]); ?>" size="30"/>
                        <span id="goods_sn_notice"></span><br />
                    </td>
                </tr>

                <tr>
                    <td class="label">分类排序：</td>
                    <td><input type="text" name="sort" value="<?php echo ($row["sort"]); ?>" size="30" /><span class="require-field">*</span></td>
                </tr>

                <tr>
                    <td class="label">是否上线：</td>

                    <td>
                        <input type="radio" name="status" value="1" class="status" checked/> 是
                        <input type="radio" name="status" value="0" class="status" /> 否
                    </td>
                </tr>

                <tr>
                    <td class="label">是否是帮助类：</td>
                    <td>
                        <input type="radio" name="is_help" value="1" class="status"/> 是
                        <input type="radio" name="is_help" value="0" class="status" checked/> 否

                </tr>
                <tr>
                    <td class="label"></td>
                    <td>
                       <input type="submit" value=" 立即添加 " class="button"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<div id="footer">
    共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
</div>
<script>
    $(function(){
        $('form input[name="status"]').val([<?php echo ((isset($row["status"]) && ($row["status"] !== ""))?($row["status"]):1); ?>]);
        $('form input[name="is_help"]').val([<?php echo ((isset($row["is_help"]) && ($row["is_help"] !== ""))?($row["is_help"]):0); ?>]);

    });
</script>
</body>
</html>