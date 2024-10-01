<?php
echo '<div class="'.esc_attr($blog_row_class).'">';
    while( $blogpost->have_posts() ){
        $blogpost->the_post(); 
        $categories = get_the_category();

        echo '<div class="'.esc_attr($blog_col_class).'">';
            echo '<div class="'.esc_attr($blog_design_style).'">';
                    //Blog Post Thumbnail Category
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
                        // if($settings['blog_list_style2'] == '5'){
                            if(!empty($settings['blog_btn'])){
                                echo '<a href="'.esc_url( get_permalink() ).'" class="th-btn style2 th_btn">'.wp_kses_post($settings['blog_btn']).'</a>';
                            }
                        // }
                    echo '</div>';
            echo '</div>';
        echo '</div>';
    } wp_reset_postdata();
echo '</div>';