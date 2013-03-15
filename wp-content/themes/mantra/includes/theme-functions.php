<?php
/**
 * Misc functions breadcrumbs / pagination / transient data /back to top button
 *
 * @package mantra
 * @subpackage Functions
 */


 /**
 * Loads necessary scripts
 * Adds HTML5 tags for IE8
 * Used in header.php
*/
 function mantra_header_scripts() {
 $mantra_options= mantra_get_theme_options();
foreach ($mantra_options as $key => $value) {
     ${"$key"} = $value ;
}
?>
<!--[if lt IE 9]>
<script>
document.createElement('header');
document.createElement('nav');
document.createElement('section');
document.createElement('article');
document.createElement('aside');
document.createElement('footer');
document.createElement('hgroup');
</script>
<![endif]-->
<script type="text/javascript">
function makeDoubleDelegate(function1, function2) {
// concatenate functions
    return function() { if (function1) function1(); if (function2) function2(); }
}

function mantra_onload() {
     // Add custom borders to images
     jQuery("img.alignnone, img.alignleft, img.aligncenter,  img.alignright").addClass("<?php echo 'image'.$mantra_image;?>");
<?php if ($mantra_mobile=="Enable") { // If mobile view is enabled ?>
	jQuery(function () {
	// Add select navigation to small screens
     jQuery("#access .menu ul:first-child").tinyNav({
          	header: false // Show header instead of the active item
			});
	});
     // Add responsive videos
     if (jQuery(window).width() < 800) jQuery(".entry-content").fitVids();
<?php }
if (($mantra_s1bg || $mantra_s2bg) ) { ?>
     // Check if sidebars have user colors and if so equalize their heights
     equalizeHeights();<?php } ?>
}; // mantra_onload

// make sure not to lose previous onload events
window.onload = makeDoubleDelegate(window.onload, mantra_onload );
</script>
<?php
}

add_action('wp_head','mantra_header_scripts',100);


/**
 * Creates invisible div over header making it link to home page
 * Used in header.php
*/
 function mantra_link_header() {
echo '<a href="'.home_url( '/' ).'" id="linky"> </a>' ;

}


if ($mantra_options['mantra_linkheader']=="Enable") add_action('cryout_branding_hook','mantra_link_header');



 /**
 * Adds title and description to heaer
 * Used in header.php
*/
 function mantra_title_and_description() {
 // Site Title
  $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
  echo '<'.$heading_tag.' id="site-title">';
  echo '<span> <a href="'.home_url( '/' ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">'.get_bloginfo( 'name' ).'</a> </span>';
  echo '</'.$heading_tag.'>';
  // Site Description
  echo '<div id="site-description" >'.get_bloginfo( 'description' ).'</div>';
}


add_action ('cryout_branding_hook','mantra_title_and_description');

 /**
 * Add social icons in header / undermneu left / undermenu right / footer
 * Used in header.php and footer.php
*/
 function mantra_header_socials() {
 mantra_set_social_icons('sheader');
 }

  function mantra_smenul_socials() {
 mantra_set_social_icons('smenul');
 }

  function mantra_smenur_socials() {
 mantra_set_social_icons('smenur');
 }

   function mantra_footer_socials() {
 mantra_set_social_icons('sfooter');
 }

if($mantra_socialsdisplay0) add_action('cryout_branding_hook', 'mantra_header_socials');
if($mantra_socialsdisplay1) add_action('cryout_forbottom_hook', 'mantra_smenul_socials');
if($mantra_socialsdisplay2) add_action('cryout_forbottom_hook', 'mantra_smenur_socials');
if($mantra_socialsdisplay3) add_action('cryout_footer_hook', 'mantra_footer_socials',13);


if ( ! function_exists( 'mantra_set_social_icons' ) ) :
/**
 * Social icons function
 */
function mantra_set_social_icons($id) {
	global $mantra_options;
		foreach ($mantra_options as $key => $value) {
		${"$key"} = $value ;
					}
echo '<div class="socials" id="'.$id.'">';
for ($i=1; $i<=9; $i+=2) {
	$j=$i+1;
	if ( ${"mantra_social$j"} ) {?>
		<a target="_blank" rel="nofollow" href="<?php echo esc_url(${"mantra_social$j"}); ?>" class="socialicons social-<?php echo esc_attr(${"mantra_social$i"}); ?>" title="<?php echo esc_attr(${"mantra_social$i"}); ?>"><img alt="<?php echo esc_attr(${"mantra_social$i"}); ?>" src="<?php echo get_template_directory_uri().'/images/socials/'.${"mantra_social$i"}.'.png'; ?>" /></a><?php
				}
		}
echo '</div>';
}
endif;

// Get any existing copy of our transient data
if ( false === ( $mantra_theme_info = get_transient( 'mantra_theme_info' ) ) ) {
    // It wasn't there, so regenerate the data and save the transient
 if ( ! function_exists( 'get_custom_header' ) ) {  $mantra_theme_info = get_theme_data( get_theme_root() . '/mantra/style.css' ); }
else { $mantra_theme_info = wp_get_theme( );}

     set_transient( 'mantra_theme_info',  $mantra_theme_info ,60*60);
}



  /**
 * Replaces header image with featured image if there is one for single pages
 * Used in header.php
*/
function mantra_header_featured_image() {
global $post;
global $mantra_options;
foreach ($mantra_options as $key => $value) {
${"$key"} = $value ;
}
// Check if this is a post or page, if it has a thumbnail, and if it's a big one
if ( is_singular() && has_post_thumbnail( $post->ID ) && $mantra_fheader == "Enable" &&
	(  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
	$image[1] >= HEADER_IMAGE_WIDTH ) :
	// Houston, we have a new header image!
	//echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array(HEADER_IMAGE_WIDTH,HEADER_IMAGE_HEIGHT) );
endif;
}


add_action ('cryout_branding_hook','mantra_header_featured_image');


/**
 * Mantra back to top button
 * Creates div for js
*/
function mantra_back_top() {
  echo '<div id="toTop"> </div>';
  }


if ($mantra_backtop=="Enable") add_action ('cryout_body_hook','mantra_back_top');



 /**
 * Creates breadcrumns with page sublevels and category sublevels.
 */
function mantra_breadcrumbs() {
$mantra_options= mantra_get_theme_options();
foreach ($mantra_options as $key => $value) {
     ${"$key"} = $value ;
}
global $post;
echo '<div class="breadcrumbs">';
if (is_page() && !is_front_page() || is_single() || is_category() || is_archive()) {
        echo '<a href="'.get_bloginfo('url').'">'.get_bloginfo('name').' &raquo; </a>';

        if (is_page()) {
            $ancestors = get_post_ancestors($post);

            if ($ancestors) {
                $ancestors = array_reverse($ancestors);

                foreach ($ancestors as $crumb) {
                    echo '<a href="'.get_permalink($crumb).'">'.get_the_title($crumb).' &raquo; </a>';
                }
            }
        }

        if (is_single()) {
       if(has_category())    { $category = get_the_category();
            echo '<a href="'.get_category_link($category[0]->cat_ID).'">'.$category[0]->cat_name.' &raquo; </a>';
								}
        }

        if (is_category()) {
            $category = get_the_category();
            echo ''.$category[0]->cat_name.'';
        }



        // Current page
        if (is_page() || is_single()) {
            echo ''.get_the_title().'';
        }
        echo '';
    } elseif (is_home() && $mantra_frontpage!="Enable" ) {
        // Front page
        echo '';
        echo '<a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a> '."&raquo; ";
        _e('Home Page','mantra');
        echo '';
    }
echo '</div>';
}


if($mantra_breadcrumbs=="Enable")  add_action ('cryout_breadcrumbs_hook','mantra_breadcrumbs');


if ( ! function_exists( 'mantra_pagination' ) ) :
/**
 * Creates pagination for blog pages.
 */
function mantra_pagination($pages = '', $range = 2, $prefix ='')
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
		echo "<div class='pagination_container'><nav class='pagination'>";
         if ($prefix) {echo "<span id='paginationPrefix'>$prefix </span>";}
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</nav></div>\n";
     }
}
endif;


/**
 * Site info
 */
function mantra_site_info() {
$mantra_options= mantra_get_theme_options();
foreach ($mantra_options as $key => $value) {
     ${"$key"} = $value ;
}	?>
	<div id="site-info" >
		<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<?php bloginfo( 'name' ); ?></a> | <?php _e('Powered by','mantra')?> <a href="<?php echo 'http://www.cryoutcreations.eu';?>" title="<?php echo 'Mantra Theme by '.
			'Cryout Creations';?>"><?php echo 'Mantra' ?></a> &amp; <a href="<?php echo esc_url('http://wordpress.org/' ); ?>"
			title="<?php esc_attr_e('Semantic Personal Publishing Platform', 'mantra'); ?>"> <?php printf(' %s.', 'WordPress' ); ?>
		</a>
	</div><!-- #site-info -->
<?php }

add_action('cryout_footer_hook','mantra_site_info',12);


/**
 * Copyright text
 */
function mantra_copyright() {
$mantra_options= mantra_get_theme_options();
foreach ($mantra_options as $key => $value) {
     ${"$key"} = $value ;
	 }
	echo '<div id="site-copyright">'.$mantra_copyright.'</div>';
}


if ($mantra_copyright != '') add_action('cryout_footer_hook','mantra_copyright',11);

add_action('wp_ajax_nopriv_do_ajax', 'mantra_ajax_function');
add_action('wp_ajax_do_ajax', 'mantra_ajax_function');

if ( ! function_exists( 'mantra_ajax_function' ) ) :

function mantra_ajax_function(){
ob_clean();

   // the first part is a SWTICHBOARD that fires specific functions
   // according to the value of Query Var 'fn'

     switch($_REQUEST['fn']){
          case 'get_latest_posts':
               $output = mantra_ajax_get_latest_posts($_REQUEST['count'],$_REQUEST['categName']);
          break;
          default:
              $output = 'No function specified, check your jQuery.ajax() call';
          break;

     }

   // at this point, $output contains some sort of valuable data!
   // Now, convert $output to JSON and echo it to the browser
   // That way, we can recapture it with jQuery and run our success function

          $output=json_encode($output);
         if(is_array($output)){
        print_r($output);
         }
         else{
        echo $output;
         }
         die;
}
endif;

if ( ! function_exists( 'mantra_ajax_get_latest_posts' ) ) :
function mantra_ajax_get_latest_posts($count,$categName){
 $testVar='';
// The Query
query_posts( 'category_name='.$categName);
// The Loop
if ( have_posts() ) : while ( have_posts() ) : the_post();
$testVar .=the_title("<option>","</option>",0);
endwhile; else: endif;

// Reset Query
wp_reset_query();

return $testVar;
}
endif;
?>