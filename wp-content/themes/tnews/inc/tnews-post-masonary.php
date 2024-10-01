<?php
//Post Masonary & Load more code
function blog_scripts() {
    // Register the script
    wp_register_script( 'custom-script', get_theme_file_uri( '/assets/js/custom.js' ), array('jquery'), false, true );
 
    // Localize the script with new data
    $script_data_array = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'security' => wp_create_nonce( 'load_more_posts' ),
    );
    wp_localize_script( 'custom-script', 'blog', $script_data_array );
 
    // Enqueued script with localized data.
    wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'blog_scripts' );

add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');

function load_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged' => $_POST['page'],
    );
    $blog_posts = new WP_Query( $args );
    ?>
 
    <?php if ( $blog_posts->have_posts() ) : 
        $post_count = 0;
    ?>
        <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post();  $post_count++; ?>
            <?php 
             echo '<div class="post col-xl-4 col-sm-6">';
             echo '<div class="blog-style1">';
             
                 // Blog Post Thumbnail
                if ($post_count % 4 === 0) {
                    do_action( 'tnews_blog_post_thumb', 'tnews_288X320' );
                }else{
                    do_action( 'tnews_blog_post_thumb', 'tnews_288X187' );
                }
     
                 echo '<h3 class="box-title-20"><a  class="hover-line" href="'.esc_url( get_permalink() ).'">'.esc_html( get_the_title( )).'</a></h3>';
     
                 // Blog Post Meta
                 echo '<div class="blog-meta">';
                     echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'"><i class="far fa-user"></i>'.esc_html__('BY-', 'tnews').esc_html( ucwords( get_the_author() ) ).'</a>';
                     echo ' <a href="'.esc_url( tnews_blog_date_permalink() ).'"><i class="fal fa-calendar-days"></i>'.esc_html( get_the_date() ).'</a>';
                 echo '</div>';
                 
             echo '</div>';
         echo '</div>';
            ?>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
    <?php
    wp_die();
}