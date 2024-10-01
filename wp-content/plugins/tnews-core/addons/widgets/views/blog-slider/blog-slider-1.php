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
            echo '<div class="icon-box">';
                echo '<button data-slick-prev="#blog-slide1" class="slick-arrow default"><i class="far fa-arrow-left"></i></button>';
                echo '<button data-slick-next="#blog-slide1" class="slick-arrow default"><i class="far fa-arrow-right"></i></button>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';

echo '<div class="row th-carousel" id="blog-slide1" data-slide-show="'.esc_attr($all_items).'" data-lg-slide-show="'.esc_attr($lg_items).'" data-md-slide-show="'.esc_attr($md_items).'" data-sm-slide-show="'.esc_attr($sm_items).'">';
    while( $blogpost->have_posts() ){
        $blogpost->the_post(); 
        $categories = get_the_category();
        echo '<div class="'.esc_attr($blog_col_class).'">';
            echo '<div class="'.esc_attr($blog_design_style).'">';
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