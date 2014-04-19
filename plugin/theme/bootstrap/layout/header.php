<!DOCTYPE html>
<html>
<head>
	<title>Joe Conradt</title>
	<meta charset=utf-8 />
	<link rel="stylesheet" type="text/css" href="<?php echo WWW . '/plugin/theme/bootstrap/css/style.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo WWW . '/core/lib/fontawesome/css/font-awesome.css'; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="<?php echo WWW . '/core/lib/jquery/jquery-2.1.0.min.js'; ?>"></script>
	<link rel="stylesheet" href="<?php echo WWW ?>/plugin/theme/bootstrap/css/bootstrap.min.css">
</head>

<body>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<script type="text/javascript">
	jQuery('#my-tab a').click(function (e) {
		e.preventDefault();
		jQuery(this).tab('show');
	})
	</script>

	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>


	<div id="header">
		<?php $CORE->menu(1) ?>
	</div>