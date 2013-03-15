<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="content">

<?php include (TEMPLATEPATH . '/searchform.php'); ?>

<h1>Archives by Month:</h1>
	<ul>
		<?php wp_get_archives('type=monthly'); ?>
	</ul>

<h1>Archives by Subject:</h1>
	<ul>
		 <?php wp_list_categories(); ?>
	</ul>

</div>

<?php get_footer(); ?>