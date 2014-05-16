<?php

// check if installed or not

if(!file_exists('config.php')) {
	header("Location: install.php");
}

require_once 'config.php';
require_once DIR . '/core/route/route_improved.class.php';
require_once 'core/lib/addTinymce.php';
require_once DIR . '/components/controller.php';
require_once DIR . '/components/component.class.php';
require_once DIR . '/plugin/theme/thememanager.class.php';

// *** route ***
//echo WWW;
$pageURL = 'http';
 if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 //echo "<br>" . $pageURL;
 $custom_routepath = "";

 if (WWW . "/" != $pageURL && WWW . "/index.php" != $pageURL) {
 	//echo "custom page";
 	$custom_routepath = str_replace(WWW, '', $pageURL) . "/";
 	//echo "cutstom route is   " . $custom_routepath;
 } else {
 	//echo "regular page";
 }


// path_info. Example: domain.com/index.php/course/index/3 
//                                         ^             ^
// ----------------------------------------^-------------^

$routepath = (isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : 'application/index');  

$route = new Route();
$route->parse_route($routepath);

$controller = $route->get_controller();

$route->invoke_action($controller, $route->action);

?>