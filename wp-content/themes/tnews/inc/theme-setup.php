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

if ( ! function_exists( 'tnews_setup' ) ){
    function tnews_setup() {

        // content width
        $GLOBALS['content_width'] = apply_filters( 'tnews_content_width', 751 );

        // language file
		load_theme_textdomain( 'tnews', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// title tag
		add_theme_support( 'title-tag' );

		// post thumbnails
		add_theme_support( 'post-thumbnails' );

        add_image_size( 'tnews-shop-single',580,580,true );
        add_image_size( 'tnews-shop-thumb',100,106,true );
        add_image_size( 'tnews-shop-small-image',294,312,true ); 
        add_image_size( 'tnews_80X80',80,80,true );
		//Blog list & masonary size
        add_image_size( 'tnews_270X220',270,220,true );
        add_image_size( 'tnews_288X187',288,187,true );
        add_image_size( 'tnews_288X320',288,320,true );
        add_image_size( 'tnews_392X310',392,310,true );

        register_nav_menus( array(
            'primary-menu'      => esc_html__( 'Primary Menu', 'tnews' ),
            'footer-menu'      => esc_html__( 'Footer Menu', 'tnews' ),
        ) );

		//support html5
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style'
			)
		);


        // support post format
        add_theme_support( 'post-formats', array( 'audio', 'video', 'gallery', 'quote') );

		// Custom logo
		add_theme_support( 'custom-logo' );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'assets/css/style-editor.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

        // support woocommerce
        add_theme_support( 'woocommerce' );
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-slider' );

	}
}
add_action( 'after_setup_theme', 'tnews_setup' );