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
 * Text Domain: bd-webhooks
 * Domain Path: /languages/
 * Network:     false
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
		add_action( 'admin_enqueue_scripts', array( $this, 'add_webhooks_script' ) );
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
	 * Add webhooks related script and style.
	 */
	function add_webhooks_script() {
		wp_enqueue_style( 'webhook-styles', plugin_dir_url( __FILE__ ) . '_inc/style.css' );
		wp_enqueue_script( 'webhooks-script', plugin_dir_url( __FILE__ ) . '_inc/script.js', array( 'jquery' ) );
		wp_enqueue_script( 'thickbox');

	}

	/**
	 * Add action call for creating webhooks setting page here.
	 */
	public function add_webhooks_settings() {
		add_options_page(
			__( 'WebHooks', 'bd-webhooks' ),
			__( 'WebHooks', 'bd-webhooks' ),
			'manage_options',
			'wp-webhooks.php',
			array( $this, 'wp_webhooks_page_callback' )
		);
	}

	/**
	 * This function is just callback for adding webhooks option page content.
	 */
	public function wp_webhooks_page_callback() {
		// Add setting form HTML here.
		?>
		<h2><?php _e( 'WebHooks', 'bd-webhooks' ); ?></h2>
		<p><?php _e( 'Webhooks let you easily develop push notifications. These push notifications are simply an HTTP POST that is triggered by some action. You can use it to pass wordpress data to any third party script/application. Inspired from HookPress !!!', 'bd-webhooks' );?></p>
		<?php add_thickbox(); ?>
		<p class="submit">
			<input class="thickbox button button-primary" type="button" value="Add webhook" title="Add new webhook" alt="#TB_inline?height=330&amp;width=500&amp;inlineId=hookpress-webhook">
		</p>
		<div id="hookpress-webhook" class="webhook-content-css">
			<div id="webhooks-contetn-with-css">
				<form id="newform">
					<table>
						<tbody>
							<tr>
								<td><label style="font-weight: bold" for="newhook" id="action_or_filter">Action:</label></td>
								<td><select name="newhook" id="newhook"><option value="comment_post">comment_post</option><option value="publish_page">publish_page</option><option value="publish_post">publish_post</option></select></td>
							</tr>
							<tr>
								<td style="vertical-align: top"><label style="font-weight: bold" for="newfields">Fields: </label><br><small>Ctrl-click on Windows or Command-click on Mac to select multiple. The <code>hook</code> field with the relevant hook name is always sent.</small><br>
								</td>
								<td>
									<select style="vertical-align: top" name="newfields" id="newfields" multiple="multiple" size="8">
										<option value="ID">ID</option><option value="comment_count">comment_count</option><option value="comment_status">comment_status</option><option value="guid">guid</option><option value="menu_order">menu_order</option><option value="ping_status">ping_status</option><option value="pinged">pinged</option><option value="post_author">post_author</option><option value="post_category">post_category</option><option value="post_content">post_content</option><option value="post_content_filtered">post_content_filtered</option><option value="post_date">post_date</option><option value="post_date_gmt">post_date_gmt</option><option value="post_excerpt">post_excerpt</option><option value="post_mime_type">post_mime_type</option><option value="post_modified">post_modified</option><option value="post_modified_gmt">post_modified_gmt</option><option value="post_name">post_name</option><option value="post_parent">post_parent</option><option value="post_password">post_password</option><option value="post_status">post_status</option><option value="post_title">post_title</option><option value="post_type">post_type</option><option value="post_url">post_url</option><option value="to_ping">to_ping</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><label style="font-weight: bold" for="newurl">URL: </label></td><td><input name="newurl" id="newurl" size="40" value="http://"></td>
							</tr>
						</tbody>
					</table>
					<input type="hidden" id="submit-nonce" name="submit-nonce" value="ae51d02b38">  
					<center><span id="newindicator"></span><br>
					<input type="button" class="button" id="newsubmit" value="Add new webhook">
					<input type="button" class="button" id="newcancel" value="Cancel"></center>
				</form>
			</div>
		</div>
		<?php
	}


}
$instance = WP_Webhooks::get_instance();
