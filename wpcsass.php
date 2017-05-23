<?php
/*
* Plugin Name: WPCSASS
* Description: A plugin which passes Customizer variables to Sass.
* Author: Joe McGrath
* Version: 1.0.0
* Author URI: http://www.jmcgrath.co.uk
* License: GNU General Public License v2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( "ABSPATH" ) ) exit; // Exit if accessed directly.

function wpcsass_init() {
	if ( is_customize_preview() ) :
		require_once plugin_dir_path( __FILE__ ) . 'inc/custom_controls.php';
		require_once plugin_dir_path( __FILE__ ) . 'inc/class_wpcsass.php';
	endif;
}
add_action('wp_loaded', 'wpcsass_init');
?>
