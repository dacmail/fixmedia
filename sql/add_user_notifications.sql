ALTER TABLE `users` ADD `notification` TINYINT(1)  NULL  DEFAULT '1'  AFTER `allow_mention_twitter`;
ALTER TABLE `users` ADD `notifications_types` VARCHAR(100)  NULL  DEFAULT 'a:4:{s:3:\"FIX\";b:1;s:4:\"VOTE\";b:1;s:6:\"REPORT\";b:1;s:6:\"SOLVED\";b:1;}'  AFTER `notifications`;
