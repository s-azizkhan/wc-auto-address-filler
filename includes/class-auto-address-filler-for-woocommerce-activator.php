<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/s-azizkhan
 * @since      1.0.0
 *
 * @package    Auto_Address_Filler_For_Woocommerce
 * @subpackage Auto_Address_Filler_For_Woocommerce/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Auto_Address_Filler_For_Woocommerce
 * @subpackage Auto_Address_Filler_For_Woocommerce/includes
 * @author     Aziz Khan <sakataziznkhan1@gmail.com>
 */
class Auto_Address_Filler_For_Woocommerce_Activator
{

	/**
	 * Plugin activation hook
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		// Check if WooCommerce is active
		if (!is_plugin_active('woocommerce/woocommerce.php')) {
			// Deactivate the plugin
			deactivate_plugins(plugin_basename(__FILE__));

			// Show admin notice
			add_action('admin_notices', [__CLASS__, 'activation_notice']);
		}
	}

	public function activation_notice()
	{
?>
		<div class="error">
			<p><?php echo esc_html__('Auto-Address-Filler-For-Woocommerce requires WooCommerce to be installed and activated. The plugin has been deactivated.', 'auto-address-filler-for-woocommerce'); ?></p>
		</div>
<?php
	}
}
