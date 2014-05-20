<?php

require_once 'config.php';
require_once DIR . '/core/route/route.class.php';

// *** route ***

if(isset($_SERVER['PATH_INFO'])) {
	$routepath = $_SERVER['PATH_INFO'];
	
	$route = new Route();
	$route->direct_route($routepath);

	die();

} else { ?>

<?php

$currenttheme = $CORE->get_setting("currenttheme");

require_once DIR . "/plugin/theme/$currenttheme/layout/header.php";

?>

<div id="view-content">

	<div class="module" style='margin:auto; width:100%; max-width:400px; float:none; margin-bottom:30px'> 
		<div class="content">
			<h2>Login Here</h2>
			<?php
				if ($CORE->check_if_logged_in()) {
					echo "<div class='alert alert-success'><b>You are logged in</b></div>";
				} else {
					//echo "<div class='alert alert-warning'><b>You are not logged in</b></div>";
				}
			?>
			<form id = "new_account_form" action = "login.php" method = "post" role="form">
				<div class="form-group">
					<label>Username:</label>
					<input type = "text" class = "login_text form-control" name = "username" value = ""/>
				</div>

				<div class="form-group">
					<label>Password:</label> 
					<input type = "password" class = "login_text form-control" name = "password" />
				</div>
				<?php
					if ($CORE->check_if_logged_in()) {
						?>
						<input class='btn btn-primary' type = "submit" name = "submit" value = "Logout" />
						<?php

					} else {
						?>
						<input class='btn btn-primary' type = "submit" name = "submit" value = "Login" />
						<?php

					}
				?>
				
			</form>
		</div>
	</div> 
</div>

<?php

require_once DIR . "/plugin/theme/$currenttheme/layout/footer.php";

?>

<?php } ?>


<?php

?>