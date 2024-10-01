<?php
/*
Template Name: Blog List
*/

  // get header //
  get_header();
?>
<section class="space-top space-extra-bottom">
    <div class="container">
        <div class="row">
            <!-- Blog post -->
            <div class="col-xxl-9 col-lg-8">
                <div class="mb-30">
                    <?php 
                    $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                    );

                    $blog_posts = new WP_Query( $args ); 

                    while ( $blog_posts->have_posts() ){
                        $blog_posts->the_post();
                    
                        if( class_exists( 'ReduxFramework' ) ) {
                            $tnews_excerpt_length          = tnews_opt( 'tnews_blog_postExcerpt' );

                            $tnews_blog_readmore_setting_val = tnews_opt('tnews_blog_readmore_setting');
                            if( $tnews_blog_readmore_setting_val == 'custom' ) {
                                $tnews_blog_readmore_setting = tnews_opt('tnews_blog_custom_readmore');
                            } else {
                                $tnews_blog_readmore_setting = __( 'Read More', 'tnews' );
                            }
                        } else {
                            $tnews_excerpt_length          = '17';
                            $tnews_blog_readmore_setting = __( 'Read More', 'tnews' );
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

                        echo '<div class="border-blog2">';
                            echo '<div class="blog-style4">';
                                // Blog Post Thumbnail
                                do_action( 'tnews_blog_post_thumb', 'tnews_392X310', false );
                    
                                echo '<div class="blog-content">';
                                    $categories = get_the_category(); 
                                    if(!empty($categories)){
                                        global $post;
                                        $terms = get_the_terms( $post->ID, 'category' );
                                        $term_id = $terms[0]->term_id;
                    
                                        echo '<a data-theme-color="'.get_term_meta( $term_id, '_tnews_term_bg_color', true ).'" href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'" class="category">'.esc_html( $categories[0]->name ).'</a>';
                    
                                    }
                                    echo '<h3 class="box-title-30"><a class="hover-line" href="'.esc_url( get_permalink() ).'">'.wp_kses( get_the_title( ), $allowhtml ).'</a></h3>';
                                    echo tnews_paragraph_tag( array(
                                        "text"  => wp_kses( wp_trim_words( get_the_excerpt(), $tnews_excerpt_length, '' ), $allowhtml ),
                                        "class" => 'blog-text',
                                    ) );
                                     // Blog Post Meta
                                    echo '<div class="blog-meta">';
                                        echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'"><i class="far fa-user"></i>'.esc_html__('By - ', 'tnews').esc_html( ucwords( get_the_author() ) ).'</a>';
                                        echo ' <a href="'.esc_url( tnews_blog_date_permalink() ).'"><i class="fal fa-calendar-days"></i>'.esc_html( get_the_date() ).'</a>';
                                    echo '</div>';
                                    if( !empty( $tnews_blog_readmore_setting ) ){
                                        echo '<a href="'.esc_url( get_permalink() ).'" class="th-btn style2">'.esc_html( $tnews_blog_readmore_setting ).'<i class="fas fa-arrow-up-right ms-2"></i></a>';
                                    }
                                echo '</div>';

                                
                            echo '</div>';
                        echo '</div>';

                    } wp_reset_postdata();

                    ?>
                </div>

                <?php 
                //Blog list custom pagination
                    $pagination_links = paginate_links(array(
                        'total' => $blog_posts->max_num_pages,
                        'mid_size' => 2,
                        'prev_text' => '<i class="fas fa-arrow-left"></i>',
                        'next_text' => '<i class="fas fa-arrow-right"></i>',
                        'type' => 'array',
                    ));
                
                    if ($pagination_links) {
                        echo '<div class="th-pagination mt-40">';
                            echo '<ul>';
                        
                            $current_page_number = max(1, get_query_var('paged')); // Get current page number
                        
                            foreach ($pagination_links as $link) {
                                // Get the page number from the link using regular expressions
                                if (preg_match('/\d+/', $link, $matches)) {
                                    $page_number = intval($matches[0]);
                        
                                    // Format the page number with leading zeros if needed
                                    $formatted_page_number = str_pad($page_number, 2, '0', STR_PAD_LEFT);
                        
                                    // Replace the original page number with the formatted one
                                    $modified_link = preg_replace('/\d+/', $formatted_page_number, $link);
                        
                                    // Check if the current link corresponds to the current page
                                    $class = ($current_page_number === $page_number) ? 'class="active"' : '';
                        
                                    // Create the list item with the modified link and the active class
                                    echo '<li ' . $class . '>' . $modified_link . '</li>';
                                } else {
                                    // Create the list item with the original link
                                    echo '<li>' . $link . '</li>';
                                }
                            }
                        
                            echo '</ul>';
                        echo '</div>';
                    }
                ?>
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