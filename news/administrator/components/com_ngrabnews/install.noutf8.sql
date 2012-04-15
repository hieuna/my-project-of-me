DROP TABLE IF EXISTS
`#__ngrab_lic`,
`#__ngrab_filter`,
`#__ngrab_cron`,
`#__ngrab_usage`;


CREATE TABLE `#__ngrab_lic` (
 	`id` int(11) NOT NULL auto_increment,
	`serial_number` varchar(255) NOT NULL default '',
	`license_key` varchar(255) NOT NULL default '',
	`license_info` varchar(255) NOT NULL default '',
	`license` blob,
	PRIMARY KEY  (`id`)
);

INSERT INTO `#__ngrab_lic` (`id`) VALUES (1); 

CREATE TABLE `#__ngrab_filter` (
	`id` int(11) NOT NULL auto_increment,
	`user_id` int(11) NOT NULL,
	`filter_name` varchar(255) NOT NULL,
	`filter_spec` mediumblob NOT NULL,
	`inc_top` text NOT NULL,
	`inc_bot` text NOT NULL,
	`mdate` datetime NOT NULL,
	`cdate` datetime NOT NULL,
	PRIMARY KEY  (`id`)
);


CREATE TABLE `#__ngrab_cron` (
	`id` int(11) NOT NULL auto_increment,
	`cron_name` varchar(255) NOT NULL,
	`parent` int(11) NOT NULL default '0',
	`filter_id` int(11) NOT NULL,
	`cron_url` text,
	`section_id` int(11) NOT NULL default '0',
	`cat_id` int(11) NOT NULL default '0',
	`field_title` varchar(100) NOT NULL,
	`field_intro` varchar(100) NOT NULL,
	`field_full` varchar(100) NOT NULL,
	`full_filter` int(11) NOT NULL default '0',
	`field_unique` varchar(100) NOT NULL,
	`field_created` int(11) NOT NULL default '0',
	`show_intro` tinyint(3) NOT NULL default '0',
	`field_state` tinyint(3) NOT NULL default '0',
	`front_page` tinyint(4) NOT NULL default '0',	
	`fix_html` tinyint(4) NOT NULL default '0',	
	`remove_style` tinyint(4) NOT NULL default '0',	
	`remove_link` tinyint(4) NOT NULL default '0',	
	`tag_allowed` text NOT NULL default '',
	`get_keyword` tinyint(4) NOT NULL default '1',	
	`black_word` text NOT NULL default '',
	`extract_img` tinyint(4) NOT NULL default '0',	
	`thumb_width` smallint(6) NOT NULL default '0',	
	`thumb_height` smallint(6) NOT NULL default '0',	
	`image_align` varchar(10) NOT NULL default '',
	`image_hspace` varchar(10) NOT NULL default '',
	`image_vspace` varchar(10) NOT NULL default '',
	`image_border` varchar(10) NOT NULL default '',
	`detail_width` smallint(6) NOT NULL default '0',	
	`detail_height` smallint(6) NOT NULL default '0',	
	`detail_align` varchar(10) NOT NULL default '',
	`detail_hspace` varchar(10) NOT NULL default '',
	`detail_vspace` varchar(10) NOT NULL default '',
	`detail_border` varchar(10) NOT NULL default '',
	`content_source` varchar(255) NOT NULL default '',
	`cron_mhdmd` varchar(255) NOT NULL default '',
	`cron_ran` datetime default NULL,
	`cron_ok` tinyint(4) NOT NULL default '0',
	`published` tinyint(4) NOT NULL,	
	`mdate` datetime NOT NULL,
	`cdate` datetime NOT NULL,
	PRIMARY KEY  (`id`)
);


CREATE TABLE `#__ngrab_usage` (
	`id` int(11) NOT NULL auto_increment,
	`cron_id` int(11) NOT NULL,
	`usage_unique` varchar(255) NOT NULL default '',
	`content_id` int(11) NOT NULL default '0',
	`cdate` datetime NOT NULL,
	`link_detail` text,
	`is_detail` tinyint(4) NOT NULL default '0',	
	PRIMARY KEY  (`id`)
);
