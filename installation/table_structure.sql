

CREATE TABLE IF NOT EXISTS `userlog` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(60) NOT NULL,
  `action` varchar(10) NOT NULL,
  `userip` varchar(255) NOT NULL,
  `useragent` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `username` (`username`),
  FULLTEXT KEY `username_2` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1449 ;




CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(60) NOT NULL,
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `cnt` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;



CREATE TABLE IF NOT EXISTS `signlog` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `failed` text NOT NULL,
  `username` varchar(60) NOT NULL,
  `userip` varchar(255) NOT NULL,
  `useragent` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `time` (`date`),
  KEY `post_time_idx` (`date`) USING BTREE,
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=276 ;




CREATE TABLE IF NOT EXISTS `prof` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `joindate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(60) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `joinip` varchar(255) NOT NULL,
  `joinagent` varchar(255) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

