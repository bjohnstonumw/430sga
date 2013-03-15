<?php
/* 	Simplify Theme's Functions
	Copyright: 2012, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Simplify 1.0
*/
   
  
  	add_theme_support( 'automatic-feed-links' );
  	register_nav_menus( array( 'main-menu' => "Main Menu" ) );

//	Set the content width based on the theme's design and stylesheet.
	if ( ! isset( $content_width ) ) $content_width = 584;

// Load the D5 Framework Optios Page
	if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
	}

// 	Tell WordPress for wp_title in order to modify document title content
	function simplify_filter_wp_title( $title ) {
    $site_name = get_bloginfo( 'name' );
    $filtered_title = $site_name . $title;
    return $filtered_title;
	}
	add_filter( 'wp_title', 'simplify_filter_wp_title' );


// 	Tell WordPress for the Feed Link
	add_editor_style();
	add_theme_support( 'automatic-feed-links' );
	
// 	This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ); // default Post Thumbnail dimensions (cropped)

	// additional image sizes
	// delete the next line if you do not need additional image sizes
	add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
	}
	
		
// 	WordPress 3.4 Custom Background Support	
	$simplify_custom_background = array( 'default-color' => 'ffffff', );
	add_theme_support( 'custom-background', $simplify_custom_background );
	
// 	WordPress 3.4 Custom Header Support				
	$simplify_custom_header = array(
	'default-image'          => get_template_directory_uri() . '/images/logo.png',
	'random-default'         => false,
	'width'                  => 300,
	'height'                 => 90,
	'flex-height'            => true,
	'flex-width'             => true,
	'default-text-color'     => 'AAAAAA',
	'header-text'            => false,
	'uploads'                => True,
	'wp-head-callback' 		 => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $simplify_custom_header );

// 	Functions for adding script
	function simplify_enqueue_scripts() { ?>
	<!--[if lt IE 9]>
	<?php wp_enqueue_script( 'html5forie', get_template_directory_uri(). '/js/html5.js'); ?>
	<![endif]-->
	<?php
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
		wp_enqueue_script( 'comment-reply' ); 
	}
	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'd5corporate-menu-style', get_template_directory_uri(). '/js/menu.js' );
	wp_enqueue_style('d5corporate-gfonts1', 'http://fonts.googleapis.com/css?family=Poiret+One', false );
	wp_enqueue_style('d5corporate-gfonts2', 'http://fonts.googleapis.com/css?family=Anaheim', false );
	}
	add_action( 'wp_enqueue_scripts', 'simplify_enqueue_scripts' );


// 	Functions for adding some custom code within the head tag of site
	function simplify_custom_code() {
?>
	
	<style type="text/css">
	.site-title a, 
	.site-title a:active, 
	.site-title a:hover {
	
	color: #<?php echo get_header_textcolor(); ?>;
	}
	</style>
		
<?php 
	}
	
	add_action('wp_head', 'simplify_custom_code');
	
//	function tied to the excerpt_more filter hook.
	function simplify_excerpt_length( $length ) {
	global $simplifyExcerptLength;
	if ($simplifyExcerptLength) {
    return $simplifyExcerptLength;
	} else {
    return 50; //default value
    } }
	add_filter( 'excerpt_length', 'simplify_excerpt_length', 999 );
	
	function simplify_excerpt_more($more) {
       global $post;
	return '<a href="'. get_permalink($post->ID) . '" class="read-more">Read More...</a>';
	}
	add_filter('excerpt_more', 'simplify_excerpt_more');
	
	// Content Type Showing
	function simplify_content() { the_content('<span class="read-more">Read More...</span>'); }
	function simplify_creditline() { echo '<span class="credit">| Simplify Theme by: <a href="http://d5creation.com" target="_blank"><img  src="' . get_template_directory_uri() . '/images/d5logofooter.png" /> D5 Creation</a> | Powered by: <a href="http://wordpress.org" target="_blank">WordPress</a></span>'; }
	
//	Registers the Widgets and Sidebars for the site
	function simplify_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Primary Sidebar', 'simplify' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Secondary Sidebar', 'simplify' ),
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	 
	register_sidebar( array(
		'name' => __( 'Footer Area One', 'simplify' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'simplify' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	    
	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'simplify' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'simplify' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'simplify' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site footer', 'simplify' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	register_sidebar( array(
		'name' => __( 'Footer Area Four', 'simplify' ),
		'id' => 'sidebar-6',
		'description' => __( 'An optional widget area for your site footer', 'simplify' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	}
	add_action( 'widgets_init', 'simplify_widgets_init' );
	
	
	add_filter('the_title', 'simplify_title');
	function simplify_title($title) {
        if ( '' == $title ) {
            return '(Untitled)';
        } else {
            return $title;
        }
    }
	
//	Remove WordPress Custom Header Support for the theme Simplify
//	remove_theme_support('custom-header');