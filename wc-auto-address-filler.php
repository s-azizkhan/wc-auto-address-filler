<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/s-azizkhan
 * @since             1.0.0
 * @package           Wc_Auto_Address_Filler
 *
 * @wordpress-plugin
 * Plugin Name:       WC Auto Address Filler
 * Plugin URI:        https://github.com/s-azizkhan/wc-auto-address-filler
 * Description:       Automate WooCommerce checkout with WC-Auto-Address-Filler. Streamlines shipping and billing address entry, saving time and improving user experience. Hassle-free integration for a smoother, error-free checkout process.
 * Version:           1.0.0
 * Author:            Aziz Khan
 * Author URI:        https://github.com/s-azizkhan
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-auto-address-filler
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WC_AUTO_ADDRESS_FILLER_VERSION', '1.0.0' );
define( 'WCAF_DOMAIN', 'WCAF' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-auto-address-filler-activator.php
 */
function activate_wc_auto_address_filler() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-auto-address-filler-activator.php';
	Wc_Auto_Address_Filler_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc-auto-address-filler-deactivator.php
 */
function deactivate_wc_auto_address_filler() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-auto-address-filler-deactivator.php';
	Wc_Auto_Address_Filler_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wc_auto_address_filler' );
register_deactivation_hook( __FILE__, 'deactivate_wc_auto_address_filler' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wc-auto-address-filler.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wc_auto_address_filler() {

	$plugin = new Wc_Auto_Address_Filler();
	$plugin->run();

}
run_wc_auto_address_filler();
