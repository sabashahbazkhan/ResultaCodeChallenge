<?php

/**
 * Fired during plugin activation
 *
 * @link       http://resulta-code-challenge.com
 * @since      1.0.0
 *
 * @package    Resulta_Cc
 * @subpackage Resulta_Cc/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Resulta_Cc
 * @subpackage Resulta_Cc/includes
 * @author     Saba Shahbaz <saba.shabazkhan@gmail.com>
 */
class Resulta_Cc_Activator {

	/**
	 * This Functionality will be called when user want to activate the plugin
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		/**
		 * For the sake of this API solution we dont need any DB interaction for now 
		 * But in future if it is required then we can declare functionality here
		 * This commented code is just to give you the glimse that how things work if we have DB tables
		 */
		/**
		 * Check user rights
		 */
		if ( !current_user_can( "manage_options" ) ) {
			wp_die( "Unauthorized user" );
		}
		add_option( 'rcc_show_graph', '1', '', 'yes' );
		add_option( 'rcc_header_bg_color', '#d3c904', '', 'yes' );
	
		/**
		 * Create database tables
		 */
		/*if ( !function_exists( "dbDelta" ) ) { 
			require_once ABSPATH . "/wp-admin/includes/upgrade.php"; 
		}
	
		$nfl_table_name = NFL_TABLE_PREFIX.NFL_TABLE_NAME;*/
	
		/**
		 * Create smart notification bars table
		 */
		/*$nfl_table_create_query = "CREATE TABLE " . $nfl_table_name . " ( 
			id int(11) NOT NULL auto_increment ,
			name varchar(250) NOT NULL ,
			content text ,
			created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
			updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
			PRIMARY KEY  (id)
			)
			CHARSET=utf8mb4
			COLLATE utf8mb4_unicode_ci";
	
		dbDelta( $nfl_table_create_query );*/

	}

}
