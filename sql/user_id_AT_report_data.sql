ALTER TABLE `reports_data` ADD `user_id` INT(10)  UNSIGNED  NULL  DEFAULT NULL  AFTER `created_at`;
ALTER TABLE `reports_data` ADD INDEX `user_id` (`user_id`);

