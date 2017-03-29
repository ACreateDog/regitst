# Host: localhost  (Version: 5.6.12-log)
# Date: 2016-05-02 18:39:08
# Generator: MySQL-Front 5.3  (Build 4.214)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "guardian"
#

DROP TABLE IF EXISTS `guardian`;
CREATE TABLE `guardian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '监护人姓名',
  `id_num` char(18) NOT NULL DEFAULT '' COMMENT '身份证号',
  `workunit` varchar(255) NOT NULL DEFAULT '无' COMMENT '工作单位',
  `occupation` varchar(25) DEFAULT '无' COMMENT '职业',
  `phone` char(11) NOT NULL DEFAULT '' COMMENT '手机号码',
  `relations` varchar(10) NOT NULL DEFAULT '0' COMMENT '关系 0父 1母',
  `student_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '学生id',
  `creattime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='监护人';

#
# Data for table "guardian"
#


#
# Structure for table "organ"
#

DROP TABLE IF EXISTS `organ`;
CREATE TABLE `organ` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `handler` varchar(10) DEFAULT '' COMMENT '负责人',
  `phone` char(11) DEFAULT NULL COMMENT '联系方式',
  `address` varchar(100) DEFAULT NULL COMMENT '地址',
  `rank` tinyint(1) NOT NULL DEFAULT '0' COMMENT '等级 0超级管理员，1市，2区，3公办初中，4民办初中，5小学，6班级',
  `pid` tinyint(1) unsigned DEFAULT NULL COMMENT '上级id',
  `creattime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '0未删除，1删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='机构表';

#
# Data for table "organ"
#

INSERT INTO `organ` VALUES (1,'市教育局','朱某某','12345678911',NULL,1,0,0,0,NULL),(2,'1区','王某某','78945612333',NULL,2,1,0,0,NULL),(3,'2区','赵某某','65434178932',NULL,2,1,0,0,NULL),(4,'3区','杨某某','65432164965',NULL,2,1,0,0,NULL),(5,'一中','李某某','35234166456',NULL,3,2,0,0,NULL),(6,'二中','凌某某','32346532313',NULL,3,3,0,0,NULL),(7,'三中','梁某某','35632186548',NULL,3,3,0,0,NULL),(8,'四中','刘某某','54665413215',NULL,3,2,0,0,NULL);

#
# Structure for table "register"
#

DROP TABLE IF EXISTS `register`;
CREATE TABLE `register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '学生id',
  `pub_junior` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '公办初中id',
  `civil_junior` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '民办初中id',
  `pub_release` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '公办录取 0,未发布 1已发布',
  `civil_release` tinyint(1) DEFAULT '0' COMMENT '民办录取 0,未发布，1发布',
  `lot_release` tinyint(1) DEFAULT '0' COMMENT '摇号发布 0,未发布 1 发布',
  `pub_status` tinyint(1) unsigned DEFAULT '0' COMMENT '公办初中 0，等待，1同意，2拒绝',
  `civil_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '民办初中 0等待 1面试 2同意 3退回',
  `creattime` int(11) unsigned DEFAULT NULL,
  `updatetime` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='报名表';

#
# Data for table "register"
#

INSERT INTO `register` VALUES (1,3,2,0,0,0,0,1,0,NULL,NULL),(2,4,2,4,1,0,0,2,1,NULL,NULL),(3,2,2,6,0,1,1,1,1,NULL,NULL),(4,1,2,3,0,1,1,0,2,NULL,NULL),(5,5,2,3,0,0,1,0,2,NULL,NULL),(6,6,2,3,0,1,1,0,3,NULL,NULL),(7,7,2,3,0,0,1,0,1,NULL,NULL);

#
# Structure for table "reject"
#

DROP TABLE IF EXISTS `reject`;
CREATE TABLE `reject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL DEFAULT '0' COMMENT '学校ID',
  `reason` varchar(255) DEFAULT '无' COMMENT '拒绝理由',
  `creattime` int(11) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='拒绝原因';

#
# Data for table "reject"
#


#
# Structure for table "setting"
#

DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `register_time` int(11) DEFAULT NULL COMMENT '报名时间',
  `civil_permit_time` int(11) NOT NULL DEFAULT '0' COMMENT '民办录取时间',
  `pub_permit_time` int(11) DEFAULT NULL COMMENT '公办录取时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='设置';

#
# Data for table "setting"
#


#
# Structure for table "student"
#

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid_num` char(20) NOT NULL DEFAULT '' COMMENT '学籍号',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '名字',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0男,1女',
  `birthday` int(11) unsigned DEFAULT NULL COMMENT '出生日期',
  `oid` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '机构id',
  `id_num` char(18) NOT NULL DEFAULT '0' COMMENT '身份证号',
  `nation` char(16) NOT NULL DEFAULT '' COMMENT '民族',
  `account` varchar(255) DEFAULT '' COMMENT '户口所在地',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '家庭住址',
  `phone` varchar(11) DEFAULT NULL COMMENT '手机号',
  `picture` varchar(255) DEFAULT NULL COMMENT '照片',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `origin` tinyint(1) unsigned DEFAULT NULL COMMENT '生源类型,0学区生，1统筹生。',
  `hous` varchar(255) DEFAULT NULL COMMENT '房产证编号',
  `hous_address` varchar(255) DEFAULT NULL COMMENT '房产地址',
  `hours_owners` varchar(255) DEFAULT NULL COMMENT '房产所有人及共有人',
  `hours_relations` varchar(255) DEFAULT NULL COMMENT '房产证户主与孩子关系',
  `creattime` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '0未删除，1删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='学生表';

#
# Data for table "student"
#

INSERT INTO `student` VALUES (1,'20141515407','朱孝远',1,1995050413,6,'411425199705000000','汉','商丘','商丘梁园区','15537031444',NULL,NULL,1,'安徽','安徽','安徽','安',NULL,NULL,0),(2,'20141515407','朱孝国',0,1995050413,7,'411425199705041393','汉','安徽','相山区','15537031333',NULL,'12271745@qq.com',NULL,'商丘','商丘','商','商',NULL,NULL,0),(3,'20141515407','朱孝远',1,1995050413,6,'411425199705043232','汉','商丘','商丘梁园区','15537031222','','',1,'安徽','安徽','安徽','安',NULL,NULL,0),(4,'20141515407','朱孝国',0,1995050413,7,'411425199705045456','汉','安徽','相山区','15537031111','','12271745@qq.com',NULL,'商丘','商丘','商','商',NULL,NULL,0),(5,'20141515408','王某某',0,1995050493,5,'411425199705043333','汉','淮北','相山区','15537031666',NULL,NULL,NULL,'淮北','淮北','王大','父子',NULL,NULL,0),(6,'20141515408','梁某某',1,1996453213,5,'864631321321321','汉','单县','单县','25151631635',NULL,'515313',NULL,'单县','单县','梁大','单县',NULL,NULL,0),(7,'20141515417','赵某某',1,1995051213,3,'46513213516131','回族','徐州','云门区','15537313216',NULL,NULL,NULL,'云门','徐州','王二','父子',NULL,NULL,0);

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `pass` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `oid` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '机构id',
  `creattime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0未删除，1删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='账号';

#
# Data for table "user"
#

