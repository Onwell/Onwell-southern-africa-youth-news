<?php
/**
 * @Packge     : Tnews
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */


// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit;
}

function tnews_widgets_init() {

    if( class_exists('ReduxFramework') ) {
        $tnews_sidebar_widget_title_heading_tag = tnews_opt('tnews_sidebar_widget_title_heading_tag');
    } else {
        $tnews_sidebar_widget_title_heading_tag = 'h3';
    }

    //sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Blog Sidebar', 'tnews' ),
        'id'            => 'tnews-blog-sidebar',
        'description'   => esc_html__( 'Add Blog Sidebar Widgets Here.', 'tnews' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget_title">',
        'after_title'   => '</h3>',
    ) );

    // page sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Page Sidebar', 'tnews' ),
        'id'            => 'tnews-page-sidebar',
        'description'   => esc_html__( 'Add Page Sidebar Widgets Here.', 'tnews' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget_title">',
        'after_title'   => '</h3>',
    ) );
    if( class_exists( 'ReduxFramework' ) ){
        // footer widgets register
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 1', 'tnews' ),
           'id'            => 'tnews-footer-1',
           'before_widget' => '<div class="col-md-6 col-xl-3"><div id="%1$s" class="widget footer-widget %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 2', 'tnews' ),
           'id'            => 'tnews-footer-2',
           'before_widget' => '<div class="col-md-6 col-xl-auto"><div id="%1$s" class="widget widget_nav_menu footer-widget %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 3', 'tnews' ),
           'id'            => 'tnews-footer-3',
           'before_widget' => '<div class="col-md-6 col-xl-auto"><div id="%1$s" class="widget footer-widget %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 4', 'tnews' ),
           'id'            => 'tnews-footer-4',
           'before_widget' => '<div class="col-md-6 col-xl-3"><div id="%1$s" class="widget widget_tag_cloud footer-widget %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Offcanvas Sidebar', 'tnews' ),
           'id'            => 'tnews-offcanvas',
           'before_widget' => '<div id="%1$s" class="widget %2$s">',
           'after_widget'  => '</div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
    }
    if( class_exists('woocommerce') ) {
        register_sidebar(
            array(
                'name'          => esc_html__( 'WooCommerce Sidebar', 'tnews' ),
                'id'            => 'tnews-woo-sidebar',
                'description'   => esc_html__( 'Add widgets here to appear in your woocommerce page sidebar.', 'tnews' ),
                'before_widget' => '<div class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="widget_title">',
                'after_title'   => '</h4>',
            )
        );
    }

}

add_action( 'widgets_init', 'tnews_widgets_init' );