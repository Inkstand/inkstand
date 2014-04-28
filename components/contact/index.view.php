<?php

global $CORE;

if (isset($_POST['submit']) && $_POST['submit'] == 'Send Email') {
	$lib->sendMessage($_POST);
}

?>

<header>
	<h2><?php echo $CORE->getSetting('site_title');?></h2>
</header>

<div class="content">
	<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
		Your Name: <input type="text" name="name"><br>
		Your Email: <input type="text" name="from_email"><br>
		Subject: <input type="text" name="subject"><br>
		Message: <textarea rows="10" cols="40" name="message"></textarea><br>
		<input type="submit" name="submit" value="Send Email">
	</form>
</div>