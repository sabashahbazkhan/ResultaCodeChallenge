<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://resulta-code-challenge.com
 * @since      1.0.0
 *
 * @package    Resulta_Cc
 * @subpackage Resulta_Cc/includes
 */

/**
 * The core plugin class.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Resulta_Cc
 * @subpackage Resulta_Cc/includes
 * @author     Saba Shahbaz <saba.shabazkhan@gmail.com>
 */
class Resulta_Cc {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Resulta_Cc_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $resulta_cc    The string used to uniquely identify this plugin.
	 */
	protected $resulta_cc;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;
	
	/**
	 * The Database Object to read/write data to DB tables.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $db    The db object.
	 */
	private $db;

	/**
	 * The Database tables prefix defined in config.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $prefix    The prefix for DB tables.
	 */
	private $prefix;

	/**
	 * The Database tablename to hold information for NFL teams.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $prefix    The prefix for DB tables.
	 */
	private $nfl_team_table;

	/**
	 * A unique name string to hold the information of data on every call.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $name     The unique name for holding API call information.
	 */
	public $name;

	/**
	 * Core functionality of the plugin.
	 *
	 * Setting the plugin name and the plugin version
	 * Loading the dependencies, defining the locale, and setting the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		global $wpdb;
		$this->db = $wpdb;
		$this->prefix = $wpdb->prefix;
		$this->nfl_team_table = $wpdb->prefix . NFL_TABLE_NAME;
		$date = new DateTime("now");
		$this->name = "NFL TEAM" . $date->format( "Y-m-d" );
		if ( defined( 'RESULTA_CC_VERSION' ) ) {
			$this->version = RESULTA_CC_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->resulta_cc = 'resulta-cc';
		

		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_short_codes();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Resulta_Cc_Loader. Orchestrates the hooks of the plugin.
	 * - Resulta_Cc_Admin. Defines all hooks for the admin area.
	 * - Resulta_Cc_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-resulta-cc-loader.php';


		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-resulta-cc-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-resulta-cc-public.php';

		$this->loader = new Resulta_Cc_Loader();

	}


	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Resulta_Cc_Admin( $this->get_resulta_cc(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'top_level_menu_resulta_cc' );
		$this->loader->add_action( 'admin_init',$plugin_admin, 'settings' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Resulta_Cc_Public( $this->get_resulta_cc(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Register all of the Shortcode of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_short_codes() {

		$plugin_public = new Resulta_Cc_Public( $this->get_resulta_cc(), $this->get_version() );
		
		add_shortcode( 'NFL_TEAMS_INFO_SHORT_CODE', array($plugin_public,'display_nfl_team_info' ));

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_resulta_cc() {
		return $this->resulta_cc;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Resulta_Cc_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
