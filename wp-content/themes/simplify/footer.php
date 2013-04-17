<?php
/* 	Simplify Theme's Footer
	Copyright: 2012-2013, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Simplify 1.0
*/
?>


</div><!-- container -->
<div id="footer">

<div id="footer-content">

<?php
   	get_sidebar( 'footer' );
?>
<div class="clear"></div>
<div id="creditline"><?php echo of_get_option('copyright', '&copy; ' . date("Y"). ': ' . get_bloginfo( 'name' ) . '  '); simplify_creditline(); ?></div>
</div> <!-- footer-content -->
</div> <!-- footer -->
<?php wp_footer(); ?>
</body>
</html>