<?php
$CORE = new Core();

$page = $viewdata->page;

if(empty($page)) {
	echo "<h2>404 - Oops!</h2>";
	echo "<p>There doesn't appear to be an article, perhaps it's been moved or the supplied URL is incorrect.</p>";
}

?>

<header>
	<h2><?php echo $page['title'] ?></h2>
	<?php if ($CORE->is_admin() == true) { ?>
		<div class="header-menu">
			<ul>
				<li><a class="fa fa-cog fa-lg" href="<?php echo WWW . '/index.php/admin/edit/page/' . $page['id'] ?>"></a></li>
			</ul>
		</div>
	<?php } ?>
</header>

<div class="content">
	<?php echo $page['content'] ?>
</div>

<footer>

</footer>