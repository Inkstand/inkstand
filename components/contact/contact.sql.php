<?php

require_once 'config.php';

$table = $CORE->getTableFormat("contact");
DB::query("CREATE TABLE IF NOT EXISTS $table (
  `id` INT(7) NOT NULL AUTO_INCREMENT,
  `name` TEXT,
  `value` text,
  PRIMARY KEY  (`id`)
);");
?>