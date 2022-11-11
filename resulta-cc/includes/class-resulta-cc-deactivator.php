<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://resulta-code-challenge.com
 * @since      1.0.0
 *
 * @package    Resulta_Cc
 * @subpackage Resulta_Cc/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Resulta_Cc
 * @subpackage Resulta_Cc/includes
 * @author     Saba Shahbaz <saba.shabazkhan@gmail.com>
 */
class Resulta_Cc_Deactivator {

	/**
	 * We will not do anything here because deactivation can be temporary and we dont want to loose data.
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		//nothing to do here for now to avoid data loss 
	}

}
