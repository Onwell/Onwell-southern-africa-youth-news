<?php
/**
 * @Packge     : Tnews
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

    if( class_exists( 'ReduxFramework' ) && defined('ELEMENTOR_VERSION') ) {
        if( is_page() || is_page_template('template-builder.php') ) {
            $tnews_post_id = get_the_ID();

            // Get the page settings manager
            $tnews_page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

            // Get the settings model for current post
            $tnews_page_settings_model = $tnews_page_settings_manager->get_model( $tnews_post_id );

            // Retrieve the color we added before
            $tnews_header_style = $tnews_page_settings_model->get_settings( 'tnews_header_style' );
            $tnews_header_builder_option = $tnews_page_settings_model->get_settings( 'tnews_header_builder_option' );

            if( $tnews_header_style == 'header_builder'  ) {

                if( !empty( $tnews_header_builder_option ) ) {
                    $tnewsheader = get_post( $tnews_header_builder_option );
                    echo '<header class="header">';
                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $tnewsheader->ID );
                    echo '</header>';
                }
            } else {
                // global options
                $tnews_header_builder_trigger = tnews_opt('tnews_header_options');
                if( $tnews_header_builder_trigger == '2' ) {
                    echo '<header>';
                    $tnews_global_header_select = get_post( tnews_opt( 'tnews_header_select_options' ) );
                    $header_post = get_post( $tnews_global_header_select );
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $header_post->ID );
                    echo '</header>';
                } else {
                    // wordpress Header
                    tnews_global_header_option();
                }
            }
        } else {
            $tnews_header_options = tnews_opt('tnews_header_options');
            if( $tnews_header_options == '1' ) {
                tnews_global_header_option();
            } else {
                $tnews_header_select_options = tnews_opt('tnews_header_select_options');
                $tnewsheader = get_post( $tnews_header_select_options );
                echo '<header class="header">';
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $tnewsheader->ID );
                echo '</header>';
            }
        }
    } else {
        tnews_global_header_option();
    }