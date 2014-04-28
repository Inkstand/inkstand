<?php

$CORE->require_capability("Admin");

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$CORE->editgeneralsettings($_POST);
}
?>
<header>
	<h2>Editing General Settings</h2>
</header>
<div class="content">
	<form method="post" action="" id="settingsform">
		<span class="input-group-addon">Site Title</span> <input class="form-control" type = "text" name = "sitetitle" value = "<?php echo $CORE->getSetting('site_title'); ?>"/> <br>
		<span class="input-group-addon">Theme Picker</span> <select class="form-control" name = "theme">
			<?php
				$currenttheme = $CORE->getSetting('currenttheme');;
				if ($handle = opendir(DIR . '/plugin/theme')) {
				    $blacklist = array('.', '..', 'theme.php');
				    while (false !== ($file = readdir($handle))) {
				        if (!in_array($file, $blacklist)) {
				        	if ($currenttheme == $file) {
				        		echo "<option selected = \'selected\' value = $file>$file</option>";
				        	} else {
				        		echo "<option value = $file>$file</option>";
				        	} 
				        }
				    }
				    closedir($handle);
				}
			?>
		</select> <br>



		
	</form>
	<a class="btn btn-primary" href="#" onclick="document.getElementById('settingsform').submit();">Update</a>
	<a class="btn btn-default" href="">Cancel</a>
</div>
	
