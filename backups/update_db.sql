ALTER TABLE `tbl_products_discount` ADD `start_date` DATETIME NOT NULL AFTER `percent` ,
ADD `end_date` DATETIME NOT NULL AFTER `start_date` ;

/* 15-03-2012 */
ALTER TABLE `tbl_banner` ADD `banner_topup` VARCHAR( 255 ) NOT NULL AFTER `banner_id` ;