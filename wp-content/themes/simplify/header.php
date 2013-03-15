<?php

/* 	Simplify Theme's Header
	Copyright: 2012, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Simplify 1.0
*/

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title() ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php wp_enqueue_style('simplify-style', get_stylesheet_uri(), false ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> >
  
      <div id ="header">
      <div id ="header-content">
		<!-- Site Titele and Description Goes Here -->
        <a href="<?php echo esc_url( home_url( '/' ) );  ?>"><img class="site-logo" src="<?php header_image(); ?>"/></a>
        <h1 class="site-title-hidden"><?php bloginfo( 'name' ); ?></h1>
		<h2 class="site-title-hidden"><?php bloginfo( 'description' ); ?></h2>
                
        
        <!-- Site Main Menu Goes Here -->
        <nav id="simplify-main-menu">
		<?php if ( has_nav_menu( 'main-menu' ) ) :  wp_nav_menu( array( 'theme_location' => 'main-menu' )); else: wp_page_menu(); endif; ?>
        </nav>
      
      </div><!-- header-content -->
      </div><!-- header -->
      
      
	  