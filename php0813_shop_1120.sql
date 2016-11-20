/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1_3306
Source Server Version : 50524
Source Host           : 127.0.0.1:3306
Source Database       : php0813_shop

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2016-11-20 10:19:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for shop_admin
-- ----------------------------
DROP TABLE IF EXISTS `shop_admin`;
CREATE TABLE `shop_admin` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '�û���',
  `password` char(32) NOT NULL COMMENT '����',
  `salt` char(6) NOT NULL COMMENT '��',
  `email` varchar(30) NOT NULL COMMENT '����',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT 'ע��ʱ��',
  `last_login_time` int(11) NOT NULL DEFAULT '0',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '����¼IP',
  `token` char(32) NOT NULL COMMENT '�Զ���¼����',
  `token_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '���ƴ���ʱ��',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_admin
-- ----------------------------
INSERT INTO `shop_admin` VALUES ('3', 'zhanshan', 'c2dcb604a78221b0a098eec6c24cd78b', 'DlG2', 'zhangsan@qq.com', '1479092720', '1479309678', '2130706433', '9QcX', '1479309678');
INSERT INTO `shop_admin` VALUES ('4', 'admin', '191af74935a49c6ecb9725e9b1b18206', 'fXIi', 'admin@qq.com', '1479098959', '1479553310', '2130706433', 'AxFh', '1479553310');
INSERT INTO `shop_admin` VALUES ('7', '王五', '6902e130654ea178567cd8e12c28ba9c', 'bi0J', 'wangwu@qq.com', '1479141662', '1479141662', '2130706433', '', '0');
INSERT INTO `shop_admin` VALUES ('8', '666666', '8fd0f5ccb0f8407bd7ed90c50d68d05e', 'jEdC', '111111@qq.com', '1479205548', '1479209376', '2130706433', '4Ns2', '1479209376');

-- ----------------------------
-- Table structure for shop_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `shop_admin_role`;
CREATE TABLE `shop_admin_role` (
  `admin_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '����ԱID',
  `role_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '��ɫID',
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_admin_role
-- ----------------------------
INSERT INTO `shop_admin_role` VALUES ('7', '21');
INSERT INTO `shop_admin_role` VALUES ('8', '21');
INSERT INTO `shop_admin_role` VALUES ('4', '21');
INSERT INTO `shop_admin_role` VALUES ('3', '21');

-- ----------------------------
-- Table structure for shop_article
-- ----------------------------
DROP TABLE IF EXISTS `shop_article`;
CREATE TABLE `shop_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '����',
  `article_category_id` tinyint(3) unsigned NOT NULL COMMENT '���·���',
  `intro` text COMMENT '���@textarea',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '״̬@radio|1=��&0=��',
  `sort` tinyint(4) NOT NULL DEFAULT '20' COMMENT '����',
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '¼��ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_article
-- ----------------------------
INSERT INTO `shop_article` VALUES ('1', '购物流程', '1', '购物流程', '1', '20', '0');
INSERT INTO `shop_article` VALUES ('2', '会员介绍', '1', '会员介绍', '1', '21', '0');
INSERT INTO `shop_article` VALUES ('3', '团购/机票/充值/点卡', '1', '团购/机票/充值/点卡', '1', '22', '0');
INSERT INTO `shop_article` VALUES ('4', '常见问题', '1', '常见问题', '1', '23', '0');
INSERT INTO `shop_article` VALUES ('5', '大家电', '1', '大家电', '1', '24', '0');
INSERT INTO `shop_article` VALUES ('6', '联系客服', '1', '联系客服', '1', '25', '0');
INSERT INTO `shop_article` VALUES ('7', '上门自提', '2', '上门自提', '1', '20', '0');
INSERT INTO `shop_article` VALUES ('8', '快速运输', '2', '快速运输', '1', '21', '0');
INSERT INTO `shop_article` VALUES ('9', '特快专递（EMS）', '2', '特快专递（EMS）', '1', '22', '0');
INSERT INTO `shop_article` VALUES ('10', '如何送礼', '2', '如何送礼', '1', '22', '0');
INSERT INTO `shop_article` VALUES ('11', '海外购物', '2', '海外购物', '1', '25', '0');
INSERT INTO `shop_article` VALUES ('12', '货到付款', '3', '货到付款', '1', '20', '0');
INSERT INTO `shop_article` VALUES ('13', '在线支付', '3', '在线支付', '1', '11', '0');
INSERT INTO `shop_article` VALUES ('14', '分期付款', '3', '分期付款', '1', '12', '0');
INSERT INTO `shop_article` VALUES ('15', '邮局汇款', '3', '邮局汇款', '1', '13', '0');
INSERT INTO `shop_article` VALUES ('16', '公司转账', '3', '公司转账', '1', '14', '0');
INSERT INTO `shop_article` VALUES ('17', '退换货政策', '4', '退换货政策', '1', '11', '0');
INSERT INTO `shop_article` VALUES ('18', '退换货流程', '4', '退换货流程', '1', '12', '0');
INSERT INTO `shop_article` VALUES ('19', '价格保护', '4', '价格保护', '1', '14', '0');
INSERT INTO `shop_article` VALUES ('20', '退款说明', '4', '退款说明', '1', '15', '0');
INSERT INTO `shop_article` VALUES ('21', '返修/退换货', '4', '返修/退换货', '1', '16', '0');
INSERT INTO `shop_article` VALUES ('22', '退款申请', '4', '退款申请', '1', '17', '0');
INSERT INTO `shop_article` VALUES ('23', '夺宝岛', '5', '夺宝岛', '1', '11', '0');
INSERT INTO `shop_article` VALUES ('24', 'DIY装机', '5', 'DIY装机', '1', '13', '0');
INSERT INTO `shop_article` VALUES ('25', '延保服务', '5', '延保服务', '1', '14', '0');
INSERT INTO `shop_article` VALUES ('26', '家电下乡', '5', '家电下乡', '1', '16', '0');
INSERT INTO `shop_article` VALUES ('27', '京东礼品卡', '5', '京东礼品卡', '1', '17', '0');
INSERT INTO `shop_article` VALUES ('28', '能效补贴', '5', '能效补贴', '1', '19', '0');

-- ----------------------------
-- Table structure for shop_article_category
-- ----------------------------
DROP TABLE IF EXISTS `shop_article_category`;
CREATE TABLE `shop_article_category` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '分类名',
  `intro` text COMMENT '简介',
  `status` tinyint(4) NOT NULL COMMENT '状态״̬@radio|1是0不是',
  `sort` tinyint(4) NOT NULL COMMENT '����',
  `is_help` tinyint(4) NOT NULL COMMENT '�Ƿ��ǰ�����ط���',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_article_category
-- ----------------------------
INSERT INTO `shop_article_category` VALUES ('1', ' 购物指南', ' 购物指南', '1', '20', '1');
INSERT INTO `shop_article_category` VALUES ('2', '配送方式', '配送方式', '1', '21', '1');
INSERT INTO `shop_article_category` VALUES ('3', '支付方式', '支付方式', '1', '22', '1');
INSERT INTO `shop_article_category` VALUES ('4', '售后服务', '售后服务', '1', '23', '1');
INSERT INTO `shop_article_category` VALUES ('5', '特色服务', '特色服务', '1', '24', '1');

-- ----------------------------
-- Table structure for shop_article_detail
-- ----------------------------
DROP TABLE IF EXISTS `shop_article_detail`;
CREATE TABLE `shop_article_detail` (
  `article_id` int(10) unsigned NOT NULL,
  `content` text COMMENT '��������',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_article_detail
-- ----------------------------
INSERT INTO `shop_article_detail` VALUES ('1', '购物流程购物流程购物流程购物流程购物流程');
INSERT INTO `shop_article_detail` VALUES ('2', '会员介绍会员介绍会员介绍会员介绍');
INSERT INTO `shop_article_detail` VALUES ('3', '团购/机票/充值/点卡团购/机票/充值/点卡团购/机票/充值/点卡');
INSERT INTO `shop_article_detail` VALUES ('4', '常见问题常见问题常见问题常见问题常见问题常见问题');
INSERT INTO `shop_article_detail` VALUES ('5', '大家电大家电大家电大家电大家电大家电');
INSERT INTO `shop_article_detail` VALUES ('6', '联系客服联系客服联系客服联系客服');
INSERT INTO `shop_article_detail` VALUES ('7', '上门自提上门自提上门自提上门自提上门自提');
INSERT INTO `shop_article_detail` VALUES ('8', '快速运输快速运输快速运输快速运输');
INSERT INTO `shop_article_detail` VALUES ('9', '特快专递（EMS）特快专递（EMS）特快专递（EMS）特快专递（EMS）特快专递（EMS）');
INSERT INTO `shop_article_detail` VALUES ('10', '如何送礼如何送礼如何送礼如何送礼');
INSERT INTO `shop_article_detail` VALUES ('11', '海外购物海外购物海外购物海外购物海外购物');
INSERT INTO `shop_article_detail` VALUES ('12', '货到付款货到付款货到付款货到付款');
INSERT INTO `shop_article_detail` VALUES ('13', '在线支付在线支付在线支付在线支付在线支付');
INSERT INTO `shop_article_detail` VALUES ('14', '分期付款分期付款分期付款分期付款');
INSERT INTO `shop_article_detail` VALUES ('15', '邮局汇款邮局汇款邮局汇款邮局汇款');
INSERT INTO `shop_article_detail` VALUES ('16', '公司转账公司转账公司转账公司转账');
INSERT INTO `shop_article_detail` VALUES ('17', '退换货政策退换货政策退换货政策退换货政策退换货政策');
INSERT INTO `shop_article_detail` VALUES ('18', '退换货流程退换货流程退换货流程退换货流程退换货流程退换货流程');
INSERT INTO `shop_article_detail` VALUES ('19', '价格保护价格保护价格保护价格保护价格保护');
INSERT INTO `shop_article_detail` VALUES ('20', '退款说明退款说明退款说明退款说明退款说明');
INSERT INTO `shop_article_detail` VALUES ('21', '返修/退换货返修/退换货返修/退换货返修/退换货');
INSERT INTO `shop_article_detail` VALUES ('22', '退款申请退款申请退款申请退款申请退款申请');
INSERT INTO `shop_article_detail` VALUES ('23', '夺宝岛夺宝岛夺宝岛夺宝岛夺宝岛夺宝岛夺宝岛夺宝岛');
INSERT INTO `shop_article_detail` VALUES ('24', 'DIY装机DIY装机DIY装机DIY装机DIY装机DIY装机');
INSERT INTO `shop_article_detail` VALUES ('25', '延保服务延保服务延保服务延保服务延保服务');
INSERT INTO `shop_article_detail` VALUES ('26', '家电下乡家电下乡家电下乡家电下乡家电下乡家电下乡家电下乡');
INSERT INTO `shop_article_detail` VALUES ('27', '京东礼品卡京东礼品卡京东礼品卡京东礼品卡京东礼品卡京东礼品卡');
INSERT INTO `shop_article_detail` VALUES ('28', '能效补贴能效补贴能效补贴能效补贴能效补贴能效补贴');

-- ----------------------------
-- Table structure for shop_brand
-- ----------------------------
DROP TABLE IF EXISTS `shop_brand`;
CREATE TABLE `shop_brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT 'Ʒ������',
  `intro` varchar(255) NOT NULL DEFAULT '' COMMENT '���',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT 'Ʒ�Ʊ�ʶ',
  `sort` int(10) unsigned NOT NULL DEFAULT '20' COMMENT '��������ԽСԽ��ǰ',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1���� 0���� -1ɾ��',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_brand
-- ----------------------------
INSERT INTO `shop_brand` VALUES ('1', '惠普', '惠普', 'http://admin.shop.com/./Uploads/images/2016-11-19/5830376936d35.jpg', '1', '1');
INSERT INTO `shop_brand` VALUES ('2', '海尔', '海尔', 'http://admin.shop.com/./Uploads/images/2016-11-19/5830377e6a6b8.jpg', '2', '1');
INSERT INTO `shop_brand` VALUES ('3', '康佳', '康佳', 'http://admin.shop.com/./Uploads/images/2016-11-19/5830378e0e493.jpg', '3', '1');
INSERT INTO `shop_brand` VALUES ('4', '梨子', '梨子', 'http://admin.shop.com/./Uploads/images/2016-11-19/583037a48bff1.jpg', '4', '1');
INSERT INTO `shop_brand` VALUES ('5', '好声音', '好声音', 'http://admin.shop.com/./Uploads/images/2016-11-19/583037bcc3f18.jpg', '5', '1');
INSERT INTO `shop_brand` VALUES ('6', '索尼', '索尼', 'http://admin.shop.com/./Uploads/images/2016-11-19/583037d551751.jpg', '6', '1');
INSERT INTO `shop_brand` VALUES ('7', '华为', '华为', 'http://admin.shop.com/./Uploads/images/2016-11-19/583037e4ea8fb.jpg', '7', '1');
INSERT INTO `shop_brand` VALUES ('8', '卡姿兰', '卡姿兰', 'http://admin.shop.com/./Uploads/images/2016-11-19/583037fb30212.jpg', '8', '1');
INSERT INTO `shop_brand` VALUES ('9', '黄飞鸿', '黄飞鸿', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303810eb665.jpg', '9', '1');
INSERT INTO `shop_brand` VALUES ('10', '戴尔', '戴尔', 'http://admin.shop.com/./Uploads/images/2016-11-19/5830381fdfe9e.jpg', '9', '1');
INSERT INTO `shop_brand` VALUES ('11', 'DVD', '车载', 'http://admin.shop.com/./Uploads/images/2016-11-19/583038398c6d2.jpg', '10', '1');

-- ----------------------------
-- Table structure for shop_goods
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods`;
CREATE TABLE `shop_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '����',
  `sn` char(15) NOT NULL COMMENT '����',
  `logo` varchar(150) NOT NULL COMMENT '��Ʒlogo',
  `goods_category_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `brand_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Ʒ',
  `market_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '�г��۸�',
  `shop_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '����۸�',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '���',
  `goods_status` int(11) NOT NULL DEFAULT '0' COMMENT '��Ʒ��������:1��Ʒ2��Ʒ3����',
  `is_on_sale` tinyint(4) NOT NULL DEFAULT '1' COMMENT '�Ƿ��ϼ�',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '״̬@radio|1=��&0=��',
  `sort` tinyint(4) NOT NULL DEFAULT '20' COMMENT '����',
  `inputtime` int(11) NOT NULL DEFAULT '0' COMMENT '¼��ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_goods
-- ----------------------------
INSERT INTO `shop_goods` VALUES ('1', '惠普G4-1332TX', 'SN201611190000', 'http://admin.shop.com/./Uploads/images/2016-11-19/583038efc5bce.jpg', '3', '1', '3200.00', '2999.00', '10', '2', '1', '1', '1', '1479555356');
INSERT INTO `shop_goods` VALUES ('2', '海尔冰箱', 'SN201611190001', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303caa7d731.jpg', '74', '2', '1000.00', '800.00', '12', '2', '1', '1', '12', '1479556326');
INSERT INTO `shop_goods` VALUES ('3', '康佳液晶37寸电视', 'SN201611190001', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303d095d9a7.jpg', '72', '3', '3000.00', '2799.00', '12', '2', '1', '1', '13', '1479556388');
INSERT INTO `shop_goods` VALUES ('4', '梨子平板电脑7.9寸', 'SN201611190001', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303d52d4436.jpg', '22', '4', '2999.00', '1999.00', '14', '2', '1', '1', '14', '1479556469');
INSERT INTO `shop_goods` VALUES ('5', '好声音耳机', 'SN201611190001', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303da0ce09b.jpg', '15', '5', '299.00', '199.00', '12', '2', '1', '1', '15', '1479556549');
INSERT INTO `shop_goods` VALUES ('6', '索尼双核五英寸四核手机', 'SN201611190001', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303dfca7325.jpg', '3', '6', '1500.00', '1386.00', '10', '4', '1', '1', '12', '1479556640');
INSERT INTO `shop_goods` VALUES ('7', '华为通话平板', 'SN201611190001', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303e6754502.jpg', '3', '7', '1100.00', '969.00', '12', '4', '1', '1', '12', '1479556718');
INSERT INTO `shop_goods` VALUES ('8', '卡姿兰明星彩妆单品7件装', 'SN201611190001', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303e9b68ea4.jpg', '25', '8', '199.00', '169.00', '12', '4', '1', '1', '12', '1479556783');
INSERT INTO `shop_goods` VALUES ('9', '黄飞鸿麻辣花生整箱特惠装', 'SN201611190001', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303edb841bf.jpg', '12', '9', '150.00', '139.00', '4', '1', '1', '1', '33', '1479556848');
INSERT INTO `shop_goods` VALUES ('10', '戴尔IN1940MW 19英寸LED', 'SN201611190001', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303f163b3b6.jpg', '72', '10', '1000.00', '679.00', '4', '1', '1', '1', '33', '1479556910');
INSERT INTO `shop_goods` VALUES ('11', '逻辑思维车载音频', 'SN201611190001', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303f6fb1487.jpg', '1', '11', '40.00', '25.00', '13', '1', '1', '1', '127', '1479556996');

-- ----------------------------
-- Table structure for shop_goods_category
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods_category`;
CREATE TABLE `shop_goods_category` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `parent_id` tinyint(3) unsigned NOT NULL COMMENT '������',
  `lft` smallint(5) unsigned DEFAULT NULL,
  `rght` smallint(5) unsigned DEFAULT NULL,
  `level` tinyint(3) unsigned DEFAULT NULL,
  `intro` text COMMENT '���',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_goods_category
-- ----------------------------
INSERT INTO `shop_goods_category` VALUES ('1', '图像、影音、数字商品', '0', '1', '106', '1', '图像、影音、数字商品');
INSERT INTO `shop_goods_category` VALUES ('2', '家用电器', '0', '107', '170', '1', '');
INSERT INTO `shop_goods_category` VALUES ('3', '手机、数码', '0', '171', '172', '1', '手机、数码');
INSERT INTO `shop_goods_category` VALUES ('4', '电脑、办公', '0', '173', '174', '1', '电脑、办公');
INSERT INTO `shop_goods_category` VALUES ('5', '家居、家装、家具、厨具', '0', '175', '176', '1', '家居、家装、家具、厨具');
INSERT INTO `shop_goods_category` VALUES ('6', '服饰鞋帽', '0', '177', '178', '1', '服饰鞋帽');
INSERT INTO `shop_goods_category` VALUES ('7', '个护化妆', '0', '179', '180', '1', '个护化妆');
INSERT INTO `shop_goods_category` VALUES ('8', '礼品箱包、钟表、珠宝', '0', '181', '182', '1', '礼品箱包、钟表、珠宝');
INSERT INTO `shop_goods_category` VALUES ('9', '运动健康', '0', '183', '184', '1', '运动健康');
INSERT INTO `shop_goods_category` VALUES ('10', '汽车用品', '0', '185', '186', '1', '汽车用品');
INSERT INTO `shop_goods_category` VALUES ('11', '母婴、玩具乐器', '0', '187', '188', '1', '母婴、玩具乐器');
INSERT INTO `shop_goods_category` VALUES ('12', '食品饮料、保健食品', '0', '189', '190', '1', '食品饮料、保健食品');
INSERT INTO `shop_goods_category` VALUES ('13', '彩票、旅行、充值、票务', '0', '191', '192', '1', '彩票、旅行、充值、票务');
INSERT INTO `shop_goods_category` VALUES ('15', '数字音乐', '1', '2', '15', '2', '数字音乐');
INSERT INTO `shop_goods_category` VALUES ('16', '音像', '1', '16', '25', '2', '音像');
INSERT INTO `shop_goods_category` VALUES ('17', '文艺', '1', '26', '39', '2', '文艺');
INSERT INTO `shop_goods_category` VALUES ('18', '人文社科', '1', '40', '53', '2', '人文社科');
INSERT INTO `shop_goods_category` VALUES ('19', '经管励志', '1', '54', '63', '2', '经管励志');
INSERT INTO `shop_goods_category` VALUES ('20', '生活', '1', '64', '75', '2', '生活');
INSERT INTO `shop_goods_category` VALUES ('21', '科技', '1', '76', '89', '2', '科技');
INSERT INTO `shop_goods_category` VALUES ('22', '大家电', '2', '108', '123', '2', '大家电');
INSERT INTO `shop_goods_category` VALUES ('23', '生活电器', '2', '124', '133', '2', '生活电器');
INSERT INTO `shop_goods_category` VALUES ('24', '厨房电器', '2', '134', '147', '2', '厨房电器');
INSERT INTO `shop_goods_category` VALUES ('25', '个护健康', '2', '148', '157', '2', '个护健康');
INSERT INTO `shop_goods_category` VALUES ('26', '五金家装', '2', '158', '169', '2', '五金家装');
INSERT INTO `shop_goods_category` VALUES ('27', '电子书', '1', '90', '105', '2', '电子书');
INSERT INTO `shop_goods_category` VALUES ('28', '免费', '27', '91', '92', '3', '免费');
INSERT INTO `shop_goods_category` VALUES ('29', '小说', '27', '93', '94', '3', '小说');
INSERT INTO `shop_goods_category` VALUES ('30', '励志与成功', '27', '95', '96', '3', '励志与成功');
INSERT INTO `shop_goods_category` VALUES ('31', '婚恋/两性', '27', '97', '98', '3', '婚恋/两性');
INSERT INTO `shop_goods_category` VALUES ('32', '文学', '27', '99', '100', '3', '文学');
INSERT INTO `shop_goods_category` VALUES ('33', '经管', '27', '101', '102', '3', '经管');
INSERT INTO `shop_goods_category` VALUES ('34', '畅读ＶＩＰ', '27', '103', '104', '3', '畅读ＶＩＰ');
INSERT INTO `shop_goods_category` VALUES ('35', '通俗流行', '15', '3', '4', '3', '通俗流行');
INSERT INTO `shop_goods_category` VALUES ('36', '古典音乐', '15', '5', '6', '3', '古典音乐');
INSERT INTO `shop_goods_category` VALUES ('37', '摇滚说唱', '15', '7', '8', '3', '摇滚说唱');
INSERT INTO `shop_goods_category` VALUES ('38', '爵士蓝调', '15', '9', '10', '3', '爵士蓝调');
INSERT INTO `shop_goods_category` VALUES ('39', '乡村名谣', '15', '11', '12', '3', '乡村名谣');
INSERT INTO `shop_goods_category` VALUES ('40', '有声读物', '15', '13', '14', '3', '有声读物');
INSERT INTO `shop_goods_category` VALUES ('41', '音乐', '16', '17', '18', '3', '音乐');
INSERT INTO `shop_goods_category` VALUES ('42', '影视', '16', '19', '20', '3', '影视');
INSERT INTO `shop_goods_category` VALUES ('43', '教育影像', '16', '21', '22', '3', '教育影像');
INSERT INTO `shop_goods_category` VALUES ('44', '游戏', '16', '23', '24', '3', '游戏');
INSERT INTO `shop_goods_category` VALUES ('45', '小说', '17', '27', '28', '3', '小说');
INSERT INTO `shop_goods_category` VALUES ('46', '文学', '17', '29', '30', '3', '文学');
INSERT INTO `shop_goods_category` VALUES ('47', '青春文学', '17', '31', '32', '3', '青春文学');
INSERT INTO `shop_goods_category` VALUES ('48', '传记', '17', '33', '34', '3', '传记');
INSERT INTO `shop_goods_category` VALUES ('49', '艺术', '17', '35', '36', '3', '艺术');
INSERT INTO `shop_goods_category` VALUES ('50', '经管', '17', '37', '38', '3', '经管');
INSERT INTO `shop_goods_category` VALUES ('51', '历史', '18', '41', '42', '3', '历史');
INSERT INTO `shop_goods_category` VALUES ('52', '心理学', '18', '43', '44', '3', '心理学');
INSERT INTO `shop_goods_category` VALUES ('53', '政治/军事', '18', '45', '46', '3', '政治/军事');
INSERT INTO `shop_goods_category` VALUES ('54', '国学/古籍', '18', '47', '48', '3', '国学/古籍');
INSERT INTO `shop_goods_category` VALUES ('55', '宗教/哲学', '18', '49', '50', '3', '宗教/哲学');
INSERT INTO `shop_goods_category` VALUES ('56', '社会科学', '18', '51', '52', '3', '社会科学');
INSERT INTO `shop_goods_category` VALUES ('57', '经济', '19', '55', '56', '3', '经济');
INSERT INTO `shop_goods_category` VALUES ('58', '金融与投资', '19', '57', '58', '3', '金融与投资');
INSERT INTO `shop_goods_category` VALUES ('59', '管理', '19', '59', '60', '3', '管理');
INSERT INTO `shop_goods_category` VALUES ('60', '励志与成功', '19', '61', '62', '3', '励志与成功');
INSERT INTO `shop_goods_category` VALUES ('61', '烹饪/美食', '20', '65', '66', '3', '烹饪/美食');
INSERT INTO `shop_goods_category` VALUES ('62', '时尚/美妆', '20', '67', '68', '3', '时尚/美妆');
INSERT INTO `shop_goods_category` VALUES ('63', '休闲/娱乐', '20', '69', '70', '3', '休闲/娱乐');
INSERT INTO `shop_goods_category` VALUES ('64', '动漫/幽默', '20', '71', '72', '3', '动漫/幽默');
INSERT INTO `shop_goods_category` VALUES ('65', '体育/运动', '20', '73', '74', '3', '体育/运动');
INSERT INTO `shop_goods_category` VALUES ('66', '科普', '21', '77', '78', '3', '科普');
INSERT INTO `shop_goods_category` VALUES ('67', '建筑', '21', '79', '80', '3', '建筑');
INSERT INTO `shop_goods_category` VALUES ('68', 'IT', '21', '81', '82', '3', 'IT');
INSERT INTO `shop_goods_category` VALUES ('69', '医学', '21', '83', '84', '3', '医学');
INSERT INTO `shop_goods_category` VALUES ('70', '电子通信', '21', '85', '86', '3', '电子通信');
INSERT INTO `shop_goods_category` VALUES ('71', '科学与技术', '21', '87', '88', '3', '科学与技术');
INSERT INTO `shop_goods_category` VALUES ('72', '平板电视', '22', '109', '110', '3', '平板电视');
INSERT INTO `shop_goods_category` VALUES ('73', '空调', '22', '111', '112', '3', '空调');
INSERT INTO `shop_goods_category` VALUES ('74', '冰箱', '22', '113', '114', '3', '冰箱');
INSERT INTO `shop_goods_category` VALUES ('75', '洗衣机', '22', '115', '116', '3', '洗衣机');
INSERT INTO `shop_goods_category` VALUES ('76', '热水器', '22', '117', '118', '3', '热水器');
INSERT INTO `shop_goods_category` VALUES ('77', 'ＤＶＤ', '22', '119', '120', '3', 'ＤＶＤ');
INSERT INTO `shop_goods_category` VALUES ('78', '烟机/灶具', '22', '121', '122', '3', '烟机/灶具');
INSERT INTO `shop_goods_category` VALUES ('79', '取暖器', '23', '125', '126', '3', '取暖器');
INSERT INTO `shop_goods_category` VALUES ('80', '加湿器', '23', '127', '128', '3', '加湿器');
INSERT INTO `shop_goods_category` VALUES ('81', '净化器', '23', '129', '130', '3', '净化器');
INSERT INTO `shop_goods_category` VALUES ('82', '饮水机', '23', '131', '132', '3', '饮水机');
INSERT INTO `shop_goods_category` VALUES ('83', '电磁炉', '24', '143', '144', '3', '电磁炉');
INSERT INTO `shop_goods_category` VALUES ('84', '电水壶', '24', '145', '146', '3', '电水壶');
INSERT INTO `shop_goods_category` VALUES ('85', '剃须刀', '25', '149', '150', '3', '剃须刀');
INSERT INTO `shop_goods_category` VALUES ('86', '电饭煲', '24', '135', '136', '3', '电饭煲');
INSERT INTO `shop_goods_category` VALUES ('87', '豆浆机', '24', '137', '138', '3', '豆浆机');
INSERT INTO `shop_goods_category` VALUES ('88', '面包机', '24', '139', '140', '3', '面包机');
INSERT INTO `shop_goods_category` VALUES ('89', '微波炉', '24', '141', '142', '3', '微波炉');
INSERT INTO `shop_goods_category` VALUES ('90', '电吹风', '25', '151', '152', '3', '电吹风');
INSERT INTO `shop_goods_category` VALUES ('91', '按摩器', '25', '153', '154', '3', '按摩器');
INSERT INTO `shop_goods_category` VALUES ('92', '血压计', '25', '155', '156', '3', '血压计');
INSERT INTO `shop_goods_category` VALUES ('93', '灯具', '26', '159', '160', '3', '灯具');
INSERT INTO `shop_goods_category` VALUES ('94', '水槽', '26', '161', '162', '3', '水槽');
INSERT INTO `shop_goods_category` VALUES ('95', '水龙头', '26', '163', '164', '3', '水龙头');
INSERT INTO `shop_goods_category` VALUES ('96', '插座', '26', '165', '166', '3', '插座');
INSERT INTO `shop_goods_category` VALUES ('97', '开关', '26', '167', '168', '3', '开关');

-- ----------------------------
-- Table structure for shop_goods_day_count
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods_day_count`;
CREATE TABLE `shop_goods_day_count` (
  `day` date NOT NULL COMMENT '����',
  `count` int(10) DEFAULT NULL COMMENT '��Ʒ��',
  PRIMARY KEY (`day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_goods_day_count
-- ----------------------------
INSERT INTO `shop_goods_day_count` VALUES ('2016-11-19', '1');

-- ----------------------------
-- Table structure for shop_goods_detail
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods_detail`;
CREATE TABLE `shop_goods_detail` (
  `goods_id` bigint(20) NOT NULL COMMENT '��ƷID',
  `content` text COMMENT '��Ʒ����',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_goods_detail
-- ----------------------------
INSERT INTO `shop_goods_detail` VALUES ('1', '&lt;p&gt;新品上架，超级划算&lt;/p&gt;');
INSERT INTO `shop_goods_detail` VALUES ('2', '&lt;p&gt;&amp;nbsp;海尔冰箱&lt;/p&gt;');
INSERT INTO `shop_goods_detail` VALUES ('3', '&lt;p&gt;康佳液晶电视&lt;/p&gt;');
INSERT INTO `shop_goods_detail` VALUES ('4', '&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;lt;p&amp;gt;新品上架，超级划算&amp;lt;/p&amp;gt; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;');
INSERT INTO `shop_goods_detail` VALUES ('5', '&lt;p&gt;好声音耳机，音质就是好&lt;/p&gt;');
INSERT INTO `shop_goods_detail` VALUES ('6', '&lt;p&gt;索尼大法好&lt;/p&gt;');
INSERT INTO `shop_goods_detail` VALUES ('7', '&lt;p&gt;的说法是&lt;/p&gt;');
INSERT INTO `shop_goods_detail` VALUES ('8', '&lt;p&gt;撒地方撒地方三&lt;/p&gt;');
INSERT INTO `shop_goods_detail` VALUES ('9', '&lt;p&gt;士大夫撒发&lt;/p&gt;');
INSERT INTO `shop_goods_detail` VALUES ('10', '&lt;p&gt;的所发生的&lt;/p&gt;');
INSERT INTO `shop_goods_detail` VALUES ('11', '&lt;p&gt;地方撒发生&lt;/p&gt;');

-- ----------------------------
-- Table structure for shop_goods_gallery
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods_gallery`;
CREATE TABLE `shop_goods_gallery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` bigint(20) DEFAULT NULL COMMENT '��ƷID',
  `path` varchar(255) NOT NULL COMMENT '��ƷͼƬ��ַ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_goods_gallery
-- ----------------------------
INSERT INTO `shop_goods_gallery` VALUES ('1', '1', 'http://admin.shop.com/./Uploads/images/2016-11-19/5830390e2df08.jpg');
INSERT INTO `shop_goods_gallery` VALUES ('2', '2', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303cca6d618.jpg');
INSERT INTO `shop_goods_gallery` VALUES ('3', '3', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303d1c70f9d.jpg');
INSERT INTO `shop_goods_gallery` VALUES ('4', '4', '');
INSERT INTO `shop_goods_gallery` VALUES ('5', '5', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303db9750fc.jpg');
INSERT INTO `shop_goods_gallery` VALUES ('6', '6', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303e191bffd.jpg');
INSERT INTO `shop_goods_gallery` VALUES ('7', '7', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303e6b5e955.jpg');
INSERT INTO `shop_goods_gallery` VALUES ('8', '8', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303eac4d137.jpg');
INSERT INTO `shop_goods_gallery` VALUES ('9', '9', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303eecb7648.jpg');
INSERT INTO `shop_goods_gallery` VALUES ('10', '10', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303f2b993fe.jpg');
INSERT INTO `shop_goods_gallery` VALUES ('11', '11', 'http://admin.shop.com/./Uploads/images/2016-11-19/58303f81e14c7.jpg');

-- ----------------------------
-- Table structure for shop_menu
-- ----------------------------
DROP TABLE IF EXISTS `shop_menu`;
CREATE TABLE `shop_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '�˵�����',
  `path` varchar(50) DEFAULT NULL COMMENT '�˵�·��',
  `parent_id` int(10) unsigned DEFAULT NULL COMMENT '�����˵�',
  `lft` int(10) unsigned DEFAULT NULL COMMENT '��ڵ�',
  `rght` int(10) unsigned DEFAULT NULL COMMENT '�ҽڵ�',
  `level` int(10) unsigned DEFAULT NULL COMMENT '�㼶',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_menu
-- ----------------------------
INSERT INTO `shop_menu` VALUES ('1', '商品管理', '', '0', '1', '10', '1');
INSERT INTO `shop_menu` VALUES ('2', '订单管理', '', '0', '11', '22', '1');
INSERT INTO `shop_menu` VALUES ('3', '会员管理', '', '0', '23', '30', '1');
INSERT INTO `shop_menu` VALUES ('4', '商品列表', 'Admin/Goods/index', '1', '8', '9', '2');
INSERT INTO `shop_menu` VALUES ('5', '添加新商品', 'Admin/Goods/add', '1', '2', '3', '2');
INSERT INTO `shop_menu` VALUES ('6', '商品分类', 'Admin/GoodsCategory/index', '1', '4', '5', '2');
INSERT INTO `shop_menu` VALUES ('7', '商品品牌', 'Admin/Brand/index', '1', '6', '7', '2');
INSERT INTO `shop_menu` VALUES ('8', '订单列表', '', '2', '12', '13', '2');
INSERT INTO `shop_menu` VALUES ('9', '订单查询', '', '2', '14', '15', '2');
INSERT INTO `shop_menu` VALUES ('10', '添加订单', '', '2', '16', '17', '2');
INSERT INTO `shop_menu` VALUES ('11', '发货订单列表', '', '2', '18', '19', '2');
INSERT INTO `shop_menu` VALUES ('12', '退货订单列表', '', '2', '20', '21', '2');
INSERT INTO `shop_menu` VALUES ('13', '会员列表', '', '3', '24', '25', '2');
INSERT INTO `shop_menu` VALUES ('14', '添加会员', '', '3', '26', '27', '2');
INSERT INTO `shop_menu` VALUES ('15', '会员留言', '', '3', '28', '29', '2');

-- ----------------------------
-- Table structure for shop_menu_permission
-- ----------------------------
DROP TABLE IF EXISTS `shop_menu_permission`;
CREATE TABLE `shop_menu_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL COMMENT '�˵�id',
  `permission_id` int(10) unsigned NOT NULL COMMENT 'Ȩ��id',
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_menu_permission
-- ----------------------------
INSERT INTO `shop_menu_permission` VALUES ('8', '1', '7');
INSERT INTO `shop_menu_permission` VALUES ('9', '1', '8');
INSERT INTO `shop_menu_permission` VALUES ('10', '1', '9');
INSERT INTO `shop_menu_permission` VALUES ('11', '1', '2');
INSERT INTO `shop_menu_permission` VALUES ('12', '1', '10');
INSERT INTO `shop_menu_permission` VALUES ('13', '1', '11');
INSERT INTO `shop_menu_permission` VALUES ('14', '1', '12');
INSERT INTO `shop_menu_permission` VALUES ('19', '7', '2');
INSERT INTO `shop_menu_permission` VALUES ('20', '7', '10');
INSERT INTO `shop_menu_permission` VALUES ('21', '7', '11');
INSERT INTO `shop_menu_permission` VALUES ('45', '4', '1');
INSERT INTO `shop_menu_permission` VALUES ('46', '4', '8');
INSERT INTO `shop_menu_permission` VALUES ('47', '4', '9');
INSERT INTO `shop_menu_permission` VALUES ('48', '4', '13');
INSERT INTO `shop_menu_permission` VALUES ('49', '6', '2');
INSERT INTO `shop_menu_permission` VALUES ('50', '6', '10');
INSERT INTO `shop_menu_permission` VALUES ('51', '6', '11');
INSERT INTO `shop_menu_permission` VALUES ('52', '6', '12');
INSERT INTO `shop_menu_permission` VALUES ('53', '6', '14');
INSERT INTO `shop_menu_permission` VALUES ('54', '5', '1');
INSERT INTO `shop_menu_permission` VALUES ('55', '5', '7');
INSERT INTO `shop_menu_permission` VALUES ('56', '5', '13');

-- ----------------------------
-- Table structure for shop_permission
-- ----------------------------
DROP TABLE IF EXISTS `shop_permission`;
CREATE TABLE `shop_permission` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '����',
  `path` varchar(50) NOT NULL COMMENT 'URL',
  `parent_id` tinyint(5) unsigned NOT NULL DEFAULT '0',
  `lft` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '��߽�',
  `rght` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '�ұ߽�',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '����',
  `intro` text COMMENT '���@textarea',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `lft` (`lft`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_permission
-- ----------------------------
INSERT INTO `shop_permission` VALUES ('1', '商品管理', 'Admin/Goods/index', '0', '1', '10', '1', '商品管理');
INSERT INTO `shop_permission` VALUES ('2', '商品分类', 'Admin/GoodsCategory/index', '0', '11', '20', '1', '商品分类');
INSERT INTO `shop_permission` VALUES ('7', '添加商品', 'Admin/Goods/add', '1', '2', '3', '2', '添加商品');
INSERT INTO `shop_permission` VALUES ('8', '编辑商品', 'Admin/Goods/edit', '1', '4', '5', '2', '编辑商品');
INSERT INTO `shop_permission` VALUES ('9', '删除商品', 'Admin/Goods/remove', '1', '6', '7', '2', '删除商品');
INSERT INTO `shop_permission` VALUES ('10', '添加分类', 'Admin/GoodsCategory/add', '2', '12', '13', '2', '添加商品分类');
INSERT INTO `shop_permission` VALUES ('11', '编辑分类', 'Admin/GoodsCategory/edit', '2', '14', '15', '2', '编辑商品分类');
INSERT INTO `shop_permission` VALUES ('12', '删除分类', 'Admin/GoodsCategory/remove', '2', '16', '17', '2', '删除分类');
INSERT INTO `shop_permission` VALUES ('13', '商品列表', 'Admin/Goods/index', '1', '8', '9', '2', '商品列表');
INSERT INTO `shop_permission` VALUES ('14', '商品分类列表', 'Admin/GoodsCategory/index', '2', '18', '19', '2', '商品分类列表');

-- ----------------------------
-- Table structure for shop_role
-- ----------------------------
DROP TABLE IF EXISTS `shop_role`;
CREATE TABLE `shop_role` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '����',
  `intro` text COMMENT '���@textarea',
  `sort` tinyint(4) NOT NULL DEFAULT '20' COMMENT '����',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_role
-- ----------------------------
INSERT INTO `shop_role` VALUES ('21', '商品管理员', '我就一管商品的', '20');
INSERT INTO `shop_role` VALUES ('23', '临时工', '我是临时工，我怕谁', '20');

-- ----------------------------
-- Table structure for shop_role_permission
-- ----------------------------
DROP TABLE IF EXISTS `shop_role_permission`;
CREATE TABLE `shop_role_permission` (
  `role_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `permission_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Ȩ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_role_permission
-- ----------------------------
INSERT INTO `shop_role_permission` VALUES ('21', '1');
INSERT INTO `shop_role_permission` VALUES ('21', '7');
INSERT INTO `shop_role_permission` VALUES ('21', '8');

-- ----------------------------
-- Table structure for shop_user
-- ----------------------------
DROP TABLE IF EXISTS `shop_user`;
CREATE TABLE `shop_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '�û���',
  `password` char(32) NOT NULL COMMENT '����',
  `tel` char(11) DEFAULT NULL COMMENT '�ֻ�����',
  `email` varchar(30) NOT NULL COMMENT 'email',
  `add_time` int(11) NOT NULL COMMENT '����ʱ��',
  `last_login_time` int(11) NOT NULL COMMENT '����¼ʱ��',
  `last_login_ip` bigint(20) NOT NULL COMMENT '����¼ip',
  `salt` char(6) NOT NULL COMMENT '��',
  `status` tinyint(4) NOT NULL COMMENT '״̬��-1 ɾ�� 0 ���� 1 ����',
  `token` char(32) NOT NULL COMMENT '�����ַ���',
  `active_token` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_user
-- ----------------------------
INSERT INTO `shop_user` VALUES ('1', 'admin', '72ed8545be1c52fbac7551f454bee95d', '13396870807', 'dgwnyb08964@chacuo.net', '1479482242', '1479482242', '2130706433', 'VUZdOc', '1', 'ocgBEb', 'ERtjrkUVbnkYgyzAXMbyNzXCXHUoekcB');
