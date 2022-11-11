<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://resulta-code-challenge.com
 * @since             1.0.0
 * @package           Resulta_CC
 *
 * @wordpress-plugin
 * Plugin Name:       Resulta Code Challenge
 * Plugin URI:        http://resulta-code-challenge.com/
 * Description:       This is a Code Challenge to assess the skillset to resolve technical problems and how you architect and implement solutions to those problems.
 * Version:           1.0.0
 * Author:            Saba Shahbaz
 * Author URI:        https://www.linkedin.com/in/sabashahbaz/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       resulta-cc
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Update it as (MAJOR.MINOR.PATCH) release new versions .
 */
define( 'RESULTA_CC_VERSION', '1.0.0' );
/**
 * for future use if we need to define custom table 
 */
global $wpdb;
define( 'NFL_TABLE_NAME', 'nfl' );
define( 'NFL_TABLE_PREFIX', $wpdb->prefix );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-resulta-cc-activator.php
 */
function activate_resulta_cc() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-resulta-cc-activator.php';
	Resulta_Cc_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-resulta-cc-deactivator.php
 */
function deactivate_resulta_cc() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-resulta-cc-deactivator.php';
	Resulta_Cc_Deactivator::deactivate();
}
function uninstall_resulta_cc() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-resulta-cc-uninstall.php';
	Resulta_Cc_Uninstall::uninstall();
}

register_activation_hook( __FILE__, 'activate_resulta_cc' );
register_deactivation_hook( __FILE__, 'deactivate_resulta_cc' );
register_uninstall_hook( __FILE__ , "uninstall_resulta_cc" );

/**
 * The core plugin class that is used to define admin-specific hooks, 
 * and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-resulta-cc.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_resulta_cc() {

	$plugin = new Resulta_Cc();
	$plugin->run();

}
run_resulta_cc();
