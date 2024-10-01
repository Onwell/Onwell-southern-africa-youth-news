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
                    // print_r($data);
                    echo ' <button data-filter=".'.esc_attr($data['selected_category']).'" class="tab-btn" type="button">'.esc_html($data['tab_title']).'</button>';
                }
            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';

echo '<div class="row gy-24 filter-active mbn-24">';
    $post_id_array = array();
    
    foreach( $settings['post_filter_list'] as $key => $data ) {
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => !empty($data['blog_post_count']) ? $data['blog_post_count'] : -1,
            'orderby' => $data['blog_post_order_by'],
            'order' => $data['blog_post_order'],
            'category_name' => $data['selected_category'],
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
        );

        $blogpost = new WP_Query($args);

        while( $blogpost->have_posts() ) {
            $blogpost->the_post();
            $post_id = get_the_ID();
            $post_id_array[] = $post_id;

            // Output other content if needed, but don't output it here

        }wp_reset_postdata();
        
    }

    $args2 = array(
        'post_type' => 'post',
        'post__in' => $post_id_array,
    );
    $blogpost2 = new WP_Query($args2);

    $x=0;
    while( $blogpost2->have_posts() ){
        $blogpost2->the_post(); 
        $categories = get_the_category();
        $x++;
        if($x==1){
            $font_size = 'box-title-24';
            $style = 'blog-style3 dark-theme';
        }else{
            $font_size = $blog_font_size;
            $style = $blog_design_style;
        }

        $category_slugs = array();
        foreach ($categories as $category) {
            $category_slugs[] = $category->slug;
        }
        // Join the category slugs into a space-separated string
        $category_class = implode(' ', $category_slugs);

        echo '<div class="col-xl-4 col-md-6 filter-item ' . esc_attr($category_class) . '">';
            echo '<div class="'.esc_attr($style).'">';
                    if($x==1){
                        $this->tnews_blog_post_thumb_with_cate('tnews_392X414', false);
                        $title_count = $settings['title_count2'];
                    }else{
                        //Blog post thumbnial with category
                        $this->tnews_blog_post_thumb_with_cate( $blog_image_size, $img_cate, $blog_img_class);
                        $title_count = $settings['title_count'];
                    }
        
                    echo '<div class="blog-content">';
                        if($img_cate == false){
                            //Blog Post Category
                            $this->tnews_blog_thumbnial_cate();
                        }
        
                        echo '<h3 class="'.esc_attr($font_size).'"><a class="hover-line" href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $title_count, '' ) ).'</a></h3>';
                        
                        if($settings['excerpt_count'] != ''){
                            echo '<p class="blog-text">'.esc_html( wp_trim_words( get_the_content( ), $settings['excerpt_count'], '' ) ).'</p>';
                        }
                        echo '<div class="blog-meta">';
                            //Author Meta
                            $this->show_author_cb();
                            //Date Meta
                            $this->show_date_cb();
                        echo '</div>';
                        if(!empty($settings['blog_btn'])){
                            echo '<a href="'.esc_url( get_permalink() ).'" class="th-btn th_btn style2">'.wp_kses_post($settings['blog_btn']).'</a>';
                        }
                    echo '</div>';
                
            echo '</div>';
        echo '</div>';
    
    } wp_reset_postdata();
    
echo '</div>';
