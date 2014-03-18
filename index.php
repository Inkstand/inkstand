<?php

require_once 'config.php';
require_once DIR . '/core/route/route.class.php';

// *** route ***

if(isset($_SERVER['PATH_INFO'])) {
	$routepath = $_SERVER['PATH_INFO'];
	
	$route = new Route();
	$route->directRoute($routepath);

	die();

} else { ?>

<?php

require_once DIR . '/plugin/theme/foundation/layout/header.php';

?>

<div id="view-content">

	<div class="module module2"> 
		<h1 class="big center"><span>portfolio of</span> Joe Conradt</h1>
		<div class="content">
			<hr>
			<p class="center">Programmer&nbsp;&nbsp;<i class="fa fa-code"></i>&nbsp;&nbsp;Web Developer&nbsp;&nbsp;<i class="fa fa-code"></i>&nbsp;&nbsp;Designer</p>
			<h2>Hi there!</h2>
			<p>I'm a guy with a laptop and too many ideas; utilizaing my left and right brain powers. Check out my <a href='index.php/article'>projects</a>!</p> 
		</div>
	</div> 

	<div class="module module1">
		<div class="content">
			<img class="profile" src="<?php echo WWW . '/plugin/theme/foundation/image/joe.jpg'; ?>">
		</div>
		<footer>
			<div class="width33 fa-container">
				<i class="fa fa-phone fa-2x"></i>
			</div>
			<div class="width33 fa-container">
				<i class="fa fa-linkedin-square fa-2x"></i>
			</div>
			<div class="width33 fa-container">
				<i class="fa fa-file-text-o fa-2x"></i>
			</div>
		</footer>
	</div>

	<div class="module module1">
		<h3>Menu</h3>
		<ul>
			<li>Menu logic soon</li>
		</ul>
	</div>

</div>

<?php

require_once DIR . '/plugin/theme/foundation/layout/footer.php';

?>

<?php } ?>
