<?php

require_once 'config.php';

$table = $CORE->get_table_format("contact");
DB::query("CREATE TABLE IF NOT EXISTS $table (
  `id` INT(7) NOT NULL AUTO_INCREMENT,
  `name` TEXT,
  `value` text,
  PRIMARY KEY  (`id`)
);");

DB::insert($table, array(
  'name' => 'email_to',
  'value' => ''
));
?>