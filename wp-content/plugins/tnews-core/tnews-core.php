<?php
/**
 * 
 * Plugin Name: Tnews Core
 * Description: This is a helper plugin of tnews theme
 * Version:     1.0
 * Author:      Themeholy
 * Author URI:  https://themeforest.net/user/themeholy 
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * Text Domain: tnews
 * 
 */

// Blocking direct access

if( ! defined( 'ABSPATH' ) ) {

    exit();

}

// Define Constant

define( 'TNEWS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

define( 'TNEWS_PLUGIN_INC_PATH', plugin_dir_path( __FILE__ ) . 'inc/' );
define( 'TNEWS_PLUGIN_CMB2EXT_PATH', plugin_dir_path( __FILE__ ) . 'cmb2-ext/' );

define( 'TNEWS_PLUGIN_WIDGET_PATH', plugin_dir_path( __FILE__ ) . 'inc/widgets/' );

define( 'TNEWS_PLUGDIRURI', plugin_dir_url( __FILE__ ) );

define( 'TNEWS_ADDONS', plugin_dir_path( __FILE__ ) .'addons/' );

define( 'TNEWS_ASSETS', plugin_dir_url( __FILE__ ) .'assets/' );

define( 'TNEWS_CORE_PLUGIN_TEMP', plugin_dir_path( __FILE__ ) .'tnews-template/' );

// load textdomain

load_plugin_textdomain( 'tnews', false, basename( dirname( __FILE__ ) ) . '/languages' );

//include file.

require_once TNEWS_PLUGIN_INC_PATH .'tnewscore-functions.php';
require_once TNEWS_PLUGIN_INC_PATH .'builder/builder.php';
require_once TNEWS_PLUGIN_INC_PATH . 'MCAPI.class.php';
require_once TNEWS_PLUGIN_INC_PATH .'tnewsajax.php';

require_once TNEWS_PLUGIN_CMB2EXT_PATH . 'cmb2ext-init.php';

//Widget

require_once TNEWS_PLUGIN_WIDGET_PATH . 'recent-post-widget.php';
require_once TNEWS_PLUGIN_WIDGET_PATH . 'search-form.php';
require_once TNEWS_PLUGIN_WIDGET_PATH . 'categories-lists.php';
require_once TNEWS_PLUGIN_WIDGET_PATH . 'about-us-widget.php';
// require_once TNEWS_PLUGIN_WIDGET_PATH . 'author-widget.php';
// require_once TNEWS_PLUGIN_WIDGET_PATH . 'offer-banner.php';
require_once TNEWS_PLUGIN_WIDGET_PATH . 'banner-ads.php';

//addons

require_once TNEWS_ADDONS . 'addons.php';

// Register widget styles
add_action( 'elementor/editor/after_enqueue_scripts', 'widget_styles' );

function widget_styles() {

    wp_register_style( 'editor-style-1', plugins_url( 'assets/css/editor.css', __FILE__ ) );
    wp_enqueue_style( 'editor-style-1' );

}
