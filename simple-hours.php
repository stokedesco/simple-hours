<?php
/*
Plugin Name: Simple Hours
Description: Lean plugin for setting weekly hours and holiday overrides.
Version: 1.0
Author: Stoke Design Co
Text Domain: simple-hours
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Plugin directory and URL
if ( ! defined( 'SH_DIR' ) ) {
    define( 'SH_DIR', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'SH_URL' ) ) {
    define( 'SH_URL', plugin_dir_url( __FILE__ ) );
}

// Core includes
require_once SH_DIR . 'includes/class-sh-settings.php';
require_once SH_DIR . 'includes/class-sh-shortcodes.php';
require_once SH_DIR . 'includes/class-sh-schema.php';
require_once SH_DIR . 'includes/class-sh-logger.php';

add_action( 'plugins_loaded', array( 'SH_Shortcodes', 'init' ) );
add_action( 'init', array( 'SH_Shortcodes', 'register_gutenberg_blocks' ) );

/**
 * Load Elementor integration only when Elementor is active.
 */
function sh_maybe_load_elementor_widget() {
    if ( class_exists( '\\Elementor\\Widget_Base' ) || did_action( 'elementor/loaded' ) ) {
        require_once SH_DIR . 'includes/class-sh-elementor.php';
        add_action( 'elementor/widgets/register', array( 'SH_Elementor_Widget', 'register_widget' ) );
    } else {
        add_action( 'admin_notices', function() {
            echo '<div class="notice notice-warning"><p>' . esc_html__( 'Elementor must be active for Simple Hours widget.', 'simple-hours' ) . '</p></div>';
        } );
    }
}
add_action( 'plugins_loaded', 'sh_maybe_load_elementor_widget' );
