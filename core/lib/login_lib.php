<?php
session_start();

function check_if_logged_in(){
	if (isset($_SESSION['user'])) {
		//user is logged in (lets check all the credentials)
		//echo $_SESSION['user'];

		//lets verify the login user with the login table
		$login_results = DB::query("Select id, userid, user_ip, user_ip_2, last_action FROM logins");
		$verified_login = false;
		foreach ($login_results as $i)
		{
			if ($_SESSION['user'] == hash('ripemd160', $i['id'])) {
				//found the record we are looking for based on the id. Now, we must verify the ip, and then update the last action column
				if ($_SERVER['REMOTE_ADDR'] == $i['user_ip']) {
					//first ip is correct. check if 2nd is set. Then verify it.
					if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
						if ($_SERVER['HTTP_X_FORWARDED_FOR'] == $i['user_ip_2']) {
							$verified_login = true;
						}
					} else {
						if ($_SERVER['REMOTE_ADDR'] == $i['user_ip_2']) {
							$verified_login = true;
						}
					}
				}
			}
			if ($verified_login) { //lets update the last action column
				/*DB::replace('logins', array(
				  'id' => $i["id"],
				  'last_action' => time()
				));*/
				DB::update('logins', array(
				'last_action' => time()
				), "id=%s", $i["id"]);
				echo "You are logged in";

			}
		}

		if (!$verified_login) {
			//account is not verified correctly. We must unset the session
			session_destroy();
		}

		return $verified_login;
	}
}

function handle_submit($submit_value) 
{
	if ($submit_value == "Login") {
		login_user();
	} else if ($submit_value = "Logout") {
		logout_user();
	}
}

function login_user()
{
	echo "form was submitted";
	$form_filled = true;

	//a way to set default values
	if (isset($_POST['username']) && $_POST['username'] != "") 
	{
		$username = $_POST["username"];
	} else
	{
		$username = "";
		$form_filled = false;
	}
	if (isset($_POST['password']) && $_POST['password'] != "") 
	{
		$password = $_POST["password"];
	} else
	{
		$password = "";
		$form_filled = false;
	}

	if ($form_filled)
	{
		$results = DB::query("SELECT id, username, password FROM users");
		foreach ($results as $row) {
			if ($row['username'] == $username)
			{
				if (password_verify($password, $row['password']))
				{
					echo "Login Correct";
					$logged_in = true;
					//$_SESSION['user'] = $row['id'];

					/*Add login to logins table*/
					$userid = $row['id'];
					$userip = $_SERVER['REMOTE_ADDR'];
					if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
						$userip2 = $_SERVER['HTTP_X_FORWARDED_FOR'];
					} else {
						$userip2 = $userip;
					}
					
					$current_time = time();

					DB::insert('logins', array(
					  'userid' => $userid,
					  'user_ip' => $userip,
					  'user_ip_2' => $userip2,
					  'last_action' => $current_time
					));

					//now, lets get the id of the session, hash it, and save it in the session variable
					$login_results = DB::query("Select * FROM logins");
					foreach ($login_results as $i)
					{
						if ($i['userid'] == $userid && $i['user_ip'] == $userip && $i['user_ip_2'] == $userip2 && $i['last_action'] == $current_time) {
							echo "found the record";
							$_SESSION['user'] = hash('ripemd160', $i['id']);
						}
					}




					break;
				}
			} else
			{
				//echo "Username or Password not correct";
				$logged_in = false;
			}
		}
	}
}

function logout_user()
{
	$logged_in = check_if_logged_in();
	$userid;
	if ($logged_in)
	{
		$current_logs = DB::query("Select id, userid, user_ip, user_ip_2, last_action FROM logins");
		foreach ($current_logs as $i)
		{
			if ($_SESSION['user'] == hash('ripemd160', $i['id'])) {
				//found the record we are looking for based on the id. Now, we must verify the ip, and then update the last action column
				$userid = $i['userid'];
			}
		}
		if ($userid != "") {
			DB::delete('logins', "userid=%i", "$userid");
		}
	//	session_destroy();
	} else
	{
		//don't log user out. Something fishy might be happening here
	}

	
}


?>