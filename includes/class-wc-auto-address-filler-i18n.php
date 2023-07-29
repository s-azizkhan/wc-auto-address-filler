<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/s-azizkhan
 * @since      1.0.0
 *
 * @package    Wc_Auto_Address_Filler
 * @subpackage Wc_Auto_Address_Filler/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wc_Auto_Address_Filler
 * @subpackage Wc_Auto_Address_Filler/includes
 * @author     Aziz Khan <sakataziznkhan1@gmail.com>
 */
class Wc_Auto_Address_Filler_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wc-auto-address-filler',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
