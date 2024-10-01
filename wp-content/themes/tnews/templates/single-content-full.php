<?php
echo '<div class="row justify-content-center">';
    echo '<div class="col-12 text-center mb-40">';
        if( class_exists('ReduxFramework') ) {
            $tnews_post_details_title_position = tnews_opt('tnews_post_details_title_position');
        } else {
            $tnews_post_details_title_position = 'header';
        }

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

        //Blog Post Thumbnail Category
        do_action( 'tnews_blog_thumbnial_cate' );

        //Header
        if( $tnews_post_details_title_position != 'header' ) {
            echo '<h2 class="blog-title">'.wp_kses( get_the_title(), $allowhtml ).'</h2>';
        }

        // Blog Post Meta
        do_action( 'tnews_blog_post_meta' );

        // Blog Post Thumbnail
        do_action( 'tnews_blog_post_thumb' );
    echo '</div>';

    if(  $tnews_blog_single_layout == 4 ){
        $col = 'col-xxl-9 col-lg-10';
    }elseif(  $tnews_blog_single_layout == 5 ){
        $col = 'col-12';
    }else{
        $col = 'col-xxl-9 col-lg-10';
    }
    ?>
    <div class="<?php echo esc_attr($col); ?>">
        <div <?php post_class(); ?>>
    <?php
            
            echo '<div class="blog-content-wrap">';

            if( class_exists('ReduxFramework') ) {
                $tnews_post_details_share_options = tnews_opt('tnews_post_details_share_options');
                $tnews_display_post_tags = tnews_opt('tnews_display_post_tags');
            } else {
                $tnews_post_details_share_options = false;
                $tnews_display_post_tags = false;
            }
                /**
                *
                * Hook for Blog Details Share Options
                *
                * Hook tnews_blog_details_share_options
                *
                * @Hooked tnews_blog_details_share_options_cb 10
                *
                */
                do_action( 'tnews_blog_details_share_options' );

                echo '<div class="blog-content">';
                    $post_print = tnews_opt('tnews_display_post_print');
                    $Post_email = tnews_opt('tnews_display_post_email');
                    $post_likes = tnews_opt('tnews_display_post_likes');
                    $post_views = tnews_opt('tnews_display_post_views');
                    if( ! empty( $post_print ) || ! empty( $Post_email ) || ! empty( $post_likes ) || ! empty( $post_views ) ){
                        echo '<div class="blog-info-wrap">';
                            if( ! empty( $post_print ) ){
                                echo '<button class="blog-info print_btn">Print :<i class="fas fa-print"></i></button>';
                            }
                            if( ! empty( $Post_email ) ){
                                echo '<a class="blog-info" href="mailto:'.get_the_author_meta('user_email').'">Email :<i class="fas fa-envelope"></i></a>';
                            }
                            
                            if( ! empty( $post_likes ) ){
                                $post_id = get_the_ID();
                                $like_count = get_post_meta($post_id, '_custom_like_count', true);
                                echo '<span id="custom-like-count" class="ms-sm-auto">' . esc_html($like_count) . '</span><button class="custom-like-button blog-info" data-post-id="' . esc_attr($post_id) . '"><i class="fas fa-thumbs-up"></i></button>';
                            }

                            if( ! empty( $post_views ) ){
                                echo '<span class="blog-info">'.tnews_getPostViews( get_the_ID() ).' <i class="fas fa-eye"></i></span>';
                            }
                        echo '</div>';
                    }

                    echo '<div class="content">';
                        if( get_the_content() ){
                            the_content();
                            // Link Pages
                            tnews_link_pages();
                        }  
                    echo '</div>';

                    $tnews_post_tag = get_the_tags();
            
                    if( ! empty( $tnews_display_post_tags ) ){
                        if( is_array( $tnews_post_tag ) && ! empty( $tnews_post_tag ) ){
                            if( count( $tnews_post_tag ) > 1 ){
                                $tag_text = __( 'Related Tags:', 'tnews' );
                            }else{
                                $tag_text = __( 'Related Tag:', 'tnews' );
                            }
                            echo '<div class="blog-tag">';
                                echo '<h6 class="title">'.esc_html($tag_text).'</h6>';
                                echo '<div class="tagcloud">';
                                    foreach( $tnews_post_tag as $tags ){
                                        echo '<a href="'.esc_url( get_tag_link( $tags->term_id ) ).'">'.esc_html( $tags->name ).'</a>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                    }  


                echo '</div>';

            echo '</div>';


        echo '</div>'; 

        /**
        *
        * Hook for Blog Navigation
        *
        * Hook tnews_blog_details_post_navigation
        *
        * @Hooked tnews_blog_details_post_navigation_cb 10
        *
        */
        do_action( 'tnews_blog_details_post_navigation' );

        /**
        *
        * Hook for Blog Navigation
        *
        * Hook tnews_blog_details_author_bio
        *
        * @Hooked tnews_blog_details_author_bio_cb 10
        *
        */
        do_action( 'tnews_blog_details_author_bio' );

        /**
        *
        * Hook for Blog Details Comments
        *
        * Hook tnews_blog_details_comments
        *
        * @Hooked tnews_blog_details_comments_cb 10
        *
        */
        do_action( 'tnews_blog_details_comments' );

        /* 
        * funtion is tnews-functions 
        * tnews_related_post_slider();
        */
        tnews_related_post_slider();

    echo '</div>';
echo '</div>';