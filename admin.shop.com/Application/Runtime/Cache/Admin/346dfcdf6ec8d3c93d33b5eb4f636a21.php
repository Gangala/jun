<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 添加新商品 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.com/Public/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.com/Public/css/main.css" rel="stylesheet" type="text/css" />

    <!--ueditor-->
    <script type="text/javascript" charset="utf-8" src="http://admin.shop.com/Public/ext/uediter/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="http://admin.shop.com/Public/ext/uediter/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="http://admin.shop.com/Public/ext/uediter/lang/zh-cn/zh-cn.js"></script>
    <!--文件上传-->
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
            <table width="90%" id="general-table" align="center">
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="name" value="<?php echo ($goods_info["name"]); ?>" size="30" />
                    <span class="require-field">*</span></td>
                </tr>

                <tr>
                    <td class="label">商品分类：</td>
                    <td>
                        <select name="goods_category_id">
                            <option value="0">请选择...</option>
                            <?php if(is_array($goods_category_rows)): foreach($goods_category_rows as $key=>$goods_category_rows): ?><option value="<?php echo ($goods_category_rows["id"]); ?>"><?php echo str_repeat('&nbsp;',($goods_category_rows['level']-1)*3); echo ($goods_category_rows["name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品品牌：</td>
                    <td>
                        <select name="brand_id">
                            <option value="0">请选择...</option>
                            <?php if(is_array($brand_rows)): foreach($brand_rows as $key=>$brand_rows): ?><option value="<?php echo ($brand_rows["id"]); ?>"><?php echo ($brand_rows["name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="label">商品logo：</td>
                    <td>
                        <input type="file" name="logo" id="logo" size="35" />
                        <input type="hidden" name='logo' value="<?php echo ($row["logo"]); ?>" id='logo-url'/>
                        <span id="logo_view">
                            <img src='<?php echo ($row["logo"]); ?>' id='logo-preview' style='max-width: 80px;max-height: 60px;margin-top:10px'/>
                        </span>
                    </td>
                </tr>

                <tr>
                    <td class="label">市场售价：</td>
                    <td>
                        <input type="text" name="market_price" value="<?php echo ($goods_info["market_price"]); ?>" size="20" />
                    </td>
                </tr>

                <tr>
                    <td class="label">本店售价：</td>
                    <td>
                        <input type="text" name="shop_price" value="<?php echo ($goods_info["shop_price"]); ?>" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品库存：</td>
                    <td>
                        <input type="text" name="stock" size="8" value="<?php echo ($goods_info["stock"]); ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">是否上架：</td>
                    <td>
                        <input type="radio" name="is_on_sale" class="is_on_sale" value="1" checked="checked"/> 是
                        <input type="radio" name="is_on_sale" class="is_on_sale" value="0"/> 否
                    </td>
                </tr>
                <tr>
                    <td class="label">加入推荐：</td>
                    <td>
                        <input type="checkbox" name="goods_status[]" value="1" /> 精品
                        <input type="checkbox" name="goods_status[]" value="2" /> 新品
                        <input type="checkbox" name="goods_status[]" value="4" /> 热销
                    </td>
                </tr>
                <tr>
                    <td class="label">推荐排序：</td>
                    <td>
                        <input type="text" name="sort" size="5" value="<?php echo ($goods_info["sort"]); ?>"/>
                    </td>
                </tr>

                <tr>
                    <td class="label">商品图片：</td>
                    <td>
                        <input type="file"  id="picture" size="35" />
                        <span id="goods_pic"></span>
                    </td>
                </tr>

                <tr>
                    <td class="label">商品详情：</td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td class="label"></td>
                    <td>
                        <script id="container" name="content" type="text/plain"></script>
                    </td>
                </tr>
            </table>
            <div class="button-div">
                <input type="submit" value=" 确定 " class="button"/>
                <input type="reset" value=" 重置 " class="button" />
            </div>
        </form>
    </div>
</div>

<div id="footer">
共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

<!--富文本编辑器-->
<script type="text/javascript">
    var ue = UE.getEditor('container',{initialFrameHeight:100,initialFrameWidth:700});
</script>
<!--文件上传-->
<script>
    $(function(){
        //绑定商品分类
        $('#goods_category_id option').val(<?php echo ($goods_info["goods_category_id"]); ?>);
        $('#brand_id option').val(<?php echo ($goods_info["brand_id"]); ?>);
        $('.is_on_sale').val(<?php echo ($goods_info["is_on_sale"]); ?>);
        $('#container').val(<?php echo ($goods_detail_info["content"]); ?>);
        //绑定商品品牌
        //上传logo
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

        //上传商品图片
        $('#picture').uploadify({
            swf:'http://admin.shop.com/Public/ext/uploadify/uploadify.swf',
            uploader:"<?php echo U('Upload/upload');?>",
            buttonText:'选择商品图片',
            fileTypeDesc:'选择商品图片',
            onUploadSuccess:function(file,data){
                //将数组转换成Json
                data = $.parseJSON(data);

                if(data.status == false){
                    layer.msg(data.msg,{icon:5});
                }else{
                    layer.msg(data.msg,{icon:6});
                    //构建图片标签
                    var html = '<img src="'+data.url+'" width="80" hight="60"/>';
                    html +='<input type="hidden" name="path[]" value="'+data.url+'" />';
                    $('#goods_pic').append(html)
                }
            },
        });
    })
</script>
</body>
</html>