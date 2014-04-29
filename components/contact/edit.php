<?php
require_once DIR. '/components/contact/contact.lib.php';

$lib = new ContactLibrary();

if($_SERVER['REQUEST_METHOD'] == "POST") {

	$lib->setEmailTo($_POST);

}


?>

<header>
	<h2>Contact Component Settings</h2>
</header>
<div class="content">
	<form method="post" action="" id="settingsform">
		<span class="input-group-addon">Email Addresses</span> <input class="form-control" type = "text" name = "emailto" value = "<?php echo $lib->getEmailTo(); ?>"/><br>
	</form>
	<a class="btn btn-primary" href="#" onclick="document.getElementById('settingsform').submit();">Update</a>
	<a class="btn btn-default" href="">Cancel</a>
</div>
	
