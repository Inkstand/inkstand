<?php

require_once 'config.php';

$table = $CORE->getTableFormat("page");
DB::query("CREATE TABLE IF NOT EXISTS $table (
  `id` INT(7) NOT NULL AUTO_INCREMENT,
  `title` tinytext,
  `description` text,
  `content` text,
  `datecreated` int(11) NOT NULL,
  `datemodified` int(11) NOT NULL,
  `usercreatedid` int(11) NOT NULL,
  `usermodifiedid` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
);");

?>