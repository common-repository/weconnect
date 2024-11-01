<?php
/**
 * Plugin Name: WeConnect.chat
 * Version: 1.1.0
 * Plugin URI: https://weconnect.chat
 * Description: A conversational messaging bot platform.
 * Author: WeConnect.chat Inc.
 * License: GPLv2 or later
 */


// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define('WCCT_PLUGIN_DIR',str_replace('\\','/',dirname(__FILE__)));

if ( !class_exists( 'WCCTScriptLoader' ) ) {

	class WCCTScriptLoader {

		function __construct() {

			add_action( 'init', array( &$this, 'wcct_init' ) );
			add_action( 'admin_init', array( &$this, 'wcct_admin_init' ) );
			add_action( 'admin_menu', array( &$this, 'wcct_admin_menu' ) );
			add_action( 'wp_head', array( &$this, 'wcct_head' ) );

			$plugin = plugin_basename( __FILE__ );
		   	add_filter( "plugin_action_links_$plugin", array( &$this, 'admin_settings_link_WeConnectchat' ) );
		}


		function wcct_init() {
			load_plugin_textdomain( 'WeConnectchat-settings', false, dirname( plugin_basename ( __FILE__ ) ).'/lang' );

		}

		function admin_settings_link_WeConnectchat( $links ) {
			$settings_link = '<a href="options-general.php?page=WeConnectchat">' . __( 'Settings' ) . '</a>';
			array_push( $links, $settings_link );
			return $links;
		}

		function wcct_admin_init() {

			// register settings for sitewide script
			register_setting( 'WeConnectchat-settings-group', 'WeConnectchat-plugin-settings' );

			add_settings_field( 'script', 'Script', 'trim','WeConnectchat' );
			add_settings_field( 'showOn', 'Show On', 'trim','WeConnectchat' );

			// default value for settings
			$initialSettings = get_option( 'WeConnectchat-plugin-settings' );
			if ( $initialSettings === false || !$initialSettings['showOn'] ) {
				$initialSettings['showOn'] = 'all';
   			 	update_option( 'WeConnectchat-plugin-settings', $initialSettings );
			}

			// add meta box to all post types
			//add_meta_box('wcct_all_post_meta', esc_html__('WeConnect.chat Script:', 'WeConnectchat-settings'), 'wcct_meta_setup', array('post','page'), 'normal', 'default');


		}



		// adds menu item to wordpress admin dashboard
		function wcct_admin_menu() {
			$page = add_submenu_page( 'options-general.php', __('weconnect.chat', 'WeConnectchat-settings'), __('WeConnect.chat', 'WeConnectchat-settings'), 'manage_options', 'WeConnectchat', array( &$this, 'wcct_options_panel' ) );
		}

		function wcct_head() {

			$settings = get_option( 'WeConnectchat-plugin-settings');


			if(is_array($settings) && array_key_exists('script', $settings)) {
				$script = $settings['script'];
				$showOn = $settings['showOn'];

				// main bot
				if ( $script != '' ) {
					if(($showOn === 'all') || ($showOn === 'home' && (is_home() || is_front_page())) || ($showOn === 'nothome' && !is_home() && !is_front_page()) || !$showOn === 'none') {
						echo $script;
					}
				}
			}

			// post and page bots
			$cc_post_meta = get_post_meta( get_the_ID(), '_inpost_head_script' , TRUE );
			if ( $cc_post_meta != '' && !is_home() && !is_front_page()) {
				echo $cc_post_meta['synth_header_script'];
			}

		}

		function wcct_options_panel() {
				// Load options page
				require_once(WCCT_PLUGIN_DIR . '/options.php');
		}
	}


	$scripts = new WCCTScriptLoader();


}
?>