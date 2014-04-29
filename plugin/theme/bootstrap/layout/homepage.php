<?php

require_once 'header.php';

?>

<style type="text/css">
	
	#showcase
	{
		padding-top:35px;
		background-image:url(<?php echo WWW ?>/plugin/theme/bootstrap/image/bg.gif);
		overflow:hidden;
	}
	#showcase h1
	{
		text-shadow:3px 3px 0px rgba(33,33,33,0.3);
		color:#fff;
	}
	#showcase p
	{
		color:#fff;
		font-size:18px;
	}
	#showcase b
	{
		color:#1b4670;
	}
	#showcase > .row
	{
		max-width:1000px;
		margin:auto;
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
	@media (min-width: 768px) 
	{
		#bs-example-navbar-collapse-1 
		{
			padding-top:26px;
		}
	}
	.navbar-toggle
	{
		margin-top:35px;
	}
	#circles 
	{
		background-image:url(<?php echo WWW ?>/plugin/theme/bootstrap/image/inkstand_features_circles.png);
		background-size:100%;
		background-repeat:no-repeat;
		max-width:740px;
		width:100%;
		height:230px;
		margin:20px auto;
	}
	#ipad
	{
		background-image:url(<?php echo WWW ?>/plugin/theme/bootstrap/image/inkstand_ipad.png);
		width:350px;
		height:250px;
		margin:auto;
	}

</style>

<div id="showcase">
	
	
	<div class="row">
		<div class="col-md-6">
			<h1>the CMS you've been waiting for</h1>
			<p><b>Inkstand</b> is the new way to deploy your website</p>
			<p><b>Manage</b> your content - users - products</p>
			<p>Blog, market, and create with user <b>friendly</b> tools</p>
		</div>
		<div class="col-md-6"><div id="ipad"></div></div>
		<div class="col-md-12">
			<hr>
			<h1 style="text-align:center">easy to use, fast content delivery</h1>
		</div>
	</div>
	<div id="circles"></div>

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

