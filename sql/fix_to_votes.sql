RENAME TABLE `fixs` TO `votes`;
ALTER TABLE `votes` CHANGE `report_id` `item_id` BIGINT(20)  NULL  DEFAULT NULL;
ALTER TABLE `votes` ADD `vote_type` ENUM('FIX','REPORT') AFTER `item_id`;
ALTER TABLE `votes` ADD `vote_value` INT  NULL  DEFAULT NULL  AFTER `vote_type`;
ALTER TABLE `votes` DROP INDEX `report_id`;
ALTER TABLE `votes` DROP INDEX `user_id`;
ALTER TABLE `votes` DROP INDEX `report_id_2`;
ALTER TABLE `votes` DROP INDEX `ip`;
ALTER TABLE `votes` ADD UNIQUE INDEX `vote` (`user_id`, `item_id`, `vote_type`);

ALTER TABLE `reports_data` ADD `votes_count` SMALLINT  NULL  DEFAULT '0'  AFTER `urls`;
ALTER TABLE `reports` ADD `votes_count` SMALLINT(4)  NULL  DEFAULT '0'  AFTER `author_approved`;

