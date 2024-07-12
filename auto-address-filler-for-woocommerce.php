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
 * @package           Auto_Address_Filler_For_Woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       WC Auto Address Filler
 * Plugin URI:        https://github.com/s-azizkhan/auto-address-filler-for-woocommerce
 * Description:       Automate WooCommerce checkout with Auto-Address-Filler-For-Woocommerce. Streamlines shipping and billing address entry, saving time and improving user experience. Hassle-free integration for a smoother, error-free checkout process.
 * Version:           1.0.0
 * Author:            Aziz Khan
 * Author URI:        https://github.com/s-azizkhan
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       auto-address-filler-for-woocommerce
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
define( 'AUTO_ADDRESS_FILLER_FOR_WOOCOMMERCE_VERSION', '1.0.0' );
define( 'ADFFW_DOMAIN', 'ADFFW' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-auto-address-filler-for-woocommerce-activator.php
 */
function activate_Auto_Address_Filler_For_Woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-auto-address-filler-for-woocommerce-activator.php';
	Auto_Address_Filler_For_Woocommerce_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-auto-address-filler-for-woocommerce-deactivator.php
 */
function deactivate_Auto_Address_Filler_For_Woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-auto-address-filler-for-woocommerce-deactivator.php';
	Auto_Address_Filler_For_Woocommerce_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Auto_Address_Filler_For_Woocommerce' );
register_deactivation_hook( __FILE__, 'deactivate_Auto_Address_Filler_For_Woocommerce' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-auto-address-filler-for-woocommerce.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Auto_Address_Filler_For_Woocommerce() {

	$plugin = new Auto_Address_Filler_For_Woocommerce();
	$plugin->run();

}
run_Auto_Address_Filler_For_Woocommerce();
