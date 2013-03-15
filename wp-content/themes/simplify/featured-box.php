<?php
/* 	Simplify Theme's Featured Box to show the Featured Items of Front Page
	Copyright: 2012, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Simplify 1.0
*/
?>

<div id="featured-boxs">

<span class="featured-box-first"><h2><?php echo of_get_option('featuredr-title', 'Recent Works'); ?></h2><div class="content-ver-sep"></div><br /><p><?php echo of_get_option('featuredr-description', 'The Color changing options of Simplify will give the WordPress Driven Site an attractive look.'); ?></p></span>
<?php 
$fboxclm = array("1","2","3");
foreach ($fboxclm as $fboxn) { ?>
<span class="featured-box"> 
<img class="box-image" src="<?php echo of_get_option('featured-image' . $fboxn, get_template_directory_uri() . '/images/featured-image' . $fboxn . '.jpg') ?>"/>
<h3><?php echo of_get_option('featured-title' . $fboxn, 'Simplify Theme for Small Business'); ?></h3>
<div class="content-ver-sep"></div><br />
<p><?php echo of_get_option('featured-description' . $fboxn , 'The Color changing options of Simplify will give the WordPress Driven Site an attractive look. Simplify is super elegant and Professional Responsive Theme which will create the business widely expressed.'); ?></p>
</span>

<?php }  ?>
</div> <!-- featured-boxs -->