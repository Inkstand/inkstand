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
<header>
	<h2>Editing Homepage Content</h2>
</header>
<div class="content">
	<form method="post" action="" id="homepageform">
		<span>
			<textarea id="homepagecontent" name="content">
				<?php echo $CORE->getSetting('custom_homepage_content'); ?>
			</textarea>
		</span>
		<span>
		Select a Layout: 
		<select name = "layout">
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
		</span>
		<br>
		<br>
	</form>
	<a  href="#" onclick="document.getElementById('homepageform').submit();">Update</a>
	<a  href="">Cancel</a>
</div>
	
