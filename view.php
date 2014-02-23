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

require_once DIR . "/plugin/theme/$currenttheme/layout/" . $VIEW->layout . ".php";

?>

<script type="text/javascript" src="<?php echo WWW ?>/core/lib/jquery/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="<?php echo WWW ?>/core/lib/jqueryflip/jquery.flippy.min.js"></script>
<script type="text/javascript" src="<?php echo WWW ?>/plugin/module/module.js"></script>