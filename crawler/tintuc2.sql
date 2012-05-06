# SQL Manager 2007 for MySQL 4.5.0.4
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : tintuc2


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the `categories` table : 
#

CREATE TABLE `categories` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `section` varchar(50) NOT NULL default '',
  `published` tinyint(1) NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `cat_idx` (`section`,`published`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

#
# Structure for the `categories_source` table : 
#

CREATE TABLE `categories_source` (
  `id` int(11) NOT NULL auto_increment,
  `web_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `link` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `published` tinyint(4) default '1',
  `ordering` int(11) default '1',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `content` table : 
#

CREATE TABLE `content` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `introtext` mediumtext NOT NULL,
  `full_text` mediumtext NOT NULL,
  `sectionid` int(11) unsigned NOT NULL default '0',
  `catid` int(11) unsigned NOT NULL default '0',
  `created` int(11) NOT NULL default '0',
  `published` int(11) NOT NULL default '0',
  `publisher` int(11) unsigned NOT NULL default '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `source_web_id` int(11) NOT NULL default '0',
  `source_category_id` int(11) unsigned NOT NULL,
  `source_link` varchar(255) NOT NULL default '',
  `source_time` int(11) NOT NULL default '0',
  `source_introtext` mediumtext,
  `source_fulltext` text NOT NULL,
  `source_linkdie` tinyint(4) default '0',
  `up2server` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `source_link` (`source_link`),
  KEY `idx_section` (`sectionid`),
  KEY `idx_catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=10762;

#
# Structure for the `images` table : 
#

CREATE TABLE `images` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `content_id` int(11) unsigned NOT NULL,
  `path_source` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `path_root` varchar(500) collate utf8_unicode_ci NOT NULL default '',
  `up2server` tinyint(4) default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `path_source` (`path_source`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `last_crawl` table : 
#

CREATE TABLE `last_crawl` (
  `catid` int(11) NOT NULL,
  `link` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `time` datetime NOT NULL,
  PRIMARY KEY  (`catid`),
  UNIQUE KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `sections` table : 
#

CREATE TABLE `sections` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `scope` varchar(50) NOT NULL default '',
  `published` tinyint(1) NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `count` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `idx_scope` (`scope`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

#
# Structure for the `web_source` table : 
#

CREATE TABLE `web_source` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `link` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for the `categories` table  (LIMIT 0,500)
#

INSERT INTO `categories` (`id`, `title`, `section`, `published`, `ordering`) VALUES 
  (1,'Mang thai','1',1,1),
  (2,'Trẻ sơ sinh','1',1,2),
  (3,'Trẻ nhỏ','1',1,3),
  (4,'Tuổi teen','1',1,4),
  (5,'Giáo dục con cái','1',1,5),
  (6,'Sức khỏe bé','1',1,6),
  (7,'Bé học hát','1',1,7),
  (8,'Kể chuyện','1',1,8),
  (9,'Góc vợ chồng','2',1,1),
  (10,'Chìa khóa phòng the','2',1,2),
  (11,'Tình yêu - Giới tính','2',1,9),
  (12,'Tư vấn','2',1,10),
  (13,'Chia sẻ','2',1,11),
  (14,'Tủ thuốc gia đình','3',1,1),
  (15,'Bệnh người lớn','3',1,2),
  (16,'Bệnh trẻ em','3',1,3),
  (17,'Chăm sóc người già','3',1,4),
  (18,'Dinh dưỡng','3',1,5),
  (19,'Cơ thể và tâm hồn','3',1,6),
  (20,'Thông tin mùa cưới ','4',1,1),
  (21,'Kế hoạch','4',1,2),
  (22,'Tân hôn - Trăng mật','4',1,3),
  (23,'Khuyến mãi mùa cưới','4',1,4),
  (24,'Quán ngon','5',1,1),
  (25,'Món ngon','5',1,2),
  (26,'Đồ uống','5',1,3),
  (27,'Mẹo vặt nội chợ','5',1,4),
  (28,'Đồ bổ dưỡng','5',1,5),
  (29,'Tiêu dùng','6',1,1),
  (30,'Thời trang','6',1,2),
  (31,'Mua cho con','6',1,3),
  (32,'Nhà đẹp','7',1,1),
  (33,'Trang trí nội thất','7',1,2),
  (34,'Thuật phong thủy','7',1,3),
  (35,'Nhà của bạn','7',1,4),
  (36,'Du lịch','8',1,1),
  (37,'Truyền hình','8',1,2),
  (38,'Phim chiếu rạp','8',1,3),
  (39,'Đời sống âm nhạc','8',1,4),
  (40,'Thế giới sao','8',1,5),
  (41,'Thư giãn','8',1,6),
  (46,'Đồ gia dụng','6',1,4),
  (47,'Thời trang','10',1,0),
  (48,'Trang điểm','10',1,0),
  (49,'Dịch vụ làm đẹp','10',1,0),
  (51,'Chưa sắp xếp','1',1,0),
  (52,'Chưa sắp xếp','2',1,0),
  (53,'Chưa sắp xếp','3',1,0),
  (54,'Chưa sắp xếp','5',1,0),
  (55,'Chưa sắp xếp','6',1,0),
  (56,'Chưa sắp xếp','10',1,0),
  (57,'Chưa sắp xếp','7',1,0),
  (58,'Chưa sắp xếp','8',1,0);
COMMIT;

#
# Data for the `categories_source` table  (LIMIT 0,500)
#

INSERT INTO `categories_source` (`id`, `web_id`, `category_id`, `name`, `link`, `published`, `ordering`) VALUES 
  (1,1,1,'Mang Thai','http://afamily.vn/chu-de/42/mang-thai',1,1),
  (2,1,2,'Sơ Sinh','http://afamily.vn/chu-de/98/so-sinh',1,1),
  (3,1,16,'Sức khỏe bé','http://afamily.vn/chu-de/36/suc-khoe-be',1,1),
  (4,1,5,'Dạy con','http://afamily.vn/chu-de/37/day-con',1,1),
  (5,1,12,'Tư vấn','http://afamily.vn/cuoc-song-gia-dinh/chuyen-gia',1,1),
  (6,1,9,'Ly hôn','http://afamily.vn/chu-de/31/Ran-nut',1,1),
  (7,1,10,'Chuyện ấy','http://afamily.vn/chu-de/77/Chuyen-ay',1,1),
  (8,1,14,'Tủ thuốc gia đình','http://afamily.vn/song-khoe/tu-thuoc-gia-dinh',1,1),
  (9,1,14,'Chuyên gia tư vấn','http://afamily.vn/song-khoe/chuyen-gia-tu-van',1,1),
  (10,1,36,'Du lịch','http://afamily.vn/truyen-hinh-du-lich/du-lich',1,1),
  (11,1,38,'Truyền hình','http://afamily.vn/truyen-hinh-du-lich/hom-nay-tivi-nha-ban-co-gi',1,1),
  (12,1,40,'Thế giới sao','http://afamily.vn/truyen-hinh-du-lich/chuyen-sao',1,1),
  (13,1,29,'Tiêu dùng','http://afamily.vn/mua-sam/tieu-dung',1,1),
  (14,1,30,'Thời trang','http://afamily.vn/mua-sam/thoi-trang',1,1),
  (15,1,31,'Mua cho con','http://afamily.vn/mua-sam/mua-cho-con',1,1),
  (16,1,46,'Đồ gia dụng','http://afamily.vn/mua-sam/gia-dung',1,1),
  (17,1,24,'Quán ngon','http://afamily.vn/an-ngon/nha-hang',1,1),
  (18,1,25,'Món chính','http://afamily.vn/chu-de/78/mon-chinh',1,1),
  (19,1,26,'Món nhẹ - đồ uống','http://afamily.vn/chu-de/55/mon-nhe-do-uong',1,1),
  (20,1,28,'Đồ bổ dưỡng','http://afamily.vn/chu-de/58/Bo-duong',1,1),
  (21,1,32,'Giải pháp','http://afamily.vn/nha-dep/giai-phap',1,1),
  (22,1,35,'Nhà của bạn','http://afamily.vn/nha-dep/nha-cua-ban',1,1),
  (23,2,9,'Góc vợ - chồng','http://giadinh.net.vn/p0c1008/trang-goc-vo-chong.htm',1,1),
  (24,2,10,'Chìa khóa phòng the','http://giadinh.net.vn/p0c1009/trang-chia-khoa-phong-the.htm',1,1),
  (25,2,13,'Chia sẻ','http://giadinh.net.vn/p0c1010/trang-chia-se.htm',1,1),
  (26,2,14,'Bệnh thường gặp','http://giadinh.net.vn/p0c1036/trang-benh-thuong-gap.htm',1,1),
  (27,2,14,'Thuốc','http://giadinh.net.vn/p0c1037/trang-thuoc.htm',1,1),
  (28,2,18,'Dinh dưỡng','http://giadinh.net.vn/p0c1038/trang-dinh-duong.htm',1,1),
  (29,2,27,'Mẹo vặt','http://giadinh.net.vn/p0c1015/trang-meo-vat.htm',1,1),
  (30,2,5,'Nuôi dạy con','http://giadinh.net.vn/p0c1017/trang-nuoi-day-con.htm',1,1),
  (31,2,4,'Tuổi teen','http://giadinh.net.vn/p0c1018/trang-tuoi-teen.htm',1,1),
  (32,2,1,'Thai sản','http://giadinh.net.vn/p0c1039/trang-thai-san.htm',1,1),
  (33,2,46,'Đồ gia dụng','http://giadinh.net.vn/p0c1028/trang-do-gia-dung.htm',1,1),
  (34,2,29,'Hàng điện tử','http://giadinh.net.vn/p0c1030/trang-hang-dien-tu.htm',1,1),
  (35,2,47,'Thời trang','http://giadinh.net.vn/p0c1034/trang-thoi-trang.htm',1,1),
  (36,2,48,'Trang điểm','http://giadinh.net.vn/p0c1035/trang-trang-diem.htm',1,1),
  (37,2,49,'Dịch vụ làm đẹp','http://giadinh.net.vn/p0c1040/trang-dich-vu-lam-dep.htm',1,1),
  (38,1,38,'Phim chiếu rạp','http://afamily.vn/truyen-hinh-du-lich/phim-chieu-o-rap',1,1),
  (39,1,51,'Unknow - Làm cha mẹ','http://afamily.vn/nuoi-day-con',1,2),
  (40,1,52,'Unknow - Vợ chồng','http://afamily.vn/cuoc-song-gia-dinh',1,2),
  (41,1,53,'Unknow - Sống khỏe','http://afamily.vn/song-khoe',1,2),
  (42,1,54,'Unknow - Ẩm thực','http://afamily.vn/an-ngon',1,2),
  (43,1,55,'Unknow - Mua sắm','http://afamily.vn/mua-sam',1,2),
  (44,1,57,'Unknow - Không gian sống','http://afamily.vn/nha-dep',1,2),
  (45,1,58,'Unknow - Giải trí Du lịch','http://afamily.vn/truyen-hinh-du-lich',1,2),
  (46,2,52,'Unknow - Vợ chồng','http://giadinh.net.vn/p0c1007/doi-song-vo-chong.htm',1,2),
  (47,2,53,'Unknow - Sống khỏe','http://giadinh.net.vn/p0c1011/suc-khoe.htm',1,2),
  (48,2,51,'Unknow - Làm cha mẹ','http://giadinh.net.vn/p0c1016/lam-cha-me.htm',1,2),
  (49,2,55,'Unknow - Mua sắm','http://giadinh.net.vn/p0c1024/mua-sam.htm',1,2),
  (50,2,58,'Unknow - Giải trí Du lịch','http://giadinh.net.vn/p0c1019/giai-tri.htm',1,2),
  (51,2,56,'Unknow - Làm đẹp','http://giadinh.net.vn/p0c1022/lam-dep.htm',1,2),
  (52,2,58,'Unknow - Giải trí Du lịch','http://giadinh.net.vn/p0c1023/du-lich.htm',1,2),
  (53,2,52,'Unknow - Vợ chồng','http://giadinh.net.vn/p0c1001/gia-dinh.htm',1,2),
  (54,1,38,'Truyền hình','http://afamily.vn/truyen-hinh-du-lich/phim-chieu-o-rap',1,1),
  (55,1,47,'Thời trang','http://afamily.vn/thoi-trang-lam-dep',1,1),
  (56,1,13,'Góc lãng đãng','http://afamily.vn/tam-su-ban-doc/goc-lang-dang',1,1),
  (57,3,48,'Trang Điểm','http://xinhxinh.com.vn/Thu-vien-lam-dep/Trang-diem.xinh',1,1),
  (59,3,48,'Dưỡng da','http://xinhxinh.com.vn/Thu-vien-lam-dep/Duong-da.xinh',1,1),
  (60,3,48,'Mái tóc','http://xinhxinh.com.vn/Thu-vien-lam-dep/Mai-toc.xinh',1,1),
  (61,3,48,'Chống lão hoá','http://xinhxinh.com.vn/Thu-vien-lam-dep/Chong-lao-hoa.xinh',1,1),
  (62,3,48,'Hàm răng','http://xinhxinh.com.vn/Thu-vien-lam-dep/Ham-rang.xinh',1,1),
  (63,3,48,'Chăm sóc chân tay','http://xinhxinh.com.vn/Thu-vien-lam-dep/Cham-soc-chan-tay.xinh',1,1),
  (64,3,48,'Lời khuyên','http://xinhxinh.com.vn/Thu-vien-lam-dep/Loi-khuyen.xinh',1,1),
  (65,3,48,'Khoẻ và đẹp','http://xinhxinh.com.vn/Thu-vien-lam-dep/Khoe-va-dep.xinh',1,1),
  (66,3,48,'Mỹ phẩm','http://xinhxinh.com.vn/Thu-vien-lam-dep/My-pham.xinh',1,1),
  (67,3,49,'Địa chỉ làm đẹp','http://xinhxinh.com.vn/Thu-vien-lam-dep/Dia-chi-lam-dep.xinh',1,1),
  (68,3,47,'Trang phục nữ','http://xinhxinh.com.vn/Phong-cach/Trang-phuc-nu.xinh',1,1),
  (69,3,47,'Trang phục nam','http://xinhxinh.com.vn/Phong-cach/Trang-phuc-nam.xinh',1,1),
  (70,3,47,'Trang phục teen','http://xinhxinh.com.vn/Phong-cach/Trang-phuc-teen.xinh',1,1),
  (71,3,47,'Nội y','http://xinhxinh.com.vn/Phong-cach/Noi-y.xinh',1,1),
  (72,3,47,'Đồ ngủ','http://xinhxinh.com.vn/Phong-cach/Do-ngu.xinh',1,1),
  (73,3,47,'Đi biển','http://xinhxinh.com.vn/Phong-cach/Di-bien.xinh',1,1),
  (74,3,47,'Phụ kiện','http://xinhxinh.com.vn/Phong-cach/Phu-kien.xinh',1,1),
  (75,3,47,'Thời trang trình diễn','http://xinhxinh.com.vn/Phong-cach/Thoi-trang-trinh-dien.xinh',1,1),
  (76,3,11,'1001 cách tỏ tình','http://xinhxinh.com.vn/Nghe-thuat-yeu/1001-cach-to-tinh.xinh',1,1),
  (77,3,9,'Hôn nhân','http://xinhxinh.com.vn/Nghe-thuat-yeu/Hon-nhan.xinh',1,1),
  (78,3,10,'Giới tính','http://xinhxinh.com.vn/Nghe-thuat-yeu/Gioi-tinh.xinh',1,1),
  (79,3,40,'Chuyện của sao','http://xinhxinh.com.vn/The-gioi-sao/Chuyen-cua-sao.xinh',1,1),
  (80,3,40,'Ngắm mỹ nhân','http://xinhxinh.com.vn/The-gioi-sao/Ngam-my-nhan.xinh',1,1),
  (81,3,40,'Hoa hậu','http://xinhxinh.com.vn/The-gioi-sao/Hoa-hau.xinh',1,1),
  (82,3,40,'Sao thương hiệu','http://xinhxinh.com.vn/The-gioi-sao/Sao-thuong-hieu.xinh',1,1),
  (83,3,40,'Sao làm đẹp','http://xinhxinh.com.vn/The-gioi-sao/Sao-lam-dep.xinh',1,1),
  (84,3,1,'Mang thai','http://xinhxinh.com.vn/Me-va-be/Mang-thai.xinh',1,1),
  (85,3,2,'Trẻ sơ sinh','http://xinhxinh.com.vn/Me-va-be/Tre-so-sinh.xinh',1,1),
  (86,3,3,'Nuôi con','http://xinhxinh.com.vn/Me-va-be/Nuoi-con.xinh',1,1),
  (87,3,5,'Dạy con','http://xinhxinh.com.vn/Me-va-be/Day-con.xinh',1,1),
  (88,3,16,'Bệnh trẻ nhỏ','http://xinhxinh.com.vn/Me-va-be/Benh-tre-nho.xinh',1,1),
  (89,3,19,'Sức khoẻ tinh thần','http://xinhxinh.com.vn/Suc-khoe/Suc-khoe-tinh-than.xinh',0,1),
  (90,3,15,'Bệnh phụ nữ','http://xinhxinh.com.vn/Suc-khoe/Benh-phu-nu.xinh',1,1),
  (91,3,14,'Đông tây y học','http://xinhxinh.com.vn/Suc-khoe/Dong-tay-y-hoc.xinh',1,1),
  (92,3,14,'Tư vấn sức khoẻ','http://xinhxinh.com.vn/Suc-khoe/Tu-van-suc-khoe.xinh',1,1),
  (93,3,34,'Phong thuỷ','http://xinhxinh.com.vn/Khong-gian-song/Phong-thuy.xinh',1,1),
  (94,3,32,'Nhà sạch','http://xinhxinh.com.vn/Khong-gian-song/Nha-sach.xinh',1,1),
  (95,3,33,'Không gian đẹp','http://xinhxinh.com.vn/Khong-gian-song/Khong-gian-dep.xinh',1,1),
  (96,3,35,'Nhà của sao','http://xinhxinh.com.vn/Khong-gian-song/Nha-cua-sao.xinh',1,1),
  (97,3,25,'Thực đơn','http://xinhxinh.com.vn/Mon-ngon-de-lam/Thuc-don.xinh',1,1),
  (98,3,25,'Tôi vào bếp','http://xinhxinh.com.vn/Mon-ngon-de-lam/Toi-vao-bep.xinh',1,1),
  (99,3,27,'Mẹo vặt nhà bếp','http://xinhxinh.com.vn/Mon-ngon-de-lam/Meo-vat-nha-bep.xinh',1,1),
  (100,3,46,'Đồ gia dụng','http://xinhxinh.com.vn/Mon-ngon-de-lam/Do-gia-dung.xinh',1,1),
  (101,3,24,'Quán ngon','http://xinhxinh.com.vn/Mon-ngon-de-lam/quan-ngon.xinh',1,1),
  (102,3,25,'Hương vị quê nhà','http://xinhxinh.com.vn/Mon-ngon-de-lam/Huong-vi-que-nha.xinh',1,1),
  (103,3,13,'Tâm sự ds','http://xinhxinh.com.vn/Doi-song/Tam-su-ds.xinh',1,1),
  (104,3,36,'Du lịch','http://xinhxinh.com.vn/Doi-song/Du-lich.xinh',1,1),
  (105,3,29,'Tiêu dùng thông minh','http://xinhxinh.com.vn/Mua-sam/Tieu-dung-thong-minh.xinh',1,1);
COMMIT;

#
# Data for the `last_crawl` table  (LIMIT 0,500)
#

INSERT INTO `last_crawl` (`catid`, `link`, `time`) VALUES 
  (1,'http://afamily.vn/20100809042558794tm0ca32/Xem-thai-nhi-lon-trong-bung-me','2010-08-17 11:47:32'),
  (2,'http://afamily.vn/20100728082134872tm0ca32/Chua-cho-be-hay-duon-minh-tro-sua-theo-dan-gian','2010-08-17 11:48:25'),
  (3,'http://afamily.vn/20100811091444933tm0ca52/Bim-bim-khoai-tay-cho-con-yeu','2010-08-17 11:48:28'),
  (4,'http://afamily.vn/2010081608133508tm0ca32/Bi-quyet-giup-con-nho-hoc-tieng-Anh-sieu-gioi','2010-08-17 11:48:34'),
  (5,'http://afamily.vn/20100816110511607tm0ca64/Vo-nang-nguc-chong-bat-luc','2010-08-17 11:48:37'),
  (6,'http://afamily.vn/2010081511284119tm0ca31/Ly-hon-hay-chiu-dung','2010-08-17 11:48:42'),
  (7,'http://afamily.vn/20100816105932647tm0ca31/Em-chi-len-dinh-o-moi-mot-tu-the','2010-08-17 11:48:46'),
  (8,'http://afamily.vn/20100813100010158tm0ca88/Dung-hanh-tam-tri-cam','2010-08-17 11:48:50'),
  (9,'http://afamily.vn/20100816041611559tm0ca89/-Ban-gai-tu-10-den-25-tuoi-Co-the-tiem-ngua-ung-thu-co-tu-cung','2010-08-17 11:48:54'),
  (10,'http://afamily.vn/2010080808054568tm0ca96/Ke-hoach-hoan-hao-cho-ngay-nghi-cuoi-tuan-o-Quang-Ninh','2010-08-17 11:48:58'),
  (11,'http://afamily.vn/2010081604072720tm0ca94/Xem-Me-cuoi-vi-con-tren-VTV3','2010-08-17 11:49:09'),
  (12,'http://afamily.vn/20100817101815900tm0ca94/Hon-nhan-cua-Trieu-Vy-dang-gap-song-gio','2010-08-17 11:49:03'),
  (13,'http://afamily.vn/2010080708135649tm0ca56/Chu-nhat-kham-pha-the-gioi-nem-tai-NemNem','2010-08-17 11:48:20'),
  (14,'http://afamily.vn/20100815112058988tm0ca111/Nhung-kieu-toc-dep-giup-ban-an-gian-chieu-cao','2010-08-17 11:48:15'),
  (15,'http://afamily.vn/20100804113113451tm0ca59/Quan-ao-cuc-dep-cho-be-day-cac-me-oi','2010-08-17 11:47:36'),
  (16,'http://afamily.vn/20100814091053757tm0ca59/Trang-tri-nha-voi-thuy-tinh-ve','2010-08-17 11:47:39'),
  (17,'http://afamily.vn/20100815011117693tm0ca56/Den-Sai-thanh-dung-quen-thuong-thuc-pha-lau-bo','2010-08-17 11:47:42'),
  (18,'http://afamily.vn/20100817073538169tm0ca52/Kho-ca-loc-chua-ngot','2010-08-17 11:47:45'),
  (19,'http://afamily.vn/2010081602132614tm0ca52/Kem-sua-chua-vi-cam','2010-08-17 11:47:49'),
  (20,'http://afamily.vn/20100817082227631tm0ca52/Rau-la-non-nhieu-duong-chat-nhat','2010-08-17 11:47:53'),
  (21,'http://afamily.vn/20100815080023259tm0ca48/Nghe-thuat-trang-tri-nhung-buc-tuong','2010-08-17 11:47:57'),
  (22,'http://afamily.vn/20100717101841869tm0ca49/Ngoi-nha-nhiet-doi-o-thu-do-Argentina','2010-08-17 11:48:00'),
  (23,'http://giadinh.net.vn/2010030909392689p0c1001/lay-phai-vo-hu-hong.htm','2010-07-28 15:31:19'),
  (24,'http://giadinh.net.vn/20100413084626472p0c1007/lam-sao-biet-chong-bi-roi-loan-cuong.htm','2010-07-28 15:31:27'),
  (25,'http://giadinh.net.vn/20100404052334164p0c1007/su-that-ve-chuyen-tu-suong.htm','2010-07-28 15:31:29'),
  (26,'http://giadinh.net.vn/2010040302331176p0c1011/an-man-co-nguy-co-bi-ung-thu-da-day.htm','2010-07-28 15:31:30'),
  (27,'http://giadinh.net.vn/20100413010513795p0c1011/thoat-khoi-be-tac-do-benh-vay-nen.htm','2010-07-28 15:31:31'),
  (28,'http://giadinh.net.vn/2010033109180410p0c1011/an-gan-dong-vat-co-tot.htm','2010-07-28 15:31:32'),
  (29,'http://giadinh.net.vn/20100408083755917p0c1012/nen-va-khong-nen-dung-muoi.htm','2010-07-28 15:31:33'),
  (30,'http://giadinh.net.vn/20100414090118837p0c1016/meo-chua-nac-cho-be.htm','2010-07-28 15:31:26'),
  (31,'http://giadinh.net.vn/20100412045547569p0c1000/hoc-tro-yeu-va-danh-nhau-nhu-nguoi-lon.htm','2010-07-28 15:31:25'),
  (32,'http://giadinh.net.vn/20100413115733882p0c1006/nhung-phu-nu-khong-biet-minh-co-thai.htm','2010-07-28 15:31:24'),
  (33,'http://giadinh.net.vn/20100409084849860p0c1024/tiet-trung-ban-chai-bang-anh-sang.htm','2010-07-28 15:31:23'),
  (34,'http://giadinh.net.vn/20100412094434306p0c1024/chiem-nguong-netbook-ban-phim-gap-sieu-gon.htm','2010-07-28 15:31:22'),
  (35,'http://giadinh.net.vn/2010040902371504p0c1022/nguoi-cao-mac-gi-dep-va-ton-dang.htm','2010-07-28 15:31:21'),
  (36,'http://giadinh.net.vn/20100413010910242p0c1022/meo-su-dung-mascara.htm','2010-07-28 15:31:20'),
  (37,'http://giadinh.net.vn/20100405102527262p0c1022/sao-em-cu-quay-lung-vao-anh-mai-the.htm','2010-07-28 15:31:20'),
  (38,'http://afamily.vn/20100813094530695tm0ca109/Co-hoi-xem-phim-mien-phi-tai-rap-BHD','2010-08-17 11:48:05'),
  (39,'http://afamily.vn/20100817100810467tm0ca32/Co-the-vat-sua-de-tu-lanh-cho-be-dung-ngay-hom-sau','2010-08-17 11:49:34'),
  (40,'http://afamily.vn/20100817092614273tm0ca31/Chan-goi-chang-hop-nhau-hon-nhan-dai-dang-dang','2010-08-17 11:49:29'),
  (41,'http://afamily.vn/20100817103723868tm0ca86/Thua-Thien-Hue-Bung-phat-du-doi-dich-sot-xuat-huyet','2010-08-17 11:49:26'),
  (42,'http://afamily.vn/20100817082227631tm0ca52/Rau-la-non-nhieu-duong-chat-nhat','2010-08-17 11:49:23'),
  (43,'http://afamily.vn/20100816095359578tm0ca59/Choi-hut-bui-thong-minh-va-tien-loi','2010-08-17 11:49:21'),
  (44,'http://afamily.vn/20100717101841869tm0ca49/Ngoi-nha-nhiet-doi-o-thu-do-Argentina','2010-08-17 11:49:18'),
  (45,'http://afamily.vn/2010081707571884tm0ca94/Phuong-Thanh-Toi-dam-tham-hon-la-nho-be-Ga','2010-08-17 11:49:13'),
  (46,'http://giadinh.net.vn/20100728090624853p0c1007/4-nguyen-nhan-quy-ong-buong-sung.htm','2010-07-28 15:32:32'),
  (47,'http://giadinh.net.vn/2010072809244042p0c1011/an-nho-nen-an-ca-hat.htm','2010-07-28 15:32:15'),
  (48,'http://giadinh.net.vn/20100728113043903p0c1016/co-nen-cho-be-so-sinh-uong-nuoc.htm','2010-07-28 15:31:57'),
  (49,'http://giadinh.net.vn/20100721121747957p0c1024/phong-bep-ruc-ro-voi-bo-dao-da-sac.htm','2010-07-28 15:31:46'),
  (50,'http://giadinh.net.vn/2010072809138142p0c1019/phim-moi-tren-vtv3-gia-dinh-da-quy.htm','2010-07-28 15:31:40'),
  (51,'http://giadinh.net.vn/2010072703443331p0c1022/rang-ngoi-va-hien-dai-voi-sac-hong.htm','2010-07-28 15:31:34'),
  (52,'http://giadinh.net.vn/20100721120057336p0c1002/lai-hai-hung-canh-nghi-mat-thanh-hanh-xac.htm','2010-07-28 15:31:34'),
  (53,'http://giadinh.net.vn/2010072810188977p0c1001/quy-den-tro-thanh-ac-mong.htm','2010-07-28 15:32:39'),
  (54,'http://afamily.vn/20100813094530695tm0ca109/Co-hoi-xem-phim-mien-phi-tai-rap-BHD','2010-08-17 11:48:08'),
  (55,'http://afamily.vn/20100817075841789tm0ca110/Vao-thu-voi-xu-huong-thoi-trang-thap-nien-60','2010-08-17 11:48:11'),
  (56,'http://afamily.vn/20100809093240249tm0ca36/Em-buong-tay-roi-do-anh-di-di','2010-08-17 11:48:31'),
  (57,'http://xinhxinh.com.vn/Trang-diem/55038/Thoa-ma-hong-dung-kieu-sanh-dieu.xinh','2010-08-17 11:41:58'),
  (59,'http://xinhxinh.com.vn/Duong-da/54960/Duong-da-khi-bi-mun.xinh','2010-08-17 11:40:11'),
  (60,'http://xinhxinh.com.vn/Mai-toc/55016/Nhung-kieu-toc-cuc-dinh-danh-cho-khuon-mat-tron.xinh','2010-08-17 11:40:01'),
  (61,'http://xinhxinh.com.vn/Chong-lao-hoa/54828/Loai-bo-nep-nhan-cho-phu-nu-ngoai-30-tuoi.xinh','2010-08-17 11:39:46'),
  (62,'http://xinhxinh.com.vn/Ham-rang/50699/Rang-trang-cho-nu-cuoi-xinh.xinh','2010-08-17 11:39:37'),
  (63,'http://xinhxinh.com.vn/Cham-soc-chan-tay/54718/Nhung-kieu-nghich-mong-sanh-dieu-cho-thu-moi.xinh','2010-08-17 11:39:31'),
  (64,'http://xinhxinh.com.vn/Loi-khuyen/54318/4-loi-khuyen-khien-da-ban-min-dep-khong-bong-dau.xinh','2010-08-17 11:39:23'),
  (65,'http://xinhxinh.com.vn/Khoe-va-dep/54319/Cuoc-chien-giam-can-ban-se-la-nguoi-thang.xinh','2010-08-17 11:39:09'),
  (66,'http://xinhxinh.com.vn/My-pham/54320/Nam-mui-huong-co-dien-diu-nhe-cho-ngay-dau-thu.xinh','2010-08-17 11:38:53'),
  (67,'http://xinhxinh.com.vn/Dia-chi-lam-dep/44730/Mui-dep-bang-cong-nghe-han-quoc.xinh','2010-08-17 11:38:46'),
  (68,'http://xinhxinh.com.vn/Trang-phuc-nu/55047/Ron-ra-chao-thu-voi-cardigan-dang-dai.xinh','2010-08-17 11:40:19'),
  (69,'http://xinhxinh.com.vn/Trang-phuc-teen/54695/Quan-jeans-doi-ca-tinh-chao-thu.xinh','2010-08-17 11:40:24'),
  (70,'http://xinhxinh.com.vn/Trang-phuc-teen/54744/Xuong-pho-cung-dam-duyen-dang.xinh','2010-08-17 11:40:30'),
  (71,'http://xinhxinh.com.vn/Noi-y/54021/Tuyet-dinh-quyen-ru-voi-noi-y-lien.xinh','2010-08-17 11:41:45'),
  (72,'http://xinhxinh.com.vn/Do-ngu/54312/Lang-man-nhung-phut-ben-nguoi-ay.xinh','2010-08-17 11:41:39'),
  (73,'http://xinhxinh.com.vn/Di-bien/54594/Quyen-ru-me-nguoi-voi-bikini-tho-cam.xinh','2010-08-17 11:41:33'),
  (74,'http://xinhxinh.com.vn/Phu-kien/54399/Cach-chon-khuyen-tai-phu-hop-voi-dang-khuon-mat.xinh','2010-08-17 11:41:28'),
  (75,'http://xinhxinh.com.vn/Thoi-trang-trinh-dien/54861/Nhung-chiec-dam-da-hoi-ruc-sang-tham-do-2010.xinh','2010-08-17 11:41:20'),
  (76,'http://xinhxinh.com.vn/1001-cach-to-tinh/54811/Bi-hai-ban-tre-may-moc-lam-theo-tu-van-tinh-cam.xinh','2010-08-17 11:41:12'),
  (77,'http://xinhxinh.com.vn/Hon-nhan/54925/5-nam-nhin-chuyen-ay”-chong-bo-nha-theo-bo.xinh','2010-08-17 11:41:06'),
  (78,'http://xinhxinh.com.vn/Gioi-tinh/55001/Em-chi-len-dinh-o-moi-mot-tu-the.xinh','2010-08-17 11:40:57'),
  (79,'http://xinhxinh.com.vn/Chuyen-cua-sao/54954/Boys-over-flowers-f4-ngay-ay-–-bay-gio.xinh','2010-08-17 11:40:36'),
  (80,'http://xinhxinh.com.vn/Ngam-my-nhan/54940/Vuong-diem-dep-mong-manh-e-ap.xinh','2010-08-17 11:38:42'),
  (81,'http://xinhxinh.com.vn/Hoa-hau/54943/10-dieu-gay-tiec-nuoi-cua-chung-ket-hhvn-2010.xinh','2010-08-17 11:38:30'),
  (82,'http://xinhxinh.com.vn/Sao-thuong-hieu/54011/Avril-lavigne-dep-ngo-ngang-trong-quang-cao-moi.xinh','2010-08-17 11:38:23'),
  (83,'http://xinhxinh.com.vn/Sao-lam-dep/53922/Dep-nhu-tang-bao-quyen.xinh','2010-08-17 11:35:56'),
  (84,'http://xinhxinh.com.vn/Mang-thai/55013/Ba-bau-can-than-mua-mua.xinh','2010-08-17 11:35:53'),
  (85,'http://xinhxinh.com.vn/Tre-so-sinh/54821/Tai-hai-khi-tam-cho-tre-bang-nuoc-la.xinh','2010-08-17 11:35:42'),
  (86,'http://xinhxinh.com.vn/Nuoi-con/54872/9-loai-thuc-pham-giup-cai-thien-chieu-cao.xinh','2010-08-17 11:35:41'),
  (87,'http://xinhxinh.com.vn/Day-con/54130/Bi-quyet-day-tre-thong-minh.xinh','2010-08-17 11:35:36'),
  (88,'http://xinhxinh.com.vn/Benh-tre-nho/53887/Goi-dau-voi-dam-se-tri-chay-ran-hieu-qua.xinh','2010-08-17 11:35:34'),
  (89,'http://xinhxinh.com.vn/Suc-khoe-tinh-than/43221/De-cuoc-song-hanh-phuc-hon-moi-ngay.xinh','2010-05-26 19:02:36'),
  (90,'http://xinhxinh.com.vn/Benh-phu-nu/54554/Nhap-vien-vi-uong-thuoc-no-nguc-de-chong-khen.xinh','2010-08-17 11:35:32'),
  (91,'http://xinhxinh.com.vn/Dong-tay-y-hoc/54939/Chua-ho-dai-dang-khong-dung-thuoc.xinh','2010-08-17 11:35:30'),
  (92,'http://xinhxinh.com.vn/Tu-van-suc-khoe/55054/Phong-nhiem-sieu-khuan-khang-thuoc-nhu-the-nao.xinh','2010-08-17 11:35:27'),
  (93,'http://xinhxinh.com.vn/Phong-thuy/53750/Nguyen-tac-dat-guong-theo-thuyet-phong-thuy.xinh','2010-08-17 11:35:59'),
  (94,'http://xinhxinh.com.vn/Nha-sach/53205/De-tuong-nha-khong-nam-moc.xinh','2010-08-17 11:36:02'),
  (95,'http://xinhxinh.com.vn/Khong-gian-dep/54843/Phong-ngu-nong-am-mua-yeu-thuong.xinh','2010-08-17 11:36:04'),
  (96,'http://xinhxinh.com.vn/Nha-cua-sao/52772/Nha-20-trieu-usd-cua-celine-dion.xinh','2010-08-17 11:38:18'),
  (97,'http://xinhxinh.com.vn/Thuc-don/55011/Thuc-don-hom-nay-trung-cut-boc-thit-sot-ca-canh-rau-den-tia-nau-tom.xinh','2010-08-17 11:38:12'),
  (98,'http://xinhxinh.com.vn/Toi-vao-bep/55049/Thit-bam-xao-thap-cam.xinh','2010-08-17 11:38:05'),
  (99,'http://xinhxinh.com.vn/Meo-vat-nha-bep/54213/Meo-phan-biet-nhan-long-hung-yen-va-nhan-trung-quoc.xinh','2010-08-17 11:37:57'),
  (100,'http://xinhxinh.com.vn/Do-gia-dung/52083/Chon-tu-lanh-bao-quan-tot-tiet-kiem-dien.xinh','2010-08-17 11:37:42'),
  (101,'http://xinhxinh.com.vn/quan-ngon/54999/Doc-dao-ca-nuong-16-tieng.xinh','2010-08-17 11:37:33'),
  (102,'http://xinhxinh.com.vn/Huong-vi-que-nha/53342/Goi-la-bua-tiec-vi-rung.xinh','2010-08-17 11:37:25'),
  (103,'http://xinhxinh.com.vn/Tam-su-ds/54991/Chong-oi-dung-vi-chuyen-con-kien-ma-thoi-phong-thanh-voi.xinh','2010-08-17 11:37:13'),
  (104,'http://xinhxinh.com.vn/Du-lich/54446/Kham-pha-mui-dai-lanh.xinh','2010-08-17 11:36:29'),
  (105,'http://xinhxinh.com.vn/Tieu-dung-thong-minh/54863/Da-trong-vat-nho-hoa-chat.xinh','2010-08-17 11:35:24');
COMMIT;

#
# Data for the `sections` table  (LIMIT 0,500)
#

INSERT INTO `sections` (`id`, `title`, `scope`, `published`, `ordering`, `count`) VALUES 
  (1,'Làm cha mẹ','content',1,1,12),
  (2,'Vợ chồng','content',1,2,5),
  (3,'Sống khỏe','content',1,3,6),
  (4,'Mùa cưới','content',1,4,4),
  (5,'Ẩm thực','content',1,5,5),
  (6,'Mua sắm','content',1,6,3),
  (7,'Không gian sống','content',1,7,4),
  (8,'Giải  trí - Du lịch','content',1,8,6),
  (10,'Làm đẹp','content',1,9,0);
COMMIT;

#
# Data for the `web_source` table  (LIMIT 0,500)
#

INSERT INTO `web_source` (`id`, `name`, `link`) VALUES 
  (1,'Afamily.vn','http://afamily.vn'),
  (2,'Giadinh.net.vn','http://giadinh.net.vn'),
  (3,'Xinhxinh.com.vn','http://xinhxinh.com.vn');
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;