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
    if( class_exists('ReduxFramework') ) {
        $tnews_blog_archive_sidebar = tnews_opt('tnews_blog_archive_sidebar');
        $tnews_archive_grid = tnews_opt('tnews_archive_grid');
    } else {
        $tnews_blog_archive_sidebar = 1;
        $tnews_archive_grid = 4;
    }

    if ( isset( $_GET['column'] ) ) {
        $column_value = sanitize_text_field( $_GET['column'] );
    }
    if( isset( $_GET['column'] ) && ($column_value === '3' || $column_value === '2')){
        if ( $column_value === '3' ) {
            $column = 'col-xl-4 col-sm-6';
        }elseif ( $column_value === '2' ) {
            $column = 'col-sm-6';
        }else{
            $column = 'col-xl-3 col-lg-4 col-sm-6';
        }
    }else{
        //Redux option work
        if($tnews_archive_grid == 1){
            $column = 'col-sm-12';
        }elseif($tnews_archive_grid == 2){
            $column = 'col-sm-6';
        }elseif($tnews_archive_grid == 3){
            $column = 'col-xl-4 col-sm-6';
        }else{
            $column = 'col-xl-3 col-lg-4 col-sm-6';
        }
    }

  echo '<section class="space-top space-extra-bottom">';
        echo '<div class="container">';

            //Show for demo only. //Sidebar row & column start 
            if( isset( $_GET['sidebar']) ){
                $sidebar_value = sanitize_text_field( $_GET['sidebar'] );
                if($sidebar_value==='yes'){
                    echo '<div class="row">';
                    echo '<div class="col-xxl-9 col-lg-8">';
                }
            }
            if($tnews_blog_archive_sidebar == 2 || $tnews_blog_archive_sidebar == 3){
                if($tnews_blog_archive_sidebar == 2 ){
                    $left_side_class = 'order-last';
                }else{
                    $left_side_class = '';
                }
                echo '<div class="row">';
                echo '<div class="col-xxl-9 col-lg-8 '.$left_side_class.'">';
            }

                echo '<div class="row gy-30">';
                    // echo $column_value;
                    if ( have_posts() ) {
                        while ( have_posts() ){
                            the_post();
                        
                            echo '<div class="'.$column.'">';
                                echo '<div class="blog-style1">';
                                    // Blog Post Thumbnail
                                    do_action( 'tnews_blog_post_thumb', 'tnews_392X310' );
                        
                                    echo '<h3 class="box-title-20"><a  class="hover-line" href="'.esc_url( get_permalink() ).'">'.esc_html( get_the_title( )).'</a></h3>';
                        
                                    // Blog Post Meta
                                    echo '<div class="blog-meta">';
                                        echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'"><i class="far fa-user"></i>'.esc_html__('BY-', 'tnews').esc_html( ucwords( get_the_author() ) ).'</a>';
                                        echo ' <a href="'.esc_url( tnews_blog_date_permalink() ).'"><i class="fal fa-calendar-days"></i>'.esc_html( get_the_date() ).'</a>';
                                    echo '</div>';
                                    
                                echo '</div>';
                            echo '</div>';

                        } wp_reset_postdata();
                    }
                echo '</div>';

            //Show for demo only. //Sidebar column start
            if( isset( $_GET['sidebar']) ){
                $sidebar_value = sanitize_text_field( $_GET['sidebar'] );
                if($sidebar_value==='yes'){
                echo '</div>';
                }
            }
            if($tnews_blog_archive_sidebar == 2 || $tnews_blog_archive_sidebar == 3){
                echo '</div>';
            }

            //Show for demo only. //Sidebar row end & sidebar active
            if( isset( $_GET['sidebar']) ){
                $sidebar_value = sanitize_text_field( $_GET['sidebar'] );
                if($sidebar_value==='yes'){
                    /**
                    * @Hooked tnews_blog_sidebar_cb 10
                    */
                    do_action( 'tnews_blog_sidebar' );  
                echo '</div>';
                }
            }
            if($tnews_blog_archive_sidebar == 2 || $tnews_blog_archive_sidebar == 3){
                    /**
                    * @Hooked tnews_blog_sidebar_cb 10
                    */
                    do_action( 'tnews_blog_sidebar' );  
                echo '</div>';
            }

            //Pagination
            echo '<div class="mt-40 mb-0 text-center">';
                /**
                * @Hooked tnews_blog_pagination_cb 10
                */
                do_action( 'tnews_blog_pagination' ); 
            echo '</div>';

        echo '</div>';
    echo '</section>';

//footer
get_footer();