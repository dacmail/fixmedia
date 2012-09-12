ALTER TABLE reports ADD `karma` decimal(10,2) DEFAULT '0.00';
ALTER TABLE reports ADD `karma_value` decimal(10,2) DEFAULT '0.00';
ALTER TABLE `reports` ADD INDEX `karma` (`karma`);
