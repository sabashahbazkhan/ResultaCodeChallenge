<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://resulta-code-challenge.com
 * @since      1.0.0
 *
 * @package    Resulta_Cc
 * @subpackage Resulta_Cc/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Resulta_Cc
 * @subpackage Resulta_Cc/admin
 * @author     Saba Shahbaz <saba.shabazkhan@gmail.com>
 */
class Resulta_Cc_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $resulta_cc    The ID of this plugin.
	 */
	private $resulta_cc;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $resulta_cc       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $resulta_cc, $version ) {

		$this->resulta_cc = $resulta_cc;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * The Resulta_Cc_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( $this->resulta_cc, plugin_dir_url( __FILE__ ) . 'css/resulta-cc-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Resulta_Cc_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Resulta_Cc_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
    	wp_enqueue_script( 'wp-color-picker');
		wp_enqueue_script( $this->resulta_cc, plugin_dir_url( __FILE__ ) . 'js/resulta-cc-admin.js', array( 'jquery','wp-color-picker' ), $this->version, false );

	}

	/**
	 * Register the Menu for plugin (Resulta code challenge resulta-cc) admin area.
	 *
	 * @since    1.0.0
	 */
	function top_level_menu_resulta_cc() {
		
	add_menu_page('Resulta Teams Info', 
				  'NFL Teams', 
				  'manage_options', 
				  'resulta-nfl-info-setting', 
				  array($this, 'nflSettingsPage'),
				  'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xMCAyMEMxNS41MjI5IDIwIDIwIDE1LjUyMjkgMjAgMTBDMjAgNC40NzcxNCAxNS41MjI5IDAgMTAgMEM0LjQ3NzE0IDAgMCA0LjQ3NzE0IDAgMTBDMCAxNS41MjI5IDQuNDc3MTQgMjAgMTAgMjBaTTExLjk5IDcuNDQ2NjZMMTAuMDc4MSAxLjU2MjVMOC4xNjYyNiA3LjQ0NjY2SDEuOTc5MjhMNi45ODQ2NSAxMS4wODMzTDUuMDcyNzUgMTYuOTY3NEwxMC4wNzgxIDEzLjMzMDhMMTUuMDgzNSAxNi45Njc0TDEzLjE3MTYgMTEuMDgzM0wxOC4xNzcgNy40NDY2NkgxMS45OVoiIGZpbGw9IiNGRkRGOEQiLz4KPC9zdmc+', 100);
   
    add_submenu_page('resulta-nfl-info-setting', 
					 'NFL Info Shortcode', 
					 'NFL Info Shortcode', 
					 'manage_options', 
					 'resulta-nfl-info-shortcode', 
					 array($this, 'optionsSubPage'));
	
	}
	/**
	 * Registering all the settings required for NFL team setting page
	 */
	function settings() {
		add_settings_section('rcc_option_section', null, null, 'resulta-nfl-info-setting');
	
		add_settings_field('rcc_header_bg_color', 'Info Header Background Color', array($this, 'dispalyColorPickerBackgroundField'), 'resulta-nfl-info-setting', 'rcc_option_section');
		register_setting('rccoptionsplugin', 'rcc_header_bg_color', array('sanitize_callback' => array($this,'check_color')));
	
		add_settings_field('rcc_show_graph', 'Show Graphical Representation', array($this, 'rccShowGraphHTML'), 'resulta-nfl-info-setting', 'rcc_option_section');
		register_setting('rccoptionsplugin', 'rcc_show_graph', array('sanitize_callback' => array($this, 'sanitizeShowGraph')));
		
		add_settings_field('rcc_shortcode', 'Shortcode', array($this, 'rccShortcodeHTML'), 'resulta-nfl-info-setting', 'rcc_option_section');
		register_setting('rccoptionsplugin', 'rcc_shortcode', array('default' => '[NFL_TEAMS_INFO_SHORT_CODE]'));
		
			
	  }

	  /**
	   * This partial functionality is implemented to show that in case we have large HTML to handle then we can use partials .
	   * As for now the html is very minmal so for other fields we are declaring funtion in same file.
	   * 
	   */

	  function dispalyColorPickerBackgroundField(){
		require_once(__DIR__ . '/partials/resulta-cc-admin-display-color-picker.php');
	  }
	  // Validation 
	/**
	 * validation functionality for background color content
	 * 
	 */
	function check_color( $value ) { 
	
		if ( preg_match( '/^#[a-f0-9]{6}$/i', $value ) ) { // if user insert a HEX color with #     
			return $value;
		}
	
		add_settings_error('rcc_header_bg_color', 'rcc_header_bg_color_error', 'Please insert a valid HEX Color .');
		return get_option('rcc_header_bg_color');
	}
	/**
	 * validation functionality for Show graph dropdown content
	 * 
	 */
	  function sanitizeShowGraph($input) {
		if ($input != '0' AND $input != '1') {
		  add_settings_error('rcc_show_graph', 'rcc_show_graph_error', 'Graphical Representation must be either Yes or No.');
		  return get_option('rcc_show_graph');
		}
		return $input;
	  }
	  /**
	 * HTML for checkbox content field
	 * cab be used for future settings
	 */
	  function checkboxHTML($args) { ?>
		<input type="checkbox" name="<?php echo $args['theName'] ?>" value="1" <?php checked(get_option($args['theName']), '1') ?>>
	  <?php }

	/**
	 * HTML for Shortcode content field
	 * 
	 */
	  function rccShortcodeHTML(){?>
		<textarea id="shortcode_area" name="shortcode_area" rows="4" cols="50">[NFL_TEAMS_INFO_SHORT_CODE]</textarea>
	 <?php }

	/**
	 * HTML for show graph settings field
	 * 
	 */
	function rccShowGraphHTML() { ?>
		<select name="rcc_show_graph">
		<option value="0" <?php selected(get_option('rcc_show_graph'), '0') ?>>No</option>
		<option value="1" <?php selected(get_option('rcc_show_graph'), '1') ?>>Yes</option>
		</select>
	<?php }

	/**
	 * NFL Teams  menu functionality
	 * Function for main menu page NFL Teams settings content 
	 * 
	 */
	
	function nflSettingsPage() { ?>
	<div class="wrap">
      <h1>NFL Teams Info Settings</h1>
      <form action="options.php" method="POST">
      <?php
	  	settings_errors();
        settings_fields('rccoptionsplugin');
        do_settings_sections('resulta-nfl-info-setting');
        submit_button();
      ?>
      </form>
    </div>
	<?php }
	/**
	 * NFL Info Shortcode menu functionality
	 * Function for Submenu page content 
	 * 
	 */
	function optionsSubPage() { ?>
	<div class="wrap">
		<h1>NFL Teams Info Shortcode</h1>
		<table class="form-table" role="presentation">
			<tbody>
				<tr>
					<th scope="row">Shortcode</th>
					<td><textarea id="shortcode_area" name="shortcode_area" rows="4" cols="50">[NFL_TEAMS_INFO_SHORT_CODE]</textarea>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php }
	
	  
	

}
