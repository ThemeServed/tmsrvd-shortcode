<?php
/**
 * Plugin Name: TmsrvdShortcodes
 * Plugin URI: http://www.themeserved.com/plugins/tmsrvdshortcodes
 * Description: A simple shortcode generator. Add buttons, columns, tabs, toggles and alerts to your theme.
 * Version: '1.0.0'
 * Author: ThemeServed
 * Author URI: http://www.themeserved.com
 */

class TmsrvdShortcodes {

    function __construct()
    {
    	define( 'TMSRVD_VERSION', '1.0.0' );

    	// Plugin folder path
    	if ( ! defined( 'TMSRVD_PLUGIN_DIR' ) ) {
    		define( 'TMSRVD_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
    	}

    	// Plugin folder URL
    	if ( ! defined( 'TMSRVD_PLUGIN_URL' ) ) {
    		define( 'TMSRVD_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
    	}

    	require_once( TMSRVD_PLUGIN_DIR .'includes/shortcodes.php' );

        add_action( 'wp_enqueue_scripts', array(&$this, 'init') );
        add_action( 'admin_init', array(&$this, 'admin_init') );
	}

	/**
	 * Enqueue front end scripts and styles
	 *
	 * @return	void
	 */
	function init()
	{
		if( ! is_admin() )
		{
			wp_enqueue_style( 'tmsrvd-shortcodes', TMSRVD_PLUGIN_URL . 'assets/css/shortcodes.css' );
			wp_enqueue_script( 'tmsrvd-shortcodes-bootstrap', TMSRVD_PLUGIN_URL . 'assets/js/bootstrap.js', array('jquery') );
			wp_enqueue_script( 'tmsrvd-shortcodes-lib', TMSRVD_PLUGIN_URL . 'assets/js/tmsrvd-shortcodes-lib.js', array('jquery') );
		}
	}

	/**
	 * Enqueue Scripts and Styles
	 *
	 * @return	void
	 */
	function admin_init()
	{
		include_once( TMSRVD_PLUGIN_DIR . 'includes/class-tmsrvd-admin-insert.php' );

		// css
		wp_enqueue_style( 'tmsrvd-popup', TMSRVD_PLUGIN_URL . 'assets/css/admin.css', false, '1.0', 'all' );

		// js
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_localize_script( 'jquery', 'TmsrvdShortcodes', array('plugin_folder' => WP_PLUGIN_URL .'/tmsrvd-shortcodes') );
	}
}

global $tmsrvd_shortcodes;
$tmsrvd_shortcodes = new TmsrvdShortcodes();

?>