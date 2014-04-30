<?php

$CORE->require_capability("Admin");

//get homepage library
require_once DIR. '/components/homepage/homepage.lib.php';

$homelib = new HomepageLibrary();


if($_SERVER['REQUEST_METHOD'] == "POST") {
	$CORE->editHomepage($_POST);
}
	$CORE->tinymce('#homepagecontent');
?>

<h2>Editing Homepage Content</h2>

<form method="post" action="" id="homepageform">
	<div class="form-group">
		<textarea id="homepagecontent" name="content">
			<?php echo $CORE->getSetting('custom_homepage_content'); ?>
		</textarea>
	</div>
	<div class="form-group">
		<label>Select a Layout:</label> 
		<select name = "layout" class="form-control">
		<?php
			$currentLayout = $homelib->getLayout();
			$currenttheme = $CORE->getSetting("currenttheme");
			require_once (DIR . "/plugin/theme/$currenttheme/config.php");
			foreach ($theme_layouts as $layout) {
				if ($layout == $currentLayout) {
					echo "<option selected = 'selected' value = '$layout'>$layout</option>";
				} else {
					echo "<option value = '$layout'>$layout</option>";
				}
			}
		?>
		</select>
	</div>
	
	<div class="form-group">
		<?php

		$slideshow = $CORE->getSetting('homepage_slideshow');

		$yes = '';
		$no = '';

		if($slideshow == 1) {
			$yes = "selected='selected'";
		} else {
			$no = "selected='selected'";
		}

		?>
		<label>Homepage slideshow</label>
		<select name="homepage_slideshow" class="form-control">
			<option <?php echo $yes ?>>Yes</option>
			<option <?php echo $no ?>>No</option>
		</select>
	</div>
</form>

<a class = "btn btn-primary" href="#" onclick="document.getElementById('homepageform').submit();">Update</a>
<a class = "btn btn-default"  href="">Cancel</a>


