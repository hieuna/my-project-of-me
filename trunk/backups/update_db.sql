ALTER TABLE `tbl_products_discount` ADD `start_date` DATETIME NOT NULL AFTER `percent` ,
ADD `end_date` DATETIME NOT NULL AFTER `start_date` ;