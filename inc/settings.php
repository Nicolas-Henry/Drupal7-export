<?php
// databases connexions

// drupal 7 db
// IMPORTANT : specify if possible a copy of our drupal 7 database
$settings_db_drupal7['server']      = 'localhost';
$settings_db_drupal7['user']        = 'nicolas';
$settings_db_drupal7['password']    = '';
$settings_db_drupal7['database']    = 'drupal7-copy';

// destination db
$settings_db_destination['server']      = 'localhost';
$settings_db_destination['user']        = 'nicolas';
$settings_db_destination['password']    = '';
$settings_db_destination['database']    = 'db-destination';

// tables
$tables['1'] = 'users';
$tables['2'] = 'articles';
$tables['3'] = 'categories';

// category vid = The taxonomy_vocabulary.vid of the vocabulary to which the term is assigned.
$category_vid = 2; 

// tables structures
$tables_create_sql['1'] = "CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(60) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `numberslogin` smallint(6) NOT NULL DEFAULT '0',
  `lastlogin` datetime DEFAULT NULL,
  `lastaccess` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$tables_create_sql['2'] = "CREATE TABLE articles (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(5) NOT NULL,
  `category_id` int(3) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(250) DEFAULT NULL,
  `content` text NOT NULL,
  `imagefilename` varchar(25) DEFAULT NULL,
  `imagealt` varchar(64) DEFAULT NULL,
  `views` int(6) NOT NULL DEFAULT '0',
  `online` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";


$tables_create_sql['3'] = "CREATE TABLE `categories` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `category_id` int(3) NOT NULL DEFAULT '0',
  `name` varchar(70) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `description` tinytext NOT NULL,
  `imagefilename` varchar(64) DEFAULT NULL,
  `order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

?>
