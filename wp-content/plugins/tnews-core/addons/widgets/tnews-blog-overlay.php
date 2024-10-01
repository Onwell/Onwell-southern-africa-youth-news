<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
/**
 *
 * Blog Overlay Post Widget .
 *
 */
class Tnews_Overlay_Blog extends Widget_Base {

	public function get_name() {
		return 'tnewsoverlayblog';
	}
	public function get_title() {
		return __( 'Blog Overlay Post', 'tnews' );
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
				'label' => __( 'Blog Post', 'tnews' ),
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
					'2' 		=> __( 'Style Two', 'tnews' ),
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
			'skip_post',
			[
				'label'          => esc_html__( 'Skip Post Enable?', 'tnews' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => esc_html__( 'Show', 'tnews' ),
				'label_off'      => esc_html__( 'Hide', 'tnews' ),
				'return_value'   => 'yes',
				'default'        => 'yes',
				'style_transfer' => true,
			]
		);
		$this->add_control(
			'skip_post_count',
			[
				'label'   => __( 'Skip Post Count', 'tnews' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 0,
				'condition' => ['skip_post' => 'yes'],
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
                'description' => __('Select Category if you show only category post.', 'tnews'),
                'type' => \Elementor\Controls_Manager::SELECT,
                // 'multiple' => true,
                'options' => $this->get_categories_options(),
                'condition' => ['filter_post' => 'category'],
            ]
        );
        $this->add_control(
            'selected_tags',
            [
                'label' => __('Select Tags', 'tnews'),
                'description' => __('Select Tags if you show only tags post.', 'tnews'),
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
				'description' => __('Select Post if you show only selected post.', 'tnews'),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
				'options'       => $this->tnews_post_id(),
				'condition' => ['filter_post' => 'sposts'],
			]
        );

        $this->add_control(
			'heading1',
			[
				'label' => esc_html__( 'Blog Post Layout Elements', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'blog_row_class',
			[
				'label' 	=> __( 'Blog Row Class', 'tnews' ),
				'type' 		=> Controls_Manager::TEXTAREA,
				'default'  	=> __( 'row gy-4', 'tnews' ),
				'rows' => 1,
				'condition' => [
					'layout_style' => ['1'],
				]
			]
		);
		$this->add_control(
			'blog_col_class',
			[
				'label' 	=> __( 'Blog Column Class', 'tnews' ),
				'type' 		=> Controls_Manager::TEXTAREA,
				'default'  	=> __( 'dark-theme img-overlay2', 'tnews' ),
				'rows' => 2,
				'condition' => [
					'layout_style!' => ['2'],
				]
			]
		);
		$this->add_control(
            'blog_image_size',
            [
                'label' => 'Blog Image Size',
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_image_size_options(),
                'default' 	=> 'tnews_288X233',
				'condition' => [
					'layout_style!' => ['2'],
				]
            ]
        );
		$this->add_control(
			'blog_font_size',
			[
				'label' 	=> __( 'Title Font Size', 'tnews' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> 'box-title-18',
				'options' 	=> [
					'box-title-18'  	=> __( 'Font Size 18', 'tnews' ),
					'box-title-20' 		=> __( 'Font Size 20', 'tnews' ),
					'box-title-22' 		=> __( 'Font Size 22', 'tnews' ),
					'box-title-24' 		=> __( 'Font Size 24', 'tnews' ),
					'box-title-30' 		=> __( 'Font Size 30', 'tnews' ),
					'box-title-40' 		=> __( 'Font Size 40', 'tnews' ),
					'box-title-50' 		=> __( 'Font Size 50', 'tnews' ),
				],
			]
		);

        $this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'title_count',
			[
				'label' 	=> __( 'Title Length', 'tnews' ),
				'type' 		=> Controls_Manager::TEXT,
				'default'  	=> __( '5', 'tnews' ),
			]
		);
		$this->add_control(
			'show_cate',
			[
				'label' => esc_html__( 'Show Category', 'tnews' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tnews' ),
				'label_off' => esc_html__( 'Hide', 'tnews' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_author',
			[
				'label' => esc_html__( 'Show Author', 'tnews' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tnews' ),
				'label_off' => esc_html__( 'Hide', 'tnews' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_date',
			[
				'label' => esc_html__( 'Show Date', 'tnews' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tnews' ),
				'label_off' => esc_html__( 'Hide', 'tnews' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->end_controls_section();

		//---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------------------------Title Style-----------------------//
        $this->start_controls_section(
			'blog_title_style_section',
			[
				'label' => __( 'Title Style', 'tnews' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,	
			]
		);
        $this->add_control(
			'blog_title_color',
			[
				'label' 	=> __( 'Color', 'tnews' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} h3' => 'color: {{VALUE}}!important;',
                ],
			]
        );
        $this->add_control(
			'blog_title_color2',
			[
				'label' 	=> __( 'Hover Color', 'tnews' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} h3 a:hover' => '--theme-color: {{VALUE}}!important;',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'blog_title_typography',
				'label' 	=> __( 'Typography', 'tnews' ),
                'selector' 	=> '{{WRAPPER}} h3',
			]
		);
        $this->add_responsive_control(
			'blog_title_margin',
			[
				'label' 		=> __( 'Margin', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
        $this->add_responsive_control(
			'blog_title_padding',
			[
				'label' 		=> __( 'Padding', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

        $this->end_controls_section();

		//-------------------------Meta Style-----------------------//
        $this->start_controls_section(
			'blog_meta_style_section',
			[
				'label' => __( 'Meta Style', 'tnews' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,	
			]
		);
        $this->add_control(
			'blog_meta_color',
			[
				'label' 	=> __( 'Color', 'tnews' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-meta a' => 'color: {{VALUE}}!important;',
                ],
			]
        );
        $this->add_control(
			'blog_meta_color2',
			[
				'label' 	=> __( 'Hover Color', 'tnews' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-meta a:hover' => 'color: {{VALUE}}!important;',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'blog_meta_typography',
				'label' 	=> __( 'Typography', 'tnews' ),
                'selector' 	=> '{{WRAPPER}} .blog-meta a',
			]
		);
        $this->add_responsive_control(
			'blog_meta_margin',
			[
				'label' 		=> __( 'Margin', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .blog-meta a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
		$this->add_control(
			'cate_heading',
			[
				'label' => esc_html__( 'Category', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'blog_cate_color',
			[
				'label' 	=> __( 'Color', 'tnews' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .category' => 'color: {{VALUE}}!important;',
                ],
			]
        );
        $this->add_control(
			'blog_cate_color2',
			[
				'label' 	=> __( 'Hover Color', 'tnews' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .category:hover' => 'color: {{VALUE}}!important;',
                ],
			]
        );
		$this->add_control(
			'blog_cate_bg',
			[
				'label' 	=> __( 'Background', 'tnews' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .category' => 'background: {{VALUE}}!important;',
                ],
			]
        );
        $this->add_control(
			'blog_cate_bg2',
			[
				'label' 	=> __( 'Background Color', 'tnews' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .category:hover' => 'background: {{VALUE}}!important;',
                ],
			]
        );
		$this->add_responsive_control(
			'blog_cate_padding',
			[
				'label' 		=> __( 'Padding', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

        $this->end_controls_section();


    }

    // Get all registered image sizes
    public function get_image_size_options() {
         global $_wp_additional_image_sizes;
         $image_sizes = get_intermediate_image_sizes();
         $options = array();
         foreach ($image_sizes as $size) {
             $size_label = $size;
             if (isset($_wp_additional_image_sizes[$size]['width'])) {
                 $size_label .= ' (' . $_wp_additional_image_sizes[$size]['width'] . 'x' . $_wp_additional_image_sizes[$size]['height'] . ')';
             }
             $options[$size] = $size_label;
         }
         return $options;
    }

    // //get category list
	public function get_categories_options() {
		$categories = get_categories(array('hide_empty' => false));
		$options = array();

		// Add an empty option
		$options[''] = 'Select a category';
		
		foreach ($categories as $category) {
			$options[$category->slug] = $category->name;
		}
		return $options;
	}

    //get tags list
	public function get_tags_options() {
        $tags = get_tags(array('hide_empty' => false));
        $options = array();
        foreach ($tags as $tag) {
            $options[$tag->slug] = $tag->name;
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

	//Blog post thumbnial category
	public function tnews_blog_thumbnial_cate(){
		$settings = $this->get_settings();
		$categories = get_the_category(); 
		if(!empty($categories)){
			global $post;
			$terms = get_the_terms( $post->ID, 'category' );
			$term_id = $terms[0]->term_id;
			if($settings['show_cate']){
				echo '<a data-theme-color="'.get_term_meta( $term_id, '_tnews_term_bg_color', true ).'" href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'" class="category">'.esc_html( $categories[0]->name ).'</a>';
			}
		}
	} 

	//Blog post thumbnial 
    public function tnews_blog_post_thumb_with_cate( $thumb_size = null, $cate_show = null) {
		if( get_post_format() ) {
			$format = get_post_format();
		}else{
			$format = 'standard';
		}

		$tnews_post_slider_thumbnail = tnews_meta( 'post_format_slider' );

		if( !empty( $tnews_post_slider_thumbnail ) ){
			echo '<div class="blog-img">';
				echo '<div class="th-carousel arrow-wrap">';
					foreach( $tnews_post_slider_thumbnail as $single_image ){
						$attachment_id = attachment_url_to_postid($single_image);
						$thumbnail = wp_get_attachment_image($attachment_id, $thumb_size);

						echo '<a href="'.esc_url( get_permalink() ).'">'.$thumbnail.'</a>';
					}
				echo '</div>';
				if($cate_show){
					//Blog Post Thumbnail Category
					$this->tnews_blog_thumbnial_cate();
				}
			echo '</div>';

		}elseif( has_post_thumbnail() && $format == 'standard' ) {
			echo '<div class="blog-img">';
					the_post_thumbnail($thumb_size);
					if($cate_show){
						//Blog Post Thumbnail Category
						$this->tnews_blog_thumbnial_cate();
					}
			echo '</div>';

		}elseif( $format == 'video' ){
			if( has_post_thumbnail() && ! empty ( tnews_meta( 'post_format_video' ) ) ){
				echo '<div class="blog-img blog-video">';
						the_post_thumbnail($thumb_size);
						if($cate_show){
							//Blog Post Thumbnail Category
							$this->tnews_blog_thumbnial_cate();
						}

					echo '<a href="'.esc_url( tnews_meta( 'post_format_video' ) ).'" class="play-btn popup-video style6">';
						echo '<i class="fas fa-play"></i>';
					echo '</a>';
				echo '</div>';
			}elseif( ! has_post_thumbnail() && ! is_single() ){
				echo '<div class="blog-video">';
						echo tnews_embedded_media( array( 'video', 'iframe' ) );
				echo '</div>';
			}
		}elseif( $format == 'audio' ){
			$tnews_audio = tnews_meta( 'post_format_audio' );
			if( ! empty( $tnews_audio ) ){
				echo '<div class="blog-audio">';
					echo wp_oembed_get( $tnews_audio );
					if($cate_show){
						//Blog Post Thumbnail Category
						$this->tnews_blog_thumbnial_cate();
					}
				echo '</div>';
			}
		}

	}

	//Meta - Author
	public function show_author_cb(){ 
		$settings = $this->get_settings();
		if($settings['show_author']){
			echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'"><i class="far fa-user"></i>'.esc_html__('By - ', 'tnews') . esc_html( ucwords( get_the_author() ) ).'</a>';
		}
	}
	//Meta - Date
	public function show_date_cb(){
		$settings = $this->get_settings();
		if($settings['show_date']){
			echo '<a href="'.esc_url( tnews_blog_date_permalink() ).'"><i class="fal fa-calendar-days"></i>12 Mar, 2023</a>';
		}
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

		if( $settings['skip_post'] == "yes" ){
            $args['offset'] = $settings['skip_post_count'];
        }
		if ($settings['filter_post'] == "category" && !empty($settings['selected_category'])) {
			$args['category_name'] = $settings['selected_category'];
		}
		if ($settings['filter_post'] == "tags" && !empty($settings['selected_tags'])) {
			$args['tag_slug__in'] = $settings['selected_tags'];
		}
		if ($settings['filter_post'] == "sposts" && !empty($settings['selected_posts'])) {
			$args['post__in'] = $settings['selected_posts'];
		}
	
		$blogpost = new WP_Query($args);

		$blog_row_class = $settings['blog_row_class'] ? $settings['blog_row_class'] : 'row gy-4';
        $blog_col_class = $settings['blog_col_class'] ? $settings['blog_col_class'] : 'dark-theme img-overlay2';
        $blog_image_size = $settings['blog_image_size'] ? $settings['blog_image_size'] : 'tnews_288X233';
        $blog_font_size = $settings['blog_font_size'] ? $settings['blog_font_size'] : 'box-title-18';

		if( $settings['layout_style'] == '2' ){
			require dirname( __FILE__ ) . '/views/blog-overlay/blog-overlay-2.php';
		}elseif( $settings['layout_style'] == '3' ){
			// require dirname( __FILE__ ) . '/views/blog-overlay/blog-overlay-3.php';
		}else{
			require dirname( __FILE__ ) . '/views/blog-overlay/blog-overlay-1.php';
		}
      
	}
}