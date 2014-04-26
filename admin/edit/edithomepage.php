<?php

$CORE->require_capability("Admin");

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$CORE->editHomepage($_POST);
}
	$CORE->tinymce('#homepagecontent');
?>
<header>
	<h2>Editing Article</h2>
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
			/*$currentLayout = $lib->getArticleLayout($id);
			foreach ($theme_layouts as $layout) {
				if ($layout == $currentLayout) {
					echo "<option selected = 'selected' value = '$layout'>$layout</option>";
				} else {
					echo "<option value = '$layout'>$layout</option>";
				}
			}*/
		?>
		</select>
		</span>
		<br>
		<br>
	</form>
	<a  href="#" onclick="document.getElementById('homepageform').submit();">Update</a>
	<a  href="">Cancel</a>
</div>
	
