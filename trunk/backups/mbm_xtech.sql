-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 16, 2012 at 02:11 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `mbm_xtech`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_admins`
-- 

CREATE TABLE `tbl_admins` (
  `admin_id` int(11) NOT NULL auto_increment,
  `admin_name` varchar(50) NOT NULL default '',
  `admin_email` varchar(50) NOT NULL default '',
  `admin_username` varchar(50) NOT NULL default '',
  `admin_password` varchar(50) NOT NULL default '',
  `admin_password_method` tinyint(1) NOT NULL default '1',
  `admin_code` varchar(16) NOT NULL default '',
  `admin_group` tinyint(3) NOT NULL default '2' COMMENT '1:admin\r\n2:manager\r\n3:manager-site',
  `admin_access` text,
  `admin_created` int(11) NOT NULL default '1',
  `admin_modify` int(11) NOT NULL,
  `admin_registerDate` datetime default '0000-00-00 00:00:00',
  `admin_lastvisitDate` datetime default '0000-00-00 00:00:00',
  `admin_enabled` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`admin_id`),
  UNIQUE KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

-- 
-- Dumping data for table `tbl_admins`
-- 

INSERT INTO `tbl_admins` VALUES (1, 'Kiều Văn Ngọc', 'ngockieuvan@vccorp.vn', 'kieuvanngoc', 'f1b8be6c6d03d1abf6f01ec160774ea4', 1, 'A2OLyR4BizBmAhLT', 1, '', 1, 1, '0000-00-00 00:00:00', '2012-02-03 22:12:10', 1);
INSERT INTO `tbl_admins` VALUES (25, 'Phan Thị Trang', 'xtech@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1, '', 2, 'a:2:{s:11:"admin.sites";s:0:"";s:13:"admin.hotdeal";a:6:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"5";i:4;s:1:"6";i:5;s:1:"7";}}', 0, 1, '1970-01-01 07:00:00', '0000-00-00 00:00:00', 1);
INSERT INTO `tbl_admins` VALUES (26, 'Bạch Quý Hợi', 'bqh@yahoo.com', 'bachquyhoi', 'e807f1fcf82d132f9bb018ca6738a19f', 1, '', 2, 'a:2:{s:11:"admin.sites";s:0:"";s:13:"admin.hotdeal";a:1:{i:0;s:1:"5";}}', 0, 0, '1970-01-01 07:00:00', '0000-00-00 00:00:00', 1);
INSERT INTO `tbl_admins` VALUES (29, 'Quản trị viên', 'quantrivien@gmail.com', 'quantrivien', 'fef1ddf26aacab614a822e243bdb16cb', 1, '', 2, 'a:3:{s:12:"admin_admins";s:0:"";s:11:"admin_sites";s:0:"";s:13:"admin_hotdeal";a:2:{i:0;s:1:"5";i:1;s:1:"7";}}', 0, 0, '1970-01-01 07:00:00', '0000-00-00 00:00:00', 1);
INSERT INTO `tbl_admins` VALUES (38, 'Nguyễn Văn Minh', 'minhnv@gmail.com', 'minhnv', 'e10adc3949ba59abbe56e057f20f883e', 1, '', 2, 'a:4:{s:12:"admin_admins";s:0:"";s:11:"admin_sites";s:0:"";s:13:"admin_hotdeal";a:1:{i:0;s:1:"2";}s:22:"admin_customer_hotdeal";s:0:"";}', 1, 38, '2012-02-15 05:24:45', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_admins_sites`
-- 

CREATE TABLE `tbl_admins_sites` (
  `site_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `tbl_admins_sites`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_adv`
-- 

CREATE TABLE `tbl_adv` (
  `adv_id` int(11) NOT NULL auto_increment,
  `adv_img` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `adv_link` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `adv_title` text collate utf8_unicode_ci,
  `adv_status` tinyint(1) NOT NULL default '0',
  `adv_date` timestamp NULL default NULL,
  `adv_click` int(11) default NULL,
  `adv_location` varchar(6) collate utf8_unicode_ci NOT NULL default '0' COMMENT 'Vị trí bên trái hay phải',
  PRIMARY KEY  (`adv_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

-- 
-- Dumping data for table `tbl_adv`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_banner`
-- 

CREATE TABLE `tbl_banner` (
  `banner_id` tinyint(4) NOT NULL auto_increment COMMENT 'Mã Banner',
  `banner_image` varchar(255) collate utf8_unicode_ci NOT NULL,
  `banner_url` varchar(255) collate utf8_unicode_ci NOT NULL,
  `banner_status` tinyint(1) NOT NULL default '1',
  `banner_web` int(11) NOT NULL,
  `banner_page` varchar(50) collate utf8_unicode_ci NOT NULL,
  `banner_position` varchar(100) collate utf8_unicode_ci NOT NULL,
  `banner_title` varchar(255) collate utf8_unicode_ci NOT NULL,
  `banner_description` tinytext collate utf8_unicode_ci NOT NULL,
  `banner_click` int(11) NOT NULL default '0',
  `banner_create` datetime NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY  (`banner_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `tbl_banner`
-- 

INSERT INTO `tbl_banner` VALUES (4, 'image/banners/2.jpg', 'http://xtech.vn/register_get_phone.php?product_id=', 1, 1, '', '', 'đặt hàng online htc cha cha', '', 0, '2012-02-10 12:00:00', 0, 2374);
INSERT INTO `tbl_banner` VALUES (5, '', '', 0, 1, '', '', 'Chương trình mới', '', 0, '2012-02-10 04:29:02', 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_customer_hotdel`
-- 

CREATE TABLE `tbl_customer_hotdel` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `hotdeal_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `number_register` int(11) NOT NULL default '1',
  `order_product` int(11) NOT NULL,
  `is_promotion` tinyint(1) NOT NULL default '0',
  `payment` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=211 ;

-- 
-- Dumping data for table `tbl_customer_hotdel`
-- 

INSERT INTO `tbl_customer_hotdel` VALUES (7, '', '', '', '', 2590000, '0000-00-00 00:00:00', 31, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (8, '', '', '', '', 280000, '0000-00-00 00:00:00', 21, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (5, 'Phạm Hồng Quân', '', '098781186', '', 13, '0000-00-00 00:00:00', 32, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (6, '', '', '', '', 1270000, '0000-00-00 00:00:00', 22, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (9, '', '', '', '', 0, '0000-00-00 00:00:00', 27, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (10, '', '', '', '', 0, '0000-00-00 00:00:00', 30, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (11, '', '', '', '', 0, '0000-00-00 00:00:00', 25, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (12, '', '', '', '', 0, '0000-00-00 00:00:00', 25, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (13, '', '', '', '', 0, '0000-00-00 00:00:00', 23, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (14, '', '', '', '', 0, '0000-00-00 00:00:00', 23, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (15, '', '', '', '', 0, '0000-00-00 00:00:00', 23, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (16, '', '', '', '', 0, '0000-00-00 00:00:00', 32, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (17, '', '', '', '', 0, '0000-00-00 00:00:00', 32, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (18, '', '', '', '', 0, '0000-00-00 00:00:00', 32, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (19, '', '', '', '', 0, '0000-00-00 00:00:00', 32, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (20, '', '', '', '', 0, '0000-00-00 00:00:00', 21, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (21, '', '', '', '', 0, '0000-00-00 00:00:00', 21, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (22, '', '', '', '', 0, '0000-00-00 00:00:00', 21, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (23, '', '', '', '', 0, '0000-00-00 00:00:00', 21, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (24, '', '', '', '', 0, '0000-00-00 00:00:00', 32, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (25, '', '', '', '', 0, '0000-00-00 00:00:00', 32, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (26, '', '', '', '', 0, '0000-00-00 00:00:00', 32, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (27, '', '', '', '', 0, '0000-00-00 00:00:00', 32, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (28, '', '', '', '', 0, '0000-00-00 00:00:00', 21, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (29, '', '', '', '', 0, '0000-00-00 00:00:00', 21, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (30, '', '', '', '', 0, '0000-00-00 00:00:00', 21, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (31, '', '', '', '', 0, '0000-00-00 00:00:00', 21, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (32, '', '', '', '', 0, '0000-00-00 00:00:00', 21, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (33, '', '', '', '', 0, '0000-00-00 00:00:00', 21, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (34, '', '', '', '', 0, '0000-00-00 00:00:00', 27, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (35, '', '', '', '', 0, '0000-00-00 00:00:00', 21, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (36, '', '', '', '', 0, '0000-00-00 00:00:00', 21, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (37, '', '', '', '', 0, '0000-00-00 00:00:00', 21, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (38, '', '', '', '', 0, '0000-00-00 00:00:00', 39, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (39, '', '', '', '', 0, '0000-00-00 00:00:00', 29, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (40, '', '', '', '', 0, '0000-00-00 00:00:00', 38, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (41, '', '', '', '', 0, '0000-00-00 00:00:00', 38, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (42, '', '', '', '', 0, '0000-00-00 00:00:00', 36, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (43, '', '', '', '', 0, '0000-00-00 00:00:00', 37, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (44, '', '', '', '', 0, '0000-00-00 00:00:00', 32, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (45, 'Nguyễn Thu Thủy', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (46, 'Trần Hồng Quang', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (47, 'Đào Thế Anh', '', '', '', 0, '0000-00-00 00:00:00', 45, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (48, 'Nguyễn Thanh', '', '', '', 0, '0000-00-00 00:00:00', 40, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (49, 'Trần Trung Kiên', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (50, 'Phan Thị Hằng', '', '', '', 0, '0000-00-00 00:00:00', 42, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (51, 'Ngọc Duy', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (52, 'The Thang', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (53, 'Nguyễn Trang', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (54, 'Đức Thanh', '', '', '', 0, '0000-00-00 00:00:00', 37, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (55, 'Anh Tuấn', '', '', '', 0, '0000-00-00 00:00:00', 45, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (56, 'Trần Minh Việt', '', '', '', 0, '0000-00-00 00:00:00', 43, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (57, 'Lâm Thủ Thừa', '', '', '', 0, '0000-00-00 00:00:00', 49, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (58, 'Nguyễn Thị Thơm', '', '', '', 0, '0000-00-00 00:00:00', 31, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (59, 'Trần Quang Hải', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (60, 'Vũ Hồng Quân', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (61, 'Đặng Văn Thiều', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (62, 'Nguyễn Bá', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (63, 'lâm Nhật quang', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (64, 'Huỳnh Điểu', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (65, 'Phan Minh', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (66, 'Anh Bách', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (67, 'Trần Thiện Thanh', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (68, 'Đặng Hồng Quân', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (69, 'Vũ Ngọc Anh', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (70, 'Lê Na', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (71, 'Lê Thị Tuyết', '', '', '', 0, '0000-00-00 00:00:00', 48, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (72, 'Lê Bích Phương', '', '', '', 0, '0000-00-00 00:00:00', 41, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (73, 'Nguyễn Thu Phương', '', '', '', 0, '0000-00-00 00:00:00', 41, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (74, 'Văn Hùng', '', '', '', 0, '0000-00-00 00:00:00', 43, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (75, 'Hoang Huỳnh', '', '', '', 0, '0000-00-00 00:00:00', 37, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (76, 'Kiều Ngọc ANh', '', '', '', 0, '0000-00-00 00:00:00', 55, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (77, 'Thế Anh', '', '', '', 0, '0000-00-00 00:00:00', 55, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (78, 'bùi Trung Hiếu', '', '', '', 0, '0000-00-00 00:00:00', 54, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (79, 'Quang Thiều', '', '', '', 0, '0000-00-00 00:00:00', 54, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (80, 'lam Anh', '', '', '', 0, '0000-00-00 00:00:00', 50, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (81, 'Bùi Minh', '', '', '', 0, '0000-00-00 00:00:00', 49, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (82, 'Vũ Hoài Nam', '', '', '', 0, '0000-00-00 00:00:00', 45, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (83, 'Bùi Thị Ngọc Anh', '', '', '', 0, '0000-00-00 00:00:00', 55, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (84, 'Nguyễn Thị Mai', '', '', '', 0, '0000-00-00 00:00:00', 50, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (85, 'Hoàng Thị Hồng', '', '', '', 0, '0000-00-00 00:00:00', 54, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (86, 'Bùi Mạnh Cường', '', '', '', 0, '0000-00-00 00:00:00', 45, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (87, 'Nguyễn Ngọc Hoa', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (88, 'Nguyễn Phương Mai Khanh', '', '', '', 0, '2012-02-02 12:00:00', 50, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (89, 'Bùi Hồng Nhung', '', '', '', 0, '0000-00-00 00:00:00', 41, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (90, 'Trần Ngọc Tuân', '', '', '', 0, '0000-00-00 00:00:00', 40, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (91, 'Lương Đức Tâm', '', '', '', 0, '0000-00-00 00:00:00', 38, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (92, 'Nguyễn Thanh Tùng', '', '', '', 0, '0000-00-00 00:00:00', 49, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (93, 'Vũ Ngọc Phan', '', '', '', 0, '0000-00-00 00:00:00', 53, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (94, 'Lê Thị Cúc', '', '', '', 0, '0000-00-00 00:00:00', 55, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (95, 'Nguyễn Hương Giang Thanh', '', '', '', 0, '2002-02-20 12:14:00', 53, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (96, 'Tạ Cẩm Tú', '', '', '', 0, '0000-00-00 00:00:00', 53, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (97, 'Đặng Thùy Dung', '', '', '', 0, '0000-00-00 00:00:00', 52, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (98, 'Bùi Minh Hiếu', '', '', '', 0, '0000-00-00 00:00:00', 52, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (99, 'Đỗ Thúy Chi', '', '', '', 0, '0000-00-00 00:00:00', 53, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (100, 'Nguyễn Phương Khánh', '', '', '', 0, '0000-00-00 00:00:00', 53, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (101, 'Nguyễn Thùy Chi', '', '', '', 0, '0000-00-00 00:00:00', 51, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (102, 'Đỗ Đức Mạnh', '', '', '', 0, '0000-00-00 00:00:00', 51, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (103, 'Nguyễn Ngọc', '', '', '', 0, '0000-00-00 00:00:00', 45, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (104, 'Trần Văn Hòa', '', '', '', 0, '0000-00-00 00:00:00', 45, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (105, 'Lê Văn Thành', '', '', '', 0, '0000-00-00 00:00:00', 45, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (106, 'Bùi Ngọc Mai', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (107, 'Đỗ Thị Thủy', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (108, 'Lý Văn Đại', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (109, 'Lâm Bảo Trung', '', '', '', 0, '0000-00-00 00:00:00', 45, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (110, 'Nguyễn Thành Công', '', '', '', 0, '2012-02-02 12:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (111, 'Trần Thị Ngọc Minh', '', '', '', 0, '2012-02-02 12:00:00', 45, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (112, 'Võ Hoa Mai', '', '', '', 0, '0000-00-00 00:00:00', 45, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (113, '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 1, 0, 0, '');
INSERT INTO `tbl_customer_hotdel` VALUES (114, 'Hoàng Thu Giang', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (115, 'Ngô Thu Huyền', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (116, 'Nguyễn Thành Trung', '', '', '', 0, '0000-00-00 00:00:00', 53, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (117, 'Hoàng Thị Hòa', '', '', '', 0, '0000-00-00 00:00:00', 52, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (118, 'Nguyễn Minh Hồng', '', '', '', 0, '0000-00-00 00:00:00', 53, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (119, 'Trần Đức Hùng', '', '', '', 0, '0000-00-00 00:00:00', 50, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (120, 'Nguyễn Tiến Dũng', '', '', '', 0, '2012-02-07 11:27:00', 50, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (121, 'Đỗ Anh Tú', '', '', '', 0, '0000-00-00 00:00:00', 49, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (122, 'Vũ Thị Chinh', '', '', '', 0, '0000-00-00 00:00:00', 49, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (123, 'Giang Hoàng Anh', '', '', '', 0, '0000-00-00 00:00:00', 48, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (124, 'Nguyễn Thị Yến', '', '', '', 0, '0000-00-00 00:00:00', 48, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (125, 'Trương Huyền Trang', '', '', '', 0, '0000-00-00 00:00:00', 47, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (126, 'Hồ Sỹ Hoàn', '', '', '', 0, '0000-00-00 00:00:00', 47, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (127, 'Nguyễn Văn Tùng', '', '', '', 0, '0000-00-00 00:00:00', 46, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (128, 'Vũ Nam', '', '', '', 0, '0000-00-00 00:00:00', 40, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (129, 'Bùi Phương Lan', '', '', '', 0, '0000-00-00 00:00:00', 40, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (130, 'Lương Thúy Hằng', '', '', '', 0, '0000-00-00 00:00:00', 46, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (131, 'Lưu Thanh Bình', '', '', '', 0, '0000-00-00 00:00:00', 47, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (132, 'Nguyễn Thu Hường', '', '', '', 0, '0000-00-00 00:00:00', 40, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (133, 'Trần Thị Phượng', '', '', '', 0, '0000-00-00 00:00:00', 40, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (134, 'Nguyễn Phương', '', '', '', 0, '0000-00-00 00:00:00', 41, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (135, 'Lê Thị Thắm', '', '', '', 0, '0000-00-00 00:00:00', 41, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (136, 'Đỗ Đức Anh', '', '', '', 0, '0000-00-00 00:00:00', 41, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (137, 'Đỗ Mai Anh', '', '', '', 0, '0000-00-00 00:00:00', 40, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (138, 'Hoàng Thị Hà', '', '', '', 0, '0000-00-00 00:00:00', 40, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (139, 'Lê Minh Ngọc', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (140, 'Trần Ngọc Tuấn', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (141, 'Vũ Hồng', '', '', '', 0, '0000-00-00 00:00:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (142, 'Lương Tâm Anh', '', '', '', 0, '0000-00-00 00:00:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (143, 'Hồ Ngọc Minh', '', '', '', 0, '2012-02-07 09:41:00', 50, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (144, 'Nguyễn Hưng', '', '', '', 0, '0000-00-00 00:00:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (145, '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 1, 0, 0, '');
INSERT INTO `tbl_customer_hotdel` VALUES (146, 'Ngô Hoa', '', '', '', 0, '0000-00-00 00:00:00', 35, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (147, 'Ngọc Mai', '', '', '', 0, '0000-00-00 00:00:00', 35, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (148, 'Lý Văn Đại', '', '', '', 0, '0000-00-00 00:00:00', 48, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (149, 'Nguyễn Mạnh Hưng', '', '', '', 0, '0000-00-00 00:00:00', 48, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (150, 'Võ Mạnh Cường', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (151, 'Nguyễn Thu Hiền', '', '', '', 0, '0000-00-00 00:00:00', 44, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (152, '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 1, 0, 0, '');
INSERT INTO `tbl_customer_hotdel` VALUES (153, 'Bùi Hồng Nhung', '', '', '', 0, '0000-00-00 00:00:00', 42, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (154, 'Nguyễn Thúy', '', '', '', 0, '0000-00-00 00:00:00', 42, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (155, 'Nguyễn Đức Hùng', '', '', '', 0, '0000-00-00 00:00:00', 36, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (156, 'Nguyễn Văn Trường', '', '', '', 0, '0000-00-00 00:00:00', 36, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (157, 'Bùi Hồng Điệp', '', '', '', 0, '0000-00-00 00:00:00', 35, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (158, 'Nguyễn Thị Ngọc', '', '', '', 0, '0000-00-00 00:00:00', 35, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (159, 'Lương Đức TIến', '', '', '', 0, '0000-00-00 00:00:00', 39, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (160, 'Bùi Văn Hùng', '', '', '', 0, '0000-00-00 00:00:00', 39, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (161, 'Lê Thanh Thúy', 'thuy56785@gmail.com', '01696 678 498', '169B Thái Hà', 690000, '2012-02-03 04:12:00', 59, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (162, 'Trần Thúy Hằng', 'hangtt@gmail.com', '', '', 0, '2012-02-07 12:33:00', 69, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (163, 'Nguyễn Duy Hải', '', '', '', 280000, '2012-02-07 12:22:00', 72, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (164, 'Phí Ngọc Tuấn', '', '', '', 0, '2012-02-07 10:00:00', 69, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (165, 'Phạm Thị Xuân Phương', '', '', '', 0, '2012-02-06 09:00:00', 64, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (166, 'Nguyễn Văn Chung', '', '', '', 0, '2012-02-07 01:00:00', 69, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (167, 'Nguyễn Thị Thùy Dương', '', '', '', 0, '2012-02-05 10:44:00', 68, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (168, 'Đoàn Minh Vương', '', '', '', 0, '2012-02-07 09:00:00', 72, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (169, 'Trần Thị Hà Thanh', '', '', '', 0, '2012-02-07 11:00:00', 72, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (170, 'Lê Cao Ngân', '', '', '', 0, '2012-02-04 12:15:00', 74, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (171, 'Lê Ngọc Trâm', '', '', '', 0, '2012-02-05 11:11:00', 70, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (172, 'Trần Bích Phượng', '', '', '', 0, '2012-02-06 10:00:00', 57, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (173, 'Nguyễn Lan Anh', '', '', '', 0, '2012-02-06 12:19:00', 57, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (174, 'Hồ Công Dũng', '', '', '', 0, '2012-02-04 12:46:00', 71, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (175, 'Trần Thi Lan', '', '', '', 0, '2012-02-07 09:00:00', 61, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (176, 'Vũ Hoài Anh', '', '', '', 0, '2012-02-07 11:38:00', 73, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (177, 'Lưu Ngọc Mai', '', '', '', 0, '2012-02-07 01:09:00', 73, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (178, 'Nguyễn Bích Phượng', '', '', '', 0, '2012-02-06 06:09:00', 58, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (179, 'Nguyễn Ngọc Huyền', '', '', '', 0, '2012-02-07 11:46:00', 72, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (180, 'Trần Quý', '', '', '', 0, '2012-02-07 10:15:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (181, 'Vũ Dũng', '', '', '', 0, '2012-02-07 07:00:00', 68, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (182, 'Ngô Tiến Dũng', '', '', '', 0, '2012-02-08 06:20:00', 72, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (183, 'Lan Nhi', '', '', '', 0, '2012-02-09 09:44:00', 72, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (184, 'Nguyễn Thị Hằng', '', '', '', 0, '2012-02-09 10:09:00', 69, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (196, 'Phạm Thanh Hằng', '', '', '', 0, '2012-02-04 06:32:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (195, 'Tô Ngọc Loan', '', '', '', 0, '2012-02-11 09:48:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (194, 'Nguyễn Văn Linh', '', '', '', 0, '2012-02-10 09:15:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (193, 'Hữu Lộc', '', '', '', 0, '2012-02-10 01:14:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (192, 'Nguyễn Hải', '', '', '', 0, '2012-02-08 09:27:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (191, 'Kiều Văn Ngọc', '', '0978686055', 'Lê Hồ - Kim Bảng - Hà Nam', 0, '0000-00-00 00:00:00', 0, 2374, 7, 0, 0, '');
INSERT INTO `tbl_customer_hotdel` VALUES (197, 'Đặng Trần Lan', '', '', '', 0, '2012-02-09 01:15:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (198, 'Bá Văn Dũng', '', '', '', 0, '2012-02-10 10:38:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (199, 'Hoàng Long', '', '', '', 0, '2012-02-10 07:25:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (200, 'Phùng Tiêu', '', '', '', 0, '2012-02-09 03:10:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (201, 'Huỳnh Nhật Quang', '', '', '', 0, '2012-02-10 03:15:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (202, 'Nguyễn Tiến', '', '', '', 0, '2012-02-09 03:34:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (203, 'Vũ Hoài Nam', '', '', '', 0, '2012-02-10 12:23:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (204, 'Lê Huyền Trang', '', '', '', 0, '2012-02-11 10:30:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (205, 'Phạm Bông Mai', '', '', '', 0, '2012-02-09 05:27:00', 34, 0, 1, 0, 1, '');
INSERT INTO `tbl_customer_hotdel` VALUES (206, 'Phan thu Trang', '', '01287974244', 'hà Nội', 0, '0000-00-00 00:00:00', 0, 0, 1, 0, 0, '');
INSERT INTO `tbl_customer_hotdel` VALUES (207, 'Nguyen Bao', '', '0937395359', '31B To ngoc Van Q12', 0, '0000-00-00 00:00:00', 0, 0, 1, 0, 0, '');
INSERT INTO `tbl_customer_hotdel` VALUES (208, 'nguyen anh tuan', '', '0977660187', 'QUang ninh', 0, '0000-00-00 00:00:00', 0, 0, 1, 0, 0, '');
INSERT INTO `tbl_customer_hotdel` VALUES (209, 'Nguyễn Văn Qúy', '', '0904860050', '35a, trần thái tông, cầu giấy, hà nội', 0, '0000-00-00 00:00:00', 0, 0, 1, 0, 0, '');
INSERT INTO `tbl_customer_hotdel` VALUES (210, 'ngockv@gmail.com', '', '0984561231', '18 Tam Trinh', 0, '0000-00-00 00:00:00', 0, 0, 1, 0, 0, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_hotdeal`
-- 

CREATE TABLE `tbl_hotdeal` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price_ny` int(11) NOT NULL,
  `price_hotdeal` int(11) NOT NULL,
  `muc_giam` int(11) NOT NULL,
  `discount` tinyint(4) NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_feauture` varchar(255) NOT NULL,
  `description` tinytext NOT NULL,
  `image` varchar(255) NOT NULL,
  `view` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `feauture` tinytext NOT NULL,
  `ct_name` varchar(255) NOT NULL,
  `ct_phone` varchar(20) NOT NULL,
  `ct_yahoo` varchar(100) NOT NULL,
  `ct_skype` varchar(100) NOT NULL,
  `published` tinyint(1) NOT NULL default '1',
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(100) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

-- 
-- Dumping data for table `tbl_hotdeal`
-- 

INSERT INTO `tbl_hotdeal` VALUES (1, 2435, 40, 0, 20000000, 9290000, 32, 'Macbook Air giảm giá cực số 128GB', 'Chíp đă năng lõi kép', 'Sản phẩm chỉ có tại xtech.vn, chương trình khuyến mãi được thể hiện bổ xung vào dịp tết, hãy nhanh tay, số lượng có hạn', '', 0, 0, '', '', '', '', '', 1, '2012-01-11 00:00:00', '2012-01-25 00:00:00', 0);
INSERT INTO `tbl_hotdeal` VALUES (2, 2473, 40, 0, 30000000, 8990000, 23, 'Macbook iMac khuyến mãi sock', 'Chip đă năng tính năg', 'Chỉ có tại Xtech.vn, giá cực kỳ hấp dẫn, các bạn hãy tham gia chương trình khuyến mãi của chúng tôi để trở thành người may mắn nhận giải thưởng này', '', 0, 0, '', '', '', '', '', 1, '2012-01-19 00:00:00', '2012-01-31 00:00:00', 0);
INSERT INTO `tbl_hotdeal` VALUES (4, 2166, 634, 0, 6000000, 999000, 14, 'Samsung B7610 giảm giá sock', 'Màn hình cảm ứng', 'Sản phẩm có tại xtech đang được khuyến mãi giảm giá, các bạn hãy nhanh tay mua hàng', '', 0, 0, '', '', '', '', '', 1, '2012-01-18 00:00:00', '2012-01-25 00:00:00', 0);
INSERT INTO `tbl_hotdeal` VALUES (23, 2708, 0, 5600000, 5400000, 200000, 4, 'Smartphone cao cấp', '', 'Chào mừng các cậu nhé', '', 0, 8, '', '', '', '', '', 1, '01/19/2012 03:10', '01/26/2012 04:19', 0);
INSERT INTO `tbl_hotdeal` VALUES (17, 2640, 35, 0, 2200000, 0, 0, 'Chương trình khuyến mãi PentaxQ', 'Đa năng', 'Sản phẩm chỉ được giảm giá tại xtech.v', '', 0, 0, '', 'Kiều Út Ngọc', '01643385050', 'boy_phong_luu105', 'kieuvanngocday', 1, '01/09/2012 07:30', '01/30/2012 05:26', 0);
INSERT INTO `tbl_hotdeal` VALUES (18, 3321, 35, 0, 6800000, 0, 0, 'Sản phẩm philips X501 khuyến mãi cực hot', 'Sản phẩm đặc trưng', 'Chương trình khuyến mãi chỉ có tại MBM và Xtech.vn, bạn hãy nhanh chân đến với chung tôi để có được sản phẩm', '', 0, 10, '', 'Kiều Văn Ngọc', '0978686055', 'kieuvanngoc105', 'kieu.van.ngoc', 1, '01/17/2012 17:13', '01/28/2012 04:10', 0);
INSERT INTO `tbl_hotdeal` VALUES (25, 2697, 17, 20000000, 18000000, 2000000, 10, 'Smartphone cao cấp', '', 'xdsafasfsafsaf', '', 0, 0, '', '', '', '', '', 1, '', '', 0);
INSERT INTO `tbl_hotdeal` VALUES (26, 3751, 17, 16500000, 12000000, 4500000, 27, 'Giảm giá Laptop cực kỳ sock', '', 'Hãy đến ngay với chúng tôi để có được sản phẩm giảm giá cực sock này', '', 0, 10, '', '', '', '', '', 1, '', '', 0);
INSERT INTO `tbl_hotdeal` VALUES (28, 2670, 35, 8600000, 3500000, 5100000, 59, 'Philips X116 giảm giá  socks', '', '', 'image/hotdeal/bestseller1.jpg', 0, 12, '', 'Kiều Văn Ngọc', '0978686055', 'kieuvanngoc105', 'kieu.van.ngoc', 1, '02/16/2012 00:00', '02/24/2012 00:00', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_menulevel1`
-- 

CREATE TABLE `tbl_menulevel1` (
  `mn_id` int(11) NOT NULL auto_increment COMMENT 'Mã menu cấp 1',
  `mn_name` varchar(40) collate utf8_unicode_ci NOT NULL default '',
  `mn_order` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`mn_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

-- 
-- Dumping data for table `tbl_menulevel1`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_menulevel2`
-- 

CREATE TABLE `tbl_menulevel2` (
  `submn_id` int(11) NOT NULL auto_increment COMMENT 'Mã menu cấp 2',
  `mn_id` int(11) NOT NULL default '0' COMMENT 'mã menu cấp 1',
  `submn_name` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `submn_order` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`submn_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

-- 
-- Dumping data for table `tbl_menulevel2`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_news`
-- 

CREATE TABLE `tbl_news` (
  `news_id` int(11) NOT NULL auto_increment,
  `news_title` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `news_sums` text collate utf8_unicode_ci NOT NULL,
  `news_details` text collate utf8_unicode_ci NOT NULL,
  `news_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `news_status` tinyint(1) NOT NULL default '0',
  `news_hot` tinyint(1) NOT NULL default '0',
  `news_img` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `news_cat` varchar(8) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;

-- 
-- Dumping data for table `tbl_news`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_newsmid`
-- 

CREATE TABLE `tbl_newsmid` (
  `newMid_id` int(11) NOT NULL auto_increment COMMENT 'Mã tin trung tâm',
  `newMid_title` varchar(200) collate utf8_unicode_ci NOT NULL default '' COMMENT 'Tiêu đề',
  `newMid_sums` text collate utf8_unicode_ci NOT NULL COMMENT 'Tóm tắt',
  `newMid_details` text collate utf8_unicode_ci NOT NULL COMMENT 'Chi tiết',
  `newMid_img` varchar(200) collate utf8_unicode_ci NOT NULL default '' COMMENT 'Ảnh',
  `newMid_status` tinyint(1) NOT NULL default '0' COMMENT 'Trạng thái cho hiển thị',
  `newMid_order` tinyint(4) NOT NULL default '0' COMMENT 'Vị trí xuất hiện',
  `newMid_date` timestamp NULL default NULL COMMENT 'Ngày đưa lên',
  PRIMARY KEY  (`newMid_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `tbl_newsmid`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_represent`
-- 

CREATE TABLE `tbl_represent` (
  `re_id` int(11) NOT NULL auto_increment,
  `re_sum` text collate utf8_unicode_ci NOT NULL,
  `re_content` text collate utf8_unicode_ci NOT NULL COMMENT 'nội dung giới thiê',
  `re_status` tinyint(1) NOT NULL default '0' COMMENT 'Trạng thái hiển thị hay Ko ?',
  PRIMARY KEY  (`re_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `tbl_represent`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_sites`
-- 

CREATE TABLE `tbl_sites` (
  `site_id` int(11) NOT NULL auto_increment,
  `site_type` tinyint(2) NOT NULL default '0' COMMENT '0: Site; 1: Users',
  `site_code` varchar(20) NOT NULL default '',
  `site_secure_secret` varchar(20) NOT NULL default '',
  `site_name` varchar(250) NOT NULL default '',
  `site_domain` varchar(100) NOT NULL default '',
  `site_phone` varchar(250) default '',
  `site_emails` varchar(500) NOT NULL default '',
  `site_qt_feename` varchar(50) NOT NULL default '',
  `site_qt_feeper` varchar(20) NOT NULL default '',
  `site_qt_feefix` varchar(20) NOT NULL default '',
  `site_nd_feename` varchar(50) NOT NULL default '',
  `site_nd_feeper` varchar(20) NOT NULL default '',
  `site_nd_feefix` varchar(20) NOT NULL default '',
  `site_merchant_qt_feename` varchar(50) NOT NULL default '',
  `site_merchant_qt_feeper` varchar(20) NOT NULL default '',
  `site_merchant_qt_feefix` varchar(20) NOT NULL default '',
  `site_merchant_nd_feename` varchar(50) NOT NULL default '',
  `site_merchant_nd_feeper` varchar(20) NOT NULL default '',
  `site_merchant_nd_feefix` varchar(20) NOT NULL default '',
  `site_mc_feename` varchar(50) NOT NULL default '',
  `site_mc_feeper` varchar(20) NOT NULL default '',
  `site_mc_feefix` varchar(20) NOT NULL default '',
  `site_use_coupon` tinyint(1) default '0',
  `site_coupon_fee` varchar(20) default '0',
  `site_shipping_allow` tinyint(2) default '0',
  `site_shipping_urban_fee` int(11) default '0',
  `site_shipping_suburb_fee` int(11) default '0',
  `site_payment_type` varchar(50) NOT NULL default '',
  `site_sendemail` tinyint(4) NOT NULL default '1',
  `site_redirect_uri` text,
  `site_client_id` varchar(20) NOT NULL default '',
  `site_publish` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`site_id`),
  UNIQUE KEY `site_id` (`site_id`),
  UNIQUE KEY `site_code` (`site_code`),
  UNIQUE KEY `site_code_2` (`site_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `tbl_sites`
-- 

INSERT INTO `tbl_sites` VALUES (1, 1, 'u1', '1234567890', 'Công Ty TNHH X-one', 'xone.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0', 0, 0, 0, '', 1, NULL, '', 1);
INSERT INTO `tbl_sites` VALUES (2, 1, 'u5', 'e646e6ebb36e0bafe690', 'CÔng ty ABC', 'http://enbac.com/Zshop', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0', 0, 0, 0, '', 1, NULL, '', 1);
INSERT INTO `tbl_sites` VALUES (3, 1, 'u13', '99ecbafca83cb156357f', 'Nguyễn Văn Chiến', 'http://enbac.com/sâfgas', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0', 0, 0, 0, '', 1, NULL, '', 1);
INSERT INTO `tbl_sites` VALUES (4, 1, 'u20', '6b3c55b9160e7becfcdd', 'CTY ACHT', 'http://enbac.com/savc', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0', 0, 0, 0, '', 1, NULL, '', 1);
INSERT INTO `tbl_sites` VALUES (5, 1, 'u21', 'f51ca622bff53472746c', 'Công ty CP XNK MBM', 'xtech.vn', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0', 0, 0, 0, '', 1, NULL, '', 1);
INSERT INTO `tbl_sites` VALUES (6, 1, 'u22', '8c5d76a75ad3228ba821', 'Công ty CP XNK MBM', 'xtech.vn', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0', 0, 0, 0, '', 1, NULL, '', 1);
INSERT INTO `tbl_sites` VALUES (7, 1, 'u23', '7e83349ce1759d9a12f9', 'Công ty CP XNK MBM', 'xtech.vn', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0', 0, 0, 0, '', 1, NULL, '', 1);
INSERT INTO `tbl_sites` VALUES (8, 1, 'u24', '7741bfbe33fa9085e19e', 'Công ty CP XNK MBM', 'xtech.vn', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0', 0, 0, 0, '', 1, NULL, '', 1);
INSERT INTO `tbl_sites` VALUES (9, 1, 'u25', '228faac260460a549900', 'Công ty CP XNK MBM', 'xtech.vn', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0', 0, 0, 0, '', 1, NULL, '', 1);
INSERT INTO `tbl_sites` VALUES (10, 1, 'u26', 'ca3bb675745d72579487', 'Công ty CP XNK MBM', 'xtech.vn', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0', 0, 0, 0, '', 1, NULL, '', 1);
INSERT INTO `tbl_sites` VALUES (11, 1, 'u37', 'd4815cd2275a638db3c9', 'MBM', 'http://enbac.com/savc', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0', 0, 0, 0, '', 1, NULL, '', 1);
INSERT INTO `tbl_sites` VALUES (12, 1, 'u40', 'd088bba0c5383bf63ca9', 'Công Ty CP XNK XONE', 'http://xonejone.vn', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '0', 0, 0, 0, '', 1, NULL, '', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_subscribe`
-- 

CREATE TABLE `tbl_subscribe` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(100) NOT NULL default '',
  `status` tinyint(1) default '1',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tbl_subscribe`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_subscribe_content`
-- 

CREATE TABLE `tbl_subscribe_content` (
  `id` int(11) NOT NULL auto_increment,
  `subject` varchar(255) NOT NULL default '',
  `body` text,
  `send_number` int(11) NOT NULL default '0',
  `status` tinyint(4) default '0',
  `time_start` int(11) default '0',
  `time_end` int(11) default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tbl_subscribe_content`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_voting_ip`
-- 

CREATE TABLE `tbl_voting_ip` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `session_id` varchar(100) NOT NULL,
  `ip_add` varchar(40) NOT NULL,
  `value` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `tbl_voting_ip`
-- 

INSERT INTO `tbl_voting_ip` VALUES (1, '86c0e540f33d1faaf950e8b840262dd9', '127.0.0.1', 5);
INSERT INTO `tbl_voting_ip` VALUES (2, '961fb1261a4f713cb4f13050a2899303', '127.0.0.1', 4);
INSERT INTO `tbl_voting_ip` VALUES (3, 'b04a8c7c71c08c72cc1b40b72a37bd0b', '127.0.0.1', 5);
