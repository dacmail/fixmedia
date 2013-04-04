ALTER TABLE `users` CHANGE `notifications_types` `notifications_types` VARCHAR(150)  CHARACTER SET latin1  COLLATE latin1_swedish_ci  NULL  DEFAULT 'a:6:{s:3:\"FIX\";b:1;s:4:\"VOTE\";b:1;s:6:\"REPORT\";b:1;s:6:\"SOLVED\";b:1;s:7:\"COMMENT\";b:1;s:5:\"REPLY\";b:1;}';
ALTER TABLE `comments` CHANGE `report_id` `reports_data_id` BIGINT(20)  NULL  DEFAULT NULL;
