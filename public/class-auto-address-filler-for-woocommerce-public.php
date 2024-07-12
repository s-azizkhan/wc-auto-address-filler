<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/s-azizkhan
 * @since      1.0.0
 *
 * @package    Auto_Address_Filler_For_Woocommerce
 * @subpackage Auto_Address_Filler_For_Woocommerce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @version  1.0.0
 * @since    1.0.0
 * @package    Auto_Address_Filler_For_Woocommerce
 * @subpackage Auto_Address_Filler_For_Woocommerce/public
 * @author     Aziz Khan <sakataziznkhan1@gmail.com>
 */
class Auto_Address_Filler_For_Woocommerce_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @version  1.0.0
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Auto_Address_Filler_For_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Auto_Address_Filler_For_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/auto-address-filler-for-woocommerce-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @version  1.0.0
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Auto_Address_Filler_For_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Auto_Address_Filler_For_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if (is_checkout()) {
			wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/auto-address-filler-for-woocommerce-public.js', array('jquery'), $this->version, false);

			// Localize the script with the AJAX URL
			wp_localize_script($this->plugin_name, 'ajax_object', array(
				'ajax_url' => admin_url('admin-ajax.php'),
				'action'   => ADFFW_DOMAIN . '_get_user_location',
			));
		}
	}

	/**
	 * Retrieves the user's location data using the Geoplugin API and sends it as a JSON response.
	 * 
	 * @version  1.0.0
	 * @since    1.0.0
	 * @return void
	 */
	public function get_user_location_callback()
	{
		$api_url = 'http://www.geoplugin.net/json.gp';
		$response = wp_remote_get($api_url);

		$data = json_decode($response['body']);
		$locationData = array();
		foreach ($data as $key => $value) {
			$locationKey = str_replace('geoplugin_', '', $key);
			$locationData[$locationKey] = $value;
		}

		$fullDetail = $this->get_location_details($locationData['latitude'], $locationData['longitude']);
		$locationData['address'] = $fullDetail->address;

		// Send the location data as a JSON response
		wp_send_json_success($locationData);
	}

	/**
	 * Retrieves the location details for a given latitude and longitude.
	 *
	 * @version  1.0.0
	 * @since    1.0.0
	 * @param float $latitude The latitude of the location.
	 * @param float $longitude The longitude of the location.
	 * @throws Some_Exception_Class A description of the exception.
	 * @return mixed The location details in JSON format.
	 */
	private function get_location_details($latitude, $longitude)
	{
		$api_url = "https://nominatim.openstreetmap.org/reverse?format=json&lat=$latitude&lon=$longitude&zoom=18&addressdetails=1";

		$response = wp_remote_get($api_url);
		$data = json_decode($response['body']);
		return $data;
	}
}
