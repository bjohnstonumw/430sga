<?php
/**
 * Plugin Name: Weather for us widget
 * Plugin URI: http://www.weatherfor.us/
 * Description: The really cool looking weather widget for your website, comes with weather forecast, temparture units, automatically detecting location
 * Version: 1.4.1
 * Author: Weatherfor.us
 * Author URI: http://www.weatherfor.us/
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'weather_for_us_v1_0_load' );

/**
 * Register our widgets
 * 
 *
 * @since 0.1
 */
function weather_for_us_v1_0_load() {
	if(is_admin()){

		wp_enqueue_style('jpicker', plugins_url('css/colorpicker.css',  __FILE__ ));
		wp_enqueue_script('jpicker', plugins_url('js/colorpicker.js',  __FILE__ ));

		wp_enqueue_script('w4s', plugins_url('init.w4s.js', __FILE__), array('spectrum', 'jquery'));
	}
	register_widget( 'ExplicitWeather4UsWidget' );
	register_widget( 'MiniWeather4UsWidget' );
}

class MiniTl8 {
	public static function render($content, $data = array()) {
		$ret = $content;
		foreach ($data as $name => $val) {
			$ret = str_replace('{{'.$name.'}}', $val, $ret);
		}
		return $ret;
	}
}

class Weather4UsWidget extends WP_Widget {

	public $SiteUrl = 'http://www.weatherfor.us';
	
	public $widget_name = 'weather';
	public $widget_title = "Weather for us widget";

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'w4us_widget', 'description' => __('Weather for us widget', 'w4us_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 720, 'height' => 250, 'id_base' => 'weatherforus-wp-'.strtolower($this->widget_name));

		/* Create the widget. */
		parent::__construct( 'weatherforus-wp-'.$this->widget_name, __($this->widget_title, $this->widget_name), $widget_ops, $control_ops );
	}

	/**
	 *display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$code = '';
		$params = array();
		if(isset($instance['location'])){
			$params['location'] = $instance['location'];
		}
		if(isset($instance['unit']) && $instance['unit'] == 'c') {
			$params['unit'] = 'metric';
		}else{
			$params['unit'] = 'f';
		}

		$code = '<iframe id="explicit" src="{{base_url}}/load.php?{{params}}" allowtransparency="true" style="background: transparent; width: 720px; height: 250px; overflow: hidden;" frameborder="0" scrolling="no"></iframe>';
		echo MiniTl8::render($code, array('base_url' => $this->SiteUrl, 'params' => http_build_query($params)));
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		foreach(array('location', 'bg_color', 'unit') as $i){
			/* Strip tags for title and name to remove HTML (important for text inputs). */
			if(isset($new_instance[$i])){
				$instance[$i] = strip_tags( $new_instance[$i] );
			}
		}

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'location' => __('', $this->widget_name));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Your Name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'location' ); ?>"><?php _e('Enter location, city name followed by country(optional leave empty to autodetect):', $this->widget_name); ?></label>
			<input id="<?php echo $this->get_field_id( 'location' ); ?>" name="<?php echo $this->get_field_name( 'location' ); ?>" value="<?php echo $instance['location']; ?>" style="width:100%;" />

			<input id="<?php echo $this->get_field_id( 'unit' ); ?>" name="<?php echo $this->get_field_name( 'unit' ); ?>" value="c" <?php if(isset($instance['unit']) && $instance['unit'] == 'c') echo 'checked="checked"'; ?> type="checkbox" /> 
			<label for="<?php echo $this->get_field_id( 'unit' ); ?>"><?php _e('Use Centigrade as default unit', $this->widget_name); ?></label>
			<br/>
		</p>
		
	<?php
	}
}

class ExplicitWeather4UsWidget extends Weather4UsWidget {	
	public $widget_name = 'weather-large';
	public $widget_title = "Weather for us 720px wide widget";
}

class MiniWeather4UsWidget extends Weather4UsWidget {
	public $widget_name = 'weather-';
	public $widget_title = "Weather for us mini widget";

	/**
	 *display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$code = '';
		$params = array();

		foreach(array('location', 'bg_color', 'unit') as $i){
			if(isset($instance[$i])){
				$params[$i] = $instance[$i];
			}
		}

		$code = '<div style="margin: 0 auto; width: 100%; min-width: 150px; position: relative; "><script type="text/javascript" src="{{root_home}}/static/js/minion/minion.js"></script><script type="text/javascript">w4uminion.run({{config_json}});</script></div>';
		echo MiniTl8::render($code, array('config_json' => json_encode($params), 'root_home' => $this->SiteUrl));
	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'location' => __('', $this->widget_name));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Your Name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'location' ); ?>"><?php _e('Enter comma seperated location in following format city, county/state, country (Leave empty to autodetect users\'s location):', $this->widget_name); ?></label>
			<input id="<?php echo $this->get_field_id( 'location' ); ?>" name="<?php echo $this->get_field_name( 'location' ); ?>" value="<?php echo $instance['location']; ?>" style="width:100%;" />

			<input id="<?php echo $this->get_field_id( 'unit' ); ?>" name="<?php echo $this->get_field_name( 'unit' ); ?>" value="c" <?php if(isset($instance['unit']) && $instance['unit'] == 'c') echo 'checked="checked"'; ?> type="checkbox" /> 
			<label for="<?php echo $this->get_field_id( 'unit' ); ?>"><?php _e('Use <strong>Centigrade</strong> as default unit', $this->widget_name); ?></label>
			<br/>

			<label for="<?php echo $this->get_field_id( 'bg_color' ); ?>"><?php _e('Select background color of the panel where widget is placed.', $this->widget_name); ?></label>
			<input id="<?php echo $this->get_field_id( 'bg_color' ); ?>" name="<?php echo $this->get_field_name( 'bg_color' ); ?>" value="<?php echo $instance['bg_color']; ?>" class="color-picker"/>
		</p>
		
	<?php
	}
}
