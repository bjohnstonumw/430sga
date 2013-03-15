<?php get_header(); ?><?php get_sidebar(); ?>
<div id="content">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<h1><?php the_title(); ?></a></h1>

<?php the_content("<p>__('Read the rest of this page &raquo;')</p>"); ?>
<?php edit_post_link(__('Edit'), '<p>', '</p>'); ?>
<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>