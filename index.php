<?php

// check if installed or not

if(!file_exists('config.php')) {
	header("Location: install.php");
}

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

	if($content == "custom") {
		//lets get content from the database
		$content = $CORE->getSetting('custom_homepage_content');
		$currenttheme = $CORE->getSetting("currenttheme");

		require_once DIR . "/plugin/theme/$currenttheme/layout/header.php";

		?>
		<header>
			<h2><?php echo 'Homepage' ?></h2>
		</header>

		<div class="content">
			<?php echo $CORE->getSetting('custom_homepage_content'); ?>
		</div>

		<footer>

		</footer>
		<?php
		require_once DIR . "/plugin/theme/$currenttheme/layout/footer.php";

	} else if(file_exists(DIR . "/components/$content/index.view.php")) {

		require_once DIR . "/components/$content/$content.controller.php";

		// create controller instance from string
		$class = ucwords(strtolower($content)) . "Controller";

		$controller = new $class(null);

		$controller->component = $content;

		$controller->viewdata->layout = "homepage";

		$controller->index();

	} else {
		echo "Home page is broken :(";
	}
}

?>