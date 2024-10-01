<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
/**
 *
 * News Ticker Widget .
 *
 */
class Tnews_News_Ticker extends Widget_Base {

	public function get_name() {
		return 'tnewsnewsticker';
	}
	public function get_title() {
		return __( 'News Ticker', 'tnews' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'tnews' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'blog_post_section',
			[
				'label' => __( 'News Ticker', 'tnews' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'layout_style',
			[
				'label' 	=> __( 'Layout Style', 'tnews' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  		=> __( 'Style One', 'tnews' ),
					// '2' 		=> __( 'Style Two', 'tnews' ),
				],
				'separator' => 'after'
			]
		);

        $this->add_control(
			'blog_post_count',
			[
				'label' 	=> __( 'No of Post to show', 'tnews' ),
                'type' 		=> Controls_Manager::NUMBER,
                'min'       => 1,
                'max'       => count( get_posts( array('post_type' => 'post', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default'  	=> __( '4', 'tnews' )
			]
        );

        $this->add_control(
			'blog_post_order',
			[
				'label' 	=> __( 'Order', 'tnews' ),
                'type' 		=> Controls_Manager::SELECT,
                'options'   => [
                    'ASC'   	=> __('ASC','tnews'),
                    'DESC'   	=> __('DESC','tnews'),
                ],
                'default'  	=> 'DESC'
			]
        );

        $this->add_control(
			'blog_post_order_by',
			[
				'label' 	=> __( 'Order By', 'tnews' ),
                'type' 		=> Controls_Manager::SELECT,
                'options'   => [
                    'ID'    	=> __( 'ID', 'tnews' ),
                    'author'    => __( 'Author', 'tnews' ),
                    'title'    	=> __( 'Title', 'tnews' ),
                    'date'    	=> __( 'Date', 'tnews' ),
                    'rand'    	=> __( 'Random', 'tnews' ),
                ],
                'default'  	=> 'ID'
			]
        );

        $this->add_control(
			'filter_post',
			[
				'label' 	=> __( 'Filter Post?', 'tnews' ),
                'type' 		=> Controls_Manager::SELECT,
                'options'   => [
                    'category'    	=> __( 'Category', 'tnews' ),
                    'tags'    => __( 'Tags', 'tnews' ),
                    'sposts'    => __( 'Selected Post', 'tnews' ),
                ],
                'default'  	=> 'category'
			]
        );
		$this->add_control(
            'selected_category',
            [
                'label' => __('Select Category', 'tnews'),
                'description' => __('Select Category if you show only category post. (Note: no select tags)', 'tnews'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_categories_options(),
                'condition' => ['filter_post' => 'category'],
            ]
        );
        $this->add_control(
            'selected_tags',
            [
                'label' => __('Select Tags', 'tnews'),
                'description' => __('Select Tags if you show only tags post. (Note: no select category)', 'tnews'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_tags_options(),
                'condition' => ['filter_post' => 'tags'],
            ]
        );
		$this->add_control(
			'selected_posts',
			[
				'label'         => __( 'Select Post', 'tnews' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
				'options'       => $this->tnews_post_id(),
				'condition' => ['filter_post' => 'sposts'],
			]
        );

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

        //-------------------------General Style-----------------------//
        $this->start_controls_section(
			'general_style_section',
			[
				'label' => __( 'General Style', 'tnews' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'general_color',
			[
				'label' 		=> __( 'Heading Color', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .news-area .title' => 'color: {{VALUE}}!important',
                ],
			]
        );
		$this->add_control(
			'general_bg',
			[
				'label' 		=> __( 'Heading Background', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .news-area .title' => 'background: {{VALUE}}!important',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'general_typography',
				'label' 	=> __( 'Heading Typography', 'tnews' ),
                'selector' 	=> '{{WRAPPER}} .news-area .title',
			]
        );

        $this->add_responsive_control(
			'general_padding',
			[
				'label' 		=> __( 'Heading Padding', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .news-area .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_control(
			'general_content_bg',
			[
				'label' 		=> __( 'Content Background', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .news-area .news-wrap' => 'background: {{VALUE}}!important',
                ],
			]
        );
        $this->add_responsive_control(
			'general_content_padding',
			[
				'label' 		=> __( 'Content Padding', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .news-area .news-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->end_controls_section();

		//-------------------------Title Style-----------------------//
        $this->start_controls_section(
			'title_style_section',
			[
				'label' => __( 'Title Style', 'tnews' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Color', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .breaking-news' => 'color: {{VALUE}}!important',
                ],
			]
        );

		$this->add_control(
			'title_color2',
			[
				'label' 		=> __( 'Dot Color', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .breaking-news:before' => 'background-color: {{VALUE}}!important',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'label' 	=> __( 'Typography', 'tnews' ),
                'selector' 	=> '{{WRAPPER}} .breaking-news',
			]
        );

        $this->end_controls_section();

    }

    //get category list
    public function get_categories_options() {
        $categories = get_categories(array('hide_empty' => false));
        $options = array();
        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }
        return $options;
    }

    //get tags list
    public function get_tags_options() {
        $tags = get_tags(array('hide_empty' => false));
        $options = array();
        foreach ($tags as $tag) {
            $options[$tag->term_id] = $tag->name;
        }
        return $options;
    }

	// Get Specific Post
	public function tnews_post_id(){
		$args = array(
			'post_type'         => 'post',
			'posts_per_page'    => -1,
		);

		$tnews_post = new WP_Query( $args );

		$postarray = [];

		while( $tnews_post->have_posts() ){
			$tnews_post->the_post();
			$postarray[get_the_Id()] = get_the_title();
		}
		wp_reset_postdata();
		return $postarray;
	}


	protected function render() {

        $settings = $this->get_settings_for_display();

        $args = array(
			'post_type' => 'post',
			'posts_per_page' => !empty($settings['blog_post_count']) ? $settings['blog_post_count'] : -1,
			'orderby' => $settings['blog_post_order_by'],
			'order' => $settings['blog_post_order'],
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
		);

        if( $settings['filter_post'] == "category" ){
            $args['cat'] = $settings['selected_category'];
        }
        if( $settings['filter_post'] == "tags" ){
            $args['tag__in'] = $settings['selected_tags'];
        }
        if( $settings['filter_post'] == "sposts" ){
            $args['post__in'] = $settings['selected_posts'];
        }

        $blogpost = new WP_Query( $args );

        if( $settings['layout_style'] == '2' ){

        }else{
            echo '<div class="news-area">';
                echo '<div class="title">Breaking News :</div>';
                echo '<div class="news-wrap">';
                    echo '<div class="row slick-marquee">';

                        while( $blogpost->have_posts() ){
                            $blogpost->the_post(); 
                            echo '<div class="col-auto">';
                                echo '<a href="'.esc_url( get_permalink() ).'" class="breaking-news">'.esc_html( get_the_title() ).'</a>';
                            echo '</div>';
                        } wp_reset_postdata();

                echo ' </div>';
                echo '</div>';
            echo '</div>';
         
        }


	}
}