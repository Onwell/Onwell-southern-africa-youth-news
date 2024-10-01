<?php


// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Include File
 *
 */

// Constants
require_once get_parent_theme_file_path() . '/inc/tnews-constants.php';

//theme setup
require_once TNEWS_DIR_PATH_INC . 'theme-setup.php';

//essential scripts
require_once TNEWS_DIR_PATH_INC . 'essential-scripts.php';

// Woo Hooks
require_once TNEWS_DIR_PATH_INC . 'woo-hooks/tnews-woo-hooks.php';

// Woo Hooks Functions
require_once TNEWS_DIR_PATH_INC . 'woo-hooks/tnews-woo-hooks-functions.php';

// plugin activation
require_once TNEWS_DIR_PATH_FRAM . 'plugins-activation/tnews-active-plugins.php';

// theme dynamic css
require_once TNEWS_DIR_PATH_INC . 'tnews-commoncss.php';

// meta options
require_once TNEWS_DIR_PATH_FRAM . 'tnews-meta/tnews-config.php';

// page breadcrumbs
require_once TNEWS_DIR_PATH_INC . 'tnews-breadcrumbs.php';

// sidebar register
require_once TNEWS_DIR_PATH_INC . 'tnews-widgets-reg.php';

//essential functions
require_once TNEWS_DIR_PATH_INC . 'tnews-functions.php';

// helper function
require_once TNEWS_DIR_PATH_INC . 'wp-html-helper.php';

// Demo Data
require_once TNEWS_DEMO_DIR_PATH . 'demo-import.php';

// pagination
require_once TNEWS_DIR_PATH_INC . 'wp_bootstrap_pagination.php';

// tnews options
require_once TNEWS_DIR_PATH_FRAM . 'tnews-options/tnews-options.php';

// hooks
require_once TNEWS_DIR_PATH_HOOKS . 'hooks.php';

// hooks funtion
require_once TNEWS_DIR_PATH_HOOKS . 'hooks-functions.php';

//Post Masonary template functions
require_once TNEWS_DIR_PATH_INC . 'tnews-post-masonary.php';