# SQL Dump for lexique module
# PhpMyAdmin Version: 4.0.4
# https://www.phpmyadmin.net
#
# Host: xoops-2511b-fr
# Generated on: Mon Jul 31, 2023 to 18:05:53
# Server version: 8.0.31
# PHP Version: 8.0.26

#
# Structure table for `lexique_lex__items` 3
#

CREATE TABLE `lexique_lex__items` (
  `item_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_list_id` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `item_name` VARCHAR(80) NULL DEFAULT '',
  PRIMARY KEY (`item_id`),
  INDEX (`item_list_id`)
) ENGINE=InnoDB;

#
# Structure table for `lexique_lex__labels` 4
#

CREATE TABLE `lexique_lex__labels` (
  `lab_id` INT(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lab_lex_id` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `lab_code` VARCHAR(50) NOT NULL DEFAULT '',
  `lab_label` VARCHAR(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`lab_id`),
  INDEX (`lab_lex_id`),
  UNIQUE KEY `lab_code` (`lab_code`)
) ENGINE=InnoDB;

#
# Structure table for `lexique_lex__lists` 3
#

CREATE TABLE `lexique_lex__lists` (
  `list_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `list_name` VARCHAR(50) NULL DEFAULT '',
  `list_description` TEXT NULL ,
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB;

#
# Structure table for `lexique_lex__params` 41
#

CREATE TABLE `lexique_lex__params` (
  `lex_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lex_sql_prefix` VARCHAR(12) NULL DEFAULT '',
  `lex_category` VARCHAR(50) NOT NULL DEFAULT '',
  `lex_name` VARCHAR(80) NOT NULL DEFAULT '',
  `lex_icon` VARCHAR(30) NOT NULL DEFAULT 'livre1.gif',
  `lex_icon_width` TINYINT(4) NOT NULL DEFAULT '1',
  `lex_description` TEXT NOT NULL ,
  `lex_actif` TINYINT(1) NOT NULL DEFAULT '1',
  `lex_weight` SMALLINT(1) NOT NULL DEFAULT '0',
  `lex_default` TINYINT(1) NULL DEFAULT '0',
  `lex_seealso_mode` TINYINT(1) NOT NULL DEFAULT '0',
  `lex_bin_menus` INT(0) UNSIGNED NOT NULL DEFAULT '65535',
  `lex_buttons_position` TINYINT(4) NOT NULL DEFAULT '0',
  `lex_group_id_mail` INT(11) NOT NULL DEFAULT '1',
  `lex_bin_search` INT(0) UNSIGNED NOT NULL DEFAULT '0',
  `lex_note_min` INT(11) NULL DEFAULT '0',
  `lex_note_max` INT(11) NULL DEFAULT '0',
  `lex_note_img` VARCHAR(255) NULL DEFAULT '',
  `lex_selector_caracters` VARCHAR(100) NOT NULL DEFAULT 'ABCDEFGHIJKLMNOPQRSTUVWXZ',
  `lex_selector_numerique` VARCHAR(5) NULL DEFAULT '#',
  `lex_selector_other` VARCHAR(5) NOT NULL DEFAULT '@',
  `lex_selector_show_all` TINYINT(1) NOT NULL DEFAULT '1',
  `lex_selector_frames_delimitor` VARCHAR(5) NOT NULL DEFAULT '',
  `lex_selector_letters_separator` VARCHAR(5) NOT NULL DEFAULT '#|#',
  `lex_selector_css_enabled` TEXT NULL ,
  `lex_selector_css_selected` TEXT NULL ,
  `lex_selector_css_disabled` TEXT NULL ,
  `lex_bandeau` VARCHAR(255) NULL DEFAULT '',
  `lex_bandeau_css` TEXT NULL ,
  `lex_term_admin_pager` INT(0) NOT NULL DEFAULT '10',
  `lex_term_user_pager` INT(11) NOT NULL DEFAULT '10',
  `lex_term_img_css` TEXT NULL ,
  `lex_terms_visits` INT(11) NOT NULL DEFAULT '0',
  `lex_note_count` INT(11) NULL DEFAULT '0',
  `lex_note_sum` INT(11) NULL DEFAULT '0',
  `lex_note_average` DECIMAL(11) NULL DEFAULT '0',
  `lex_editor` VARCHAR(45) NULL DEFAULT '',
  `lex_pos_Image_1` TINYINT(1) NULL DEFAULT '0',
  `lex_bin_show` INT(0) UNSIGNED NULL DEFAULT '65535',
  `lex_date_creation` DATETIME(0) NULL DEFAULT '0000-00-00 00:00:00.00000',
  `lex_date_modification` DATETIME(0) NULL DEFAULT '0000-00-00 00:00:00.00000',
  PRIMARY KEY (`lex_id`),
  UNIQUE KEY `lex_sql_prefix` (`lex_sql_prefix`)
) ENGINE=InnoDB;

#
# Structure table for `lexique_lex__propertys` 7
#

CREATE TABLE `lexique_lex__propertys` (
  `ppt_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ppt_list_id` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `ppt_dtype_id` INT(0) UNSIGNED NOT NULL DEFAULT '1',
  `ppt_name` VARCHAR(50) NOT NULL DEFAULT '',
  `ppt_active` TINYINT(1) NOT NULL DEFAULT '0',
  `ppt_weight` INT(4) NOT NULL DEFAULT '99',
  `ppt_css` TEXT NOT NULL ,
  `ppt_is_criteria` TINYINT(1) NULL DEFAULT '0',
  `ppt_attributs` VARCHAR(1024) NOT NULL DEFAULT '',
  PRIMARY KEY (`ppt_id`),
  INDEX (`ppt_list_id`)
) ENGINE=InnoDB;

#
# Structure table for `lexique_lex__terms` 16
#

CREATE TABLE `lexique_lex__terms` (
  `term_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `term_lex_id` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `term_letter` CHAR(1) NOT NULL DEFAULT '',
  `term_name` VARCHAR(50) NOT NULL DEFAULT '',
  `term_short_def` VARCHAR(255) NOT NULL DEFAULT '',
  `term_image_1` VARCHAR(255) NULL DEFAULT '',
  `term_image_2` VARCHAR(255) NULL DEFAULT '',
  `term_image_3` VARCHAR(255) NULL DEFAULT '',
  `term_definition` TEXT NOT NULL ,
  `term_seealso` TEXT NOT NULL DEFAULT '',
  `term_seealso_list` VARCHAR(255) NOT NULL DEFAULT '',
  `term_state` TINYINT(1) NOT NULL DEFAULT '0',
  `term_visits` INT(11) NOT NULL DEFAULT '0',
  `term_user_creation` VARCHAR(80) NOT NULL DEFAULT '',
  `term_date_creation` DATETIME(0) NULL DEFAULT '0000-00-00 00:00:00.00000',
  `term_date_modification` DATETIME(0) NULL DEFAULT '0000-00-00 00:00:00.00000',
  PRIMARY KEY (`term_id`),
  INDEX (`term_lex_id`),
  INDEX (`term_letter`),
  INDEX (`term_name`)
) ENGINE=InnoDB;

#
# Structure table for `lexique_lex__values` 7
#

CREATE TABLE `lexique_lex__values` (
  `val_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `val_lex_id` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `val_ppt_id` INT(11) UNSIGNED NULL DEFAULT '0',
  `val_term_id` INT(11) UNSIGNED NULL DEFAULT '0',
  `val_value` TEXT NULL ,
  `val_link` VARCHAR(255) NULL DEFAULT '',
  `val_attributs` VARCHAR(1024) NULL DEFAULT '',
  PRIMARY KEY (`val_id`),
  INDEX (`val_lex_id`),
  INDEX (`val_ppt_id`),
  INDEX (`val_term_id`)
) ENGINE=InnoDB;

CREATE TABLE `lexique_lex__datatypes` (
  `dtype_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dtype_name` VARCHAR(50) NOT NULL DEFAULT '',
  `dtype_attributs` VARCHAR(1024) NOT NULL DEFAULT '',
  PRIMARY KEY (`dtype_id`)
) ENGINE=InnoDB;

