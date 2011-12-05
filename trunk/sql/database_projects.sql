-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Dec 06, 2011 at 12:05 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `database_projects`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `admins`
-- 

CREATE TABLE `admins` (
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
  `admin_registerDate` datetime default '0000-00-00 00:00:00',
  `admin_lastvisitDate` datetime default '0000-00-00 00:00:00',
  `admin_enabled` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`admin_id`),
  UNIQUE KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

-- 
-- Dumping data for table `admins`
-- 

INSERT INTO `admins` VALUES (1, 'Kiều Văn Ngọc', 'ngockieuvan@vccorp.vn', 'kieuvanngoc', 'f87f21bcc22272d63e275103bf194ca3', 1, 'A2OLyR4BizBmAhLT', 1, '', 1, '0000-00-00 00:00:00', '2011-11-29 10:40:29', 1);
INSERT INTO `admins` VALUES (2, 'Nguyễn Văn Tuấn', 'tuannguyenvan@vccorp.vn', 'tuannguyenvan', '23f25cc180d966535f3c79c1ee6a353c', 1, 'A2OLyR4BizBmAhLT', 1, '', 1, '2010-10-01 14:26:22', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (3, 'Nguyễn Tuyết Nhung', 'nhungnguyentuyet@vccorp.vn', 'nhungnguyentuyet', '324dbe4b8a62719bbc2d785d68de8b1c', 1, 'A2OLyR4BizBmAhLT', 2, 'a:2:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:2:{i:0;s:1:"5";i:1;s:1:"7";}}', 1, '2010-10-01 14:33:14', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (4, 'Phạm Thị Huế', 'huephamthi@vccorp.vn', 'huephamthi', '324dbe4b8a62719bbc2d785d68de8b1c', 1, 'A2OLyR4BizBmAhLT', 3, 'a:2:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:2:{i:0;s:1:"5";i:1;s:1:"7";}}', 1, '2010-10-01 14:42:16', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (6, 'Lý Mạnh Hà', 'halymanh@vccorp.vn', 'halymanh', '324dbe4b8a62719bbc2d785d68de8b1c', 1, 'A2OLyR4BizBmAhLT', 3, 'a:2:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:2:{i:0;s:1:"5";i:1;s:1:"7";}}', 1, '2010-10-05 11:23:09', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (7, 'Hiếu', 'hieutranvan@vccorp.vn', 'hieutranvan', '8b25e0500479ad9f5664d985bc916752', 1, 'A2OLyR4BizBmAhLT', 1, '', 1, '2010-10-11 16:58:37', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (8, 'Kế toán', 'ketoan@vccorp.vn', 'ketoanvcc', 'ed4f1f65610ff3a2ab8c84c95dceb6c4', 1, 'A2OLyR4BizBmAhLT', 3, 'a:3:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:3:{i:0;s:1:"5";i:1;s:1:"7";i:2;s:2:"11";}s:12:"admin_errors";s:0:"";}', 1, '2010-10-12 11:49:16', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (9, 'Mạnh Nguyễn Đức', 'manhnguyenduc@vccorp.vn', 'manhnguyenduc', 'd4fd232c7dce166b12230400dca68a25', 1, 'A2OLyR4BizBmAhLT', 3, 'a:3:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:2:{i:0;s:1:"5";i:1;s:1:"7";}s:12:"admin_errors";s:0:"";}', 1, '2010-10-27 15:06:28', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (10, 'Trịnh Thị Hiên', 'hientrinhthi@vccorp.vn', 'hientrinhthi', '324dbe4b8a62719bbc2d785d68de8b1c', 1, 'A2OLyR4BizBmAhLT', 3, 'a:2:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:2:{i:0;s:1:"5";i:1;s:1:"7";}}', 1, '2010-11-04 15:09:43', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (11, 'Vu Bich Nhai', 'nhaivubich@vccorp.vn', 'nhaivubich', '324dbe4b8a62719bbc2d785d68de8b1c', 1, 'A2OLyR4BizBmAhLT', 3, 'a:3:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:3:{i:0;s:1:"5";i:1;s:1:"7";i:2;s:2:"10";}s:12:"admin_errors";s:0:"";}', 1, '2010-11-05 14:55:03', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (12, 'Vũ Hồng Quang', 'quangvuhong@vccorp.vn', 'quangvuhong', 'acc2192fc44f1bd8a408e2dc2a37c761', 1, 'A2OLyR4BizBmAhLT', 3, 'a:2:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:2:{i:0;s:1:"5";i:1;s:1:"7";}}', 2, '2010-11-15 14:55:15', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (13, 'Nguyễn Thế Tân', 'tannguyenthe@vccorp.vn', 'tannguyenthe', '390314a68ca67896e0584054ca8b918b', 1, 'A2OLyR4BizBmAhLT', 3, 'a:3:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:2:{i:0;s:1:"5";i:1;s:1:"7";}s:12:"admin_errors";s:0:"";}', 2, '2010-11-16 14:46:03', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (14, 'huyennt', 'hcm@muachung.vn', 'cskhhcm', 'd4fd232c7dce166b12230400dca68a25', 1, 'A2OLyR4BizBmAhLT', 3, 'a:2:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:2:{i:0;s:1:"5";i:1;s:1:"7";}}', 1, '2010-11-17 12:39:30', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (15, 'Nguyen Tri Dat', 'datnguyentri@vccorp.vn', 'datnguyentri', '630132344bb336836e1e661209f64655', 1, 'A2OLyR4BizBmAhLT', 3, 'a:2:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:2:{i:0;s:1:"5";i:1;s:1:"7";}}', 1, '2010-11-17 12:44:37', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (16, 'Nguyễn Văn Tấn', 'tannguyenvan@vccorp.vn', 'tannguyenvan', '1571e2ee965d68de394b1f1f651ed05e', 1, 'A2OLyR4BizBmAhLT', 3, 'a:3:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:2:{i:0;s:1:"5";i:1;s:1:"7";}s:12:"admin_errors";s:0:"";}', 1, '2010-11-26 11:11:32', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (17, 'CSKH Muachung', 'hotro@muachung.vn', 'cskhmuachung', '324dbe4b8a62719bbc2d785d68de8b1c', 1, 'A2OLyR4BizBmAhLT', 3, 'a:3:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:2:{i:0;s:1:"5";i:1;s:1:"7";}s:12:"admin_errors";s:0:"";}', 1, '2010-11-30 17:27:32', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (18, 'Ninh Thị Mai', 'maininhthi@vccorp.vn', 'maininhthi', 'b5f16c585aeb0928d9d2c0ee7fb5405a', 1, 'A2OLyR4BizBmAhLT', 3, 'a:3:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:5:{i:0;s:1:"5";i:1;s:1:"6";i:2;s:1:"7";i:3;s:1:"8";i:4;s:1:"9";}s:12:"admin_errors";s:0:"";}', 1, '2010-12-01 11:40:30', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (19, 'Đoàn Phúc Bảo', 'baodoanphuc@vccorp.vn', 'baodoanphuc', 'f66b87faed387fec21271f9c5c003d96', 1, 'A2OLyR4BizBmAhLT', 3, 'a:3:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:2:{i:0;s:1:"5";i:1;s:1:"7";}s:12:"admin_errors";s:0:"";}', 1, '2010-12-14 12:16:52', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (20, 'Nguyễn Khương Tuấn', 'mrtuannk@gmail.com', 'tuannguyenkhuong', '1e058caef21e42ce8dd2af3bee341bcb', 1, 'A2OLyR4BizBmAhLT', 3, 'a:3:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:2:{i:0;s:1:"5";i:1;s:1:"7";}s:12:"admin_errors";s:0:"";}', 1, '2010-12-20 10:12:01', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (21, 'Đặng Thị Kim Yến', 'yendtk@muachung.vn', 'yendtk', '4f3742954f861dcae5275415b25dbe3f', 1, 'A2OLyR4BizBmAhLT', 3, 'a:3:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:2:{i:0;s:1:"5";i:1;s:1:"7";}s:12:"admin_errors";s:0:"";}', 2, '2011-01-07 10:01:33', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (22, 'Đỗ Thị Thuỷ', 'thuydothi@vccorp.vn', 'thuydothi', '013f191f6e4803202b3391e3e8e4b872', 1, 'A2OLyR4BizBmAhLT', 3, 'a:3:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:2:{i:0;s:1:"5";i:1;s:1:"7";}s:12:"admin_errors";s:0:"";}', 2, '2011-01-10 15:24:22', '0000-00-00 00:00:00', 1);
INSERT INTO `admins` VALUES (23, 'Vương Vũ Thắng', 'thangvuongvu@vccorp.vn', 'thangvv', 'bd145dbb36d3fc17b3b7d429ae2c5346', 1, 'A2OLyR4BizBmAhLT', 3, 'a:3:{s:11:"admin_users";s:0:"";s:12:"admin_orders";a:2:{i:0;s:1:"5";i:1;s:1:"7";}s:12:"admin_errors";s:0:"";}', 2, '2011-01-24 12:56:26', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `admins_sites`
-- 

CREATE TABLE `admins_sites` (
  `site_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `admins_sites`
-- 

INSERT INTO `admins_sites` VALUES (1, 1);
INSERT INTO `admins_sites` VALUES (3, 3);
INSERT INTO `admins_sites` VALUES (3, 2);
INSERT INTO `admins_sites` VALUES (5, 2);
INSERT INTO `admins_sites` VALUES (6, 2);
INSERT INTO `admins_sites` VALUES (4, 3);
INSERT INTO `admins_sites` VALUES (8, 10);
INSERT INTO `admins_sites` VALUES (8, 9);
INSERT INTO `admins_sites` VALUES (18, 10);
INSERT INTO `admins_sites` VALUES (18, 9);
INSERT INTO `admins_sites` VALUES (17, 2);
INSERT INTO `admins_sites` VALUES (16, 2);
INSERT INTO `admins_sites` VALUES (9, 2);
INSERT INTO `admins_sites` VALUES (10, 2);
INSERT INTO `admins_sites` VALUES (8, 8);
INSERT INTO `admins_sites` VALUES (8, 7);
INSERT INTO `admins_sites` VALUES (8, 5);
INSERT INTO `admins_sites` VALUES (11, 10);
INSERT INTO `admins_sites` VALUES (12, 2);
INSERT INTO `admins_sites` VALUES (13, 2);
INSERT INTO `admins_sites` VALUES (14, 2);
INSERT INTO `admins_sites` VALUES (15, 2);
INSERT INTO `admins_sites` VALUES (18, 8);
INSERT INTO `admins_sites` VALUES (18, 7);
INSERT INTO `admins_sites` VALUES (18, 5);
INSERT INTO `admins_sites` VALUES (8, 4);
INSERT INTO `admins_sites` VALUES (8, 3);
INSERT INTO `admins_sites` VALUES (18, 4);
INSERT INTO `admins_sites` VALUES (18, 3);
INSERT INTO `admins_sites` VALUES (19, 2);
INSERT INTO `admins_sites` VALUES (20, 3);
INSERT INTO `admins_sites` VALUES (20, 8);
INSERT INTO `admins_sites` VALUES (20, 9);
INSERT INTO `admins_sites` VALUES (21, 2);
INSERT INTO `admins_sites` VALUES (22, 2);
INSERT INTO `admins_sites` VALUES (11, 9);
INSERT INTO `admins_sites` VALUES (23, 10);
INSERT INTO `admins_sites` VALUES (8, 2);
INSERT INTO `admins_sites` VALUES (18, 2);
INSERT INTO `admins_sites` VALUES (11, 8);
INSERT INTO `admins_sites` VALUES (11, 7);
INSERT INTO `admins_sites` VALUES (11, 4);
INSERT INTO `admins_sites` VALUES (11, 3);
INSERT INTO `admins_sites` VALUES (11, 2);

-- --------------------------------------------------------

-- 
-- Table structure for table `badwords`
-- 

CREATE TABLE `badwords` (
  `badword_id` int(6) NOT NULL auto_increment,
  `badword_contents` varchar(250) NOT NULL,
  `badword_exact` int(1) NOT NULL,
  `badword_checksum` varchar(32) NOT NULL,
  `badword_isphone` tinyint(1) NOT NULL default '0',
  `badword_reason` varchar(255) default NULL,
  `badword_username` varchar(50) default NULL,
  `badword_created` int(11) default NULL,
  PRIMARY KEY  (`badword_id`),
  FULLTEXT KEY `contents` (`badword_contents`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=892 ;

-- 
-- Dumping data for table `badwords`
-- 

INSERT INTO `badwords` VALUES (11, 'Cụ Hồ', 1, '3ed1a3a928e809bf49dff6de4ab826ec', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (12, 'cu ho', 1, '72095df8edfc63b234da89b48b8fd3cb', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (13, 'Bác Hồ', 1, '97c588632e9fa46c09913cc86f667545', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (14, 'bac ho', 1, 'e32fa7eaeb117318814064e1187ff8de', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (15, 'Chú Hồ', 1, '7c0a27826e6789cc3a5253bd10afdba9', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (16, 'chu ho', 1, '84b2444a6888be8788df867bde6ee630', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (17, 'Nguyễn Minh Triết', 1, '4200b697976e5c75399ae077deba5156', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (18, 'nguyen minh triet', 1, 'a5b7d926180d3d15c8f42804dd39d752', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (19, 'Nguyễn Tấn Dũng', 1, '52f93161ecfa8d6092d39b81c81a8a1d', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (20, 'nguyen tan dung', 1, 'd3621bd19bfd2e6cbf73e19217e880f2', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (21, 'Phan Văn Khải', 1, 'bc1aecc33cb136f765bb35a1b79056c1', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (22, 'phan van khai', 1, '9dd27b10704e2121e47b77e2504c4391', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (23, 'Trần Đức Lương', 1, 'f8b07cd820dd4e505d79f847b06a533f', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (24, 'tran duc luong', 1, '1ad28c8ac111aa39a4bc4b511ddb4fe9', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (25, 'Chủ Tịch Nước', 1, '7ea7bd58e49d4564a220e1c2776aa522', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (26, 'chu tich nuoc', 1, 'ccccee998c574d561bec94e004fd38a2', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (27, 'Thủ Tướng', 1, '25bba4c857425bf003c6997768b6141a', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (28, 'thu tuong', 1, 'f9050a0edaf6966f5de26b54678721cb', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (29, 'Chính quyền bạo lực', 1, 'b765b6a7ac10be4b63cb2fa4362a5b3a', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (30, 'Chinh quyen bao luc', 1, '90db6b6d1360b9ba010c883f5130a1de', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (31, 'Đàn áp', 1, '50686e211981a445a06f3d1ace6ff692', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (32, 'dan ap', 1, 'c2dea0d21a5ceff3368a39395f214e03', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (33, 'Cách mạng văn hóa', 1, 'c8005a8ac199c981ffbea17b2b0028f3', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (34, 'cach mang van hoa', 1, '549d2ddf16ff989f944b5f5f514ac40e', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (35, 'Thoái Đảng', 1, '63cb58ce79b33a6e42affd630fe883a8', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (36, 'thoai dang', 1, '939a1ed6131b0c538032657cf912a1fc', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (37, 'Phản động', 1, '65e21156c701150b4f9063fed9b9a99c', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (38, 'phan dong', 1, 'a8fe54cfdb1d0281592482ab1b83eaf8', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (39, 'Đảng Cộng Sản Chó', 1, '1d4bf2165fdc9c4b8060bd6ba6eb7e93', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (40, 'dang cong san cho', 1, '8e3db393972ad8465295f8e5fe00c8f9', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (41, 'Nhà Nước Chó', 1, 'fd9faf721d2e7e617fc9febaaea49736', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (42, 'nha nuoc cho', 1, '4ed34fc6f34ec7c51555df988863fbc8', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (43, 'Đa Nguyên Đa Đảng', 1, 'a53329ee6f4f59604a52edc38cb3fdce', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (44, 'da nguyen da dang', 1, '535ce476654e1c93dfaf4d5d5307be31', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (45, 'Giải Thể Nhà Nước', 1, 'e1c78e5766ef85fefcc8df019d170ccd', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (46, 'giai the nha nuoc', 1, '82e018f12bf8bead9e5749d616c6c873', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (47, 'Nhà Nước Tham Ô', 1, '2517e1f15c303f5c0b2105c15bb606ed', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (48, 'nha nuoc tham o', 1, 'a5bafd169c79d9c5deb3f958a683ac59', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (49, 'Chính Quyền Tham Ô', 1, 'c27294a062fdb0118a0ffe5212b43918', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (50, 'chinh quyen tham o', 1, 'a2d7a1211e52e096788b1fc7f3fcc2b4', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (51, 'Mai Xuân Thưởng', 1, 'c4bda387ae6dc6cf73ffed8d59dd2662', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (52, 'Mai Xuan Thuong', 1, '7c6c5f9bba8b6bd93818349757dc060d', 0, '', NULL, NULL);
INSERT INTO `badwords` VALUES (53, 'quảng trường ba đình', 1, '3145d79004c14e9d0321cf2749458d4b', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (54, 'quang truong ba dinh', 1, '009370c8f39d7bd53dff22c5621c66da', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (60, 'Thanh tra chính phủ', 1, '456e1806334bc608b0d3c9afc25f1a8e', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (61, 'thanh tra chinh phu', 1, '78a656d344f76455356b79355d091492', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (62, 'sex', 1, '3c3662bcb661d6de679c636744c66b62', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (63, 'chó chết', 1, '6cafebab702e287b1a35f9c47d3e7807', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (64, 'cho chet', 1, 'd722fb7c3897e2ab56beb20093b15bc8', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (65, 'fuck', 1, '99754106633f94d350db34d548d6091a', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (66, 'địt', 1, '3171fd5b95d1b705ddf77580d8bab6f4', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (67, 'cặc', 1, '0b235cf829492f8f277666fb1a6a199f', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (68, 'buồi', 1, '232277851d6437155986901e063a695d', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (69, 'lồn', 1, 'c66fa676b8e47380dc09e7b3a95a6c79', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (70, 'giao cấu', 1, 'd3048b275c683a2e92274fff239114c5', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (71, 'giao cau', 1, 'c7bc41fb32d9d248201098ef927797d9', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (72, 'hãm hiếp', 1, 'a358fd5ef3087cdc54d2caef2e37a0a3', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (73, 'ham hiep', 1, '4f633ba3e2145b5c5d1dd7f2610dd153', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (74, 'hiếp dâm', 1, '358249482d8a4563693842f28d2cd66e', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (75, 'hiep dam', 1, 'd19f2c30dc1165f2eb07b7b518d66e18', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (76, 'cứt', 1, '7733ffa6a05d97363163f819ba7b6569', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (77, 'shit', 1, '1223b8c30a347321299611f873b449ad', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (78, 'penis', 1, 'c02b7d24a066adb747fdeb12deb21bfa', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (79, 'cunt', 1, 'b52b073595ccb35eaebb87178227b779', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (80, 'pussy', 1, 'acc6f2779b808637d04c71e3d8360eeb', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (81, 'cock', 1, '9268d0b2d17670598c70045b0c7abf38', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (82, 'đéo', 1, '19f96459582fe80350fdc00fdf876574', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (83, 'con bà nó', 1, '1498cb339c325b5c3f1d7cabdfe5d342', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (84, 'con ba no', 1, 'f5f97d8638808d3e497d8528c87dde7c', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (85, 'tổ sư', 1, '64138c3cfce59e565225706b8051da65', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (86, 'to su', 1, '468acee0a8d9730c2c661b63b4ce535c', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (87, 'thằng chó', 1, 'c392ee568cd8ca6d22507845804cebfd', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (88, 'thang cho', 1, 'f1c87e155c16c836455fd8345779e8cf', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (89, 'cha mày', 1, '8e5c7dca71fbbf9697f019cca116f2a1', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (90, 'cha may', 1, '8bfd5bbdf8de932f529fef149e0ea6a9', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (91, 'má mày', 1, 'c26a9c5d6517569319a90db04a323996', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (92, 'ma may', 1, 'bd0a8b87325a33d6ee3ad43151d8b4f6', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (93, 'tổ cha', 1, 'c52d07c337fa631a002a4e64e70a0e0c', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (94, 'to cha', 1, '3ef54880b554254b2658a6e00bfabf7c', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (95, 'mẹ mày', 1, '7beab42eea539a0b06692320902023ad', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (96, 'me may', 1, '7c21f0315e09ed413fc8078ead7397dd', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (97, 'bố mày', 1, '1859e0bd95027f96717d4de89f1ecd8d', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (98, 'bo may', 1, '8c7f9cc10fb0799bd5eabb0a22769bb2', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (99, 'cụ mày', 1, '8c90827918f37dcbf6715588bebe30e5', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (100, 'cu may', 1, '63b0eac1a544c32d100b5c3dd86b27d1', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (101, 'Cái chim', 1, '623d6da70f7a92494653c2f840bec4c1', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (102, 'cai chim', 1, 'fb9337a12c3e9eacef1e7df297b4af23', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (108, 'nhiều lông', 1, 'a53ec8998956db2e30616d5f2d6899bb', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (109, 'nhieu long', 1, '821ab08b9a6766932b56e286f8aefdde', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (110, 'lông nhiều', 1, '896ac1116a9208ec405ed8b1d919933a', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (111, 'long nhieu', 1, '6a49f63d7e96f4bc8ee1dffd8f17c832', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (112, 'làm tình', 1, '77387af17a125528a6a4a299b50d4c46', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (113, 'lam tinh', 1, 'e07c9c59978a17e51ddd38199a4798e9', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (122, 'trai gọi', 1, 'dd10a6bd24d36ff643ed4ac810247e09', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (123, 'trai goi', 1, '8aa036b3201c4a9447a23c8179012a8e', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (124, 'gái gọi', 1, '94fad554b16f87d1c60b02bc85714529', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (125, 'gai goi', 1, 'f9a5cb0597bbba1816e6760f3f70ac4b', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (126, 'sung sướng', 1, '346115ac14f0ecd81733802ba54bffc8', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (131, 'lam tinh', 1, 'e07c9c59978a17e51ddd38199a4798e9', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (132, 'tình dục', 1, 'ddd7b946fbc6a57fa083233d4ffb6139', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (133, 'tinh duc', 1, '4b0b13ed0788b6bef04e66eb670a7185', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (136, 'bạn tình', 1, '57331f8f6d1684031b5e366d5337a59d', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (137, 'ban tinh', 1, '42a16c11a188912599d39fd1a48ca187', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (149, 'dieu luyen', 1, 'f5d89c8f9342fb8cd0f49d38b6271797', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (150, 'con chim', 1, 'c4fd35036044222e8fe2551dbe169437', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (152, 'vang anh', 1, 'b226f74cfe5ecaedf87f6f1f5251faf8', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (161, 'vàng anh', 1, '332f8df46f93853ed5eb35cdd463c28c', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (178, 'trường sa', 1, '6256b7dd12ab6c7cdd83d6f312ca7af7', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (179, 'hoàng sa', 1, '92cad7a42c817409485a930319a81ccf', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (180, 'truongsa', 1, '17a8fcfa40ce1fd7d37839fc3eafa592', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (181, 'hoangsa', 1, 'e71d1d03cf65812c475910e5d92c1737', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (193, 'gso media', 1, '890c8ec30bf84da12dff90e87deb8320', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (194, 'gso-media', 1, 'bdffc98f945f97c8685026695e1b34bd', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (207, 'kích dục', 1, 'a67cc9aedb62e218990ee2f295bec919', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (208, 'xuất tinh', 1, '3507f43b599b51afe8f2d7eb9da3b941', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (213, 'màng trinh', 1, '0f73b437032ced34415ec2416b1ffc59', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (217, '42 Nhà Chung', 1, 'b425449c1b89a32ef4233f6d4a0c8ac7', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (218, 'Tổng Giám Mục', 1, '4831051d7ba9202fc21f5c74388b7991', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (219, 'Ngô Quang Kiệt', 1, '1b944893fed675437ede58a1f26a7b9b', 0, NULL, NULL, NULL);
INSERT INTO `badwords` VALUES (331, 'củ cặc', 1, 'ffd0df8b52960cf409b04d4e6c31e377', 0, '', NULL, NULL);
INSERT INTO `badwords` VALUES (801, 'cave', 1, 'e386df9ee22e271da0b7d489447870ff', 0, '', 'admin', 1296035333);
INSERT INTO `badwords` VALUES (802, 'đù má', 1, '5046b924e06732be0d2052c77c31c106', 0, '', 'admin', 1296035351);
INSERT INTO `badwords` VALUES (803, 'bìu', 1, '9b6656eac31b860383d263a4307dc5d8', 0, '', 'admin', 1296035394);
INSERT INTO `badwords` VALUES (804, 'bitch', 1, '316928e0d260556eaccb6627f2ed657b', 0, '', 'admin', 1296035411);
INSERT INTO `badwords` VALUES (805, 'suck', 1, 'a195a27d1c96dbc7ea4aa9928d914673', 0, '', 'admin', 1296035443);
INSERT INTO `badwords` VALUES (806, 'm4? ch4', 1, '67d596aac6a2933e66d13f10e6bb020d', 0, '', 'admin', 1296035461);
INSERT INTO `badwords` VALUES (807, 'm4? m3.', 1, '52ed9078d5de18de29d4f52c7aaf7da5', 0, '', 'admin', 1296035477);
INSERT INTO `badwords` VALUES (808, 'c0.ng s4?n', 1, '21099a836adbe30e4e6b0ed8f9c22eee', 0, '', 'admin', 1296035510);
INSERT INTO `badwords` VALUES (809, 'c4.c', 1, '4a05c0b4686e8212baae66d84aafbb6f', 0, '', 'admin', 1296035524);
INSERT INTO `badwords` VALUES (810, 'f0`', 1, '8ead17de6a957cf78d96a933c112b439', 0, '', 'admin', 1296035536);
INSERT INTO `badwords` VALUES (811, 'fo`', 1, '6f212bbdbdeb7ee5be2d1c2638561b4e', 0, '', 'admin', 1296035544);
INSERT INTO `badwords` VALUES (812, 'dmm', 1, '340d70f50a7a4507bc874c8108bb45bc', 0, '', 'admin', 1296035576);
INSERT INTO `badwords` VALUES (813, 'dm', 1, '608e7dc116de7157306012b4f0be82ac', 0, '', 'admin', 1296035587);
INSERT INTO `badwords` VALUES (814, 'dcmm', 1, 'fb6c7ad40860f48514f0c2c663373861', 0, '', 'admin', 1296035653);
INSERT INTO `badwords` VALUES (815, 'dclcm', 1, '1558659feee2b0bb9cd6faf5aba69785', 0, '', 'admin', 1296035679);
INSERT INTO `badwords` VALUES (816, 'đj.t', 1, '9743eb9329c85814cf8f709209789888', 0, '', 'admin', 1296035703);
INSERT INTO `badwords` VALUES (819, 'dis', 1, '4cdf5a25d4673bfc4546ca7843071f65', 0, '', 'admin', 1296035776);
INSERT INTO `badwords` VALUES (820, 'clgt', 1, 'bb111048b8ff8883032ef76494f31db8', 0, '', 'admin', 1296035811);
INSERT INTO `badwords` VALUES (821, 'cdcmm', 1, 'e4951248f6b5e8cd9ad8c4ec13d19656', 0, '', 'admin', 1296035831);
INSERT INTO `badwords` VALUES (822, 'lìn', 1, 'ee178746bfaf92d76f35e134e50d3f09', 0, '', 'admin', 1296035850);
INSERT INTO `badwords` VALUES (823, 'nìn', 1, 'edd006ce5e28c02571956ae164f77cd5', 0, '', 'admin', 1296035858);
INSERT INTO `badwords` VALUES (824, 'ni`n', 1, '673c3f80ee8d53bcf3914f73d94a7cc2', 0, '', 'admin', 1296035866);
INSERT INTO `badwords` VALUES (825, 'nin`', 1, '86be13109a222418730065c33bd946d0', 0, '', 'admin', 1296035871);
INSERT INTO `badwords` VALUES (826, 'lin`', 1, '87c0847ed1a2a02c85fb488f9934bfeb', 0, '', 'admin', 1296035881);
INSERT INTO `badwords` VALUES (827, 'li`n', 1, 'e168b565bfeebe9948a30b3c14d6d3d9', 0, '', 'admin', 1296035888);
INSERT INTO `badwords` VALUES (828, 'lôn`', 1, 'd146333663a90f3c58ff1ec88abc500a', 0, '', 'admin', 1296035896);
INSERT INTO `badwords` VALUES (829, 'lô`n', 1, '93e6e1bcb30191dab554201a9731095e', 0, '', 'admin', 1296035904);
INSERT INTO `badwords` VALUES (830, 'lon`', 1, 'bb039422b5cec1c0386e241d157e76c2', 0, '', 'admin', 1296035916);
INSERT INTO `badwords` VALUES (831, 'lo`n', 1, 'e9600cfd6d3a39fe7960e0f57f0eb6b7', 0, '', 'admin', 1296035924);
INSERT INTO `badwords` VALUES (832, 'lôn', 1, '4e12dcc478a7c46a4264dbf98c8a3a8f', 0, '', 'admin', 1296035939);
INSERT INTO `badwords` VALUES (833, 'l0n`', 1, 'f8cffc4c5cad695cff1a799ca25d940a', 0, '', 'admin', 1296035964);
INSERT INTO `badwords` VALUES (834, 'l0`n', 1, '0c818d98be8b7d51bfa888c9b80793c4', 0, '', 'admin', 1296035972);
INSERT INTO `badwords` VALUES (835, '|on`', 1, '48827ebeab9fe91e75d463697c6c7657', 0, '', 'admin', 1296035994);
INSERT INTO `badwords` VALUES (836, 'buôi`', 1, 'c65f8b9df483d1c2ede82a82f715851e', 0, '', 'admin', 1296036028);
INSERT INTO `badwords` VALUES (837, 'buoi`', 1, 'c668c17ff59adc3caa8ae4cfa3096922', 0, '', 'admin', 1296036034);
INSERT INTO `badwords` VALUES (838, 'ljn`', 1, 'ca1ee31402e431018f1b53ba870955a6', 0, '', 'admin', 1296036055);
INSERT INTO `badwords` VALUES (839, 'lj`n', 1, 'c03601f327440ed818c56c36d8a0bba0', 0, '', 'admin', 1296036064);
INSERT INTO `badwords` VALUES (840, 'phịch', 1, 'ac3fdbc19dc86694d7e00af708556adb', 0, '', 'admin', 1296036084);
INSERT INTO `badwords` VALUES (842, 'vcl', 1, 'b8e70c06e5ce7d45969fbe73d751b395', 0, '', 'admin', 1296036116);
INSERT INTO `badwords` VALUES (843, 'vkl', 1, 'ed82777942d7be2f0bc5932689195523', 0, '', 'admin', 1296036121);
INSERT INTO `badwords` VALUES (844, 'kứt', 1, '49ec1045d5bd80bd048ec31af3b60537', 0, '', 'admin', 1296036174);
INSERT INTO `badwords` VALUES (845, 'vú', 1, '840aa8c707c79545f8117731b17475e3', 0, '', 'admin', 1296036241);
INSERT INTO `badwords` VALUES (846, 'bím', 1, 'cada336913101b1f1920d06b3fc61ef2', 0, '', 'admin', 1296036248);
INSERT INTO `badwords` VALUES (847, 'đa đảng', 1, 'f5b03d10af6c730e89e31156c5cbe844', 0, '', 'admin', 1296036285);
INSERT INTO `badwords` VALUES (848, 'phj.ch', 1, '63979568c179c62aa4850c94a1af4fa5', 0, '', 'admin', 1296036304);
INSERT INTO `badwords` VALUES (849, 'chém chết', 1, 'f1b19e1ffbd1f78455746c7f79cca723', 0, '', 'admin', 1296036325);
INSERT INTO `badwords` VALUES (850, 'vulva', 1, 'f97ee44aefd797519351ae90825e0730', 0, '', 'admin', 1296036350);
INSERT INTO `badwords` VALUES (851, 'kặc', 1, '990fcea2f4364934197b688d8c0d8a2b', 0, '', 'admin', 1296036393);
INSERT INTO `badwords` VALUES (852, 'kẹc', 1, '652fe5f7ed3c95d069b7bc64e9501e7c', 0, '', 'admin', 1296036402);
INSERT INTO `badwords` VALUES (853, 'mả mẹ', 1, 'f9170dcc4afa345d3c30a8e25d3aaf74', 0, '', 'admin', 1296036428);
INSERT INTO `badwords` VALUES (854, 'mả cha', 1, '53068c92cc6eacd57f2010faf2b0e7fd', 0, '', 'admin', 1296036434);
INSERT INTO `badwords` VALUES (855, 'cả lò', 1, '7b66f1c5a4f66667b68ba41652080188', 0, '', 'admin', 1296036441);
INSERT INTO `badwords` VALUES (856, 'họ hàng hang hốc', 1, 'ab229c3f03eb1d2ef4f4dc0f7a3ca443', 0, '', 'admin', 1296036456);
INSERT INTO `badwords` VALUES (857, 'đái', 1, '8bc3c1d032338c8518b72de9119cd0f7', 0, '', 'admin', 1296036479);
INSERT INTO `badwords` VALUES (858, 'éo', 1, 'eedfc35916226b795733dd88d835481e', 0, '', 'admin', 1296036491);
INSERT INTO `badwords` VALUES (859, 'đụ', 1, '70b3faff12381eac29fae851291d7838', 0, '', 'admin', 1296036504);
INSERT INTO `badwords` VALUES (860, 'đíu', 1, 'ae672ddcf1c9e4915cbf8ff89c842d36', 0, '', 'admin', 1296036525);
INSERT INTO `badwords` VALUES (861, 'đếu', 1, '54232f7acee5f0cd2686f7fe2b054f75', 0, '', 'admin', 1296036533);
INSERT INTO `badwords` VALUES (862, 'điếm', 1, '935650a2e1abf673f307f24f0b0c36eb', 0, '', 'admin', 1296036546);
INSERT INTO `badwords` VALUES (863, 'đĩ', 1, 'da27bcb87c9f3f385615eddc423171e4', 0, '', 'admin', 1296036552);
INSERT INTO `badwords` VALUES (864, 'đi~', 1, '29c24b78b4b41fac34724e2daad7e674', 0, '', 'admin', 1296036560);
INSERT INTO `badwords` VALUES (865, 'căng củ cọt', 1, 'a6b888abaf8517e60ba7e35a6764f11f', 0, '', 'admin', 1296036635);
INSERT INTO `badwords` VALUES (866, 'kăng kủ kọt', 1, 'c14fb46d22f922b0307f69a6514cd342', 0, '', 'admin', 1296036657);
INSERT INTO `badwords` VALUES (867, 'đồ con lợn', 1, '19d927a2d9239424cd9d87512722c5f0', 0, '', 'admin', 1296036734);
INSERT INTO `badwords` VALUES (868, 'thằng mặt lợn', 1, '014c7d685658485b39ff1650fce21ecc', 0, '', 'admin', 1296036752);
INSERT INTO `badwords` VALUES (869, 'sóc lọ', 1, '5f9793e7141134b4b7f1668d8813711f', 0, '', 'admin', 1296036801);
INSERT INTO `badwords` VALUES (870, 'soc lo', 1, '9941b357a61ad63be88f191c126a9e25', 0, '', 'admin', 1296036819);
INSERT INTO `badwords` VALUES (871, 'thủ dâm', 1, '92b0ca0402e4153b9644d924f89d60af', 0, '', 'admin', 1296036840);
INSERT INTO `badwords` VALUES (872, 'thu dam', 1, 'c6e7dccf087f93213ecb1f1fff72818b', 0, '', 'admin', 1296036851);
INSERT INTO `badwords` VALUES (874, 'híp dâm', 1, '2f572fda20d2a7ab2a9b8d9148b05658', 0, '', 'admin', 1296036870);
INSERT INTO `badwords` VALUES (875, 'cưỡng bức', 1, '2b96652386e61ee01fc31387c150c32b', 0, '', 'admin', 1296036902);
INSERT INTO `badwords` VALUES (876, 'cưỡng hiếp', 1, '7c5b547810b00dc64a9758bdf3245161', 0, '', 'admin', 1296036917);
INSERT INTO `badwords` VALUES (877, 'sh!t', 1, '8ec03f3c81448d80f906654c76d8b7d9', 0, '', 'admin', 1296037028);
INSERT INTO `badwords` VALUES (878, 'shjt', 1, 'd5beb0236d10733c4e3faff8c52beeb0', 0, '', 'admin', 1296037035);
INSERT INTO `badwords` VALUES (880, 'thối tha', 1, '2c3f97aebab0e1721a19fab4499e4488', 0, '', 'admin', 1296037105);
INSERT INTO `badwords` VALUES (881, 'phang phập', 1, '3d7ff82c6350d9c520ce100d4c19326b', 0, '', 'admin', 1296037152);
INSERT INTO `badwords` VALUES (883, 'Nguyễn Phú Trọng', 1, 'b76ff7bbb2d3d10bd0028bd7e8a7b3df', 0, '', 'admin', 1296037333);
INSERT INTO `badwords` VALUES (884, 'Nguyen Phu Trong', 1, '5d8ea9f5a39667c7753d48cf14f71ca3', 0, '', 'admin', 1296037345);
INSERT INTO `badwords` VALUES (885, 'Minh râu', 1, '2f62aedabbc0aa99f20f4c6a73c85206', 0, '', 'admin', 1296037389);
INSERT INTO `badwords` VALUES (886, 'dái', 1, 'f3fcd3b8fd39ca4c7f1f9d96b72f2792', 0, '', 'admin', 1296090337);
INSERT INTO `badwords` VALUES (891, 'mie', 1, '49f3fe6cf61e07c14baf3fcb6d293f47', 0, '', 'admin', 1296206632);

-- --------------------------------------------------------

-- 
-- Table structure for table `city`
-- 

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL auto_increment,
  `city_name` varchar(255) NOT NULL,
  `city_order` tinyint(4) NOT NULL,
  `city_status` varchar(20) NOT NULL,
  `city_area` tinyint(4) NOT NULL,
  `city_shippable` tinyint(1) default '0',
  PRIMARY KEY  (`city_id`),
  KEY `position` (`city_order`),
  KEY `status` (`city_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

-- 
-- Dumping data for table `city`
-- 

INSERT INTO `city` VALUES (3, 'Bạc Liêu', 6, '0', 3, 0);
INSERT INTO `city` VALUES (4, 'Bắc Cạn', 7, '0', 1, 0);
INSERT INTO `city` VALUES (5, 'Bắc Giang', 6, '0', 1, 0);
INSERT INTO `city` VALUES (6, 'Bắc Ninh', 7, '0', 1, 0);
INSERT INTO `city` VALUES (7, 'Bến Tre', 8, '0', 3, 0);
INSERT INTO `city` VALUES (8, 'Bình Dương', 9, '0', 3, 0);
INSERT INTO `city` VALUES (9, 'Bình Định', 10, '0', 2, 0);
INSERT INTO `city` VALUES (10, 'Bình Phước', 11, '0', 2, 0);
INSERT INTO `city` VALUES (11, 'Bình Thuận', 12, '0', 2, 0);
INSERT INTO `city` VALUES (12, 'Cà Mau', 13, '0', 3, 0);
INSERT INTO `city` VALUES (13, 'Cao Bằng', 14, '0', 1, 0);
INSERT INTO `city` VALUES (14, 'Cần Thơ', 5, '0', 3, 0);
INSERT INTO `city` VALUES (15, 'Đà Nẵng', 4, '1', 2, 0);
INSERT INTO `city` VALUES (17, 'Đồng Nai', 18, '0', 3, 0);
INSERT INTO `city` VALUES (18, 'Đồng Tháp', 19, '0', 3, 0);
INSERT INTO `city` VALUES (19, 'Gia Lai', 20, '0', 2, 0);
INSERT INTO `city` VALUES (20, 'Hà Giang', 21, '0', 1, 0);
INSERT INTO `city` VALUES (21, 'Hà Nam', 22, '0', 1, 0);
INSERT INTO `city` VALUES (22, 'Hà Nội', 1, '1', 1, 1);
INSERT INTO `city` VALUES (23, 'Hà Tây', 24, '0', 1, 0);
INSERT INTO `city` VALUES (24, 'Hà Tĩnh', 25, '0', 2, 0);
INSERT INTO `city` VALUES (25, 'Hải Dương', 26, '0', 1, 0);
INSERT INTO `city` VALUES (26, 'Hải Phòng', 3, '0', 1, 0);
INSERT INTO `city` VALUES (27, 'Hòa Bình', 28, '0', 1, 0);
INSERT INTO `city` VALUES (28, 'Hưng Yên', 29, '0', 1, 0);
INSERT INTO `city` VALUES (29, 'TP Hồ Chí Minh', 2, '1', 3, 1);
INSERT INTO `city` VALUES (30, 'Khánh Hòa', 31, '0', 2, 0);
INSERT INTO `city` VALUES (31, 'Kiên Giang', 32, '0', 3, 0);
INSERT INTO `city` VALUES (32, 'Kon Tum', 33, '0', 2, 0);
INSERT INTO `city` VALUES (33, 'Lai Châu', 34, '0', 1, 0);
INSERT INTO `city` VALUES (34, 'Lạng Sơn', 35, '0', 1, 0);
INSERT INTO `city` VALUES (35, 'Lào Cai', 36, '0', 1, 0);
INSERT INTO `city` VALUES (36, 'Lâm Đồng', 37, '0', 2, 0);
INSERT INTO `city` VALUES (37, 'Long An', 38, '0', 3, 0);
INSERT INTO `city` VALUES (38, 'Nam Định', 39, '0', 1, 0);
INSERT INTO `city` VALUES (39, 'Nghệ An', 40, '0', 2, 0);
INSERT INTO `city` VALUES (40, 'Ninh Bình', 41, '0', 1, 0);
INSERT INTO `city` VALUES (41, 'Ninh Thuận', 42, '0', 2, 0);
INSERT INTO `city` VALUES (42, 'Phú Thọ', 43, '0', 1, 0);
INSERT INTO `city` VALUES (43, 'Phú Yên', 44, '0', 2, 0);
INSERT INTO `city` VALUES (44, 'Quảng Bình', 45, '0', 2, 0);
INSERT INTO `city` VALUES (45, 'Quảng Nam', 46, '0', 2, 0);
INSERT INTO `city` VALUES (46, 'Quảng Ngãi', 47, '0', 2, 0);
INSERT INTO `city` VALUES (47, 'Quảng Ninh', 48, '0', 1, 0);
INSERT INTO `city` VALUES (48, 'Quảng Trị', 49, '0', 2, 0);
INSERT INTO `city` VALUES (49, 'Sóc Trăng', 50, '0', 3, 0);
INSERT INTO `city` VALUES (50, 'Sơn La', 51, '0', 1, 0);
INSERT INTO `city` VALUES (51, 'Tây Ninh', 52, '0', 3, 0);
INSERT INTO `city` VALUES (52, 'Thái Bình', 53, '0', 1, 0);
INSERT INTO `city` VALUES (53, 'Thái Nguyên', 54, '0', 1, 0);
INSERT INTO `city` VALUES (54, 'Thanh Hóa', 55, '0', 1, 0);
INSERT INTO `city` VALUES (55, 'Thừa Thiên Huế', 56, '0', 2, 0);
INSERT INTO `city` VALUES (56, 'Tiền Giang', 57, '0', 3, 0);
INSERT INTO `city` VALUES (57, 'Trà Vinh', 58, '0', 3, 0);
INSERT INTO `city` VALUES (58, 'Tuyên Quang', 59, '0', 1, 0);
INSERT INTO `city` VALUES (59, 'Vĩnh Long', 60, '0', 3, 0);
INSERT INTO `city` VALUES (60, 'Vĩnh Phúc', 61, '0', 1, 0);
INSERT INTO `city` VALUES (61, 'Yên Bái', 62, '0', 1, 0);
INSERT INTO `city` VALUES (66, 'An giang', 62, '0', 3, 0);
INSERT INTO `city` VALUES (67, 'Bà Rịa - Vũng Tàu', 123, '0', 3, 0);
INSERT INTO `city` VALUES (68, 'Nha Trang', 0, '1', 0, 0);
INSERT INTO `city` VALUES (69, 'Điện Biên', 0, '0', 0, 0);
INSERT INTO `city` VALUES (70, 'Hậu Giang', 0, '0', 0, 0);
INSERT INTO `city` VALUES (71, 'Đắk Nông', 0, '0', 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `districts`
-- 

CREATE TABLE `districts` (
  `district_id` int(3) NOT NULL auto_increment,
  `district_city_id` int(10) NOT NULL default '0',
  `district_name` varchar(225) character set utf8 collate utf8_unicode_ci NOT NULL,
  `district_status` tinyint(1) NOT NULL default '1',
  `district_is_urban` tinyint(1) default '0',
  `district_shippable` tinyint(1) default '0',
  PRIMARY KEY  (`district_id`),
  KEY `id_citiesfather` (`district_city_id`),
  KEY `Idx_id_citiesfather_orders_name` (`district_city_id`,`district_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=788 ;

-- 
-- Dumping data for table `districts`
-- 

INSERT INTO `districts` VALUES (1, 22, 'Ba Đình', 1, 1, 1);
INSERT INTO `districts` VALUES (2, 22, 'Long Biên', 1, 0, 1);
INSERT INTO `districts` VALUES (3, 22, 'Sóc Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (4, 22, 'Đông Anh', 1, 0, 0);
INSERT INTO `districts` VALUES (5, 8, 'Thủ Dầu Một', 1, 0, 0);
INSERT INTO `districts` VALUES (7, 10, 'Thị xã Đồng Xoài', 1, 0, 0);
INSERT INTO `districts` VALUES (8, 10, 'Huyện Đồng Phú', 1, 0, 0);
INSERT INTO `districts` VALUES (9, 10, 'Huyện Chơn Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (10, 8, 'Bến Cát', 1, 0, 0);
INSERT INTO `districts` VALUES (11, 10, 'Huyện Bình Long', 1, 0, 0);
INSERT INTO `districts` VALUES (12, 8, 'Tân Uyên', 1, 0, 0);
INSERT INTO `districts` VALUES (13, 10, 'Huyện Lộc Ninh', 1, 0, 0);
INSERT INTO `districts` VALUES (14, 10, 'Huyện Bù Đốp', 1, 0, 0);
INSERT INTO `districts` VALUES (15, 10, 'Huyện Phước Long', 1, 0, 0);
INSERT INTO `districts` VALUES (16, 8, 'Thuận An', 1, 0, 0);
INSERT INTO `districts` VALUES (17, 10, 'Huyện Bù Đăng', 1, 0, 0);
INSERT INTO `districts` VALUES (18, 8, 'Dĩ An', 1, 0, 0);
INSERT INTO `districts` VALUES (19, 10, 'Huyện Hớn Quản', 1, 0, 0);
INSERT INTO `districts` VALUES (20, 8, 'Phú Giáo', 1, 0, 0);
INSERT INTO `districts` VALUES (21, 10, 'Huyện Bù Gia Mập', 1, 0, 0);
INSERT INTO `districts` VALUES (22, 8, 'Dầu Tiếng', 1, 0, 0);
INSERT INTO `districts` VALUES (24, 8, 'Thị xã Thủ Dầu Một', 1, 0, 0);
INSERT INTO `districts` VALUES (25, 18, 'Thị xã Thủ Dầu Một', 1, 0, 0);
INSERT INTO `districts` VALUES (26, 8, 'Huyện Bến Cát', 1, 0, 0);
INSERT INTO `districts` VALUES (27, 8, 'Huyện Tân Uyên', 1, 0, 0);
INSERT INTO `districts` VALUES (28, 10, 'Đồng Xoài', 1, 0, 0);
INSERT INTO `districts` VALUES (29, 8, 'Huyện Thuận An', 1, 0, 0);
INSERT INTO `districts` VALUES (30, 8, 'Huyện Dĩ An', 1, 0, 0);
INSERT INTO `districts` VALUES (31, 10, 'Đồng Phú', 1, 0, 0);
INSERT INTO `districts` VALUES (32, 8, 'Huyện Phú Giáo', 1, 0, 0);
INSERT INTO `districts` VALUES (33, 10, 'Chơn Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (34, 8, 'Huyện Dầu Tiếng', 1, 0, 0);
INSERT INTO `districts` VALUES (35, 10, 'Bình Long', 1, 0, 0);
INSERT INTO `districts` VALUES (36, 10, 'Lộc Ninh', 1, 0, 0);
INSERT INTO `districts` VALUES (39, 10, 'Bù Đốp', 1, 0, 0);
INSERT INTO `districts` VALUES (40, 41, 'Thành phố Phan Rang', 1, 0, 0);
INSERT INTO `districts` VALUES (41, 41, 'Tháp Chàm', 1, 0, 0);
INSERT INTO `districts` VALUES (42, 42, 'Việt Trì', 1, 0, 0);
INSERT INTO `districts` VALUES (43, 10, 'Phước Long', 1, 0, 0);
INSERT INTO `districts` VALUES (44, 41, 'Huyện Ninh Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (45, 41, 'Huyện Ninh Hải', 1, 0, 0);
INSERT INTO `districts` VALUES (46, 10, 'Bù Đăng', 1, 0, 0);
INSERT INTO `districts` VALUES (47, 41, 'Huyện Ninh Phước', 1, 0, 0);
INSERT INTO `districts` VALUES (48, 10, 'Hớn Quản', 1, 0, 0);
INSERT INTO `districts` VALUES (49, 41, 'Bác Ái', 1, 0, 0);
INSERT INTO `districts` VALUES (50, 10, 'Bù Gia Mập', 1, 0, 0);
INSERT INTO `districts` VALUES (51, 22, 'Hoàn Kiếm', 1, 1, 1);
INSERT INTO `districts` VALUES (52, 41, 'Huyện Thuận Bắc', 1, 0, 0);
INSERT INTO `districts` VALUES (53, 22, 'Hai Bà Trưng', 1, 1, 1);
INSERT INTO `districts` VALUES (54, 41, 'Huyện Thuận Nam', 1, 0, 0);
INSERT INTO `districts` VALUES (55, 22, 'Đống Đa', 1, 1, 1);
INSERT INTO `districts` VALUES (57, 22, 'Tây Hồ', 1, 1, 1);
INSERT INTO `districts` VALUES (58, 36, 'Đà Lạt', 1, 0, 0);
INSERT INTO `districts` VALUES (60, 22, 'Cầu Giấy', 1, 1, 1);
INSERT INTO `districts` VALUES (61, 36, 'Bảo Lộc', 1, 0, 0);
INSERT INTO `districts` VALUES (62, 51, 'Thị xã Tây Ninh', 1, 0, 0);
INSERT INTO `districts` VALUES (63, 22, 'Thanh Xuân', 1, 1, 1);
INSERT INTO `districts` VALUES (64, 51, 'Huyện Tân Biên', 1, 0, 0);
INSERT INTO `districts` VALUES (65, 36, 'Đức Trọng', 1, 0, 0);
INSERT INTO `districts` VALUES (66, 51, 'Huyện Tân Châu', 1, 0, 0);
INSERT INTO `districts` VALUES (67, 51, 'Huyện Dương Minh Châu', 1, 0, 0);
INSERT INTO `districts` VALUES (68, 36, 'Di Linh', 1, 0, 0);
INSERT INTO `districts` VALUES (69, 51, 'Huyện Châu Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (70, 22, 'Hoàng Mai', 1, 0, 1);
INSERT INTO `districts` VALUES (71, 36, 'Đơn Dương', 1, 0, 0);
INSERT INTO `districts` VALUES (72, 51, 'Huyện Hoà Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (73, 51, 'Huyện Bến Cầu', 1, 0, 0);
INSERT INTO `districts` VALUES (74, 36, 'Lạc Dương', 1, 0, 0);
INSERT INTO `districts` VALUES (75, 42, 'Đoan Hùng', 1, 0, 0);
INSERT INTO `districts` VALUES (76, 36, 'Đạ Huoai', 1, 0, 0);
INSERT INTO `districts` VALUES (77, 51, 'Huyện Gò Dầu', 1, 0, 0);
INSERT INTO `districts` VALUES (78, 51, 'Huyện Trảng Bàng', 1, 0, 0);
INSERT INTO `districts` VALUES (79, 36, 'Đạ Tẻh', 1, 0, 0);
INSERT INTO `districts` VALUES (80, 42, 'Thanh Ba', 1, 0, 0);
INSERT INTO `districts` VALUES (81, 36, 'Cát Tiên', 1, 0, 0);
INSERT INTO `districts` VALUES (83, 36, 'Lâm Hà', 1, 0, 0);
INSERT INTO `districts` VALUES (84, 11, 'Thành phố Phan Thiết', 1, 0, 0);
INSERT INTO `districts` VALUES (85, 11, 'Huyện Tuy Phong', 1, 0, 0);
INSERT INTO `districts` VALUES (86, 36, 'Bảo Lâm', 1, 0, 0);
INSERT INTO `districts` VALUES (87, 22, 'Từ Liêm', 1, 0, 1);
INSERT INTO `districts` VALUES (88, 11, 'Huyện Bắc Bình', 1, 0, 0);
INSERT INTO `districts` VALUES (89, 36, 'Đam Rông', 1, 0, 0);
INSERT INTO `districts` VALUES (91, 22, 'Thanh Trì', 1, 0, 1);
INSERT INTO `districts` VALUES (92, 11, 'Hàm Thuận Bắc', 1, 0, 0);
INSERT INTO `districts` VALUES (93, 22, 'Gia Lâm', 1, 0, 0);
INSERT INTO `districts` VALUES (95, 11, 'Hàm Thuận Nam', 1, 0, 0);
INSERT INTO `districts` VALUES (96, 30, 'Nha Trang', 1, 0, 0);
INSERT INTO `districts` VALUES (97, 58, 'Tuyên Quang', 1, 0, 0);
INSERT INTO `districts` VALUES (98, 11, 'Huyện Hàm Tân', 1, 0, 0);
INSERT INTO `districts` VALUES (99, 30, 'Vạn Ninh', 1, 0, 0);
INSERT INTO `districts` VALUES (100, 11, 'Huyện Đức Linh', 1, 0, 0);
INSERT INTO `districts` VALUES (101, 58, 'Na Hang', 1, 0, 0);
INSERT INTO `districts` VALUES (102, 11, 'Huyện Tánh Linh', 1, 0, 0);
INSERT INTO `districts` VALUES (103, 30, 'Ninh Hoà', 1, 0, 0);
INSERT INTO `districts` VALUES (104, 11, 'Huyện đảo Phú Quý', 1, 0, 0);
INSERT INTO `districts` VALUES (105, 58, 'Chiêm Hoá', 1, 0, 0);
INSERT INTO `districts` VALUES (106, 11, 'Thị xã La Gi', 1, 0, 0);
INSERT INTO `districts` VALUES (107, 30, 'Diên Khánh', 1, 0, 0);
INSERT INTO `districts` VALUES (108, 58, 'Hàm Yên', 1, 0, 0);
INSERT INTO `districts` VALUES (109, 58, 'Yên Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (110, 30, 'Khánh Vĩnh', 1, 0, 0);
INSERT INTO `districts` VALUES (111, 30, 'Cam Ranh', 1, 0, 0);
INSERT INTO `districts` VALUES (112, 58, 'Sơn Dương', 1, 0, 0);
INSERT INTO `districts` VALUES (113, 22, 'Hà Đông', 1, 1, 1);
INSERT INTO `districts` VALUES (115, 30, 'Khánh Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (116, 22, 'Sơn Tây', 1, 0, 0);
INSERT INTO `districts` VALUES (117, 22, 'Ba Vì', 1, 0, 0);
INSERT INTO `districts` VALUES (118, 30, 'Trường Sa', 1, 0, 0);
INSERT INTO `districts` VALUES (119, 17, 'Thành phố Biên Hoà', 1, 0, 0);
INSERT INTO `districts` VALUES (120, 22, 'Phúc Thọ', 1, 0, 0);
INSERT INTO `districts` VALUES (121, 17, 'Huyện Vĩnh Cửu', 1, 0, 0);
INSERT INTO `districts` VALUES (122, 30, 'Cam Lâm', 1, 0, 0);
INSERT INTO `districts` VALUES (123, 22, 'Thạch Thất', 1, 0, 0);
INSERT INTO `districts` VALUES (124, 22, 'Quốc Oai', 1, 0, 0);
INSERT INTO `districts` VALUES (127, 22, 'Chương Mỹ', 1, 0, 0);
INSERT INTO `districts` VALUES (128, 34, 'Lạng Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (129, 16, 'Buôn Ma Thuột', 1, 0, 0);
INSERT INTO `districts` VALUES (130, 22, 'Đan Phượng', 1, 0, 0);
INSERT INTO `districts` VALUES (131, 34, 'Tràng Định', 1, 0, 0);
INSERT INTO `districts` VALUES (132, 22, 'Hoài Đức', 1, 0, 0);
INSERT INTO `districts` VALUES (133, 16, 'Ea H Leo', 1, 0, 0);
INSERT INTO `districts` VALUES (134, 34, 'Bình Gia', 1, 0, 0);
INSERT INTO `districts` VALUES (135, 16, 'Krông Buk', 1, 0, 0);
INSERT INTO `districts` VALUES (136, 22, 'Thanh Oai', 1, 0, 0);
INSERT INTO `districts` VALUES (137, 17, 'Huyện Định Quán', 1, 0, 0);
INSERT INTO `districts` VALUES (138, 34, 'Văn Lãng', 1, 0, 0);
INSERT INTO `districts` VALUES (139, 22, 'Mỹ Đức', 1, 0, 0);
INSERT INTO `districts` VALUES (140, 16, 'Krông Năng', 1, 0, 0);
INSERT INTO `districts` VALUES (141, 34, 'Bắc Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (142, 22, 'Ứng Hoà', 1, 0, 0);
INSERT INTO `districts` VALUES (143, 16, 'Ea Súp', 1, 0, 0);
INSERT INTO `districts` VALUES (144, 17, 'Thống Nhất', 1, 0, 0);
INSERT INTO `districts` VALUES (145, 22, 'Thường Tín', 1, 0, 0);
INSERT INTO `districts` VALUES (146, 16, 'Cư M gar', 1, 0, 0);
INSERT INTO `districts` VALUES (147, 17, 'Định Quán', 1, 0, 0);
INSERT INTO `districts` VALUES (148, 22, 'Phú Xuyên', 1, 0, 0);
INSERT INTO `districts` VALUES (149, 34, 'Văn Quan', 1, 0, 0);
INSERT INTO `districts` VALUES (150, 22, 'Mê Linh', 1, 0, 0);
INSERT INTO `districts` VALUES (151, 17, 'Thị xã Long Khánh', 1, 0, 0);
INSERT INTO `districts` VALUES (152, 16, 'Krông Pắc', 1, 0, 0);
INSERT INTO `districts` VALUES (153, 17, 'Huyện Long Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (154, 16, 'Ea Kar', 1, 0, 0);
INSERT INTO `districts` VALUES (155, 17, 'Huyện Nhơn Trạch', 1, 0, 0);
INSERT INTO `districts` VALUES (156, 16, 'M&#39;Đrăk', 1, 0, 0);
INSERT INTO `districts` VALUES (157, 17, 'Huyện Trảng Bom', 1, 0, 0);
INSERT INTO `districts` VALUES (158, 16, 'Krông Ana', 1, 0, 0);
INSERT INTO `districts` VALUES (160, 16, 'Krông Bông', 1, 0, 0);
INSERT INTO `districts` VALUES (161, 29, 'Quận 1', 1, 0, 1);
INSERT INTO `districts` VALUES (162, 34, 'Cao Lộc', 1, 0, 0);
INSERT INTO `districts` VALUES (163, 29, 'Quận 2', 1, 0, 1);
INSERT INTO `districts` VALUES (164, 16, 'Lăk', 1, 0, 0);
INSERT INTO `districts` VALUES (165, 29, 'Quận 3', 1, 0, 1);
INSERT INTO `districts` VALUES (166, 29, 'Quận 4', 1, 0, 1);
INSERT INTO `districts` VALUES (167, 29, 'Quận 5', 1, 0, 1);
INSERT INTO `districts` VALUES (168, 29, 'Quận 6', 1, 0, 1);
INSERT INTO `districts` VALUES (169, 34, 'Lộc Bình', 1, 0, 0);
INSERT INTO `districts` VALUES (170, 29, 'Quận 7', 1, 0, 1);
INSERT INTO `districts` VALUES (171, 34, 'Chi Lăng', 1, 0, 0);
INSERT INTO `districts` VALUES (172, 29, 'Quận 8', 1, 0, 1);
INSERT INTO `districts` VALUES (173, 34, 'Đình Lập', 1, 0, 0);
INSERT INTO `districts` VALUES (174, 29, 'Quận 9', 1, 0, 1);
INSERT INTO `districts` VALUES (175, 34, 'Hữu Lũng', 1, 0, 0);
INSERT INTO `districts` VALUES (176, 29, 'Quận 10', 1, 0, 1);
INSERT INTO `districts` VALUES (177, 29, 'Quận 11', 1, 0, 1);
INSERT INTO `districts` VALUES (178, 29, 'Quận 12', 1, 0, 1);
INSERT INTO `districts` VALUES (179, 17, 'Huyện Tân Phú', 1, 0, 0);
INSERT INTO `districts` VALUES (180, 29, 'Gò Vấp', 1, 0, 1);
INSERT INTO `districts` VALUES (181, 16, 'Buôn Đôn', 1, 0, 0);
INSERT INTO `districts` VALUES (182, 29, 'Tân Bình', 1, 0, 1);
INSERT INTO `districts` VALUES (183, 17, 'Xuân Lộc', 1, 0, 0);
INSERT INTO `districts` VALUES (184, 16, 'Cư Kuin', 1, 0, 0);
INSERT INTO `districts` VALUES (185, 29, 'Tân Phú', 1, 0, 0);
INSERT INTO `districts` VALUES (186, 17, 'Cẩm Mỹ', 1, 0, 0);
INSERT INTO `districts` VALUES (187, 16, 'Buôn Hồ', 1, 0, 0);
INSERT INTO `districts` VALUES (188, 29, 'Bình Thạnh', 1, 0, 1);
INSERT INTO `districts` VALUES (189, 29, 'Phú Nhuận', 1, 0, 1);
INSERT INTO `districts` VALUES (191, 37, 'Tân An', 1, 0, 0);
INSERT INTO `districts` VALUES (192, 37, 'Vĩnh Hưng', 1, 0, 0);
INSERT INTO `districts` VALUES (194, 37, 'Mộc Hoá', 1, 0, 0);
INSERT INTO `districts` VALUES (195, 43, 'Tuy Hoà', 1, 0, 0);
INSERT INTO `districts` VALUES (196, 43, 'Đồng Xuân', 1, 0, 0);
INSERT INTO `districts` VALUES (197, 43, 'Sông Cầu', 1, 0, 0);
INSERT INTO `districts` VALUES (198, 43, 'Tuy An', 1, 0, 0);
INSERT INTO `districts` VALUES (199, 43, 'Sơn Hoà', 1, 0, 0);
INSERT INTO `districts` VALUES (200, 37, 'Tân Thạnh', 1, 0, 0);
INSERT INTO `districts` VALUES (201, 43, 'Sông Hinh', 1, 0, 0);
INSERT INTO `districts` VALUES (202, 43, 'Đông Hoà', 1, 0, 0);
INSERT INTO `districts` VALUES (203, 43, 'Phú Hoà', 1, 0, 0);
INSERT INTO `districts` VALUES (204, 37, 'Đức Huệ', 1, 0, 0);
INSERT INTO `districts` VALUES (205, 43, 'Tây Hoà', 1, 0, 0);
INSERT INTO `districts` VALUES (206, 37, 'Đức Hoà', 1, 0, 0);
INSERT INTO `districts` VALUES (207, 37, 'Bến Lức', 1, 0, 0);
INSERT INTO `districts` VALUES (208, 37, 'Thủ Thừa', 1, 0, 0);
INSERT INTO `districts` VALUES (209, 37, 'Châu Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (212, 37, 'Tân Trụ', 1, 0, 0);
INSERT INTO `districts` VALUES (213, 53, 'Thái Nguyên', 1, 0, 0);
INSERT INTO `districts` VALUES (214, 53, 'Sông Công', 1, 0, 0);
INSERT INTO `districts` VALUES (215, 37, 'Cần Đước', 1, 0, 0);
INSERT INTO `districts` VALUES (216, 53, 'Định Hoá', 1, 0, 0);
INSERT INTO `districts` VALUES (217, 37, 'Cần Giuộc', 1, 0, 0);
INSERT INTO `districts` VALUES (218, 53, 'Phú Lương', 1, 0, 0);
INSERT INTO `districts` VALUES (219, 37, 'Tân Hưng', 1, 0, 0);
INSERT INTO `districts` VALUES (220, 53, 'Võ Nhai', 1, 0, 0);
INSERT INTO `districts` VALUES (222, 53, 'Đại Từ', 1, 0, 0);
INSERT INTO `districts` VALUES (223, 18, 'Cao Lãnh', 1, 0, 0);
INSERT INTO `districts` VALUES (224, 53, 'Đồng Hỷ', 1, 0, 0);
INSERT INTO `districts` VALUES (225, 18, 'Sa Đéc', 1, 0, 0);
INSERT INTO `districts` VALUES (226, 53, 'Phú Bình', 1, 0, 0);
INSERT INTO `districts` VALUES (227, 18, 'Tân Hồng', 1, 0, 0);
INSERT INTO `districts` VALUES (228, 53, 'Phổ Yên', 1, 0, 0);
INSERT INTO `districts` VALUES (229, 18, 'Hồng Ngự', 1, 0, 0);
INSERT INTO `districts` VALUES (230, 18, 'Tam Nông', 1, 0, 0);
INSERT INTO `districts` VALUES (231, 18, 'Thanh Bình', 1, 0, 0);
INSERT INTO `districts` VALUES (233, 61, 'Yên Bái', 1, 0, 0);
INSERT INTO `districts` VALUES (234, 18, 'Lấp Vò', 1, 0, 0);
INSERT INTO `districts` VALUES (235, 61, 'Nghĩa Lộ', 1, 0, 0);
INSERT INTO `districts` VALUES (236, 18, 'Tháp Mười', 1, 0, 0);
INSERT INTO `districts` VALUES (237, 61, 'Văn Yên', 1, 0, 0);
INSERT INTO `districts` VALUES (238, 18, 'Lai Vung', 1, 0, 0);
INSERT INTO `districts` VALUES (239, 19, 'Pleiku', 1, 0, 0);
INSERT INTO `districts` VALUES (240, 61, 'Yên Bình', 1, 0, 0);
INSERT INTO `districts` VALUES (241, 18, 'Châu Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (242, 61, 'Cang Chải', 1, 0, 0);
INSERT INTO `districts` VALUES (243, 19, 'Chư Păh', 1, 0, 0);
INSERT INTO `districts` VALUES (244, 61, 'Văn Chấn', 1, 0, 0);
INSERT INTO `districts` VALUES (245, 19, 'Mang Yang', 1, 0, 0);
INSERT INTO `districts` VALUES (246, 61, 'Trấn Yên', 1, 0, 0);
INSERT INTO `districts` VALUES (247, 19, 'Kông Chro', 1, 0, 0);
INSERT INTO `districts` VALUES (249, 19, 'Đức Cơ', 1, 0, 0);
INSERT INTO `districts` VALUES (250, 66, 'Long Xuyên', 1, 0, 0);
INSERT INTO `districts` VALUES (251, 66, 'Châu Đốc', 1, 0, 0);
INSERT INTO `districts` VALUES (252, 19, 'Chư Prông', 1, 0, 0);
INSERT INTO `districts` VALUES (253, 61, 'Trạm Tấu', 1, 0, 0);
INSERT INTO `districts` VALUES (254, 66, 'An Phú', 1, 0, 0);
INSERT INTO `districts` VALUES (255, 19, 'Chư Sê', 1, 0, 0);
INSERT INTO `districts` VALUES (256, 66, 'Tân Châu', 1, 0, 0);
INSERT INTO `districts` VALUES (257, 19, 'Ia Grai', 1, 0, 0);
INSERT INTO `districts` VALUES (258, 66, 'Phú Tân', 1, 0, 0);
INSERT INTO `districts` VALUES (259, 66, 'Tịnh Biên', 1, 0, 0);
INSERT INTO `districts` VALUES (260, 19, 'Đăk Đoa', 1, 0, 0);
INSERT INTO `districts` VALUES (261, 66, 'Tri Tôn', 1, 0, 0);
INSERT INTO `districts` VALUES (262, 19, 'Ia Pa', 1, 0, 0);
INSERT INTO `districts` VALUES (263, 66, 'Châu Phú', 1, 0, 0);
INSERT INTO `districts` VALUES (264, 19, 'Đăk Pơ', 1, 0, 0);
INSERT INTO `districts` VALUES (265, 66, 'Chợ Mới', 1, 0, 0);
INSERT INTO `districts` VALUES (266, 19, 'K’Bang', 1, 0, 0);
INSERT INTO `districts` VALUES (267, 19, 'An Khê', 1, 0, 0);
INSERT INTO `districts` VALUES (268, 19, 'Ayun Pa', 1, 0, 0);
INSERT INTO `districts` VALUES (269, 66, 'Châu Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (270, 19, 'Krông Pa', 1, 0, 0);
INSERT INTO `districts` VALUES (271, 29, 'Thủ Đức', 1, 0, 1);
INSERT INTO `districts` VALUES (272, 19, 'Phú Thiện', 1, 0, 0);
INSERT INTO `districts` VALUES (273, 66, 'Thoại Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (274, 29, 'Bình Tân', 1, 0, 1);
INSERT INTO `districts` VALUES (275, 61, 'Lục Yên', 1, 0, 0);
INSERT INTO `districts` VALUES (276, 19, 'Chư Pưh', 1, 0, 0);
INSERT INTO `districts` VALUES (277, 29, 'Bình Chánh', 1, 0, 0);
INSERT INTO `districts` VALUES (278, 29, 'Củ Chi', 1, 0, 0);
INSERT INTO `districts` VALUES (280, 9, 'Quy Nhơn', 1, 0, 0);
INSERT INTO `districts` VALUES (281, 29, 'Hóc Môn', 1, 0, 0);
INSERT INTO `districts` VALUES (282, 29, 'Nhà Bè', 1, 0, 1);
INSERT INTO `districts` VALUES (283, 9, 'An Lão', 1, 0, 0);
INSERT INTO `districts` VALUES (285, 29, 'Cần Giờ', 1, 0, 0);
INSERT INTO `districts` VALUES (286, 9, 'Hoài Ân', 1, 0, 0);
INSERT INTO `districts` VALUES (287, 67, 'Vũng Tàu', 1, 0, 0);
INSERT INTO `districts` VALUES (288, 67, 'Bà Rịa', 1, 0, 0);
INSERT INTO `districts` VALUES (289, 9, 'Hoài Nhơn', 1, 0, 0);
INSERT INTO `districts` VALUES (290, 67, 'Xuyên Mộc', 1, 0, 0);
INSERT INTO `districts` VALUES (291, 67, 'Long Điền', 1, 0, 0);
INSERT INTO `districts` VALUES (292, 9, 'Phù Mỹ', 1, 0, 0);
INSERT INTO `districts` VALUES (293, 9, 'Phù Cát', 1, 0, 0);
INSERT INTO `districts` VALUES (294, 67, 'Côn Đảo', 1, 0, 0);
INSERT INTO `districts` VALUES (295, 9, 'Vĩnh Thạnh', 1, 0, 0);
INSERT INTO `districts` VALUES (296, 67, 'Tân Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (297, 67, 'Châu Đức', 1, 0, 0);
INSERT INTO `districts` VALUES (298, 9, 'Tây Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (300, 67, 'Đất Đỏ', 1, 0, 0);
INSERT INTO `districts` VALUES (301, 50, 'Sơn La', 1, 0, 0);
INSERT INTO `districts` VALUES (302, 9, 'Vân Canh', 1, 0, 0);
INSERT INTO `districts` VALUES (303, 50, 'Quỳnh Nhai', 1, 0, 0);
INSERT INTO `districts` VALUES (305, 50, 'Mường La', 1, 0, 0);
INSERT INTO `districts` VALUES (306, 9, 'An Nhơn', 1, 0, 0);
INSERT INTO `districts` VALUES (307, 56, 'Mü Tho', 1, 0, 0);
INSERT INTO `districts` VALUES (308, 50, 'Thuận Châu', 1, 0, 0);
INSERT INTO `districts` VALUES (309, 9, 'Tuy Phước', 1, 0, 0);
INSERT INTO `districts` VALUES (310, 50, 'Bắc Yên', 1, 0, 0);
INSERT INTO `districts` VALUES (311, 56, 'Gß C«ng', 1, 0, 0);
INSERT INTO `districts` VALUES (313, 56, 'Cái Bè', 1, 0, 0);
INSERT INTO `districts` VALUES (314, 50, 'Phù Yên', 1, 0, 0);
INSERT INTO `districts` VALUES (315, 32, 'KonTum', 1, 0, 0);
INSERT INTO `districts` VALUES (316, 50, 'Mai Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (317, 56, 'Cai Lậy', 1, 0, 0);
INSERT INTO `districts` VALUES (318, 32, 'Đăk Glei', 1, 0, 0);
INSERT INTO `districts` VALUES (319, 50, 'Yên Châu', 1, 0, 0);
INSERT INTO `districts` VALUES (320, 56, 'Châu Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (321, 32, 'Ngọc Hồi', 1, 0, 0);
INSERT INTO `districts` VALUES (322, 50, 'Sông Mã', 1, 0, 0);
INSERT INTO `districts` VALUES (323, 50, 'Mộc Châu', 1, 0, 0);
INSERT INTO `districts` VALUES (324, 32, 'Đăk Tô', 1, 0, 0);
INSERT INTO `districts` VALUES (325, 56, 'Chợ Gạo', 1, 0, 0);
INSERT INTO `districts` VALUES (326, 32, 'Sa Thầy', 1, 0, 0);
INSERT INTO `districts` VALUES (327, 50, 'Sốp Cộp', 1, 0, 0);
INSERT INTO `districts` VALUES (328, 56, 'Gò Công Tây', 1, 0, 0);
INSERT INTO `districts` VALUES (329, 32, 'Kon Plong', 1, 0, 0);
INSERT INTO `districts` VALUES (330, 32, 'Đăk Hà', 1, 0, 0);
INSERT INTO `districts` VALUES (331, 56, 'Gò Công Đông', 1, 0, 0);
INSERT INTO `districts` VALUES (332, 32, 'Kon Rộy', 1, 0, 0);
INSERT INTO `districts` VALUES (333, 32, 'Tu Mơ Rông', 1, 0, 0);
INSERT INTO `districts` VALUES (335, 56, 'Tân Phước', 1, 0, 0);
INSERT INTO `districts` VALUES (337, 4, 'Bắc Kạn', 1, 0, 0);
INSERT INTO `districts` VALUES (338, 56, 'Tân Phước Đông', 1, 0, 0);
INSERT INTO `districts` VALUES (339, 46, 'Quảng Ngãi', 1, 0, 0);
INSERT INTO `districts` VALUES (340, 4, 'Chợ Đồn', 1, 0, 0);
INSERT INTO `districts` VALUES (341, 46, 'Lý Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (342, 4, 'Bạch Thông', 1, 0, 0);
INSERT INTO `districts` VALUES (343, 46, 'Bình Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (344, 46, 'Trà Bồng', 1, 0, 0);
INSERT INTO `districts` VALUES (345, 46, 'Sơn Tịnh', 1, 0, 0);
INSERT INTO `districts` VALUES (346, 4, 'Na Rì', 1, 0, 0);
INSERT INTO `districts` VALUES (347, 46, 'Sơn Hà', 1, 0, 0);
INSERT INTO `districts` VALUES (348, 56, 'Tân Phú Đông', 1, 0, 0);
INSERT INTO `districts` VALUES (349, 46, 'Tư Nghĩa', 1, 0, 0);
INSERT INTO `districts` VALUES (350, 46, 'Nghĩa Hành', 1, 0, 0);
INSERT INTO `districts` VALUES (351, 4, 'Ngân Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (353, 46, 'Minh Long', 1, 0, 0);
INSERT INTO `districts` VALUES (354, 4, 'Ba Bể', 1, 0, 0);
INSERT INTO `districts` VALUES (355, 31, 'Rạch Giá', 1, 0, 0);
INSERT INTO `districts` VALUES (356, 4, 'Chợ Mới', 1, 0, 0);
INSERT INTO `districts` VALUES (357, 46, 'Mộ Đức', 1, 0, 0);
INSERT INTO `districts` VALUES (358, 31, 'Hà Tiên', 1, 0, 0);
INSERT INTO `districts` VALUES (359, 4, 'Pác Nặm', 1, 0, 0);
INSERT INTO `districts` VALUES (360, 46, 'Đức Phổ', 1, 0, 0);
INSERT INTO `districts` VALUES (361, 31, 'Kiên Lương', 1, 0, 0);
INSERT INTO `districts` VALUES (362, 31, 'Hòn Đất', 1, 0, 0);
INSERT INTO `districts` VALUES (363, 46, 'Ba Tơ', 1, 0, 0);
INSERT INTO `districts` VALUES (364, 42, 'Phú Thọ', 1, 0, 0);
INSERT INTO `districts` VALUES (365, 31, 'Tân Hiệp', 1, 0, 0);
INSERT INTO `districts` VALUES (366, 46, 'Sơn Tây', 1, 0, 0);
INSERT INTO `districts` VALUES (367, 31, 'Châu Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (368, 46, 'Tây Trà', 1, 0, 0);
INSERT INTO `districts` VALUES (369, 31, 'Giồng Riềng', 1, 0, 0);
INSERT INTO `districts` VALUES (370, 42, 'Hạ Hoà', 1, 0, 0);
INSERT INTO `districts` VALUES (371, 31, 'Gò Quao', 1, 0, 0);
INSERT INTO `districts` VALUES (372, 42, 'Cẩm Khê', 1, 0, 0);
INSERT INTO `districts` VALUES (374, 31, 'An Biên', 1, 0, 0);
INSERT INTO `districts` VALUES (375, 42, 'Yên Lập', 1, 0, 0);
INSERT INTO `districts` VALUES (376, 31, 'An Minh', 1, 0, 0);
INSERT INTO `districts` VALUES (377, 42, 'Thanh Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (378, 31, 'Vĩnh Thuận', 1, 0, 0);
INSERT INTO `districts` VALUES (379, 45, 'Tam Kỳ', 1, 0, 0);
INSERT INTO `districts` VALUES (380, 42, 'Phù Ninh', 1, 0, 0);
INSERT INTO `districts` VALUES (381, 31, 'Phú Quốc', 1, 0, 0);
INSERT INTO `districts` VALUES (382, 45, 'Hội An', 1, 0, 0);
INSERT INTO `districts` VALUES (383, 42, 'Lâm Thao', 1, 0, 0);
INSERT INTO `districts` VALUES (384, 31, 'Kiên Hải', 1, 0, 0);
INSERT INTO `districts` VALUES (385, 42, 'Tam Nông', 1, 0, 0);
INSERT INTO `districts` VALUES (386, 31, 'U Minh Thượng', 1, 0, 0);
INSERT INTO `districts` VALUES (387, 45, 'Duy Xuyên', 1, 0, 0);
INSERT INTO `districts` VALUES (388, 42, 'Thanh Thủy', 1, 0, 0);
INSERT INTO `districts` VALUES (389, 45, 'Điện Bàn', 1, 0, 0);
INSERT INTO `districts` VALUES (390, 42, 'Tân Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (391, 31, 'Giang Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (392, 45, 'Đại Lộc', 1, 0, 0);
INSERT INTO `districts` VALUES (394, 45, 'Quế Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (395, 14, 'Ninh Kiều', 1, 0, 0);
INSERT INTO `districts` VALUES (396, 45, 'Hiệp Đức', 1, 0, 0);
INSERT INTO `districts` VALUES (397, 14, 'Bình Thuỷ', 1, 0, 0);
INSERT INTO `districts` VALUES (398, 45, 'Thăng Bình', 1, 0, 0);
INSERT INTO `districts` VALUES (399, 14, 'Cái Răng', 1, 0, 0);
INSERT INTO `districts` VALUES (400, 14, 'Ô Môn', 1, 0, 0);
INSERT INTO `districts` VALUES (401, 45, 'Núi Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (402, 14, 'Phong Điền', 1, 0, 0);
INSERT INTO `districts` VALUES (403, 45, 'Tiên Phước', 1, 0, 0);
INSERT INTO `districts` VALUES (404, 14, 'Cờ Đỏ', 1, 0, 0);
INSERT INTO `districts` VALUES (405, 45, 'Bắc Trà My', 1, 0, 0);
INSERT INTO `districts` VALUES (406, 14, 'Vĩnh Thạnh', 1, 0, 0);
INSERT INTO `districts` VALUES (407, 14, 'Thốt Nốt', 1, 0, 0);
INSERT INTO `districts` VALUES (408, 45, 'Đông Giang', 1, 0, 0);
INSERT INTO `districts` VALUES (409, 14, 'Thới Lai', 1, 0, 0);
INSERT INTO `districts` VALUES (410, 45, 'Nam Giang', 1, 0, 0);
INSERT INTO `districts` VALUES (412, 45, 'Phước Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (413, 45, 'Nam Trà My', 1, 0, 0);
INSERT INTO `districts` VALUES (414, 7, 'Bến Tre', 1, 0, 0);
INSERT INTO `districts` VALUES (415, 45, 'Tây Giang', 1, 0, 0);
INSERT INTO `districts` VALUES (416, 45, 'Phú Ninh', 1, 0, 0);
INSERT INTO `districts` VALUES (417, 45, 'Nông Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (418, 7, 'Châu Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (420, 7, 'Chợ Lách', 1, 0, 0);
INSERT INTO `districts` VALUES (421, 7, 'Mỏ Cày Bắc', 1, 0, 0);
INSERT INTO `districts` VALUES (423, 7, 'Giồng Trôm', 1, 0, 0);
INSERT INTO `districts` VALUES (424, 55, 'Huế', 1, 0, 0);
INSERT INTO `districts` VALUES (425, 26, 'Hồng Bàng', 1, 0, 0);
INSERT INTO `districts` VALUES (426, 7, 'Bình Đại', 1, 0, 0);
INSERT INTO `districts` VALUES (427, 55, 'Phong Điền', 1, 0, 0);
INSERT INTO `districts` VALUES (428, 55, 'Quảng Điền', 1, 0, 0);
INSERT INTO `districts` VALUES (429, 7, 'Ba Tri', 1, 0, 0);
INSERT INTO `districts` VALUES (430, 7, 'Thạnh Phú', 1, 0, 0);
INSERT INTO `districts` VALUES (431, 55, 'Hương Trà', 1, 0, 0);
INSERT INTO `districts` VALUES (432, 7, 'Mỏ Cày Nam', 1, 0, 0);
INSERT INTO `districts` VALUES (433, 26, 'Lê Chân', 1, 0, 0);
INSERT INTO `districts` VALUES (434, 55, 'Phú Vang', 1, 0, 0);
INSERT INTO `districts` VALUES (435, 26, 'Ngô Quyền', 1, 0, 0);
INSERT INTO `districts` VALUES (436, 55, 'Hương Thuỷ', 1, 0, 0);
INSERT INTO `districts` VALUES (438, 26, 'Kiến An', 1, 0, 0);
INSERT INTO `districts` VALUES (439, 55, 'Phú Lộc', 1, 0, 0);
INSERT INTO `districts` VALUES (440, 59, 'Vĩnh Long', 1, 0, 0);
INSERT INTO `districts` VALUES (441, 42, 'Kiến An', 1, 0, 0);
INSERT INTO `districts` VALUES (442, 59, 'Long Hồ', 1, 0, 0);
INSERT INTO `districts` VALUES (443, 55, 'Nam Đông', 1, 0, 0);
INSERT INTO `districts` VALUES (444, 26, 'Hải An', 1, 0, 0);
INSERT INTO `districts` VALUES (445, 59, 'Mang Thít', 1, 0, 0);
INSERT INTO `districts` VALUES (446, 55, 'A Lưới', 1, 0, 0);
INSERT INTO `districts` VALUES (447, 26, 'Đồ Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (448, 59, 'Bình Minh', 1, 0, 0);
INSERT INTO `districts` VALUES (449, 26, 'An Lão', 1, 0, 0);
INSERT INTO `districts` VALUES (450, 59, 'Tam Bình', 1, 0, 0);
INSERT INTO `districts` VALUES (452, 26, 'Kiến Thụy', 1, 0, 0);
INSERT INTO `districts` VALUES (453, 59, 'Trà Ôn', 1, 0, 0);
INSERT INTO `districts` VALUES (454, 48, 'Đông Hà', 1, 0, 0);
INSERT INTO `districts` VALUES (455, 26, 'Thủy Nguyên', 1, 0, 0);
INSERT INTO `districts` VALUES (456, 26, 'An Dương', 1, 0, 0);
INSERT INTO `districts` VALUES (457, 48, 'Quảng Trị', 1, 0, 0);
INSERT INTO `districts` VALUES (458, 26, 'Tiên Lãng', 1, 0, 0);
INSERT INTO `districts` VALUES (459, 48, 'Vĩnh Linh', 1, 0, 0);
INSERT INTO `districts` VALUES (460, 26, 'Vĩnh Bảo', 1, 0, 0);
INSERT INTO `districts` VALUES (461, 48, 'Gio Linh', 1, 0, 0);
INSERT INTO `districts` VALUES (462, 48, 'Cam Lộ', 1, 0, 0);
INSERT INTO `districts` VALUES (463, 48, 'Triệu Phong', 1, 0, 0);
INSERT INTO `districts` VALUES (464, 48, 'Hải Lăng', 1, 0, 0);
INSERT INTO `districts` VALUES (465, 48, 'Hướng Hoá', 1, 0, 0);
INSERT INTO `districts` VALUES (466, 48, 'Đăk Rông', 1, 0, 0);
INSERT INTO `districts` VALUES (467, 48, 'Cồn Cỏ', 1, 0, 0);
INSERT INTO `districts` VALUES (469, 44, 'Đồng Hới', 1, 0, 0);
INSERT INTO `districts` VALUES (470, 59, 'Vũng Liêm', 1, 0, 0);
INSERT INTO `districts` VALUES (471, 44, 'Tuyên Hoá', 1, 0, 0);
INSERT INTO `districts` VALUES (472, 59, 'Bình Tân', 1, 0, 0);
INSERT INTO `districts` VALUES (473, 44, 'Minh Hoá', 1, 0, 0);
INSERT INTO `districts` VALUES (474, 44, 'Quảng Trạch', 1, 0, 0);
INSERT INTO `districts` VALUES (476, 57, 'Trà Vinh', 1, 0, 0);
INSERT INTO `districts` VALUES (477, 44, 'Bố Trạch', 1, 0, 0);
INSERT INTO `districts` VALUES (478, 57, 'Càng Long', 1, 0, 0);
INSERT INTO `districts` VALUES (479, 57, 'Cầu Kè', 1, 0, 0);
INSERT INTO `districts` VALUES (480, 44, 'Quảng Ninh', 1, 0, 0);
INSERT INTO `districts` VALUES (481, 57, 'Tiểu Cần', 1, 0, 0);
INSERT INTO `districts` VALUES (482, 44, 'Lệ Thuỷ', 1, 0, 0);
INSERT INTO `districts` VALUES (483, 57, 'Châu Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (484, 57, 'Trà Cú', 1, 0, 0);
INSERT INTO `districts` VALUES (485, 57, 'Cầu Ngang', 1, 0, 0);
INSERT INTO `districts` VALUES (487, 57, 'Duyên Hải', 1, 0, 0);
INSERT INTO `districts` VALUES (488, 24, 'Hà Tĩnh', 1, 0, 0);
INSERT INTO `districts` VALUES (489, 24, 'Hồng Lĩnh', 1, 0, 0);
INSERT INTO `districts` VALUES (490, 26, 'Cát Hải', 1, 0, 0);
INSERT INTO `districts` VALUES (492, 24, 'Hương Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (493, 49, 'Sóc Trăng', 1, 0, 0);
INSERT INTO `districts` VALUES (494, 26, 'Bạch Long Vĩ', 1, 0, 0);
INSERT INTO `districts` VALUES (495, 24, 'Đức Thọ', 1, 0, 0);
INSERT INTO `districts` VALUES (496, 49, 'Mỹ Xuyên', 1, 0, 0);
INSERT INTO `districts` VALUES (497, 26, 'Dương Kinh', 1, 0, 0);
INSERT INTO `districts` VALUES (498, 49, 'Thạnh Trị', 1, 0, 0);
INSERT INTO `districts` VALUES (499, 24, 'Nghi Xuân', 1, 0, 0);
INSERT INTO `districts` VALUES (500, 24, 'Can Lộc', 1, 0, 0);
INSERT INTO `districts` VALUES (501, 49, 'Cù Lao Dung', 1, 0, 0);
INSERT INTO `districts` VALUES (502, 49, 'Ngã Năm', 1, 0, 0);
INSERT INTO `districts` VALUES (503, 24, 'Hương Khê', 1, 0, 0);
INSERT INTO `districts` VALUES (505, 24, 'Thạch Hà', 1, 0, 0);
INSERT INTO `districts` VALUES (506, 49, 'Kế Sách', 1, 0, 0);
INSERT INTO `districts` VALUES (507, 24, 'Cẩm Xuyên', 1, 0, 0);
INSERT INTO `districts` VALUES (508, 49, 'Mỹ Tú', 1, 0, 0);
INSERT INTO `districts` VALUES (509, 24, 'Kỳ Anh', 1, 0, 0);
INSERT INTO `districts` VALUES (510, 15, 'Hải Châu', 1, 0, 0);
INSERT INTO `districts` VALUES (511, 49, 'Long Phú', 1, 0, 0);
INSERT INTO `districts` VALUES (512, 24, 'Vũ Quang', 1, 0, 0);
INSERT INTO `districts` VALUES (513, 49, 'Vĩnh Châu', 1, 0, 0);
INSERT INTO `districts` VALUES (514, 15, 'Thanh Khê', 1, 0, 0);
INSERT INTO `districts` VALUES (515, 24, 'Lộc Hà', 1, 0, 0);
INSERT INTO `districts` VALUES (516, 49, 'Châu Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (517, 15, 'Sơn Trà', 1, 0, 0);
INSERT INTO `districts` VALUES (518, 49, 'Trần Đề', 1, 0, 0);
INSERT INTO `districts` VALUES (519, 15, 'Ngũ Hành Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (521, 15, 'Liên Chiểu', 1, 0, 0);
INSERT INTO `districts` VALUES (522, 39, 'Vinh', 1, 0, 0);
INSERT INTO `districts` VALUES (524, 15, 'Hoà Vang', 1, 0, 0);
INSERT INTO `districts` VALUES (525, 39, 'Cửa Lò', 1, 0, 0);
INSERT INTO `districts` VALUES (526, 3, 'Bạc Liêu', 1, 0, 0);
INSERT INTO `districts` VALUES (527, 3, 'Vĩnh Lợi', 1, 0, 0);
INSERT INTO `districts` VALUES (528, 39, 'Quỳ Châu', 1, 0, 0);
INSERT INTO `districts` VALUES (529, 3, 'Hồng Dân', 1, 0, 0);
INSERT INTO `districts` VALUES (530, 39, 'Quỳ Hợp', 1, 0, 0);
INSERT INTO `districts` VALUES (531, 3, 'Giá Rai', 1, 0, 0);
INSERT INTO `districts` VALUES (532, 39, 'Nghĩa Đàn', 1, 0, 0);
INSERT INTO `districts` VALUES (533, 15, 'Cẩm Lệ', 1, 0, 0);
INSERT INTO `districts` VALUES (534, 3, 'Phước Long', 1, 0, 0);
INSERT INTO `districts` VALUES (535, 39, 'Quỳnh Lưu', 1, 0, 0);
INSERT INTO `districts` VALUES (536, 3, 'Đông Hải', 1, 0, 0);
INSERT INTO `districts` VALUES (537, 39, 'Kỳ Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (538, 3, 'Hoà Bình', 1, 0, 0);
INSERT INTO `districts` VALUES (539, 39, 'Tương Dương', 1, 0, 0);
INSERT INTO `districts` VALUES (540, 39, 'Con Cuông', 1, 0, 0);
INSERT INTO `districts` VALUES (542, 39, 'Tân Kỳ', 1, 0, 0);
INSERT INTO `districts` VALUES (543, 39, 'Yên Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (544, 39, 'Diễn Châu', 1, 0, 0);
INSERT INTO `districts` VALUES (545, 39, 'Anh Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (546, 39, 'Đô Lương', 1, 0, 0);
INSERT INTO `districts` VALUES (547, 39, 'Thanh Chương', 1, 0, 0);
INSERT INTO `districts` VALUES (548, 39, 'Nghi Lộc', 1, 0, 0);
INSERT INTO `districts` VALUES (549, 20, 'Đồng Văn', 1, 0, 0);
INSERT INTO `districts` VALUES (550, 20, 'Mèo Vạc', 1, 0, 0);
INSERT INTO `districts` VALUES (551, 39, 'Nam Đàn', 1, 0, 0);
INSERT INTO `districts` VALUES (553, 20, 'Yên Minh', 1, 0, 0);
INSERT INTO `districts` VALUES (554, 39, 'Hưng Nguyên', 1, 0, 0);
INSERT INTO `districts` VALUES (555, 20, 'Quản Bạ', 1, 0, 0);
INSERT INTO `districts` VALUES (556, 20, 'Vị Xuyên', 1, 0, 0);
INSERT INTO `districts` VALUES (557, 39, 'Quế Phong', 1, 0, 0);
INSERT INTO `districts` VALUES (558, 20, 'Bắc Mê', 1, 0, 0);
INSERT INTO `districts` VALUES (559, 39, 'Thái Hòa', 1, 0, 0);
INSERT INTO `districts` VALUES (560, 20, 'Hoàng Su Phì', 1, 0, 0);
INSERT INTO `districts` VALUES (561, 12, 'Cà Mau', 1, 0, 0);
INSERT INTO `districts` VALUES (563, 20, 'Xín Mần', 1, 0, 0);
INSERT INTO `districts` VALUES (564, 12, 'Thới Bình', 1, 0, 0);
INSERT INTO `districts` VALUES (565, 54, 'Thanh Hoá', 1, 0, 0);
INSERT INTO `districts` VALUES (566, 12, 'U Minh', 1, 0, 0);
INSERT INTO `districts` VALUES (567, 20, 'Bắc Quang', 1, 0, 0);
INSERT INTO `districts` VALUES (568, 54, 'Bỉm Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (569, 12, 'Trần Văn Thời', 1, 0, 0);
INSERT INTO `districts` VALUES (570, 54, 'Sầm Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (571, 20, 'Quang Bình', 1, 0, 0);
INSERT INTO `districts` VALUES (572, 12, 'Cái Nước', 1, 0, 0);
INSERT INTO `districts` VALUES (573, 54, 'Quan Hoá', 1, 0, 0);
INSERT INTO `districts` VALUES (574, 54, 'Quan Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (575, 54, 'Mường Lát', 1, 0, 0);
INSERT INTO `districts` VALUES (577, 54, 'Bá Thước', 1, 0, 0);
INSERT INTO `districts` VALUES (578, 13, 'Cao Bằng', 1, 0, 0);
INSERT INTO `districts` VALUES (579, 54, 'Thường Xuân', 1, 0, 0);
INSERT INTO `districts` VALUES (580, 13, 'Bảo Lạc', 1, 0, 0);
INSERT INTO `districts` VALUES (581, 13, 'Thông Nông', 1, 0, 0);
INSERT INTO `districts` VALUES (582, 54, 'Như Xuân', 1, 0, 0);
INSERT INTO `districts` VALUES (583, 54, 'Như Thanh', 1, 0, 0);
INSERT INTO `districts` VALUES (584, 54, 'Lang Chánh', 1, 0, 0);
INSERT INTO `districts` VALUES (585, 54, 'Ngọc Lặc', 1, 0, 0);
INSERT INTO `districts` VALUES (586, 54, 'Thạch Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (587, 54, 'Cẩm Thủy', 1, 0, 0);
INSERT INTO `districts` VALUES (588, 13, 'Hà Quảng', 1, 0, 0);
INSERT INTO `districts` VALUES (589, 54, 'Thọ Xuân', 1, 0, 0);
INSERT INTO `districts` VALUES (590, 13, 'Trà Lĩnh', 1, 0, 0);
INSERT INTO `districts` VALUES (591, 54, 'Vĩnh Lộc', 1, 0, 0);
INSERT INTO `districts` VALUES (592, 54, 'Thiệu Hoá', 1, 0, 0);
INSERT INTO `districts` VALUES (593, 54, 'Triệu Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (594, 12, 'Đầm Dơi', 1, 0, 0);
INSERT INTO `districts` VALUES (595, 54, 'Nông Cống', 1, 0, 0);
INSERT INTO `districts` VALUES (596, 12, 'Ngọc Hiển', 1, 0, 0);
INSERT INTO `districts` VALUES (597, 54, 'Đông Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (598, 12, 'Năm Căn', 1, 0, 0);
INSERT INTO `districts` VALUES (599, 54, 'Hà Trung', 1, 0, 0);
INSERT INTO `districts` VALUES (600, 12, 'Phú Tân', 1, 0, 0);
INSERT INTO `districts` VALUES (601, 54, 'Hoằng Hoá', 1, 0, 0);
INSERT INTO `districts` VALUES (603, 54, 'Nga Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (604, 69, 'Điện Biên Phủ', 1, 0, 0);
INSERT INTO `districts` VALUES (605, 54, 'Hậu Lộc', 1, 0, 0);
INSERT INTO `districts` VALUES (606, 69, 'Mường Lay', 1, 0, 0);
INSERT INTO `districts` VALUES (607, 54, 'Quảng Xương', 1, 0, 0);
INSERT INTO `districts` VALUES (608, 69, 'Điện Biên', 1, 0, 0);
INSERT INTO `districts` VALUES (609, 54, 'Tĩnh Gia', 1, 0, 0);
INSERT INTO `districts` VALUES (610, 69, 'Tuần Giáo', 1, 0, 0);
INSERT INTO `districts` VALUES (611, 54, 'Yên Định', 1, 0, 0);
INSERT INTO `districts` VALUES (612, 13, 'Trùng Khánh', 1, 0, 0);
INSERT INTO `districts` VALUES (613, 69, 'Mường Chà', 1, 0, 0);
INSERT INTO `districts` VALUES (614, 69, 'Tủa Chùa', 1, 0, 0);
INSERT INTO `districts` VALUES (615, 13, 'Nguyên Bình', 1, 0, 0);
INSERT INTO `districts` VALUES (616, 69, 'Điện Biên Đông', 1, 0, 0);
INSERT INTO `districts` VALUES (618, 69, 'Mường Nhé', 1, 0, 0);
INSERT INTO `districts` VALUES (619, 40, 'Thành phố Ninh Bình', 1, 0, 0);
INSERT INTO `districts` VALUES (620, 69, 'Mường Ảng', 1, 0, 0);
INSERT INTO `districts` VALUES (621, 40, 'Ninh Bình', 1, 0, 0);
INSERT INTO `districts` VALUES (622, 40, 'Tam Điệp', 1, 0, 0);
INSERT INTO `districts` VALUES (623, 40, 'Nho Quan', 1, 0, 0);
INSERT INTO `districts` VALUES (624, 40, 'Gia Viễn', 1, 0, 0);
INSERT INTO `districts` VALUES (625, 40, 'Hoa Lư', 1, 0, 0);
INSERT INTO `districts` VALUES (626, 40, 'Yên Mô', 1, 0, 0);
INSERT INTO `districts` VALUES (628, 40, 'Kim Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (629, 71, 'Gia Nghĩa', 1, 0, 0);
INSERT INTO `districts` VALUES (630, 40, 'Yên Khánh', 1, 0, 0);
INSERT INTO `districts` VALUES (631, 71, 'Dăk RLấp', 1, 0, 0);
INSERT INTO `districts` VALUES (632, 71, 'Dăk Mil', 1, 0, 0);
INSERT INTO `districts` VALUES (633, 71, 'Cư Jút', 1, 0, 0);
INSERT INTO `districts` VALUES (635, 13, 'Hoà An', 1, 0, 0);
INSERT INTO `districts` VALUES (636, 71, 'Dăk Song', 1, 0, 0);
INSERT INTO `districts` VALUES (637, 52, 'Thái Bình', 1, 0, 0);
INSERT INTO `districts` VALUES (638, 13, 'Quảng Uyên', 1, 0, 0);
INSERT INTO `districts` VALUES (639, 71, 'Krông Nô', 1, 0, 0);
INSERT INTO `districts` VALUES (640, 13, 'Thạch An', 1, 0, 0);
INSERT INTO `districts` VALUES (641, 52, 'Quỳnh Phụ', 1, 0, 0);
INSERT INTO `districts` VALUES (642, 71, 'Dăk GLong', 1, 0, 0);
INSERT INTO `districts` VALUES (643, 13, 'Hạ Lang', 1, 0, 0);
INSERT INTO `districts` VALUES (644, 52, 'Hưng Hà', 1, 0, 0);
INSERT INTO `districts` VALUES (645, 71, 'Tuy Đức', 1, 0, 0);
INSERT INTO `districts` VALUES (646, 13, 'Bảo Lâm', 1, 0, 0);
INSERT INTO `districts` VALUES (647, 52, 'Đông Hưng', 1, 0, 0);
INSERT INTO `districts` VALUES (648, 13, 'Phục Hoà', 1, 0, 0);
INSERT INTO `districts` VALUES (649, 52, 'Vũ Thư', 1, 0, 0);
INSERT INTO `districts` VALUES (651, 52, 'Kiến Xương', 1, 0, 0);
INSERT INTO `districts` VALUES (652, 70, 'Vị Thanh', 1, 0, 0);
INSERT INTO `districts` VALUES (654, 70, 'Vị Thuỷ', 1, 0, 0);
INSERT INTO `districts` VALUES (655, 52, 'Tiền Hải', 1, 0, 0);
INSERT INTO `districts` VALUES (656, 33, 'Lai Châu', 1, 0, 0);
INSERT INTO `districts` VALUES (657, 70, 'Long Mỹ', 1, 0, 0);
INSERT INTO `districts` VALUES (658, 52, 'Thái Thuỵ', 1, 0, 0);
INSERT INTO `districts` VALUES (659, 70, 'Phụng Hiệp', 1, 0, 0);
INSERT INTO `districts` VALUES (660, 33, 'Tam Đường', 1, 0, 0);
INSERT INTO `districts` VALUES (661, 70, 'Châu Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (662, 33, 'Phong Thổ', 1, 0, 0);
INSERT INTO `districts` VALUES (663, 70, 'Châu Thành A', 1, 0, 0);
INSERT INTO `districts` VALUES (665, 33, 'Sìn Hồ', 1, 0, 0);
INSERT INTO `districts` VALUES (666, 70, 'Ngã Bảy', 1, 0, 0);
INSERT INTO `districts` VALUES (667, 38, 'Nam Định', 1, 0, 0);
INSERT INTO `districts` VALUES (668, 33, 'Mường Tè', 1, 0, 0);
INSERT INTO `districts` VALUES (669, 38, 'Mỹ Lộc', 1, 0, 0);
INSERT INTO `districts` VALUES (670, 33, 'Than Uyên', 1, 0, 0);
INSERT INTO `districts` VALUES (671, 38, 'Xuân Trường', 1, 0, 0);
INSERT INTO `districts` VALUES (672, 33, 'Tân Uyên', 1, 0, 0);
INSERT INTO `districts` VALUES (673, 38, 'Giao Thủy', 1, 0, 0);
INSERT INTO `districts` VALUES (674, 38, 'Ý Yên', 1, 0, 0);
INSERT INTO `districts` VALUES (676, 38, 'Vụ Bản', 1, 0, 0);
INSERT INTO `districts` VALUES (677, 35, 'Lào Cai', 1, 0, 0);
INSERT INTO `districts` VALUES (678, 38, 'Nam Trực', 1, 0, 0);
INSERT INTO `districts` VALUES (679, 35, 'Xi Ma Cai', 1, 0, 0);
INSERT INTO `districts` VALUES (680, 38, 'Trực Ninh', 1, 0, 0);
INSERT INTO `districts` VALUES (681, 35, 'Bát Xát', 1, 0, 0);
INSERT INTO `districts` VALUES (682, 38, 'Nghĩa Hưng', 1, 0, 0);
INSERT INTO `districts` VALUES (683, 35, 'Bảo Thắng', 1, 0, 0);
INSERT INTO `districts` VALUES (684, 38, 'Hải Hậu', 1, 0, 0);
INSERT INTO `districts` VALUES (685, 35, 'Sa Pa', 1, 0, 0);
INSERT INTO `districts` VALUES (686, 35, 'Văn Bàn', 1, 0, 0);
INSERT INTO `districts` VALUES (688, 21, 'Phủ Lý', 1, 0, 0);
INSERT INTO `districts` VALUES (689, 21, 'Duy Tiên', 1, 0, 0);
INSERT INTO `districts` VALUES (690, 35, 'Bảo Yên', 1, 0, 0);
INSERT INTO `districts` VALUES (691, 21, 'Kim Bảng', 1, 0, 0);
INSERT INTO `districts` VALUES (692, 35, 'Bắc Hà', 1, 0, 0);
INSERT INTO `districts` VALUES (693, 21, 'Lý Nhân', 1, 0, 0);
INSERT INTO `districts` VALUES (694, 35, 'Mường Khương', 1, 0, 0);
INSERT INTO `districts` VALUES (695, 21, 'Thanh Liêm', 1, 0, 0);
INSERT INTO `districts` VALUES (696, 21, 'Bình Lục', 1, 0, 0);
INSERT INTO `districts` VALUES (698, 27, 'Hoà Bình', 1, 0, 0);
INSERT INTO `districts` VALUES (699, 27, 'Đà Bắc', 1, 0, 0);
INSERT INTO `districts` VALUES (700, 27, 'Mai Châu', 1, 0, 0);
INSERT INTO `districts` VALUES (701, 27, 'Tân Lạc', 1, 0, 0);
INSERT INTO `districts` VALUES (702, 27, 'Lạc Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (703, 27, 'Kỳ Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (704, 27, 'Lư¬ơng Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (705, 27, 'Kim Bôi', 1, 0, 0);
INSERT INTO `districts` VALUES (706, 27, 'Lạc Thuỷ', 1, 0, 0);
INSERT INTO `districts` VALUES (707, 27, 'Yên Thuỷ', 1, 0, 0);
INSERT INTO `districts` VALUES (708, 27, 'Cao Phong', 1, 0, 0);
INSERT INTO `districts` VALUES (710, 28, 'Hưng Yên', 1, 0, 0);
INSERT INTO `districts` VALUES (711, 28, 'Kim Động', 1, 0, 0);
INSERT INTO `districts` VALUES (712, 28, 'Ân Thi', 1, 0, 0);
INSERT INTO `districts` VALUES (713, 28, 'Khoái Châu', 1, 0, 0);
INSERT INTO `districts` VALUES (714, 28, 'Yên Mỹ', 1, 0, 0);
INSERT INTO `districts` VALUES (715, 28, 'Tiên Lữ', 1, 0, 0);
INSERT INTO `districts` VALUES (716, 28, 'Phù Cừ', 1, 0, 0);
INSERT INTO `districts` VALUES (717, 28, 'Mỹ Hào', 1, 0, 0);
INSERT INTO `districts` VALUES (718, 28, 'Văn Lâm', 1, 0, 0);
INSERT INTO `districts` VALUES (719, 28, 'Văn Giang', 1, 0, 0);
INSERT INTO `districts` VALUES (721, 25, 'Hải Dương', 1, 0, 0);
INSERT INTO `districts` VALUES (722, 25, 'Chí Linh', 1, 0, 0);
INSERT INTO `districts` VALUES (723, 25, 'Nam Sách', 1, 0, 0);
INSERT INTO `districts` VALUES (724, 25, 'Kinh Môn', 1, 0, 0);
INSERT INTO `districts` VALUES (725, 25, 'Gia Lộc', 1, 0, 0);
INSERT INTO `districts` VALUES (726, 25, 'Tứ Kỳ', 1, 0, 0);
INSERT INTO `districts` VALUES (727, 25, 'Thanh Miện', 1, 0, 0);
INSERT INTO `districts` VALUES (728, 25, 'Ninh Giang', 1, 0, 0);
INSERT INTO `districts` VALUES (729, 25, 'Cẩm Giàng', 1, 0, 0);
INSERT INTO `districts` VALUES (730, 25, 'Thanh Hà', 1, 0, 0);
INSERT INTO `districts` VALUES (731, 25, 'Kim Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (732, 25, 'Bình Giang', 1, 0, 0);
INSERT INTO `districts` VALUES (734, 6, 'Bắc Ninh', 1, 0, 0);
INSERT INTO `districts` VALUES (735, 6, 'Yên Phong', 1, 0, 0);
INSERT INTO `districts` VALUES (736, 6, 'Quế Võ', 1, 0, 0);
INSERT INTO `districts` VALUES (737, 6, 'Tiên Du', 1, 0, 0);
INSERT INTO `districts` VALUES (738, 6, 'Từ  Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (739, 6, 'Thuận Thành', 1, 0, 0);
INSERT INTO `districts` VALUES (740, 6, 'Gia Bình', 1, 0, 0);
INSERT INTO `districts` VALUES (741, 6, 'Lương Tài', 1, 0, 0);
INSERT INTO `districts` VALUES (743, 5, 'Bắc Giang', 1, 0, 0);
INSERT INTO `districts` VALUES (744, 5, 'Yên Thế', 1, 0, 0);
INSERT INTO `districts` VALUES (745, 5, 'Lục Ngạn', 1, 0, 0);
INSERT INTO `districts` VALUES (746, 5, 'Sơn Động', 1, 0, 0);
INSERT INTO `districts` VALUES (747, 5, 'Lục Nam', 1, 0, 0);
INSERT INTO `districts` VALUES (748, 5, 'Tân Yên', 1, 0, 0);
INSERT INTO `districts` VALUES (749, 5, 'Hiệp Hoà', 1, 0, 0);
INSERT INTO `districts` VALUES (750, 5, 'Lạng Giang', 1, 0, 0);
INSERT INTO `districts` VALUES (751, 5, 'Việt Yên', 1, 0, 0);
INSERT INTO `districts` VALUES (752, 5, 'Yên Dũng', 1, 0, 0);
INSERT INTO `districts` VALUES (754, 47, 'Hạ Long', 1, 0, 0);
INSERT INTO `districts` VALUES (755, 47, 'Cẩm Phả', 1, 0, 0);
INSERT INTO `districts` VALUES (756, 47, 'Uông Bí', 1, 0, 0);
INSERT INTO `districts` VALUES (757, 47, 'Móng Cái', 1, 0, 0);
INSERT INTO `districts` VALUES (758, 47, 'Bình Liêu', 1, 0, 0);
INSERT INTO `districts` VALUES (759, 47, 'Đầm Hà', 1, 0, 0);
INSERT INTO `districts` VALUES (760, 47, 'Hải Hà', 1, 0, 0);
INSERT INTO `districts` VALUES (761, 47, 'Tiên Yên', 1, 0, 0);
INSERT INTO `districts` VALUES (762, 47, 'Ba Chẽ', 1, 0, 0);
INSERT INTO `districts` VALUES (763, 47, 'Đông Triều', 1, 0, 0);
INSERT INTO `districts` VALUES (764, 47, 'Yên Hưng', 1, 0, 0);
INSERT INTO `districts` VALUES (765, 47, 'Hoành Bồ', 1, 0, 0);
INSERT INTO `districts` VALUES (766, 47, 'Vân Đồn', 1, 0, 0);
INSERT INTO `districts` VALUES (767, 47, 'Cô Tô', 1, 0, 0);
INSERT INTO `districts` VALUES (769, 60, 'Vĩnh Yên', 1, 0, 0);
INSERT INTO `districts` VALUES (770, 60, 'Tam Dương', 1, 0, 0);
INSERT INTO `districts` VALUES (771, 60, 'Lập Thạch', 1, 0, 0);
INSERT INTO `districts` VALUES (772, 60, 'Vĩnh Tường', 1, 0, 0);
INSERT INTO `districts` VALUES (773, 60, 'Yên Lạc', 1, 0, 0);
INSERT INTO `districts` VALUES (774, 60, 'Bình Xuyên', 1, 0, 0);
INSERT INTO `districts` VALUES (775, 60, 'Sông Lô', 1, 0, 0);
INSERT INTO `districts` VALUES (776, 60, 'Phúc Yên', 1, 0, 0);
INSERT INTO `districts` VALUES (777, 60, 'Tam Đảo', 1, 0, 0);
INSERT INTO `districts` VALUES (778, 68, 'Thành phố Nha Trang', 1, 0, 0);
INSERT INTO `districts` VALUES (779, 68, 'Huyện Vạn Ninh', 1, 0, 0);
INSERT INTO `districts` VALUES (780, 68, 'Huyện Ninh Hoà', 1, 0, 0);
INSERT INTO `districts` VALUES (781, 68, 'Huyện Diên Khánh', 1, 0, 0);
INSERT INTO `districts` VALUES (782, 68, 'Huyện Khánh Vĩnh', 1, 0, 0);
INSERT INTO `districts` VALUES (783, 68, 'Thị xã Cam Ranh', 1, 0, 0);
INSERT INTO `districts` VALUES (784, 68, 'Huyện Khánh Sơn', 1, 0, 0);
INSERT INTO `districts` VALUES (785, 68, 'Huyện đảo Trường Sa', 1, 0, 0);
INSERT INTO `districts` VALUES (786, 68, 'Huyện Cam Lâm', 1, 0, 0);
INSERT INTO `districts` VALUES (787, 15, 'Hoàng Sa', 1, 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `errors`
-- 

CREATE TABLE `errors` (
  `error_id` int(11) NOT NULL auto_increment,
  `error_card_type` varchar(50) NOT NULL,
  `error_response_code` varchar(5) NOT NULL,
  `error_title` varchar(255) NOT NULL,
  `error_message` text NOT NULL,
  `error_guide` text,
  `error_show` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`error_id`),
  UNIQUE KEY `error_id` (`error_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=176 ;

-- 
-- Dumping data for table `errors`
-- 

INSERT INTO `errors` VALUES (1, '1', '0', 'Giao dịch thành công', '<p>giao dịch th&agrave;nh c&ocirc;ng</p>', '', 0);
INSERT INTO `errors` VALUES (2, '1', '1', 'Ngân hàng từ chối giao dịch', '<p>C&oacute; thể bạn đ&atilde; nhập sai:</p>\n<ul>\n<li>T&ecirc;n truy cập hoặc mật khẩu của t&agrave;i khoản <strong>Internet Banking</strong></li>\n<li>Mật khẩu <strong>OTP</strong>, c&oacute; ph&acirc;n biệt chữ hoa v&agrave; chữ thường</li>\n</ul>', '<p>&nbsp;</p>\n<p>﻿</p>', 1);
INSERT INTO `errors` VALUES (3, '1', '3', 'Mã đơn vị không tồn tại', 'Mã đơn vị không tồn tại', '', 0);
INSERT INTO `errors` VALUES (4, '1', '4', 'Không đúng access code', '', '', 0);
INSERT INTO `errors` VALUES (5, '1', '5', 'Số tiền không hợp lệ', 'Số tiền không hợp lệ', '', 0);
INSERT INTO `errors` VALUES (6, '1', '6', 'Mã tiền tệ không tồn tại', '', '', 0);
INSERT INTO `errors` VALUES (7, '1', '7', 'Lỗi không xác định', '<ul>\n<li>Bạn vui l&ograve;ng gọi số điện thoại hỗ trợ 24/24 của VCB <strong>1900.545413</strong> hoặc <strong>04.3824.3524</strong> để biết chi tiết l&yacute; do</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (8, '1', '8', 'Số thẻ không đúng', '<p>Bạn nhập th&ocirc;ng tin thẻ kh&ocirc;ng đ&uacute;ng. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>T&ecirc;n in tr&ecirc;n thẻ, g&otilde; kh&ocirc;ng dấu</li>\n<li>Số thẻ l&agrave; 16 hoặc 19 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Ng&agrave;y ph&aacute;t h&agrave;nh của thẻ, v&iacute; dụ: 09/07</li>\n<li>Bạn chưa đổi m&atilde; PIN của thẻ. Nếu l&agrave; thẻ mới, bạn cần phải đổi m&atilde; PIN ở c&acirc;y ATM th&igrave; thẻ mới c&oacute; thể sử dụng được.</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (9, '1', '9', 'Tên chủ thẻ không đúng', '<p>Bạn nhập th&ocirc;ng tin thẻ kh&ocirc;ng đ&uacute;ng. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>T&ecirc;n in tr&ecirc;n thẻ, g&otilde; kh&ocirc;ng dấu</li>\n<li>Số thẻ l&agrave; 16 hoặc 19 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Ng&agrave;y ph&aacute;t h&agrave;nh của thẻ, v&iacute; dụ: 09/07</li>\n<li>Bạn chưa đổi m&atilde; PIN của thẻ. Nếu l&agrave; thẻ mới, bạn cần phải đổi m&atilde; PIN ở c&acirc;y ATM th&igrave; thẻ mới c&oacute; thể sử dụng được.</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (10, '1', '10', 'Thẻ hết hạn hoặc Thẻ bị khóa', '<p>Bạn đ&atilde; nhập sai ng&agrave;y ph&aacute;t h&agrave;nh của thẻ hoặc thẻ đ&atilde; bị kh&oacute;a. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>T&ecirc;n in tr&ecirc;n thẻ, g&otilde; kh&ocirc;ng dấu</li>\n<li>Số thẻ l&agrave; 16 hoặc 19 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Ng&agrave;y ph&aacute;t h&agrave;nh của thẻ, v&iacute; dụ: 09/07</li>\n<li>Bạn chưa đổi m&atilde; PIN của thẻ. Nếu l&agrave; thẻ mới, bạn cần phải đổi m&atilde; PIN ở c&acirc;y ATM th&igrave; thẻ mới c&oacute; thể sử dụng được.</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (11, '1', '11', 'Thẻ chưa đăng ký sử dụng dịch vụ thanh toán trực tuyến.', '<p>Thẻ của bạn chưa đăng k&yacute; sử dụng dịch vụ thanh to&aacute;n trực tuyến. Vui l&ograve;ng gọi số điện thoại hỗ trợ 24/24 của VCB <strong>1900.545413</strong> - <strong>04.3824.3524 </strong>hoặc <strong><a href="http://vcb.com.vn/EBanking/" target="_blank">xem chi tiết tại đ&acirc;y</a><br /></strong></p>', '', 1);
INSERT INTO `errors` VALUES (12, '1', '12', 'Ngày phát hành hoặc ngày hết hạn không đúng', '<p>Bạn nhập ng&agrave;y ph&aacute;t h&agrave;nh hoặc ng&agrave;y hết hạn kh&ocirc;ng đ&uacute;ng. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>T&ecirc;n in tr&ecirc;n thẻ, g&otilde; kh&ocirc;ng dấu</li>\n<li>Số thẻ l&agrave; 16 hoặc 19 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Ng&agrave;y ph&aacute;t h&agrave;nh của thẻ, v&iacute; dụ: 09/07</li>\n<li>Bạn chưa đổi m&atilde; PIN của thẻ. Nếu l&agrave; thẻ mới, bạn cần phải đổi m&atilde; PIN ở c&acirc;y ATM th&igrave; thẻ mới c&oacute; thể sử dụng được.</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (13, '1', '13', 'Vượt quá hạn mức thanh toán', '<p>Số tiền thanh to&aacute;n vượt qu&aacute; hạn mức thanh to&aacute;n. Vui l&ograve;ng gọi số điện thoại hỗ trợ 24/24 của VCB <strong>1900.545413</strong> hoặc <strong>04.3824.3524</strong></p>', '', 1);
INSERT INTO `errors` VALUES (14, '1', '21', 'Số dư không đủ để thanh toán', 'Số dư thẻ của bạn không đủ để thanh toán', '', 1);
INSERT INTO `errors` VALUES (15, '1', '99', 'Hủy giao dịch', 'Bạn đã huỷ bỏ thanh toán', '', 1);
INSERT INTO `errors` VALUES (16, '1', '100', 'Không nhập thông tin thẻ hoặc Hủy giao dịch thanh toán', '', '', 0);
INSERT INTO `errors` VALUES (17, '1', 'PG', 'Không tồn tại giao dịch trên hệ thống', '', '', 0);
INSERT INTO `errors` VALUES (18, '2', '0', 'Giao dịch thành công', '', '', 0);
INSERT INTO `errors` VALUES (19, '2', '1', 'Ngân hàng từ chối giao dịch', '<p>C&oacute; thể bạn đ&atilde; nhập sai:</p>\n<ul>\n<li>T&ecirc;n truy cập hoặc mật khẩu của t&agrave;i khoản <strong>Internet Banking</strong></li>\n<li>Mật khẩu <strong>OTP</strong> l&agrave; 6 chữ số hiển thị tr&ecirc;n <strong>Token Key</strong></li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (20, '2', '3', 'Mã đơn vị không tồn tại', 'Mã đơn vị không tồn tại', '', 1);
INSERT INTO `errors` VALUES (21, '2', '4', 'Không đúng access code', '', '', 0);
INSERT INTO `errors` VALUES (22, '2', '5', 'Số tiền không hợp lệ', 'Số tiền không hợp lệ', '', 1);
INSERT INTO `errors` VALUES (23, '2', '6', 'Mã tiền tệ không tồn tại', '', '', 0);
INSERT INTO `errors` VALUES (24, '2', '7', 'Lỗi không xác định', '', '', 0);
INSERT INTO `errors` VALUES (25, '2', '8', 'Số thẻ không đúng', 'Bạn nhập số thẻ không đúng', '', 1);
INSERT INTO `errors` VALUES (26, '2', '9', 'Tên chủ thẻ không đúng', 'Bạn nhập thông tin thẻ không đúng', '', 1);
INSERT INTO `errors` VALUES (27, '2', '10', 'Thẻ hết hạn hoặc Thẻ bị khóa', 'Bạn đã nhập sai ngày phát hành của thẻ hoặc thẻ đã bị khóa', '', 1);
INSERT INTO `errors` VALUES (28, '2', '11', 'Thẻ chưa đăng ký sử dụng dịch vụ thanh toán trực tuyến.', 'Thẻ của bạn chưa đăng ký sử dụng dịch vụ thanh toán trực tuyến. Vui lòng liên hệ với ngân hàng', '', 1);
INSERT INTO `errors` VALUES (29, '2', '12', 'Ngày phát hành hoặc ngày hết hạn không đúng', 'Bạn nhập ngày phát hành hoặc ngày hết hạn không đúng', '', 1);
INSERT INTO `errors` VALUES (30, '2', '13', 'Vượt quá hạn mức thanh toán', 'Số tiền thanh toán vượt quá hạn mức thanh toán', '', 1);
INSERT INTO `errors` VALUES (31, '2', '21', 'Số dư không đủ để thanh toán', 'Số dư thẻ của bạn không đủ để thanh toán', '', 1);
INSERT INTO `errors` VALUES (32, '2', '99', 'Hủy giao dịch', 'Bạn đã huỷ bỏ thanh toán', '', 1);
INSERT INTO `errors` VALUES (33, '2', '100', 'Không nhập thông tin thẻ hoặc Hủy giao dịch thanh toán', '', '', 0);
INSERT INTO `errors` VALUES (34, '2', 'PG', 'Không tồn tại giao dịch trên hệ thống', '', '', 0);
INSERT INTO `errors` VALUES (35, '3', '0', 'Giao dịch thành công', '', '', 0);
INSERT INTO `errors` VALUES (36, '3', '1', 'Ngân hàng từ chối giao dịch', '<p>C&oacute; thể bạn đ&atilde; nhập sai:</p>\n<ul>\n<li>T&ecirc;n truy cập hoặc mật khẩu của t&agrave;i khoản <strong>Internet Banking</strong></li>\n<li>Mật khẩu <strong>OTP</strong></li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (37, '3', '3', 'Mã đơn vị không tồn tại', 'Mã đơn vị không tồn tại', '', 0);
INSERT INTO `errors` VALUES (38, '3', '4', 'Không đúng access code', '', '', 0);
INSERT INTO `errors` VALUES (39, '3', '5', 'Số tiền không hợp lệ', 'Số tiền không hợp lệ', '', 0);
INSERT INTO `errors` VALUES (40, '3', '6', 'Mã tiền tệ không tồn tại', '', '', 0);
INSERT INTO `errors` VALUES (41, '3', '7', 'Lỗi không xác định', '<p>Bạn vui l&ograve;ng gọi số điện thoại hỗ trợ của Ti&ecirc;nPhongBank. Hotline <strong>1800.585885 </strong>(miễn ph&iacute;) hoặc <strong>04.37 683 683</strong> để biết chi tiết l&yacute; do</p>\n<ul>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (42, '3', '8', 'Số thẻ không đúng', '<p>Bạn nhập số thẻ kh&ocirc;ng đ&uacute;ng. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>Số thẻ l&agrave; 16 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Thẻ của bạn chưa đăng k&yacute; sử dụng dịch vụ thanh to&aacute;n trực tuyến, <strong><a href="http://www.tpb.com.vn/vn/khach-hang-ca-nhan/ngan-hang-dien-tu/internet-banking/" target="_blank">xem chi tiết tại đ&acirc;y</a></strong></li>\n<li>Bạn chưa đổi m&atilde; PIN của thẻ. Nếu l&agrave; thẻ mới, bạn cần phải đổi m&atilde; PIN ở c&acirc;y ATM th&igrave; thẻ mới c&oacute; thể sử dụng được.</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (43, '3', '9', 'Tên chủ thẻ không đúng', '<p>Bạn nhập số thẻ kh&ocirc;ng đ&uacute;ng. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>Số thẻ l&agrave; 16 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Thẻ của bạn chưa đăng k&yacute; sử dụng dịch vụ thanh to&aacute;n trực tuyến, <strong><a href="http://www.tpb.com.vn/vn/khach-hang-ca-nhan/ngan-hang-dien-tu/internet-banking/" target="_blank">xem chi tiết tại đ&acirc;y</a></strong></li>\n<li>Bạn chưa đổi m&atilde; PIN của thẻ. Nếu l&agrave; thẻ mới, bạn cần phải đổi m&atilde; PIN ở c&acirc;y ATM th&igrave; thẻ mới c&oacute; thể sử dụng được.</li>\n</ul>\n<div id="_mcePaste" style="position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px; overflow: hidden;">\n<p>h&ocirc;ng đ&uacute;ng. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>Số thẻ l&agrave; 16 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Bạn chưa đổi m&atilde; PIN của thẻ. Nếu l&agrave; thẻ mới, bạn cần phải đổi m&atilde; PIN ở c&acirc;y ATM th&igrave; thẻ mới c&oacute; thể sử dụng được.</li>\n</ul>\n</div>', '', 1);
INSERT INTO `errors` VALUES (44, '3', '10', 'Thẻ hết hạn hoặc Thẻ bị khóa', '<p>Bạn đ&atilde; nhập sai ng&agrave;y ph&aacute;t h&agrave;nh của thẻ hoặc thẻ đ&atilde; bị kh&oacute;a. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>Số thẻ l&agrave; 16 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Thẻ của bạn chưa đăng k&yacute; sử dụng dịch vụ thanh to&aacute;n trực tuyến, <strong><a href="http://www.tpb.com.vn/vn/khach-hang-ca-nhan/ngan-hang-dien-tu/internet-banking/" target="_blank">xem chi tiết tại đ&acirc;y</a></strong></li>\n<li>Bạn chưa đổi m&atilde; PIN của thẻ. Nếu l&agrave; thẻ mới, bạn cần phải đổi m&atilde; PIN ở c&acirc;y ATM th&igrave; thẻ mới c&oacute; thể sử dụng được.</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (45, '3', '11', 'Thẻ chưa đăng ký sử dụng dịch vụ thanh toán trực tuyến.', '<p>Thẻ của bạn chưa đăng k&yacute; sử dụng dịch vụ thanh to&aacute;n trực tuyến. Bạn vui l&ograve;ng gọi số điện thoại hỗ trợ của Ti&ecirc;nPhongBank. Hotline <strong>1800.585885 </strong>(miễn ph&iacute;) - <strong>04.37 683 683 </strong>hoặc <strong><a href="http://www.tpb.com.vn/vn/khach-hang-ca-nhan/ngan-hang-dien-tu/internet-banking/" target="_blank">xem chi tiết tại đ&acirc;y</a><br /></strong></p>', '', 1);
INSERT INTO `errors` VALUES (46, '3', '12', 'Ngày phát hành hoặc ngày hết hạn không đúng', 'Bạn nhập ngày phát hành hoặc ngày hết hạn không đúng', '', 1);
INSERT INTO `errors` VALUES (47, '3', '13', 'Vượt quá hạn mức thanh toán', 'Số tiền thanh toán vượt quá hạn mức thanh toán', '', 1);
INSERT INTO `errors` VALUES (48, '3', '21', 'Số dư không đủ để thanh toán', 'Số dư thẻ của bạn không đủ để thanh toán', '', 1);
INSERT INTO `errors` VALUES (49, '3', '99', 'Hủy giao dịch', 'Bạn đã huỷ bỏ thanh toán', '', 1);
INSERT INTO `errors` VALUES (50, '3', '100', 'Không nhập thông tin thẻ hoặc Hủy giao dịch thanh toán', '', '', 0);
INSERT INTO `errors` VALUES (51, '3', 'PG', 'Không tồn tại giao dịch trên hệ thống', '', '', 0);
INSERT INTO `errors` VALUES (52, '4', '0', 'Giao dịch thành công', '', '', 0);
INSERT INTO `errors` VALUES (53, '4', '1', 'Ngân hàng từ chối giao dịch', '<p>C&oacute; thể bạn đ&atilde; nhập sai:</p>\n<ul>\n<li>Mật khẩu của<strong> </strong><strong>dịch vụ thanh to&aacute;n trực tuyến<br /></strong></li>\n<li>Mật khẩu <strong>OTP</strong>: (10 chữ số) nhận qua SMS về số điện thoại di động đ&atilde; đăng k&yacute; với Vietinbank</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (54, '4', '3', 'Mã đơn vị không tồn tại', 'Mã đơn vị không tồn tại', '', 0);
INSERT INTO `errors` VALUES (55, '4', '4', 'Không đúng access code', '', '', 0);
INSERT INTO `errors` VALUES (56, '4', '5', 'Số tiền không hợp lệ', 'Số tiền không hợp lệ', '', 0);
INSERT INTO `errors` VALUES (57, '4', '6', 'Mã tiền tệ không tồn tại', '', '', 0);
INSERT INTO `errors` VALUES (58, '4', '7', 'Lỗi không xác định', '<p>Bạn vui l&ograve;ng gọi số điện thoại hỗ trợ của VietinBank: <strong>04.39421030</strong> để biết chi tiết l&yacute; do</p>', '', 1);
INSERT INTO `errors` VALUES (59, '4', '8', 'Số thẻ không đúng', '<p>Bạn nhập số thẻ kh&ocirc;ng đ&uacute;ng. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>T&ecirc;n in tr&ecirc;n thẻ, g&otilde; kh&ocirc;ng dấu</li>\n<li>Số thẻ l&agrave; 16 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Ng&agrave;y ph&aacute;t h&agrave;nh của thẻ, v&iacute; dụ: 09/07</li>\n<li>Bạn chưa đổi m&atilde; PIN của thẻ. Nếu l&agrave; thẻ mới, bạn cần phải đổi m&atilde; PIN ở c&acirc;y ATM th&igrave; thẻ mới c&oacute; thể sử dụng được.</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (60, '4', '9', 'Tên chủ thẻ không đúng', '<p>Bạn nhập th&ocirc;ng tin thẻ kh&ocirc;ng đ&uacute;ng. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>T&ecirc;n in tr&ecirc;n thẻ, g&otilde; kh&ocirc;ng dấu</li>\n<li>Số thẻ l&agrave; 16 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Ng&agrave;y ph&aacute;t h&agrave;nh của thẻ, v&iacute; dụ: 09/07</li>\n<li>Bạn chưa đổi m&atilde; PIN của thẻ. Nếu l&agrave; thẻ mới, bạn cần phải đổi m&atilde; PIN ở c&acirc;y ATM th&igrave; thẻ mới c&oacute; thể sử dụng được.</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (61, '4', '10', 'Thẻ hết hạn hoặc Thẻ bị khóa', '<p>Bạn đ&atilde; nhập sai ng&agrave;y ph&aacute;t h&agrave;nh của thẻ hoặc thẻ đ&atilde; bị kh&oacute;a. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>T&ecirc;n in tr&ecirc;n thẻ, g&otilde; kh&ocirc;ng dấu</li>\n<li>Số thẻ l&agrave; 16 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Ng&agrave;y ph&aacute;t h&agrave;nh của thẻ, v&iacute; dụ: 09/07</li>\n<li>Bạn chưa đổi m&atilde; PIN của thẻ. Nếu l&agrave; thẻ mới, bạn cần phải đổi m&atilde; PIN ở c&acirc;y ATM th&igrave; thẻ mới c&oacute; thể sử dụng được.</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (62, '4', '11', 'Thẻ chưa đăng ký sử dụng dịch vụ thanh toán trực tuyến.', '<p>Thẻ của bạn chưa đăng k&yacute; sử dụng dịch vụ thanh to&aacute;n trực tuyến. Bạn vui l&ograve;ng gọi số điện thoại hỗ trợ của VietinBank: <strong>04.39421030</strong> hoặc <strong><a href="http://www.vietinbank.vn/web/home/vn/product/card/service/intro_atmPayment.html" target="_blank">xem chi tiết tại đ&acirc;y</a><br /></strong></p>', '', 1);
INSERT INTO `errors` VALUES (63, '4', '12', 'Ngày phát hành hoặc ngày hết hạn không đúng', '<p>Bạn nhập ng&agrave;y ph&aacute;t h&agrave;nh hoặc ng&agrave;y hết hạn kh&ocirc;ng đ&uacute;ng. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>T&ecirc;n in tr&ecirc;n thẻ, g&otilde; kh&ocirc;ng dấu</li>\n<li>Số thẻ l&agrave; 16 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Ng&agrave;y ph&aacute;t h&agrave;nh của thẻ, v&iacute; dụ: 09/07</li>\n<li>Bạn chưa đổi m&atilde; PIN của thẻ. Nếu l&agrave; thẻ mới, bạn cần phải đổi m&atilde; PIN ở c&acirc;y ATM th&igrave; thẻ mới c&oacute; thể sử dụng được.</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (64, '4', '13', 'Vượt quá hạn mức thanh toán', 'Số tiền thanh toán vượt quá hạn mức thanh toán', '', 1);
INSERT INTO `errors` VALUES (65, '4', '21', 'Số dư không đủ để thanh toán', 'Số dư thẻ của bạn không đủ để thanh toán', '', 1);
INSERT INTO `errors` VALUES (66, '4', '99', 'Hủy giao dịch', 'Bạn đã huỷ bỏ thanh toán', '', 1);
INSERT INTO `errors` VALUES (67, '4', '100', 'Không nhập thông tin thẻ hoặc Hủy giao dịch thanh toán', '', '', 0);
INSERT INTO `errors` VALUES (68, '4', 'PG', 'Không tồn tại giao dịch trên hệ thống', '', '', 0);
INSERT INTO `errors` VALUES (69, '5', '0', 'Giao dịch thành công', '', '', 0);
INSERT INTO `errors` VALUES (70, '5', '1', 'Ngân hàng từ chối giao dịch', '<p>C&oacute; thể bạn đ&atilde; nhập sai:</p>\n<ul>\n<li>T&ecirc;n đăng nhập, Mật khẩu đ&atilde; đăng k&yacute; sử dụng VIB4U<strong></strong></li>\n<li>Mật khẩu <strong>OTP</strong> nhận qua SMS bằng c&aacute;ch soạn tin nhắn theo c&uacute; ph&aacute;p: <strong>VIB OTP gửi 6089</strong></li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (71, '5', '3', 'Mã đơn vị không tồn tại', 'Mã đơn vị không tồn tại', '', 0);
INSERT INTO `errors` VALUES (72, '5', '4', 'Không đúng access code', '', '', 0);
INSERT INTO `errors` VALUES (73, '5', '5', 'Số tiền không hợp lệ', 'Số tiền không hợp lệ', '', 0);
INSERT INTO `errors` VALUES (74, '5', '6', 'Mã tiền tệ không tồn tại', '', '', 0);
INSERT INTO `errors` VALUES (75, '5', '7', 'Lỗi không xác định', '<p>Bạn vui l&ograve;ng gọi số điện thoại hỗ trợ của VIB: <strong>04.62585858</strong> để biết chi tiết l&yacute; do</p>', '', 1);
INSERT INTO `errors` VALUES (76, '5', '8', 'Số thẻ không đúng', '<p>Bạn nhập số thẻ kh&ocirc;ng đ&uacute;ng. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>T&ecirc;n in tr&ecirc;n thẻ, g&otilde; kh&ocirc;ng dấu</li>\n<li>Số thẻ l&agrave; 16 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Ng&agrave;y ph&aacute;t h&agrave;nh của thẻ, v&iacute; dụ: 09/07</li>\n<li>Bạn chưa đổi m&atilde; PIN của thẻ. Nếu l&agrave; thẻ mới, bạn cần phải đổi m&atilde; PIN ở c&acirc;y ATM th&igrave; thẻ mới c&oacute; thể sử dụng được.</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (77, '5', '9', 'Tên chủ thẻ không đúng', '<p>Bạn nhập th&ocirc;ng tin thẻ kh&ocirc;ng đ&uacute;ng. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>T&ecirc;n in tr&ecirc;n thẻ, g&otilde; kh&ocirc;ng dấu</li>\n<li>Số thẻ l&agrave; 16 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Ng&agrave;y ph&aacute;t h&agrave;nh của thẻ, v&iacute; dụ: 09/07</li>\n<li>Bạn chưa đổi m&atilde; PIN của thẻ. Nếu l&agrave; thẻ mới, bạn cần phải đổi m&atilde; PIN ở c&acirc;y ATM th&igrave; thẻ mới c&oacute; thể sử dụng được.</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (78, '5', '10', 'Thẻ hết hạn hoặc Thẻ bị khóa', '<p>Bạn đ&atilde; nhập sai ng&agrave;y ph&aacute;t h&agrave;nh của thẻ hoặc thẻ đ&atilde; bị kh&oacute;a. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>T&ecirc;n in tr&ecirc;n thẻ, g&otilde; kh&ocirc;ng dấu</li>\n<li>Số thẻ l&agrave; 16 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Ng&agrave;y ph&aacute;t h&agrave;nh của thẻ, v&iacute; dụ: 09/07</li>\n<li>Bạn chưa đổi m&atilde; PIN của thẻ. Nếu l&agrave; thẻ mới, bạn cần phải đổi m&atilde; PIN ở c&acirc;y ATM th&igrave; thẻ mới c&oacute; thể sử dụng được.</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (79, '5', '11', 'Thẻ chưa đăng ký sử dụng dịch vụ thanh toán trực tuyến.', '<p>Thẻ của bạn chưa đăng k&yacute; sử dụng dịch vụ thanh to&aacute;n trực tuyến. Bạn vui l&ograve;ng gọi số điện thoại hỗ trợ của VIB: <strong>04.62585858 </strong>hoặc <strong><a href="http://www.vib.com.vn/Default.aspx?tabid=156" target="_blank">xem chi tiết tại đ&acirc;y</a><br /></strong></p>', '', 1);
INSERT INTO `errors` VALUES (80, '5', '12', 'Ngày phát hành hoặc ngày hết hạn không đúng', '<p>Bạn nhập ng&agrave;y ph&aacute;t h&agrave;nh hoặc ng&agrave;y hết hạn kh&ocirc;ng đ&uacute;ng. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>T&ecirc;n in tr&ecirc;n thẻ, g&otilde; kh&ocirc;ng dấu</li>\n<li>Số thẻ l&agrave; 16 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Ng&agrave;y ph&aacute;t h&agrave;nh của thẻ, v&iacute; dụ: 09/07</li>\n<li>Bạn chưa đổi m&atilde; PIN của thẻ. Nếu l&agrave; thẻ mới, bạn cần phải đổi m&atilde; PIN ở c&acirc;y ATM th&igrave; thẻ mới c&oacute; thể sử dụng được.</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (81, '5', '13', 'Vượt quá hạn mức thanh toán', 'Số tiền thanh toán vượt quá hạn mức thanh toán', '', 1);
INSERT INTO `errors` VALUES (82, '5', '21', 'Số dư không đủ để thanh toán', 'Số dư thẻ của bạn không đủ để thanh toán', '', 1);
INSERT INTO `errors` VALUES (83, '5', '99', 'Hủy giao dịch', 'Bạn đã huỷ bỏ thanh toán', '', 1);
INSERT INTO `errors` VALUES (84, '5', '100', 'Không nhập thông tin thẻ hoặc Hủy giao dịch thanh toán', '', '', 0);
INSERT INTO `errors` VALUES (85, '5', 'PG', 'Không tồn tại giao dịch trên hệ thống', '', '', 0);
INSERT INTO `errors` VALUES (86, '6', '0', 'Giao dịch thành công', '', '', 0);
INSERT INTO `errors` VALUES (87, '6', '1', 'Ngân hàng từ chối giao dịch', 'Ngân hàng từ chối giao dịch của bạn.', '', 1);
INSERT INTO `errors` VALUES (88, '6', '3', 'Mã đơn vị không tồn tại', 'Mã đơn vị không tồn tại', '', 1);
INSERT INTO `errors` VALUES (89, '6', '4', 'Không đúng access code', '', '', 0);
INSERT INTO `errors` VALUES (90, '6', '5', 'Số tiền không hợp lệ', 'Số tiền không hợp lệ', '', 1);
INSERT INTO `errors` VALUES (91, '6', '6', 'Mã tiền tệ không tồn tại', '', '', 0);
INSERT INTO `errors` VALUES (92, '6', '7', 'Lỗi không xác định', '', '', 0);
INSERT INTO `errors` VALUES (93, '6', '8', 'Số thẻ không đúng', 'Bạn nhập số thẻ không đúng', '', 1);
INSERT INTO `errors` VALUES (94, '6', '9', 'Tên chủ thẻ không đúng', 'Bạn nhập thông tin thẻ không đúng', '', 1);
INSERT INTO `errors` VALUES (95, '6', '10', 'Thẻ hết hạn hoặc Thẻ bị khóa', 'Bạn đã nhập sai ngày phát hành của thẻ hoặc thẻ đã bị khóa', '', 1);
INSERT INTO `errors` VALUES (96, '6', '11', 'Thẻ chưa đăng ký sử dụng dịch vụ thanh toán trực tuyến.', 'Thẻ của bạn chưa đăng ký sử dụng dịch vụ thanh toán trực tuyến. Vui lòng liên hệ với ngân hàng', '', 1);
INSERT INTO `errors` VALUES (97, '6', '12', 'Ngày phát hành hoặc ngày hết hạn không đúng', 'Bạn nhập ngày phát hành hoặc ngày hết hạn không đúng', '', 1);
INSERT INTO `errors` VALUES (98, '6', '13', 'Vượt quá hạn mức thanh toán', 'Số tiền thanh toán vượt quá hạn mức thanh toán', '', 1);
INSERT INTO `errors` VALUES (99, '6', '21', 'Số dư không đủ để thanh toán', 'Số dư thẻ của bạn không đủ để thanh toán', '', 1);
INSERT INTO `errors` VALUES (100, '6', '99', 'Hủy giao dịch', 'Bạn đã huỷ bỏ thanh toán', '', 1);
INSERT INTO `errors` VALUES (101, '6', '100', 'Không nhập thông tin thẻ hoặc Hủy giao dịch thanh toán', '', '', 0);
INSERT INTO `errors` VALUES (102, '6', 'PG', 'Không tồn tại giao dịch trên hệ thống', '', '', 0);
INSERT INTO `errors` VALUES (103, '7', '0', 'Giao dịch thành công', '', '', 0);
INSERT INTO `errors` VALUES (104, '7', '1', 'Ngân hàng từ chối giao dịch', 'Ngân hàng từ chối giao dịch của bạn.', '', 1);
INSERT INTO `errors` VALUES (105, '7', '3', 'Mã đơn vị không tồn tại', 'Mã đơn vị không tồn tại', '', 1);
INSERT INTO `errors` VALUES (106, '7', '4', 'Không đúng access code', '', '', 0);
INSERT INTO `errors` VALUES (107, '7', '5', 'Số tiền không hợp lệ', 'Số tiền không hợp lệ', '', 1);
INSERT INTO `errors` VALUES (108, '7', '6', 'Mã tiền tệ không tồn tại', '', '', 0);
INSERT INTO `errors` VALUES (109, '7', '7', 'Lỗi không xác định', '', '', 0);
INSERT INTO `errors` VALUES (110, '7', '8', 'Số thẻ không đúng', 'Bạn nhập số thẻ không đúng', '', 1);
INSERT INTO `errors` VALUES (111, '7', '9', 'Tên chủ thẻ không đúng', 'Bạn nhập thông tin thẻ không đúng', '', 1);
INSERT INTO `errors` VALUES (112, '7', '10', 'Thẻ hết hạn hoặc Thẻ bị khóa', 'Bạn đã nhập sai ngày phát hành của thẻ hoặc thẻ đã bị khóa', '', 1);
INSERT INTO `errors` VALUES (113, '7', '11', 'Thẻ chưa đăng ký sử dụng dịch vụ thanh toán trực tuyến.', 'Thẻ của bạn chưa đăng ký sử dụng dịch vụ thanh toán trực tuyến. Vui lòng liên hệ với ngân hàng', '', 1);
INSERT INTO `errors` VALUES (114, '7', '12', 'Ngày phát hành hoặc ngày hết hạn không đúng', 'Bạn nhập ngày phát hành hoặc ngày hết hạn không đúng', '', 1);
INSERT INTO `errors` VALUES (115, '7', '13', 'Vượt quá hạn mức thanh toán', 'Số tiền thanh toán vượt quá hạn mức thanh toán', '', 1);
INSERT INTO `errors` VALUES (116, '7', '21', 'Số dư không đủ để thanh toán', 'Số dư thẻ của bạn không đủ để thanh toán', '', 1);
INSERT INTO `errors` VALUES (117, '7', '99', 'Hủy giao dịch', 'Bạn đã huỷ bỏ thanh toán', '', 1);
INSERT INTO `errors` VALUES (118, '7', '100', 'Không nhập thông tin thẻ hoặc Hủy giao dịch thanh toán', '', '', 0);
INSERT INTO `errors` VALUES (119, '7', 'PG', 'Không tồn tại giao dịch trên hệ thống', '', '', 0);
INSERT INTO `errors` VALUES (120, 'Visa', '0', 'Giao dịch thành công', '', '', 0);
INSERT INTO `errors` VALUES (121, 'Visa', '?', 'Tình trạng giao dịch không xác định', '', '', 0);
INSERT INTO `errors` VALUES (122, 'Visa', '1', 'Lỗi không xác định', '<p>H&atilde;y chắc chắn rằng thẻ của bạn đ&atilde; được đăng k&yacute; chức năng <strong>thanh to&aacute;n trực tuyến</strong>. Vui l&ograve;ng gọi số hỗ trợ của Ng&acirc;n h&agrave;ng in mặt sau của thẻ để kiểm tra.</p>', '', 1);
INSERT INTO `errors` VALUES (123, 'Visa', '2', 'Ngân hàng từ chối giao dịch', '<p>Ng&acirc;n h&agrave;ng từ chối giao dịch của bạn, xin h&atilde;y kiểm tra lại c&aacute;c nguy&ecirc;n nh&acirc;n ch&iacute;nh sau:</p>\n<ul>\n<li>Số dư thẻ kh&ocirc;ng đủ thanh to&aacute;n</li>\n<li>Thẻ đ&atilde; hết hạn hoặc nhập sai ng&agrave;y hết hạn</li>\n<li>Chưa đăng k&yacute; chức năng thanh to&aacute;n trực tuyến với Ng&acirc;n h&agrave;ng</li>\n<li>Nhập sai m&atilde; bảo mật CSC của thẻ (3 số cuối mặt sau thẻ)</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (124, 'Visa', '3', 'Không có trả lời từ Ngân hàng', '', '', 0);
INSERT INTO `errors` VALUES (125, 'Visa', '4', 'Thẻ hết hạn', '<p><strong>Thẻ của bạn đ&atilde; hết hạn</strong> hoặc bạn đ&atilde; nhập sai th&ocirc;ng tin thẻ. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>Số thẻ l&agrave; 16 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Ng&agrave;y hết hạn của thẻ, v&iacute; dụ 05/2013</li>\n<li>M&atilde; bảo mật CSC: l&agrave; 3 chữ số cuối mặt sau của thẻ</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (126, 'Visa', '5', 'Số dư không đủ', 'Số dư thẻ của bạn không đủ để thanh toán', '', 1);
INSERT INTO `errors` VALUES (127, 'Visa', '6', 'Lỗi giao tiếp với Ngân hàng', '', '', 0);
INSERT INTO `errors` VALUES (128, 'Visa', '7', 'Lỗi Hệ thống máy chủ Thanh toán', '', '', 0);
INSERT INTO `errors` VALUES (129, 'Visa', '8', 'Giao dịch không được hỗ trợ', 'Thẻ của bạn không được hỗ trợ', '', 0);
INSERT INTO `errors` VALUES (130, 'Visa', '9', 'Ngân hàng từ chối giao dịch', '<p>Ng&acirc;n h&agrave;ng từ chối giao dịch của bạn. Vui l&ograve;ng gọi số hỗ trợ của Ng&acirc;n h&agrave;ng in mặt sau của thẻ để kiểm tra.</p>', '', 1);
INSERT INTO `errors` VALUES (131, 'Visa', 'A', 'giao dịch Aborted', '', '', 0);
INSERT INTO `errors` VALUES (132, 'Visa', 'B', 'Bị chặn do có rủi ro giả mạo', '', '', 0);
INSERT INTO `errors` VALUES (133, 'Visa', 'C', 'Huỷ bỏ giao dịch', 'Bạn đã huỷ bỏ thanh toán', '', 1);
INSERT INTO `errors` VALUES (134, 'Visa', 'D', 'Giao dịch hoãn lại đã được nhận và đang chờ xử lý', '', '', 0);
INSERT INTO `errors` VALUES (135, 'Visa', 'E', 'Sai mã bảo mật', '<p>C&oacute; thể bạn đ&atilde; nhập sai m&atilde; CVV/CVC2 l&agrave; ba chữ số cuối tr&ecirc;n dải chữ k&yacute; ở mặt thẻ ph&iacute;a sau của bạn</p>', '', 1);
INSERT INTO `errors` VALUES (136, 'Visa', 'F', 'Xác thực với ngân hàng không thành công', '<p>Bạn h&atilde;y kiểm tra lại c&aacute;c nguy&ecirc;n nh&acirc;n ch&iacute;nh sau:</p>\n<ul>\n<li>Bạn đ&atilde; nhập sai th&ocirc;ng tin x&aacute;c thực với Ng&acirc;n h&agrave;ng ph&aacute;t h&agrave;nh thẻ của bạn (c&oacute; thể l&agrave; ng&agrave;y sinh, OTP - mật khẩu thanh to&aacute;n 1 lần,...)</li>\n<li>Thẻ của bạn chưa được bật chức năng x&aacute;c thực: Verified by Visa (đối với thẻ Visa) hoặc MasterCard SecureCode (đối với thẻ MasterCard). H&atilde;y gọi số điện thoại in ph&iacute;a sau mặt thẻ để y&ecirc;u cầu bật chức năng n&agrave;y.</li>\n</ul>', '<p>Sau khi kh&aacute;ch nhập th&ocirc;ng tin thẻ Visa hoặc Master sẽ được chuyển sang x&aacute;c thực 1 số th&ocirc;ng tin với ng&acirc;n h&agrave;ng ph&aacute;t h&agrave;nh thẻ của kh&aacute;ch (hay gặp HSBC), th&ocirc;ng tin x&aacute;c thực mỗi ng&acirc;n h&agrave;ng 1 kh&aacute;c (v&iacute; dụ: mật khẩu thanh to&aacute;n 1 lần, ng&agrave;y sinh,...). Kh&aacute;ch đ&atilde; nhập sai th&ocirc;ng tin n&agrave;y, th&ocirc;ng b&aacute;o cho kh&aacute;ch nhập lại ch&iacute;nh x&aacute;c.</p>', 1);
INSERT INTO `errors` VALUES (137, 'Visa', 'I', 'Sai mã bảo mật', 'Mã bảo mật của thẻ không đúng', '', 1);
INSERT INTO `errors` VALUES (138, 'Visa', 'L', 'Chưa đăng ký dịch vụ thanh toán trực tuyến', '<p>Dịch vụ thanh to&aacute;n trực tuyến đ&atilde; bị kho&aacute;. Vui l&ograve;ng gọi số hỗ trợ của Ng&acirc;n h&agrave;ng in mặt sau của thẻ để kiểm tra.</p>', '', 1);
INSERT INTO `errors` VALUES (139, 'Visa', 'N', 'Chủ thẻ không ghi danh vào chương trình xác thực', '', '', 0);
INSERT INTO `errors` VALUES (140, 'Visa', 'P', 'giao dịch đã được nhận bởi các Adaptor thanh toán và đang được xử lý', '', '', 0);
INSERT INTO `errors` VALUES (141, 'Visa', 'R', 'giao dịch không được xử lý', '', '', 0);
INSERT INTO `errors` VALUES (142, 'Visa', 'S', 'SessionID bị trùng - OrderInfo', '', '', 0);
INSERT INTO `errors` VALUES (143, 'Visa', 'T', 'Địa chỉ xác minh không đúng', '', '', 0);
INSERT INTO `errors` VALUES (144, 'Visa', 'U', 'Sai mã bảo mật', 'Mã bảo mật của thẻ không đúng', '', 1);
INSERT INTO `errors` VALUES (145, 'Visa', 'V', 'Địa chỉ hoặc mã bảo mật không đúng', 'Địa chỉ xác minh và mã bảo mật của thẻ không đúng', '', 1);
INSERT INTO `errors` VALUES (146, 'Visa', '9999', 'Giao dịch có rủi ro giả mạo', '<p>Ch&uacute;ng t&ocirc;i từ chối giao dịch thanh to&aacute;n n&agrave;y của bạn. Xin h&atilde;y gọi <span style="text-decoration: underline;"><strong>04.39743410 - m&aacute;y lẻ 467</strong></span> để x&aacute;c thực chủ thẻ v&agrave; thanh to&aacute;n lại.</p>', '', 1);
INSERT INTO `errors` VALUES (147, 'Visa', 'PG', 'Không tồn tại giao dịch trên hệ thống', '', '', 0);
INSERT INTO `errors` VALUES (148, 'Mastercard', '0', 'Giao dịch thành công', '', '', 0);
INSERT INTO `errors` VALUES (149, 'Mastercard', '?', 'Tình trạng giao dịch không xác định', '', '', 0);
INSERT INTO `errors` VALUES (150, 'Mastercard', '1', 'Lỗi không xác định', '<p>H&atilde;y chắc chắn rằng thẻ của bạn đ&atilde; được đăng k&yacute; chức năng <strong>thanh to&aacute;n trực tuyến</strong>. Vui l&ograve;ng gọi số hỗ trợ của Ng&acirc;n h&agrave;ng in mặt sau của thẻ để kiểm tra.</p>', '', 1);
INSERT INTO `errors` VALUES (151, 'Mastercard', '2', 'Ngân hàng từ chối giao dịch', '<p>Ng&acirc;n h&agrave;ng từ chối giao dịch của bạn, xin h&atilde;y kiểm tra lại c&aacute;c nguy&ecirc;n nh&acirc;n ch&iacute;nh sau:</p>\n<ul>\n<li>Số dư thẻ kh&ocirc;ng đủ thanh to&aacute;n</li>\n<li>Thẻ đ&atilde; hết hạn hoặc nhập sai ng&agrave;y hết hạn</li>\n<li>Chưa đăng k&yacute; chức năng thanh to&aacute;n trực tuyến với Ng&acirc;n h&agrave;ng</li>\n<li>Nhập sai m&atilde; bảo mật CSC của thẻ (3 số cuối mặt sau thẻ)</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (152, 'Mastercard', '3', 'Không có trả lời từ Ngân hàng', '', '', 0);
INSERT INTO `errors` VALUES (153, 'Mastercard', '4', 'Thẻ hết hạn', '<p><strong>Thẻ của bạn đ&atilde; hết hạn</strong> hoặc bạn đ&atilde; nhập sai th&ocirc;ng tin thẻ. Xin h&atilde;y kiểm tra lại:</p>\n<ul>\n<li>Số thẻ l&agrave; 16 chữ số viết liền, kh&ocirc;ng c&oacute; dấu c&aacute;ch.</li>\n<li>Ng&agrave;y hết hạn của thẻ, v&iacute; dụ 05/2013</li>\n<li>M&atilde; bảo mật CSC: l&agrave; 3 chữ số cuối mặt sau của thẻ</li>\n</ul>', '', 1);
INSERT INTO `errors` VALUES (154, 'Mastercard', '5', 'Số dư không đủ', 'Số dư thẻ của bạn không đủ để thanh toán', '', 1);
INSERT INTO `errors` VALUES (155, 'Mastercard', '6', 'Lỗi giao tiếp với Ngân hàng', '', '', 0);
INSERT INTO `errors` VALUES (156, 'Mastercard', '7', 'Lỗi Hệ thống máy chủ Thanh toán', '', '', 0);
INSERT INTO `errors` VALUES (157, 'Mastercard', '8', 'Giao dịch không được hỗ trợ', 'Thẻ của bạn không được hỗ trợ', '', 1);
INSERT INTO `errors` VALUES (158, 'Mastercard', '9', 'Ngân hàng từ chối giao dịch', '<p>Ng&acirc;n h&agrave;ng từ chối giao dịch của bạn. Vui l&ograve;ng gọi số hỗ trợ của Ng&acirc;n h&agrave;ng in mặt sau của thẻ để kiểm tra.</p>', '', 1);
INSERT INTO `errors` VALUES (159, 'Mastercard', 'A', 'giao dịch Aborted', '', '', 0);
INSERT INTO `errors` VALUES (160, 'Mastercard', 'B', 'Bị chặn do có rủi ro giả mạo', '', '', 0);
INSERT INTO `errors` VALUES (161, 'Mastercard', 'C', 'Huỷ bỏ giao dịch', 'Bạn đã huỷ bỏ thanh toán', '', 1);
INSERT INTO `errors` VALUES (162, 'Mastercard', 'D', 'Giao dịch hoãn lại đã được nhận và đang chờ xử lý', '', '', 0);
INSERT INTO `errors` VALUES (163, 'Mastercard', 'E', 'Sai mã bảo mật', '<p>C&oacute; thể bạn đ&atilde; nhập sai m&atilde; CVV/CVC2 l&agrave; ba chữ số cuối tr&ecirc;n dải chữ k&yacute; ở mặt thẻ ph&iacute;a sau của bạn</p>', '', 1);
INSERT INTO `errors` VALUES (164, 'Mastercard', 'F', 'Xác thực với ngân hàng không thành công', '<p>Bạn h&atilde;y kiểm tra lại c&aacute;c nguy&ecirc;n nh&acirc;n ch&iacute;nh sau:</p>\n<ul>\n<li>Bạn đ&atilde; nhập sai th&ocirc;ng tin x&aacute;c thực với Ng&acirc;n h&agrave;ng ph&aacute;t h&agrave;nh thẻ của  bạn (c&oacute; thể l&agrave; ng&agrave;y sinh, OTP - mật khẩu thanh to&aacute;n 1 lần,...)</li>\n<li>Thẻ của bạn chưa được bật chức năng x&aacute;c thực: Verified by Visa  (đối với thẻ Visa) hoặc MasterCard SecureCode (đối với thẻ MasterCard).  H&atilde;y gọi số điện thoại in ph&iacute;a sau mặt thẻ để y&ecirc;u cầu bật chức năng n&agrave;y.</li>\n</ul>', '<p>Sau khi kh&aacute;ch nhập th&ocirc;ng tin thẻ Visa hoặc Master sẽ được chuyển sang  x&aacute;c thực 1 số th&ocirc;ng tin với ng&acirc;n h&agrave;ng ph&aacute;t h&agrave;nh thẻ của kh&aacute;ch (hay gặp  HSBC), th&ocirc;ng tin x&aacute;c thực mỗi ng&acirc;n h&agrave;ng 1 kh&aacute;c (v&iacute; dụ: mật khẩu thanh to&aacute;n 1 lần, ng&agrave;y sinh,...). Kh&aacute;ch đ&atilde; nhập sai th&ocirc;ng tin n&agrave;y, th&ocirc;ng b&aacute;o cho kh&aacute;ch nhập lại ch&iacute;nh x&aacute;c.</p>', 1);
INSERT INTO `errors` VALUES (165, 'Mastercard', 'I', 'Sai mã bảo mật', 'Mã bảo mật của thẻ không đúng', '', 1);
INSERT INTO `errors` VALUES (166, 'Mastercard', 'L', 'Chưa đăng ký dịch vụ thanh toán trực tuyến', '<p>Dịch vụ thanh to&aacute;n trực tuyến đ&atilde; bị kho&aacute;. Vui l&ograve;ng gọi số hỗ trợ của Ng&acirc;n h&agrave;ng in mặt sau của thẻ để kiểm tra.</p>', '', 1);
INSERT INTO `errors` VALUES (167, 'Mastercard', 'N', 'Chủ thẻ không ghi danh vào chương trình xác thực', '', '', 0);
INSERT INTO `errors` VALUES (168, 'Mastercard', 'P', 'giao dịch đã được nhận bởi các Adaptor thanh toán và đang được xử lý', '', '', 0);
INSERT INTO `errors` VALUES (169, 'Mastercard', 'R', 'giao dịch không được xử lý', '', '', 0);
INSERT INTO `errors` VALUES (170, 'Mastercard', 'S', 'SessionID bị trùng - OrderInfo', '', '', 0);
INSERT INTO `errors` VALUES (171, 'Mastercard', 'T', 'Địa chỉ xác minh không đúng', '', '', 0);
INSERT INTO `errors` VALUES (172, 'Mastercard', 'U', 'Sai mã bảo mật', 'Mã bảo mật của thẻ không đúng', '', 1);
INSERT INTO `errors` VALUES (173, 'Mastercard', 'V', 'Địa chỉ hoặc mã bảo mật không đúng', 'Địa chỉ xác minh và mã bảo mật của thẻ không đúng', '', 1);
INSERT INTO `errors` VALUES (174, 'Mastercard', '9999', 'Giao dịch có rủi ro giả mạo', '<p>Ch&uacute;ng t&ocirc;i từ chối giao dịch thanh to&aacute;n n&agrave;y của bạn. Xin h&atilde;y gọi <span style="text-decoration: underline;"><strong>04.39743410 - m&aacute;y lẻ 467</strong></span> để x&aacute;c thực chủ thẻ v&agrave; thanh to&aacute;n lại.</p>', '', 1);
INSERT INTO `errors` VALUES (175, 'Mastercard', 'PG', 'Không tồn tại giao dịch trên hệ thống', '', '', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `guests`
-- 

CREATE TABLE `guests` (
  `guest_id` int(11) NOT NULL auto_increment,
  `guest_fullname` varchar(255) collate utf8_unicode_ci default NULL,
  `guest_user_code` varchar(50) collate utf8_unicode_ci default NULL,
  `guest_email` varchar(255) collate utf8_unicode_ci default NULL,
  `guest_created` int(11) NOT NULL default '0',
  `guest_ip_signup` varchar(20) collate utf8_unicode_ci default NULL,
  `guest_phone` varchar(20) collate utf8_unicode_ci default NULL,
  `guest_mobile` varchar(20) collate utf8_unicode_ci default NULL,
  `guest_address` varchar(255) collate utf8_unicode_ci default NULL,
  `guest_status` tinyint(1) default NULL,
  `guest_active` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`guest_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=96 ;

-- 
-- Dumping data for table `guests`
-- 

INSERT INTO `guests` VALUES (1, '..................*********************************////////////////////////////////////////////////////////////////////////////////////////-----------------------------------------------------------------------', NULL, 'test@email.com', 1311664817, '192.168.3.55', NULL, '03252525252525252525', '', 1, 0);
INSERT INTO `guests` VALUES (2, '..................*********************************////////////////////////////////////////////////////////////////////////////////////////-----------------------------------------------------------------------', NULL, 'test@email.com', 1311664838, '192.168.3.55', NULL, '03252525252525252525', '', 1, 0);
INSERT INTO `guests` VALUES (3, '..................*********************************////////////////////////////////////////////////////////////////////////////////////////-----------------------------------------------------------------------', NULL, 'test@email.com', 1311664844, '192.168.3.55', NULL, '03252525252525252525', '', 1, 0);
INSERT INTO `guests` VALUES (4, ';delete from cms_user_tbl;', NULL, 'suongrongxanh30@yahoo.com', 1312173402, '192.168.3.55', NULL, '35345345', '', 1, 0);
INSERT INTO `guests` VALUES (5, 'Dzung Do Hai', NULL, 'test@email.com', 1312252796, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (6, 'Dzung Do Hai', NULL, 'test@email.com', 1312253002, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (7, 'Dzung Do Hai', NULL, 'test@email.com', 1312253779, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (8, 'Dzung Do Hai', NULL, 'test@email.com', 1312254298, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (9, 'Dzung Do Hai', NULL, 'test@email.com', 1312254323, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (10, 'Dzung Do Hai', NULL, 'test@email.com', 1312254549, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (11, ';delete from cms_user_tbl;', NULL, 'suongrongxanh30@yahoo.com', 1312254597, '192.168.3.55', NULL, '35345345', '', 1, 0);
INSERT INTO `guests` VALUES (12, ';delete from cms_user_tbl;', NULL, 'suongrongxanh30@yahoo.com', 1312254736, '192.168.3.55', NULL, '35345345', '', 1, 0);
INSERT INTO `guests` VALUES (13, 'Dzung Do Hai', NULL, 'test@email.com', 1312254805, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (14, 'Dzung Do Hai', NULL, 'test@email.com', 1312254816, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (15, ';delete from cms_user_tbl;', NULL, 'suongrongxanh30@yahoo.com', 1312254988, '192.168.3.55', NULL, '35345345', '', 1, 0);
INSERT INTO `guests` VALUES (16, ';delete from cms_user_tbl;', NULL, 'suongrongxanh30@yahoo.com', 1312255012, '192.168.3.55', NULL, '35345345', '', 1, 0);
INSERT INTO `guests` VALUES (17, 'Dzung Do Hai', NULL, 'test@email.com', 1312255156, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (18, ';delete from cms_user_tbl;', NULL, 'suongrongxanh30@yahoo.com', 1312256539, '192.168.3.55', NULL, '35345345', '', 1, 0);
INSERT INTO `guests` VALUES (19, ';delete from cms_user_tbl;', NULL, 'suongrongxanh30@yahoo.com', 1312256851, '192.168.3.55', NULL, '35345345', '', 1, 0);
INSERT INTO `guests` VALUES (20, ';delete from cms_user_tbl;', NULL, 'suongrongxanh30@yahoo.com', 1312257034, '192.168.3.55', NULL, '35345345', '', 1, 0);
INSERT INTO `guests` VALUES (21, ';delete from cms_user_tbl;', NULL, 'suongrongxanh30@yahoo.com', 1312270114, '192.168.3.55', NULL, '35345345', '', 1, 0);
INSERT INTO `guests` VALUES (22, ';delete from cms_user_tbl;', NULL, 'suongrongxanh30@yahoo.com', 1312339028, '192.168.3.55', NULL, '35345345', '', 1, 0);
INSERT INTO `guests` VALUES (23, 'Dzung Do Hai', NULL, 'test@email.com', 1312339363, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (24, 'Dzung Do Hai', NULL, 'test@email.com', 1312339378, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (25, 'Dzung Do Hai', NULL, 'test@email.com', 1313382193, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (26, 'Dzung Do Hai', NULL, 'test@email.com', 1313664524, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (27, 'Dzung Do Hai', NULL, 'test@email.com', 1313664535, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (28, 'Dzung Do Hai', NULL, 'test@email.com', 1313664599, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (29, 'Dzung Do Hai', NULL, 'test@email.com', 1313664619, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (30, 'Dzung Do Hai', NULL, 'test@email.com', 1313986242, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (31, 'Dzung Do Hai', NULL, 'test@email.com', 1314611358, '192.168.3.55', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (32, 'Tài Khoản Test', NULL, 'test@email.com', 1317769043, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (33, 'Tài Khoản Test', NULL, 'test@email.com', 1317769492, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (34, 'Tài Khoản Test', NULL, 'test@email.com', 1317769506, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (35, 'Tài Khoản Test', NULL, 'test@email.com', 1317853419, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (36, 'Tài Khoản Test', NULL, 'test@email.com', 1317854491, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (37, 'Tài Khoản Test', NULL, 'test@email.com', 1317854737, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (38, 'Tài Khoản Test', NULL, 'test@email.com', 1317854833, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (39, 'Tài Khoản Test', NULL, 'test@email.com', 1317854936, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (40, 'Tài Khoản Test', NULL, 'test@email.com', 1317922531, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (41, 'Tài Khoản Test', NULL, 'test@email.com', 1317923478, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (42, 'Tài Khoản Test', NULL, 'test@email.com', 1317924462, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (43, 'Tài Khoản Test', NULL, 'test@email.com', 1317924591, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (44, 'Tài Khoản Test', NULL, 'test@email.com', 1317924636, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (45, 'Tài Khoản Test', NULL, 'test@email.com', 1317924743, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (46, 'Tài Khoản Test', NULL, 'test@email.com', 1317926469, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (47, 'Tài Khoản Test', NULL, 'test@email.com', 1317942515, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (48, 'Tài Khoản Test', NULL, 'test@email.com', 1317942598, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (49, 'Tài Khoản Test', NULL, 'test@email.com', 1317942634, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (50, 'Tài Khoản Test', NULL, 'test@email.com', 1318024830, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (51, 'Tài Khoản Test', NULL, 'test@email.com', 1318028572, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (52, 'Dzung Do Hai', NULL, 'test@email.com', 1318266221, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (53, 'Dzung Do Hai', NULL, 'test@email.com', 1318286010, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (54, 'Dzung Do Hai', NULL, 'test@email.com', 1318286375, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (55, 'Dzung Do Hai', NULL, 'test@email.com', 1318287377, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (56, 'Dzung Do Hai', NULL, 'test@email.com', 1318287399, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (57, 'Dzung Do Hai', NULL, 'test@email.com', 1318353074, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (58, 'Dzung Do Hai', NULL, 'test@email.com', 1318353133, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (59, 'Dzung Do Hai', NULL, 'test@email.com', 1318353391, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (60, 'Dzung Do Hai', NULL, 'test@email.com', 1318307736, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (61, 'Dzung Do Hai', NULL, 'test@email.com', 1318307896, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (62, 'Dzung Do Hai', NULL, 'test@email.com', 1318308621, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (63, 'Dzung Do Hai', NULL, 'test@email.com', 1318563946, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (64, 'Dzung Do Hai', NULL, 'test@email.com', 1318563957, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (65, 'Dzung Do Hai', NULL, 'test@email.com', 1318563973, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (66, 'Tài Khoản Test', NULL, 'test@email.com', 1318839561, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (67, 'Tài Khoản Test', NULL, 'test@email.com', 1318840323, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (68, 'Tài Khoản Test', NULL, 'test@email.com', 1318843628, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (69, 'Tài Khoản Test', NULL, 'test@email.com', 1318845715, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (70, 'Tài Khoản Test', NULL, 'test@email.com', 1318846357, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (71, 'Tài Khoản Test', NULL, 'test@email.com', 1318846604, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (72, 'Tài Khoản Test', NULL, 'test@email.com', 1318847233, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (73, 'Tài Khoản Test', NULL, 'test@email.com', 1318848139, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (74, 'Tài Khoản Test', NULL, 'test@email.com', 1318848239, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (75, 'cao huong', NULL, 'caothilanhuong@gmail.com', 1318908363, '127.0.0.1', NULL, '01632195886', '', 1, 0);
INSERT INTO `guests` VALUES (76, 'cao huong', NULL, 'caothilanhuong@gmail.com', 1318908891, '127.0.0.1', NULL, '01632195886', '', 1, 0);
INSERT INTO `guests` VALUES (77, 'cao huong', NULL, 'caothilanhuong@gmail.com', 1318925029, '127.0.0.1', NULL, '01632195886', '', 1, 0);
INSERT INTO `guests` VALUES (78, 'cao huong', NULL, 'caothilanhuong@gmail.com', 1318925476, '127.0.0.1', NULL, '01632195886', '', 1, 0);
INSERT INTO `guests` VALUES (79, 'Dzung Do Hai', NULL, 'test@email.com', 1318994893, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (80, 'Dzung Do Hai', NULL, 'test@email.com', 1319168628, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (81, 'Dzung Do Hai', NULL, 'test@email.com', 1319168642, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (82, 'Dzung Do Hai', NULL, 'test@email.com', 1319168839, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (83, 'Dzung Do Hai', NULL, 'test@email.com', 1319168963, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (84, 'Dzung Do Hai', NULL, 'test@email.com', 1319169637, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (85, 'Dzung Do Hai', NULL, 'test@email.com', 1319169734, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (86, 'Dzung Do Hai', NULL, 'test@email.com', 1319170235, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (87, 'Dzung Do Hai', NULL, 'test@email.com', 1319170618, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (88, 'Dzung Do Hai', NULL, 'test@email.com', 1320656382, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (89, 'Dzung Do Hai', NULL, 'test@email.com', 1320658851, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (90, 'Dzung Do Hai', NULL, 'test@email.com', 1320811705, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (91, 'Dzung Do Hai', NULL, 'test@email.com', 1320912644, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (92, 'Dzung Do Hai', NULL, 'test@email.com', 1321001066, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (93, 'Dzung Do Hai', NULL, 'test@email.com', 1321001627, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (94, 'Dzung Do Hai', NULL, 'test@email.com', 1321001833, '127.0.0.1', NULL, '0989315924', '', 1, 0);
INSERT INTO `guests` VALUES (95, 'Dzung Do Hai', NULL, 'test@email.com', 1321605651, '127.0.0.1', NULL, '0989315924', '', 1, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `products`
-- 

CREATE TABLE `products` (
  `product_id` int(11) unsigned NOT NULL auto_increment,
  `product_name` varchar(255) NOT NULL,
  `product_desc` text,
  `product_price` varchar(50) default '0',
  `product_button_type` tinyint(3) unsigned default NULL,
  `product_user_id` int(11) unsigned default NULL,
  `product_created` int(11) unsigned default NULL,
  `product_updated` int(11) unsigned default NULL,
  `product_status` tinyint(4) default '1',
  `product_embed_html` mediumtext,
  `product_embed_bbcode` mediumtext,
  PRIMARY KEY  (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- 
-- Dumping data for table `products`
-- 

INSERT INTO `products` VALUES (1, 'Motorolla Xoom 25', 'blah blah', '110', 1, 2, 1308625950, 1311590711, 1, '<a href="PG_URL_ROOTpayment_product.php?id=1" target="_blank"><img src="PG_URL_ROOTimages/btn/muangay_small.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=1][img]PG_URL_ROOTimages/btn/muangay_small.gif[/img][/url]');
INSERT INTO `products` VALUES (2, 'sp test', 'test sản phẩm', '10000', 1, 2, 1311068044, 1315278636, 1, '<a href="PG_URL_ROOTpayment_product.php?id=2" target="_blank"><img src="PG_URL_ROOTimages/btn/muangay_small.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=2][img]PG_URL_ROOTimages/btn/muangay_small.gif[/img][/url]');
INSERT INTO `products` VALUES (3, 'test sp sửa', 'sp test\r\n\r\n[b]Truyền thông[/b]\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nend', '123456', 4, 2, 1311219178, 1314262279, 1, '<a href="PG_URL_ROOTpayment_product.php?id=3" target="_blank"><img src="PG_URL_ROOTimages/btn/thanhtoan_small.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=3][img]PG_URL_ROOTimages/btn/thanhtoan_small.gif[/img][/url]');
INSERT INTO `products` VALUES (4, 'test new', 'may thanh toán\r\nhttp://pay.todo.vn/user_product_button.php\r\n[b]Truyền thông[/b]', '101112320', 1, 2, 1311588990, 1314262219, 1, '<a href="PG_URL_ROOTpayment_product.php?id=4" target="_blank"><img src="PG_URL_ROOTimages/btn/muangay_small.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=4][img]PG_URL_ROOTimages/btn/muangay_small.gif[/img][/url]');
INSERT INTO `products` VALUES (10, '9', 'o', '121408', 1, 2, 1311648845, 1314262231, 1, '<a href="PG_URL_ROOTpayment_product.php?id=10" target="_blank"><img src="PG_URL_ROOTimages/btn/muangay_small.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=10][img]PG_URL_ROOTimages/btn/muangay_small.gif[/img][/url]');
INSERT INTO `products` VALUES (11, '9', '6', '20000', 3, 2, 1311648878, 1317183150, 1, '<iframe src="PG_URL_ROOTiframe_user_embed_button.php?id=3&url=PG_URL_ROOTpayment_product.php%3Fid%3D11" width="230" height="34" style="background-color: transparent;" allowtransparency="true" frameborder="0" scrolling="no"></iframe>', '');
INSERT INTO `products` VALUES (12, '123123123', '', '2', 1, 2, 1311651935, 1311652013, 1, '<a href="PG_URL_ROOTpayment_product.php?id=12" target="_blank"><img src="PG_URL_ROOTimages/btn/muangay_small.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=12][img]PG_URL_ROOTimages/btn/muangay_small.gif[/img][/url]');
INSERT INTO `products` VALUES (8, 'test Thanh toán sp', 'test thanh toán sp', '3000', 6, 2, 1311648719, 1317183138, 1, '<iframe src="PG_URL_ROOTiframe_user_embed_button.php?id=6&url=PG_URL_ROOTpayment_product.php%3Fid%3D8" width="230" height="34" style="background-color: transparent;" allowtransparency="true" frameborder="0" scrolling="no"></iframe>', '');
INSERT INTO `products` VALUES (9, 'hhhhhhhhhhhhhhhhhhhhhh', 'sd', '90', 5, 2, 1311648775, 1311653188, 1, '<a href="PG_URL_ROOTpayment_product.php?id=9" target="_blank"><img src="PG_URL_ROOTimages/btn/thanhtoan_card.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=9][img]PG_URL_ROOTimages/btn/thanhtoan_card.gif[/img][/url]');
INSERT INTO `products` VALUES (13, 'sản phẩm mới', 'test sp', '110', 1, 14, 1311758086, 1311760908, 1, '<a href="PG_URL_ROOTpayment_product.php?id=13" target="_blank"><img src="PG_URL_ROOTimages/btn/muangay_small.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=13][img]PG_URL_ROOTimages/btn/muangay_small.gif[/img][/url]');
INSERT INTO `products` VALUES (14, 'sfsd', 'sfsd', '3345345', 3, 2, 1312183886, 1312183886, 1, '<iframe src="PG_URL_ROOTiframe_user_embed_button.php?id=3&url=PG_URL_ROOTpayment_product.php%3Fid%3D14" width="230" height="33" style="background-color: transparent;" allowtransparency="true" frameborder="0" scrolling="no"></iframe>', '');
INSERT INTO `products` VALUES (15, 't', 't', '1', 4, 14, 1312261241, 1312261241, 1, '<a href="PG_URL_ROOTpayment_product.php?id=15" target="_blank"><img src="PG_URL_ROOTimages/btn/thanhtoan_small.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=15][img]PG_URL_ROOTimages/btn/thanhtoan_small.gif[/img][/url]');
INSERT INTO `products` VALUES (21, 'Motorolla Xoom 25', 'Điện thoại Motorolla mới', '2000000', 1, 2, 1315644549, 1315644549, 1, '<a href="PG_URL_ROOTpayment_product.php?id=21" target="_blank"><img src="PG_URL_ROOTimages/btn/muangay_small.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=21][img]PG_URL_ROOTimages/btn/muangay_small.gif[/img][/url]');
INSERT INTO `products` VALUES (17, 'kh hjh h                                                                                                               sfs sfsdf sdfsdf', '2', '1212121', 1, 2, 1313985045, 1313985905, 1, '<a href="PG_URL_ROOTpayment_product.php?id=17" target="_blank"><img src="PG_URL_ROOTimages/btn/muangay_small.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=17][img]PG_URL_ROOTimages/btn/muangay_small.gif[/img][/url]');
INSERT INTO `products` VALUES (19, 'test', '2234234234', '345345', 1, 2, 1315210638, 1315210638, 1, '<a href="PG_URL_ROOTpayment_product.php?id=19" target="_blank"><img src="PG_URL_ROOTimages/btn/muangay_small.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=19][img]PG_URL_ROOTimages/btn/muangay_small.gif[/img][/url]');
INSERT INTO `products` VALUES (20, 'test', 'sdfadasd', '500000', 1, 2, 1315217571, 1315217571, 1, '<a href="PG_URL_ROOTpayment_product.php?id=20" target="_blank"><img src="PG_URL_ROOTimages/btn/muangay_small.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=20][img]PG_URL_ROOTimages/btn/muangay_small.gif[/img][/url]');
INSERT INTO `products` VALUES (22, 'test mới 15', 'test mới 15', '100000', 4, 2, 1316077818, 1316077818, 1, '<a href="PG_URL_ROOTpayment_product.php?id=22" target="_blank"><img src="PG_URL_ROOTimages/btn/thanhtoan_small.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=22][img]PG_URL_ROOTimages/btn/thanhtoan_small.gif[/img][/url]');
INSERT INTO `products` VALUES (24, 'sản phẩm 1', 'test sản phẩm 1', '1000', 1, 4, 1316426148, 1316426148, 1, '<a href="PG_URL_ROOTpayment_product.php?id=24" target="_blank"><img src="PG_URL_ROOTimages/btn/muangay_small.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=24][img]PG_URL_ROOTimages/btn/muangay_small.gif[/img][/url]');
INSERT INTO `products` VALUES (25, 'sản phẩm 2', 'Test sản phẩm 2 nhé', '1000', 2, 4, 1316488191, 1316488191, 1, '<a href="PG_URL_ROOTpayment_product.php?id=25" target="_blank"><img src="PG_URL_ROOTimages/btn/muangay_card.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=25][img]PG_URL_ROOTimages/btn/muangay_card.gif[/img][/url]');
INSERT INTO `products` VALUES (26, 'sản phẩm 3', 'test sản phẩm 3 nhé', '10000', 3, 4, 1316488209, 1316488209, 1, '<iframe src="PG_URL_ROOTiframe_user_embed_button.php?id=3&url=PG_URL_ROOTpayment_product.php%3Fid%3D26" width="230" height="34" style="background-color: transparent;" allowtransparency="true" frameborder="0" scrolling="no"></iframe>', '');
INSERT INTO `products` VALUES (27, 'sản phẩm 4', 'test sản phẩm 4', '10000', 4, 4, 1316488262, 1316488262, 1, '<a href="PG_URL_ROOTpayment_product.php?id=27" target="_blank"><img src="PG_URL_ROOTimages/btn/thanhtoan_small.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=27][img]PG_URL_ROOTimages/btn/thanhtoan_small.gif[/img][/url]');
INSERT INTO `products` VALUES (28, 'sản phẩm 5', 'test sản phẩm 5', '10000', 5, 4, 1316488278, 1316488278, 1, '<a href="PG_URL_ROOTpayment_product.php?id=28" target="_blank"><img src="PG_URL_ROOTimages/btn/thanhtoan_card.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=28][img]PG_URL_ROOTimages/btn/thanhtoan_card.gif[/img][/url]');
INSERT INTO `products` VALUES (29, 'sản phẩm 6', 'test sản phẩm 6', '100000', 6, 4, 1316488295, 1316488295, 1, '<iframe src="PG_URL_ROOTiframe_user_embed_button.php?id=6&url=PG_URL_ROOTpayment_product.php%3Fid%3D29" width="230" height="34" style="background-color: transparent;" allowtransparency="true" frameborder="0" scrolling="no"></iframe>', '');
INSERT INTO `products` VALUES (30, 'Mua phiếu ăn trưa tại Sumo', 'Giảm 50% - chỉ còn jfdkajfk', '100000', 1, 2, 1320208056, 1320208056, 1, '<a href="PG_URL_ROOTpayment_product.php?id=30" target="_blank"><img src="PG_URL_ROOTimages/btn/muangay_small.gif" /></a>', '[url=PG_URL_ROOTpayment_product.php?id=30][img]PG_URL_ROOTimages/btn/muangay_small.gif[/img][/url]');

-- --------------------------------------------------------

-- 
-- Table structure for table `sites`
-- 

CREATE TABLE `sites` (
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
  `site_mc_feename` varchar(50) NOT NULL default '',
  `site_mc_feeper` varchar(20) NOT NULL default '',
  `site_mc_feefix` varchar(20) NOT NULL default '',
  `site_use_coupon` tinyint(1) default '0',
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `sites`
-- 

INSERT INTO `sites` VALUES (1, 1, 'u1', '', 'Công Ty TNHH X-one', 'xone.com', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, '', 1, NULL, '', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `system_emails`
-- 

CREATE TABLE `system_emails` (
  `system_email_id` int(11) NOT NULL auto_increment,
  `system_email_name` varchar(255) NOT NULL,
  `system_email_title` varchar(255) default NULL,
  `system_email_description` text,
  `system_email_subject` varchar(255) NOT NULL,
  `system_email_body` text,
  `system_email_vars` varchar(200) default NULL,
  PRIMARY KEY  (`system_email_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `system_emails`
-- 

INSERT INTO `system_emails` VALUES (1, 'ForgotPass', NULL, 'link kích hoạt mật khẩu', 'Email kích hoạt mật khẩu', '<p>Xin ch&agrave;o <strong>[user_name]</strong>,</p>\n<p>Ch&uacute;ng t&ocirc;i nhận được y&ecirc;u cầu reset lại mật khẩu đăng nhập website <a href="http://pay.soha.vn" target="_blank">pay.soha.vn</a>. Hệ thống sẽ tự động tạo lại mật khẩu mới v&agrave; gửi tới email <a href="%5Buser_email%5D">[user_email]</a> nếu bạn click v&agrave;o link sau:<br /><br /><a href="%5Buser_link%5D">[user_link]</a><br /><br /> ( Bạn c&oacute; thể copy v&agrave; paste link sau v&agrave; chạy tr&ecirc;n tr&igrave;nh duyệt: <a href="%5Buser_link%5D">[user_link]</a></p>\n<p><br /><strong> Pay soha Team</strong></p>', 'undefined');
INSERT INTO `system_emails` VALUES (5, 'verification', 'Xác thực Email', 'Gửi cho khách đăng ký để xác thực Email', 'Đăng ký tài khoản - Xác nhận địa chỉ Email', 'Xin chào [fullname],<br><br>Cảm ơn quý khách đã dùng Cổng thanh toán SohaPay.<br><br><b>Hãy nhấp chuột vào đường dẫn bên dưới để xác nhận địa chỉ email của quý khách </b><br><br><a target="_blank" href="[link]">[link]</a><br><br>Quý khách sẽ bị quay trả lại trang web chủ của SohaPay để hoàn tất việc đăng ký<br><br>Nếu quý khách không thể nhấp chuột vào đường dẫn, qúy khách hãy sao chép và dán địa chỉ trang web vào trình duyệt<br><br>Với những lời chúc tốt đẹp,<br><br>Cổng thanh toán SohaPay<br><br><a target="_blank" href="http://pay.soha.vn">pay.soha.vn</a><br><br>Đây là email tự động. Việc hồi âm cho địa chỉ email này sẽ không được ghi nhận.<br><br>..............................................................................................................................<br><br>LƯU Ý<br><br>Thông tin trong thư điện tử này là riêng tư và được bảo mật, và chỉ dành riêng cho người nhận. Nếu bạn không phải là người được nhận, xin thông báo với bạn là mọi sự tiết lộ, sao chép, phát tán hoặc sử dụng các thông tin này đều bị nghiêm cấm. Nếu bạn nhận được bức thư này vì nhầm lẫn, vui lòng xóa bỏ bức thư này mà không được phép sao chép hay tiết lộ thông tin trong thư.<br>', '[fullname],[email],[link]');
INSERT INTO `system_emails` VALUES (6, 'ChangePass', NULL, 'Thay đổi mật khau user', 'Thay đổi mật khẩu user', '<p>Xin ch&agrave;o <strong>[user_name]</strong>,</p>\n<p>Hệ thống <a href="http://pay.soha.vn" target="_blank">pay.soha.vn</a> đ&atilde; reset lại mật khẩu của bạn. Mật khẩu mới đề truy cập v&agrave;o <a href="http://pay.soha.vn" target="_blank">pay.soha.vn</a> l&agrave;:</p>\n<p>[user_password]<br /> <br /><strong> </strong></p>\n<p><strong>Pay soha Team</strong></p>', 'undefined');

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL auto_increment,
  `user_type` tinyint(4) NOT NULL default '1' COMMENT '1: Normal; 2: Merchant;',
  `user_email` varchar(70) NOT NULL default '',
  `user_username` varchar(50) NOT NULL default '',
  `user_password` varchar(50) NOT NULL default '',
  `user_password_method` tinyint(1) NOT NULL default '1',
  `user_fullname` varchar(255) NOT NULL default '',
  `user_address` varchar(255) NOT NULL default '',
  `user_district` int(11) default '0',
  `user_city` int(11) default '0',
  `user_address2` varchar(255) NOT NULL default '',
  `user_district2` int(11) default '0',
  `user_city2` int(11) default '0',
  `user_mobile` varchar(15) NOT NULL default '',
  `user_verified_mobile` tinyint(1) default '0',
  `user_gold` int(15) default '0',
  `user_gold_hash` varchar(32) default '',
  `user_goldhold` int(15) default '0',
  `user_goldhold_hash` varchar(32) default '',
  `user_goldblock` int(15) default '0',
  `user_goldblock_hash` varchar(32) default '',
  `user_signupdate` int(11) NOT NULL default '0',
  `user_lastlogindate` int(11) NOT NULL default '0',
  `user_lastactive` int(11) NOT NULL default '0',
  `user_ip_signup` varchar(20) NOT NULL default '',
  `user_ip_lastactive` varchar(20) NOT NULL default '',
  `user_logins` int(9) default '0',
  `user_code` varchar(255) default '',
  `user_verified` tinyint(1) default '0',
  `user_enabled` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (1, 2, 'ngockv@gmail.com', '', 'fb0f03774c38344e0cbf0243cae026ec', 1, 'Kiều Văn Ngọc', 'Nguyễn Khang', 60, 22, '', 0, 0, '0978686055', 0, 100000000, '', 0, '', 0, '', 1322562766, 1323103911, 1323104616, '127.0.0.1', '127.0.0.1', 2, '1Mb33qTGTUoaH6Bl', 1, 1);
