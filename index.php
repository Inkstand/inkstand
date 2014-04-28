<?php

require_once 'config.php';
require_once DIR . '/core/route/route.class.php';
require_once 'core/lib/addTinymce.php';

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


if(isset($_SERVER['PATH_INFO'])) {
	$routepath = $_SERVER['PATH_INFO'];

	$route = new Route();
	$route->directRoute($routepath);

	die();

} else if ($custom_routepath != "") {
	$route = new Route();
	$route->directRoute($custom_routepath);

	die();

} else { 

	$content = $CORE->getSetting("homepage");

	if(file_exists(DIR . "/components/$content/index.view.php")) {

		require_once DIR . "/components/$content/$content.controller.php";

		// create controller instance from string
		$class = ucwords(strtolower($content)) . "Controller";

		$controller = new $class(null);

		$controller->component = $content;

		if ($content == "homepage") {
			$controller->viewdata->layout = $CORE->getSetting('custom_homepage_layout');
		} else {
			$controller->viewdata->layout = "Homepage";
		}

		$controller->index();

	} else {
		echo "Home page is broken :(";
	}
}

?>