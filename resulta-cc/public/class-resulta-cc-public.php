<?php

/**
 * The public-facing functionality of the plugin.
 *
 *  http://resulta-code-challenge.com
 * @since      1.0.0
 *
 * @package    Resulta_Cc
 * @subpackage Resulta_Cc/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Resulta_Cc
 * @subpackage Resulta_Cc/public
 * @author     Saba Shahbaz <saba.shabazkhan@gmail.com>
 */
class Resulta_Cc_Public {

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
	 * The URL for API.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $api_url    The URL to get NFL information of this plugin.
	 */
	private $api_url;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $resulta_cc       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $resulta_cc, $version ) {

		$this->resulta_cc = $resulta_cc;
		$this->version    = $version;
		$this->api_url    = 'http://delivery.chalk247.com/team_list/NFL.JSON?api_key=74db8efa2a6db279393b433d97c2bc843f8e32b0';

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_style( 'bootstrap_twitter_style',  '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'bootstrap_datatable_style',  '//cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->resulta_cc, plugin_dir_url( __FILE__ ) . 'css/resulta-cc-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		
		wp_enqueue_script( $this->resulta_cc, plugin_dir_url( __FILE__ ) . 'js/resulta-cc-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'datatable_script', '//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js', array( ), $this->version, false );
		wp_enqueue_script( 'bootstrap_datatable_script', '//cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js', array( ), $this->version, false );
		wp_enqueue_script( 'canvas_script', '//canvasjs.com/assets/script/canvasjs.min.js', array(  ), $this->version, false );
		
	}

	public function get_nfl_team_info(){

		/**
		 * Sending Curl request to get info from API
		 */
		$curl = curl_init();
		$url = $this->api_url;

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			return array();
		} else {
			//The API returns data in JSON format, so first convert that to an array of data objects
			$responseObj = json_decode($response,true);
			return $responseObj;
		}
	}

	function display_nfl_team_info(){
		$dataObj = $this->get_nfl_team_info();
		/**
		 * Check if the object is empty then show No Records message
		 * Else continue to draw graphs or table representation
		 */
		if(empty($dataObj)){
			echo '<div class="container container-margin-top bg-danger text-white p-4 text-center"> <h2>NFL Teams Information</h2><p>No Record found.</p></div>'; 
			
		}else{
			require_once(__DIR__ . '/partials/resulta-cc-public-display.php');
	
		}
	}

}
