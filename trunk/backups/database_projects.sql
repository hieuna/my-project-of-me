-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Mar 20, 2012 at 03:34 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `database_projects`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_attachments`
-- 

CREATE TABLE `jos_attachments` (
  `id` int(11) NOT NULL auto_increment,
  `filename` varchar(80) NOT NULL,
  `filename_sys` varchar(255) NOT NULL,
  `file_type` varchar(128) NOT NULL,
  `file_size` int(11) unsigned NOT NULL,
  `url` text NOT NULL,
  `uri_type` enum('file','url') default 'file',
  `url_valid` tinyint(1) unsigned NOT NULL default '0',
  `display_name` varchar(80) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `icon_filename` varchar(20) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `published` tinyint(1) unsigned NOT NULL default '0',
  `user_field_1` varchar(100) NOT NULL default '',
  `user_field_2` varchar(100) NOT NULL default '',
  `user_field_3` varchar(100) NOT NULL default '',
  `parent_type` varchar(100) NOT NULL default 'com_content',
  `parent_entity` varchar(100) NOT NULL default 'ARTICLE',
  `parent_id` int(11) unsigned,
  `create_date` datetime default NULL,
  `modification_date` datetime default NULL,
  `download_count` int(11) unsigned default '0',
  PRIMARY KEY  (`id`),
  KEY `attachment_parent_id_index` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `jos_attachments`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `jos_banner`
-- 

CREATE TABLE `jos_banner` (
  `bid` int(11) NOT NULL auto_increment,
  `cid` int(11) NOT NULL default '0',
  `type` varchar(30) NOT NULL default 'banner',
  `name` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `imptotal` int(11) NOT NULL default '0',
  `impmade` int(11) NOT NULL default '0',
  `clicks` int(11) NOT NULL default '0',
  `imageurl` varchar(100) NOT NULL default '',
  `clickurl` varchar(200) NOT NULL default '',
  `date` datetime default NULL,
  `showBanner` tinyint(1) NOT NULL default '0',
  `checked_out` tinyint(1) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `editor` varchar(50) default NULL,
  `custombannercode` text,
  `catid` int(10) unsigned NOT NULL default '0',
  `description` text NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
  `tags` text NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY  (`bid`),
  KEY `viewbanner` (`showBanner`),
  KEY `idx_banner_catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `jos_banner`
-- 

INSERT INTO `jos_banner` VALUES (1, 1, 'banner', 'OSM 1', 'osm-1', 0, 43, 0, 'osmbanner1.png', 'http://www.opensourcematters.org', '2004-07-07 15:31:29', 1, 0, '0000-00-00 00:00:00', '', '', 13, '', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');
INSERT INTO `jos_banner` VALUES (2, 1, 'banner', 'OSM 2', 'osm-2', 0, 49, 0, 'osmbanner2.png', 'http://www.opensourcematters.org', '2004-07-07 15:31:29', 1, 0, '0000-00-00 00:00:00', '', '', 13, '', 0, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');
INSERT INTO `jos_banner` VALUES (3, 1, '', 'Joomla!', 'joomla', 0, 24, 0, '', 'http://www.joomla.org', '2006-05-29 14:21:28', 1, 0, '0000-00-00 00:00:00', '', '<a href="{CLICKURL}" target="_blank">{NAME}</a>\r\n<br/>\r\nJoomla! The most popular and widely used Open Source CMS Project in the world.', 14, '', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');
INSERT INTO `jos_banner` VALUES (4, 1, '', 'JoomlaCode', 'joomlacode', 0, 24, 0, '', 'http://joomlacode.org', '2006-05-29 14:19:26', 1, 0, '0000-00-00 00:00:00', '', '<a href="{CLICKURL}" target="_blank">{NAME}</a>\r\n<br/>\r\nJoomlaCode, development and distribution made easy.', 14, '', 0, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');
INSERT INTO `jos_banner` VALUES (5, 1, '', 'Joomla! Extensions', 'joomla-extensions', 0, 19, 0, '', 'http://extensions.joomla.org', '2006-05-29 14:23:21', 1, 0, '0000-00-00 00:00:00', '', '<a href="{CLICKURL}" target="_blank">{NAME}</a>\r\n<br/>\r\nJoomla! Components, Modules, Plugins and Languages by the bucket load.', 14, '', 0, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');
INSERT INTO `jos_banner` VALUES (6, 1, '', 'Joomla! Shop', 'joomla-shop', 0, 19, 0, '', 'http://shop.joomla.org', '2006-05-29 14:23:21', 1, 0, '0000-00-00 00:00:00', '', '<a href="{CLICKURL}" target="_blank">{NAME}</a>\r\n<br/>\r\nFor all your Joomla! merchandise.', 14, '', 0, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');
INSERT INTO `jos_banner` VALUES (7, 1, '', 'Joomla! Promo Shop', 'joomla-promo-shop', 0, 10, 1, 'shop-ad.jpg', 'http://shop.joomla.org', '2007-09-19 17:26:24', 1, 0, '0000-00-00 00:00:00', '', '', 33, '', 0, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');
INSERT INTO `jos_banner` VALUES (8, 1, '', 'Joomla! Promo Books', 'joomla-promo-books', 0, 15, 0, 'shop-ad-books.jpg', 'http://shop.joomla.org/amazoncom-bookstores.html', '2007-09-19 17:28:01', 1, 0, '0000-00-00 00:00:00', '', '', 33, '', 0, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_bannerclient`
-- 

CREATE TABLE `jos_bannerclient` (
  `cid` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `contact` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `extrainfo` text NOT NULL,
  `checked_out` tinyint(1) NOT NULL default '0',
  `checked_out_time` time default NULL,
  `editor` varchar(50) default NULL,
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `jos_bannerclient`
-- 

INSERT INTO `jos_bannerclient` VALUES (1, 'Open Source Matters', 'Administrator', 'admin@opensourcematters.org', '', 0, '00:00:00', NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_bannertrack`
-- 

CREATE TABLE `jos_bannertrack` (
  `track_date` date NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_bannertrack`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `jos_categories`
-- 

CREATE TABLE `jos_categories` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `image` varchar(255) NOT NULL default '',
  `section` varchar(50) NOT NULL default '',
  `image_position` varchar(30) NOT NULL default '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `editor` varchar(50) default NULL,
  `ordering` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `count` int(11) NOT NULL default '0',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cat_idx` (`section`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

-- 
-- Dumping data for table `jos_categories`
-- 

INSERT INTO `jos_categories` VALUES (1, 0, 'Phóng sự', '', 'phong-su', '', '1', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');
INSERT INTO `jos_categories` VALUES (2, 0, 'Pháp luật', '', 'phap-luat', '', '1', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, '');
INSERT INTO `jos_categories` VALUES (3, 0, 'Ô tô - Xe máy', '', 'oto-xemay', '', '1', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
INSERT INTO `jos_categories` VALUES (4, 0, 'An toàn giao thông', '', 'an-toan-giao-thong', '', '1', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 4, 0, 0, '');
INSERT INTO `jos_categories` VALUES (5, 0, 'Tuyển sinh', '', 'tuyen-sinh', '', '2', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');
INSERT INTO `jos_categories` VALUES (6, 0, 'Diễn đàn', '', 'dien-dan', '', '2', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, '');
INSERT INTO `jos_categories` VALUES (7, 0, 'Giảng đường', '', 'giang-duong', '', '2', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
INSERT INTO `jos_categories` VALUES (8, 0, 'Du học', '', 'du-hoc', '', '2', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 4, 0, 0, '');
INSERT INTO `jos_categories` VALUES (9, 0, 'Đối nội', '', 'doi-noi', '', '3', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');
INSERT INTO `jos_categories` VALUES (10, 0, 'Đối ngoại', '', 'doi-ngoai', '', '3', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 5, 0, 0, '');
INSERT INTO `jos_categories` VALUES (11, 0, 'Giải trí', '', 'giai-tri', '', '8', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');
INSERT INTO `jos_categories` VALUES (12, 0, 'Chuyện yêu', '', 'chuyen-yeu', '', '8', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, '');
INSERT INTO `jos_categories` VALUES (13, 0, 'Học đường', '', 'hoc-duong', '', '8', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
INSERT INTO `jos_categories` VALUES (14, 0, 'Teen-style', '', 'teen-style', '', '8', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 4, 0, 0, '');
INSERT INTO `jos_categories` VALUES (15, 0, 'Tài chính', '', 'tai-chinh', '', '10', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');
INSERT INTO `jos_categories` VALUES (16, 0, 'Kinh doanh', '', 'kinh-doanh', '', '10', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, '');
INSERT INTO `jos_categories` VALUES (17, 0, 'Thị trường', '', 'thi-truong', '', '10', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
INSERT INTO `jos_categories` VALUES (18, 0, 'Tiêu dùng', '', 'tieu-dung', '', '10', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 4, 0, 0, '');
INSERT INTO `jos_categories` VALUES (19, 0, 'Thế giới 24h', '', 'the-goi-24h', '', '9', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');
INSERT INTO `jos_categories` VALUES (20, 0, 'Thế giới đó đây', '', 'the-gioi-do-day', '', '9', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, '');
INSERT INTO `jos_categories` VALUES (21, 0, 'Nhân vật và đối thoại', '', 'nhan-vat-va-doi-thoai', '', '9', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
INSERT INTO `jos_categories` VALUES (22, 0, 'Điện thoại', '', 'dien-thoai', '', '6', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');
INSERT INTO `jos_categories` VALUES (23, 0, 'Máy tính', '', 'may-tinh', '', '6', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, '');
INSERT INTO `jos_categories` VALUES (24, 0, 'Camera', '', 'camera', '', '6', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
INSERT INTO `jos_categories` VALUES (25, 0, 'Hình ảnh', '', 'hinh-anh', '', '6', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 4, 0, 0, '');
INSERT INTO `jos_categories` VALUES (26, 0, 'Đồ chơi số', '', 'do-choi-so', '', '6', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 5, 0, 0, '');
INSERT INTO `jos_categories` VALUES (27, 0, 'Âm thanh', '', 'am-thanh', '', '6', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 6, 0, 0, '');
INSERT INTO `jos_categories` VALUES (28, 0, 'Góc nhìn văn hóa', '', 'goc-nhin-van-hoa', '', '4', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');
INSERT INTO `jos_categories` VALUES (29, 0, 'Showbiz', '', 'showbiz', '', '4', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, '');
INSERT INTO `jos_categories` VALUES (30, 0, 'Nhan sắc Việt', '', 'nhan-sac-viet', '', '4', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
INSERT INTO `jos_categories` VALUES (31, 0, 'Ảnh đẹp', '', 'anh-dep', '', '4', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 4, 0, 0, '');
INSERT INTO `jos_categories` VALUES (32, 0, 'Khoa học công nghệ', '', 'khoa-hoc-cong-nghe', '', '5', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');
INSERT INTO `jos_categories` VALUES (33, 0, 'Môi trường', '', 'moi-truong', '', '5', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, '');
INSERT INTO `jos_categories` VALUES (34, 0, 'Sức khỏe giới tính', '', 'suc-khoe-gioi-tinh', '', '5', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
INSERT INTO `jos_categories` VALUES (35, 0, 'Khám phá', '', 'kham-pha', '', '5', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 4, 0, 0, '');
INSERT INTO `jos_categories` VALUES (36, 0, 'Hỏi đáp', '', 'hoi-dap', '', '5', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 5, 0, 0, '');
INSERT INTO `jos_categories` VALUES (37, 0, 'Bóng đá trong nước', '', 'bong-da-trong-nuoc', '', '7', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');
INSERT INTO `jos_categories` VALUES (38, 0, 'Bóng đá quốc tế', '', 'bong-da-quoc-te', '', '7', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, '');
INSERT INTO `jos_categories` VALUES (39, 0, 'Cup Châu Âu', '', 'cup-chau-au', '', '7', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
INSERT INTO `jos_categories` VALUES (40, 0, 'Bóng đá Anh', '', 'bong-da-anh', '', '7', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 4, 0, 0, '');
INSERT INTO `jos_categories` VALUES (41, 0, 'Bóng đá Tây Ban Nha', '', 'bong-da-taybannha', '', '7', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 5, 0, 0, '');
INSERT INTO `jos_categories` VALUES (42, 0, 'Bóng đá Ý', '', 'bong-da-y', '', '7', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 6, 0, 0, '');
INSERT INTO `jos_categories` VALUES (43, 0, 'Tennis - Đua xe', '', 'tennis-duaxe', '', '7', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 7, 0, 0, '');
INSERT INTO `jos_categories` VALUES (44, 0, 'Các môn khác', '', 'cac-mon-khac', '', '7', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 8, 0, 0, '');
INSERT INTO `jos_categories` VALUES (45, 0, 'Gương sáng doanh nghiệp', '', 'guong-sang-doanh-nghiep', '', '11', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');
INSERT INTO `jos_categories` VALUES (46, 0, 'Chuyện kinh doanh', '', 'chuyen-kinh-doanh', '', '11', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, '');
INSERT INTO `jos_categories` VALUES (47, 0, 'Chân dung doanh nhân', '', 'chan-dung-doanh-nhan', '', '11', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
INSERT INTO `jos_categories` VALUES (48, 0, 'Hợp tác', '', 'hop-tac', '', '12', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');
INSERT INTO `jos_categories` VALUES (49, 0, 'Xuất nhập khẩu', '', 'xuat-nhap-khau', '', '12', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, '');
INSERT INTO `jos_categories` VALUES (50, 0, 'Kinh tế - Đầu tư', '', 'kinh-te-dau-tu', '', '12', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_components`
-- 

CREATE TABLE `jos_components` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `link` varchar(255) NOT NULL default '',
  `menuid` int(11) unsigned NOT NULL default '0',
  `parent` int(11) unsigned NOT NULL default '0',
  `admin_menu_link` varchar(255) NOT NULL default '',
  `admin_menu_alt` varchar(255) NOT NULL default '',
  `option` varchar(50) NOT NULL default '',
  `ordering` int(11) NOT NULL default '0',
  `admin_menu_img` varchar(255) NOT NULL default '',
  `iscore` tinyint(4) NOT NULL default '0',
  `params` text NOT NULL,
  `enabled` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `parent_option` (`parent`,`option`(32))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

-- 
-- Dumping data for table `jos_components`
-- 

INSERT INTO `jos_components` VALUES (1, 'Banners', '', 0, 0, '', 'Banner Management', 'com_banners', 0, 'js/ThemeOffice/component.png', 0, 'track_impressions=0\ntrack_clicks=0\ntag_prefix=\n\n', 1);
INSERT INTO `jos_components` VALUES (2, 'Banners', '', 0, 1, 'option=com_banners', 'Active Banners', 'com_banners', 1, 'js/ThemeOffice/edit.png', 0, '', 1);
INSERT INTO `jos_components` VALUES (3, 'Clients', '', 0, 1, 'option=com_banners&c=client', 'Manage Clients', 'com_banners', 2, 'js/ThemeOffice/categories.png', 0, '', 1);
INSERT INTO `jos_components` VALUES (4, 'Web Links', 'option=com_weblinks', 0, 0, '', 'Manage Weblinks', 'com_weblinks', 0, 'js/ThemeOffice/component.png', 0, 'show_comp_description=1\ncomp_description=\nshow_link_hits=1\nshow_link_description=1\nshow_other_cats=1\nshow_headings=1\nshow_page_title=1\nlink_target=0\nlink_icons=\n\n', 1);
INSERT INTO `jos_components` VALUES (5, 'Links', '', 0, 4, 'option=com_weblinks', 'View existing weblinks', 'com_weblinks', 1, 'js/ThemeOffice/edit.png', 0, '', 1);
INSERT INTO `jos_components` VALUES (6, 'Categories', '', 0, 4, 'option=com_categories&section=com_weblinks', 'Manage weblink categories', '', 2, 'js/ThemeOffice/categories.png', 0, '', 1);
INSERT INTO `jos_components` VALUES (7, 'Contacts', 'option=com_contact', 0, 0, '', 'Edit contact details', 'com_contact', 0, 'js/ThemeOffice/component.png', 1, 'contact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_fax=\nicon_misc=\nshow_headings=1\nshow_position=1\nshow_email=0\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nbannedEmail=\nbannedSubject=\nbannedText=\nsession=1\ncustomReply=0\n\n', 1);
INSERT INTO `jos_components` VALUES (8, 'Contacts', '', 0, 7, 'option=com_contact', 'Edit contact details', 'com_contact', 0, 'js/ThemeOffice/edit.png', 1, '', 1);
INSERT INTO `jos_components` VALUES (9, 'Categories', '', 0, 7, 'option=com_categories&section=com_contact_details', 'Manage contact categories', '', 2, 'js/ThemeOffice/categories.png', 1, 'contact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_fax=\nicon_misc=\nshow_headings=1\nshow_position=1\nshow_email=0\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nbannedEmail=\nbannedSubject=\nbannedText=\nsession=1\ncustomReply=0\n\n', 1);
INSERT INTO `jos_components` VALUES (10, 'Polls', 'option=com_poll', 0, 0, 'option=com_poll', 'Manage Polls', 'com_poll', 0, 'js/ThemeOffice/component.png', 0, '', 1);
INSERT INTO `jos_components` VALUES (11, 'News Feeds', 'option=com_newsfeeds', 0, 0, '', 'News Feeds Management', 'com_newsfeeds', 0, 'js/ThemeOffice/component.png', 0, '', 1);
INSERT INTO `jos_components` VALUES (12, 'Feeds', '', 0, 11, 'option=com_newsfeeds', 'Manage News Feeds', 'com_newsfeeds', 1, 'js/ThemeOffice/edit.png', 0, 'show_headings=1\nshow_name=1\nshow_articles=1\nshow_link=1\nshow_cat_description=1\nshow_cat_items=1\nshow_feed_image=1\nshow_feed_description=1\nshow_item_description=1\nfeed_word_count=0\n\n', 1);
INSERT INTO `jos_components` VALUES (13, 'Categories', '', 0, 11, 'option=com_categories&section=com_newsfeeds', 'Manage Categories', '', 2, 'js/ThemeOffice/categories.png', 0, '', 1);
INSERT INTO `jos_components` VALUES (14, 'User', 'option=com_user', 0, 0, '', '', 'com_user', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES (15, 'Search', 'option=com_search', 0, 0, 'option=com_search', 'Search Statistics', 'com_search', 0, 'js/ThemeOffice/component.png', 1, 'enabled=0\n\n', 1);
INSERT INTO `jos_components` VALUES (16, 'Categories', '', 0, 1, 'option=com_categories&section=com_banner', 'Categories', '', 3, '', 1, '', 1);
INSERT INTO `jos_components` VALUES (17, 'Wrapper', 'option=com_wrapper', 0, 0, '', 'Wrapper', 'com_wrapper', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES (18, 'Mail To', '', 0, 0, '', '', 'com_mailto', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES (19, 'Media Manager', '', 0, 0, 'option=com_media', 'Media Manager', 'com_media', 0, '', 1, 'upload_extensions=bmp,csv,doc,epg,gif,ico,jpg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,EPG,GIF,ICO,JPG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS\nupload_maxsize=10000000\nfile_path=images\nimage_path=images/stories\nrestrict_uploads=1\nallowed_media_usergroup=3\ncheck_mime=1\nimage_extensions=bmp,gif,jpg,png\nignore_extensions=\nupload_mime=image/jpeg,image/gif,image/png,image/bmp,application/x-shockwave-flash,application/msword,application/excel,application/pdf,application/powerpoint,text/plain,application/x-zip\nupload_mime_illegal=text/html\nenable_flash=0\n\n', 1);
INSERT INTO `jos_components` VALUES (20, 'Articles', 'option=com_content', 0, 0, '', '', 'com_content', 0, '', 1, 'show_noauth=0\nshow_title=1\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\nfeed_summary=0\n\n', 1);
INSERT INTO `jos_components` VALUES (21, 'Configuration Manager', '', 0, 0, '', 'Configuration', 'com_config', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES (22, 'Installation Manager', '', 0, 0, '', 'Installer', 'com_installer', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES (23, 'Language Manager', '', 0, 0, '', 'Languages', 'com_languages', 0, '', 1, 'site=vi-VN\nadministrator=vi-VN\n\n', 1);
INSERT INTO `jos_components` VALUES (24, 'Mass mail', '', 0, 0, '', 'Mass Mail', 'com_massmail', 0, '', 1, 'mailSubjectPrefix=\nmailBodySuffix=\n\n', 1);
INSERT INTO `jos_components` VALUES (25, 'Menu Editor', '', 0, 0, '', 'Menu Editor', 'com_menus', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES (27, 'Messaging', '', 0, 0, '', 'Messages', 'com_messages', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES (28, 'Modules Manager', '', 0, 0, '', 'Modules', 'com_modules', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES (29, 'Plugin Manager', '', 0, 0, '', 'Plugins', 'com_plugins', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES (30, 'Template Manager', '', 0, 0, '', 'Templates', 'com_templates', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES (31, 'User Manager', '', 0, 0, '', 'Users', 'com_users', 0, '', 1, 'allowUserRegistration=1\nnew_usertype=Registered\nuseractivation=1\nfrontend_userparams=1\n\n', 1);
INSERT INTO `jos_components` VALUES (32, 'Cache Manager', '', 0, 0, '', 'Cache', 'com_cache', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES (33, 'Control Panel', '', 0, 0, '', 'Control Panel', 'com_cpanel', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES (34, 'Xmap', 'option=com_xmap', 0, 0, 'option=com_xmap', 'Xmap', 'com_xmap', 0, 'js/ThemeOffice/component.png', 0, '', 1);
INSERT INTO `jos_components` VALUES (35, 'JCE', 'option=com_jce', 0, 0, 'option=com_jce', 'JCE', 'com_jce', 0, 'components/com_jce/media/img/menu/logo.png', 0, '', 1);
INSERT INTO `jos_components` VALUES (36, 'WF_MENU_CPANEL', '', 0, 35, 'option=com_jce', 'WF_MENU_CPANEL', 'com_jce', 0, 'components/com_jce/media/img/menu/jce-cpanel.png', 0, '', 1);
INSERT INTO `jos_components` VALUES (37, 'WF_MENU_CONFIG', '', 0, 35, 'option=com_jce&view=config', 'WF_MENU_CONFIG', 'com_jce', 1, 'components/com_jce/media/img/menu/jce-config.png', 0, '', 1);
INSERT INTO `jos_components` VALUES (38, 'WF_MENU_PROFILES', '', 0, 35, 'option=com_jce&view=profiles', 'WF_MENU_PROFILES', 'com_jce', 2, 'components/com_jce/media/img/menu/jce-profiles.png', 0, '', 1);
INSERT INTO `jos_components` VALUES (39, 'WF_MENU_INSTALL', '', 0, 35, 'option=com_jce&view=installer', 'WF_MENU_INSTALL', 'com_jce', 3, 'components/com_jce/media/img/menu/jce-install.png', 0, '', 1);
INSERT INTO `jos_components` VALUES (40, 'Attachments', 'option=com_attachments', 0, 0, 'option=com_attachments', 'Attachments', 'com_attachments', 0, 'components/com_attachments/attachments.png', 0, '', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_contact_details`
-- 

CREATE TABLE `jos_contact_details` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `con_position` varchar(255) default NULL,
  `address` text,
  `suburb` varchar(100) default NULL,
  `state` varchar(100) default NULL,
  `country` varchar(100) default NULL,
  `postcode` varchar(100) default NULL,
  `telephone` varchar(255) default NULL,
  `fax` varchar(255) default NULL,
  `misc` mediumtext,
  `image` varchar(255) default NULL,
  `imagepos` varchar(20) default NULL,
  `email_to` varchar(255) default NULL,
  `default_con` tinyint(1) unsigned NOT NULL default '0',
  `published` tinyint(1) unsigned NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL default '0',
  `catid` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `mobile` varchar(255) NOT NULL default '',
  `webpage` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `jos_contact_details`
-- 

INSERT INTO `jos_contact_details` VALUES (1, 'Name', 'name', 'Position', 'Street', 'Suburb', 'State', 'Country', 'Zip Code', 'Telephone', 'Fax', 'Miscellanous info', 'powered_by.png', 'top', 'email@email.com', 1, 1, 0, '0000-00-00 00:00:00', 1, 'show_name=1\r\nshow_position=1\r\nshow_email=0\r\nshow_street_address=1\r\nshow_suburb=1\r\nshow_state=1\r\nshow_postcode=1\r\nshow_country=1\r\nshow_telephone=1\r\nshow_mobile=1\r\nshow_fax=1\r\nshow_webpage=1\r\nshow_misc=1\r\nshow_image=1\r\nallow_vcard=0\r\ncontact_icons=0\r\nicon_address=\r\nicon_email=\r\nicon_telephone=\r\nicon_fax=\r\nicon_misc=\r\nshow_email_form=1\r\nemail_description=1\r\nshow_email_copy=1\r\nbanned_email=\r\nbanned_subject=\r\nbanned_text=', 0, 12, 0, '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_content`
-- 

CREATE TABLE `jos_content` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `title_alias` varchar(255) NOT NULL default '',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL default '0',
  `sectionid` int(11) unsigned NOT NULL default '0',
  `mask` int(11) unsigned NOT NULL default '0',
  `catid` int(11) unsigned NOT NULL default '0',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL default '0',
  `created_by_alias` varchar(255) NOT NULL default '',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` text NOT NULL,
  `version` int(11) unsigned NOT NULL default '1',
  `parentid` int(11) unsigned NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(11) unsigned NOT NULL default '0',
  `hits` int(11) unsigned NOT NULL default '0',
  `metadata` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_section` (`sectionid`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

-- 
-- Dumping data for table `jos_content`
-- 

INSERT INTO `jos_content` VALUES (1, 'Welcome to Joomla!', 'welcome-to-joomla', '', '<div align="left"><strong>Joomla! is a free open source framework and content publishing system designed for quickly creating highly interactive multi-language Web sites, online communities, media portals, blogs and eCommerce applications. <br /></strong></div><p><strong><br /></strong><img src="images/stories/powered_by.png" border="0" alt="Joomla! Logo" title="Example Caption" hspace="6" vspace="0" width="165" height="68" align="left" />Joomla! provides an easy-to-use graphical user interface that simplifies the management and publishing of large volumes of content including HTML, documents, and rich media.  Joomla! is used by organisations of all sizes for intranets and extranets and is supported by a community of tens of thousands of users. </p>', 'With a fully documented library of developer resources, Joomla! allows the customisation of every aspect of a Web site including presentation, layout, administration, and the rapid integration with third-party applications.<p>Joomla! now provides more developer power while making the user experience all the more friendly. For those who always wanted increased extensibility, Joomla! 1.5 can make this happen.</p><p>A new framework, ground-up refactoring, and a highly-active development team brings the excitement of ''the next generation CMS'' to your fingertips.  Whether you are a systems architect or a complete ''noob'' Joomla! can take you to the next level of content delivery. ''More than a CMS'' is something we have been playing with as a catchcry because the new Joomla! API has such incredible power and flexibility, you are free to take whatever direction your creative mind takes you and Joomla! can help you get there so much more easily than ever before.</p><p>Thinking Web publishing? Think Joomla!</p>', 1, 1, 0, 1, '2008-08-12 10:00:00', 62, '', '2008-08-12 10:00:00', 62, 0, '0000-00-00 00:00:00', '2006-01-03 01:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 29, 0, 1, '', '', 0, 92, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (2, 'Newsflash 1', 'newsflash-1', '', '<p>Joomla! makes it easy to launch a Web site of any kind. Whether you want a brochure site or you are building a large online community, Joomla! allows you to deploy a new site in minutes and add extra functionality as you need it. The hundreds of available Extensions will help to expand your site and allow you to deliver new services that extend your reach into the Internet.</p>', '', 1, 1, 0, 3, '2008-08-10 06:30:34', 62, '', '2008-08-10 06:30:34', 62, 0, '0000-00-00 00:00:00', '2004-08-09 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 3, '', '', 0, 1, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (3, 'Newsflash 2', 'newsflash-2', '', '<p>The one thing about a Web site, it always changes! Joomla! makes it easy to add Articles, content, images, videos, and more. Site administrators can edit and manage content ''in-context'' by clicking the ''Edit'' link. Webmasters can also edit content through a graphical Control Panel that gives you complete control over your site.</p>', '', 1, 1, 0, 3, '2008-08-09 22:30:34', 62, '', '2008-08-09 22:30:34', 62, 0, '0000-00-00 00:00:00', '2004-08-09 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 6, 0, 4, '', '', 0, 0, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (4, 'Newsflash 3', 'newsflash-3', '', '<p>With a library of thousands of free <a href="http://extensions.joomla.org" target="_blank" title="The Joomla! Extensions Directory">Extensions</a>, you can add what you need as your site grows. Don''t wait, look through the <a href="http://extensions.joomla.org/" target="_blank" title="Joomla! Extensions">Joomla! Extensions</a>  library today. </p>', '', 1, 1, 0, 3, '2008-08-10 06:30:34', 62, '', '2008-08-10 06:30:34', 62, 0, '0000-00-00 00:00:00', '2004-08-09 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 5, '', '', 0, 1, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (5, 'Joomla! License Guidelines', 'joomla-license-guidelines', 'joomla-license-guidelines', '<p>This Web site is powered by <a href="http://joomla.org/" target="_blank" title="Joomla!">Joomla!</a> The software and default templates on which it runs are Copyright 2005-2008 <a href="http://www.opensourcematters.org/" target="_blank" title="Open Source Matters">Open Source Matters</a>. The sample content distributed with Joomla! is licensed under the <a href="http://docs.joomla.org/JEDL" target="_blank" title="Joomla! Electronic Document License">Joomla! Electronic Documentation License.</a> All data entered into this Web site and templates added after installation, are copyrighted by their respective copyright owners.</p> <p>If you want to distribute, copy, or modify Joomla!, you are welcome to do so under the terms of the <a href="http://www.gnu.org/licenses/old-licenses/gpl-2.0.html#SEC1" target="_blank" title="GNU General Public License"> GNU General Public License</a>. If you are unfamiliar with this license, you might want to read <a href="http://www.gnu.org/licenses/old-licenses/gpl-2.0.html#SEC4" target="_blank" title="How To Apply These Terms To Your Program">''How To Apply These Terms To Your Program''</a> and the <a href="http://www.gnu.org/licenses/old-licenses/gpl-2.0-faq.html" target="_blank" title="GNU General Public License FAQ">''GNU General Public License FAQ''</a>.</p> <p>The Joomla! licence has always been GPL.</p>', '', 1, 6, 0, 25, '2008-08-20 10:11:07', 62, '', '2008-08-20 10:11:07', 62, 0, '0000-00-00 00:00:00', '2004-08-19 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 2, '', '', 0, 100, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (6, 'We are Volunteers', 'we-are-volunteers', '', '<p>The Joomla Core Team and Working Group members are volunteer developers, designers, administrators and managers who have worked together to take Joomla! to new heights in its relatively short life. Joomla! has some wonderfully talented people taking Open Source concepts to the forefront of industry standards.  Joomla! 1.5 is a major leap forward and represents the most exciting Joomla! release in the history of the project. </p>', '', 1, 1, 0, 1, '2007-07-07 09:54:06', 62, '', '2007-07-07 09:54:06', 62, 0, '0000-00-00 00:00:00', '2004-07-06 22:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 10, 0, 4, '', '', 0, 54, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (9, 'Millions of Smiles', 'millions-of-smiles', '', '<p>The Joomla! team has millions of good reasons to be smiling about the Joomla! 1.5. In its current incarnation, it''s had millions of downloads, taking it to an unprecedented level of popularity.  The new code base is almost an entire re-factor of the old code base.  The user experience is still extremely slick but for developers the API is a dream.  A proper framework for real PHP architects seeking the best of the best.</p><p>If you''re a former Mambo User or a 1.0 series Joomla! User, 1.5 is the future of CMSs for a number of reasons.  It''s more powerful, more flexible, more secure, and intuitive.  Our developers and interface designers have worked countless hours to make this the most exciting release in the content management system sphere.</p><p>Go on ... get your FREE copy of Joomla! today and spread the word about this benchmark project. </p>', '', 1, 1, 0, 1, '2007-07-07 09:54:06', 62, '', '2007-07-07 09:54:06', 62, 0, '0000-00-00 00:00:00', '2004-07-06 22:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 5, 0, 7, '', '', 0, 23, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (10, 'How do I localise Joomla! to my language?', 'how-do-i-localise-joomla-to-my-language', '', '<h4>General<br /></h4><p>In Joomla! 1.5 all User interfaces can be localised. This includes the installation, the Back-end Control Panel and the Front-end Site.</p><p>The core release of Joomla! 1.5 is shipped with multiple language choices in the installation but, other than English (the default), languages for the Site and Administration interfaces need to be added after installation. Links to such language packs exist below.</p>', '<p>Translation Teams for Joomla! 1.5 may have also released fully localised installation packages where site, administrator and sample data are in the local language. These localised releases can be found in the specific team projects on the <a href="http://extensions.joomla.org/component/option,com_mtree/task,listcats/cat_id,1837/Itemid,35/" target="_blank" title="JED">Joomla! Extensions Directory</a>.</p><h4>How do I install language packs?</h4><ul><li>First download both the admin and the site language packs that you require.</li><li>Install each pack separately using the Extensions-&gt;Install/Uninstall Menu selection and then the package file upload facility.</li><li>Go to the Language Manager and be sure to select Site or Admin in the sub-menu. Then select the appropriate language and make it the default one using the Toolbar button.</li></ul><h4>How do I select languages?</h4><ul><li>Default languages can be independently set for Site and for Administrator</li><li>In addition, users can define their preferred language for each Site and Administrator. This takes affect after logging in.</li><li>While logging in to the Administrator Back-end, a language can also be selected for the particular session.</li></ul><h4>Where can I find Language Packs and Localised Releases?</h4><p><em>Please note that Joomla! 1.5 is new and language packs for this version may have not been released at this time.</em> </p><ul><li><a href="http://joomlacode.org/gf/project/jtranslation/" target="_blank" title="Accredited Translations">The Joomla! Accredited Translations Project</a>  - This is a joint repository for language packs that were developed by teams that are members of the Joomla! Translations Working Group.</li><li><a href="http://extensions.joomla.org/component/option,com_mtree/task,listcats/cat_id,1837/Itemid,35/" target="_blank" title="Translations">The Joomla! Extensions Site - Translations</a>  </li><li><a href="http://community.joomla.org/translations.html" target="_blank" title="Translation Work Group Teams">List of Translation Teams and Translation Partner Sites for Joomla! 1.5</a> </li></ul>', 1, 5, 0, 32, '2008-07-30 14:06:37', 62, '', '2008-07-30 14:06:37', 62, 0, '0000-00-00 00:00:00', '2006-09-29 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 9, 0, 5, '', '', 0, 10, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (11, 'How do I upgrade to Joomla! 1.5 ?', 'how-do-i-upgrade-to-joomla-15', '', '<p>Joomla! 1.5 does not provide an upgrade path from earlier versions. Converting an older site to a Joomla! 1.5 site requires creation of a new empty site using Joomla! 1.5 and then populating the new site with the content from the old site. This migration of content is not a one-to-one process and involves conversions and modifications to the content dump.</p> <p>There are two ways to perform the migration:</p>', ' <div id="post_content-107"><li>An automated method of migration has been provided which uses a migrator Component to create the migration dump out of the old site (Mambo 4.5.x up to Joomla! 1.0.x) and a smart import facility in the Joomla! 1.5 Installation that performs required conversions and modifications during the installation process.</li> <li>Migration can be performed manually. This involves exporting the required tables, manually performing required conversions and modifications and then importing the content to the new site after it is installed.</li>  <p><!--more--></p> <h2><strong> Automated migration</strong></h2>  <p>This is a two phased process using two tools. The first tool is a migration Component named <font face="courier new,courier">com_migrator</font>. This Component has been contributed by Harald Baer and is based on his <strong>eBackup </strong>Component. The migrator needs to be installed on the old site and when activated it prepares the required export dump of the old site''s data. The second tool is built into the Joomla! 1.5 installation process. The exported content dump is loaded to the new site and all conversions and modification are performed on-the-fly.</p> <h3><u> Step 1 - Using com_migrator to export data from old site:</u></h3> <li>Install the <font face="courier new,courier">com_migrator</font> Component on the <u><strong>old</strong></u> site. It can be found at the <a href="http://joomlacode.org/gf/project/pasamioprojects/frs/" target="_blank" title="JoomlaCode">JoomlaCode developers forge</a>.</li> <li>Select the Component in the Component Menu of the Control Panel.</li> <li>Click on the <strong>Dump it</strong> icon. Three exported <em>gzipped </em>export scripts will be created. The first is a complete backup of the old site. The second is the migration content of all core elements which will be imported to the new site. The third is a backup of all 3PD Component tables.</li> <li>Click on the download icon of the particular exports files needed and store locally.</li> <li>Multiple export sets can be created.</li> <li>The exported data is not modified in anyway and the original encoding is preserved. This makes the <font face="courier new,courier">com_migrator</font> tool a recommended tool to use for manual migration as well.</li> <h3><u> Step 2 - Using the migration facility to import and convert data during Joomla! 1.5 installation:</u></h3><p>Note: This function requires the use of the <em><font face="courier new,courier">iconv </font></em>function in PHP to convert encodings. If <em><font face="courier new,courier">iconv </font></em>is not found a warning will be provided.</p> <li>In step 6 - Configuration select the ''Load Migration Script'' option in the ''Load Sample Data, Restore or Migrate Backed Up Content'' section of the page.</li> <li>Enter the table prefix used in the content dump. For example: ''jos_'' or ''site2_'' are acceptable values.</li> <li>Select the encoding of the dumped content in the dropdown list. This should be the encoding used on the pages of the old site. (As defined in the _ISO variable in the language file or as seen in the browser page info/encoding/source)</li> <li>Browse the local host and select the migration export and click on <strong>Upload and Execute</strong></li> <li>A success message should appear or alternately a listing of database errors</li> <li>Complete the other required fields in the Configuration step such as Site Name and Admin details and advance to the final step of installation. (Admin details will be ignored as the imported data will take priority. Please remember admin name and password from the old site)</li> <p><u><br /></u></p></div>', 1, 4, 0, 28, '2008-07-30 20:27:52', 62, '', '2008-07-30 20:27:52', 62, 0, '0000-00-00 00:00:00', '2006-09-29 12:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 10, 0, 3, '', '', 0, 14, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (12, 'Why does Joomla! 1.5 use UTF-8 encoding?', 'why-does-joomla-15-use-utf-8-encoding', '', '<p>Well... how about never needing to mess with encoding settings again?</p><p>Ever needed to display several languages on one page or site and something always came up in Giberish?</p><p>With utf-8 (a variant of Unicode) glyphs (character forms) of basically all languages can be displayed with one single encoding setting. </p>', '', 1, 4, 0, 31, '2008-08-05 01:11:29', 62, '', '2008-08-05 01:11:29', 62, 0, '0000-00-00 00:00:00', '2006-10-03 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 8, 0, 8, '', '', 0, 29, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (13, 'What happened to the locale setting?', 'what-happened-to-the-locale-setting', '', 'This is now defined in the Language [<em>lang</em>].xml file in the Language metadata settings. If you are having locale problems such as dates do not appear in your language for example, you might want to check/edit the entries in the locale tag. Note that multiple locale strings can be set and the host will usually accept the first one recognised.', '', 1, 4, 0, 28, '2008-08-06 16:47:35', 62, '', '2008-08-06 16:47:35', 62, 0, '0000-00-00 00:00:00', '2006-10-05 14:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 2, '', '', 0, 11, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (14, 'What is the FTP layer for?', 'what-is-the-ftp-layer-for', '', '<p>The FTP Layer allows file operations (such as installing Extensions or updating the main configuration file) without having to make all the folders and files writable. This has been an issue on Linux and other Unix based platforms in respect of file permissions. This makes the site admin''s life a lot easier and increases security of the site.</p><p>You can check the write status of relevent folders by going to ''''Help-&gt;System Info" and then in the sub-menu to "Directory Permissions". With the FTP Layer enabled even if all directories are red, Joomla! will operate smoothly.</p><p>NOTE: the FTP layer is not required on a Windows host/server. </p>', '', 1, 4, 0, 31, '2008-08-06 21:27:49', 62, '', '2008-08-06 21:27:49', 62, 0, '0000-00-00 00:00:00', '2006-10-05 16:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=', 6, 0, 6, '', '', 0, 23, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (15, 'Can Joomla! 1.5 operate with PHP Safe Mode On?', 'can-joomla-15-operate-with-php-safe-mode-on', '', '<p>Yes it can! This is a significant security improvement.</p><p>The <em>safe mode</em> limits PHP to be able to perform actions only on files/folders who''s owner is the same as PHP is currently using (this is usually ''apache''). As files normally are created either by the Joomla! application or by FTP access, the combination of PHP file actions and the FTP Layer allows Joomla! to operate in PHP Safe Mode.</p>', '', 1, 4, 0, 31, '2008-08-06 19:28:35', 62, '', '2008-08-06 19:28:35', 62, 0, '0000-00-00 00:00:00', '2006-10-05 14:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 4, '', '', 0, 8, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (16, 'Only one edit window! How do I create "Read more..."?', 'only-one-edit-window-how-do-i-create-read-more', '', '<p>This is now implemented by inserting a <strong>Read more...</strong> tag (the button is located below the editor area) a dotted line appears in the edited text showing the split location for the <em>Read more....</em> A new Plugin takes care of the rest.</p><p>It is worth mentioning that this does not have a negative effect on migrated data from older sites. The new implementation is fully backward compatible.</p>', '', 1, 4, 0, 28, '2008-08-06 19:29:28', 62, '', '2008-08-06 19:29:28', 62, 0, '0000-00-00 00:00:00', '2006-10-05 14:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 4, '', '', 0, 20, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (17, 'My MySQL database does not support UTF-8. Do I have a problem?', 'my-mysql-database-does-not-support-utf-8-do-i-have-a-problem', '', 'No you don''t. Versions of MySQL lower than 4.1 do not have built in UTF-8 support. However, Joomla! 1.5 has made provisions for backward compatibility and is able to use UTF-8 on older databases. Let the installer take care of all the settings and there is no need to make any changes to the database (charset, collation, or any other).', '', 1, 4, 0, 31, '2008-08-07 09:30:37', 62, '', '2008-08-07 09:30:37', 62, 0, '0000-00-00 00:00:00', '2006-10-05 20:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 10, 0, 7, '', '', 0, 9, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (18, 'Joomla! Features', 'joomla-features', '', '<h4><font color="#ff6600">Joomla! features:</font></h4> <ul><li>Completely database driven site engines </li><li>News, products, or services sections fully editable and manageable</li><li>Topics sections can be added to by contributing Authors </li><li>Fully customisable layouts including <em>left</em>, <em>center</em>, and <em>right </em>Menu boxes </li><li>Browser upload of images to your own library for use anywhere in the site </li><li>Dynamic Forum/Poll/Voting booth for on-the-spot results </li><li>Runs on Linux, FreeBSD, MacOSX server, Solaris, and AIX', '  </li></ul> <h4>Extensive Administration:</h4> <ul><li>Change order of objects including news, FAQs, Articles etc. </li><li>Random Newsflash generator </li><li>Remote Author submission Module for News, Articles, FAQs, and Links </li><li>Object hierarchy - as many Sections, departments, divisions, and pages as you want </li><li>Image library - store all your PNGs, PDFs, DOCs, XLSs, GIFs, and JPEGs online for easy use </li><li>Automatic Path-Finder. Place a picture and let Joomla! fix the link </li><li>News Feed Manager. Easily integrate news feeds into your Web site.</li><li>E-mail a friend and Print format available for every story and Article </li><li>In-line Text editor similar to any basic word processor software </li><li>User editable look and feel </li><li>Polls/Surveys - Now put a different one on each page </li><li>Custom Page Modules. Download custom page Modules to spice up your site </li><li>Template Manager. Download Templates and implement them in seconds </li><li>Layout preview. See how it looks before going live </li><li>Banner Manager. Make money out of your site.</li></ul>', 1, 4, 0, 29, '2008-08-08 23:32:45', 62, '', '2008-08-08 23:32:45', 62, 0, '0000-00-00 00:00:00', '2006-10-07 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 11, 0, 4, '', '', 0, 59, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (19, 'Joomla! Overview', 'joomla-overview', '', '<p>If you''re new to Web publishing systems, you''ll find that Joomla! delivers sophisticated solutions to your online needs. It can deliver a robust enterprise-level Web site, empowered by endless extensibility for your bespoke publishing needs. Moreover, it is often the system of choice for small business or home users who want a professional looking site that''s simple to deploy and use. <em>We do content right</em>.<br /> </p><p>So what''s the catch? How much does this system cost?</p><p> Well, there''s good news ... and more good news! Joomla! 1.5 is free, it is released under an Open Source license - the GNU/General Public License v 2.0. Had you invested in a mainstream, commercial alternative, there''d be nothing but moths left in your wallet and to add new functionality would probably mean taking out a second mortgage each time you wanted something adding!</p><p>Joomla! changes all that ... <br />Joomla! is different from the normal models for content management software. For a start, it''s not complicated. Joomla! has been developed for everybody, and anybody can develop it further. It is designed to work (primarily) with other Open Source, free, software such as PHP, MySQL, and Apache. </p><p>It is easy to install and administer, and is reliable. </p><p>Joomla! doesn''t even require the user or administrator of the system to know HTML to operate it once it''s up and running.</p><p>To get the perfect Web site with all the functionality that you require for your particular application may take additional time and effort, but with the Joomla! Community support that is available and the many Third Party Developers actively creating and releasing new Extensions for the 1.5 platform on an almost daily basis, there is likely to be something out there to meet your needs. Or you could develop your own Extensions and make these available to the rest of the community. </p>', '', 1, 4, 0, 29, '2008-08-09 07:49:20', 62, '', '2008-08-09 07:49:20', 62, 0, '0000-00-00 00:00:00', '2006-10-07 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 13, 0, 2, '', '', 0, 150, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (20, 'Support and Documentation', 'support-and-documentation', '', '<h1>Support </h1><p>Support for the Joomla! CMS can be found on several places. The best place to start would be the <a href="http://docs.joomla.org/" target="_blank" title="Joomla! Official Documentation Wiki">Joomla! Official Documentation Wiki</a>. Here you can help yourself to the information that is regularly published and updated as Joomla! develops. There is much more to come too!</p> <p>Of course you should not forget the Help System of the CMS itself. On the <em>topmenu </em>in the Back-end Control panel you find the Help button which will provide you with lots of explanation on features.</p> <p>Another great place would of course be the <a href="http://forum.joomla.org/" target="_blank" title="Forum">Forum</a> . On the Joomla! Forum you can find help and support from Community members as well as from Joomla! Core members and Working Group members. The forum contains a lot of information, FAQ''s, just about anything you are looking for in terms of support.</p> <p>Two other resources for Support are the <a href="http://developer.joomla.org/" target="_blank" title="Joomla! Developer Site">Joomla! Developer Site</a> and the <a href="http://extensions.joomla.org/" target="_blank" title="Joomla! Extensions Directory">Joomla! Extensions Directory</a> (JED). The Joomla! Developer Site provides lots of technical information for the experienced Developer as well as those new to Joomla! and development work in general. The JED whilst not a support site in the strictest sense has many of the Extensions that you will need as you develop your own Web site.</p> <p>The Joomla! Developers and Bug Squad members are regularly posting their blog reports about several topics such as programming techniques and security issues.</p> <h1>Documentation</h1> <p>Joomla! Documentation can of course be found on the <a href="http://docs.joomla.org/" target="_blank" title="Joomla! Official Documentation Wiki">Joomla! Official Documentation Wiki</a>. You can find information for beginners, installation, upgrade, Frequently Asked Questions, developer topics, and a lot more. The Documentation Team helps oversee the wiki but you are invited to contribute content, as well.</p> <p>There are also books written about Joomla! You can find a listing of these books in the <a href="http://shop.joomla.org/" target="_blank" title="Joomla! Shop">Joomla! Shop</a>.</p>', '', 1, 6, 0, 25, '2008-08-09 08:33:57', 62, '', '2008-08-09 08:33:57', 62, 0, '0000-00-00 00:00:00', '2006-10-07 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 13, 0, 1, '', '', 0, 6, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (21, 'Joomla! Facts', 'joomla-facts', '', '<p>Here are some interesting facts about Joomla!</p><ul><li><span>Over 210,000 active registered Users on the <a href="http://forum.joomla.org" target="_blank" title="Joomla Forums">Official Joomla! community forum</a> and more on the many international community sites.</span><ul><li><span>over 1,000,000 posts in over 200,000 topics</span></li><li>over 1,200 posts per day</li><li>growing at 150 new participants each day!</li></ul></li><li><span>1168 Projects on the JoomlaCode (<a href="http://joomlacode.org/" target="_blank" title="JoomlaCode">joomlacode.org</a> ). All for open source addons by third party developers.</span><ul><li><span>Well over 6,000,000 downloads of Joomla! since the migration to JoomlaCode in March 2007.<br /></span></li></ul></li><li><span>Nearly 4,000 extensions for Joomla! have been registered on the <a href="http://extensions.joomla.org" target="_blank" title="http://extensions.joomla.org">Joomla! Extension Directory</a>  </span></li><li><span>Joomla.org exceeds 2 TB of traffic per month!</span></li></ul>', '', 1, 4, 0, 30, '2008-08-09 16:46:37', 62, '', '2008-08-09 16:46:37', 62, 0, '0000-00-00 00:00:00', '2006-10-07 14:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 13, 0, 1, '', '', 0, 50, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (22, 'What''s New in 1.5?', 'whats-new-in-15', '', '<p>As with previous releases, Joomla! provides a unified and easy-to-use framework for delivering content for Web sites of all kinds. To support the changing nature of the Internet and emerging Web technologies, Joomla! required substantial restructuring of its core functionality and we also used this effort to simplify many challenges within the current user interface. Joomla! 1.5 has many new features.</p>', '<p style="margin-bottom: 0in">In Joomla! 1.5, you''ll notice: </p>    <ul><li>     <p style="margin-bottom: 0in">       Substantially improved usability, manageability, and scalability far beyond the original Mambo foundations</p>   </li><li>     <p style="margin-bottom: 0in"> Expanded accessibility to support internationalisation, double-byte characters and right-to-left support for Arabic, Farsi, and Hebrew languages among others</p>   </li><li>     <p style="margin-bottom: 0in"> Extended integration of external applications through Web services and remote authentication such as the Lightweight Directory Access Protocol (LDAP)</p>   </li><li>     <p style="margin-bottom: 0in"> Enhanced content delivery, template and presentation capabilities to support accessibility standards and content delivery to any destination</p>   </li><li>     <p style="margin-bottom: 0in">       A more sustainable and flexible framework for Component and Extension developers</p>   </li><li>     <p style="margin-bottom: 0in">Backward compatibility with previous releases of Components, Templates, Modules, and other Extensions</p></li></ul>', 1, 4, 0, 29, '2008-08-11 22:13:58', 62, '', '2008-08-11 22:13:58', 62, 0, '0000-00-00 00:00:00', '2006-10-10 18:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 10, 0, 1, '', '', 0, 92, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (23, 'Platforms and Open Standards', 'platforms-and-open-standards', '', '<p class="MsoNormal">Joomla! runs on any platform including Windows, most flavours of Linux, several Unix versions, and the Apple OS/X platform.  Joomla! depends on PHP and the MySQL database to deliver dynamic content.  </p>            <p class="MsoNormal">The minimum requirements are:</p>      <ul><li>Apache 1.x, 2.x and higher</li><li>PHP 4.3 and higher</li><li>MySQL 3.23 and higher</li></ul>It will also run on alternative server platforms such as Windows IIS - provided they support PHP and MySQL - but these require additional configuration in order for the Joomla! core package to be successful installed and operated.', '', 1, 6, 0, 25, '2008-08-11 04:22:14', 62, '', '2008-08-11 04:22:14', 62, 0, '0000-00-00 00:00:00', '2006-10-10 08:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 3, '', '', 0, 11, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (24, 'Content Layouts', 'content-layouts', '', '<p>Joomla! provides plenty of flexibility when displaying your Web content. Whether you are using Joomla! for a blog site, news or a Web site for a company, you''ll find one or more content styles to showcase your information. You can also change the style of content dynamically depending on your preferences. Joomla! calls how a page is laid out a <strong>layout</strong>. Use the guide below to understand which layouts are available and how you might use them. </p> <h2>Content </h2> <p>Joomla! makes it extremely easy to add and display content. All content  is placed where your mainbody tag in your template is located. There are three main types of layouts available in Joomla! and all of them can be customised via parameters. The display and parameters are set in the Menu Item used to display the content your working on. You create these layouts by creating a Menu Item and choosing how you want the content to display.</p> <h3>Blog Layout<br /> </h3> <p>Blog layout will show a listing of all Articles of the selected blog type (Section or Category) in the mainbody position of your template. It will give you the standard title, and Intro of each Article in that particular Category and/or Section. You can customise this layout via the use of the Preferences and Parameters, (See Article Parameters) this is done from the Menu not the Section Manager!</p> <h3>Blog Archive Layout<br /> </h3> <p>A Blog Archive layout will give you a similar output of Articles as the normal Blog Display but will add, at the top, two drop down lists for month and year plus a search button to allow Users to search for all Archived Articles from a specific month and year.</p> <h3>List Layout<br /> </h3> <p>Table layout will simply give you a <em>tabular </em>list<em> </em>of all the titles in that particular Section or Category. No Intro text will be displayed just the titles. You can set how many titles will be displayed in this table by Parameters. The table layout will also provide a filter Section so that Users can reorder, filter, and set how many titles are listed on a single page (up to 50)</p> <h2>Wrapper</h2> <p>Wrappers allow you to place stand alone applications and Third Party Web sites inside your Joomla! site. The content within a Wrapper appears within the primary content area defined by the "mainbody" tag and allows you to display their content as a part of your own site. A Wrapper will place an IFRAME into the content Section of your Web site and wrap your standard template navigation around it so it appears in the same way an Article would.</p> <h2>Content Parameters</h2> <p>The parameters for each layout type can be found on the right hand side of the editor boxes in the Menu Item configuration screen. The parameters available depend largely on what kind of layout you are configuring.</p>', '', 1, 4, 0, 29, '2008-08-12 22:33:10', 62, '', '2008-08-12 22:33:10', 62, 0, '0000-00-00 00:00:00', '2006-10-11 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 11, 0, 5, '', '', 0, 70, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (25, 'What are the requirements to run Joomla! 1.5?', 'what-are-the-requirements-to-run-joomla-15', '', '<p>Joomla! runs on the PHP pre-processor. PHP comes in many flavours, for a lot of operating systems. Beside PHP you will need a Web server. Joomla! is optimized for the Apache Web server, but it can run on different Web servers like Microsoft IIS it just requires additional configuration of PHP and MySQL. Joomla! also depends on a database, for this currently you can only use MySQL. </p>Many people know from their own experience that it''s not easy to install an Apache Web server and it gets harder if you want to add MySQL, PHP and Perl. XAMPP, WAMP, and MAMP are easy to install distributions containing Apache, MySQL, PHP and Perl for the Windows, Mac OSX and Linux operating systems. These packages are for localhost installations on non-public servers only.<br />The minimum version requirements are:<br /><ul><li>Apache 1.x or 2.x</li><li>PHP 4.3 or up</li><li>MySQL 3.23 or up</li></ul>For the latest minimum requirements details, see <a href="http://www.joomla.org/about-joomla/technical-requirements.html" target="_blank" title="Joomla! Technical Requirements">Joomla! Technical Requirements</a>.', '', 1, 4, 0, 31, '2008-08-11 00:42:31', 62, '', '2008-08-11 00:42:31', 62, 0, '0000-00-00 00:00:00', '2006-10-10 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 6, 0, 5, '', '', 0, 25, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (26, 'Extensions', 'extensions', '', '<p>Out of the box, Joomla! does a great job of managing the content needed to make your Web site sing. But for many people, the true power of Joomla! lies in the application framework that makes it possible for developers all around the world to create powerful add-ons that are called <strong>Extensions</strong>. An Extension is used to add capabilities to Joomla! that do not exist in the base core code. Here are just some examples of the hundreds of available Extensions:</p> <ul>   <li>Dynamic form builders</li>   <li>Business or organisational directories</li>   <li>Document management</li>   <li>Image and multimedia galleries</li>   <li>E-commerce and shopping cart engines</li>   <li>Forums and chat software</li>   <li>Calendars</li>   <li>E-mail newsletters</li>   <li>Data collection and reporting tools</li>   <li>Banner advertising systems</li>   <li>Paid subscription services</li>   <li>and many, many, more</li> </ul> <p>You can find more examples over at our ever growing <a href="http://extensions.joomla.org" target="_blank" title="Joomla! Extensions Directory">Joomla! Extensions Directory</a>. Prepare to be amazed at the amount of exciting work produced by our active developer community!</p><p>A useful guide to the Extension site can be found at:<br /><a href="http://extensions.joomla.org/content/view/15/63/" target="_blank" title="Guide to the Joomla! Extension site">http://extensions.joomla.org/content/view/15/63/</a> </p> <h3>Types of Extensions </h3><p>There are five types of extensions:</p> <ul>   <li>Components</li>   <li>Modules</li>   <li>Templates</li>   <li>Plugins</li>   <li>Languages</li> </ul> <p>You can read more about the specifics of these using the links in the Article Index - a Table of Contents (yet another useful feature of Joomla!) - at the top right or by clicking on the <strong>Next </strong>link below.<br /> </p> <hr title="Components" class="system-pagebreak" /> <h3><img src="images/stories/ext_com.png" border="0" alt="Component - Joomla! Extension Directory" title="Component - Joomla! Extension Directory" width="17" height="17" /> Components</h3> <p>A Component is the largest and most complex of the Extension types.  Components are like mini-applications that render the main body of the  page. An analogy that might make the relationship easier to understand  would be that Joomla! is a book and all the Components are chapters in  the book. The core Article Component (<font face="courier new,courier">com_content</font>), for example, is the  mini-application that handles all core Article rendering just as the  core registration Component (<font face="courier new,courier">com_user</font>) is the mini-application  that handles User registration.</p> <p>Many of Joomla!''s core features are provided by the use of default Components such as:</p> <ul>   <li>Contacts</li>   <li>Front Page</li>   <li>News Feeds</li>   <li>Banners</li>   <li>Mass Mail</li>   <li>Polls</li></ul><p>A Component will manage data, set displays, provide functions, and in general can perform any operation that does not fall under the general functions of the core code.</p> <p>Components work hand in hand with Modules and Plugins to provide a rich variety of content display and functionality aside from the standard Article and content display. They make it possible to completely transform Joomla! and greatly expand its capabilities.</p>  <hr title="Modules" class="system-pagebreak" /> <h3><img src="images/stories/ext_mod.png" border="0" alt="Module - Joomla! Extension Directory" title="Module - Joomla! Extension Directory" width="17" height="17" /> Modules</h3> <p>A more lightweight and flexible Extension used for page rendering is a Module. Modules are used for small bits of the page that are generally  less complex and able to be seen across different Components. To  continue in our book analogy, a Module can be looked at as a footnote  or header block, or perhaps an image/caption block that can be rendered  on a particular page. Obviously you can have a footnote on any page but  not all pages will have them. Footnotes also might appear regardless of  which chapter you are reading. Simlarly Modules can be rendered  regardless of which Component you have loaded.</p> <p>Modules are like little mini-applets that can be placed anywhere on your site. They work in conjunction with Components in some cases and in others are complete stand alone snippets of code used to display some data from the database such as Articles (Newsflash) Modules are usually used to output data but they can also be interactive form items to input data for example the Login Module or Polls.</p> <p>Modules can be assigned to Module positions which are defined in your Template and in the back-end using the Module Manager and editing the Module Position settings. For example, "left" and "right" are common for a 3 column layout. </p> <h4>Displaying Modules</h4> <p>Each Module is assigned to a Module position on your site. If you wish it to display in two different locations you must copy the Module and assign the copy to display at the new location. You can also set which Menu Items (and thus pages) a Module will display on, you can select all Menu Items or you can pick and choose by holding down the control key and selecting multiple locations one by one in the Modules [Edit] screen</p> <p>Note: Your Main Menu is a Module! When you create a new Menu in the Menu Manager you are actually copying the Main Menu Module (<font face="courier new,courier">mod_mainmenu</font>) code and giving it the name of your new Menu. When you copy a Module you do not copy all of its parameters, you simply allow Joomla! to use the same code with two separate settings.</p> <h4>Newsflash Example</h4> <p>Newsflash is a Module which will display Articles from your site in an assignable Module position. It can be used and configured to display one Category, all Categories, or to randomly choose Articles to highlight to Users. It will display as much of an Article as you set, and will show a <em>Read more...</em> link to take the User to the full Article.</p> <p>The Newsflash Component is particularly useful for things like Site News or to show the latest Article added to your Web site.</p>  <hr title="Plugins" class="system-pagebreak" /> <h3><img src="images/stories/ext_plugin.png" border="0" alt="Plugin - Joomla! Extension Directory" title="Plugin - Joomla! Extension Directory" width="17" height="17" /> Plugins</h3> <p>One  of the more advanced Extensions for Joomla! is the Plugin. In previous  versions of Joomla! Plugins were known as Mambots. Aside from changing their name their  functionality has been expanded. A Plugin is a section of code that  runs when a pre-defined event happens within Joomla!. Editors are Plugins, for example, that execute when the Joomla! event <font face="courier new,courier">onGetEditorArea</font> occurs. Using a Plugin allows a developer to change  the way their code behaves depending upon which Plugins are installed  to react to an event.</p>  <hr title="Languages" class="system-pagebreak" /> <h3><img src="images/stories/ext_lang.png" border="0" alt="Language - Joomla! Extensions Directory" title="Language - Joomla! Extensions Directory" width="17" height="17" /> Languages</h3> <p>New  to Joomla! 1.5 and perhaps the most basic and critical Extension is a Language. Joomla! is released with multiple Installation Languages but the base Site and Administrator are packaged in just the one Language <strong>en-GB</strong> - being English with GB spelling for example. To include all the translations currently available would bloat the core package and make it unmanageable for uploading purposes. The Language files enable all the User interfaces both Front-end and Back-end to be presented in the local preferred language. Note these packs do not have any impact on the actual content such as Articles. </p> <p>More information on languages is available from the <br />   <a href="http://community.joomla.org/translations.html" target="_blank" title="Joomla! Translation Teams">http://community.joomla.org/translations.html</a></p>', '', 1, 4, 0, 29, '2008-08-11 06:00:00', 62, '', '2008-08-11 06:00:00', 62, 0, '0000-00-00 00:00:00', '2006-10-10 22:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 24, 0, 3, 'About Joomla!, General, Extensions', '', 0, 102, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (27, 'The Joomla! Community', 'the-joomla-community', '', '<p><strong>Got a question? </strong>With more than 210,000 members, the Joomla! Discussion Forums at <a href="http://forum.joomla.org/" target="_blank" title="Forums">forum.joomla.org</a> are a great resource for both new and experienced users. Ask your toughest questions the community is waiting to see what you''ll do with your Joomla! site.</p><p><strong>Do you want to show off your new Joomla! Web site?</strong> Visit the <a href="http://forum.joomla.org/viewforum.php?f=514" target="_blank" title="Site Showcase">Site Showcase</a> section of our forum.</p><p><strong>Do you want to contribute?</strong></p><p>If you think working with Joomla is fun, wait until you start working on it. We''re passionate about helping Joomla users become contributors. There are many ways you can help Joomla''s development:</p><ul>	<li>Submit news about Joomla. We syndicate Joomla-related news on <a href="http://news.joomla.org" target="_blank" title="JoomlaConnect">JoomlaConnect<sup>TM</sup></a>. If you have Joomla news that you would like to share with the community, find out how to get connected <a href="http://community.joomla.org/connect.html" target="_blank" title="JoomlaConnect">here</a>.</li>	<li>Report bugs and request features in our <a href="http://joomlacode.org/gf/project/joomla/tracker/" target="_blank" title="Joomla! developement trackers">trackers</a>. Please read <a href="http://docs.joomla.org/Filing_bugs_and_issues" target="_blank" title="Reporting Bugs">Reporting Bugs</a>, for details on how we like our bug reports served up</li><li>Submit patches for new and/or fixed behaviour. Please read <a href="http://docs.joomla.org/Patch_submission_guidelines" target="_blank" title="Submitting Patches">Submitting Patches</a>, for details on how to submit a patch.</li><li>Join the <a href="http://forum.joomla.org/viewforum.php?f=509" target="_blank" title="Joomla! development forums">developer forums</a> and share your ideas for how to improve Joomla. We''re always open to suggestions, although we''re likely to be sceptical of large-scale suggestions without some code to back it up.</li><li>Join any of the <a href="http://www.joomla.org/about-joomla/the-project/working-groups.html" target="_blank" title="Joomla! working groups">Joomla Working Groups</a> and bring your personal expertise to the Joomla community. </li></ul><p>These are just a few ways you can contribute. See <a href="http://www.joomla.org/about-joomla/contribute-to-joomla.html" target="_blank" title="Contribute">Contribute to Joomla</a> for many more ways.</p>', '', 1, 4, 0, 30, '2008-08-12 16:50:48', 62, '', '2008-08-12 16:50:48', 62, 0, '0000-00-00 00:00:00', '2006-10-11 02:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 12, 0, 2, '', '', 0, 52, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (28, 'How do I install Joomla! 1.5?', 'how-do-i-install-joomla-15', '', '<p>Installing of Joomla! 1.5 is pretty easy. We assume you have set-up your Web site, and it is accessible with your browser.<br /><br />Download Joomla! 1.5, unzip it and upload/copy the files into the directory you Web site points to, fire up your browser and enter your Web site address and the installation will start.  </p><p>For full details on the installation processes check out the <a href="http://help.joomla.org/content/category/48/268/302" target="_blank" title="Joomla! 1.5 Installation Manual">Installation Manual</a> on the <a href="http://help.joomla.org" target="_blank" title="Joomla! Help Site">Joomla! Help Site</a> where you will also find download instructions for a PDF version too. </p>', '', 1, 4, 0, 31, '2008-08-11 01:10:59', 62, '', '2008-08-11 01:10:59', 62, 0, '0000-00-00 00:00:00', '2006-10-10 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 5, 0, 3, '', '', 0, 5, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (29, 'What is the purpose of the collation selection in the installation screen?', 'what-is-the-purpose-of-the-collation-selection-in-the-installation-screen', '', 'The collation option determines the way ordering in the database is done. In languages that use special characters, for instance the German umlaut, the database collation determines the sorting order. If you don''t know which collation you need, select the "utf8_general_ci" as most languages use this. The other collations listed are exceptions in regards to the general collation. If your language is not listed in the list of collations it most likely means that "utf8_general_ci is suitable.', '', 1, 5, 0, 32, '2008-08-11 03:11:38', 62, '', '2008-08-11 03:11:38', 62, 0, '0000-00-00 00:00:00', '2006-10-10 08:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=', 4, 0, 4, '', '', 0, 6, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (30, 'What languages are supported by Joomla! 1.5?', 'what-languages-are-supported-by-joomla-15', '', 'Within the Installer you will find a wide collection of languages. The installer currently supports the following languages: Arabic, Bulgarian, Bengali, Czech, Danish, German, Greek, English, Spanish, Finnish, French, Hebrew, Devanagari(India), Croatian(Croatia), Magyar (Hungary), Italian, Malay, Norwegian bokmal, Dutch, Portuguese(Brasil), Portugues(Portugal), Romanian, Russian, Serbian, Svenska, Thai and more are being added all the time.<br />By default the English language is installed for the Back and Front-ends. You can download additional language files from the <a href="http://extensions.joomla.org" target="_blank" title="Joomla! Extensions Directory">Joomla!Extensions Directory</a>. ', '', 1, 5, 0, 32, '2008-08-11 01:12:18', 62, '', '2008-08-11 01:12:18', 62, 0, '0000-00-00 00:00:00', '2006-10-10 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 5, 0, 2, '', '', 0, 8, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (31, 'Is it useful to install the sample data?', 'is-it-useful-to-install-the-sample-data', '', 'Well you are reading it right now! This depends on what you want to achieve. If you are new to Joomla! and have no clue how it all fits together, just install the sample data. If you don''t like the English sample data because you - for instance - speak Chinese, then leave it out.', '', 1, 6, 0, 27, '2008-08-11 09:12:55', 62, '', '2008-08-11 09:12:55', 62, 0, '0000-00-00 00:00:00', '2006-10-10 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 6, 0, 3, '', '', 0, 3, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (32, 'Where is the Static Content Item?', 'where-is-the-static-content', '', '<p>In Joomla! versions prior to 1.5 there were separate processes for creating a Static Content Item and normal Content Items. The processes have been combined now and whilst both content types are still around they are renamed as Articles for Content Items and Uncategorized Articles for Static Content Items. </p><p>If you want to create a static item, create a new Article in the same way as for standard content and rather than relating this to a particular Section and Category just select <span style="font-style: italic">Uncategorized</span> as the option in the Section and Category drop down lists.</p>', '', 1, 4, 0, 28, '2008-08-10 23:13:33', 62, '', '2008-08-10 23:13:33', 62, 0, '0000-00-00 00:00:00', '2006-10-10 04:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 6, 0, 6, '', '', 0, 5, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (33, 'What is an Uncategorised Article?', 'what-is-uncategorised-article', '', 'Most Articles will be assigned to a Section and Category. In many cases, you might not know where you want it to appear so put the Article in the <em>Uncategorized </em>Section/Category. The Articles marked as <em>Uncategorized </em>are handled as static content.', '', 1, 4, 0, 31, '2008-08-11 15:14:11', 62, '', '2008-08-11 15:14:11', 62, 0, '0000-00-00 00:00:00', '2006-10-10 12:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 8, 0, 2, '', '', 0, 6, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (34, 'Does the PDF icon render pictures and special characters?', 'does-the-pdf-icon-render-pictures-and-special-characters', '', 'Yes! Prior to Joomla! 1.5, only the text values of an Article and only for ISO-8859-1 encoding was allowed in the PDF rendition. With the new PDF library in place, the complete Article including images is rendered and applied to the PDF. The PDF generator also handles the UTF-8 texts and can handle any character sets from any language. The appropriate fonts must be installed but this is done automatically during a language pack installation.', '', 1, 5, 0, 32, '2008-08-11 17:14:57', 62, '', '2008-08-11 17:14:57', 62, 0, '0000-00-00 00:00:00', '2006-10-10 14:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 3, '', '', 0, 6, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (35, 'Is it possible to change A Menu Item''s Type?', 'is-it-possible-to-change-the-types-of-menu-entries', '', '<p>You indeed can change the Menu Item''s Type to whatever you want, even after they have been created. </p><p>If, for instance, you want to change the Blog Section of a Menu link, go to the Control Panel-&gt;Menus Menu-&gt;[menuname]-&gt;Menu Item Manager and edit the Menu Item. Select the <strong>Change Type</strong> button and choose the new style of Menu Item Type from the available list. Thereafter, alter the Details and Parameters to reconfigure the display for the new selection  as you require it.</p>', '', 1, 4, 0, 31, '2008-08-10 23:15:36', 62, '', '2008-08-10 23:15:36', 62, 0, '0000-00-00 00:00:00', '2006-10-10 04:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 6, 0, 1, '', '', 0, 18, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (36, 'Where did the Installers go?', 'where-did-the-installer-go', '', 'The improved Installer can be found under the Extensions Menu. With versions prior to Joomla! 1.5 you needed to select a specific Extension type when you wanted to install it and use the Installer associated with it, with Joomla! 1.5 you just select the Extension you want to upload, and click on install. The Installer will do all the hard work for you.', '', 1, 4, 0, 28, '2008-08-10 23:16:20', 62, '', '2008-08-10 23:16:20', 62, 0, '0000-00-00 00:00:00', '2006-10-10 04:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 6, 0, 1, '', '', 0, 4, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (37, 'Where did the Mambots go?', 'where-did-the-mambots-go', '', '<p>Mambots have been renamed as Plugins. </p><p>Mambots were introduced in Mambo and offered possibilities to add plug-in logic to your site mainly for the purpose of manipulating content. In Joomla! 1.5, Plugins will now have much broader capabilities than Mambots. Plugins are able to extend functionality at the framework layer as well.</p>', '', 1, 4, 0, 28, '2008-08-11 09:17:00', 62, '', '2008-08-11 09:17:00', 62, 0, '0000-00-00 00:00:00', '2006-10-10 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 6, 0, 5, '', '', 0, 4, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (38, 'I installed with my own language, but the Back-end is still in English', 'i-installed-with-my-own-language-but-the-back-end-is-still-in-english', '', '<p>A lot of different languages are available for the Back-end, but by default this language may not be installed. If you want a translated Back-end, get your language pack and install it using the Extension Installer. After this, go to the Extensions Menu, select Language Manager and make your language the default one. Your Back-end will be translated immediately.</p><p>Users who have access rights to the Back-end may choose the language they prefer in their Personal Details parameters. This is of also true for the Front-end language.</p><p> A good place to find where to download your languages and localised versions of Joomla! is <a href="http://extensions.joomla.org/index.php?option=com_mtree&task=listcats&cat_id=1837&Itemid=35" target="_blank" title="Translations for Joomla!">Translations for Joomla!</a> on JED.</p>', '', 1, 5, 0, 32, '2008-08-11 17:18:14', 62, '', '2008-08-11 17:18:14', 62, 0, '0000-00-00 00:00:00', '2006-10-10 14:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 1, '', '', 0, 7, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (39, 'How do I remove an Article?', 'how-do-i-remove-an-article', '', '<p>To completely remove an Article, select the Articles that you want to delete and move them to the Trash. Next, open the Article Trash in the Content Menu and select the Articles you want to delete. After deleting an Article, it is no longer available as it has been deleted from the database and it is not possible to undo this operation.  </p>', '', 1, 6, 0, 27, '2008-08-11 09:19:01', 62, '', '2008-08-11 09:19:01', 62, 0, '0000-00-00 00:00:00', '2006-10-10 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 6, 0, 2, '', '', 0, 4, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (40, 'What is the difference between Archiving and Trashing an Article? ', 'what-is-the-difference-between-archiving-and-trashing-an-article', '', '<p>When you <em>Archive </em>an Article, the content is put into a state which removes it from your site as published content. The Article is still available from within the Control Panel and can be <em>retrieved </em>for editing or republishing purposes. Trashed Articles are just one step from being permanently deleted but are still available until you Remove them from the Trash Manager. You should use Archive if you consider an Article important, but not current. Trash should be used when you want to delete the content entirely from your site and from future search results.  </p>', '', 1, 6, 0, 27, '2008-08-11 05:19:43', 62, '', '2008-08-11 05:19:43', 62, 0, '0000-00-00 00:00:00', '2006-10-10 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 8, 0, 1, '', '', 0, 5, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (41, 'Newsflash 5', 'newsflash-5', '', 'Joomla! 1.5 - ''Experience the Freedom''!. It has never been easier to create your own dynamic Web site. Manage all your content from the best CMS admin interface and in virtually any language you speak.', '', 1, 1, 0, 3, '2008-08-12 00:17:31', 62, '', '2008-08-12 00:17:31', 62, 0, '0000-00-00 00:00:00', '2006-10-11 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 5, 0, 2, '', '', 0, 4, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (42, 'Newsflash 4', 'newsflash-4', '', 'Yesterday all servers in the U.S. went out on strike in a bid to get more RAM and better CPUs. A spokes person said that the need for better RAM was due to some fool increasing the front-side bus speed. In future, buses will be told to slow down in residential motherboards.', '', 1, 1, 0, 3, '2008-08-12 00:25:50', 62, '', '2008-08-12 00:25:50', 62, 0, '0000-00-00 00:00:00', '2006-10-11 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 5, 0, 1, '', '', 0, 5, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (43, 'Example Pages and Menu Links', 'example-pages-and-menu-links', '', '<p>This page is an example of content that is <em>Uncategorized</em>; that is, it does not belong to any Section or Category. You will see there is a new Menu in the left column. It shows links to the same content presented in 4 different page layouts.</p><ul><li>Section Blog</li><li>Section Table</li><li> Blog Category</li><li>Category Table</li></ul><p>Follow the links in the <strong>Example Pages</strong> Menu to see some of the options available to you to present all the different types of content included within the default installation of Joomla!.</p><p>This includes Components and individual Articles. These links or Menu Item Types (to give them their proper name) are all controlled from within the <strong><font face="courier new,courier">Menu Manager-&gt;[menuname]-&gt;Menu Items Manager</font></strong>. </p>', '', 1, 0, 0, 0, '2008-08-12 09:26:52', 62, '', '2008-08-12 09:26:52', 62, 0, '0000-00-00 00:00:00', '2006-10-11 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 1, 'Uncategorized, Uncategorized, Example Pages and Menu Links', '', 0, 43, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (44, 'Joomla! Security Strike Team', 'joomla-security-strike-team', '', '<p>The Joomla! Project has assembled a top-notch team of experts to form the new Joomla! Security Strike Team. This new team will solely focus on investigating and resolving security issues. Instead of working in relative secrecy, the JSST will have a strong public-facing presence at the <a href="http://developer.joomla.org/security.html" target="_blank" title="Joomla! Security Center">Joomla! Security Center</a>.</p>', '<p>The new JSST will call the new <a href="http://developer.joomla.org/security.html" target="_blank" title="Joomla! Security Center">Joomla! Security Center</a> their home base. The Security Center provides a public presence for <a href="http://developer.joomla.org/security/news.html" target="_blank" title="Joomla! Security News">security issues</a> and a platform for the JSST to <a href="http://developer.joomla.org/security/articles-tutorials.html" target="_blank" title="Joomla! Security Articles">help the general public better understand security</a> and how it relates to Joomla!. The Security Center also offers users a clearer understanding of how security issues are handled. There''s also a <a href="http://feeds.joomla.org/JoomlaSecurityNews" target="_blank" title="Joomla! Security News Feed">news feed</a>, which provides subscribers an up-to-the-minute notification of security issues as they arise.</p>', 1, 1, 0, 1, '2007-07-07 09:54:06', 62, '', '2007-07-07 09:54:06', 62, 0, '0000-00-00 00:00:00', '2004-07-06 22:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 3, '', '', 0, 0, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES (45, 'Joomla! Community Portal', 'joomla-community-portal', '', '<p>The <a href="http://community.joomla.org/" target="_blank" title="Joomla! Community Portal">Joomla! Community Portal</a> is now online. There, you will find a constant source of information about the activities of contributors powering the Joomla! Project. Learn about <a href="http://community.joomla.org/events.html" target="_blank" title="Joomla! Events">Joomla! Events</a> worldwide, and see if there is a <a href="http://community.joomla.org/user-groups.html" target="_blank" title="Joomla! User Groups">Joomla! User Group</a> nearby.</p><p>The <a href="http://magazine.joomla.org/" target="_blank" title="Joomla! Community Magazine">Joomla! Community Magazine</a> promises an interesting overview of feature articles, community accomplishments, learning topics, and project updates each month. Also, check out <a href="http://community.joomla.org/connect.html" target="_blank" title="JoomlaConnect">JoomlaConnect&#0153;</a>. This aggregated RSS feed brings together Joomla! news from all over the world in your language. Get the latest and greatest by clicking <a href="http://community.joomla.org/connect.html" target="_blank" title="JoomlaConnect">here</a>.</p>', '', 1, 1, 0, 1, '2007-07-07 09:54:06', 62, '', '2007-07-07 09:54:06', 62, 0, '0000-00-00 00:00:00', '2004-07-06 22:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 2, 0, 2, '', '', 0, 5, 'robots=\nauthor=');

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_content_frontpage`
-- 

CREATE TABLE `jos_content_frontpage` (
  `content_id` int(11) NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  PRIMARY KEY  (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_content_frontpage`
-- 

INSERT INTO `jos_content_frontpage` VALUES (45, 2);
INSERT INTO `jos_content_frontpage` VALUES (6, 3);
INSERT INTO `jos_content_frontpage` VALUES (44, 4);
INSERT INTO `jos_content_frontpage` VALUES (5, 5);
INSERT INTO `jos_content_frontpage` VALUES (9, 6);
INSERT INTO `jos_content_frontpage` VALUES (30, 7);
INSERT INTO `jos_content_frontpage` VALUES (16, 8);

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_content_rating`
-- 

CREATE TABLE `jos_content_rating` (
  `content_id` int(11) NOT NULL default '0',
  `rating_sum` int(11) unsigned NOT NULL default '0',
  `rating_count` int(11) unsigned NOT NULL default '0',
  `lastip` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_content_rating`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `jos_core_acl_aro`
-- 

CREATE TABLE `jos_core_acl_aro` (
  `id` int(11) NOT NULL auto_increment,
  `section_value` varchar(240) NOT NULL default '0',
  `value` varchar(240) NOT NULL default '',
  `order_value` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `hidden` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `jos_section_value_value_aro` (`section_value`(100),`value`(100)),
  KEY `jos_gacl_hidden_aro` (`hidden`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `jos_core_acl_aro`
-- 

INSERT INTO `jos_core_acl_aro` VALUES (10, 'users', '62', 0, 'Kiều Văn Ngọc', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_core_acl_aro_groups`
-- 

CREATE TABLE `jos_core_acl_aro_groups` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `lft` int(11) NOT NULL default '0',
  `rgt` int(11) NOT NULL default '0',
  `value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `jos_gacl_parent_id_aro_groups` (`parent_id`),
  KEY `jos_gacl_lft_rgt_aro_groups` (`lft`,`rgt`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- 
-- Dumping data for table `jos_core_acl_aro_groups`
-- 

INSERT INTO `jos_core_acl_aro_groups` VALUES (17, 0, 'ROOT', 1, 22, 'ROOT');
INSERT INTO `jos_core_acl_aro_groups` VALUES (28, 17, 'USERS', 2, 21, 'USERS');
INSERT INTO `jos_core_acl_aro_groups` VALUES (29, 28, 'Public Frontend', 3, 12, 'Public Frontend');
INSERT INTO `jos_core_acl_aro_groups` VALUES (18, 29, 'Registered', 4, 11, 'Registered');
INSERT INTO `jos_core_acl_aro_groups` VALUES (19, 18, 'Author', 5, 10, 'Author');
INSERT INTO `jos_core_acl_aro_groups` VALUES (20, 19, 'Editor', 6, 9, 'Editor');
INSERT INTO `jos_core_acl_aro_groups` VALUES (21, 20, 'Publisher', 7, 8, 'Publisher');
INSERT INTO `jos_core_acl_aro_groups` VALUES (30, 28, 'Public Backend', 13, 20, 'Public Backend');
INSERT INTO `jos_core_acl_aro_groups` VALUES (23, 30, 'Manager', 14, 19, 'Manager');
INSERT INTO `jos_core_acl_aro_groups` VALUES (24, 23, 'Administrator', 15, 18, 'Administrator');
INSERT INTO `jos_core_acl_aro_groups` VALUES (25, 24, 'Super Administrator', 16, 17, 'Super Administrator');

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_core_acl_aro_map`
-- 

CREATE TABLE `jos_core_acl_aro_map` (
  `acl_id` int(11) NOT NULL default '0',
  `section_value` varchar(230) NOT NULL default '0',
  `value` varchar(100) NOT NULL,
  PRIMARY KEY  (`acl_id`,`section_value`,`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_core_acl_aro_map`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `jos_core_acl_aro_sections`
-- 

CREATE TABLE `jos_core_acl_aro_sections` (
  `id` int(11) NOT NULL auto_increment,
  `value` varchar(230) NOT NULL default '',
  `order_value` int(11) NOT NULL default '0',
  `name` varchar(230) NOT NULL default '',
  `hidden` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `jos_gacl_value_aro_sections` (`value`),
  KEY `jos_gacl_hidden_aro_sections` (`hidden`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `jos_core_acl_aro_sections`
-- 

INSERT INTO `jos_core_acl_aro_sections` VALUES (10, 'users', 1, 'Users', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_core_acl_groups_aro_map`
-- 

CREATE TABLE `jos_core_acl_groups_aro_map` (
  `group_id` int(11) NOT NULL default '0',
  `section_value` varchar(240) NOT NULL default '',
  `aro_id` int(11) NOT NULL default '0',
  UNIQUE KEY `group_id_aro_id_groups_aro_map` (`group_id`,`section_value`,`aro_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_core_acl_groups_aro_map`
-- 

INSERT INTO `jos_core_acl_groups_aro_map` VALUES (25, '', 10);

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_core_log_items`
-- 

CREATE TABLE `jos_core_log_items` (
  `time_stamp` date NOT NULL default '0000-00-00',
  `item_table` varchar(50) NOT NULL default '',
  `item_id` int(11) unsigned NOT NULL default '0',
  `hits` int(11) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_core_log_items`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `jos_core_log_searches`
-- 

CREATE TABLE `jos_core_log_searches` (
  `search_term` varchar(128) NOT NULL default '',
  `hits` int(11) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_core_log_searches`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `jos_groups`
-- 

CREATE TABLE `jos_groups` (
  `id` tinyint(3) unsigned NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_groups`
-- 

INSERT INTO `jos_groups` VALUES (0, 'Public');
INSERT INTO `jos_groups` VALUES (1, 'Registered');
INSERT INTO `jos_groups` VALUES (2, 'Special');

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_menu`
-- 

CREATE TABLE `jos_menu` (
  `id` int(11) NOT NULL auto_increment,
  `menutype` varchar(75) default NULL,
  `name` varchar(255) default NULL,
  `alias` varchar(255) NOT NULL default '',
  `link` text,
  `type` varchar(50) NOT NULL default '',
  `published` tinyint(1) NOT NULL default '0',
  `parent` int(11) unsigned NOT NULL default '0',
  `componentid` int(11) unsigned NOT NULL default '0',
  `sublevel` int(11) default '0',
  `ordering` int(11) default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `pollid` int(11) NOT NULL default '0',
  `browserNav` tinyint(4) default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `utaccess` tinyint(3) unsigned NOT NULL default '0',
  `params` text NOT NULL,
  `lft` int(11) unsigned NOT NULL default '0',
  `rgt` int(11) unsigned NOT NULL default '0',
  `home` int(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `componentid` (`componentid`,`menutype`,`published`,`access`),
  KEY `menutype` (`menutype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=116 ;

-- 
-- Dumping data for table `jos_menu`
-- 

INSERT INTO `jos_menu` VALUES (1, 'mainmenu', 'Home', 'home', 'index.php?option=com_content&view=frontpage', 'component', 1, 0, 20, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'show_page_title=1\npage_title=Welcome to the Frontpage\nshow_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\nshow_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\norderby_pri=\norderby_sec=front\nshow_pagination=2\nshow_pagination_results=1\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 1);
INSERT INTO `jos_menu` VALUES (2, 'mainmenu', 'Joomla! License', 'joomla-license', 'index.php?option=com_content&view=article&id=5', 'component', 1, 0, 20, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'pageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (41, 'mainmenu', 'FAQ', 'faq', 'index.php?option=com_content&view=section&id=3', 'component', 1, 0, 20, 0, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_page_title=1\nshow_description=0\nshow_description_image=0\nshow_categories=1\nshow_empty_categories=0\nshow_cat_num_articles=1\nshow_category_description=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\norderby=\nshow_noauth=0\nshow_title=1\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (11, 'othermenu', 'Joomla! Home', 'joomla-home', 'http://www.joomla.org', 'url', 1, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (12, 'othermenu', 'Joomla! Forums', 'joomla-forums', 'http://forum.joomla.org', 'url', 1, 0, 0, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (13, 'othermenu', 'Joomla! Documentation', 'joomla-documentation', 'http://docs.joomla.org', 'url', 1, 0, 0, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (14, 'othermenu', 'Joomla! Community', 'joomla-community', 'http://community.joomla.org', 'url', 1, 0, 0, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (15, 'othermenu', 'Joomla! Magazine', 'joomla-community-magazine', 'http://magazine.joomla.org/', 'url', 1, 0, 0, 0, 5, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (16, 'othermenu', 'OSM Home', 'osm-home', 'http://www.opensourcematters.org', 'url', 1, 0, 0, 0, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 6, 'menu_image=-1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (17, 'othermenu', 'Administrator', 'administrator', 'administrator/', 'url', 1, 0, 0, 0, 7, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (18, 'topmenu', 'News', 'news', 'index.php?option=com_newsfeeds&view=newsfeed&id=1&feedid=1', 'component', -2, 0, 11, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'show_page_title=1\npage_title=News\npageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_headings=1\nshow_name=1\nshow_articles=1\nshow_link=1\nshow_other_cats=1\nshow_cat_description=1\nshow_cat_items=1\nshow_feed_image=1\nshow_feed_description=1\nshow_item_description=1\nfeed_word_count=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (20, 'usermenu', 'Your Details', 'your-details', 'index.php?option=com_user&view=user&task=edit', 'component', 1, 0, 14, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 1, 3, '', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (24, 'usermenu', 'Logout', 'logout', 'index.php?option=com_user&view=login', 'component', 1, 0, 14, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 1, 3, '', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (38, 'keyconcepts', 'Content Layouts', 'content-layouts', 'index.php?option=com_content&view=article&id=24', 'component', 1, 0, 20, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'pageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (27, 'mainmenu', 'Joomla! Overview', 'joomla-overview', 'index.php?option=com_content&view=article&id=19', 'component', 1, 0, 20, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'pageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (28, 'topmenu', 'About Joomla!', 'about-joomla', 'index.php?option=com_content&view=article&id=25', 'component', -2, 0, 20, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'pageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (29, 'topmenu', 'Features', 'features', 'index.php?option=com_content&view=article&id=22', 'component', -2, 0, 20, 0, 5, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'pageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (30, 'topmenu', 'The Community', 'the-community', 'index.php?option=com_content&view=article&id=27', 'component', -2, 0, 20, 0, 7, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'pageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (34, 'mainmenu', 'What''s New in 1.5?', 'what-is-new-in-1-5', 'index.php?option=com_content&view=article&id=22', 'component', 1, 27, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'pageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=0\nshow_title=1\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (40, 'keyconcepts', 'Extensions', 'extensions', 'index.php?option=com_content&view=article&id=26', 'component', 1, 0, 20, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'pageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (37, 'mainmenu', 'More about Joomla!', 'more-about-joomla', 'index.php?option=com_content&view=section&id=4', 'component', 1, 0, 20, 0, 5, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_page_title=1\nshow_description=0\nshow_description_image=0\nshow_categories=1\nshow_empty_categories=0\nshow_cat_num_articles=1\nshow_category_description=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\norderby=\nshow_noauth=0\nshow_title=1\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (43, 'keyconcepts', 'Example Pages', 'example-pages', 'index.php?option=com_content&view=article&id=43', 'component', 1, 0, 20, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'pageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (44, 'ExamplePages', 'Section Blog', 'section-blog', 'index.php?option=com_content&view=section&layout=blog&id=3', 'component', 1, 0, 20, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_page_title=1\npage_title=Example of Section Blog layout (FAQ section)\nshow_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\nshow_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\norderby_pri=\norderby_sec=\nshow_pagination=2\nshow_pagination_results=1\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (45, 'ExamplePages', 'Section Table', 'section-table', 'index.php?option=com_content&view=section&id=3', 'component', 1, 0, 20, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_page_title=1\npage_title=Example of Table Blog layout (FAQ section)\nshow_description=0\nshow_description_image=0\nshow_categories=1\nshow_empty_categories=0\nshow_cat_num_articles=1\nshow_category_description=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\norderby=\nshow_noauth=0\nshow_title=1\nnlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (46, 'ExamplePages', 'Category Blog', 'categoryblog', 'index.php?option=com_content&view=category&layout=blog&id=31', 'component', 1, 0, 20, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_page_title=1\npage_title=Example of Category Blog layout (FAQs/General category)\nshow_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\nshow_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\norderby_pri=\norderby_sec=\nshow_pagination=2\nshow_pagination_results=1\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (47, 'ExamplePages', 'Category Table', 'category-table', 'index.php?option=com_content&view=category&id=32', 'component', 1, 0, 20, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_page_title=1\npage_title=Example of Category Table layout (FAQs/Languages category)\nshow_headings=1\nshow_date=0\ndate_format=\nfilter=1\nfilter_type=title\npageclass_sfx=\nmenu_image=-1\nsecure=0\norderby_sec=\nshow_pagination=1\nshow_pagination_limit=1\nshow_noauth=0\nshow_title=1\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (48, 'mainmenu', 'Web Links', 'web-links', 'index.php?option=com_weblinks&view=categories', 'component', 1, 0, 4, 0, 8, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'page_title=Weblinks\nimage=-1\nimage_align=right\npageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_comp_description=1\ncomp_description=\nshow_link_hits=1\nshow_link_description=1\nshow_other_cats=1\nshow_headings=1\nshow_page_title=1\nlink_target=0\nlink_icons=\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (49, 'mainmenu', 'News Feeds', 'news-feeds', 'index.php?option=com_newsfeeds&view=categories', 'component', 1, 0, 11, 0, 9, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_page_title=1\npage_title=Newsfeeds\nshow_comp_description=1\ncomp_description=\nimage=-1\nimage_align=right\npageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_headings=1\nshow_name=1\nshow_articles=1\nshow_link=1\nshow_other_cats=1\nshow_cat_description=1\nshow_cat_items=1\nshow_feed_image=1\nshow_feed_description=1\nshow_item_description=1\nfeed_word_count=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (50, 'mainmenu', 'The News', 'the-news', 'index.php?option=com_content&view=category&layout=blog&id=1', 'component', 1, 0, 20, 0, 7, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_page_title=1\npage_title=The News\nshow_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\nshow_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\norderby_pri=\norderby_sec=\nshow_pagination=2\nshow_pagination_results=1\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (51, 'usermenu', 'Submit an Article', 'submit-an-article', 'index.php?option=com_content&view=article&layout=form', 'component', 1, 0, 20, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 2, 0, '', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (52, 'usermenu', 'Submit a Web Link', 'submit-a-web-link', 'index.php?option=com_weblinks&view=weblink&layout=form', 'component', 1, 0, 4, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 2, 0, '', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (53, 'topmenu', 'Trang chủ', 'trang-chu', 'index.php?option=com_content&view=frontpage', 'component', 1, 0, 20, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'num_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=front\nmulti_column_order=1\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (54, 'topmenu', 'Văn hóa', 'van-hoa', 'index.php?option=com_content&view=section&layout=blog&id=4', 'component', 1, 0, 20, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (55, 'topmenu', 'Xã hội', 'xa-hoi', 'index.php?option=com_content&view=section&layout=blog&id=1', 'component', 1, 0, 20, 0, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (56, 'topmenu', 'Giáo dục', 'giao-duc', 'index.php?option=com_content&view=section&layout=blog&id=2', 'component', 1, 0, 20, 0, 9, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (57, 'topmenu', 'Chính trị', 'chinh-tri', 'index.php?option=com_content&view=section&layout=blog&id=3', 'component', 1, 0, 20, 0, 10, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (58, 'topmenu', 'Tuổi trẻ', 'tuoi-tre', 'index.php?option=com_content&view=section&layout=blog&id=8', 'component', 1, 0, 20, 0, 11, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (59, 'topmenu', 'Thị trường', 'thi-truong', 'index.php?option=com_content&view=section&layout=blog&id=10', 'component', 1, 0, 20, 0, 12, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (60, 'topmenu', 'Quốc tế', 'quoc-te', 'index.php?option=com_content&view=section&layout=blog&id=9', 'component', 1, 0, 20, 0, 14, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (61, 'topmenu', 'Công nghệ số', 'cong-nghe-so', 'index.php?option=com_content&view=section&layout=blog&id=6', 'component', 1, 0, 20, 0, 13, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (62, 'topmenu', 'Thể thao', 'the-thao', 'index.php?option=com_content&view=section&layout=blog&id=7', 'component', 1, 0, 20, 0, 8, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (63, 'topmenu', 'Khoa học', 'khoa-hoc', 'index.php?option=com_content&view=section&layout=blog&id=5', 'component', 1, 0, 20, 0, 15, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (64, 'topmenu', 'Doanh nhân & Doanh nghiệp', 'doanh-nhan-doanh-nghiep', 'index.php?option=com_content&view=section&layout=blog&id=11', 'component', 1, 0, 20, 0, 16, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (65, 'topmenu', 'Kinh doanh', 'kinh-doanh', 'index.php?option=com_content&view=section&layout=blog&id=12', 'component', 1, 0, 20, 0, 17, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (66, 'topmenu', 'Phóng sự', 'phong-su', 'index.php?option=com_content&view=category&layout=blog&id=1', 'component', 1, 55, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (67, 'topmenu', 'Pháp luật', 'phap-luat', 'index.php?option=com_content&view=category&layout=blog&id=2', 'component', 1, 55, 20, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (68, 'topmenu', 'Ô tô - Xe máy', 'oto-xemay', 'index.php?option=com_content&view=category&layout=blog&id=3', 'component', 1, 55, 20, 1, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (69, 'topmenu', 'An toàn giao thông', 'an-toan-giao-thong', 'index.php?option=com_content&view=category&layout=blog&id=4', 'component', 1, 55, 20, 1, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (70, 'topmenu', 'Góc nhìn văn hóa', 'goc-nhin-van-hoa', 'index.php?option=com_content&view=category&layout=blog&id=28', 'component', 1, 54, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (71, 'topmenu', 'Nhan sắc Việt', 'nhan-sac-viet', 'index.php?option=com_content&view=category&layout=blog&id=30', 'component', 1, 54, 20, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (72, 'topmenu', 'Showbiz', 'showbiz', 'index.php?option=com_content&view=category&layout=blog&id=29', 'component', 1, 54, 20, 1, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (73, 'topmenu', 'Ảnh đẹp', 'anh-dep', 'index.php?option=com_content&view=category&layout=blog&id=31', 'component', 1, 54, 20, 1, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (74, 'topmenu', 'Bóng đá Quốc tế', 'bong-da-quoc-te', 'index.php?option=com_content&view=category&layout=blog&id=38', 'component', 1, 62, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (75, 'topmenu', 'Bóng đá trong nước', 'bong-da-trong-nuoc', 'index.php?option=com_content&view=category&layout=blog&id=37', 'component', 1, 62, 20, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (76, 'topmenu', 'Bóng đá Anh', 'bong-da-anh', 'index.php?option=com_content&view=category&layout=blog&id=40', 'component', 1, 62, 20, 1, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (77, 'topmenu', 'Bóng đá Tây Ban Nha', 'bong-da-taybannha', 'index.php?option=com_content&view=category&layout=blog&id=41', 'component', 1, 62, 20, 1, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (78, 'topmenu', 'Bóng đá Ý', 'bong-da-y', 'index.php?option=com_content&view=category&layout=blog&id=42', 'component', 1, 62, 20, 1, 5, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (79, 'topmenu', 'Cup Châu Âu', 'cup-chau-au', 'index.php?option=com_content&view=category&layout=blog&id=39', 'component', 1, 62, 20, 1, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (80, 'topmenu', 'Tennis - Đua xe', 'tennis-duaxe', 'index.php?option=com_content&view=category&layout=blog&id=43', 'component', 1, 62, 20, 1, 7, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (81, 'topmenu', 'Các môn khác', 'cac-mon-khac', 'index.php?option=com_content&view=category&layout=blog&id=44', 'component', 1, 62, 20, 1, 8, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (82, 'topmenu', 'Tuyển sinh', 'tuyen-sinh', 'index.php?option=com_content&view=category&layout=blog&id=5', 'component', 1, 56, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (83, 'topmenu', 'Giảng đường', 'giang-duong', 'index.php?option=com_content&view=category&layout=blog&id=7', 'component', 1, 56, 20, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (84, 'topmenu', 'Du học', 'du-hoc', 'index.php?option=com_content&view=category&layout=blog&id=8', 'component', 1, 56, 20, 1, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (85, 'topmenu', 'Diễn đàn', 'dien-dan', 'index.php?option=com_content&view=category&layout=blog&id=6', 'component', 1, 56, 20, 1, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (86, 'topmenu', 'Đối nội', 'doi-noi', 'index.php?option=com_content&view=category&layout=blog&id=9', 'component', 1, 57, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (87, 'topmenu', 'Đối ngoại', 'doi-ngoai', 'index.php?option=com_content&view=category&layout=blog&id=10', 'component', 1, 57, 20, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (88, 'topmenu', 'Chuyện yêu', 'chuyen-yeu', 'index.php?option=com_content&view=category&layout=blog&id=12', 'component', 1, 58, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (89, 'topmenu', 'Giải trí', 'giai-tri', 'index.php?option=com_content&view=category&layout=blog&id=11', 'component', 1, 58, 20, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (90, 'topmenu', 'Học đường', 'hoc-duong', 'index.php?option=com_content&view=category&layout=blog&id=13', 'component', 1, 58, 20, 1, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (91, 'topmenu', 'Teen - Style', 'teen-style', 'index.php?option=com_content&view=category&layout=blog&id=14', 'component', 1, 58, 20, 1, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (92, 'topmenu', 'Kinh doanh', 'kinh-doanh', 'index.php?option=com_content&view=category&layout=blog&id=16', 'component', 1, 59, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (93, 'topmenu', 'Tài chính', 'tai-chinh', 'index.php?option=com_content&view=category&layout=blog&id=15', 'component', 1, 59, 20, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (94, 'topmenu', 'Thị trường', 'thi-truong', 'index.php?option=com_content&view=category&layout=blog&id=17', 'component', 1, 59, 20, 1, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (95, 'topmenu', 'Tiêu dùng', 'tieu-dung', 'index.php?option=com_content&view=category&layout=blog&id=18', 'component', 1, 59, 20, 1, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (96, 'topmenu', 'Điện thoại', 'dien-thoai', 'index.php?option=com_content&view=category&layout=blog&id=22', 'component', 1, 61, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (97, 'topmenu', 'Máy tính', 'may-tinh', 'index.php?option=com_content&view=category&layout=blog&id=23', 'component', 1, 61, 20, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (98, 'topmenu', 'Camera', 'camera', 'index.php?option=com_content&view=category&layout=blog&id=24', 'component', 1, 61, 20, 1, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (99, 'topmenu', 'Hình ảnh', 'hinh-anh', 'index.php?option=com_content&view=category&layout=blog&id=25', 'component', 1, 61, 20, 1, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (100, 'topmenu', 'Âm thanh', 'am-thanh', 'index.php?option=com_content&view=category&layout=blog&id=27', 'component', 1, 61, 20, 1, 5, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (101, 'topmenu', 'Đồ chơi số', 'do-choi-so', 'index.php?option=com_content&view=category&layout=blog&id=26', 'component', 1, 61, 20, 1, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (102, 'topmenu', 'Thế giới đó đây', 'the-gioi-do-day', 'index.php?option=com_content&view=category&layout=blog&id=20', 'component', 1, 60, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (103, 'topmenu', 'Thế giới 24h', 'the-goi-24h', 'index.php?option=com_content&view=category&layout=blog&id=19', 'component', 1, 60, 20, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (104, 'topmenu', 'Nhân vật và đối thoại', 'nhan-vat-va-doi-thoai', 'index.php?option=com_content&view=category&layout=blog&id=21', 'component', 1, 60, 20, 1, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (105, 'topmenu', 'Khoa học công nghệ', 'khoa-hoc-cong-nghe', 'index.php?option=com_content&view=category&layout=blog&id=32', 'component', 1, 63, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (106, 'topmenu', 'Môi trường', 'moi-truong', 'index.php?option=com_content&view=category&layout=blog&id=33', 'component', 1, 63, 20, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (107, 'topmenu', 'Sức khỏe giới tính', 'suc-khoe-gioi-tinh', 'index.php?option=com_content&view=category&layout=blog&id=34', 'component', 1, 63, 20, 1, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (108, 'topmenu', 'Khám phá', 'kham-pha', 'index.php?option=com_content&view=category&layout=blog&id=35', 'component', 1, 63, 20, 1, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (109, 'topmenu', 'Hỏi và đáp', 'hoi-va-dap', 'index.php?option=com_content&view=category&layout=blog&id=36', 'component', 1, 63, 20, 1, 5, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (110, 'topmenu', 'Gương sáng doanh nghiệp', 'guong-sang-doanh-nghiep', 'index.php?option=com_content&view=category&layout=blog&id=45', 'component', 1, 64, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (111, 'topmenu', 'Chuyện kinh doanh', 'chuyen-kinh-doanh', 'index.php?option=com_content&view=category&layout=blog&id=46', 'component', 1, 64, 20, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (112, 'topmenu', 'Chân dung doanh nhân', 'chan-dung-doanh-nhan', 'index.php?option=com_content&view=category&layout=blog&id=47', 'component', 1, 64, 20, 1, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (113, 'topmenu', 'Kinh tế - Đầu tư', 'kinh-te-dau-tu', 'index.php?option=com_content&view=category&layout=blog&id=50', 'component', 1, 65, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (114, 'topmenu', 'Xuất nhập khẩu', 'xuat-nhap-khau', 'index.php?option=com_content&view=category&layout=blog&id=49', 'component', 1, 65, 20, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES (115, 'topmenu', 'Hợp tác', 'hop-tac', 'index.php?option=com_content&view=category&layout=blog&id=48', 'component', 1, 65, 20, 1, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=\nmulti_column_order=0\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_menu_types`
-- 

CREATE TABLE `jos_menu_types` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `menutype` varchar(75) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `menutype` (`menutype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `jos_menu_types`
-- 

INSERT INTO `jos_menu_types` VALUES (1, 'mainmenu', 'Main Menu', 'The main menu for the site');
INSERT INTO `jos_menu_types` VALUES (2, 'usermenu', 'User Menu', 'A Menu for logged in Users');
INSERT INTO `jos_menu_types` VALUES (3, 'topmenu', 'Top Menu', 'Top level navigation');
INSERT INTO `jos_menu_types` VALUES (4, 'othermenu', 'Resources', 'Additional links');
INSERT INTO `jos_menu_types` VALUES (5, 'ExamplePages', 'Example Pages', 'Example Pages');
INSERT INTO `jos_menu_types` VALUES (6, 'keyconcepts', 'Key Concepts', 'This describes some critical information for new Users.');

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_messages`
-- 

CREATE TABLE `jos_messages` (
  `message_id` int(10) unsigned NOT NULL auto_increment,
  `user_id_from` int(10) unsigned NOT NULL default '0',
  `user_id_to` int(10) unsigned NOT NULL default '0',
  `folder_id` int(10) unsigned NOT NULL default '0',
  `date_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `state` int(11) NOT NULL default '0',
  `priority` int(1) unsigned NOT NULL default '0',
  `subject` text NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY  (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `jos_messages`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `jos_messages_cfg`
-- 

CREATE TABLE `jos_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL default '0',
  `cfg_name` varchar(100) NOT NULL default '',
  `cfg_value` varchar(255) NOT NULL default '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_messages_cfg`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `jos_migration_backlinks`
-- 

CREATE TABLE `jos_migration_backlinks` (
  `itemid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `sefurl` text NOT NULL,
  `newurl` text NOT NULL,
  PRIMARY KEY  (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_migration_backlinks`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `jos_modules`
-- 

CREATE TABLE `jos_modules` (
  `id` int(11) NOT NULL auto_increment,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL default '0',
  `position` varchar(50) default NULL,
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL default '0',
  `module` varchar(50) default NULL,
  `numnews` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `showtitle` tinyint(3) unsigned NOT NULL default '1',
  `params` text NOT NULL,
  `iscore` tinyint(4) NOT NULL default '0',
  `client_id` tinyint(4) NOT NULL default '0',
  `control` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

-- 
-- Dumping data for table `jos_modules`
-- 

INSERT INTO `jos_modules` VALUES (1, 'Main Menu', '', 1, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 1, 'menutype=mainmenu\nmoduleclass_sfx=_menu\n', 1, 0, '');
INSERT INTO `jos_modules` VALUES (2, 'Login', '', 1, 'login', 0, '0000-00-00 00:00:00', 1, 'mod_login', 0, 0, 1, '', 1, 1, '');
INSERT INTO `jos_modules` VALUES (3, 'Popular', '', 3, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_popular', 0, 2, 1, '', 0, 1, '');
INSERT INTO `jos_modules` VALUES (4, 'Recent added Articles', '', 4, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_latest', 0, 2, 1, 'ordering=c_dsc\nuser_id=0\ncache=0\n\n', 0, 1, '');
INSERT INTO `jos_modules` VALUES (5, 'Menu Stats', '', 5, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_stats', 0, 2, 1, '', 0, 1, '');
INSERT INTO `jos_modules` VALUES (6, 'Unread Messages', '', 1, 'header', 0, '0000-00-00 00:00:00', 1, 'mod_unread', 0, 2, 1, '', 1, 1, '');
INSERT INTO `jos_modules` VALUES (7, 'Online Users', '', 2, 'header', 0, '0000-00-00 00:00:00', 1, 'mod_online', 0, 2, 1, '', 1, 1, '');
INSERT INTO `jos_modules` VALUES (8, 'Toolbar', '', 1, 'toolbar', 0, '0000-00-00 00:00:00', 1, 'mod_toolbar', 0, 2, 1, '', 1, 1, '');
INSERT INTO `jos_modules` VALUES (9, 'Quick Icons', '', 1, 'icon', 0, '0000-00-00 00:00:00', 1, 'mod_quickicon', 0, 2, 1, '', 1, 1, '');
INSERT INTO `jos_modules` VALUES (10, 'Logged in Users', '', 2, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_logged', 0, 2, 1, '', 0, 1, '');
INSERT INTO `jos_modules` VALUES (11, 'Footer', '', 0, 'footer', 0, '0000-00-00 00:00:00', 1, 'mod_footer', 0, 0, 1, '', 1, 1, '');
INSERT INTO `jos_modules` VALUES (12, 'Admin Menu', '', 1, 'menu', 0, '0000-00-00 00:00:00', 1, 'mod_menu', 0, 2, 1, '', 0, 1, '');
INSERT INTO `jos_modules` VALUES (13, 'Admin SubMenu', '', 1, 'submenu', 0, '0000-00-00 00:00:00', 1, 'mod_submenu', 0, 2, 1, '', 0, 1, '');
INSERT INTO `jos_modules` VALUES (14, 'User Status', '', 1, 'status', 0, '0000-00-00 00:00:00', 1, 'mod_status', 0, 2, 1, '', 0, 1, '');
INSERT INTO `jos_modules` VALUES (15, 'Title', '', 1, 'title', 0, '0000-00-00 00:00:00', 1, 'mod_title', 0, 2, 1, '', 0, 1, '');
INSERT INTO `jos_modules` VALUES (16, 'Polls', '', 1, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_poll', 0, 0, 1, 'id=14\ncache=1', 0, 0, '');
INSERT INTO `jos_modules` VALUES (17, 'User Menu', '', 4, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 1, 1, 'menutype=usermenu\nmoduleclass_sfx=_menu\ncache=1', 1, 0, '');
INSERT INTO `jos_modules` VALUES (18, 'Login Form', '', 8, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_login', 0, 0, 1, 'greeting=1\nname=0', 1, 0, '');
INSERT INTO `jos_modules` VALUES (19, 'Latest News', '', 4, 'user1', 0, '0000-00-00 00:00:00', 1, 'mod_latestnews', 0, 0, 1, 'cache=1', 1, 0, '');
INSERT INTO `jos_modules` VALUES (20, 'Statistics', '', 6, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_stats', 0, 0, 1, 'serverinfo=1\nsiteinfo=1\ncounter=1\nincrease=0\nmoduleclass_sfx=', 0, 0, '');
INSERT INTO `jos_modules` VALUES (21, 'Who''s Online', '', 1, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_whosonline', 0, 0, 1, 'online=1\nusers=1\nmoduleclass_sfx=', 0, 0, '');
INSERT INTO `jos_modules` VALUES (22, 'Popular', '', 6, 'user2', 0, '0000-00-00 00:00:00', 1, 'mod_mostread', 0, 0, 1, 'cache=1', 0, 0, '');
INSERT INTO `jos_modules` VALUES (23, 'Archive', '', 9, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_archive', 0, 0, 1, 'cache=1', 1, 0, '');
INSERT INTO `jos_modules` VALUES (24, 'Sections', '', 10, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_sections', 0, 0, 1, 'cache=1', 1, 0, '');
INSERT INTO `jos_modules` VALUES (25, 'Newsflash', '', 1, 'top', 0, '0000-00-00 00:00:00', 1, 'mod_newsflash', 0, 0, 1, 'catid=3\r\nstyle=random\r\nitems=\r\nmoduleclass_sfx=', 0, 0, '');
INSERT INTO `jos_modules` VALUES (26, 'Related Items', '', 11, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_related_items', 0, 0, 1, '', 0, 0, '');
INSERT INTO `jos_modules` VALUES (27, 'Search', '', 1, 'user4', 0, '0000-00-00 00:00:00', 1, 'mod_search', 0, 0, 0, 'cache=1', 0, 0, '');
INSERT INTO `jos_modules` VALUES (28, 'Random Image', '', 9, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_random_image', 0, 0, 1, '', 0, 0, '');
INSERT INTO `jos_modules` VALUES (29, 'Top Menu', '', 0, 'news-topmenu', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 0, 'menutype=topmenu\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=1\ntag_id=\nclass_sfx=-nav\nmoduleclass_sfx=subnav\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=1\nactivate_parent=1\nfull_active_id=0\nindent_image=0\nindent_image1=-1\nindent_image2=-1\nindent_image3=-1\nindent_image4=-1\nindent_image5=-1\nindent_image6=-1\nspacer=\nend_spacer=\n\n', 1, 0, '');
INSERT INTO `jos_modules` VALUES (30, 'Banners', '', 1, 'footer', 0, '0000-00-00 00:00:00', 1, 'mod_banners', 0, 0, 0, 'target=1\ncount=1\ncid=1\ncatid=33\ntag_search=0\nordering=random\nheader_text=\nfooter_text=\nmoduleclass_sfx=\ncache=1\ncache_time=15\n\n', 1, 0, '');
INSERT INTO `jos_modules` VALUES (31, 'Resources', '', 2, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 1, 'menutype=othermenu\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=1\ntag_id=\nclass_sfx=\nmoduleclass_sfx=_menu\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n', 0, 0, '');
INSERT INTO `jos_modules` VALUES (32, 'Wrapper', '', 12, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_wrapper', 0, 0, 1, '', 0, 0, '');
INSERT INTO `jos_modules` VALUES (33, 'Footer', '', 2, 'footer', 0, '0000-00-00 00:00:00', 1, 'mod_footer', 0, 0, 0, 'cache=1\n\n', 1, 0, '');
INSERT INTO `jos_modules` VALUES (34, 'Feed Display', '', 13, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_feed', 0, 0, 1, '', 1, 0, '');
INSERT INTO `jos_modules` VALUES (35, 'Breadcrumbs', '', 1, 'breadcrumb', 0, '0000-00-00 00:00:00', 1, 'mod_breadcrumbs', 0, 0, 1, 'moduleclass_sfx=\ncache=0\nshowHome=1\nhomeText=Home\nshowComponent=1\nseparator=\n\n', 1, 0, '');
INSERT INTO `jos_modules` VALUES (36, 'Syndication', '', 3, 'syndicate', 0, '0000-00-00 00:00:00', 1, 'mod_syndicate', 0, 0, 0, '', 1, 0, '');
INSERT INTO `jos_modules` VALUES (38, 'Advertisement', '', 3, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_banners', 0, 0, 1, 'count=4\r\nrandomise=0\r\ncid=0\r\ncatid=14\r\nheader_text=Featured Links:\r\nfooter_text=<a href="http://www.joomla.org">Ads by Joomla!</a>\r\nmoduleclass_sfx=_text\r\ncache=0\r\n\r\n', 0, 0, '');
INSERT INTO `jos_modules` VALUES (39, 'Example Pages', '', 5, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 1, 'cache=1\nclass_sfx=\nmoduleclass_sfx=_menu\nmenutype=ExamplePages\nmenu_style=list_flat\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nfull_active_id=0\nmenu_images=0\nmenu_images_align=0\nexpand_menu=0\nactivate_parent=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\nwindow_open=\n\n', 0, 0, '');
INSERT INTO `jos_modules` VALUES (40, 'Key Concepts', '', 3, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 1, 'cache=1\nclass_sfx=\nmoduleclass_sfx=_menu\nmenutype=keyconcepts\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nfull_active_id=0\nmenu_images=0\nmenu_images_align=0\nexpand_menu=0\nactivate_parent=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\nwindow_open=\n\n', 0, 0, '');
INSERT INTO `jos_modules` VALUES (41, 'Welcome to Joomla!', '<div style="padding: 5px">  <p>   Congratulations on choosing Joomla! as your content management system. To   help you get started, check out these excellent resources for securing your   server and pointers to documentation and other helpful resources. </p> <p>   <strong>Security</strong><br /> </p> <p>   On the Internet, security is always a concern. For that reason, you are   encouraged to subscribe to the   <a href="http://feedburner.google.com/fb/a/mailverify?uri=JoomlaSecurityNews" target="_blank">Joomla!   Security Announcements</a> for the latest information on new Joomla! releases,   emailed to you automatically. </p> <p>   If this is one of your first Web sites, security considerations may   seem complicated and intimidating. There are three simple steps that go a long   way towards securing a Web site: (1) regular backups; (2) prompt updates to the   <a href="http://www.joomla.org/download.html" target="_blank">latest Joomla! release;</a> and (3) a <a href="http://docs.joomla.org/Security_Checklist_2_-_Hosting_and_Server_Setup" target="_blank" title="good Web host">good Web host</a>. There are many other important security considerations that you can learn about by reading the <a href="http://docs.joomla.org/Category:Security_Checklist" target="_blank" title="Joomla! Security Checklist">Joomla! Security Checklist</a>. </p> <p>If you believe your Web site was attacked, or you think you have discovered a security issue in Joomla!, please do not post it in the Joomla! forums. Publishing this information could put other Web sites at risk. Instead, report possible security vulnerabilities to the <a href="http://developer.joomla.org/security/contact-the-team.html" target="_blank" title="Joomla! Security Task Force">Joomla! Security Task Force</a>.</p><p><strong>Learning Joomla!</strong> </p> <p>   A good place to start learning Joomla! is the   "<a href="http://docs.joomla.org/beginners" target="_blank">Absolute Beginner''s   Guide to Joomla!.</a>" There, you will find a Quick Start to Joomla!   <a href="http://help.joomla.org/ghop/feb2008/task048/joomla_15_quickstart.pdf" target="_blank">guide</a>   and <a href="http://help.joomla.org/ghop/feb2008/task167/index.html" target="_blank">video</a>,   amongst many other tutorials. The   <a href="http://community.joomla.org/magazine/view-all-issues.html" target="_blank">Joomla!   Community Magazine</a> also has   <a href="http://community.joomla.org/magazine/article/522-introductory-learning-joomla-using-sample-data.html" target="_blank">articles   for new learners</a> and experienced users, alike. A great place to look for   answers is the   <a href="http://docs.joomla.org/Category:FAQ" target="_blank">Frequently Asked   Questions (FAQ)</a>. If you are stuck on a particular screen in the   Administrator (which is where you are now), try clicking the Help toolbar   button to get assistance specific to that page. </p> <p>   If you still have questions, please feel free to use the   <a href="http://forum.joomla.org/" target="_blank">Joomla! Forums.</a> The forums   are an incredibly valuable resource for all levels of Joomla! users. Before   you post a question, though, use the forum search (located at the top of each   forum page) to see if the question has been asked and answered. </p> <p>   <strong>Getting Involved</strong> </p> <p>   <a name="twjs" title="twjs"></a> If you want to help make Joomla! better, consider getting   involved. There are   <a href="http://www.joomla.org/about-joomla/contribute-to-joomla.html" target="_blank">many ways   you can make a positive difference.</a> Have fun using Joomla!.</p></div>', 0, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 2, 1, 'moduleclass_sfx=\n\n', 1, 1, '');
INSERT INTO `jos_modules` VALUES (42, 'Joomla! Security Newsfeed', '', 6, 'cpanel', 62, '2008-10-25 20:15:17', 1, 'mod_feed', 0, 0, 1, 'cache=1\ncache_time=15\nmoduleclass_sfx=\nrssurl=http://feeds.joomla.org/JoomlaSecurityNews\nrssrtl=0\nrsstitle=1\nrssdesc=0\nrssimage=1\nrssitems=1\nrssitemdesc=1\nword_count=0\n\n', 0, 1, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_modules_menu`
-- 

CREATE TABLE `jos_modules_menu` (
  `moduleid` int(11) NOT NULL default '0',
  `menuid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`moduleid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_modules_menu`
-- 

INSERT INTO `jos_modules_menu` VALUES (1, 0);
INSERT INTO `jos_modules_menu` VALUES (16, 1);
INSERT INTO `jos_modules_menu` VALUES (17, 0);
INSERT INTO `jos_modules_menu` VALUES (18, 1);
INSERT INTO `jos_modules_menu` VALUES (19, 1);
INSERT INTO `jos_modules_menu` VALUES (19, 2);
INSERT INTO `jos_modules_menu` VALUES (19, 4);
INSERT INTO `jos_modules_menu` VALUES (19, 27);
INSERT INTO `jos_modules_menu` VALUES (19, 36);
INSERT INTO `jos_modules_menu` VALUES (21, 1);
INSERT INTO `jos_modules_menu` VALUES (22, 1);
INSERT INTO `jos_modules_menu` VALUES (22, 2);
INSERT INTO `jos_modules_menu` VALUES (22, 4);
INSERT INTO `jos_modules_menu` VALUES (22, 27);
INSERT INTO `jos_modules_menu` VALUES (22, 36);
INSERT INTO `jos_modules_menu` VALUES (25, 0);
INSERT INTO `jos_modules_menu` VALUES (27, 0);
INSERT INTO `jos_modules_menu` VALUES (29, 0);
INSERT INTO `jos_modules_menu` VALUES (30, 0);
INSERT INTO `jos_modules_menu` VALUES (31, 1);
INSERT INTO `jos_modules_menu` VALUES (32, 0);
INSERT INTO `jos_modules_menu` VALUES (33, 0);
INSERT INTO `jos_modules_menu` VALUES (34, 0);
INSERT INTO `jos_modules_menu` VALUES (35, 0);
INSERT INTO `jos_modules_menu` VALUES (36, 0);
INSERT INTO `jos_modules_menu` VALUES (38, 1);
INSERT INTO `jos_modules_menu` VALUES (39, 43);
INSERT INTO `jos_modules_menu` VALUES (39, 44);
INSERT INTO `jos_modules_menu` VALUES (39, 45);
INSERT INTO `jos_modules_menu` VALUES (39, 46);
INSERT INTO `jos_modules_menu` VALUES (39, 47);
INSERT INTO `jos_modules_menu` VALUES (40, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_newsfeeds`
-- 

CREATE TABLE `jos_newsfeeds` (
  `catid` int(11) NOT NULL default '0',
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `alias` varchar(255) NOT NULL default '',
  `link` text NOT NULL,
  `filename` varchar(200) default NULL,
  `published` tinyint(1) NOT NULL default '0',
  `numarticles` int(11) unsigned NOT NULL default '1',
  `cache_time` int(11) unsigned NOT NULL default '3600',
  `checked_out` tinyint(3) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `rtl` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `published` (`published`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- 
-- Dumping data for table `jos_newsfeeds`
-- 

INSERT INTO `jos_newsfeeds` VALUES (4, 1, 'Joomla! Announcements', 'joomla-official-news', 'http://feeds.joomla.org/JoomlaAnnouncements', '', 1, 5, 3600, 0, '0000-00-00 00:00:00', 1, 0);
INSERT INTO `jos_newsfeeds` VALUES (4, 2, 'Joomla! Core Team Blog', 'joomla-core-team-blog', 'http://feeds.joomla.org/JoomlaCommunityCoreTeamBlog', '', 1, 5, 3600, 0, '0000-00-00 00:00:00', 2, 0);
INSERT INTO `jos_newsfeeds` VALUES (4, 3, 'Joomla! Community Magazine', 'joomla-community-magazine', 'http://feeds.joomla.org/JoomlaMagazine', '', 1, 20, 3600, 0, '0000-00-00 00:00:00', 3, 0);
INSERT INTO `jos_newsfeeds` VALUES (4, 4, 'Joomla! Developer News', 'joomla-developer-news', 'http://feeds.joomla.org/JoomlaDeveloper', '', 1, 5, 3600, 0, '0000-00-00 00:00:00', 4, 0);
INSERT INTO `jos_newsfeeds` VALUES (4, 5, 'Joomla! Security News', 'joomla-security-news', 'http://feeds.joomla.org/JoomlaSecurityNews', '', 1, 5, 3600, 0, '0000-00-00 00:00:00', 5, 0);
INSERT INTO `jos_newsfeeds` VALUES (5, 6, 'Free Software Foundation Blogs', 'free-software-foundation-blogs', 'http://www.fsf.org/blogs/RSS', NULL, 1, 5, 3600, 0, '0000-00-00 00:00:00', 4, 0);
INSERT INTO `jos_newsfeeds` VALUES (5, 7, 'Free Software Foundation', 'free-software-foundation', 'http://www.fsf.org/news/RSS', NULL, 1, 5, 3600, 62, '2008-09-14 00:24:25', 3, 0);
INSERT INTO `jos_newsfeeds` VALUES (5, 8, 'Software Freedom Law Center Blog', 'software-freedom-law-center-blog', 'http://www.softwarefreedom.org/feeds/blog/', NULL, 1, 5, 3600, 0, '0000-00-00 00:00:00', 2, 0);
INSERT INTO `jos_newsfeeds` VALUES (5, 9, 'Software Freedom Law Center News', 'software-freedom-law-center', 'http://www.softwarefreedom.org/feeds/news/', NULL, 1, 5, 3600, 0, '0000-00-00 00:00:00', 1, 0);
INSERT INTO `jos_newsfeeds` VALUES (5, 10, 'Open Source Initiative Blog', 'open-source-initiative-blog', 'http://www.opensource.org/blog/feed', NULL, 1, 5, 3600, 0, '0000-00-00 00:00:00', 5, 0);
INSERT INTO `jos_newsfeeds` VALUES (6, 11, 'PHP News and Announcements', 'php-news-and-announcements', 'http://www.php.net/feed.atom', NULL, 1, 5, 3600, 62, '2008-09-14 00:25:37', 1, 0);
INSERT INTO `jos_newsfeeds` VALUES (6, 12, 'Planet MySQL', 'planet-mysql', 'http://www.planetmysql.org/rss20.xml', NULL, 1, 5, 3600, 62, '2008-09-14 00:25:51', 2, 0);
INSERT INTO `jos_newsfeeds` VALUES (6, 13, 'Linux Foundation Announcements', 'linux-foundation-announcements', 'http://www.linuxfoundation.org/press/rss20.xml', NULL, 1, 5, 3600, 62, '2008-09-14 00:26:11', 3, 0);
INSERT INTO `jos_newsfeeds` VALUES (6, 14, 'Mootools Blog', 'mootools-blog', 'http://feeds.feedburner.com/mootools-blog', NULL, 1, 5, 3600, 62, '2008-09-14 00:26:51', 4, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_plugins`
-- 

CREATE TABLE `jos_plugins` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `element` varchar(100) NOT NULL default '',
  `folder` varchar(100) NOT NULL default '',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `published` tinyint(3) NOT NULL default '0',
  `iscore` tinyint(3) NOT NULL default '0',
  `client_id` tinyint(3) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_folder` (`published`,`client_id`,`access`,`folder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

-- 
-- Dumping data for table `jos_plugins`
-- 

INSERT INTO `jos_plugins` VALUES (1, 'Authentication - Joomla', 'joomla', 'authentication', 0, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (2, 'Authentication - LDAP', 'ldap', 'authentication', 0, 2, 0, 1, 0, 0, '0000-00-00 00:00:00', 'host=\nport=389\nuse_ldapV3=0\nnegotiate_tls=0\nno_referrals=0\nauth_method=bind\nbase_dn=\nsearch_string=\nusers_dn=\nusername=\npassword=\nldap_fullname=fullName\nldap_email=mail\nldap_uid=uid\n\n');
INSERT INTO `jos_plugins` VALUES (3, 'Authentication - GMail', 'gmail', 'authentication', 0, 4, 0, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (4, 'Authentication - OpenID', 'openid', 'authentication', 0, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (5, 'User - Joomla!', 'joomla', 'user', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', 'autoregister=1\n\n');
INSERT INTO `jos_plugins` VALUES (6, 'Search - Content', 'content', 'search', 0, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\nsearch_content=1\nsearch_uncategorised=1\nsearch_archived=1\n\n');
INSERT INTO `jos_plugins` VALUES (7, 'Search - Contacts', 'contacts', 'search', 0, 3, 1, 1, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n');
INSERT INTO `jos_plugins` VALUES (8, 'Search - Categories', 'categories', 'search', 0, 4, 1, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n');
INSERT INTO `jos_plugins` VALUES (9, 'Search - Sections', 'sections', 'search', 0, 5, 1, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n');
INSERT INTO `jos_plugins` VALUES (10, 'Search - Newsfeeds', 'newsfeeds', 'search', 0, 6, 1, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n');
INSERT INTO `jos_plugins` VALUES (11, 'Search - Weblinks', 'weblinks', 'search', 0, 2, 1, 1, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n');
INSERT INTO `jos_plugins` VALUES (12, 'Content - Pagebreak', 'pagebreak', 'content', 0, 10000, 1, 1, 0, 0, '0000-00-00 00:00:00', 'enabled=1\ntitle=1\nmultipage_toc=1\nshowall=1\n\n');
INSERT INTO `jos_plugins` VALUES (13, 'Content - Rating', 'vote', 'content', 0, 4, 1, 1, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (14, 'Content - Email Cloaking', 'emailcloak', 'content', 0, 5, 1, 0, 0, 0, '0000-00-00 00:00:00', 'mode=1\n\n');
INSERT INTO `jos_plugins` VALUES (15, 'Content - Code Hightlighter (GeSHi)', 'geshi', 'content', 0, 5, 0, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (16, 'Content - Load Module', 'loadmodule', 'content', 0, 6, 1, 0, 0, 0, '0000-00-00 00:00:00', 'enabled=1\nstyle=0\n\n');
INSERT INTO `jos_plugins` VALUES (17, 'Content - Page Navigation', 'pagenavigation', 'content', 0, 2, 1, 1, 0, 0, '0000-00-00 00:00:00', 'position=1\n\n');
INSERT INTO `jos_plugins` VALUES (18, 'Editor - No Editor', 'none', 'editors', 0, 0, 1, 1, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (19, 'Editor - TinyMCE', 'tinymce', 'editors', 0, 0, 1, 1, 0, 0, '0000-00-00 00:00:00', 'mode=advanced\nskin=0\ncompressed=0\ncleanup_startup=0\ncleanup_save=2\nentity_encoding=raw\nlang_mode=0\nlang_code=en\ntext_direction=ltr\ncontent_css=1\ncontent_css_custom=\nrelative_urls=1\nnewlines=0\ninvalid_elements=applet\nextended_elements=\ntoolbar=top\ntoolbar_align=left\nhtml_height=550\nhtml_width=750\nelement_path=1\nfonts=1\npaste=1\nsearchreplace=1\ninsertdate=1\nformat_date=%Y-%m-%d\ninserttime=1\nformat_time=%H:%M:%S\ncolors=1\ntable=1\nsmilies=1\nmedia=1\nhr=1\ndirectionality=1\nfullscreen=1\nstyle=1\nlayer=1\nxhtmlxtras=1\nvisualchars=1\nnonbreaking=1\ntemplate=0\nadvimage=1\nadvlink=1\nautosave=1\ncontextmenu=1\ninlinepopups=1\nsafari=1\ncustom_plugin=\ncustom_button=\n\n');
INSERT INTO `jos_plugins` VALUES (20, 'Editor - XStandard Lite 2.0', 'xstandard', 'editors', 0, 0, 0, 1, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (21, 'Editor Button - Image', 'image', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (22, 'Editor Button - Pagebreak', 'pagebreak', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (23, 'Editor Button - Readmore', 'readmore', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (24, 'XML-RPC - Joomla', 'joomla', 'xmlrpc', 0, 7, 0, 1, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (25, 'XML-RPC - Blogger API', 'blogger', 'xmlrpc', 0, 7, 0, 1, 0, 0, '0000-00-00 00:00:00', 'catid=1\nsectionid=0\n\n');
INSERT INTO `jos_plugins` VALUES (27, 'System - SEF', 'sef', 'system', 0, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (28, 'System - Debug', 'debug', 'system', 0, 2, 1, 0, 0, 0, '0000-00-00 00:00:00', 'queries=1\nmemory=1\nlangauge=1\n\n');
INSERT INTO `jos_plugins` VALUES (29, 'System - Legacy', 'legacy', 'system', 0, 3, 0, 1, 0, 0, '0000-00-00 00:00:00', 'route=0\n\n');
INSERT INTO `jos_plugins` VALUES (30, 'System - Cache', 'cache', 'system', 0, 4, 0, 1, 0, 0, '0000-00-00 00:00:00', 'browsercache=0\ncachetime=15\n\n');
INSERT INTO `jos_plugins` VALUES (31, 'System - Log', 'log', 'system', 0, 5, 0, 1, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (32, 'System - Remember Me', 'remember', 'system', 0, 6, 1, 1, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (33, 'System - Backlink', 'backlink', 'system', 0, 7, 0, 1, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (34, 'System - Mootools Upgrade', 'mtupgrade', 'system', 0, 8, 0, 1, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (35, 'Editor - JCE', 'jce', 'editors', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (36, 'Content - Attachments', 'attachments', 'content', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (37, 'System - Show attachments in editor', 'show_attachments', 'system', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (38, 'Attachments - For Components Plugin Framework', 'attachments_plugin_framework', 'attachments', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (39, 'Attachments - For Content', 'attachments_for_content', 'attachments', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (40, 'Editor Button - Add Attachment', 'add_attachment', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (41, 'Editor Button - Insert Attachments Token', 'insert_attachments_token', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES (42, 'Search - Attachments', 'attachments', 'search', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n');

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_polls`
-- 

CREATE TABLE `jos_polls` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `voters` int(9) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL default '0',
  `access` int(11) NOT NULL default '0',
  `lag` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- 
-- Dumping data for table `jos_polls`
-- 

INSERT INTO `jos_polls` VALUES (14, 'Joomla! is used for?', 'joomla-is-used-for', 11, 0, '0000-00-00 00:00:00', 1, 0, 86400);

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_poll_data`
-- 

CREATE TABLE `jos_poll_data` (
  `id` int(11) NOT NULL auto_increment,
  `pollid` int(11) NOT NULL default '0',
  `text` text NOT NULL,
  `hits` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `pollid` (`pollid`,`text`(1))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `jos_poll_data`
-- 

INSERT INTO `jos_poll_data` VALUES (1, 14, 'Community Sites', 2);
INSERT INTO `jos_poll_data` VALUES (2, 14, 'Public Brand Sites', 3);
INSERT INTO `jos_poll_data` VALUES (3, 14, 'eCommerce', 1);
INSERT INTO `jos_poll_data` VALUES (4, 14, 'Blogs', 0);
INSERT INTO `jos_poll_data` VALUES (5, 14, 'Intranets', 0);
INSERT INTO `jos_poll_data` VALUES (6, 14, 'Photo and Media Sites', 2);
INSERT INTO `jos_poll_data` VALUES (7, 14, 'All of the Above!', 3);
INSERT INTO `jos_poll_data` VALUES (8, 14, '', 0);
INSERT INTO `jos_poll_data` VALUES (9, 14, '', 0);
INSERT INTO `jos_poll_data` VALUES (10, 14, '', 0);
INSERT INTO `jos_poll_data` VALUES (11, 14, '', 0);
INSERT INTO `jos_poll_data` VALUES (12, 14, '', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_poll_date`
-- 

CREATE TABLE `jos_poll_date` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `vote_id` int(11) NOT NULL default '0',
  `poll_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `poll_id` (`poll_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `jos_poll_date`
-- 

INSERT INTO `jos_poll_date` VALUES (1, '2006-10-09 13:01:58', 1, 14);
INSERT INTO `jos_poll_date` VALUES (2, '2006-10-10 15:19:43', 7, 14);
INSERT INTO `jos_poll_date` VALUES (3, '2006-10-11 11:08:16', 7, 14);
INSERT INTO `jos_poll_date` VALUES (4, '2006-10-11 15:02:26', 2, 14);
INSERT INTO `jos_poll_date` VALUES (5, '2006-10-11 15:43:03', 7, 14);
INSERT INTO `jos_poll_date` VALUES (6, '2006-10-11 15:43:38', 7, 14);
INSERT INTO `jos_poll_date` VALUES (7, '2006-10-12 00:51:13', 2, 14);
INSERT INTO `jos_poll_date` VALUES (8, '2007-05-10 19:12:29', 3, 14);
INSERT INTO `jos_poll_date` VALUES (9, '2007-05-14 14:18:00', 6, 14);
INSERT INTO `jos_poll_date` VALUES (10, '2007-06-10 15:20:29', 6, 14);
INSERT INTO `jos_poll_date` VALUES (11, '2007-07-03 12:37:53', 2, 14);

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_poll_menu`
-- 

CREATE TABLE `jos_poll_menu` (
  `pollid` int(11) NOT NULL default '0',
  `menuid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`pollid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_poll_menu`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `jos_sections`
-- 

CREATE TABLE `jos_sections` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `image` text NOT NULL,
  `scope` varchar(50) NOT NULL default '',
  `image_position` varchar(30) NOT NULL default '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `count` int(11) NOT NULL default '0',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_scope` (`scope`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `jos_sections`
-- 

INSERT INTO `jos_sections` VALUES (1, 'Xã hội', '', 'xa-hoi', '', 'content', 'left', '', 1, 0, '0000-00-00 00:00:00', 1, 0, 6, '');
INSERT INTO `jos_sections` VALUES (2, 'Giáo dục', '', 'giao-duc', '', 'content', 'left', '', 1, 0, '0000-00-00 00:00:00', 2, 0, 4, '');
INSERT INTO `jos_sections` VALUES (3, 'Chính trị', '', 'chinh-tri', '', 'content', 'left', '', 1, 0, '0000-00-00 00:00:00', 3, 0, 2, '');
INSERT INTO `jos_sections` VALUES (4, 'Văn hóa', '', 'van-hoa', '', 'content', 'left', '', 1, 0, '0000-00-00 00:00:00', 4, 0, 4, '');
INSERT INTO `jos_sections` VALUES (5, 'Khoa học', '', 'khoa-hoc', '', 'content', 'left', '', 1, 0, '0000-00-00 00:00:00', 5, 0, 5, '');
INSERT INTO `jos_sections` VALUES (6, 'Công nghệ số', '', 'cong-nghe-so', '', 'content', 'left', '', 1, 0, '0000-00-00 00:00:00', 6, 0, 6, '');
INSERT INTO `jos_sections` VALUES (7, 'Thể thao', '', 'the-thao', '', 'content', 'left', '', 1, 0, '0000-00-00 00:00:00', 7, 0, 8, '');
INSERT INTO `jos_sections` VALUES (8, 'Tuổi trẻ', '', 'tuoi-tre', '', 'content', 'left', '', 1, 0, '0000-00-00 00:00:00', 8, 0, 4, '');
INSERT INTO `jos_sections` VALUES (9, 'Quốc tế', '', 'quoc-te', '', 'content', 'left', '', 1, 0, '0000-00-00 00:00:00', 9, 0, 3, '');
INSERT INTO `jos_sections` VALUES (10, 'Thị trường', '', 'thi-truong', '', 'content', 'left', '', 1, 0, '0000-00-00 00:00:00', 10, 0, 4, '');
INSERT INTO `jos_sections` VALUES (11, 'Doanh nhân - Doanh nghiệp', '', 'doanh-nhan-doanh-nghiep', '', 'content', 'left', '', 1, 0, '0000-00-00 00:00:00', 11, 0, 3, '');
INSERT INTO `jos_sections` VALUES (12, 'Kinh doanh', '', 'kinh-doanh', '', 'content', 'left', '', 1, 0, '0000-00-00 00:00:00', 12, 0, 3, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_session`
-- 

CREATE TABLE `jos_session` (
  `username` varchar(150) default '',
  `time` varchar(14) default '',
  `session_id` varchar(200) NOT NULL default '0',
  `guest` tinyint(4) default '1',
  `userid` int(11) default '0',
  `usertype` varchar(50) default '',
  `gid` tinyint(3) unsigned NOT NULL default '0',
  `client_id` tinyint(3) unsigned NOT NULL default '0',
  `data` longtext,
  PRIMARY KEY  (`session_id`(64)),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_session`
-- 

INSERT INTO `jos_session` VALUES ('kieuvanngoc', '1332232430', '0f9f179aacefea08e420d69a0b141edb', 0, 62, 'Super Administrator', 25, 1, '__default|a:8:{s:15:"session.counter";i:270;s:19:"session.timer.start";i:1332229903;s:18:"session.timer.last";i:1332232430;s:17:"session.timer.now";i:1332232430;s:22:"session.client.browser";s:65:"Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0";s:8:"registry";O:9:"JRegistry":3:{s:17:"_defaultNameSpace";s:7:"session";s:9:"_registry";a:6:{s:7:"session";a:1:{s:4:"data";O:8:"stdClass":0:{}}s:11:"application";a:1:{s:4:"data";O:8:"stdClass":1:{s:4:"lang";s:0:"";}}s:10:"com_cpanel";a:1:{s:4:"data";O:8:"stdClass":1:{s:9:"mtupgrade";O:8:"stdClass":1:{s:7:"checked";b:1;}}}s:14:"com_categories";a:1:{s:4:"data";O:8:"stdClass":5:{s:12:"filter_order";s:10:"c.ordering";s:16:"filter_order_Dir";s:0:"";s:11:"com_content";O:8:"stdClass":2:{s:12:"filter_state";s:0:"";s:9:"sectionid";s:1:"1";}s:6:"search";s:0:"";s:10:"limitstart";i:0;}}s:6:"global";a:1:{s:4:"data";O:8:"stdClass":1:{s:4:"list";O:8:"stdClass":1:{s:5:"limit";s:2:"20";}}}s:9:"com_menus";a:1:{s:4:"data";O:8:"stdClass":2:{s:8:"menutype";s:7:"topmenu";s:7:"topmenu";O:8:"stdClass":6:{s:12:"filter_order";s:10:"m.ordering";s:16:"filter_order_Dir";s:3:"ASC";s:12:"filter_state";s:0:"";s:10:"limitstart";s:2:"40";s:10:"levellimit";s:2:"10";s:6:"search";s:0:"";}}}}s:7:"_errors";a:0:{}}s:4:"user";O:5:"JUser":19:{s:2:"id";s:2:"62";s:4:"name";s:18:"Kiều Văn Ngọc";s:8:"username";s:11:"kieuvanngoc";s:5:"email";s:16:"ngockv@gmail.com";s:8:"password";s:65:"c59e3db1f46074b9f0ee95bdb9bbbcef:k1UiIErKajgJO4sEIwUa7wd6keP2bnSa";s:14:"password_clear";s:0:"";s:8:"usertype";s:19:"Super Administrator";s:5:"block";s:1:"0";s:9:"sendEmail";s:1:"1";s:3:"gid";s:2:"25";s:12:"registerDate";s:19:"2012-03-14 16:06:10";s:13:"lastvisitDate";s:19:"2012-03-20 06:09:52";s:10:"activation";s:0:"";s:6:"params";s:56:"admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=0\n\n";s:3:"aid";i:2;s:5:"guest";i:0;s:7:"_params";O:10:"JParameter":7:{s:4:"_raw";s:0:"";s:4:"_xml";N;s:9:"_elements";a:0:{}s:12:"_elementPath";a:1:{i:0;s:68:"D:\\AppServ\\www\\projects\\news\\libraries\\joomla\\html\\parameter\\element";}s:17:"_defaultNameSpace";s:8:"_default";s:9:"_registry";a:1:{s:8:"_default";a:1:{s:4:"data";O:8:"stdClass":5:{s:14:"admin_language";s:0:"";s:8:"language";s:0:"";s:6:"editor";s:0:"";s:8:"helpsite";s:0:"";s:8:"timezone";s:1:"0";}}}s:7:"_errors";a:0:{}}s:9:"_errorMsg";N;s:7:"_errors";a:0:{}}s:13:"session.token";s:32:"4f826b2d2d2adfa78a31548a495c6f1c";}__wf|a:1:{s:13:"session.token";s:32:"5b4e3c54c0589a6c128c157d11602791";}');
INSERT INTO `jos_session` VALUES ('', '1332232432', 'bd1fff6501d5f7bc6455cf1d1dd17d67', 1, 0, '', 0, 0, '__default|a:7:{s:15:"session.counter";i:4;s:19:"session.timer.start";i:1332232388;s:18:"session.timer.last";i:1332232432;s:17:"session.timer.now";i:1332232432;s:22:"session.client.browser";s:65:"Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0";s:8:"registry";O:9:"JRegistry":3:{s:17:"_defaultNameSpace";s:7:"session";s:9:"_registry";a:1:{s:7:"session";a:1:{s:4:"data";O:8:"stdClass":0:{}}}s:7:"_errors";a:0:{}}s:4:"user";O:5:"JUser":19:{s:2:"id";i:0;s:4:"name";N;s:8:"username";N;s:5:"email";N;s:8:"password";N;s:14:"password_clear";s:0:"";s:8:"usertype";N;s:5:"block";N;s:9:"sendEmail";i:0;s:3:"gid";i:0;s:12:"registerDate";N;s:13:"lastvisitDate";N;s:10:"activation";N;s:6:"params";N;s:3:"aid";i:0;s:5:"guest";i:1;s:7:"_params";O:10:"JParameter":7:{s:4:"_raw";s:0:"";s:4:"_xml";N;s:9:"_elements";a:0:{}s:12:"_elementPath";a:1:{i:0;s:68:"D:\\AppServ\\www\\projects\\news\\libraries\\joomla\\html\\parameter\\element";}s:17:"_defaultNameSpace";s:8:"_default";s:9:"_registry";a:1:{s:8:"_default";a:1:{s:4:"data";O:8:"stdClass":0:{}}}s:7:"_errors";a:0:{}}s:9:"_errorMsg";N;s:7:"_errors";a:0:{}}}');

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_stats_agents`
-- 

CREATE TABLE `jos_stats_agents` (
  `agent` varchar(255) NOT NULL default '',
  `type` tinyint(1) unsigned NOT NULL default '0',
  `hits` int(11) unsigned NOT NULL default '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_stats_agents`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `jos_templates_menu`
-- 

CREATE TABLE `jos_templates_menu` (
  `template` varchar(255) NOT NULL default '',
  `menuid` int(11) NOT NULL default '0',
  `client_id` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`menuid`,`client_id`,`template`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_templates_menu`
-- 

INSERT INTO `jos_templates_menu` VALUES ('newspaper', 0, 0);
INSERT INTO `jos_templates_menu` VALUES ('khepri', 0, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_users`
-- 

CREATE TABLE `jos_users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `username` varchar(150) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `password` varchar(100) NOT NULL default '',
  `usertype` varchar(25) NOT NULL default '',
  `block` tinyint(4) NOT NULL default '0',
  `sendEmail` tinyint(4) default '0',
  `gid` tinyint(3) unsigned NOT NULL default '1',
  `registerDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL default '',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`),
  KEY `gid_block` (`gid`,`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

-- 
-- Dumping data for table `jos_users`
-- 

INSERT INTO `jos_users` VALUES (62, 'Kiều Văn Ngọc', 'kieuvanngoc', 'ngockv@gmail.com', 'c59e3db1f46074b9f0ee95bdb9bbbcef:k1UiIErKajgJO4sEIwUa7wd6keP2bnSa', 'Super Administrator', 0, 1, 25, '2012-03-14 16:06:10', '2012-03-20 07:51:45', '', 'admin_language=\nlanguage=\neditor=\nhelpsite=\ntimezone=0\n\n');

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_weblinks`
-- 

CREATE TABLE `jos_weblinks` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `catid` int(11) NOT NULL default '0',
  `sid` int(11) NOT NULL default '0',
  `title` varchar(250) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `url` varchar(250) NOT NULL default '',
  `description` text NOT NULL,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `archived` tinyint(1) NOT NULL default '0',
  `approved` tinyint(1) NOT NULL default '1',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `catid` (`catid`,`published`,`archived`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `jos_weblinks`
-- 

INSERT INTO `jos_weblinks` VALUES (1, 2, 0, 'Joomla!', 'joomla', 'http://www.joomla.org', 'Home of Joomla!', '2005-02-14 15:19:02', 3, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 'target=0');
INSERT INTO `jos_weblinks` VALUES (2, 2, 0, 'php.net', 'php', 'http://www.php.net', 'The language that Joomla! is developed in', '2004-07-07 11:33:24', 6, 1, 0, '0000-00-00 00:00:00', 3, 0, 1, '');
INSERT INTO `jos_weblinks` VALUES (3, 2, 0, 'MySQL', 'mysql', 'http://www.mysql.com', 'The database that Joomla! uses', '2004-07-07 10:18:31', 1, 1, 0, '0000-00-00 00:00:00', 5, 0, 1, '');
INSERT INTO `jos_weblinks` VALUES (4, 2, 0, 'OpenSourceMatters', 'opensourcematters', 'http://www.opensourcematters.org', 'Home of OSM', '2005-02-14 15:19:02', 11, 1, 0, '0000-00-00 00:00:00', 2, 0, 1, 'target=0');
INSERT INTO `jos_weblinks` VALUES (5, 2, 0, 'Joomla! - Forums', 'joomla-forums', 'http://forum.joomla.org', 'Joomla! Forums', '2005-02-14 15:19:02', 4, 1, 0, '0000-00-00 00:00:00', 4, 0, 1, 'target=0');
INSERT INTO `jos_weblinks` VALUES (6, 2, 0, 'Ohloh Tracking of Joomla!', 'ohloh-tracking-of-joomla', 'http://www.ohloh.net/projects/20', 'Objective reports from Ohloh about Joomla''s development activity. Joomla! has some star developers with serious kudos.', '2007-07-19 09:28:31', 1, 1, 0, '0000-00-00 00:00:00', 6, 0, 1, 'target=0\n\n');

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_wf_profiles`
-- 

CREATE TABLE `jos_wf_profiles` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `users` text NOT NULL,
  `types` varchar(255) NOT NULL,
  `components` text NOT NULL,
  `area` tinyint(3) NOT NULL,
  `rows` text NOT NULL,
  `plugins` text NOT NULL,
  `published` tinyint(3) NOT NULL,
  `ordering` int(11) NOT NULL,
  `checked_out` tinyint(3) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `jos_wf_profiles`
-- 

INSERT INTO `jos_wf_profiles` VALUES (1, 'Default', 'Default Profile for all users', '', '19,20,21,23,24,25', '', 0, 'help,newdocument,undo,redo,spacer,bold,italic,underline,strikethrough,justifyfull,justifycenter,justifyleft,justifyright,spacer,blockquote,formatselect,styleselect,removeformat,cleanup;fontselect,fontsizeselect,forecolor,backcolor,spacer,paste,indent,outdent,numlist,bullist,sub,sup,textcase,charmap,hr;directionality,fullscreen,preview,source,print,searchreplace,spacer,table;visualaid,visualchars,nonbreaking,style,xhtmlxtras,anchor,unlink,link,imgmanager,spellchecker,article', 'contextmenu,browser,inlinepopups,media,help,paste,searchreplace,directionality,fullscreen,preview,source,table,textcase,print,style,nonbreaking,visualchars,xhtmlxtras,imgmanager,link,spellchecker,article', 1, 1, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_wf_profiles` VALUES (2, 'Front End', 'Sample Front-end Profile', '', '19,20,21', '', 1, 'help,newdocument,undo,redo,spacer,bold,italic,underline,strikethrough,justifyfull,justifycenter,justifyleft,justifyright,spacer,formatselect,styleselect;paste,searchreplace,indent,outdent,numlist,bullist,cleanup,charmap,removeformat,hr,sub,sup,textcase,nonbreaking,visualchars;fullscreen,preview,print,visualaid,style,xhtmlxtras,anchor,unlink,link,imgmanager,spellchecker,article', 'contextmenu,inlinepopups,help,paste,searchreplace,fullscreen,preview,print,style,textcase,nonbreaking,visualchars,xhtmlxtras,imgmanager,link,spellchecker,article', 0, 2, 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_xmap`
-- 

CREATE TABLE `jos_xmap` (
  `name` varchar(30) NOT NULL,
  `value` varchar(100) default NULL,
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_xmap`
-- 

INSERT INTO `jos_xmap` VALUES ('version', '1.2.10');
INSERT INTO `jos_xmap` VALUES ('classname', 'sitemap');
INSERT INTO `jos_xmap` VALUES ('expand_category', '1');
INSERT INTO `jos_xmap` VALUES ('expand_section', '1');
INSERT INTO `jos_xmap` VALUES ('show_menutitle', '1');
INSERT INTO `jos_xmap` VALUES ('columns', '1');
INSERT INTO `jos_xmap` VALUES ('exlinks', '1');
INSERT INTO `jos_xmap` VALUES ('ext_image', 'img_grey.gif');
INSERT INTO `jos_xmap` VALUES ('exclmenus', '');
INSERT INTO `jos_xmap` VALUES ('includelink', '1');
INSERT INTO `jos_xmap` VALUES ('sitemap_default', '1');
INSERT INTO `jos_xmap` VALUES ('exclude_css', '0');
INSERT INTO `jos_xmap` VALUES ('exclude_xsl', '0');

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_xmap_ext`
-- 

CREATE TABLE `jos_xmap_ext` (
  `id` int(11) NOT NULL auto_increment,
  `extension` varchar(100) NOT NULL,
  `published` int(1) default '0',
  `params` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

-- 
-- Dumping data for table `jos_xmap_ext`
-- 

INSERT INTO `jos_xmap_ext` VALUES (1, 'com_acymailing', 1, '-1{include_mails=1\nmax_mails=\ncat_priority=-1\ncat_changefreq=-1\nmail_priority=-1\nmail_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (2, 'com_agora', 1, '-1{include_forums=1\ninclude_topics=1\nmax_topics=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\nforum_priority=-1\nforum_changefreq=-1\ntopic_priority=-1\ntopic_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (3, 'com_contact', 1, '-1{include_contacts=1\nmax_contacts=\ncat_priority=-1\ncat_changefreq=-1\ncontact_priority=-1\ncontact_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (4, 'com_content', 1, '-1{expand_categories=1\nexpand_sections=1\narticles_order=menu\nadd_pagebreaks=1\nadd_images=0\nmax_images=1000\nshow_unauth=0\nmax_art=0\nmax_art_age=0\ncat_priority=-1\ncat_changefreq=-1\nart_priority=-1\nart_changefreq=-1\nkeywords=1\n}');
INSERT INTO `jos_xmap_ext` VALUES (5, 'com_docman', 1, '-1{include_docs=1\ndoc_task=\ncat_priority=0.5\ncat_changefreq=weekly\ndoc_priority=0.5\ndoc_changefreq=weekly\n}');
INSERT INTO `jos_xmap_ext` VALUES (6, 'com_eventlist', 1, '-1{include_events=1\nmax_events=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\nfile_priority=-1\nfile_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (7, 'com_g2bridge', 1, '-1{include_items=2\ncat_priority=-1\ncat_changefreq=-1\nitem_priority=-1\nitem_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (8, 'com_glossary', 1, '-1{include_entries=1\nmax_entries=\nletter_priority=0.5\nletter_changefreq=weekly\nentry_priority=0.5\nentry_changefreq=weekly\n}');
INSERT INTO `jos_xmap_ext` VALUES (9, 'com_hotproperty', 1, '-1{include_properties=1\ninclude_companies=1\ninclude_agents=1\nproperties_text=Properties\ncompanies_text=Companies\nagents_text=Agents\nmax_properties=\ntype_priority=-1\ntype_changefreq=-1\nproperty_priority=-1\nproperty_changefreq=-1\ncompany_priority=-1\ncompany_changefreq=-1\nagent_priority=-1\nagent_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (10, 'com_jcalpro', 1, '-1{include_events=1\ncat_priority=-1\ncat_changefreq=-1\nevent_priority=-1\nevent_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (11, 'com_jdownloads', 1, '-1{include_files=1\nmax_files=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\nfile_priority=-1\nfile_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (12, 'com_jevents', 1, '-1{include_events=1\nmax_events=\ncat_priority=0.5\ncat_changefreq=weekly\nevent_priority=0.5\nevent_changefreq=weekly\n}');
INSERT INTO `jos_xmap_ext` VALUES (13, 'com_jmovies', 1, '-1{include_movies=1\nmax_movies=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\nfile_priority=-1\nfile_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (14, 'com_jomres', 1, '-1{priority=0.5\nchangefreq=weekly\n}');
INSERT INTO `jos_xmap_ext` VALUES (15, 'com_joomdoc', 1, '-1{include_docs=1\ndoc_task=\ncat_priority=0.5\ncat_changefreq=weekly\ndoc_priority=0.5\ndoc_changefreq=weekly\n}');
INSERT INTO `jos_xmap_ext` VALUES (16, 'com_joomgallery', 1, '-1{include_pictures=1\nmax_pictures=\ncat_priority=-1\ncat_changefreq=-1\npictures_priority=-1\npictures_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (17, 'com_kb', 1, '-1{include_articles=1\ninclude_feeds=1\nmax_articles=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\nfile_priority=-1\nfile_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (18, 'com_kunena', 1, '-1{include_topics=1\nmax_topics=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\ntopic_priority=-1\ntopic_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (19, 'com_lknanswers', 1, '-1{include_files=1\nmax_questions=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\nquestion_priority=-1\nquestion_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (20, 'com_mtree', 1, '-1{cats_order=cat_name\ninclude_links=1\nlinks_order=ordering\nmax_links=\nmax_age=\ncat_priority=0.5\ncat_changefreq=weekly\nlink_priority=0.5\nlink_changefreq=weekly\n}');
INSERT INTO `jos_xmap_ext` VALUES (21, 'com_myblog', 1, '-1{include_bloggers=1\ninclude_tag_clouds=1\ninclude_feed=2\ninclude_archives=2\nnumber_of_bloggers=8\ninclude_blogger_posts=1\nnumber_of_post_per_blogger=32\ntext_bloggers=Bloggers\nblogger_priority=-1\nblogger_changefreq=-1\nfeed_priority=-1\nfeed_changefreq=-1\nentry_priority=-1\nentry_changefreq=-1\ncats_priority=-1\ncats_changefreq=-1\narc_priority=-1\narc_changefreq=-1\ntag_priority=-1\ntag_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (22, 'com_rapidrecipe', 1, '-1{cats_order=cat_name\ninclude_links=1\nlinks_order=ordering\nmax_links=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\nrecipe_priority=-1\nrecipe_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (23, 'com_remository', 1, '-1{include_files=1\nmax_files=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\nfile_priority=-1\nfile_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (24, 'com_resource', 1, '-1{include_articles=1\nmax_articles=\ncat_priority=-1\ncat_changefreq=-1\narticle_priority=-1\narticle_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (25, 'com_rdautos', 1, '-1{include_vehicles=1\ncat_priority=0.5\ncat_changefreq=weekly\nvehicle_priority=0.5\nvehicle_changefreq=weekly\n}');
INSERT INTO `jos_xmap_ext` VALUES (26, 'com_rokdownloads', 1, '-1{include_files=1\nmax_files=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\nfile_priority=-1\nfile_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (27, 'com_rsgallery2', 1, '-1{include_images=1\nmax_images=\nmax_age=\nimages_order=orderding\ncat_priority=0.5\ncat_changefreq=weekly\nimage_priority=0.5\nimage_changefreq=weekly\n}');
INSERT INTO `jos_xmap_ext` VALUES (28, 'com_sectionex', 1, '-1{expand_categories=1\nexpand_sections=1\nshow_unauth=0\ncat_priority=-1\ncat_changefreq=-1\nart_priority=-1\nart_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (29, 'com_cmsshopbuilder', 1, '-1{include_items=1\nmax_items=\nmax_age=\ncat_priority=-1\ncat_changefreq=-1\nitem_priority=-1\nitem_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (30, 'com_sobi2', 1, '-1{include_entries=1\nmax_entries=\nmax_age=\nentries_order=a.ordering\nentries_orderdir=DESC\ncat_priority=-1\ncat_changefreq=weekly\nentry_priority=-1\nentry_changefreq=weekly\n}');
INSERT INTO `jos_xmap_ext` VALUES (31, 'com_virtuemart', 1, '-1{include_products=1\ninclude_product_images=0\nproduct_image_license_url=\ncat_priority=0.5\ncat_changefreq=weekly\nprod_priority=0.5\nprod_changefreq=weekly\n}');
INSERT INTO `jos_xmap_ext` VALUES (32, 'com_weblinks', 1, '-1{include_links=1\nmax_links=\ncat_priority=-1\ncat_changefreq=-1\nlink_priority=-1\nlink_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (33, 'com_yoflash', 1, '-1{include_yoflash=1\nmax_games=\ncat_priority=-1\ncat_changefreq=-1\ngames_priority=-1\ngames_changefreq=-1\n}');
INSERT INTO `jos_xmap_ext` VALUES (34, 'com_zoo', 1, '-1{include_categories=1\ninclude_items=1\ncat_priority=-1\ncat_changefreq=-1\nitem_priority=-1\nitem_changefreq=-1\n}');

-- --------------------------------------------------------

-- 
-- Table structure for table `jos_xmap_items`
-- 

CREATE TABLE `jos_xmap_items` (
  `uid` varchar(100) NOT NULL,
  `itemid` int(11) NOT NULL,
  `view` varchar(10) NOT NULL,
  `sitemap_id` int(11) NOT NULL,
  `properties` varchar(300) default NULL,
  PRIMARY KEY  (`uid`,`itemid`,`view`,`sitemap_id`),
  KEY `uid` (`uid`,`itemid`),
  KEY `view` (`view`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jos_xmap_items`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `jos_xmap_sitemap`
-- 

CREATE TABLE `jos_xmap_sitemap` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `expand_category` int(11) default NULL,
  `expand_section` int(11) default NULL,
  `show_menutitle` int(11) default NULL,
  `columns` int(11) default NULL,
  `exlinks` int(11) default NULL,
  `ext_image` varchar(255) default NULL,
  `menus` text,
  `exclmenus` varchar(255) default NULL,
  `includelink` int(11) default NULL,
  `usecache` int(11) default NULL,
  `cachelifetime` int(11) default NULL,
  `classname` varchar(255) default NULL,
  `count_xml` int(11) default NULL,
  `count_html` int(11) default NULL,
  `views_xml` int(11) default NULL,
  `views_html` int(11) default NULL,
  `lastvisit_xml` int(11) default NULL,
  `lastvisit_html` int(11) default NULL,
  `excluded_items` text,
  `compress_xml` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `jos_xmap_sitemap`
-- 

INSERT INTO `jos_xmap_sitemap` VALUES (1, 'New Sitemap', 1, 1, 1, 1, 1, 'img_grey.gif', 'mainmenu,0,1,1,0.5,daily', '', 1, 0, 15, 'xmap', 0, 0, 0, 0, 0, 0, '', 0);

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
INSERT INTO `tbl_admins` VALUES (25, 'Phan Thị Trang', 'xtech@gmail.com', 'admin', 'e807f1fcf82d132f9bb018ca6738a19f', 1, '', 2, 'a:2:{s:11:"admin.sites";s:0:"";s:13:"admin.hotdeal";a:6:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"5";i:4;s:1:"6";i:5;s:1:"7";}}', 0, 1, '1970-01-01 07:00:00', '0000-00-00 00:00:00', 1);
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
  `banner_topup` varchar(255) collate utf8_unicode_ci NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `tbl_banner`
-- 

INSERT INTO `tbl_banner` VALUES (4, '', 'image/banners/2.jpg', 'http://xtech.vn/register_get_phone.php?product_id=', 1, 1, '', '', 'đặt hàng online htc cha cha', '', 0, '2012-02-10 12:00:00', 0, 2374);
INSERT INTO `tbl_banner` VALUES (5, '', '', '', 1, 1, '', '', 'Chương trình mới', '', 0, '2012-02-10 04:29:02', 0, 0);
INSERT INTO `tbl_banner` VALUES (6, 'image/banners/topup/topup_topup_offfline.png', 'image/banners/topup/profile_1288171257_132432803_1-Hinh-anh-ca--Ban-S-QUN-aO-THI-TRANG-0932906060-1288171257.jpg', '', 1, 2, '', '', 'Banner topup', '', 0, '2012-03-15 12:00:00', 0, 0);
INSERT INTO `tbl_banner` VALUES (7, 'image/banners/topup/topup_1_200908171834072308Zn.jpg', 'image/banners/topup/profile_4328558f2010100752.jpg', '', 1, 2, '', '', 'Banner topup mowis', '', 0, '2012-03-15 05:05:26', 0, 0);

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
INSERT INTO `tbl_menu` VALUES (21, '3', 'Đồ Bộ', 'Do-Bo', 'index.php?dispatch=product.view&product_id=18', 'product', 1, 1, 0);
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

INSERT INTO `tbl_products` VALUES (1, 'UDQLU', '0', 150000, 200000, 10, 0, 20, 5, 2, 3, 1, 0, '2012-02-23 02:07:15', 1, '2012-03-13 11:45:38', 1, 2);
INSERT INTO `tbl_products` VALUES (2, 'ASM05', '20gam', 380000, 420000, 10, 0, 20, 5, 3, 6, 1, 0, '2012-02-23 02:10:51', 1, '2012-02-26 04:00:14', 1, 1);
INSERT INTO `tbl_products` VALUES (26, 'CS01', '0', 420000, 450000, 30, 0, 20, 5, 30, 5, 1, 0, '2012-03-13 12:00:00', 1, '2012-03-13 11:45:26', 1, 2);
INSERT INTO `tbl_products` VALUES (10, 'AQN', '10gam', 520000, 560000, 50, 0, 20, 15, 2, 10, 1, 0, '2012-02-23 02:30:44', 1, '2012-02-26 04:04:15', 1, 1);
INSERT INTO `tbl_products` VALUES (25, 'CS01', '0', 420000, 450000, 30, 0, 20, 5, 30, 2, 1, 0, '2012-02-26 12:46:27', 1, '2012-02-27 05:34:54', 1, 2);
INSERT INTO `tbl_products` VALUES (24, 'VDD', '0', 420000, 460000, 20, 0, 20, 6, 30, 2, 1, 0, '2012-02-26 10:46:49', 1, '2012-03-13 11:45:31', 1, 2);
INSERT INTO `tbl_products` VALUES (16, 'ÀGGS', '0', 250000, 0, 0, 0, 0, 0, 0, 2, 1, 0, '2012-02-23 02:30:44', 1, '2012-03-13 11:49:36', 1, 5);
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=289 ;

-- 
-- Dumping data for table `tbl_products_color`
-- 

INSERT INTO `tbl_products_color` VALUES (1, 21, '00ff00', '#00ff00', 0, 0);
INSERT INTO `tbl_products_color` VALUES (2, 21, '00ff00', '#00ff00', 0, 0);
INSERT INTO `tbl_products_color` VALUES (3, 21, '00ff00', '#00ff00', 0, 0);
INSERT INTO `tbl_products_color` VALUES (281, 26, '', '', 0, 1);
INSERT INTO `tbl_products_color` VALUES (283, 24, '', '', 0, 1);
INSERT INTO `tbl_products_color` VALUES (280, 26, '417d41', '417d41', 0, 1);
INSERT INTO `tbl_products_color` VALUES (279, 26, '6200ff', '6200ff', 0, 1);
INSERT INTO `tbl_products_color` VALUES (278, 26, 'f08a88', 'f08a88', 0, 1);
INSERT INTO `tbl_products_color` VALUES (277, 26, '304be3', '304be3', 0, 1);
INSERT INTO `tbl_products_color` VALUES (286, 1, '', '', 0, 1);
INSERT INTO `tbl_products_color` VALUES (95, 25, '', '', 0, 1);
INSERT INTO `tbl_products_color` VALUES (94, 25, '24fc24', '24fc24', 270000, 1);
INSERT INTO `tbl_products_color` VALUES (285, 1, '303630', '303630', 140000, 1);
INSERT INTO `tbl_products_color` VALUES (284, 1, '0e450e', '0e450e', 145000, 1);
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
INSERT INTO `tbl_products_color` VALUES (288, 16, '', '', 0, 1);
INSERT INTO `tbl_products_color` VALUES (287, 16, '3c543c', '3c543c', 220000, 1);
INSERT INTO `tbl_products_color` VALUES (71, 18, '3ac43a', '3ac43a', 280000, 1);
INSERT INTO `tbl_products_color` VALUES (72, 18, '717371', '717371', 250000, 1);
INSERT INTO `tbl_products_color` VALUES (146, 20, '', '', 0, 1);
INSERT INTO `tbl_products_color` VALUES (145, 20, 'b8c4b8', 'b8c4b8', 330000, 1);
INSERT INTO `tbl_products_color` VALUES (144, 20, '27b027', '27b027', 350000, 1);
INSERT INTO `tbl_products_color` VALUES (282, 24, '449144', '449144', 425000, 1);

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
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  PRIMARY KEY  (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- 
-- Dumping data for table `tbl_products_discount`
-- 

INSERT INTO `tbl_products_discount` VALUES (24, 380000, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_products_discount` VALUES (26, 400000, 5, '2012-03-13 12:00:00', '2012-03-16 12:00:00');

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

INSERT INTO `tbl_products_group` VALUES (24, 0, 1, 1, 0, 1, 1, 7);
INSERT INTO `tbl_products_group` VALUES (25, 0, 1, 0, 1, 0, 0, 1);
INSERT INTO `tbl_products_group` VALUES (26, 0, 1, 1, 1, 0, 0, 0);
INSERT INTO `tbl_products_group` VALUES (20, 1, 1, 1, 1, 1, 1, 5);
INSERT INTO `tbl_products_group` VALUES (1, 0, 0, 1, 0, 0, 0, 3);
INSERT INTO `tbl_products_group` VALUES (16, 0, 0, 1, 0, 0, 0, 2);

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
