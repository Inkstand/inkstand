<?php

$CORE->require_capability("Admin");

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$CORE->edit_general_settings($_POST);
}
?>
<header>
	<h2>Editing General Settings</h2>
</header>
<div class="content">
	<form method="post" action="" id="settingsform">
		<span class="input-group-addon">Site Title</span> <input class="form-control" type = "text" name = "sitetitle" value = "<?php echo $CORE->get_setting('site_title'); ?>"/> <br>
		<span class="input-group-addon">Select what component the homepage displays</span>
			<select name = "homepage_displays" class="form-control">
			<?php
				$files = scandir(DIR . '/components');
				$currenthome = $CORE->get_setting('homepage');
	        	// loop through all the files and folders
	        	foreach ($files as $file) {	
	        		// if file, skip
	        		if(!is_dir(DIR . '/components/' . $file) || $file == '.' || $file == '..') {
	        			continue;
	        		}
	        		if ($currenthome == $file){
						echo "<option selected = 'selected' value = '$file'>" . ucfirst($file) . "</option>";
	        		} else {
	        			echo "<option value = '$file'>" . ucfirst($file) . "</option>";
	        		}
	        	}
			?>
			</select>
		</div>
		<span class="input-group-addon">Theme Picker</span> <select class="form-control" name = "theme">
			<?php
				$currenttheme = $CORE->get_setting('currenttheme');;
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
	
