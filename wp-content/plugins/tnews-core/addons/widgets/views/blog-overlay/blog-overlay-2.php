<?php
while( $blogpost->have_posts() ){
    $blogpost->the_post(); 
    $categories = get_the_category();
    echo '<section class="bg-fixed dark-theme" data-bg-src="'.get_the_post_thumbnail_url().'" data-overlay="black" data-opacity="7">';
        echo '<div class="container">';
            echo '<div class="blog-bg-style1 row">';
                echo '<div class="col-md-9 col-sm">';
                    //Blog Post Thumbnail Category
                    $this->tnews_blog_thumbnial_cate();

                    echo '<h3 class="'.esc_attr($blog_font_size).'"><a class="hover-line" href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a></h3>';
                    echo '<div class="blog-meta">';
                        //Author Meta
                        $this->show_author_cb();
                        //Date Meta
                        $this->show_date_cb();
                    echo '</div>';
                echo '</div>';
                if(!empty(tnews_meta( 'post_format_video' ))){
                    echo '<div class="col-sm-auto mt-5 mt-sm-0">';
                        echo '<a href="'.esc_url( tnews_meta( 'post_format_video' ) ).'" class="play-btn style2 popup-video"><i class="fas fa-play"></i></a>';
                    echo '</div>';
                }
            echo '</div>';
        echo '</div>';
    echo '</section>';
} wp_reset_postdata();