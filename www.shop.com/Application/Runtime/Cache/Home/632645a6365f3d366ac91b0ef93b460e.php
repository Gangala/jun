<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" href="http://www.shop.com/Public/css/base.css" type="text/css"/>
    <link rel="stylesheet" href="http://www.shop.com/Public/css/global.css" type="text/css"/>
    <link rel="stylesheet" href="http://www.shop.com/Public/css/header.css" type="text/css"/>

    <link rel="stylesheet" href="http://www.shop.com/Public/css/footer.css" type="text/css"/>
    
    <link rel="stylesheet" href="http://www.shop.com/Public/css/cart.css" type="text/css">


    <script type="text/javascript" src="http://www.shop.com/Public/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="http://www.shop.com/Public/js/cart1.js"></script>

</head>
<body>
<!-- 顶部导航 start -->
<div class="topnav">
    <div class="topnav_bd w990 bc">
        <div class="topnav_left">

        </div>
        <div class="topnav_right fr">
            <ul>
                <li>您好，欢迎来到京西！[<a href="<?php echo U('Member/login');?>">登录</a>] [<a href="<?php echo U('Member/reg');?>">免费注册</a>] </li>
                <li class="line">|</li>
                <li>我的订单</li>
                <li class="line">|</li>
                <li>客户服务</li>

            </ul>
        </div>
    </div>
</div>
<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<div style="clear:both;"></div>

    <!-- 页面头部 start -->
    <div class="header w990 bc mt15">
        <div class="logo w990">
            <h2 class="fl"><a href="<?php echo U('Index/index');?>"><img src="http://www.shop.com/Public/images/logo1.png" alt="京西商城"></a></h2>
            <div class="flow fr">
                <ul>
                    <li class="cur">1.我的购物车</li>
                    <li>2.填写核对订单信息</li>
                    <li>3.成功提交订单</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- 页面头部 end -->
	<!-- 主体部分 start -->
	<div class="mycart w990 mt10 bc">
		<h2><span>我的购物车</span></h2>
		<table>
			<thead>
				<tr>
					<th class="col1">商品名称</th>
					<th class="col3">单价</th>
					<th class="col4">数量</th>	
					<th class="col5">小计</th>
					<th class="col6">操作</th>
				</tr>
			</thead>
			<tbody>
                <?php if(is_array($goods_detail)): foreach($goods_detail as $key=>$goods_detail): ?><tr>
                        <td class="col1"><a href="<?php echo U('Goods/index',['id'=>$goods_detail['id']]);?>"><img src="<?php echo ($goods_detail["logo"]); ?>" alt="" /></a>  <strong><a href="<?php echo U('Goods/index',['id'=>$goods_detail['id']]);?>"><?php echo ($goods_detail["name"]); ?></a></strong></td>
                        <td class="col3">￥<span><?php echo ($goods_detail["shop_price"]); ?></span></td>
                        <td class="col4">
                            <a href="javascript:;" class="reduce_num" id="reduce_num"></a>
                            <input type="text" name="amount" value="<?php echo ($goods_detail["amount"]); ?>" class="amount"/>
                            <a href="javascript:;" class="add_num" id="add_num"></a>
                        </td>
                        <td class="col5">￥<span><?php echo ($goods_detail["sub_total"]); ?></span></td>
                        <td class="col6"><a href="">删除</a></td>
                    </tr><?php endforeach; endif; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="6">购物金额总计： <strong>￥ <span id="total"><?php echo ($total_price); ?></span></strong></td>
				</tr>
			</tfoot>
		</table>
		<div class="cart_btn w990 bc mt10">
			<a href="<?php echo U('Index/index');?>" class="continue">继续购物</a>
			<a href="<?php echo U('flow2');?>" class="checkout">结 算</a>
		</div>
	</div>
	<!-- 主体部分 end -->





<div style="clear:both;"></div>
<!-- 底部版权 start -->
<div class="footer w1210 bc mt15">
    <p class="links">
        <a href="">关于我们</a> |
        <a href="">联系我们</a> |
        <a href="">人才招聘</a> |
        <a href="">商家入驻</a> |
        <a href="">千寻网</a> |
        <a href="">奢侈品网</a> |
        <a href="">广告服务</a> |
        <a href="">移动终端</a> |
        <a href="">友情链接</a> |
        <a href="">销售联盟</a> |
        <a href="">京西论坛</a>
    </p>
    <p class="copyright">
        © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号
    </p>
    <p class="auth">
        <a href=""><img src="http://www.shop.com/Public/images/xin.png" alt="" /></a>
        <a href=""><img src="http://www.shop.com/Public/images/kexin.jpg" alt="" /></a>
        <a href=""><img src="http://www.shop.com/Public/images/police.jpg" alt="" /></a>
        <a href=""><img src="http://www.shop.com/Public/images/beian.gif" alt="" /></a>
    </p>
</div>
<!-- 底部版权 end -->

    <script>
        $('#reduce_num').click(function(){
        })
    </script>

</body>
</html>