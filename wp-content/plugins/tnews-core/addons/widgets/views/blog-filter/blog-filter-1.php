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
            echo '<div class="filter-menu filter-menu-active">';
                if(!empty($settings['all_tab_title'])){
                    echo '<button data-filter="*" class="tab-btn active" type="button">'.esc_html($settings['all_tab_title']).'</button>';
                }
                foreach( $settings['post_filter_list'] as $key => $data ){
                    echo ' <button data-filter=".cat'.esc_attr($key).'" class="tab-btn" type="button">'.esc_html($data['tab_title']).'</button>';

                }
            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';

echo '<div class="filter-active">';
    foreach( $settings['post_filter_list'] as $key => $data ){

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => !empty($data['blog_post_count']) ? $data['blog_post_count'] : -1,
            'orderby' => $data['blog_post_order_by'],
            'order' => $data['blog_post_order'],
            'category_name' => $data['selected_category'],
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
        );

        if( $data['skip_post_count'] != "0" ){
            $args['offset'] = $data['skip_post_count'];
        }

        $blogpost = new WP_Query($args);

        $category_data = array();

        while( $blogpost->have_posts() ){
            $blogpost->the_post(); 
            $categories = get_the_category();

            echo '<div class="border-blog2 filter-item cat'.esc_attr($key).'">';
                echo '<div class="'.esc_attr($blog_design_style).'">';
                        //Blog post thumbnial with category
                        $this->tnews_blog_post_thumb_with_cate( $blog_image_size, $img_cate, $blog_img_class);

                        echo '<div class="blog-content">';
                            if($img_cate == false){
                                //Blog Post Category
                                $this->tnews_blog_thumbnial_cate();
                            }
                            
                            echo '<h3 class="'.esc_attr($blog_font_size).'"><a class="hover-line" href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a></h3>';
                            echo '<p class="blog-text">'.esc_html( wp_trim_words( get_the_content( ), $settings['excerpt_count'], '' ) ).'</p>';
                            echo '<div class="blog-meta">';
                                //Author Meta
                                $this->show_author_cb();
                                //Date Meta
                                $this->show_date_cb();
                            echo '</div>';
                        echo '</div>';

                   
                echo '</div>';
            echo '</div>';
        } wp_reset_postdata();
        

    }
echo '</div>';