<?php
/*
 * Plugin Name: Set-up Hotjar Tracking Code
 * Description: This plugin will insert the Hotjar tracking code with the tracking ID provided by user.
 * Version: 1.0
 * Author: The Centre for Humanitarian Data
 * Author URI: https://centre.humdata.org
**/

// No direct access to this file
if(!defined('ABSPATH')) {
	exit;
}

add_action('plugins_loaded', 'hotjar_plugin_init');

function hotjar_plugin_init() {

	if(!class_exists('WP_Hotjar')) {

		class WP_Hotjar {
			/**
			 * @var Singleton The reference the *Singleton* instance of this class
			 */
			private static $instance;

			/**
			 * Returns the *Singleton* instance of this class.
			 *
			 * @return Singleton The *Singleton* instance.
			 */
			public static function get_instance() {
				if (null === self::$instance) {
					self::$instance = new self();
				}
				return self::$instance;
			}

			/**
			 * Cloning and unserialization are not permitted for singletons
			 */
			private function __clone() {}

			public function __wakeup() {}

			/**
			 * Protected constructor to prevent creating a new instance of the
			 * *Singleton* via the `new` operator from outside of this class.
			 */
			private function __construct() {
				$this->init();
			}

			/**
			 * Init the plugin after plugins_loaded so environment variables are set.
			 *
			 * @since 1.0.0
			 */
			public function init() {
				require_once(dirname(__FILE__).'/includes/class-hotjar.php');
				$hotjar = new Hotjar();
				$hotjar->init();
			}
		}

		WP_Hotjar::get_instance();

	}

}