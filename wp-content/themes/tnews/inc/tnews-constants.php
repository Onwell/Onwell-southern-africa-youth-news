<?php
/**
 * @Packge     : Tnews
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

// Block direct access
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 *
 * Define constant 
 *
 */

// Base URI
if ( ! defined( 'TNEWS_DIR_URI' ) ) {
    define('TNEWS_DIR_URI', get_parent_theme_file_uri().'/' );
}

// Assist URI
if ( ! defined( 'TNEWS_DIR_ASSIST_URI' ) ) {
    define( 'TNEWS_DIR_ASSIST_URI', get_theme_file_uri('/assets/') );
}


// Css File URI
if ( ! defined( 'TNEWS_DIR_CSS_URI' ) ) {
    define( 'TNEWS_DIR_CSS_URI', get_theme_file_uri('/assets/css/') );
}

// Js File URI
if (!defined('TNEWS_DIR_JS_URI')) {
    define('TNEWS_DIR_JS_URI', get_theme_file_uri('/assets/js/'));
}


// Base Directory
if (!defined('TNEWS_DIR_PATH')) {
    define('TNEWS_DIR_PATH', get_parent_theme_file_path() . '/');
}

//Inc Folder Directory
if (!defined('TNEWS_DIR_PATH_INC')) {
    define('TNEWS_DIR_PATH_INC', TNEWS_DIR_PATH . 'inc/');
}

//TNEWS framework Folder Directory
if (!defined('TNEWS_DIR_PATH_FRAM')) {
    define('TNEWS_DIR_PATH_FRAM', TNEWS_DIR_PATH_INC . 'tnews-framework/');
}

//Hooks Folder Directory
if (!defined('TNEWS_DIR_PATH_HOOKS')) {
    define('TNEWS_DIR_PATH_HOOKS', TNEWS_DIR_PATH_INC . 'hooks/');
}

//Demo Data Folder Directory Path
if( !defined( 'TNEWS_DEMO_DIR_PATH' ) ){
    define( 'TNEWS_DEMO_DIR_PATH', TNEWS_DIR_PATH_INC.'demo-data/' );
}
    
//Demo Data Folder Directory URI
if( !defined( 'TNEWS_DEMO_DIR_URI' ) ){
    define( 'TNEWS_DEMO_DIR_URI', TNEWS_DIR_URI.'inc/demo-data/' );
}