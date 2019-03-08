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
	private static $instance = null;

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

		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

	}

	/**
	 * Main Amply_Addons Instance
	 *
	 * Ensures only one instance of Amply_Addons is loaded or can be loaded.
	 *
	 * @static
	 * @return Object Amply_Addons instance
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Load the localisation file
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'amply-addons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}



} // End Class
