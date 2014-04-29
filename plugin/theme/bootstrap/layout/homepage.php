<?php

require_once 'header.php';

?>

<style type="text/css">
	
	#showcase
	{
		background-image:url(<?php echo WWW ?>/plugin/theme/bootstrap/image/bg.gif);
		height:300px;
	}
	#logo
	{
		background-image:url(<?php echo WWW ?>/plugin/theme/bootstrap/image/inkstand_logo.png);
		background-repeat:no-repeat;
		background-position:center;
		width:240px;
		height:100px;
		color:transparent;
	}
	#header
	{

	}
	.navbar-default
	{
		margin-bottom:0;
	}

</style>

<div id="showcase">

</div>

<div class="container">

	<div class="module module3">
		<header>
			<!-- code for temporary content -->

		</header>
		<div id="content">
			
		</div>
	</div>

	<div class="module module2"> 
	
	<?php

	require_once DIR . "/components/$component/$name.view.php";

	?>

	</div> 

	<div class="module module1">
		<div class="content">
			<h3>Welcome!</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sagittis fermentum tellus, vitae iaculis lorem vestibulum a. Suspendisse lobortis dui tristique odio cursus, ut condimentum nisi lacinia.</p>
		</div>
	</div>

	<div class="module module1">
		<div class="content">
			<h3>Menu</h3>
			<ul>
				<li>Menu logic soon</li>
			</ul>
		</div>
	</div>

</div>

<?php

require_once 'footer.php';

?>

