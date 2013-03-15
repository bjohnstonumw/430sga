<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type" />
  			<?
			$theTitle=wp_title(" - ", false);
			if($theTitle != "") {
			?>
			<title><?php echo wp_title("",false); ?></title>
			<?
			}
			else{
			?>
			<title><?php bloginfo('name'); ?></title>
			<?
			}
			?>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta http-equiv="cache-control" content="no-cache" />
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
		<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
		<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" type="image/x-icon" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php wp_head(); ?>	
</head>

<body>
<div class="centered">
	<div id="header">

		<h1><?php bloginfo('name'); ?>  |  <font size="2"><?php bloginfo('description'); ?></font></h1>
		<div id="navigation">
			<ul>
				<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
				<?php wp_list_pages('title_li=&depth=0&include=' . $include . '&exclude=' . $exclude); ?>
			</ul>
		</div>
	</div>

	<div id="container">
		<div class="header3"><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/rss.png" border="0" alt="RSS Feed" /></a></div>