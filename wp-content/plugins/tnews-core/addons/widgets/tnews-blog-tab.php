<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
/**
 *
 * Blog Post Tab Widget .
 *
 */
class Tnews_Blog_Tab extends Widget_Base {

	public function get_name() {
		return 'tnewsblogtab';
	}
	public function get_title() {
		return __( 'Blog Post Tab', 'tnews' );
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
			'section_title',
			[
				'label' 	=> __( 'Section Title', 'tnews' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Section Title', 'tnews' ),
				'rows' => 2,
				'condition'	=> [ 
					'layout_style' => ['2']
				]
			]
        );
        $this->add_control(
			'section_title_tag',
			[
				'label' 	=> __( 'Title Tag', 'tnews' ),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'span'  => 'span',
				],
				'default' => 'h2',
				'separator' => 'after',
				'condition'	=> [ 
					'layout_style' => ['2']
				]
			]
        );

		$repeater = new Repeater();

        $repeater->add_control(
			'tab_id', [
				'label' 		=> __( 'Tab ID', 'tnews' ),
				'description' => __('Use tab id different for work perfectly. (When use this widget many time in same page all id shoud be different.', 'tnews'),
				'type' 			=> Controls_Manager::TEXT,
				'rows' 			=> 2,
				'default' 		=> __( '1' , 'tnews' ),
			]
        );
        $repeater->add_control(
			'tab_title', [
				'label' 		=> __( 'Tab Title', 'tnews' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Top News' , 'tnews' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'blog_post_count',
			[
				'label' 	=> __( 'No of Post to show', 'tnews' ),
                'type' 		=> Controls_Manager::NUMBER,
                'min'       => 1,
                'max'       => count( get_posts( array('post_type' => 'post', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default'  	=> __( '4', 'tnews' )
			]
        );
        $repeater->add_control(
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
		$repeater->add_control(
            'selected_category',
            [
                'label' => __('Select Category', 'tnews'),
                'description' => __('Select Category if you show only category post.', 'tnews'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'multiple' => true,
                'options' => $this->get_categories_options(),
            ]
        );
		$repeater->add_control(
			'blog_query_type',
			[
				'label' 	=> __( 'Query Type', 'tnews' ),
                'type' 		=> Controls_Manager::SELECT,
                'options'   => [
                    '1'   	=> __('Normal','tnews'),
                    '2'   	=> __('Mostly Views Post','tnews'),
                    '3'   	=> __('Mostly Liked Post','tnews'),
                ],
                'default'  	=> '1'
			]
        );

		$this->add_control(
			'post_tab_list',
			[
				'label' 		=> __( 'Post Tabs', 'tnews' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'tab_title' => __( 'Top News','tnews' ),
					],
				],
				'title_field' 	=> '{{{ tab_title }}}',
				// 'condition'	=> [ 
				// 	'layout_style' => ['1']
				// ]
			]
		);

		
		$repeater2 = new Repeater();

        $repeater2->add_control(
			'tab_title', [
				'label' 		=> __( 'Tab Title', 'tnews' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Tab Name' , 'tnews' ),
				'label_block' 	=> true,
			]
        );
        $repeater2->add_control(
			'blog_post_count',
			[
				'label' 	=> __( 'No of Post to show', 'tnews' ),
                'type' 		=> Controls_Manager::NUMBER,
                'min'       => 1,
                'max'       => count( get_posts( array('post_type' => 'post', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default'  	=> __( '4', 'tnews' )
			]
        );
		$repeater2->add_control(
			'skip_post_count',
			[
				'label'   => __( 'Skip Post Count', 'tnews' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 0,
			]
		);
        $repeater2->add_control(
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
		$repeater2->add_control(
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
		$repeater2->add_control(
            'selected_category',
            [
                'label' => __('Select Category', 'tnews'),
                'description' => __('Select Category if you show only category post.', 'tnews'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'multiple' => true,
                'options' => $this->get_categories_options(),
            ]
        );

		$this->add_control(
			'post_tab_list2',
			[
				'label' 		=> __( 'Post Tabs', 'tnews' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater2->get_controls(),
				'default' 		=> [
					[
						'tab_title' => __( 'Top News','tnews' ),
					],
				],
				'title_field' 	=> '{{{ tab_title }}}',
				'condition'	=> [ 
					'layout_style' => ['3']
				]
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
			'blog_design_style',
			[
				'label' 	=> __( 'Blog Style', 'tnews' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> 'blog-style2',
				'options' 	=> [
					'blog-style1'  	=> __( 'Blog Style 1', 'tnews' ),
					'blog-style2' 		=> __( 'Blog Style 2', 'tnews' ),
					'blog-style3' 		=> __( 'Blog Style 3', 'tnews' ),
					'blog-style4' 		=> __( 'Blog Style 4', 'tnews' ),
					'blog-style5' 		=> __( 'Blog Style 5', 'tnews' ),
					'blog-style6' 		=> __( 'Blog Style 6', 'tnews' ),
				],
			]
		);
		$this->add_control(
			'blog_design_class',
			[
				'label' 	=> __( 'Blog Style Extra Class', 'tnews' ),
				'type' 		=> Controls_Manager::TEXT,
				'default'  	=> __( '', 'tnews' ),
			]
		);
        $this->add_control(
            'blog_image_size',
            [
                'label' => 'Blog Image Size',
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_image_size_options(),
                'default' 	=> 'tnews_288X233',
            ]
        );
		$this->add_control(
			'blog_img_class',
			[
				'label' 	=> __( 'Blog Image Extra Class', 'tnews' ),
				'type' 		=> Controls_Manager::TEXT,
				'default'  	=> __( '', 'tnews' ),
			]
		);
		$this->add_control(
			'show_cate_img',
			[
				'label' => esc_html__( 'Show Category in Image', 'tnews' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tnews' ),
				'label_off' => esc_html__( 'Hide', 'tnews' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'blog_font_size',
			[
				'label' 	=> __( 'Title Font Size', 'tnews' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> 'box-title-20',
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
			'title_count2',
			[
				'label' 	=> __( 'First Title Length', 'tnews' ),
				'type' 		=> Controls_Manager::TEXT,
				'default'  	=> __( '5', 'tnews' ),
				'condition'	=> [ 
					'layout_style' => ['2']
				]
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

		//-------------------------Section Title Style-----------------------//
		$this->start_controls_section(
			'section_title_style_section',
			[
				'label' => __( 'Section Title Style', 'tnews' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,	
				'condition'	=> [ 
					'layout_style' => ['2']
				]
			]
		);
		$this->add_control(
			'section_title_color',
			[
				'label' 	=> __( 'Color', 'tnews' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sec-title' => 'color: {{VALUE}}!important;',
				],
			]
		);
		$this->add_control(
			'section_title_color2',
			[
				'label' 	=> __( 'Line Color Color', 'tnews' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sec-title.has-line:after' => '--gray-color: {{VALUE}}!important;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'section_title_typography',
				'label' 	=> __( 'Typography', 'tnews' ),
				'selector' 	=> '{{WRAPPER}} .sec-title',
			]
		);
		$this->add_responsive_control(
			'section_title_margin',
			[
				'label' 		=> __( 'Margin', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .sec-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'section_title_padding',
			[
				'label' 		=> __( 'Padding', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .sec-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//-------------------------Tab Style-----------------------//
		$this->start_controls_section(
			'blog_tab_style_section',
			[
				'label' => __( 'Tab Style', 'tnews' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,	
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'blog_tab_typography',
				'label' 	=> __( 'Typography', 'tnews' ),
				'selector' 	=> '{{WRAPPER}} .tab-menu .tab-btn, {{WRAPPER}} .filter-menu .tab-btn',
			]
		);
		$this->add_control(
			'blog_tab_color',
			[
				'label' 	=> __( 'Color', 'tnews' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-menu .tab-btn, {{WRAPPER}} .filter-menu .tab-btn' => 'color: {{VALUE}}!important;',
				],
			]
		);
		$this->add_control(
			'blog_tab_color2',
			[
				'label' 	=> __( 'Active Color', 'tnews' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-menu .tab-btn.active, {{WRAPPER}} .filter-menu .tab-btn.active' => 'color: {{VALUE}}!important;',
				],
			]
		);
		$this->add_control(
			'blog_tab_bg',
			[
				'label' 	=> __( 'Background', 'tnews' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-menu, {{WRAPPER}} .filter-menu .tab-btn' => 'background: {{VALUE}}!important;',
				],
			]
		);
		$this->add_control(
			'blog_tab_bg2',
			[
				'label' 	=> __( 'Active Background', 'tnews' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-menu .tab-btn.active, {{WRAPPER}} .filter-menu .tab-btn.active' => 'background: {{VALUE}}!important;',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'blog_tab_border',
				'label' 	=> __( 'Border', 'tnews' ),
				'selector' => '{{WRAPPER}} .tab-menu .tab-btn, {{WRAPPER}} .filter-menu .tab-btn',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'blog_tab_border2',
				'label' 	=> __( 'Active Border', 'tnews' ),
				'selector' => '{{WRAPPER}} .tab-menu .tab-btn.active, {{WRAPPER}} .filter-menu .tab-btn.active',
			]
		);

		$this->add_responsive_control(
			'blog_tab_padding',
			[
				'label' 		=> __( 'Padding', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .tab-menu .tab-btn, {{WRAPPER}} .filter-menu .tab-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

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
    public function tnews_blog_post_thumb( $thumb_size = null) {
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
			echo '</div>';

		}elseif( has_post_thumbnail() && $format == 'standard' ) {
			echo '<div class="blog-img">';
					the_post_thumbnail($thumb_size);
			echo '</div>';

		}elseif( $format == 'video' ){
			if( has_post_thumbnail() && ! empty ( tnews_meta( 'post_format_video' ) ) ){
				echo '<div class="blog-img blog-video">';
						the_post_thumbnail($thumb_size);

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
				echo '</div>';
			}
		}

	}

	//Blog post thumbnial 
    public function tnews_blog_post_thumb_with_cate( $thumb_size = null, $cate_show = null, $class = null) {
		if( get_post_format() ) {
			$format = get_post_format();
		}else{
			$format = 'standard';
		}

		$tnews_post_slider_thumbnail = tnews_meta( 'post_format_slider' );

		if( !empty( $tnews_post_slider_thumbnail ) ){
			echo '<div class="blog-img '.$class.'">';
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
			echo '<div class="blog-img '.$class.'">';
					the_post_thumbnail($thumb_size);
					if($cate_show){
						//Blog Post Thumbnail Category
						$this->tnews_blog_thumbnial_cate();
					}
			echo '</div>';

		}elseif( $format == 'video' ){
			if( has_post_thumbnail() && ! empty ( tnews_meta( 'post_format_video' ) ) ){
				echo '<div class="blog-img  '.$class.' blog-video">';
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

		$this->add_render_attribute('title_args', 'class', 'sec-title has-line th-title');

		$blog_img_class = $settings['blog_img_class'] ? $settings['blog_img_class'] : '';
		$blog_design_style = $settings['blog_design_style'] ? $settings['blog_design_style'] : 'blog-style1';
		$blog_design_class = $settings['blog_design_class'] ? $settings['blog_design_class'] : ' ';
        $blog_image_size = $settings['blog_image_size'] ? $settings['blog_image_size'] : 'tnews_288X187';
        $blog_font_size = $settings['blog_font_size'] ? $settings['blog_font_size'] : 'box-title-20';

		if($settings['show_cate_img'] == 'yes'){
			$img_cate = true;
		}else{
			$img_cate = false;
		}

		if( $settings['layout_style'] == '2' ){
			require dirname( __FILE__ ) . '/views/blog-tab/blog-tab-2.php';
		}elseif( $settings['layout_style'] == '3' ){
			// require dirname( __FILE__ ) . '/views/blog-tab/blog-tab-3.php';
		}else{
			require dirname( __FILE__ ) . '/views/blog-tab/blog-tab-1.php';
		}

      
	}
}