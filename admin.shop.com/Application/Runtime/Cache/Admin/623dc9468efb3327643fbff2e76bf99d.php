<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 添加分类 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://admin.shop.com/Public/css/general.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.shop.com/Public/css/main.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.shop.com/Public/ext/uploadify/common.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://admin.shop.com/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/ext/uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/ext/layer/layer.js"></script>
    <link rel="stylesheet" href="http://admin.shop.com/Public/ext/ztree/css/zTreeStyle/zTreeStyle.css" type="text/css">
    <script type="text/javascript" src="http://admin.shop.com/Public/ext/ztree/js/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/ext/ztree/js/jquery.ztree.core.js"></script>

</head>
<style>
    ul.ztree {
        margin-top: 10px;
        border: 1px solid #617775;
        background: #f0f6e4;
        width: 220px;
        overflow-y: scroll;
        overflow-x: auto;
    }
</style>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>">商品列表</a>
    </span>
    <span class="action-span1"><a href="<?php echo U('index');?>">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加新商品 </span>
    <div style="clear:both"></div>
</h1>

<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="general-tab">通用信息</span>
        </p>
    </div>

    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="<?php echo U();?>" method="post">
            <input type="hidden" name="id" value="<?php echo ($goods_row["id"]); ?>">
            <table width="90%" id="general-table" align="center">
                <tr>
                    <td class="label">分类名称：</td>
                    <td><input type="text" name="name" value="<?php echo ($goods_row["name"]); ?>" size="30" />
                        <span class="require-field">*</span></td>
                </tr>

                <tr>
                    <td class="label">上级分类：</td>
                    <td>
                        <input type="hidden" name="parent_id" id="parent_id" value="">
                        <ul id="parent_node" class="ztree" ></ul>
                    </td>
                </tr>

                <tr>
                    <td class="label">分类描述：</td>
                    <td>
                        <textarea name="intro" cols="30" rows="5"><?php echo ($goods_row["intro"]); ?></textarea>
                    </td>
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
        $('#parent_id').val(<?php echo ($goods_row["parent_id"]); ?>);
    });

    var setting = {
        data: {
            simpleData: {
                pIdKey: "parent_id",
                enable: true
            }
        },
        view:{
            showIcon:false,
            showLine:false
        },
        callback:{
            onClick:function(event,ele_id,node){
                console.log(node.id);
                $('#parent_id').val(node.id);
            },
        },
    };
    var zNodes =<?php echo ($categories); ?>;
    $(document).ready(function(){
        var zTree_obj = $.fn.zTree.init($("#parent_node"), setting, zNodes);
        //设置列表展开
        zTree_obj.expandAll(true);

        <?php if(isset($goods_row)): ?>//找到节点
            var parent_node =zTree_obj.getNodeByParam('id',<?php echo ($goods_row["parent_id"]); ?>);
            //选中父级节点
            zTree_obj.selectNode(parent_node);<?php endif; ?>
    });
</script>
</body>
</html>