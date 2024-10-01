<?php
    echo '<div class="row">';
        echo '<div class="col-xl-4 col-lg-2">';
            echo '<div class="blog-tab" data-asnavfor=".blog-tab-slide">';
                $x=0;
                while( $blogpost->have_posts() ){
                    $blogpost->the_post(); 
                    $categories = get_the_category();
                    $x++;
                    $active = ($x == 1) ? 'active' : '';

                    echo '<div class="tab-btn '.esc_attr($active).'">';
                        echo '<div class="blog-style2">';
                           //Blog post thumbnial with category
                            $this->tnews_blog_post_thumb_with_cate( 'tnews_100X100', $img_cate, $blog_img_class);

                            echo '<div class="blog-content">';
                                if($img_cate == false){
                                    //Blog Post Category
                                    $this->tnews_blog_thumbnial_cate();
                                }
                                echo '<h3 class="box-title-20"><a class="hover-line" href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count2'], '' ) ).'</a></h3>';
                                echo '<div class="blog-meta">';
                                    //Date Meta
                                    $this->show_date_cb();
                                echo '</div>';
                            echo '</div>';

                        echo '</div>';
                    echo '</div>';

                } wp_reset_postdata();

            echo '</div>';
        echo '</div>';
        echo '<div class="col-xl-8 col-lg-10">';
            echo '<div class="blog-tab-slide th-carousel" data-fade="true" data-slide-show="1" data-md-slide-show="1">';
                while( $blogpost->have_posts() ){
                    $blogpost->the_post(); 
                    $categories = get_the_category();

                    echo '<div class="">';
                        echo '<div class="blog-style8">';
                            //Blog post thumbnial with category
                            $this->tnews_blog_post_thumb_with_cate( $blog_image_size, $img_cate, $blog_img_class);

                            echo '<h3 class="'.esc_attr($blog_font_size).'"><a class="hover-line" href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a></h3>';
                            echo '<div class="blog-meta">';
                                if($img_cate == false){
                                    //Blog Post Category
                                    $this->tnews_blog_thumbnial_cate();
                                }
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