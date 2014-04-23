<?php

require_once 'config.php';

$table = $CORE->getTableFormat("article");
DB::query("CREATE TABLE IF NOT EXISTS $table (
  `id` INT(7) NOT NULL AUTO_INCREMENT,
  `title` TINYTEXT,
  `description` TEXT,
  `content` TEXT,
  `image` TEXT,
  `authorid` INT,
  `layout` TEXT,
  PRIMARY KEY  (`id`)
);");

?>