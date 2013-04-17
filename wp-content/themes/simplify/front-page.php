<?php
/*
	Template Name: Front Page
	Simplify Theme's Front Page to Display the Home Page if Selected
	Copyright: 2012-2013, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Simplify 1.0
*/
 
get_header(); ?>
<div id="header-bottom"> </div>
<div id="container">
<h1 id="heading"><?php echo of_get_option('heading-text', 'Welcome to the World of Creativity!'); ?></h1>
<p class="heading-desc"><?php echo of_get_option('heading-des', 'WordPress is web software you can use to create a beautiful website or blog. We like to say that WordPress is both free and priceless at the same time.'); ?></p>

<div id="slide-container">
<div id="slide">
<img src="<?php echo of_get_option('banner-image', get_template_directory_uri() . '/images/slide-image/slide-image1.jpg'); ?>"/>
</div>
</div> <!-- slide-container -->


<?php get_template_part( 'featured-box' ); ?>

<div class="clear"></div><div class="lsep"></div>

<?php if (of_get_option('fpost', '0') != '1'): if ( 'posts' == get_option( 'show_on_front' ) ): get_template_part( 'blog' ); endif; endif;?> 

<?php if ( of_get_option('bottom-quotation', 'All the developers of D5 Creation have come from the disadvantaged part or group of the society. All have established themselves after a long and hard struggle in their life ----- D5 Creation Team') != '' ) : ?>

<div id="customers-comment">
<blockquote><?php echo of_get_option('bottom-quotation', 'All the developers of D5 Creation have come from the disadvantaged part or group of the society. All have established themselves after a long and hard struggle in their life ----- D5 Creation Team'); ?></blockquote>
</div>
<?php endif; ?>

<?php get_footer(); ?>