<?php
echo '<div class="nav tab-menu indicator-active" role="tablist">';
foreach( $settings['post_tab_list'] as $key => $data ){
    $active = ($key==0) ? 'active':'';
    echo '<button class="tab-btn '.esc_attr($active).'" id="nav-one-tab'.esc_attr($data['tab_id']).'" data-bs-toggle="tab" data-bs-target="#nav-one'.esc_attr($data['tab_id']).'" type="button" role="tab" aria-controls="nav-one'.esc_attr($data['tab_id']).'" aria-selected="true">'.$data['tab_title'].'</button>';
}
echo '</div>';
echo '<div class="tab-content">';
foreach( $settings['post_tab_list'] as $key => $data ){
    
    if($data['blog_query_type'] == '2' ){
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => !empty($data['blog_post_count']) ? $data['blog_post_count'] : -1,
            'order' => $data['blog_post_order'],
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value_num',
        );
    }elseif($data['blog_query_type'] == '3' ){
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => !empty($data['blog_post_count']) ? $data['blog_post_count'] : -1,
            'order' => $data['blog_post_order'],
            'ignore_sticky_posts' => 1,
            'meta_key' => '_custom_like_count',
            'orderby' => 'meta_value_num',
            'order'          => 'DESC', 
        );
    }else{
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => !empty($data['blog_post_count']) ? $data['blog_post_count'] : -1,
            'order' => $data['blog_post_order'],
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1, 
        );
    }

    if (!empty($data['selected_category'])) {
        $args['category_name'] = $data['selected_category'];
    }

    $blogpost = new WP_Query($args);

    $active = ($key==0) ? 'show active':'';
    
    echo '<div class="tab-pane fade '.esc_attr($active).'" id="nav-one'.esc_attr($data['tab_id']).'" role="tabpanel" aria-labelledby="nav-one-tab'.esc_attr($data['tab_id']).'">';
        echo '<div class="row gy-4">';
            while( $blogpost->have_posts() ){
                $blogpost->the_post(); 
                $categories = get_the_category();

                echo '<div class="col-xl-12 col-md-6 border-blog">';
                    echo '<div class="'.esc_attr($blog_design_style .' '. $blog_design_class).'">';
                            //Blog post thumbnial with category
                            $this->tnews_blog_post_thumb_with_cate( $blog_image_size, $img_cate, $blog_img_class);

                        echo '<div class="blog-content">';
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
                echo '</div>';
            } wp_reset_postdata();
        echo '</div>';
    echo '</div>';
}
echo '</div>';