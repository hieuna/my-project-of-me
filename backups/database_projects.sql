-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 27, 2012 at 06:06 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `database_projects`
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
-- Table structure for table `tbl_categories`
-- 

CREATE TABLE `tbl_categories` (
  `category_id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  `ordering` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY  (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `tbl_categories`
-- 

INSERT INTO `tbl_categories` VALUES (1, 'Quần áo Nam', 'Quan-ao-Nam', 'Quần áo nam', 1, 0, '2012-02-23 05:21:35', 1, 0);
INSERT INTO `tbl_categories` VALUES (2, 'Quần áo nữ', 'Quan-ao-nu', 'Quần áo nữ', 1, 0, '2012-02-23 05:21:50', 1, 0);
INSERT INTO `tbl_categories` VALUES (3, 'Váy cho trẻ 5 tuổi', 'Vay-cho-tre-5-tuoi', 'Váy cho trẻ 5 tuổi', 1, 0, '2012-02-23 05:22:04', 1, 0);
INSERT INTO `tbl_categories` VALUES (4, 'Áo sơ mi cho trẻ nam', 'Ao-so-mi-cho-tre-nam', 'Áo sơ mi cho trẻ 5 tuổi', 1, 0, '2012-02-23 05:22:20', 1, 4);
INSERT INTO `tbl_categories` VALUES (5, 'Áo bông cho trẻ', 'Ao-bong-cho-tre', 'Áo bông cho trẻ', 1, 0, '2012-02-23 05:43:41', 1, 2);

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

INSERT INTO `tbl_hotdeal` VALUES (1, 2435, 40, 0, 20000000, 9290000, 32, 'Macbook Air giảm giá cực số 128GB', 'Chíp đă năng lõi kép', 'Sản phẩm chỉ có tại xtech.vn, chương trình khuyến mãi được thể hiện bổ xung vào dịp tết, hãy nhanh tay, số lượng có hạn', '', 0, 0, '', '', '', '', '', 0, '2012-01-11 00:00:00', '2012-01-25 00:00:00', 0);
INSERT INTO `tbl_hotdeal` VALUES (2, 2473, 40, 0, 30000000, 8990000, 23, 'Macbook iMac khuyến mãi sock', 'Chip đă năng tính năg', 'Chỉ có tại Xtech.vn, giá cực kỳ hấp dẫn, các bạn hãy tham gia chương trình khuyến mãi của chúng tôi để trở thành người may mắn nhận giải thưởng này', '', 0, 0, '', '', '', '', '', 0, '2012-01-19 00:00:00', '2012-01-31 00:00:00', 0);
INSERT INTO `tbl_hotdeal` VALUES (4, 2166, 634, 0, 6000000, 999000, 14, 'Samsung B7610 giảm giá sock', 'Màn hình cảm ứng', 'Sản phẩm có tại xtech đang được khuyến mãi giảm giá, các bạn hãy nhanh tay mua hàng', '', 0, 0, '', '', '', '', '', 0, '2012-01-18 00:00:00', '2012-01-25 00:00:00', 0);
INSERT INTO `tbl_hotdeal` VALUES (23, 2708, 0, 0, 0, 0, 0, 'Smartphone cao cấp', '', 'Chào mừng các cậu nhé', '', 0, 0, '', '', '', '', '', 1, '2012-02-27 12:22:06', '2012-02-28 12:22:06', 0);
INSERT INTO `tbl_hotdeal` VALUES (17, 2640, 35, 0, 2200000, 0, 0, 'Chương trình khuyến mãi PentaxQ', 'Đa năng', 'Sản phẩm chỉ được giảm giá tại xtech.v', '', 0, 0, '', 'Kiều Út Ngọc', '01643385050', 'boy_phong_luu105', 'kieuvanngocday', 0, '01/09/2012 07:30', '01/30/2012 05:26', 0);
INSERT INTO `tbl_hotdeal` VALUES (18, 3321, 35, 0, 6800000, 0, 0, 'Sản phẩm philips X501 khuyến mãi cực hot', 'Sản phẩm đặc trưng', 'Chương trình khuyến mãi chỉ có tại MBM và Xtech.vn, bạn hãy nhanh chân đến với chung tôi để có được sản phẩm', '', 0, 10, '', 'Kiều Văn Ngọc', '0978686055', 'kieuvanngoc105', 'kieu.van.ngoc', 0, '01/17/2012 17:13', '01/28/2012 04:10', 0);
INSERT INTO `tbl_hotdeal` VALUES (25, 2697, 17, 0, 0, 0, 0, 'Smartphone cao cấp', '', 'xdsafasfsafsaf', '', 0, 0, '', '', '', '', '', 0, '2012-02-28 12:33:05', '', 0);
INSERT INTO `tbl_hotdeal` VALUES (26, 3751, 17, 0, 0, 0, 0, 'Giảm giá Laptop cực kỳ sock', '', 'Hãy đến ngay với chúng tôi để có được sản phẩm giảm giá cực sock này', '', 0, 0, '', '', '', '', '', 1, '2012-02-27 02:31:48', '2012-02-28 02:31:48', 0);
INSERT INTO `tbl_hotdeal` VALUES (28, 2670, 35, 0, 0, 0, 0, 'Philips X116 giảm giá  socks', '', '', 'image/hotdeal/bestseller1.jpg', 0, 0, '', 'Kiều Văn Ngọc', '0978686055', 'kieuvanngoc105', 'kieu.van.ngoc', 1, '2012-02-27 12:19:06', '2012-02-28 12:19:06', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_menu`
-- 

CREATE TABLE `tbl_menu` (
  `menu_id` int(10) unsigned NOT NULL auto_increment,
  `menutype` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  `parent_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY  (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

-- 
-- Dumping data for table `tbl_menu`
-- 

INSERT INTO `tbl_menu` VALUES (1, '3', 'Thời trang bé Gái', 'Thoi-trang-be-Gai', 'index.php?dispatch=category.view&category_id=2', 'category', 1, 0, 1);
INSERT INTO `tbl_menu` VALUES (2, '3', 'Thời trang bé Trai', 'Thoi-trang-be-Trai', 'index.php?dispatch=category.view&category_id=1', 'category', 1, 0, 1);
INSERT INTO `tbl_menu` VALUES (3, '3', 'Thời trang Baby Gap', 'Thoi-trang-Baby-Gap', 'index.php?dispatch=category.view&category_id=4', 'category', 1, 0, 1);
INSERT INTO `tbl_menu` VALUES (4, '3', 'Thời trang sơ sinh', 'Thoi-trang-so-sinh', 'index.php?option=com_order&task=order', 'category', 1, 0, 0);
INSERT INTO `tbl_menu` VALUES (5, '3', 'Quần Chip', 'Quan-Chip', 'index.php?dispatch=product.view&product_id=20', 'product', 1, 0, 0);
INSERT INTO `tbl_menu` VALUES (6, '3', 'Áo Khoác', 'Ao-khoac', 'index.php?dispatch=product.view&product_id=19', 'product', 1, 0, 0);
INSERT INTO `tbl_menu` VALUES (7, '3', 'Áo Mưa', 'Ao-Mua', 'index.php?dispatch=product.view&product_id=19', 'product', 1, 0, 0);
INSERT INTO `tbl_menu` VALUES (8, '3', 'Chăn - Khăn', 'Chan-Khan', 'index.php?dispatch=product.view&product_id=10', 'product', 1, 0, 0);
INSERT INTO `tbl_menu` VALUES (9, '3', 'Kẹp tóc', 'Kep-toc', 'index.php?dispatch=product.view&product_id=24', 'product', 1, 0, 0);
INSERT INTO `tbl_menu` VALUES (10, '3', 'Nón - Mắt Kính', 'Non-Mat-Kinh', 'index.php?dispatch=product.view&product_id=16', 'product', 1, 0, 0);
INSERT INTO `tbl_menu` VALUES (11, '3', 'Ba lô', 'Ba-lo', 'index.php?dispatch=product.view&product_id=10', 'product', 1, 0, 0);
INSERT INTO `tbl_menu` VALUES (12, '3', 'Tất Chân', 'Tat-Chan', 'index.php?dispatch=product.view&product_id=24', 'product', 1, 0, 0);
INSERT INTO `tbl_menu` VALUES (13, '3', 'Giày - Dép', 'Giay-Dep', 'index.php?dispatch=product.view&product_id=24', 'product', 1, 0, 0);
INSERT INTO `tbl_menu` VALUES (14, '3', 'Phụ Kiện Sơ Sinh', 'Phu-Kien-So-Sinh', 'index.php?dispatch=category.view&category_id=1', 'category', 1, 0, 0);
INSERT INTO `tbl_menu` VALUES (15, '3', 'Body sơ sinh', 'Body-so-sinh', 'index.php?dispatch=product.view&product_id=18', 'product', 1, 0, 0);
INSERT INTO `tbl_menu` VALUES (16, '3', 'Quần áo sơ sinh', 'Quan-ao-so-sinh', 'index.php?dispatch=category.view&category_id=5', 'category', 1, 4, 0);
INSERT INTO `tbl_menu` VALUES (17, '3', 'Váy cao cấp', 'Vay-cao-cap', 'index.php?dispatch=product.view&product_id=10', 'product', 1, 0, 0);
INSERT INTO `tbl_menu` VALUES (18, '3', 'Váy', 'Vay', 'index.php?dispatch=product.view&product_id=24', 'product', 1, 0, 0);
INSERT INTO `tbl_menu` VALUES (19, '3', 'Áo', 'Ao', 'index.php?dispatch=product.view&product_id=20', 'product', 1, 0, 0);
INSERT INTO `tbl_menu` VALUES (20, '3', 'Quần', 'Quan', 'index.php?dispatch=category.view&category_id=2', 'category', 1, 0, 0);
INSERT INTO `tbl_menu` VALUES (21, '3', 'Đồ Bộ', 'Do-Bo', 'index.php?dispatch=product.view&product_id=18', 'product', 1, 1, 0);
INSERT INTO `tbl_menu` VALUES (22, '3', 'Đồ tắm', 'Do-tam', 'index.php?dispatch=product.view&product_id=18', 'product', 1, 1, 0);
INSERT INTO `tbl_menu` VALUES (23, '3', 'Quần áo nhỏ nam', 'Quan-ao-nho-nam', 'index.php?dispatch=category.view&category_id=1', 'category', 1, 2, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_menutype`
-- 

CREATE TABLE `tbl_menutype` (
  `menutype_id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`menutype_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `tbl_menutype`
-- 

INSERT INTO `tbl_menutype` VALUES (2, 'MenuTop', 1);
INSERT INTO `tbl_menutype` VALUES (3, 'menuLeft', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_products`
-- 

CREATE TABLE `tbl_products` (
  `product_id` int(11) unsigned NOT NULL auto_increment,
  `code` varchar(50) NOT NULL,
  `model` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `price_ny` float NOT NULL,
  `amount` mediumint(9) NOT NULL,
  `weight` decimal(10,0) NOT NULL,
  `length` mediumint(9) NOT NULL,
  `width` mediumint(9) NOT NULL,
  `height` mediumint(9) NOT NULL,
  `number_color` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  `ordering` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `admin_created` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `admin_modified` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY  (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- 
-- Dumping data for table `tbl_products`
-- 

INSERT INTO `tbl_products` VALUES (1, 'UDQLU', '0', 150000, 200000, 10, 0, 20, 5, 2, 3, 1, 0, '2012-02-23 02:07:15', 1, '2012-02-26 03:58:16', 1, 2);
INSERT INTO `tbl_products` VALUES (2, 'ASM05', '20gam', 380000, 420000, 10, 0, 20, 5, 3, 6, 1, 0, '2012-02-23 02:10:51', 1, '2012-02-26 04:00:14', 1, 1);
INSERT INTO `tbl_products` VALUES (26, 'CS01', '0', 420000, 450000, 30, 0, 20, 5, 30, 5, 1, 0, '2012-02-26 12:46:27', 1, '2012-02-27 05:57:49', 1, 2);
INSERT INTO `tbl_products` VALUES (10, 'AQN', '10gam', 520000, 560000, 50, 0, 20, 15, 2, 10, 1, 0, '2012-02-23 02:30:44', 1, '2012-02-26 04:04:15', 1, 1);
INSERT INTO `tbl_products` VALUES (25, 'CS01', '0', 420000, 450000, 30, 0, 20, 5, 30, 2, 1, 0, '2012-02-26 12:46:27', 1, '2012-02-27 05:34:54', 1, 2);
INSERT INTO `tbl_products` VALUES (24, 'VDD', '0', 420000, 460000, 20, 0, 20, 6, 30, 2, 1, 0, '2012-02-26 10:46:49', 1, '2012-02-27 05:34:30', 1, 2);
INSERT INTO `tbl_products` VALUES (16, 'ÀGGS', '0', 250000, 0, 0, 0, 0, 0, 0, 2, 1, 0, '2012-02-23 02:30:44', 1, '2012-02-26 04:04:56', 1, 5);
INSERT INTO `tbl_products` VALUES (18, 'ADGH', '0', 300000, 350000, 0, 0, 0, 0, 0, 2, 1, 0, '2012-02-23 02:38:19', 1, '2012-02-26 04:05:26', 1, 4);
INSERT INTO `tbl_products` VALUES (19, 'AB45', '0', 380000, 0, 20, 0, 130, 30, 2, 2, 1, 0, '0000-00-00 00:00:00', 1, '2012-02-26 10:44:43', 1, 5);
INSERT INTO `tbl_products` VALUES (20, 'ATT01', '0', 400000, 450000, 15, 0, 1, 50, 2, 3, 1, 0, '0000-00-00 00:00:00', 1, '2012-02-27 05:48:38', 1, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_products_color`
-- 

CREATE TABLE `tbl_products_color` (
  `color_id` bigint(20) unsigned NOT NULL auto_increment,
  `product_id` int(10) unsigned NOT NULL,
  `name_color` varchar(100) NOT NULL,
  `value_color` varchar(100) NOT NULL,
  `price_color` float NOT NULL,
  `show_color` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`color_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=202 ;

-- 
-- Dumping data for table `tbl_products_color`
-- 

INSERT INTO `tbl_products_color` VALUES (1, 21, '00ff00', '#00ff00', 0, 0);
INSERT INTO `tbl_products_color` VALUES (2, 21, '00ff00', '#00ff00', 0, 0);
INSERT INTO `tbl_products_color` VALUES (3, 21, '00ff00', '#00ff00', 0, 0);
INSERT INTO `tbl_products_color` VALUES (201, 26, '', '', 0, 1);
INSERT INTO `tbl_products_color` VALUES (93, 24, '', '', 0, 1);
INSERT INTO `tbl_products_color` VALUES (200, 26, '417d41', '417d41', 0, 1);
INSERT INTO `tbl_products_color` VALUES (199, 26, '6200ff', '6200ff', 0, 1);
INSERT INTO `tbl_products_color` VALUES (198, 26, 'f08a88', 'f08a88', 0, 1);
INSERT INTO `tbl_products_color` VALUES (197, 26, '304be3', '304be3', 0, 1);
INSERT INTO `tbl_products_color` VALUES (48, 1, 'b2ccb2', 'b2ccb2', 135000, 1);
INSERT INTO `tbl_products_color` VALUES (95, 25, '', '', 0, 1);
INSERT INTO `tbl_products_color` VALUES (94, 25, '24fc24', '24fc24', 270000, 1);
INSERT INTO `tbl_products_color` VALUES (49, 1, '0e450e', '0e450e', 145000, 1);
INSERT INTO `tbl_products_color` VALUES (50, 1, '303630', '303630', 140000, 1);
INSERT INTO `tbl_products_color` VALUES (51, 2, '36ad36', '36ad36', 350000, 1);
INSERT INTO `tbl_products_color` VALUES (52, 2, 'b6c4b6', 'b6c4b6', 330000, 1);
INSERT INTO `tbl_products_color` VALUES (53, 2, '5e665e', '5e665e', 335000, 1);
INSERT INTO `tbl_products_color` VALUES (54, 2, '1d1f1d', '1d1f1d', 290000, 1);
INSERT INTO `tbl_products_color` VALUES (55, 2, '962744', '962744', 400000, 1);
INSERT INTO `tbl_products_color` VALUES (56, 2, '0e074a', '0e074a', 355000, 1);
INSERT INTO `tbl_products_color` VALUES (57, 10, 'dfe8df', 'dfe8df', 500000, 1);
INSERT INTO `tbl_products_color` VALUES (58, 10, '848784', '848784', 550000, 1);
INSERT INTO `tbl_products_color` VALUES (59, 10, '515451', '515451', 580000, 1);
INSERT INTO `tbl_products_color` VALUES (60, 10, '191a19', '191a19', 520000, 1);
INSERT INTO `tbl_products_color` VALUES (61, 10, '58b058', '58b058', 515000, 1);
INSERT INTO `tbl_products_color` VALUES (62, 10, 'b869b0', 'b869b0', 520000, 1);
INSERT INTO `tbl_products_color` VALUES (63, 10, '4f294d', '4f294d', 480000, 1);
INSERT INTO `tbl_products_color` VALUES (64, 10, '400a3b', '400a3b', 450000, 1);
INSERT INTO `tbl_products_color` VALUES (65, 10, 'f0fc85', 'f0fc85', 450000, 1);
INSERT INTO `tbl_products_color` VALUES (66, 10, 'ffd900', 'ffd900', 440000, 1);
INSERT INTO `tbl_products_color` VALUES (70, 16, '', '', 0, 1);
INSERT INTO `tbl_products_color` VALUES (69, 16, '3c543c', '3c543c', 220000, 1);
INSERT INTO `tbl_products_color` VALUES (71, 18, '3ac43a', '3ac43a', 280000, 1);
INSERT INTO `tbl_products_color` VALUES (72, 18, '717371', '717371', 250000, 1);
INSERT INTO `tbl_products_color` VALUES (146, 20, '', '', 0, 1);
INSERT INTO `tbl_products_color` VALUES (145, 20, 'b8c4b8', 'b8c4b8', 330000, 1);
INSERT INTO `tbl_products_color` VALUES (144, 20, '27b027', '27b027', 350000, 1);
INSERT INTO `tbl_products_color` VALUES (92, 24, '449144', '449144', 425000, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_products_description`
-- 

CREATE TABLE `tbl_products_description` (
  `product_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `introtext` tinytext NOT NULL,
  `fulltext` text NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `search_words` text NOT NULL,
  `page_title` varchar(255) NOT NULL,
  PRIMARY KEY  (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- 
-- Dumping data for table `tbl_products_description`
-- 

INSERT INTO `tbl_products_description` VALUES (1, 'Sản phẩm cho bé gái', 'San-pham-cho-be-gai', 'Sản phẩm đặc trưng', '<p>Sản phẩm cạo r&acirc;u</p>', 'Chao cac ban', 'vay', 'váy', 'Váy cho trẻ nhỏ');
INSERT INTO `tbl_products_description` VALUES (2, 'Áo sơ mi cho trẻ nam', 'Ao-so-mi-cho-tre-nam', '', '<p>ấfasfa</p>', 'fasf', '', '', '');
INSERT INTO `tbl_products_description` VALUES (3, '', '', '', '', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (4, '', '', '', '', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (5, '', '', '', '', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (6, '', '', '', '', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (7, '', '', '', '', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (8, '', '', '', '', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (9, '', '', '', '', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (10, 'Công sở cho nam giới', 'cong-so-cho-nam-gioi', 'Quần áo công sở cho nam giới', '<p>Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới</p>\r\n<p>Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới<br />&nbsp;</p>\r\n<p>Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới Quần &aacute;o c&ocirc;ng sở cho nam giới<br /> </p>', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (11, '', '', '', '', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (12, '', '', '', '', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (13, '', '', '', '', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (14, '', '', '', '', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (15, '', '', '', '', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (16, 'Áo cho trẻ nhỏ', 'Ao-cho-tre-nho', '', '', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (17, '', '', '', '', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (18, 'Áo sơm mi nam', 'san-pham', 'san pham', '<p>San pham cong nbghe</p>', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (19, 'áO bông cho trẻ nhỏ', 'aO-bong-cho-tre-nho', 'Chào bạn', '<p>Ch&agrave;o c&aacute;c bạn</p>', 'Từ khóa', 'Mô tả từ khóa', 'TỪ khóa tìm kiếm', 'Tiều đề trang');
INSERT INTO `tbl_products_description` VALUES (20, 'Quần áo thời trang cho nữ', 'Quan-ao-thoi-trang-cho-nu', 'Quần áo thời trang cho nữ giới', '<p>Bộ quần &aacute;o thời trang trẻ trung v&agrave; năng động cho nữ giới</p>', 'quan ao, thoi trang, nu gioi', 'Quần áo, thời trang, nữ giới, quần áo nữ', 'thời trang', 'Quần áo thời trang');
INSERT INTO `tbl_products_description` VALUES (21, '', '', '', '', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (22, '', '', '', '', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (23, '', '', '', '', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (24, 'Bộ váy đầm rất đẹp', 'Bo-vay-dam-rat-dep', 'Bộ váy đầm rất đẹp và rất thời trang', '<p>Bộ v&aacute;y đầm rất đẹp v&agrave; rất thời trang</p>', 'Váy, đầm, vay, dam', 'Váy thời trang, đầm thời trang', 'váy, đầm', 'Váy đầm thời trang');
INSERT INTO `tbl_products_description` VALUES (25, 'Thời trang cho bé', 'Thoi-trang-cho be', 'Thời trang công sở', '<p>Thời trang c&ocirc;ng sở của ch&uacute;ng t&ocirc;i</p>', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (26, 'Thời trang công sở', 'Thoi-trang-cong-so', 'Thời trang công sở', '<p>Thời trang c&ocirc;ng sở của ch&uacute;ng t&ocirc;i</p>', '', '', '', '');
INSERT INTO `tbl_products_description` VALUES (27, 'sdgsdgdsgds', 'sdgsdgdsgds', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_products_discount`
-- 

CREATE TABLE `tbl_products_discount` (
  `product_id` int(11) unsigned NOT NULL auto_increment,
  `discount` float NOT NULL,
  `percent` int(11) NOT NULL,
  PRIMARY KEY  (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- 
-- Dumping data for table `tbl_products_discount`
-- 

INSERT INTO `tbl_products_discount` VALUES (24, 380000, 10);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_products_feauture`
-- 

CREATE TABLE `tbl_products_feauture` (
  `feature_id` bigint(20) unsigned NOT NULL auto_increment,
  `feature_type` varchar(1) NOT NULL,
  `feature_name` varchar(255) NOT NULL,
  `categories_path` text NOT NULL,
  `parent_id` mediumint(9) NOT NULL,
  `display_on_product` tinyint(1) NOT NULL default '1',
  `display_on_catalog` tinyint(1) NOT NULL default '1',
  `status` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`feature_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tbl_products_feauture`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_products_group`
-- 

CREATE TABLE `tbl_products_group` (
  `product_id` int(10) unsigned NOT NULL auto_increment,
  `is_new` tinyint(1) NOT NULL,
  `is_hot` tinyint(1) NOT NULL,
  `is_special` tinyint(1) NOT NULL,
  `is_seller` tinyint(1) NOT NULL,
  `is_upcoming` tinyint(1) NOT NULL,
  `is_stock` tinyint(1) NOT NULL default '1',
  `is_view` tinyint(1) NOT NULL,
  PRIMARY KEY  (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- 
-- Dumping data for table `tbl_products_group`
-- 

INSERT INTO `tbl_products_group` VALUES (24, 0, 1, 1, 0, 1, 1, 0);
INSERT INTO `tbl_products_group` VALUES (25, 0, 1, 0, 1, 0, 0, 0);
INSERT INTO `tbl_products_group` VALUES (26, 0, 1, 1, 1, 0, 0, 0);
INSERT INTO `tbl_products_group` VALUES (20, 1, 1, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_products_image`
-- 

CREATE TABLE `tbl_products_image` (
  `product_id` int(10) unsigned NOT NULL auto_increment,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `image4` varchar(255) NOT NULL,
  `image5` varchar(255) NOT NULL,
  PRIMARY KEY  (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- 
-- Dumping data for table `tbl_products_image`
-- 

INSERT INTO `tbl_products_image` VALUES (1, 'image/products/ivyn1.jpg', 'image/products/1295409962_158833657_3-chuyen-phan-phoi-quan-ao-thi-trang-ngoai-nhap-gia-s-Quan-ao.jpg', 'image/products/2086811660104689848S425x425Q85.jpg', 'image/products/thumb_img.php.jpg', 'image/products/1295409962_158833657_1-Hinh-anh-ca--chuyen-phan-phoi-quan-ao-thi-trang-ngoai-nhap-gia-s.jpg');
INSERT INTO `tbl_products_image` VALUES (2, 'image/products/16792463_2.jpg', 'image/products/1295409962_158833657_1-Hinh-anh-ca--chuyen-phan-phoi-quan-ao-thi-trang-ngoai-nhap-gia-s.jpg', 'image/products/1307351558_213395870_2-quan-ao-nu-thi-trang-Ha-Noi.jpg', 'image/products/ivyn1.jpg', 'image/products/thoitranghe2.jpg');
INSERT INTO `tbl_products_image` VALUES (3, '', '', '', '', '');
INSERT INTO `tbl_products_image` VALUES (4, '', '', '', '', '');
INSERT INTO `tbl_products_image` VALUES (5, '', '', '', '', '');
INSERT INTO `tbl_products_image` VALUES (6, '', '', '', '', '');
INSERT INTO `tbl_products_image` VALUES (7, '', '', '', '', '');
INSERT INTO `tbl_products_image` VALUES (8, '', '', '', '', '');
INSERT INTO `tbl_products_image` VALUES (9, '', '', '', '', '');
INSERT INTO `tbl_products_image` VALUES (10, 'image/products/1271994316-yoon-eun-hye.jpg', 'image/products/1297918601_21111676_1-Hinh-anh-ca--Quan-ao-mua-he-qua-dp-gia-re-nhat-thi-trung.jpg', 'image/products/1297918601_21111676_3-Quan-ao-mua-he-qua-dp-gia-re-nhat-thi-trung-Quan-ao.jpg', 'image/products/1276164730_99021333_1-Hinh-anh-ca--Ban-S-Quan-ao-Thi-Trang-Ngoai-Nhap-12k-15k18k25k-1276164730.jpg', 'image/products/meo.jpg');
INSERT INTO `tbl_products_image` VALUES (11, '', '', '', '', '');
INSERT INTO `tbl_products_image` VALUES (12, '', '', '', '', '');
INSERT INTO `tbl_products_image` VALUES (13, '', '', '', '', '');
INSERT INTO `tbl_products_image` VALUES (14, '', '', '', '', '');
INSERT INTO `tbl_products_image` VALUES (15, '', '', '', '', '');
INSERT INTO `tbl_products_image` VALUES (16, 'image/products/meo.jpg', 'image/products/1276164730_99021333_1-Hinh-anh-ca--Ban-S-Quan-ao-Thi-Trang-Ngoai-Nhap-12k-15k18k25k-1276164730.jpg', 'image/products/1297918601_21111676_3-Quan-ao-mua-he-qua-dp-gia-re-nhat-thi-trung-Quan-ao.jpg', 'image/products/1276164730_99021333_1-Hinh-anh-ca--Ban-S-Quan-ao-Thi-Trang-Ngoai-Nhap-12k-15k18k25k-1276164730.jpg', 'image/products/1271994316-yoon-eun-hye.jpg');
INSERT INTO `tbl_products_image` VALUES (17, '', '', '', '', '');
INSERT INTO `tbl_products_image` VALUES (18, 'image/products/1271994316-yoon-eun-hye.jpg', 'image/products/1276164730_99021333_1-Hinh-anh-ca--Ban-S-Quan-ao-Thi-Trang-Ngoai-Nhap-12k-15k18k25k-1276164730.jpg', 'image/products/1297918601_21111676_1-Hinh-anh-ca--Quan-ao-mua-he-qua-dp-gia-re-nhat-thi-trung.jpg', 'image/products/1297918601_21111676_3-Quan-ao-mua-he-qua-dp-gia-re-nhat-thi-trung-Quan-ao.jpg', 'image/products/meo.jpg');
INSERT INTO `tbl_products_image` VALUES (19, 'image/products/16792463_2.jpg', 'image/products/1307351558_213395870_2-quan-ao-nu-thi-trang-Ha-Noi.jpg', 'image/products/thumb_img.php.jpg', 'image/products/1297955149_167938277_3-Ban-buon-quan-ao-thi-trang-nu-cong-so-dao-pho-Quan-ao.jpg', 'image/products/2086811660104689848S425x425Q85.jpg');
INSERT INTO `tbl_products_image` VALUES (20, 'image/products/254807q.jpg', 'image/products/1271994316-yoon-eun-hye--1-.jpg', 'image/products/1288171257_132432803_1-Hinh-anh-ca--Ban-S-QUN-aO-THI-TRANG-0932906060-1288171257.jpg', 'image/products/12942966692048467137_574_574.jpg', 'image/products/thoi-trang-cong-so-011.jpg');
INSERT INTO `tbl_products_image` VALUES (21, '', '', '', '', '');
INSERT INTO `tbl_products_image` VALUES (22, '', '', '', '', '');
INSERT INTO `tbl_products_image` VALUES (23, '', '', '', '', '');
INSERT INTO `tbl_products_image` VALUES (24, 'image/products/Bo-vay-dam-rat-dep-1330332302-image1.jpg', 'image/products/Bo-vay-dam-rat-dep-1330332302-image2.jpg', 'image/products/Bo-vay-dam-rat-dep-1330332302-image3.gif.jpg', 'image/products/Bo-vay-dam-rat-dep-1330332302-image4.jpg', 'image/products/Bo-vay-dam-rat-dep-1330332302-image5.jpg');
INSERT INTO `tbl_products_image` VALUES (25, 'image/products/1275384756-thoi-trang-cong-so-quan-092.jpg', 'image/products/65069427-small_71764.jpg', 'image/products/thoi-trang-cong-so.jpg', 'image/products/yku1304564013.jpg', 'image/products/thoitranghe2.jpg');
INSERT INTO `tbl_products_image` VALUES (26, 'image/products/1275384756-thoi-trang-cong-so-quan-092.jpg', 'image/products/65069427-small_71764.jpg', 'image/products/thoi-trang-cong-so.jpg', 'image/products/yku1304564013.jpg', 'image/products/thoitranghe2.jpg');
INSERT INTO `tbl_products_image` VALUES (27, 'image/products/1271350735_88120270_3-Thi-trang-cong-so-V-Style-Nhan-dat-may-va-thiet-ke-thi-trang-chuyen-nghiep-Quan-ao-1271350735.jpg', '', '', '', '');

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
