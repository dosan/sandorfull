CREATE TABLE `sandor`.`ng-phones` (
	id INT(11) NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	snippet varchar(255) COLLATE utf8_unicode_ci NOT NULL ,
	image_url varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	age INT(11) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (id),
	UNIQUE KEY `name` (name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';
