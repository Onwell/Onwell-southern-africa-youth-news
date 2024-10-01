<?php
echo '<div class="th-hero-wrapper hero-1" id="hero">';

   echo '<div class="hero-slider-1 th-carousel" data-fade="true" data-slide-show="1" data-md-slide-show="1" data-adaptive-height="true">';
        while( $blogpost->have_posts() ){
            $blogpost->the_post(); 
            $categories = get_the_category();
            echo '<div class="th-hero-slide">';
                echo '<div class="th-hero-bg" data-overlay="black" data-opacity="6" data-bg-src="'.get_the_post_thumbnail_url().'"></div>';
                echo '<div class="container">';
                    echo '<div class="blog-bg-style1">';
                            //Blog Post Thumbnail Category
                            $this->tnews_blog_thumbnial_cate();

                            echo '<h3 data-ani="slideinup" data-ani-delay="0.3s" class="box-title-50"><a class="hover-line" href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a></h3>';
                            echo '<div class="blog-meta" data-ani="slideinup" data-ani-delay="0.5s">';
                                //Author Meta
                                $this->show_author_cb();
                                //Date Meta
                                $this->show_date_cb();
                            echo '</div>';
                        echo '<p class="blog-text" data-ani="slideinup" data-ani-delay="0.7s">'.esc_html( wp_trim_words( get_the_content( ), $settings['excerpt_count'], '' ) ).'</p>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        } wp_reset_postdata();
   echo '</div>';

   echo '<div class="hero-tab-area">';
       echo '<div class="container">';
           echo '<div class="hero-tab" data-asnavfor=".hero-slider-1">';
            $x = 0;
            while( $blogpost->have_posts() ){
                $blogpost->the_post(); 
                $categories = get_the_category();
                $x++;
                $active = ($x == 1) ? 'active' : '';

                echo '<div class="tab-btn '.$active.'">';
                    the_post_thumbnail('tnews_184X80');
                echo '</div>';
                } wp_reset_postdata();
           echo '</div>';
       echo '</div>';
   echo '</div>';

echo '</div>';