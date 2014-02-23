<?php

require_once 'config.php';

$currenttheme = "foundation";

// view id
$id = $_GET['id'];

$table = $CORE->getTableFormat("view");
$view = DB::queryFirstRow("SELECT * FROM $table WHERE id = %i", $id);

$table = $CORE->getTableFormat("module");
$modules = DB::query("SELECT id, type FROM $table WHERE viewid = %i", $id);

$VIEW = new stdClass();

$VIEW->id = $view['id'];
$VIEW->layout = $view['layout'];
$VIEW->modules = $modules;

require_once DIR . "/core/theme/$currenttheme/layout/" . $VIEW->layout . ".php";

?>