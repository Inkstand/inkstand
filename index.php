<?php

require_once 'config.php';
require_once DIR . '/core/route/route.class.php';
require_once 'core/lib/addTinymce.php';

// *** route ***

if(isset($_SERVER['PATH_INFO'])) {
	$routepath = $_SERVER['PATH_INFO'];
	
	$route = new Route();
	$route->directRoute($routepath);

	die();

} else { ?>

<?php
$CORE->require_login();
require_once DIR . '/plugin/theme/foundation/layout/header.php';

?>


<script type="text/javascript">
		
	jQuery('#my-tab a').click(function (e) {
  e.preventDefault();
  jQuery(this).tab('show');
})
</script>
<div id="view-content">

	<div class="module module2"> 
		<h1 class="big center"><span>portfolio of</span> Joe Conradt</h1>
		<div class="content">
			<hr>
			<p class="center">Programmer&nbsp;&nbsp;<i class="fa fa-code"></i>&nbsp;&nbsp;Web Developer&nbsp;&nbsp;<i class="fa fa-code"></i>&nbsp;&nbsp;Designer</p>
			<h2>Hi there!</h2>
			<p>I'm a guy with a laptop and too many ideas; utilizaing my left and right brain powers. Check out my <a href='index.php/article'>projects</a>!</p> 
			<img style="max-width:640px;width:100%;display:block;margin:auto" src="http://file.kelleybluebookimages.com/kbb//vehicleimage/evoxseo/xxl/8195/2013-ford-taurus-front-angle3_8195_089_640x480.jpg">
		</div>
	</div> 

	<div class="module module1">
		<div class="content">
			<img class="profile" src="<?php echo WWW . '/plugin/theme/foundation/image/joe.jpg'; ?>">
		</div>
		<footer>
			<a href="" class="width33 fa-container">
				<i class="fa fa-phone fa-2x"></i>
			</a>
			<a href="" class="width33 fa-container">
				<i class="fa fa-linkedin-square fa-2x"></i>
			</a>
			<a href="" class="width33 fa-container">
				<i class="fa fa-file-text-o fa-2x"></i>
			</a>
		</footer>
	</div>

	<div class="module module1 quick-facts">
		<div class="content">
			<h3>Quick Facts</h3>
			<div class="width100">
				<span>print</span>
				<select>
					<option>Choose method</option>
					<option value="1">getFavLanguage()</option>
					<option value="2">getResume()</option>
				</select>
				<span>;</span>
			</div>
			<div class="placeholder">
				<p>Run a method to print out some quick info about me!</p>
			</div>
		</div>
		<footer>
			<div class="width100">
				
			</div>
		</footer>
	</div>

</div>

<?php

require_once DIR . '/plugin/theme/foundation/layout/footer.php';

?>

<?php } ?>
