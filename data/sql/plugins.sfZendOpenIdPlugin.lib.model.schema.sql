
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- sf_openid_identifier
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_openid_identifier`;


CREATE TABLE `sf_openid_identifier`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`identifier` VARCHAR(255)  NOT NULL,
	`user_id` INTEGER,
	`created_at` DATETIME,
	`last_login` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `sf_openid_identifier_U_1` (`identifier`),
	INDEX `sf_openid_identifier_FI_1` (`user_id`),
	CONSTRAINT `sf_openid_identifier_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
