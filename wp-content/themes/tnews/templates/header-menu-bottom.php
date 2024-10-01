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
        exit();
    }

    if( defined( 'CMB2_LOADED' )  ){
        if( !empty( tnews_meta('page_breadcrumb_area') ) ) {
            $tnews_page_breadcrumb_area  = tnews_meta('page_breadcrumb_area');
        } else {
            $tnews_page_breadcrumb_area = '1';
        }
    }else{
        $tnews_page_breadcrumb_area = '1';
    }
    
    $allowhtml = array(
        'p'         => array(
            'class'     => array()
        ),
        'span'      => array(
            'class'     => array(),
        ),
        'a'         => array(
            'href'      => array(),
            'title'     => array()
        ),
        'br'        => array(),
        'em'        => array(),
        'strong'    => array(),
        'b'         => array(),
        'sub'       => array(),
        'sup'       => array(),
    );

    if( class_exists( 'ReduxFramework' )  ){
        $tnews_page_breadcumb_layout  = tnews_opt('tnews_page_breadcumb_layout');
        $tnews_page_title_tag    = tnews_opt('tnews_page_title_tag');
    }else{
        $tnews_page_breadcumb_layout = '2';
        $tnews_page_title_tag    = 'h1';
    }
    
    if(  is_page() || is_page_template( 'template-builder.php' )  ) {
        if( $tnews_page_breadcrumb_area == '1' ) {
            echo '<!-- Page title 2 -->';
            echo '<div class="breadcumb-wrapper" id="breadcumbwrap">';
                echo '<div class="container">';
                    echo '<div class="row">';
                        echo '<div class="breadcumb-content">';
                            //Page title show if breadcumb layout 2
                            if( $tnews_page_breadcumb_layout == 2 ){

                                if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {
                                    if( !empty( tnews_meta('page_breadcrumb_settings') ) ) {
                                        if( tnews_meta('page_breadcrumb_settings') == 'page' ) {
                                            $tnews_page_title_switcher = tnews_meta('page_title');
                                        } else {
                                            $tnews_page_title_switcher = tnews_opt('tnews_page_title_switcher');
                                        }
                                    } else {
                                        $tnews_page_title_switcher = '1';
                                    }
                                } else {
                                    $tnews_page_title_switcher = '1';
                                }

                                if( $tnews_page_title_switcher ){
                                    if( class_exists( 'ReduxFramework' ) ){
                                        $tnews_page_title_tag    = tnews_opt('tnews_page_title_tag');
                                    }else{
                                        $tnews_page_title_tag    = 'h1';
                                    }

                                    if( defined( 'CMB2_LOADED' )  ){
                                        if( !empty( tnews_meta('page_title_settings') ) ) {
                                            $tnews_custom_title = tnews_meta('page_title_settings');
                                        } else {
                                            $tnews_custom_title = 'default';
                                        }
                                    }else{
                                        $tnews_custom_title = 'default';
                                    }

                                    if( $tnews_custom_title == 'default' ) {
                                        echo tnews_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $tnews_page_title_tag ),
                                                "text"  => esc_html( get_the_title( ) ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    } else {
                                        echo tnews_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $tnews_page_title_tag ),
                                                "text"  => esc_html( tnews_meta('custom_page_title') ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    }

                                }
                                
                            } //end

                            //front_page title if style 1
                            if ( is_front_page() ){

                                if( !empty($tnews_page_breadcumb_layout) && $tnews_page_breadcumb_layout == 1){
                                    echo tnews_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $tnews_page_title_tag ),
                                            "text"  => esc_html( get_the_title( ) ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );

                                }
                               
                            }

                            if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {

                                if( tnews_meta('page_breadcrumb_settings') == 'page' ) {
                                    $tnews_breadcrumb_switcher = tnews_meta('page_breadcrumb_trigger');
                                } else {
                                    $tnews_breadcrumb_switcher = tnews_opt('tnews_enable_breadcrumb');
                                }

                            } else {
                                $tnews_breadcrumb_switcher = '1';
                            }

                            if( $tnews_breadcrumb_switcher == '1' && (  is_page() || is_page_template( 'template-builder.php' ) )) {
                                    tnews_breadcrumbs(
                                        array(
                                            'breadcrumbs_classes' => '',
                                        )
                                    );
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<!-- End of Page title -->';
            
        }
    } else {
        echo '<!-- Page title 3 -->';
         if( class_exists( 'ReduxFramework' ) ){
            if (class_exists( 'woocommerce' ) && is_shop()){
            $breadcumb_bg_class = 'custom-woo-class';
            }elseif(is_404()){
                $breadcumb_bg_class = 'custom-error-class';
            }elseif(is_search()){
                $breadcumb_bg_class = 'custom-search-class';
            }elseif(is_archive()){
                $breadcumb_bg_class = 'custom-archive-class';
            }else{
                $breadcumb_bg_class = '';
            }
        }else{
            $breadcumb_bg_class = '';
        }
        echo '<div class="breadcumb-wrapper '. esc_attr($breadcumb_bg_class).'">';
            echo '<div class="container z-index-common">';
                    echo '<div class="breadcumb-content">';

                        //front_page title if style 1
                        if ( is_front_page() ){
                                
                            if( !empty($tnews_page_breadcumb_layout) && $tnews_page_breadcumb_layout == 1){
                                echo tnews_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $tnews_page_title_tag ),
                                        "text"  => esc_html__( 'Latest News', 'tnews' ),
                                        'class' => 'breadcumb-title'
                                    )
                                );

                            }
                           
                        }

                        //Page title show if breadcumb layout 2
                        if( $tnews_page_breadcumb_layout == 2 ){

                            if( class_exists( 'ReduxFramework' )  ){
                                $tnews_page_title_switcher  = tnews_opt('tnews_page_title_switcher');
                            }else{
                                $tnews_page_title_switcher = '2';
                            }

                            if( $tnews_page_title_switcher ){
                                if( class_exists( 'ReduxFramework' ) ){
                                    $tnews_page_title_tag    = tnews_opt('tnews_page_title_tag');
                                }else{
                                    $tnews_page_title_tag    = 'h1';
                                }
                                if( class_exists('woocommerce') && is_shop() ) {
                                    echo tnews_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $tnews_page_title_tag ),
                                            "text"  => wp_kses( woocommerce_page_title( false ), $allowhtml ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }elseif ( is_archive() ){
                                    echo tnews_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $tnews_page_title_tag ),
                                            "text"  => wp_kses( get_the_archive_title(), $allowhtml ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }elseif ( is_home() ){
                                    $tnews_blog_page_title_setting = tnews_opt('tnews_blog_page_title_setting');
                                    $tnews_blog_page_title_switcher = tnews_opt('tnews_blog_page_title_switcher');
                                    $tnews_blog_page_custom_title = tnews_opt('tnews_blog_page_custom_title');
                                    if( class_exists('ReduxFramework') ){
                                        if( $tnews_blog_page_title_switcher ){
                                            echo tnews_heading_tag(
                                                array(
                                                    "tag"   => esc_attr( $tnews_page_title_tag ),
                                                    "text"  => !empty( $tnews_blog_page_custom_title ) && $tnews_blog_page_title_setting == 'custom' ? esc_html( $tnews_blog_page_custom_title) : esc_html__( 'Latest News', 'tnews' ),
                                                    'class' => 'breadcumb-title'
                                                )
                                            );
                                        }
                                    }else{
                                        echo tnews_heading_tag(
                                            array(
                                                "tag"   => "h1",
                                                "text"  => esc_html__( 'Latest News', 'tnews' ),
                                                'class' => 'breadcumb-title',
                                            )
                                        );
                                    }
                                }elseif( is_search() ){
                                    echo tnews_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $tnews_page_title_tag ),
                                            "text"  => esc_html__( 'Search Result', 'tnews' ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }elseif( is_404() ){
                                    echo tnews_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $tnews_page_title_tag ),
                                            "text"  => esc_html__( 'Error Page', 'tnews' ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }elseif( is_singular( 'product' ) ){
                                    $posttitle_position  = tnews_opt('tnews_product_details_title_position');
                                    $postTitlePos = false;
                                    if( class_exists( 'ReduxFramework' ) ){
                                        if( $posttitle_position && $posttitle_position != 'header' ){
                                            $postTitlePos = true;
                                        }
                                    }else{
                                        $postTitlePos = false;
                                    }

                                    if( $postTitlePos != true ){
                                        echo tnews_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $tnews_page_title_tag ),
                                                "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    } else {
                                        if( class_exists( 'ReduxFramework' ) ){
                                            $tnews_post_details_custom_title  = tnews_opt('tnews_product_details_custom_title');
                                        }else{
                                            $tnews_post_details_custom_title = __( 'Shop Details','tnews' );
                                        }

                                        if( !empty( $tnews_post_details_custom_title ) ) {
                                            echo tnews_heading_tag(
                                                array(
                                                    "tag"   => esc_attr( $tnews_page_title_tag ),
                                                    "text"  => wp_kses( $tnews_post_details_custom_title, $allowhtml ),
                                                    'class' => 'breadcumb-title'
                                                )
                                            );
                                        }
                                    }
                                }else{
                                    $posttitle_position  = tnews_opt('tnews_post_details_title_position');
                                    $postTitlePos = false;
                                    if( is_single() ){
                                        if( class_exists( 'ReduxFramework' ) ){
                                            if( $posttitle_position && $posttitle_position != 'header' ){
                                                $postTitlePos = true;
                                            }
                                        }else{
                                            $postTitlePos = false;
                                        }
                                    }
                                    if( is_singular( 'product' ) ){
                                        $posttitle_position  = tnews_opt('tnews_product_details_title_position');
                                        $postTitlePos = false;
                                        if( class_exists( 'ReduxFramework' ) ){
                                            if( $posttitle_position && $posttitle_position != 'header' ){
                                                $postTitlePos = true;
                                            }
                                        }else{
                                            $postTitlePos = false;
                                        }
                                    }

                                    if( $postTitlePos != true ){
                                        echo tnews_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $tnews_page_title_tag ),
                                                "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    } else {
                                        if( class_exists( 'ReduxFramework' ) ){
                                            $tnews_post_details_custom_title  = tnews_opt('tnews_post_details_custom_title');
                                        }else{
                                            $tnews_post_details_custom_title = __( 'Blog Details','tnews' );
                                        }

                                        if( !empty( $tnews_post_details_custom_title ) ) {
                                            echo tnews_heading_tag(
                                                array(
                                                    "tag"   => esc_attr( $tnews_page_title_tag ),
                                                    "text"  => wp_kses( $tnews_post_details_custom_title, $allowhtml ),
                                                    'class' => 'breadcumb-title'
                                                )
                                            );
                                        }
                                    }
                                }
                            }
                        } //end

                        if( class_exists('ReduxFramework') ) {
                            $tnews_breadcrumb_switcher = tnews_opt( 'tnews_enable_breadcrumb' );
                        } else {
                            $tnews_breadcrumb_switcher = '1';
                        }
                        if( $tnews_breadcrumb_switcher == '1' ) {
                            if(tnews_breadcrumbs()){
                            echo '<div>';
                                tnews_breadcrumbs(
                                    array(
                                        'breadcrumbs_classes' => 'nav',
                                    )
                                );
                            echo '</div>';
                            }
                        }
                    echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<!-- End of Page title -->';
    }