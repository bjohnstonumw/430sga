<?php
/**
 * Simplify Options Page
 * @ Copyright: D5 Creation, All Rights, www.d5creation.com
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = 'simplify';
	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}
function optionsframework_options() {
	
		
	$options[] = array(
		'name' => 'Simplify Options', 
		'type' => 'heading');
	
	$options[] = array(
		'desc' => '<span class="donation">If you like this FREEE Theme You can consider for a small Donation to us. Your Donation will be spent for the Disadvantaged Children and Students. You can visit our <a href="http://d5creation.com/donate/" target="_blank"><strong>DONATION PAGE</strong></a> and Take your decision.</span><br /><br /><span class="donation"> Need More Features and Options including Exciting 3D Slide and 100+ Advanced Features? Try <a href="http://d5creation.com/theme/simplify/" target="_blank"><strong>Simplify Extend</strong></a>.</span><br /> <br /><span class="donation"> You can Visit the Simplify Extend Demo <a href="http://demo.d5creation.com/wp/themes/simplify/" target="_blank"><strong>Here</strong></a>.</span>',
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Front Page Heading', 
		'desc' => 'Input your heading text here.  Please limit it within 30 Letters.', 
		'id' => 'heading-text',
		'std' => 'Welcome to the World of Creativity!',
		'type' => 'text');
		
	$options[] = array(
		'name' => 'Front Page Heading Description', 
		'desc' => 'Input your heading description here. Please limit it within 100 Letters.', 
		'id' => 'heading-des',
		'std' => 'WordPress is web software you can use to create a beautiful website or blog. We like to say that WordPress is both free and priceless at the same time.',
		'type' => 'textarea');	
	
	$options[] = array(
		'name' => 'Banner Image', 
		'desc' => 'Upload an image for the Front Page Banner. 930px X 350px image is recommended.', 
		'id' => 'banner-image',
		'std' => get_template_directory_uri() . '/images/slide-image/slide-image1.jpg',
		'type' => 'upload');
			
	
	$options[] = array(
		'name' => 'Quote Text', 
		'desc' => 'Input your Quotation here. Plese limit it within 150 Letters.', 
		'id' => 'bottom-quotation',
		'std' => 'All the developers of D5 Creation have come from the disadvantaged part or group of the society. All have established themselves after a long and hard struggle in their life ----- D5 Creation Team',
		'type' => 'textarea');


// Front Page Fearured Boxs
		
	$options[] = array(
		'desc' => '<span class="featured-area-title">Featured Boxs</span>', 
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Row Subject', 
		'desc' => 'Input your Row Title Here.', 
		'id' => 'featuredr-title',
		'std' => 'Recent Works',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Row Description', 
		'desc' => 'Input the description of Featured Areas. Please limit the words within 30 so that the layout should be clean and attractive.', 
		'id' => 'featuredr-description',
		'std' => 'The Color changing options of Simplify will give the WordPress Driven Site an attractive look.',
		'type' => 'textarea');
		
		
	$fbsin=array("1","2","3");
	foreach ($fbsin as $fbsinumber) {
	
	$options[] = array(
		'desc' => '<b>FEATURED BOX: 0' . $fbsinumber . '</b>',
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Image', 
		'desc' => 'Upload an image for the Featured Box. 200px X 100px image is recommended.  If you do not want to show anything here leave the box blank.', 
		'id' => 'featured-image' . $fbsinumber,
		'std' => get_template_directory_uri() . '/images/featured-image' . $fbsinumber . '.jpg',
		'type' => 'upload');	
	
	$options[] = array(
		'name' => 'Title', 
		'desc' => 'Input your Featured Title here. Please limit it within 30 Letters. If you do not want to show anything here leave the box blank.', 
		'id' => 'featured-title' . $fbsinumber,
		'std' => 'Simplify Theme for Small Business',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Description', 
		'desc' => 'Input the description of Featured Areas. Please limit the words within 30 so that the layout should be clean and attractive.', 
		'id' => 'featured-description' . $fbsinumber,
		'std' => 'The Color changing options of Simplify will give the WordPress Driven Site an attractive look. Simplify is super elegant and Professional Responsive Theme which will create the business widely expressed.',
		'type' => 'textarea');
	
	}

	$options[] = array(
		'name' => 'Do not show any Posts or Page in the Front Page ', 
		'desc' => 'Check the Box if you do not want to show any Posts or Page in the Front Page', 
		'id' => 'fpost',
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Use Responsive Layout', 
		'desc' => 'Check the Box if you want the Responsive Layout of your Website', 
		'id' => 'responsive',
		'std' => '0',
		'type' => 'checkbox');
	
	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>


<?php
}
