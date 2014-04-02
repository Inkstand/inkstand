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
	//detect form submission
	if (isset($_POST['submit']))
	{
		echo "form was submitted";
		$form_filled = true;

		//a way to set default values
		if (isset($_POST['firstname']) && $_POST['firstname'] != "") 
		{
			$firstname = $_POST["firstname"];
		} else
		{
			$firstname = "";
			$form_filled = false;
		}

		if (isset($_POST['lastname']) && $_POST['lastname'] != "") 
		{
			$lastname = $_POST["lastname"];
		} else
		{
			$lastname = "";
			$form_filled = false;
		}

		if (isset($_POST['email']) && $_POST['email'] != "") 
		{
			$email = $_POST["email"];
		} else
		{
			$email = "";
			$form_filled = false;
		}

		if (isset($_POST['username']) && $_POST['username'] != "") 
		{
			$username = $_POST["username"];
		} else
		{
			$username = "";
			$form_filled = false;
		}

		if (isset($_POST['password']) && $_POST['password'] != "") {
			$password = $_POST["password"];
		} else 
		{
			$password = "";
			$form_filled = false;
		}

		if (isset($_POST['re_password']) && $_POST['re_password'] != "") {
			$repassword = $_POST["re_password"];
		} else 
		{
			$repassword = "";
			$form_filled = false;
		}

		if ($password != $repassword){
			$form_filled = false;
		}

		//if form is filled, lets sanitize and insert into database
		if ($form_filled == true) {
			/*$firstname = mysqli_real_escape_string($connection, $firstname);
			$lastname = mysqli_real_escape_string($connection, $lastname);
			$username = mysqli_real_escape_string($connection, $username);
			$email = mysqli_real_escape_string($connection, $email);
			$password = mysqli_real_escape_string($connection, $password);
*/
			$password = password_hash($password, PASSWORD_DEFAULT);

			// Perform database query
			$query = "INSERT INTO users (username, password, f_name, l_name, useremail) VALUES ('{$username}', '{$password}', '{$firstname}', '{$lastname}', '{$email}')";

			//testing password verify
			/*if (password_verify("Jack", $password)) {
			    echo "correct pass";
			}
			else {
			    echo "incorrect pass";
			}*/
			
			//$result = mysqli_query($connection, $query);
			$results = DB::query($query);
			//test if there was a query error
			/*if ($result) {
				//success
				// redirect_to(some page);
				echo "Success!";
			} else {
				//Failure
				//message subject creation failed
				die("Database query failed. " . mysqli_error($connection));
			}*/
		} else {

		}
		
	}else
	{ //set defaults
		$username = "";
		$firstname = "";
		$lastname = "";
		$email = "";
	}
?>

<?php

require_once DIR . '/plugin/theme/foundation/layout/header.php';

?>

<div id="view-content">

	<div class="module module2"> 
		<div class="content">
			<h2>New Account</h2>
			<form action = "new_account.php" method = "post">
				First Name:       <input type = "text" name = "firstname" value = "<?php echo htmlspecialchars($firstname); ?>"/> <br><br>
				Last Name:        <input type = "text" name = "lastname" value = "<?php echo htmlspecialchars($lastname); ?>"/> <br><br>
				Email:            <input type = "text" name = "email" value = "<?php echo htmlspecialchars($email); ?>"/> <br><br><br>

				Create Username:  <input type = "text" name = "username" value = "<?php echo htmlspecialchars($username); ?>"/> <br><br>
				Create Password:  <input type = "password" name = "password" /> <br><br>
				Re_Type Password: <input type = "password" name = "re_password" /> <br><br><br>

				<input type = "submit" name = "submit" value = "Create Account" />

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