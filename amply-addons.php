<?php
/**
 * Plugin Name: Amply Addons
 * Plugin URI: your plugin url
 * Description: Short description of the plugin
 * Text Domain: amply-addons
 * Domain Path: /languages/
 * Author: teva
 * Version: 1.0.0
 * Author URI: author uri
 *
 * @package amply-addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Returns the main instance of Ocean_Extra to prevent the need to use globals.
 *
 * @return object Amply_Addons
 */
function amply_addons() {
	return Amply_Addons::get_instance();
}

amply_addons();

/**
 * Main Amply_Addons Class
 */
final class Amply_Addons {

	/**
	 * The single instance of Amply_Addons.
	 *
	 * @var     object
	 * @access  private
	 */
	private static $_instance = null;

	/**
	 * Main Amply_Addons Instance
	 *
	 * Ensures only one instance of Amply_Addons is loaded or can be loaded.
	 *
	 * @static
	 * @return Object Amply_Addons instance
	 */
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 */
	public function __construct() {

		$this->plugin_path    = plugin_dir_path( __FILE__ );
		$this->plugin_url     = plugin_dir_url( __FILE__ );
		$this->plugin_name    = 'amply-addons';
		$this->plugin_version = '1.0.0';

		define( 'AMPLY_ADDONS_URL', $this->plugin_url );
		define( 'AMPLY_ADDONS_PATH', $this->plugin_path );

		register_activation_hook( __FILE__, array( $this, 'install' ) );

		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Features executed only if Amply or a child theme using Amply as a parent is active.
		$theme = wp_get_theme();
		if ( 'Amply' == $theme->name || 'Amply' == $theme->template ) {

			// Add theme panel.
			require_once( AMPLY_ADDONS_PATH .'/includes/theme-panel/class-amply-addons-theme-panel.php' );

			// Add section templates.
			require_once( AMPLY_ADDONS_PATH .'/includes/section-templates/class-amply-addons-section-templates.php' );

		}

	}

	/**
	 * Plugin installation.
	 * Runs on activation: Logs the version number.
	 */
	public function install() {
		$this->_log_version_number();
	}

	/**
	 * Log the plugin version number.
	 */
	private function _log_version_number() {
		// Log the version number.
		update_option( $this->plugin_name . '-version', $this->plugin_version );
	}

	/**
	 * Load the localisation file
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'amply-addons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}



} // End Class
