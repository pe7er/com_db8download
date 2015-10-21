CREATE TABLE IF NOT EXISTS `#__db8download_files` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`name` VARCHAR(255)  NOT NULL ,
`alias` VARCHAR(255) COLLATE utf8_bin NOT NULL ,
`catid` INT(11)  NOT NULL ,
`filename` VARCHAR(255)  NOT NULL ,
`image` VARCHAR(255)  NOT NULL ,
`description` TEXT NOT NULL ,
`access` INT(11)  NOT NULL ,
`language` VARCHAR(5)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`hits` INT(10)  NOT NULL ,
`tags` TEXT NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__db8download_users` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`name` VARCHAR(255)  NOT NULL ,
`email` VARCHAR(255)  NOT NULL ,
`ip_address` VARCHAR(255)  NOT NULL ,
`file` INT NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;
