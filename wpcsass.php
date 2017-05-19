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

if ( is_customize_preview() || is_admin() ) :
	require_once plugin_dir_path( __FILE__ ) . 'inc/class_wpcsass.php';

	$wpcsass = new WPC_Sass;
endif;
?>
