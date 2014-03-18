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
	
	<?php

	

	?>

	</div> 

	<div class="module module1">
		<h3>Welcome!</h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sagittis fermentum tellus, vitae iaculis lorem vestibulum a. Suspendisse lobortis dui tristique odio cursus, ut condimentum nisi lacinia.</p>
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
