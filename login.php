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
		<div class="content">
			<h2>Login Here</h2>
			<?php
				if ($CORE->check_if_logged_in()) {
					echo "you are logged in";
				} else {
					echo "not logged in";
				}
			?>
			<form action = "login.php" method = "post">
				<label>Username:</label> <input type = "text" class = "login_text" name = "username" value = ""/> <br><br>
				<label>Password:</label> <input type = "password" class = "login_text" name = "password" /> <br><br>
				<input type = "submit" name = "submit" value = "Login" />
				<input type = "submit" name = "submit" value = "Logout" />
			</form>
		</div>
	</div> 
</div>

<?php

require_once DIR . '/plugin/theme/foundation/layout/footer.php';

?>

<?php } ?>


<?php

?>