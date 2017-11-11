CREATE TABLE `ads`
(
   `id`          int(11) NOT NULL AUTO_INCREMENT,
   `title` text,
   `photo` text,
   `link` text,
   `tags` text,
   `position`    int(11) DEFAULT NULL,
   `status`      ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
   `created`     datetime NOT NULL,
   `modified`    datetime NOT NULL,
   PRIMARY KEY(`id`)
)
ENGINE = MyISAM
DEFAULT CHARSET = utf8;

CREATE TABLE `articles`
(
   `id`             int(11) NOT NULL AUTO_INCREMENT,
   `category_id`    int(11) NOT NULL,
   `created_by`     int(11) NOT NULL,
   `content`        text NOT NULL,
   `photo` text,
   `status`         ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
   `created`        datetime NOT NULL,
   `modified`       datetime NOT NULL,
   PRIMARY KEY(`id`),
   KEY `articles_category_id` (`category_id`),
   KEY `articles_created_by` (`created_by`)
)
ENGINE = MyISAM
DEFAULT CHARSET = utf8;

CREATE TABLE `categories`
(
   `id`           int(11) NOT NULL AUTO_INCREMENT,
   `parent_id`    int(11) DEFAULT NULL,
   `title`        varchar(200) DEFAULT NULL,
   `link` text,
   `position`     int(11) DEFAULT NULL,
   `status`       ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
   `created`      datetime DEFAULT NULL,
   `modified`     datetime DEFAULT NULL,
   PRIMARY KEY(`id`),
   KEY `categories_parent_id` (`parent_id`)
)
ENGINE = MyISAM
DEFAULT CHARSET = utf8;

CREATE TABLE `feedback`
(
   `id`          int(11) NOT NULL AUTO_INCREMENT,
   `comments`    text NOT NULL,
   `name`        text NOT NULL,
   `email`       text NOT NULL,
   `website` text,
   `created`     datetime NOT NULL,
   PRIMARY KEY(`id`)
)
ENGINE = MyISAM
DEFAULT CHARSET = utf8;

CREATE TABLE `users`
(
   `id`           int(11) NOT NULL AUTO_INCREMENT,
   `name`         varchar(200) DEFAULT NULL,
   `user_name`    varchar(200) NOT NULL,
   `pass`         varchar(200) NOT NULL,
   `mobile_no`    varchar(20) DEFAULT NULL,
   `email`        varchar(200) NOT NULL,
   `created`      datetime NOT NULL,
   `modified`     datetime NOT NULL,
   `status`       ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
   PRIMARY KEY(`id`)
)
ENGINE = MyISAM
DEFAULT CHARSET = utf8;