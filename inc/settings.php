<?php
// databases connexions

// drupal 7 db
$settings_db_drupal7['server']      = 'localhost';
$settings_db_drupal7['user']        = 'nicolas';
$settings_db_drupal7['password']    = 'xxxxxx';
$settings_db_drupal7['database']    = 'drupal7-copy'; // IMPORTANT : specify if possible a copy of our drupal 7 database

// destination db
$settings_db_destination['server']      = 'localhost';
$settings_db_destination['user']        = 'nicolas';
$settings_db_destination['password']    = 'yyyyyyy';
$settings_db_destination['database']    = 'db-destination';

// tables
$tables['1'] = 'users';
$tables['2'] = 'articles';
$tables['3'] = 'categories';

// category vid = The taxonomy_vocabulary.vid of the vocabulary to which the term is assigned.
$category_vid = 2; // 

// tables structures
$tables_create_sql['1'] = "CREATE TABLE `users` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mail` varchar(128) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `lastlogin` date NOT NULL,
  `numberslogin` smallint(6) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
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
  `imagealt` varchar(64) NOT NULL,
  `views` int(6) NOT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";


$tables_create_sql['3'] = "CREATE TABLE `categories` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `category_id` int(3) NOT NULL DEFAULT '0',
  `name` varchar(70) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `description` tinytext NOT NULL,
  `imagefilename` varchar(64) NOT NULL,
  `order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

?>