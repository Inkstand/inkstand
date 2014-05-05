<?php

global $CORE;

require_once DIR. '/components/contact/contact.lib.php';

$lib = new ContactLibrary();

if (isset($_POST['submit']) && $_POST['submit'] == 'Send Email') {
	$lib->sendMessage($_POST);
}

?>

<header>
	<h2>Contact Us</h2>
</header>

<div class="content">
	<form method="post" action="#">
		<span class="input-group-addon">Your Name:</span> <input class="form-control" type="text" name="name"><br>
		<span class="input-group-addon">Your Email:</span> <input class="form-control" type="text" name="from_email"><br>
		<span class="input-group-addon">Subject:</span> <input class="form-control" type="text" name="subject"><br>
		<span class="input-group-addon">Message:</span> <textarea style = "min-width: 100%; max-width: 100%;" class="form-control" rows="10" cols="40" name="message"></textarea><br>
		<input class = "btn btn-primary" type="submit" name="submit" value="Send Email">
	</form>
</div>