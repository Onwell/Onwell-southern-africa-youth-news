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


    // preloader hook function
    if( ! function_exists( 'tnews_preloader_wrap_cb' ) ) {
        function tnews_preloader_wrap_cb() {
            $preloader_display              =  tnews_opt('tnews_display_preloader');
            ?>
            <div class="th-cursor"></div>
            <?php
            if( class_exists('ReduxFramework') ){
                if( $preloader_display ){?>
                    <div class="preloader ">
                        <button class="th-btn preloaderCls"><?php echo esc_html__( 'Cancel Preloader', 'tnews' ) ?></button>
                        <div class="preloader-inner">
                            <span class="loader"></span>
                        </div>
                    </div>
                <?php }
            }else{ ?>
                <div class="preloader ">
                    <button class="th-btn preloaderCls"><?php echo esc_html__( 'Cancel Preloader', 'tnews' ) ?></button>
                    <div class="preloader-inner">
                        <span class="loader"></span>
                    </div>
                </div>

            <?php }
        }
    }

    // Subscribe Popup hook function
    if( ! function_exists( 'tnews_subscribe_popup_wrap_cb' ) ) {
        function tnews_subscribe_popup_wrap_cb() {
            if( class_exists('ReduxFramework') ){
                $popup_display    =  tnews_opt('tnews_display__popup');
                $popup_title      =  tnews_opt('tnews_popup_title');
                $popup_desc       =  tnews_opt('tnews_popup_desc');
                $popup_placeholder      =  tnews_opt('tnews_popup_placeholder');
                $popup_note      =  tnews_opt('tnews_popup_note');
                
                if( $popup_display ){
                    echo '<div class="popup-subscribe-area">';
                        echo '<div class="container">';
                            echo '<div class="popup-subscribe">';
                                echo '<div class="box-img">';
                                    if(!empty(tnews_opt('tnews_popup_image', 'url' ) )){
                                        echo '<img src="'.esc_url( tnews_opt('tnews_popup_image', 'url' ) ).'" alt="Image">';
                                    }else{
                                        echo '<img src="'.get_template_directory_uri().'/assets/img/popup_subscribe.jpg" alt="Image">';
                                    }
                                echo '</div>';

                                echo '<div class="box-content">';
                                    echo '<button class="simple-icon popupClose"><i class="fal fa-times"></i></button>';
                                    echo '<div class="widget newsletter-widget footer-widget">';
                                        echo '<h3 class="widget_title">'.esc_html( $popup_title ).'</h3>';
                                        echo '<p class="footer-text">'.esc_html( $popup_desc ).'</p>';
                                        echo '<form class="newsletter-form">';
                                            echo '<input class="form-control" type="email" placeholder="'.esc_attr( $popup_placeholder ).'" required="">';
                                            echo '<button type="submit" class="icon-btn"><i class="fa-solid fa-paper-plane"></i></button>';
                                        echo '</form>';
                                        echo '<div class="mt-30 note">';
                                            echo '<input type="checkbox" id="destroyPopup">';
                                            echo '<label for="destroyPopup">'.esc_html( $popup_note ).'</label>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';

                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }

            }
              
        }
    }

    // Header Hook function
    if( !function_exists('tnews_header_cb') ) { 
        function tnews_header_cb( ) {
            get_template_part('templates/header');
            get_template_part('templates/header-menu-bottom');
        }
    }

    // back top top hook function
    if( ! function_exists( 'tnews_back_to_top_cb' ) ) {
        function tnews_back_to_top_cb( ) {
            $backtotop_trigger = tnews_opt('tnews_display_bcktotop');
            if( class_exists( 'ReduxFramework' ) ) {
                if( $backtotop_trigger ) {
            	?>
                    <div class="scroll-top">
                        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
                            </path>
                        </svg>
                    </div>
                <?php 
                }
            }

        }
    }

    // Blog Start Wrapper Function
    if( !function_exists('tnews_blog_start_wrap_cb') ) {
        function tnews_blog_start_wrap_cb() { ?>
            <section class="th-blog-wrapper space-top space-extra-bottom arrow-wrap">
                <div class="container">
                    <div class="row">
        <?php }
    }

    // Blog End Wrapper Function
    if( !function_exists('tnews_blog_end_wrap_cb') ) {
        function tnews_blog_end_wrap_cb() {?>
                    </div>
                </div>
            </section>
        <?php }
    }

    // Blog Column Start Wrapper Function
    if( !function_exists('tnews_blog_col_start_wrap_cb') ) {
        function tnews_blog_col_start_wrap_cb() {
            if( class_exists('ReduxFramework') ) {
                $tnews_blog_sidebar = tnews_opt('tnews_blog_sidebar');
                if( $tnews_blog_sidebar == '2' && is_active_sidebar('tnews-blog-sidebar') ) {
                    echo '<div class="col-xxl-9 col-lg-8 order-lg-last">';
                } elseif( $tnews_blog_sidebar == '3' && is_active_sidebar('tnews-blog-sidebar') ) {
                    echo '<div class="col-xxl-9 col-lg-8">';
                } else {
                    echo '<div class="col-lg-12">';
                }

            } else {
                if( is_active_sidebar('tnews-blog-sidebar') ) {
                    echo '<div class="col-xxl-9 col-lg-8">';
                } else {
                    echo '<div class="col-lg-12">';
                }
            }
        }
    }
    // Blog Column End Wrapper Function
    if( !function_exists('tnews_blog_col_end_wrap_cb') ) {
        function tnews_blog_col_end_wrap_cb() {
            echo '</div>';
        }
    }

    // Blog Sidebar
    if( !function_exists('tnews_blog_sidebar_cb') ) {
        function tnews_blog_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $tnews_blog_sidebar = tnews_opt('tnews_blog_sidebar');
            } else {
                $tnews_blog_sidebar = 2;
                
            }
            if( $tnews_blog_sidebar != 1 && is_active_sidebar('tnews-blog-sidebar') ) {
                // Sidebar
                get_sidebar();
            }
        }
    }


    if( !function_exists('tnews_blog_details_sidebar_cb') ) {
        function tnews_blog_details_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $tnews_blog_single_sidebar = tnews_opt('tnews_blog_single_sidebar');
            } else {
                $tnews_blog_single_sidebar = 4;
            }
            if( $tnews_blog_single_sidebar != 1 ) {
                // Sidebar
                get_sidebar();
            }

        }
    }

    // Blog Pagination Function
    if( !function_exists('tnews_blog_pagination_cb') ) {
        function tnews_blog_pagination_cb( ) {
            get_template_part('templates/pagination');
        }
    }

    // Blog Content Function
    if( !function_exists('tnews_blog_content_cb') ) {
        function tnews_blog_content_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $tnews_blog_grid = tnews_opt('tnews_blog_grid');
            } else {
                $tnews_blog_grid = '1';
            }

            if( $tnews_blog_grid == '1' ) {
                $tnews_blog_grid_class = 'col-lg-12';
            } elseif( $tnews_blog_grid == '2' ) {
                $tnews_blog_grid_class = 'col-sm-6';
            } else {
                $tnews_blog_grid_class = 'col-lg-4 col-sm-6';
            }

            echo '<div class="row">';
                if( have_posts() ) {
                    while( have_posts() ) {
                        the_post();
                        echo '<div class="'.esc_attr($tnews_blog_grid_class).'">';
                            get_template_part('templates/content',get_post_format());
                        echo '</div>';
                    }
                    wp_reset_postdata();
                } else{
                    get_template_part('templates/content','none');
                }
            echo '</div>';
        }
    }

    // footer content Function
    if( !function_exists('tnews_footer_content_cb') ) {
        function tnews_footer_content_cb( ) {

            if( class_exists('ReduxFramework') && did_action( 'elementor/loaded' )  ){
                if( is_page() || is_page_template('template-builder.php') ) {
                    $post_id = get_the_ID();

                    // Get the page settings manager
                    $page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

                    // Get the settings model for current post
                    $page_settings_model = $page_settings_manager->get_model( $post_id );

                    // Retrieve the Footer Style
                    $footer_settings = $page_settings_model->get_settings( 'tnews_footer_style' );

                    // Footer Local
                    $footer_local = $page_settings_model->get_settings( 'tnews_footer_builder_option' );

                    // Footer Enable Disable
                    $footer_enable_disable = $page_settings_model->get_settings( 'tnews_footer_choice' );

                    if( $footer_enable_disable == 'yes' ){
                        if( $footer_settings == 'footer_builder' ) {
                            // local options
                            $tnews_local_footer = get_post( $footer_local );
                            echo '<footer>';
                            echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $tnews_local_footer->ID );
                            echo '</footer>';
                        } else {
                            // global options
                            $tnews_footer_builder_trigger = tnews_opt('tnews_footer_builder_trigger');
                            if( $tnews_footer_builder_trigger == 'footer_builder' ) {
                                echo '<footer>';
                                $tnews_global_footer_select = get_post( tnews_opt( 'tnews_footer_builder_select' ) );
                                $footer_post = get_post( $tnews_global_footer_select );
                                echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $footer_post->ID );
                                echo '</footer>';
                            } else {
                                // wordpress widgets
                                tnews_footer_global_option();
                            }
                        }
                    }
                } else {
                    // global options
                    $tnews_footer_builder_trigger = tnews_opt('tnews_footer_builder_trigger');
                    if( $tnews_footer_builder_trigger == 'footer_builder' ) {
                        echo '<footer>';
                        $tnews_global_footer_select = get_post( tnews_opt( 'tnews_footer_builder_select' ) );
                        $footer_post = get_post( $tnews_global_footer_select );
                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $footer_post->ID );
                        echo '</footer>';
                    } else {
                        // wordpress widgets
                        tnews_footer_global_option();
                    }
                }
            } else { ?>
                <div class="footer-layout4 footer-sitcky">
                    <div class="copyright-wrap bg-black">
                        <div class="container">
                            <p class="copyright-text text-center"><?php echo sprintf( 'Copyright <i class="fal fa-copyright"></i> %s <a href="%s"> %s </a> All Rights Reserved.', date('Y'), esc_url('#'), esc_html__( 'Tnews.','tnews') ); ?></p> 
                        </div>
                    </div>
                </div>
            <?php }

        }
    }

    // blog details wrapper start hook function
    if( !function_exists('tnews_blog_details_wrapper_start_cb') ) {
        function tnews_blog_details_wrapper_start_cb( ) {
            //Demo style show by get url varibale
            if ( isset( $_GET['layout'] ) ) {
                $layout_value = sanitize_text_field( $_GET['layout'] );
            }
            if( isset( $_GET['layout'] ) && ($layout_value === '2' || $layout_value === '3' || $layout_value === '4' || $layout_value === '5' )){
                if ( !empty($layout_value) ) {
                    $tnews_blog_single_layout = $layout_value;
                }else{
                    $tnews_blog_single_layout = 1;
                }
            }else{
                //Redux option work
                if( class_exists('ReduxFramework') ) {
                    $tnews_blog_single_layout = tnews_opt('tnews_blog_single_layout');
                }else{
                    $tnews_blog_single_layout = 1;
                }
            }//End - Demo style show by get url varibale
            
            //Blog details style 2 & 3
            if( $tnews_blog_single_layout == 2 || $tnews_blog_single_layout == 3 ) {
                $class = 'bg-smoke';
            }else{
                $class = '';
            }

            echo '<section class="th-blog-wrapper blog-details '.esc_attr($class).' space-top space-extra-bottom">';
                echo '<div class="container">';
                    if( is_active_sidebar( 'tnews-blog-sidebar' ) ){
                        $tnews_gutter_class = 'gx-60';
                    }else{
                        $tnews_gutter_class = '';
                    }
                    // echo '<div class="row './/esc_attr( $tnews_gutter_class ).'">';
                    if( $tnews_blog_single_layout == 3 ) {
                    echo '<div class="blog-style-bg">';
                    }
                        echo '<div class="row">';
        }
    }

    // blog details column wrapper start hook function
    if( !function_exists('tnews_blog_details_col_start_cb') ) {
        function tnews_blog_details_col_start_cb( ) {

            //Demo style show by get url varibale
            if ( isset( $_GET['layout'] ) ) {
                $layout_value = sanitize_text_field( $_GET['layout'] );
            }else{
                $layout_sidebar = '';
            }
            if ( isset( $_GET['sidebar']) ) {
                $layout_sidebar = sanitize_text_field( $_GET['sidebar'] );
            }else{
                $layout_sidebar = '';
            }
            if( isset( $_GET['layout'] ) && ($layout_value === '2' || $layout_value === '3' || $layout_value === '4' || $layout_value === '5' )){
                if ( !empty($layout_value) ) {
                    $tnews_blog_single_layout = $layout_value;
                }else{
                    $tnews_blog_single_layout = 1;
                }
            }else{
                //Redux option work
                if( class_exists('ReduxFramework') ) {
                    $tnews_blog_single_layout = tnews_opt('tnews_blog_single_layout');
                }else{
                    $tnews_blog_single_layout = 1;
                }
            }//End - Demo style show by get url varibale

            //Blog details style 4 & 5 //sidebar off & class change 
            if( ($tnews_blog_single_layout == 4 || $tnews_blog_single_layout == 5) && $layout_sidebar == 'no') {
                $col_center_class = 'col-lg-12 justify-content-center';
            }elseif($tnews_blog_single_layout == 4){
                $col_center_class = 'col-xxl-9 col-lg-8  justify-content-center';
            }else{
                $col_center_class = 'col-xxl-9 col-lg-8';
            }

            //Blog details style 2 & 3
            if(  $tnews_blog_single_layout == 2 || $tnews_blog_single_layout == 3 ) {
                $col = 'col-lg-8';
            }else{
                $col = $col_center_class;
            }

            if( class_exists('ReduxFramework') ) {
                $tnews_blog_single_sidebar = tnews_opt('tnews_blog_single_sidebar');
                if( $tnews_blog_single_sidebar == '2' && is_active_sidebar('tnews-blog-sidebar') ) {
                    echo '<div class="'.esc_attr($col).' order-last">';
                } elseif( $tnews_blog_single_sidebar == '3' && is_active_sidebar('tnews-blog-sidebar') ) {
                    echo '<div class="'.esc_attr($col).'">';
                } else {
                    echo '<div class="col-lg-12">';
                }

            } else {
                if( is_active_sidebar('tnews-blog-sidebar') ) {
                    echo '<div class="'.esc_attr($col).'">';
                } else {
                    echo '<div class="col-lg-12">';
                }
            }
        }
    }

    // blog details post meta hook function
    if( !function_exists('tnews_blog_post_meta_cb') ) {
        function tnews_blog_post_meta_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $tnews_display_post_author      =  tnews_opt('tnews_display_post_author');
                $tnews_display_post_date      =  tnews_opt('tnews_display_post_date');
                $tnews_display_post_comments      =  tnews_opt('tnews_display_post_comments');
                $tnews_display_post_read_time      =  tnews_opt('tnews_display_post_read_time');
            } else {
                $tnews_display_post_author      = '1';
                $tnews_display_post_date      = '1';
                $tnews_display_post_comments      = '1';
                $tnews_display_post_read_time      = '1';
            }

                echo '<div class="blog-meta">';
                    if( $tnews_display_post_author ){
                        echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'"><i class="far fa-user"></i>'.esc_html__('By - ', 'tnews').esc_html( ucwords( get_the_author() ) ).'</a>';
                    }
                    if( $tnews_display_post_date ){
                        echo ' <a href="'.esc_url( tnews_blog_date_permalink() ).'"><i class="fal fa-calendar-days"></i>'.esc_html( get_the_date() ).'</a>';
                    }
                    if( $tnews_display_post_comments ){
                        ?>
                        <a href="#"><i class="far fa-comments"></i>
                            <?php 
                                if(get_comments_number() == 1){
                                    echo esc_html__('Comment (', 'tnews'); 
                                }else{
                                    echo esc_html__('Comments (', 'tnews'); 
                                }
                                echo get_comments_number(); ?>)</a>
                        <?php
                    }
                    if( $tnews_display_post_read_time ){
                        echo '<span><i class="far fa-book-open"></i>'.tnews_get_estimated_reading_time(get_the_ID()). esc_html__(' Mins Read', 'tnews') .'</span>';
                    }
                echo '</div>';
        }
    }

    // blog details share options hook function
    if( !function_exists('tnews_blog_details_share_options_cb') ) {
        function tnews_blog_details_share_options_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $tnews_post_details_share_options = tnews_opt('tnews_post_details_share_options');
            } else {
                $tnews_post_details_share_options = false;
            }

            if( function_exists( 'tnews_social_sharing_buttons' ) && $tnews_post_details_share_options ) { 
                echo '<div class="share-links-wrap">';
                    echo '<div class="share-links">';
                        echo '<span class="share-links-title">'.esc_html__('Share Post:', 'tnews').'</span>';
                        echo '<div class="multi-social">';
                            echo tnews_social_sharing_buttons();
                        echo '</div>';
                    echo '</div>';
               echo '</div>';
             }

        }
    }
    
    // blog details author bio hook function
    if( !function_exists('tnews_blog_details_author_bio_cb') ) {
        function tnews_blog_details_author_bio_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $postauthorbox =  tnews_opt( 'tnews_post_details_author_box' );
            } else {
                $postauthorbox = '0';
            }
            if(  $postauthorbox == '1' ) {

                echo '<div class="blog-author">';
                    echo '<div class="auhtor-img">';
                        echo '<img src="'.esc_url( get_avatar_url( get_the_author_meta('ID') ) ).'" alt="img">';
                    echo '</div>';
                    echo '<div class="media-body">';
                        echo '<div class="author-top">';
                            echo '<div>';
                                echo '<h3 class="author-name"><a class="text-inherit" href="#">'.esc_html( ucwords( get_the_author() )).'</a></h3>';
                                echo '<span class="author-desig">'.get_user_meta( get_the_author_meta('ID'), '_tnews_author_desig',true ).'</span>';
                    
                            echo '</div>';
                            echo '<div class="social-links">';
                                $tnews_social_icons = get_user_meta( get_the_author_meta('ID'), '_tnews_social_profile_group',true );
                                if(!empty($tnews_social_icons)){
                                    foreach( $tnews_social_icons as $singleicon ) {
                                        if( ! empty( $singleicon['_tnews_social_profile_icon'] ) ) {
                                            echo '<a href="'.esc_url( $singleicon['_tnews_lawyer_social_profile_link'] ).'"><i class="'.esc_attr( $singleicon['_tnews_social_profile_icon'] ).'"></i></a>';
                                        }
                                    }
                                }
                            echo '</div>';
                        echo '</div>';
                        echo '<p class="author-text">'.get_the_author_meta( 'user_description', get_the_author_meta('ID') ).'</p>';
                    echo '</div>';
                echo '</div>';
               
            }

        }
    }

     // Blog Details Post Navigation hook function
     if( !function_exists( 'tnews_blog_details_post_navigation_cb' ) ) {
        function tnews_blog_details_post_navigation_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $tnews_post_navigation = tnews_opt('tnews_post_details_post_navigation');
            } else {
                $tnews_post_navigation = true;
            }

            $prevpost = get_previous_post();
            $nextpost = get_next_post();

            $allowhtml = array(
                'p'         => array(
                    'class'     => array()
                ),
                'span'      => array(),
                'a'         => array(
                    'href'      => array(),
                    'title'     => array()
                ),
                'br'        => array(),
                'em'        => array(),
                'strong'    => array(),
                'b'         => array(),
            );

            if( ($tnews_post_navigation == '1') && (!empty($prevpost) || !empty($nextpost)) ) {
                echo '<div class="blog-navigation">';
                    
                    echo '<div class="nav-btn prev">';
                        if( ! empty( $prevpost ) ) {
                            if (has_post_thumbnail($prevpost->ID)) {
                                echo '<div class="img">';
                                    echo get_the_post_thumbnail( $prevpost->ID, 'tnews_80X80' );
                                echo '</div>';
                            }
                            echo '<div class="media-body">';
                                echo '<h5 class="title">';
                                    echo '<a class="hover-line" href="'.esc_url( get_permalink( $prevpost->ID ) ).'">'.get_the_title($prevpost->ID).'</a>';
                                echo '</h5>';
                                echo '<a href="'.esc_url( get_permalink( $prevpost->ID ) ).'" class="nav-text"><i class="fas fa-arrow-left me-2"></i>'.esc_html__('Prev', 'tnews').'</a>';
                            echo '</div>';
                        }
                    echo '</div>';
                    

                    echo '<div class="divider"></div>';

                    echo '<div class="nav-btn next">';
                        if( ! empty( $nextpost ) ) {
                            echo '<div class="media-body">';
                                echo '<h5 class="title">';
                                    echo '<a class="hover-line" href="'.esc_url( get_permalink( $nextpost->ID ) ).'">'.get_the_title($nextpost->ID).'</a>';
                                echo '</h5>';
                                echo '<a href="'.esc_url( get_permalink( $nextpost->ID ) ).'" class="nav-text">'.esc_html__('Next', 'tnews').' <i class="fas fa-arrow-right ms-2"></i></a>';
                            echo '</div>';
                            if (has_post_thumbnail($nextpost->ID)) {
                                echo '<div class="img">';
                                    echo get_the_post_thumbnail( $nextpost->ID, 'tnews_80X80' );
                                echo '</div>';
                            }
                        }
                    echo '</div>';

                echo '</div>';
            }
        }
    }

    // Blog Details Comments hook function
    if( !function_exists('tnews_blog_details_comments_cb') ) {
        function tnews_blog_details_comments_cb( ) {
            if ( ! comments_open() ) {
                echo '<div class="blog-comment-area">';
                    echo tnews_heading_tag( array(
                        "tag"   => "h3",
                        "text"  => esc_html__( 'Comments are closed', 'tnews' ),
                        "class" => "inner-title"
                    ) );
                echo '</div>';
            }

            // comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
        }
    }

    // Blog Details Column end hook function
    if( !function_exists('tnews_blog_details_col_end_cb') ) {
        function tnews_blog_details_col_end_cb( ) {
            echo '</div>';
        }
    }

    // Blog Details Wrapper end hook function
    if( !function_exists('tnews_blog_details_wrapper_end_cb') ) {
        function tnews_blog_details_wrapper_end_cb( ) {
                    //Demo style show by get url varibale
                    if ( isset( $_GET['layout'] ) ) {
                        $layout_value = sanitize_text_field( $_GET['layout'] );
                    }
                    if( isset( $_GET['layout'] ) && ($layout_value === '2' || $layout_value === '3' || $layout_value === '4' || $layout_value === '5' )){
                        if ( !empty($layout_value) ) {
                            $tnews_blog_single_layout = $layout_value;
                        }else{
                            $tnews_blog_single_layout = 1;
                        }
                    }else{
                        //Redux option work
                        if( class_exists('ReduxFramework') ) {
                            $tnews_blog_single_layout = tnews_opt('tnews_blog_single_layout');
                        }else{
                            $tnews_blog_single_layout = 1;
                        }
                    }//End - Demo style show by get url varibale

                    echo '</div>';
                    if( $tnews_blog_single_layout == 3 ) {
                     echo '</div>';
                    }

                    if( $tnews_blog_single_layout == 2 || $tnews_blog_single_layout == 3 ) {  
                        tnews_related_post_slider();
                    }

                echo '</div>';
            echo '</section>';
        }
    }

    // page start wrapper hook function
    if( !function_exists('tnews_page_start_wrap_cb') ) {
        function tnews_page_start_wrap_cb( ) {
            
            if( is_page( 'cart' ) ){
                $section_class = "th-cart-wrapper space-top space-extra-bottom";
            }elseif( is_page( 'checkout' ) ){
                $section_class = "th-checkout-wrapper space-top space-extra-bottom";
            }elseif( is_page('wishlist') ){
                $section_class = "wishlist-area space-top space-extra-bottom";
            }else{
                $section_class = "space-top space-extra-bottom";  
            }
            echo '<section class="'.esc_attr( $section_class ).'">';
                echo '<div class="container">';
                    echo '<div class="row">';
        }
    }

    // page wrapper end hook function
    if( !function_exists('tnews_page_end_wrap_cb') ) {
        function tnews_page_end_wrap_cb( ) {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // page column wrapper start hook function
    if( !function_exists('tnews_page_col_start_wrap_cb') ) {
        function tnews_page_col_start_wrap_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $tnews_page_sidebar = tnews_opt('tnews_page_sidebar');
            }else {
                $tnews_page_sidebar = '1';
            }
            
            if( $tnews_page_sidebar == '2' && is_active_sidebar('tnews-page-sidebar') ) {
                echo '<div class="col-lg-8 order-last">';
            } elseif( $tnews_page_sidebar == '3' && is_active_sidebar('tnews-page-sidebar') ) {
                echo '<div class="col-lg-8">';
            } else {
                echo '<div class="col-lg-12">';
            }

        }
    }

    // page column wrapper end hook function
    if( !function_exists('tnews_page_col_end_wrap_cb') ) {
        function tnews_page_col_end_wrap_cb( ) {
            echo '</div>';
        }
    }

    // page sidebar hook function
    if( !function_exists('tnews_page_sidebar_cb') ) {
        function tnews_page_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $tnews_page_sidebar = tnews_opt('tnews_page_sidebar');
            }else {
                $tnews_page_sidebar = '1';
            }

            if( class_exists('ReduxFramework') ) {
                $tnews_page_layoutopt = tnews_opt('tnews_page_layoutopt');
            }else {
                $tnews_page_layoutopt = '3';
            }

            if( $tnews_page_layoutopt == '1' && $tnews_page_sidebar != 1 ) {
                get_sidebar('page');
            } elseif( $tnews_page_layoutopt == '2' && $tnews_page_sidebar != 1 ) {
                get_sidebar();
            }
        }
    }

    // page content hook function
    if( !function_exists('tnews_page_content_cb') ) {
        function tnews_page_content_cb( ) {
            if(  class_exists('woocommerce') && ( is_woocommerce() || is_cart() || is_checkout() || is_page('wishlist') || is_account_page() )  ) {
                echo '<div class="woocommerce--content">';
            } else {
                echo '<div class="page--content clearfix">';
            }

                the_content();

                // Link Pages
                tnews_link_pages();

            echo '</div>';
            // comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }

        }
    }

    //Function for post thumbnial meta category
    if( !function_exists('tnews_blog_thumbnial_cate_cb') ) {
        function tnews_blog_thumbnial_cate_cb(){
            if( class_exists('ReduxFramework') ) {
                $tnews_display_post_cate   =  tnews_opt('tnews_display_post_cate');
            } else {
                $tnews_display_post_cate      = '1';
            }

            if( $tnews_display_post_cate ){
                $categories = get_the_category(); 
                if(!empty($categories)){
                    global $post;
                    $terms = get_the_terms( $post->ID, 'category' );
                    $term_id = $terms[0]->term_id; 

                    echo '<a data-theme-color="'.get_term_meta( $term_id, '_tnews_term_bg_color', true ).'" href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'" class="category">'.esc_html( $categories[0]->name ).'</a>';

                }
            }

        }
    }

    if( !function_exists('tnews_blog_post_thumb_cb') ) {
        function tnews_blog_post_thumb_cb( $thumb_size = null, $cate_show = true, $related_post = false ) {
            if( get_post_format() ) {
                $format = get_post_format();
            }else{
                $format = 'standard';
            }

            $tnews_post_slider_thumbnail = tnews_meta( 'post_format_slider' );

            if( !empty( $tnews_post_slider_thumbnail ) ){
                echo '<div class="blog-img">';
                    echo '<div class="th-blog-carousel arrow-wrap">';
                        foreach( $tnews_post_slider_thumbnail as $single_image ){
                            $attachment_id = attachment_url_to_postid($single_image);
                            $thumbnail = wp_get_attachment_image($attachment_id, $thumb_size);

                            echo '<a href="'.esc_url( get_permalink() ).'">'.$thumbnail.'</a>';
                        }
                    echo '</div>';
                    if( ! is_single() ){
                        if($cate_show){
                            //Blog Post Thumbnail Category
                            do_action( 'tnews_blog_thumbnial_cate' );
                        }
                    }
                    if( is_single() && $related_post == true && $cate_show == false){
                        //Blog Post Thumbnail Category
                        do_action( 'tnews_blog_thumbnial_cate' );
                    }
                    
                echo '</div>';
            }elseif( has_post_thumbnail() && $format == 'standard' ) {
                echo '<!-- Post Thumbnail -->';
                echo '<div class="blog-img">';
                    if( ! is_single() ){
                        echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                    }

                    the_post_thumbnail($thumb_size);

                    if( ! is_single() ){
                        echo '</a>';
                        if($cate_show == true){
                            //Blog Post Thumbnail Category
                            do_action( 'tnews_blog_thumbnial_cate' );
                        }
                    }
                    if( is_single() && $related_post == true && $cate_show == false){
                        //Blog Post Thumbnail Category
                        do_action( 'tnews_blog_thumbnial_cate' );
                    }

                echo '</div>';
                echo '<!-- End Post Thumbnail -->';
            }elseif( $format == 'video' ){
                $tnews_video = tnews_meta( 'post_format_video' );
                if( has_post_thumbnail() && ! empty ( tnews_meta( 'post_format_video' ) ) ){
                    echo '<div class="blog-img blog-video">';
                        if( ! is_single() ){
                            echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                        }
                            the_post_thumbnail($thumb_size);

                        if( ! is_single() ){
                            echo '</a>';
                            if($cate_show){
                                //Blog Post Thumbnail Category
                                do_action( 'tnews_blog_thumbnial_cate' );
                            }
                        }
                        if( is_single() && $related_post == true && $cate_show == false){
                            //Blog Post Thumbnail Category
                            do_action( 'tnews_blog_thumbnial_cate' );
                        }

                        if(!empty($tnews_video)){
                            echo '<a href="'.esc_url( $tnews_video ).'" class="play-btn popup-video style6">';
                                echo '<i class="fas fa-play"></i>';
                            echo '</a>';
                        }

                    echo '</div>';
                }elseif( ! has_post_thumbnail() && ! is_single() ){
                    echo '<div class="blog-video">';
                        if( ! is_single() ){
                            echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                        }
                            echo tnews_embedded_media( array( 'video', 'iframe' ) );
                        if( ! is_single() ){
                            echo '</a>';
                        }
                    echo '</div>';
                }
            }elseif( $format == 'audio' ){
                $tnews_audio = tnews_meta( 'post_format_audio' );

                if( ! empty( $tnews_audio ) ){
                    echo '<div class="blog-img blog-audio">';
                        if( ! is_single() ){
                            if($cate_show){
                                //Blog Post Thumbnail Category
                                do_action( 'tnews_blog_thumbnial_cate' );
                            }
                        }

                        echo wp_oembed_get( $tnews_audio );

                        if( is_single() && $related_post == true && $cate_show == false){
                            //Blog Post Thumbnail Category
                            do_action( 'tnews_blog_thumbnial_cate' );
                        }

                    echo '</div>';

                }elseif( ! is_single() ){
                    if( ! empty( $tnews_audio )){
                        echo '<div class="blog-audio">';
                            echo wp_oembed_get( $tnews_audio );
                        echo '</div>';
                    }

                }
            }

        }
    }

    if( !function_exists('tnews_blog_post_content_cb') ) {
        function tnews_blog_post_content_cb( ) {
            $allowhtml = array(
                'p'         => array(
                    'class'     => array()
                ),
                'span'      => array(),
                'a'         => array(
                    'href'      => array(),
                    'title'     => array()
                ),
                'br'        => array(),
                'em'        => array(),
                'strong'    => array(),
                'b'         => array(),
            );
            if( class_exists( 'ReduxFramework' ) ) {
                $tnews_excerpt_length          = tnews_opt( 'tnews_blog_postExcerpt' );
                $tnews_display_post_category   = tnews_opt( 'tnews_display_post_category' );
            } else {
                $tnews_excerpt_length          = '48';
                $tnews_display_post_category   = '1';
            }

            if( class_exists( 'ReduxFramework' ) ) {
                $tnews_blog_admin = tnews_opt( 'tnews_blog_post_author' );
                $tnews_blog_readmore_setting_val = tnews_opt('tnews_blog_readmore_setting');
                if( $tnews_blog_readmore_setting_val == 'custom' ) {
                    $tnews_blog_readmore_setting = tnews_opt('tnews_blog_custom_readmore');
                } else {
                    $tnews_blog_readmore_setting = __( 'Read More', 'tnews' );
                }
            } else {
                $tnews_blog_readmore_setting = __( 'Read More', 'tnews' );
                $tnews_blog_admin = true;
            }
            echo '<!-- blog-content -->';

                do_action( 'tnews_blog_post_thumb' );
                
                echo '<div class="blog-content">';

                    // Blog Post Meta
                    do_action( 'tnews_blog_post_meta' );

                    echo '<!-- Post Title -->';
                    echo '<h2 class="blog-title box-title-30"><a href="'.esc_url( get_permalink() ).'">'.wp_kses( get_the_title( ), $allowhtml ).'</a></h2>';

                    echo '<!-- Post Summary -->';
                    echo tnews_paragraph_tag( array(
                        "text"  => wp_kses( wp_trim_words( get_the_excerpt(), $tnews_excerpt_length, '' ), $allowhtml ),
                        "class" => 'blog-text',
                    ) );
  
                    if( !empty( $tnews_blog_readmore_setting ) ){
                        echo '<a href="'.esc_url( get_permalink() ).'" class="th-btn style2">'.esc_html( $tnews_blog_readmore_setting ).'<i class="fas fa-arrow-up-right ms-2"></i></a>';
                    }

                    echo '<!-- End Post Summary -->';
                echo '</div>';
            echo '<!-- End Post Content -->';
        }
    }
