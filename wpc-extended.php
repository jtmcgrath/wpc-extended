<?php
/*
* Plugin Name: WPC Extended
* Description: A plugin which extends the WordPress Customizer.
* Author: Joe McGrath
* Version: 1.0.0
* Author URI: http://www.jmcgrath.co.uk
* License: GNU General Public License v2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( "ABSPATH" ) ) exit; // Exit if accessed directly.

require_once plugin_dir_path( __FILE__ ) . 'inc/class_wpc_extended.php';

function wpc_extended_init() {
	if ( is_customize_preview() ) :
		require_once plugin_dir_path( __FILE__ ) . 'inc/custom_controls.php';
	endif;
}
add_action('wp_loaded', 'wpc_extended_init');
?>
