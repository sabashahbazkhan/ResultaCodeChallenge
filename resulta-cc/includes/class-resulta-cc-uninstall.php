<?php

/**
 * Fired during plugin uninstall
 *
 * @link       http://resulta-code-challenge.com
 * @since      1.0.0
 *
 * @package    Resulta_Cc
 * @subpackage Resulta_Cc/includes
 */

/**
 * Fired during plugin uninstallation.
 *
 * This class defines all code necessary to run during the plugin's uninstallation.
 *
 * @since      1.0.0
 * @package    Resulta_Cc
 * @subpackage Resulta_Cc/includes
 * @author     Saba Shahbaz <saba.shabazkhan@gmail.com>
 */
class Resulta_Cc_Uninstall {

	/**
	 * Here we revert to the state of application where we were before installation of this plugin.
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function uninstall() {
		/**
		 * Check user rights
		 */
		if ( !current_user_can( "manage_options" ) ) {
			wp_die( "Unauthorized user" );
		}

		/**
		 * Remove options defined for this plugin
		 */
		
		$settingOptions = array( 'rcc_header_bg_color', 'rcc_show_graph' ); // etc

		// Clear up our settings
		foreach ( $settingOptions as $settingName ) {
			delete_option( $settingName );
		}
	
		/**
		 * Remove database tables if required. 
		 * This commented code is just to give you the glimse that how things work if we have DB tables
		 */
		/*if ( !function_exists( "dbDelta" ) ) { 
			require_once ABSPATH . "/wp-admin/includes/upgrade.php"; 
		}*/
		//global $wpdb;
		//$wpdb->query( "DROP TABLE IF EXISTS `" . NFL_TABLE_PREFIX.NFL_TABLE_NAME . "`" );
	
		return;

	}

}
