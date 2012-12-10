ALTER TABLE `votes` CHANGE `vote_type` `vote_type` ENUM('FIX','REPORT','SOLVED')  NULL  DEFAULT NULL;
