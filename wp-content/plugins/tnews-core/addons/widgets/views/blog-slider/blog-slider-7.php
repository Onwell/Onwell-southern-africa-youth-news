<?php
echo '<div class="container-full-1">';
    echo '<div class="row th-carousel slider-shadow" id="blog-slide5" data-slide-show="'.esc_attr($all_items).'" data-ml-slide-show="'.esc_attr($ml_items).'" data-lg-slide-show="'.esc_attr($lg_items).'" data-md-slide-show="'.esc_attr($md_items).'" data-sm-slide-show="'.esc_attr($sm_items).'">';
    while( $blogpost->have_posts() ){
        $blogpost->the_post(); 
        $categories = get_the_category();

            echo '<div class="'.esc_attr($blog_col_class).'">';
                echo '<div class="'.esc_attr($blog_design_style).'">';
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