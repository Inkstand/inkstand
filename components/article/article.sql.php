<?php

require_once 'config.php';

$table = $CORE->get_table_format("article");
DB::query("CREATE TABLE IF NOT EXISTS $table (
  `id` INT(7) NOT NULL AUTO_INCREMENT,
  `title` TINYTEXT,
  `description` TEXT,
  `content` TEXT,
  `image` TEXT,
  `authorid` INT,
  `layout` TEXT,
  `datecreated` INT(11),
  `datemodified` INT(11),
  PRIMARY KEY  (`id`)
);");

?>