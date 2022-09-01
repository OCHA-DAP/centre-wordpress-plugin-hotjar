<?php

// No direct access to this file
if(!defined('ABSPATH')) {
	exit;
}

class Hotjar {

	public function __construct() { }

	public function init() {
		$this->init_admin();
		$this->enqueue_script();
	}

	public function init_admin() {
		register_setting('custom-hotjar', 'hotjar_site_id');
		add_action('admin_menu', [$this, 'create_nav_page']);
	}

	public function create_nav_page() {
		add_options_page(
			__('Hotjar Tracking Code', 'custom-hotjar'),
			__('Hotjar Tracking Code', 'custom-hotjar'),
			'manage_options',
			'hotjar_tracking_code',
			[$this,'admin_view']
		);
	}

	public static function admin_view() {
		require_once plugin_dir_path( __FILE__ ).'/../admin/views/tracking_code.php';
	}

	public static function hotjar_code() {
		$hotjar_site_id = get_option('hotjar_site_id');
		$is_admin = is_admin();

		$hotjar_site_id = trim($hotjar_site_id);
		if(!$hotjar_site_id) {
			return;
		}

		if ($is_admin) {
			return;
		}

		echo "
		<script>
			(function(h,o,t,j,a,r){
				h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
				h._hjSettings={hjid:".$hotjar_site_id.",hjsv:5};
				a=o.getElementsByTagName('head')[0];
				r=o.createElement('script');r.async=1;
				r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
				a.appendChild(r);
			})(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
		</script>
		";
	}

	private function enqueue_script() {
		add_action('wp_head', [$this, 'hotjar_code']);
	}

}