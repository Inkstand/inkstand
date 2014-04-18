<?php

require_once 'header.php';

?>

<div id="view-content">

	<div class="module module3">
		<header>
			<h1>ModularCMS</h1>
		</header>
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

