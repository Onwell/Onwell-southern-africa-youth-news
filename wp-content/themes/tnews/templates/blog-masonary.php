<?php
/*
Template Name: Blog Masonary
*/

  // get header //
  get_header();
?>
<section class="space-top space-extra-bottom">
    <div class="container">
        <div class="row">
            <!-- Blog post -->
            <div class="col-xxl-9 col-lg-8">
                <div class="row gy-30 blog-posts"> 
                    <?php 
                    $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'paged' => 1,
                    );

                    $blog_posts = new WP_Query( $args ); 
                    $post_count = 0;
                    while ( $blog_posts->have_posts() ){
                        $blog_posts->the_post();
                        $post_count++;
                    
                        echo '<div class="post col-xl-4 col-sm-6">';
                            echo '<div class="blog-style1">';
                                // Blog Post Thumbnail
                                if($post_count == 2 || $post_count == 5 || $post_count % 4 === 0){
                                    do_action( 'tnews_blog_post_thumb', 'tnews_288X320' );
                                }else{
                                    do_action( 'tnews_blog_post_thumb', 'tnews_288X187', true );
                                }
                    
                                echo '<h3 class="box-title-20"><a  class="hover-line" href="'.esc_url( get_permalink() ).'">'.esc_html( get_the_title( )).'</a></h3>';
                    
                                // Blog Post Meta
                                echo '<div class="blog-meta">';
                                    echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'"><i class="far fa-user"></i>'.esc_html__('By - ', 'tnews').esc_html( ucwords( get_the_author() ) ).'</a>';
                                    echo ' <a href="'.esc_url( tnews_blog_date_permalink() ).'"><i class="fal fa-calendar-days"></i>'.esc_html( get_the_date() ).'</a>';
                                echo '</div>';
                                
                            echo '</div>';
                        echo '</div>';

                    } wp_reset_postdata();

                    ?>
                </div>
                <div class="mt-40 mb-30 text-center">
                    <button type="button" class="th-btn loadmore"> <?php echo esc_html__('Load More', 'tnews'); ?></button>
                </div>
            </div>

            <?php 
                    /**
                    * 
                    * Hook for Blog Sidebar
                    *
                    * Hook tnews_blog_sidebar
                    *
                    * @Hooked tnews_blog_sidebar_cb 10
                    *  
                    */
                    do_action( 'tnews_blog_sidebar' );  
            ?>

        </div>
    </div>
</section>
<?php
//footer
get_footer();