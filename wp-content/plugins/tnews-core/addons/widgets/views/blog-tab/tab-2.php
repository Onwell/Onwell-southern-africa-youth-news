<?php
echo '<div class="row align-items-center">';
    echo '<div class="col">';
        if ( !empty($settings['section_title' ]) ) :
            printf( '<%1$s %2$s>%3$s</%1$s>',
                $settings['section_title_tag'],
                $this->get_render_attribute_string( 'title_args' ),
                wp_kses_post( $settings['section_title' ] )
                );
        endif;
    echo '</div>';
    echo '<div class="col-auto">';
        echo '<div class="sec-btn">';
            echo '<div class="filter-menu filter-menu-active1">';
                foreach( $settings['post_tab_list2'] as $key => $data ){
                    $active = ($key==0) ? 'active':'';
                    echo ' <button data-filter=".cat'.esc_attr($key).'" class="tab-btn '.esc_attr($active).'" type="button">'.esc_html($data['tab_title']).'</button>';
                }
            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';

echo '<div class="filter-active-cat1">';
    foreach( $settings['post_tab_list2'] as $key => $data ){

        // $args = array(
        //     'post_type' => 'post',
        //     'posts_per_page' => 1,
        //     'orderby' => $data['blog_post_order_by'],
        //     'order' => $data['blog_post_order'],
        //     'post_status' => 'publish',
        //     'ignore_sticky_posts' => 1,
        // );

        $args2 = array(
            'post_type' => 'post',
            'posts_per_page' => !empty($data['blog_post_count']) ? $data['blog_post_count'] -1 : -1,
            'orderby' => $data['blog_post_order_by'],
            'order' => $data['blog_post_order'],
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
        );

        // // Check if a category has been selected 
        // if (!empty($data['selected_category'])) {
        //     // If a category is selected, add it to the query
        //     $args['category_name'] = $data['selected_category'];
        // }


        if (!empty($data['selected_category'])) {
            if (is_string($data['selected_category'])) {
                // Handle single category slug
                $args2['category_name'] = $data['selected_category'];
            } elseif (is_array($data['selected_category'])) {
                // Handle array of category slugs
                $args2['category_name'] = $data['selected_category'];
            } else {
                // Handle other unexpected cases
                error_log('Unexpected data type for selected_category');
            }
        }
 
        // if( !empty($data['skip_post_count']) && $data['skip_post_count'] != "0" ){
        //     $args2['offset'] = $data['skip_post_count'];
        // }else{
        //     $args2['offset'] = 1 ;
        // }

        // $blogpost = new WP_Query($args);
        $blogpost2 = new WP_Query($args2);

        $active = ($key==0) ? 'active-filter':'';

        echo '<div class="row filter-item '.$active.' cat'.esc_attr($key).'">';
            echo '<div class="col-xl-6 mb-35 mb-xl-0">';
                while( $blogpost->have_posts() ){
                    $blogpost->the_post(); 
                    $categories = get_the_category();
                    echo '<div class="">';
                        echo '<div class="blog-style1 style-big">';
                                //Blog post thumbnial
                                $this->tnews_blog_post_thumb_with_cate('tnews_600X490', true);

                            echo '<h3 class="box-title-30"><a class="hover-line" href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count2'], '' ) ).'</a></h3>';
                            echo '<div class="blog-meta">';
                                //Author Meta
                                $this->show_author_cb();
                                //Date Meta
                                $this->show_date_cb();
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                } wp_reset_postdata();
            echo '</div>';

            echo '<div class="col-xl-6">';
                echo '<div class="row gy-4">';
                while( $blogpost2->have_posts() ){
                    $blogpost2->the_post(); 
                    $categories = get_the_category();
                    echo '<div class="col-xl-6 col-sm-6 border-blog two-column">';
                        echo '<div class="'.esc_attr($blog_design_style .' '. $blog_design_class).'">';
                            //Blog post thumbnial with category
                            $this->tnews_blog_post_thumb_with_cate( $blog_image_size, $img_cate, $blog_img_class);
                            
                            if($img_cate == false){
                                //Blog Post Category
                                $this->tnews_blog_thumbnial_cate();
                            }
                            echo '<h3 class="'.esc_attr($blog_font_size).'"><a class="hover-line" href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a></h3>';
                            echo '<div class="blog-meta">';
                                //Author Meta
                                $this->show_author_cb();
                                //Date Meta
                                $this->show_date_cb();
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                } wp_reset_postdata();
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
echo '</div>';