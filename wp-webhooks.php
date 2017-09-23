<?php
/**
 * Web hooks plugin for WordPress.
 *
 * @package wp\webhooks
 * @link    https://github.com/1naveengiri/webhooks.git
 * @author  1naveengiri <1naveengiri@gmail.com>
 * @license   GPL v2 or later
 *
 * Plugin Name: Webhooks
 * Description: Webhooks let you easily develop push notifications. These push notifications are simply an HTTP POST that is triggered by some action.
 * Version: 1.0.0
 * Author: 1naveengiri
 * Author URI: http://buddydevelopers.com
 * Text Domain: wp-webhooks
 * Domain Path: /languages/
 * Network:     true
 */

/**
 * Main container class for Webhooks plugin.
 */
class WP_Webhooks {

	/**
	 * Class constructor.
	 */
	private function __construct() {
		add_action( 'admin_menu', array( $this, 'add_webhooks_settings' ) );
	}

	/**
	 * Single ton pattern instance reuse.
	 *
	 * @access  private
	 *
	 * @var object  $_instance class instance.
	 */
	private static $instance;

	/**
	 * GET Instance
	 *
	 * Function help to create class instance as per singleton pattern.
	 *
	 * @return object  $_instance
	 */
	public static function get_instance() {
		if ( ! isset( SELF::$intsane ) ) {
			$instance = new SELF();
		}
		return SELF::$instance;
	}
	/**
	 * Add action call for creating webhooks setting page here.
	 */
	public function add_webhooks_settings() {
		add_options_page(
			'WebHooks',
			'WebHooks',
			'manage_options',
			'wp-webhooks.php',
			array( $this, 'wp_webhooks_page_callback' )
		);
	}

	/**
	 * This function is just callback for adding webhooks option page content.
	 */
	public function wp_webhooks_page_callback() {
		
	}

}
$instance = WP_Webhooks::get_instance();
