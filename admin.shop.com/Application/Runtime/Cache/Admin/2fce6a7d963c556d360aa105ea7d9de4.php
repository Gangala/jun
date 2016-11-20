<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 添加新商品 </title>
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
            <input type="hidden" name="id" value="<?php echo ($row["id"]); ?>">
            <table width="90%" id="general-table" align="center">
                <tr>
                    <td class="label">品牌名称：</td>
                    <td><input type="text" name="name" value="<?php echo ($row["name"]); ?>" size="30" />
                        <span class="require-field">*</span></td>
                </tr>

                <tr>
                    <td class="label">品牌介绍： </td>
                    <td>
                        <input type="text" name="intro" value="<?php echo ($row["intro"]); ?>" size="30"/>
                        <span id="goods_sn_notice"></span><br />
                    </td>
                </tr>

                <tr>
                    <td class="label">品牌LOGO</td>
                    <td>
                        <input type="file" id="logo" size="45"/>
                        <input type="hidden" name='logo' value="<?php echo ($row["logo"]); ?>" id='logo-url'/>
                        <img src='<?php echo ($row["logo"]); ?>' id='logo-preview' style='max-width: 80px;max-height: 60px;margin-top:10px'/>
                    </td>
                </tr>

                <tr>
                    <td class="label">品牌排序：</td>
                    <td><input type="text" name="sort" value="<?php echo ($row["sort"]); ?>" size="30" /><span class="require-field">*</span></td>
                </tr>

                <tr>
                    <td class="label">是否上架：</td>
                    <td>
                        <!--<?php if($row["status"] ==1): ?>-->
                                <!--<input type="radio" name="status" value="1" checked /> 是-->
                                <!--<input type="radio" name="status" value="0"  /> 否-->
                            <!--<?php else: ?>-->
                                <!--<input type="radio" name="status" value="1"  /> 是-->
                                <!--<input type="radio" name="status" value="0" checked /> 否-->
                        <!--<?php endif; ?>-->

                        <input type="radio" name="status" value="1" class="status"/> 是
                        <input type="radio" name="status" value="0" class="status" /> 否

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
        $('form input[name="status"]').val(<?php echo ((isset($row["status"]) && ($row["status"] !== ""))?($row["status"]):1); ?>);
        $('#logo').uploadify({
            swf:'http://admin.shop.com/Public/ext/uploadify/uploadify.swf',
            uploader:"<?php echo U('Upload/upload');?>",
            buttonText:'选择文件',
            fileTypeDesc:'选择文件',
            onUploadSuccess:function(file,data){
                //将数组转换成Json
                data = $.parseJSON(data);
                if(data.status == false){
                    layer.msg(data.msg,{icon:5});
                }else{
                    layer.msg(data.msg,{icon:6});
                    $('#logo-url').val(data.url);
                    $('#logo-preview').attr('src',data.url);
                }
            },
        });
    });
</script>
</body>
</html>