<?php
/**
 * @Packge     : Tnews
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}   
// Header
get_header();

    //Redux option
    if( class_exists( 'ReduxFramework' ) ) {
        $tnews_blog_readmore_setting_val = tnews_opt('tnews_blog_readmore_setting');
        if( $tnews_blog_readmore_setting_val == 'custom' ) {
            $tnews_blog_readmore_setting = tnews_opt('tnews_blog_custom_readmore');
        } else {
            $tnews_blog_readmore_setting = __( 'Read More', 'tnews' );
        }
    } else {
        $tnews_blog_readmore_setting = __( 'Read More', 'tnews' );
    }

    $user_id = get_query_var('author');
    $post_count = count_user_posts( $user_id );

    $author_description = get_the_author_meta( 'user_description', get_the_author_meta('ID') );

    $author_desig = get_user_meta( get_the_author_meta('ID'), '_tnews_author_desig',true );
    $author_phone = get_user_meta( get_the_author_meta('ID'), '_tnews_author_phone',true );
    $tnews_social_icons = get_user_meta( get_the_author_meta('ID'), '_tnews_social_profile_group',true );

    $replace        = array(' ','-',' - ');
    $replace_phone        = array(' ','-',' - ', '(', ')');
    $with           = array('','','');
    $phoneurl       = str_replace( $replace_phone, $with, $author_phone );	

    echo '<section class="space space-extra-bottom">';
        echo '<div class="container">';
            echo '<div class="row">';
                echo '<div class="col-xl-8">';
                    echo '<div class="">';
                        if ( have_posts() ) {
                            while ( have_posts() ){
                                the_post();
                                echo '<div class="mb-4 border-blog">';
                                    echo '<div class="blog-style4">';
                                        // Blog Post Thumbnail
                                        do_action( 'tnews_blog_post_thumb', 'tnews_270X220', false );

                                        echo '<div class="blog-content">';
                                            $categories = get_the_category(); 
                                            if(!empty($categories)){
                                                global $post;
                                                $terms = get_the_terms( $post->ID, 'category' );
                                                $term_id = $terms[0]->term_id;
                            
                                                echo '<a data-theme-color="'.get_term_meta( $term_id, '_tnews_term_bg_color', true ).'" href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'" class="category">'.esc_html( $categories[0]->name ).'</a>';
                                            }
                                            echo '<h3 class="box-title-22"><a  class="hover-line" href="'.esc_url( get_permalink() ).'">'.esc_html( get_the_title( )).'</a></h3>';
                                            // Blog Post Meta
                                            echo '<div class="blog-meta">';
                                                echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'"><i class="far fa-user"></i>'.esc_html__('BY-', 'tnews').esc_html( ucwords( get_the_author() ) ).'</a>';
                                                echo ' <a href="'.esc_url( tnews_blog_date_permalink() ).'"><i class="fal fa-calendar-days"></i>'.esc_html( get_the_date() ).'</a>';
                                            echo '</div>';
                                            if( !empty( $tnews_blog_readmore_setting ) ){
                                                echo '<a href="'.esc_url( get_permalink() ).'" class="th-btn style2">'.esc_html( $tnews_blog_readmore_setting ).'<i class="fas fa-arrow-up-right ms-2"></i></a>';
                                            }
                                        echo '</div>';    
                                        
                                    echo '</div>';
                                echo '</div>';

                            } wp_reset_postdata();
                        }

                    echo '</div>';

                    //Pagination
                    echo '<div class="pt-10">';
                        /**
                        * @Hooked tnews_blog_pagination_cb 10
                        */
                        do_action( 'tnews_blog_pagination' ); 
                    echo '</div>';

                echo '</div>';

                echo '<div class="col-xl-4 sidebar-wrap">';
                    echo '<div class="sidebar-area mb-0">';
                        echo '<div class="widget  ">';
                            echo '<div class="author-details">';
                                echo '<div class="author-img">';
                                    echo '<img src="'.esc_url( get_avatar_url( $user_id ) ).'" alt="Image">';
                                echo '</div>';
                                echo '<div class="author-content">';
                                    echo '<h3 class="box-title-24">'.esc_html( ucwords( get_the_author() ) ).'</h3>';
                                    echo '<div class="info-wrap">';
                                        if(!empty($author_desig)){
                                            echo '<span class="info">'.esc_html($author_desig).'</span>';
                                        }
                                        echo '<span class="info"><strong>'.esc_html__('Posts:', 'tnews').' </strong>'.$post_count.'</span>';
                                    echo '</div>';
                                    if(!empty($author_description)){
                                        echo '<p class="author-bio">'.esc_html($author_description).'</p>';
                                    }
                                    if(!empty(get_the_author_meta('user_email'))){
                                        echo '<div class="info-wrap top-border">';
                                            echo '<span class="info"><strong>'.esc_html__('Email :', 'tnews').' </strong></span>';
                                            echo '<span class="info"><a href="mailto:'.get_the_author_meta('user_email').'">'.get_the_author_meta('user_email').'</a></span>';
                                        echo '</div>';
                                    }
                                    if(!empty($author_phone)){
                                        echo '<div class="info-wrap">';
                                            echo '<span class="info"><strong>'.esc_html__('Phone :', 'tnews').' </strong></span>';
                                            echo '<span class="info"><a href="'.esc_attr( 'tel:'.$phoneurl).'">'.esc_html($author_phone).'</a></span>';
                                        echo '</div>';
                                    }
                                    if(!empty($tnews_social_icons)){
                                        echo '<h4 class="box-title-18">'.esc_html__('Social Media', 'tnews').'</h4>';
                                        echo '<div class="th-social">';
                                            foreach( $tnews_social_icons as $singleicon ) {
                                                if( ! empty( $singleicon['_tnews_social_profile_icon'] ) ) {
                                                    echo '<a href="'.esc_url( $singleicon['_tnews_lawyer_social_profile_link'] ).'"><i class="'.esc_attr( $singleicon['_tnews_social_profile_icon'] ).'"></i></a>';
                                                }
                                            }
                                        echo '</div>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
               
        echo '</div>';
    echo '</section>';

//footer
get_footer();