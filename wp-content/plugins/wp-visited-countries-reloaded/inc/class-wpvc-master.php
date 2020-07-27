<?php
/**
 * Main class
 *
 * @package WPVC
 */
	

class WPVC_Master {
	
	/**
	 * Activates this plugin when it is first installed
	 *
	 * @access public
	 */
	function activate() {
		new WPVC_Settings( true );
		new WPVC_Countries( true );
	}
	
	function deactivate() {
	
	}

	/**
	 * Deactivates this plugin and removes all related option settings
	 *
	 * @access public
	 */
	function uninstall() {
		delete_option( WPVC_VERSION_KEY );	
		delete_option( WPVC_SETTINGS_KEY );	
		delete_option( WPVC_ADD_COUNTRIES_KEY );	
		unregister_widget( 'WPVC_Map_Widget' );					
	}
	
	function init() {
		add_option( WPVC_VERSION_KEY, WPVC_VERSION_NUM );
		// TODO: filter deprecated?
		//add_filter( 'plugin_action_links', array( 'WPVC_Master', 'add_action_links' ), 10, 2 );
		add_action( 'admin_menu',  array( 'WPVC_Master', 'add_pages' ) );
		add_shortcode( 'wp-visited-countries', array( 'WPVC_Master', 'handle_shortcode' ) );
		// TODO: add_filter( 'the_posts', array( 'WPVC_Master', 'enqueue_scripts' ) );
		
		//load the translated strings
		load_plugin_textdomain( 'wpvc-plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
		
		//add_action('admin_enqueue_scripts', array('WPVC_Master', 'admin_scripts'));
		add_filter('pre_set_site_transient_update_plugins', array('WPVC_Master', 'check_version')); 
		add_action('admin_notices', array('WPVC_Master', 'admin_notice')); 
	}		
	
	/**
	 * Adds menu and sub-menu pages to the admin panel
	 *
	 * @access public
	 */
	function add_pages() {
		global $wpvc_settings_class, $wpvc_countries_class;
		
		//don't die without permission, just don't add the pages, jonas breuer, 13.11.2016
		if (function_exists( 'current_user_can' ) && current_user_can( 'manage_options' ) ) {
		
            if( !is_a( $wpvc_settings_class, 'WPVC_Settings' ) )
                $wpvc_settings_class = new WPVC_Settings();
        
            if( !is_a( $wpvc_countries_class, 'WPVC_Countries' ) )
                $wpvc_countries_class = new WPVC_Countries();
        
            add_menu_page( 'Visited Countries', 'Visited Countries', 'manage_options', 'wpvc-settings', '', 'dashicons-palmtree' );
            $s_page = add_submenu_page( 'wpvc-settings', 'Manage Settings', 'Settings', 'manage_options', 
                    'wpvc-settings', array( 'WPVC_Master', 'display_settings' ) );
            $c_page = add_submenu_page( 'wpvc-settings', 'Manage Countries', 'Countries', 'manage_options', 
                    'wpvc-countries', array( 'WPVC_Master', 'display_countries' ) );
        
            $wpvc_settings_class->add_actions( $s_page );
            $wpvc_countries_class->add_actions( $c_page );
            
        }
	}

	function display_settings() {
		require_once WPVC_PATH . 'inc/wpvc-settings.php';
	}

	function display_countries() {
		
		require_once WPVC_PATH . 'inc/class-wpvc-list-table.php';

		$wpvc_list_table = new WPVC_Country_List_Table();
		
		require_once WPVC_PATH . 'inc/wpvc-countries.php';
	
	}
	
	/**
	 * Handles shortcode [wp-visited-countries] to display a map with specified attributes
	 *
	 * @access public
	 *
	 * @param array $atts Attributes (width and height)
	 * @return string
	 */
	function handle_shortcode( $atts, $content = '' ) {
	
		extract( shortcode_atts( array(
			'width' => '',
			'height' => '',
			'id' => null,
		), $atts ) );
		
		$content = self::parse_text( $content );
		if( !empty( $content ) )
			$content = '<div class="wpvc-description">' . $content . "</div>";
		
		return self::get_script( $width, $height, $id ) . $content;
	}
	
	/**
	 * Analyze input text. If the text contains {num}, {total}, and/or {percent}
	 * it will be changed to the corresponding numbers
	 *
	 * @access public
	 *
	 * @param string $txt
	 * @return string The modified text
	 */
	function parse_text( $txt ) {
		if( empty( $txt ) )
			return '';
		
		$txt = str_replace( '{total}', WPVC_TOTAL_COUNTRIES, $txt );
		
		if( strpos( $txt, '{num}' ) !== false || strpos( $txt, '{percent}' ) !== false ) {
			
			$option = get_option( WPVC_ADD_COUNTRIES_KEY );
			$num = 0;
			
			if( $option )
				$num = count( $option ) ;
			
			$percent = number_format( $num/WPVC_TOTAL_COUNTRIES * 100, 2 ) . '%';
			
			$txt = str_replace( '{num}', $num, $txt );
			$txt = str_replace( '{percent}', $percent, $txt );
		}
		
		return $txt;
	}
	
	/**
	 * Get the JavaScript codes for displaying a map
	 *
	 * @access public
	 *
	 * @param int $width The width of the map to be displayed
	 * @param int $height The height of the map to be displayed
	 * @param string $id The DIV id where the map is written to
	 * @return string
	 */
	function get_script( $width, $height, $id = 'wpvc-flashcontent' ) {
		global $blog_id;
		
		$option = get_option( WPVC_SETTINGS_KEY );
		$bgcolor = $option['hex_water'];
		
		// replace all empty values to the default ones
		
		if( empty( $id ) )
			$id = 'wpvc-jscontent';
		
		if( empty( $bgcolor ) )
			$bgcolor = WPVC_DEFAULT_MAP_WATER;
		
		if( substr( $bgcolor, 0, 1 ) !== '#' )
			$bgcolor = '#' . $bgcolor;
			
		if( empty( $width ) ) {
			
			if( ! empty( $option[ 'int_map_width' ] ) )
				$width = $option[ 'int_map_width' ];
			else
				$width = WPVC_DEFAULT_MAP_WIDTH;
		
		}
			
		if( empty( $height ) ) {
		
			if( ! empty( $option[ 'int_map_height' ] ) )
				$height = $option[ 'int_map_height' ];
			else
				$height = WPVC_DEFAULT_MAP_HEIGHT;
		}
		
		/*
		$script = '<script type="text/javascript" src="' . WPVC_URL . 'ammap/swfobject.js"></script>'
			.'<script type="text/javascript" src="' . WPVC_URL . 'ammap/ammap.js"></script>'
			.'<div id="' . $id . '"></div><script type="text/javascript">
			var wpvc = {
				path	:	"' . WPVC_URL . '",
				width	:	'. $width . ',
				height	:	' . $height . ',
				bgcolor	:	"' . $bgcolor . '",
				id		:	"' . $id . '",
				blogid	:	"' . $blog_id . '"
			};
			wpvc_ammap(wpvc)</script>';
		*/
		
		$areas = array();
		$countries = get_option( WPVC_ADD_COUNTRIES_KEY );
		foreach ($countries as $country_id => $country) {
		    if (!empty($country['hex_country'])) $color = $country['hex_country'];
		    elseif ($country['int_visited'] == 1) $color = $option['hex_visited'];
		    else $color = $option['hex_not_visited'];
		    $color = '#'.$color;
		    
		    $roll_over_color = !empty($country['hex_hover']) ? $country['hex_hover'] : $option['hex_hover'];
		    $roll_over_color = '#'.$roll_over_color;
		
		    $country_area = new StdClass();
		    $country_area->id = $country_id;
		    $country_area->color = $color;
		    $country_area->rollOverColor = $roll_over_color;
		    $country_area->selectedColor = $roll_over_color;
		    $country_area->balloonText = '<b>[[title]]</b><br>'.$country['txt_desc'];
		    if (!empty($country['url_country'])) $country_area->url = 'http://'.$country['url_country'];
		    $areas[] = $country_area;
		}
		$json_areas = json_encode($areas);
		
		$small_map = new StdClass();
		$small_map->backgroundColor = 
		
		$script = '
		    <link rel="stylesheet" href="' . WPVC_URL . 'ammap/ammap.css" type="text/css" media="all" />
		    <script type="text/javascript" src="' . WPVC_URL . 'ammap/ammap.js"></script>
		    <script type="text/javascript" src="' . WPVC_URL . 'ammap/maps/js/worldLow.js"></script>
		    
		    <div id="' . $id . '" style="width: '. $width . 'px; height: ' . $height . 'px; background-color:#'.$option['hex_water'].'"></div>
		    <script type="text/javascript">
                AmCharts.makeChart( "' . $id . '", {
                
                    "type": "map",
                    "fontFamily":"'.$option['font_balloon_txt'].'",
                    
                    "dataProvider": {
                        "map": "worldLow",   
                        "getAreasFromMap": true,
                        "areas": '.$json_areas.'
                    },

                    "areasSettings": {
                        "autoZoom": true,
                        "rollOverOutlineAlpha": 0,
                        "balloonText": "",
                        "color": "#'.$option['hex_normal'].'",
                        "rollOverColor": "#'.$option['hex_hover'].'",
                        "selectedColor": "#'.$option['hex_hover'].'",
                    },

                    "smallMap": {
                        "enabled":'.$option['bool_smap'].',
                        "backgroundColor": "#'.$option['hex_smap_bg'].'",
                        "mapColor": "#'.$option['hex_smap'].'",
                        "borderColor": "#'.$option['hex_smap_border'].'",
                        "rectangleColor": "#'.$option['hex_smap_rectangle'].'"
                    },
                    
                    "zoomControl": {
                        "zoomControlEnabled": '.$option['bool_zoom'].',
                        "buttonFillColor": "#'.$option['hex_zoom_bg'].'",
                        "buttonRollOverColor": "#'.$option['hex_zoom_hover'].'"
                    },
                    
                    "balloon": {
                        "fontSize":"'.$option['int_balloon_txt'].'",
                        "color":"'.$option['hex_balloon_txt'].'",
                        "fillColor":"#'.$option['hex_balloon_bg'].'"
                    }
                    
                } );
            </script>
        ';
		
		return $script;
	}
	
	/**
	 * TODO: this one only works for pages/posts. Not for plugin. So this function is not used yet 
	 * Based on: http://beerpla.net/2010/01/13/wordpress-plugin-development-how-to-include-css-and-javascript-conditionally-and-only-when-needed-by-the-posts/
	 */
	function enqueue_scripts( $posts ){
		if (empty($posts)) return $posts;
	 
		foreach ($posts as $post) {
			
			if( stripos( $post->post_content, '[wp-visited-countries' ) !== false ) {
				
				wp_enqueue_script( 'swfobject', WPVC_URL . 'ammap/swfobject.js' );
				wp_enqueue_script( 'ammap', WPVC_URL . 'ammap/ammap.js', array('swfobject') );
				
				break;
			}
		}
	 
		return $posts;
	}
	
	/**
	 * Adds a shortcut link in the plugin page to the main settings page
	 *
	 * @access public
	 *
	 * @return array
	 */
	function add_action_links($links, $file) {
		static $this_plugin;

		if (!$this_plugin) {
			$this_plugin = plugin_basename(__FILE__);
		}

		if ($file == $this_plugin) {
			// The "page" query string value must be equal to the slug
			// of the Settings admin page, i.e. wpvc-settings
			$settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=wpvc-settings">Settings</a>';
			array_unshift($links, $settings_link);
		}

		return $links;
	}
	
	
	function admin_scripts() {
	    wp_enqueue_style('wp-color-picker');
	    wp_enqueue_script('wp-color-picker'); 
	}
	
	
	function check_version($transient) {
	
	    if (empty($transient->checked)) {  
			return $transient;  
		}
		
		$meta_options = get_option(WPVC_META_OPTIONS_KEY);
		$http_answer = wp_remote_post('https://api.wordpress.org/plugins/info/1.0/wp-visited-countries-reloaded');
		$repository_info = maybe_unserialize($http_answer['body']);
		
		//die (print_r($repository_info, true));
		
		if (version_compare(WPVC_VERSION_NUM, $repository_info->version, '<')) {
		    $user = wp_get_current_user();
		    $first_name = ($user->user_firstname != '') ? $user->user_firstname : $user->user_login;
		    
            $meta_options['infotext'] = sprintf( __('<h3>Visited Countries Update Required</h3><p>Hey %s, there is a new version of Visited Countries Reloaded. Please update as soon as possible to ensure the safety and compatibility of your site. Are you annoyed by constantly updating plugins and always worrying about breaking something? Check out my new service <a href="http://www.j-breuer.com/maintenance-power/" target="_blank">Maintenance Power</a>.', 'wpvc-plugin'), $first_name );
            $meta_options['hide-infotext'] = 0;
		}
		
		update_option(WPVC_META_OPTIONS_KEY, $meta_options);
		
		return $transient;  
	}
	
	
	function admin_notice() {
	    $current_screen = get_current_screen();
	    if ($current_screen->parent_base != "wpvc-settings") return;
	    
	    $settings = get_option(WPVC_META_OPTIONS_KEY);
	    if (!isset($settings['infotext']) || empty($settings['infotext'])) return;
	    
	    echo '<div class="notice notice-warning"><p>'.$settings['infotext'].'</p></div>';
	}
	
}
?>