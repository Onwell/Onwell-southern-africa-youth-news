<?php

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * Header Widget .
 *
 */
class Tnews_Header extends Widget_Base {

	public function get_name() {
		return 'tnewsheader';
	}
	public function get_title() {
		return __( 'Header', 'tnews' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'tnews_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'layout_section',
			[
				'label' 	=> __( 'Header', 'tnews' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'layout_style',
			[
				'label' 	=> __( 'Layout Style', 'tnews' ),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'1' => __( 'Style One', 'tnews' ),
					'2' => __( 'Style Two', 'tnews' ),
					'3' => __( 'Style Three', 'tnews' ),
					'4' => __( 'Style Four', 'tnews' ),
				],
				'default' => '1',
			]
        );

		$this->add_control(
			'show_news_ticker',
			[
				'label' 		=> __( 'Show News Ticker?', 'tnews' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'tnews' ),
				'label_off' 	=> __( 'Hide', 'tnews' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'		=> [ 
					'layout_style' => ['2', '4']
				],
			]
		);
		$this->add_control(
			'news_ticker_text',
			[
				'label' 		=> __( 'News Ticker Text', 'tnews' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'default' 	=> __( 'Breaking News :', 'tnews' ),
				'condition'		=> [
					'show_news_ticker' => [ 'yes' ],
					'layout_style' => ['2', '4']
				],
			]
		);
		$this->add_control(
			'blog_post_count',
			[
				'label' 	=> __( 'No of Post to show', 'tnews' ),
                'type' 		=> Controls_Manager::NUMBER,
                'min'       => 1,
                'max'       => count( get_posts( array('post_type' => 'post', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default'  	=> __( '4', 'tnews' ),
				'condition'		=> [
					'show_news_ticker' => [ 'yes' ],
					'layout_style' => ['2', '4']
				],
			]
        );
		$this->add_control(
            'selected_category',
            [
                'label' => __('Select Category', 'tnews'),
                'description' => __('Select Category if you show only category post.', 'tnews'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_categories_options(),
                'condition' => ['filter_post' => 'category'],
				'condition'		=> [
					'show_news_ticker' => [ 'yes' ],
					'layout_style' => ['2', '4']
				],
				'separator'		=> 'after',
            ]
        );

		$this->add_control(
			'show_date',
			[
				'label' 		=> __( 'Show Today Date?', 'tnews' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'tnews' ),
				'label_off' 	=> __( 'Hide', 'tnews' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'		=> [ 
					'layout_style' => ['1', '2']
				],
			]
		);
		$this->add_control(
			'show_color_mode_box',
			[
				'label' 		=> __( 'Show Color Mode Box?', 'tnews' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'tnews' ),
				'label_off' 	=> __( 'Hide', 'tnews' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				// 'condition'		=> [ 
				// 	'layout_style' => ['1', '2', '3']
				// ],
			]
		);
		$this->add_control(
			'show_login_btn',
			[
				'label' 		=> __( 'Show Login?', 'tnews' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'tnews' ),
				'label_off' 	=> __( 'Hide', 'tnews' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'		=> [ 
					'layout_style' => ['1', '2']
				],
			]
		);
		$this->add_control(
			'login_btn_text',
			[
				'label' 		=> __( 'Login Button Text', 'tnews' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'default' 	=> __( 'Login', 'tnews' ),
				'condition'		=> [
					'show_login_btn' => [ 'yes' ],
					'layout_style' => ['1', '2']
				],
			]
		);

		//Menu 
		$this->add_control(
			'show_top_menu',
			[
				'label' 		=> __( 'Show Menu?', 'tnews' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'tnews' ),
				'label_off' 	=> __( 'Hide', 'tnews' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'separator'		=> 'before',
				'condition'		=> [ 
					'layout_style' => ['1']
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'top_menu_text',
			[
				'label' 		=> __( 'Menu Text', 'tnews' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'default' 	=> __( 'Privacy & Policy', 'tnews' ),
			]
		);
		$repeater->add_control(
			'top_menu_link',
			[
				'label' 		=> __( 'Menu Link', 'tnews' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'tnews' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> true,
				],
			]
		);

		$this->add_control(
			'top_menu_lists',
			[
				'label' 		=> __( 'Top Menus', 'tnews' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'social_icon' => __( 'Add Social Icon','tnews' ),
					],
				],
				'condition'		=> [ 
					'show_top_menu'  => 'yes',
					'layout_style' => ['1']
				],
			]
		);	

		//Social 
		$this->add_control(
			'show_social',
			[
				'label' 		=> __( 'Show Social?', 'tnews' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'tnews' ),
				'label_off' 	=> __( 'Hide', 'tnews' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'separator'		=> 'before',
				'condition'		=> [ 
					'layout_style' => ['2', '3', '4']
				],
			]
		);

		$this->add_control(
			'social_text',
			[
				'label' 		=> __( 'Social Text', 'tnews' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'default' 	=> __( 'Follow Us :', 'tnews' ),
				'condition'		=> [ 
					'show_social'  => 'yes',
					'layout_style' => ['4']
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_icon',
			[
				'label' 	=> __( 'Social Icon', 'tnews' ),
				'type' 		=> Controls_Manager::ICONS,
				'default' 	=> [
					'value' 	=> 'fab fa-facebook-f',
					'library' 	=> 'solid',
				],
			]
		);
		$repeater->add_control(
			'icon_link',
			[
				'label' 		=> __( 'Link', 'tnews' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'tnews' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> true,
				],
			]
		);

		$this->add_control(
			'social_icon_list',
			[
				'label' 		=> __( 'Social Icon', 'tnews' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'social_icon' => __( 'Add Social Icon','tnews' ),
					],
				],
				'condition'		=> [ 
					'show_social'  => 'yes',
					'layout_style' => ['2', '3', '4']
				],
			]
		);	

		$this->add_control(
			'ads_image',

			[
				'label' 		=> __( 'Upload Ads Image', 'tnews' ),
				'type' 			=> Controls_Manager::MEDIA,
				'condition'		=> [ 
					'layout_style' => ['2', '3']
				],
			]
		);	
		$this->add_control(
			'ads_url',
			[
				'label' 		=> esc_html__( 'Ads Link', 'tnews' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'tnews' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
				'condition'		=> [
					'layout_style' => ['2', '3']
				],
			]
		);

		$this->add_control(
			'logo_image',
			[
				'label' 		=> __( 'Upload Logo', 'tnews' ),
				'type' 			=> Controls_Manager::MEDIA,
			]
		);		
		$this->add_control(
			'logo_image2',
			[
				'label' 		=> __( 'Upload Logo 2', 'tnews' ),
				'type' 			=> Controls_Manager::MEDIA,
				'condition'		=> [
					'layout_style' => ['2', '3']
				],
			]
		);		

		$this->add_control(
			'show_search_btn',
			[
				'label' 		=> __( 'Show Search Button?', 'tnews' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'tnews' ),
				'label_off' 	=> __( 'Hide', 'tnews' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);		
		$this->add_control(
			'show_cart_btn',
			[
				'label' 		=> __( 'Show Cart Button?', 'tnews' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'tnews' ),
				'label_off' 	=> __( 'Hide', 'tnews' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'separator'		=> 'before',
			]
		);
		$this->add_control(
			'show_offcanvas_btn',
			[
				'label' 		=> __( 'Show Offcanvas Button?', 'tnews' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'tnews' ),
				'label_off' 	=> __( 'Hide', 'tnews' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'		=> [
					'layout_style' => ['1', '3', '4']
				],
			]
		);

		$this->add_control(
			'show_btn',
			[
				'label' 		=> __( 'Show Button?', 'tnews' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'tnews' ),
				'label_off' 	=> __( 'Hide', 'tnews' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'		=> [ 
					'layout_style' => ['4']
				],
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' 		=> __( 'Button Text', 'tnews' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'default' 	=> __( '>Contact Us', 'tnews' ),
				'condition'		=> [
					'show_btn' => [ 'yes' ],
					'layout_style' => ['4']
				],
			]
		);
		$this->add_control(
			'button_link',
			[
				'label' 		=> __( 'Button Link', 'tnews' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'tnews' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
				'condition'		=> [
					'show_btn' => [ 'yes' ],
					'layout_style' => ['4']
				],
			]
		);

        $this->end_controls_section();

		//---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------------------------General Style-----------------------//
		 $this->start_controls_section(
			'general_styling',
			[
				'label'     => __( 'Background Styling', 'tnews' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'header_top_bg',
			[
				'label' 		=> __( 'Topbar Background', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .header-top' => 'background-color: {{VALUE}} !important;',
                ],
			]
        );        
        $this->add_control(
			'header_mid_bg',
			[
				'label' 		=> __( 'Middle Background', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .header-middle' => 'background-color: {{VALUE}} !important;',
                ],
				'condition'		=> [ 
					'layout_style' => ['2']
				],
			]
        );    
        $this->add_control(
			'header_menu_bg',
			[
				'label' 		=> __( 'Menu Background', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .menu-area' => 'background-color: {{VALUE}} !important;',
                ],
			]
        );    

		$this->end_controls_section();

		//-------------------------Menu Bar Style-----------------------//
        $this->start_controls_section(
			'menubar_styling3',
			[
				'label'     => __( 'Menu Styling', 'tnews' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'menu_text_color',
			[
				'label' 			=> __( 'Menu Text Color', 'tnews' ),
				'type' 				=> Controls_Manager::COLOR,
				'selectors' 		=> [
					'{{WRAPPER}} .main-menu>ul>li>a' => 'color: {{VALUE}};',
                ]
			]
        );

        $this->add_control(
			'menu_text_hover_color',
			[
				'label' 			=> __( 'Menu Hover Color', 'tnews' ),
				'type' 				=> Controls_Manager::COLOR,
				'selectors' 		=> [
					'{{WRAPPER}} .main-menu>ul>li>a:hover' => 'color: {{VALUE}};',
                ]
			]
        );

        $this->add_control(
			'dropdown_text_color',
			[
				'label' 			=> __( 'Dropdown Text Color', 'tnews' ),
				'type' 				=> Controls_Manager::COLOR,
				'selectors' 		=> [
					'{{WRAPPER}} .main-menu ul.sub-menu li a' => 'color: {{VALUE}};',
                ]
			]
        );

        $this->add_control(
			'dropdown_text_hover_color',
			[
				'label' 			=> __( 'Dropdown Hover Color', 'tnews' ),
				'type' 				=> Controls_Manager::COLOR,
				'selectors' 		=> [
					'{{WRAPPER}} .main-menu ul.sub-menu li a:hover' => 'color: {{VALUE}};',
                ]
			]
        );

		$this->add_control(
			'dropdown_icon_color',
			[
				'label' 			=> __( 'Dropdown Icon Color', 'tnews' ),
				'type' 				=> Controls_Manager::COLOR,
				'selectors' 		=> [
					'{{WRAPPER}} .main-menu ul.sub-menu li a:before' => 'color: {{VALUE}} !important;',
                ]
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'menu_typography',
				'label' 		=> __( 'Menu Typography', 'tnews' ),
                'selector' 		=> '{{WRAPPER}} .main-menu>ul>li>a, {{WRAPPER}} .main-menu ul.sub-menu li a',
			]
		);

        $this->add_responsive_control(
			'menu_margin',
			[
				'label' 		=> __( 'Menu Margin', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .main-menu>ul>li>a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ]
			]
        );

        $this->add_responsive_control(
			'menu_padding',
			[
				'label' 		=> __( 'Menu Padding', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .main-menu>ul>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ]
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

	protected function render() {

        $settings = $this->get_settings_for_display();

		global $woocommerce;

		$user_id                   = get_current_user_id();
        $user                      = get_user_by('ID', $user_id);

		//Mobile menu, Offcanvas, Search
        echo tnews_mobile_menu();
		echo tnews_header_cart_offcanvas();
		echo tnews_header_offcanvas();
		echo tnews_search_box();

		// Header sub-menu icon
		if( class_exists( 'ReduxFramework' ) ){ 
			if(tnews_opt('tnews_menu_icon')){
				$menu_icon = '';
			}else{
				$menu_icon = 'hide-icon';
			}
		}

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => !empty($settings['blog_post_count']) ? $settings['blog_post_count'] : -1,
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
		);

		if( $settings['selected_category'] != "" ){
            $args['cat'] = $settings['selected_category'];
        }

        $blogpost = new WP_Query( $args );

		if( $settings['layout_style'] == '2' ){
			echo '<div class="th-header header-layout3">';

				echo '<div class="header-top dark-theme">';
					echo '<div class="container">';
						echo '<div class="row align-items-center">';
							if( $settings['show_news_ticker'] == 'yes' ){
								echo '<div class="col-xl-8">';
									echo '<div class="news-area">';
										if(!empty($settings['news_ticker_text'])){
											echo '<div class="title">'.esc_html($settings['news_ticker_text']).'</div>';
										}
										echo '<div class="news-wrap">';
											echo '<div class="row slick-marquee">';
												while( $blogpost->have_posts() ){
													$blogpost->the_post(); 
													echo '<div class="col-auto">';
														echo '<a href="'.esc_url( get_permalink() ).'" class="breaking-news">'.esc_html( get_the_title() ).'</a>';
													echo '</div>';
												} wp_reset_postdata();
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
							echo '<div class="col-xl-4 text-end d-none d-xl-block">';
								echo '<div class="header-links">';
									echo '<ul>';
										if( $settings['show_login_btn'] == 'yes' ){

											if(is_user_logged_in()){ 
												echo '<li>';
													echo '<div class="dropdown-link">';
														echo '<a class="dropdown-toggle" href="'.esc_url('#').'" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">';
															echo '<i class="far fa-user"></i>';
															echo esc_html(' Hello ', 'tnews') . esc_html($user->display_name);
														echo '</a>';
														echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">';
															echo '<li>';
																echo '<a href="'.get_permalink( get_option('woocommerce_myaccount_page_id') ).'">'.esc_html('Dashboard', 'tnews').'</a>';
																echo '<a href="'.esc_url( wp_logout_url() ).'">'.esc_html('Logout', 'tnews').'</a>';
															echo '</li>';
														echo '</ul>';
													echo '</div>';
												echo '</li>';
											}else{
												echo '<li class="d-none d-sm-inline-block"><a href="'.esc_url( home_url( '/my-account' ) ).'">'.wp_kses_post($settings['login_btn_text']).'</a></li>';
											}
										}
										
										echo '<li>';
											if(!empty( $settings['show_social'])){
												echo '<div class="social-links">';
												foreach( $settings['social_icon_list'] as $social_icon ){
													$social_target    = $social_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
													$social_nofollow  = $social_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';
						
													echo '<a '.wp_kses_post( $social_target.$social_nofollow ).' href="'.esc_url( $social_icon['icon_link']['url'] ).'">';
														\Elementor\Icons_Manager::render_icon( $social_icon['social_icon'] );
													echo '</a>';
												}
												echo '</div>';
											}
										echo '</li>';
									echo '</ul>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';

				echo '<div class="header-middle">';
					echo '<div class="container">';
						echo '<div class="row justify-content-center justify-content-lg-between align-items-center gy-2">';
							echo '<div class="col-auto d-none d-lg-inline-block">';
								if( !empty( $settings['logo_image']['url'] ) || !empty( $settings['logo_image2']['url'] ) ){
									echo '<div class="header-logo">';
										echo '<a href="'.esc_url( home_url( '/' ) ).'">';
											echo tnews_img_tag( array(
												'url' => esc_url( $settings['logo_image']['url'] ),
												'class' => 'light-img',
											) );
										echo '</a>';
										if( !empty( $settings['logo_image2']['url'] ) ){
											echo '<a href="'.esc_url( home_url( '/' ) ).'">';
												echo tnews_img_tag( array(
													'url' => esc_url( $settings['logo_image2']['url'] ),
													'class' => 'dark-img',
												) );
											echo '</a>';
										}
									echo '</div>';
								}
							echo '</div>';
							echo '<div class="col text-end d-none d-md-block">';
								if( ! empty( $settings['ads_image']['url'] ) ){
									echo '<div class="header-ad">';
										echo '<a href="'.esc_url( $settings['ads_url']['url'] ).'">';
											echo tnews_img_tag( array(
												'url' => esc_url( $settings['ads_image']['url'] ),
											) );
										echo '</a>';
									echo '</div>';
								}
							echo '</div>';
							echo '<div class="col-auto text-center text-md-end ms-xl-3">';
								if(!empty( $settings['show_color_mode_box'])){
									echo '<div class="header-icon">';
										echo '<div class="theme-switcher">';
											echo '<button>';
												echo '<span class="dark"><i class="fas fa-moon"></i></span>';
												echo '<span class="light"><i class="fa-solid fa-sun-bright"></i></span>';
											echo '</button>';
										echo '</div>';
									echo '</div>';
								}
								if(!empty( $settings['show_date'])){
									echo '<div class="header-links">';
										echo '<ul>';
											echo '<li><i class="fal fa-calendar-days"></i>'.date('l ').date(get_option('date_format')).'</li>';
										echo '</ul>';
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';

				echo '<div class="sticky-wrapper">';
					echo '<!-- Main Menu Area -->';
					echo '<div class="menu-area">';
						echo '<div class="container">';
							echo '<div class="row align-items-center justify-content-between">';
								echo '<div class="col-auto d-lg-none d-block">';
									if( !empty( $settings['logo_image']['url'] ) || !empty( $settings['logo_image2']['url'] ) ){
										echo '<div class="header-logo">';
											echo '<a href="'.esc_url( home_url( '/' ) ).'">';
												echo tnews_img_tag( array(
													'url' => esc_url( $settings['logo_image']['url'] ),
													'class' => 'light-img',
												) );
											echo '</a>';
											if( !empty( $settings['logo_image2']['url'] ) ){
												echo '<a href="'.esc_url( home_url( '/' ) ).'">';
													echo tnews_img_tag( array(
														'url' => esc_url( $settings['logo_image2']['url'] ),
														'class' => 'dark-img',
													) );
												echo '</a>';
											}
										echo '</div>';
									}
								echo '</div>';
								echo '<div class="col-auto">';
									if( has_nav_menu( 'primary-menu' ) ){
										echo '<nav class="main-menu d-none d-lg-inline-block '.esc_attr($menu_icon).'">';
											wp_nav_menu( array(
												"theme_location"    => 'primary-menu',
												"container"         => '',
												"menu_class"        => ''
											) );
										echo '</nav>';
									}
								echo '</div>';
								echo '<div class="col-auto">';
									echo '<div class="header-button">';
										if(!empty( $settings['show_search_btn'])){
											echo '<button type="button" class="simple-icon searchBoxToggler"><i class="far fa-search"></i></button>';
										}
										if(!empty( $settings['show_cart_btn'])){
											if( ! empty( $woocommerce->cart->cart_contents_count ) ){
												$count = $woocommerce->cart->cart_contents_count;
											}else{
												$count = "0";
											}
											echo '<button type="button" class="simple-icon d-none d-lg-block cartToggler">';
												echo '<i class="far fa-cart-shopping"></i><span class="badge">'.esc_html( $count ).'</span>';
											echo '</button>';
										}
										echo '<button type="button" class="th-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i></button>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';

			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			if(!empty( $settings['show_color_mode_box'])){
				echo '<div class="switcher-fixed">';
					echo '<div class="theme-switcher">';
						echo '<button>';
							echo '<span class="dark"><i class="fas fa-moon"></i></span>';
							echo '<span class="light"><i class="fa-solid fa-sun-bright"></i></span>';
						echo '</button>';
					echo '</div>';
				echo '</div>';
			}

			echo '<div class="th-header header-layout4">';

				echo '<div class="header-middle">';
					echo '<div class="container">';
						echo '<div class="row justify-content-center justify-content-lg-between align-items-center gy-2">';
							echo '<div class="col-auto d-none d-lg-inline-block">';
								if( !empty( $settings['logo_image']['url'] ) || !empty( $settings['logo_image2']['url'] ) ){
									echo '<div class="header-logo">';
										echo '<a href="'.esc_url( home_url( '/' ) ).'">';
											echo tnews_img_tag( array(
												'url' => esc_url( $settings['logo_image']['url'] ),
												'class' => 'light-img',
											) );
										echo '</a>';
										if( !empty( $settings['logo_image2']['url'] ) ){
											echo '<a href="'.esc_url( home_url( '/' ) ).'">';
												echo tnews_img_tag( array(
													'url' => esc_url( $settings['logo_image2']['url'] ),
													'class' => 'dark-img',
												) );
											echo '</a>';
										}
									echo '</div>';
								}
							echo '</div>';
							echo '<div class="col text-center d-none d-md-block">';
								if( ! empty( $settings['ads_image']['url'] ) ){
									echo '<div class="header-ad">';
										echo '<a href="'.esc_url( $settings['ads_url']['url'] ).'">';
											echo tnews_img_tag( array(
												'url' => esc_url( $settings['ads_image']['url'] ),
											) );
										echo '</a>';
									echo '</div>';
								}
							echo '</div>';
							echo '<div class="col-auto">';
								if(!empty( $settings['show_social'])){
									echo '<div class="th-social style-black">';
									foreach( $settings['social_icon_list'] as $social_icon ){
										$social_target    = $social_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
										$social_nofollow  = $social_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';
			
										echo '<a '.wp_kses_post( $social_target.$social_nofollow ).' href="'.esc_url( $social_icon['icon_link']['url'] ).'">';
											\Elementor\Icons_Manager::render_icon( $social_icon['social_icon'] );
										echo '</a>';
									}
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';

				echo '<div class="sticky-wrapper">';
					echo '<!-- Main Menu Area -->';
					echo '<div class="menu-area">';
						echo '<div class="container">';
							echo '<div class="row align-items-center justify-content-between">';
								echo '<div class="col-auto d-lg-none d-block">';
									if( !empty( $settings['logo_image2']['url'] ) ){
										echo '<div class="header-logo">';
											echo '<a href="'.esc_url( home_url( '/' ) ).'">';
												echo tnews_img_tag( array(
													'url' => esc_url( $settings['logo_image2']['url'] ),
												) );
											echo '</a>';
										echo '</div>';
									}
								echo '</div>';
								if(!empty( $settings['show_offcanvas_btn'])){
									echo '<div class="col-auto d-none d-lg-block">';
										echo '<div class="header-button">';
											echo '<a href="#" class="simple-icon sideMenuToggler d-none d-lg-block"><i class="far fa-bars"></i></a>';
										echo '</div>';
									echo '</div>';
								}
								echo '<div class="col-auto">';
									if( has_nav_menu( 'primary-menu' ) ){
										echo '<nav class="main-menu d-none d-lg-inline-block '.esc_attr($menu_icon).'">';
											wp_nav_menu( array(
												"theme_location"    => 'primary-menu',
												"container"         => '',
												"menu_class"        => ''
											) );
										echo '</nav>';
									}
								echo '</div>';
								echo '<div class="col-auto">';
									echo '<div class="header-button">';
										if(!empty( $settings['show_search_btn'])){
											echo '<button type="button" class="simple-icon searchBoxToggler"><i class="far fa-search"></i></button>';
										}
										if(!empty( $settings['show_cart_btn'])){
											if( ! empty( $woocommerce->cart->cart_contents_count ) ){
												$count = $woocommerce->cart->cart_contents_count;
											}else{
												$count = "0";
											}
											echo '<button type="button" class="simple-icon d-none d-lg-block cartToggler">';
												echo '<i class="far fa-cart-shopping"></i><span class="badge">'.esc_html( $count ).'</span>';
											echo '</button>';
										}
										echo '<button type="button" class="th-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i></button>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';

			echo '</div>';
 
		}elseif( $settings['layout_style'] == '4' ){
			if(!empty( $settings['show_color_mode_box'])){
				echo '<div class="switcher-fixed">';
					echo '<div class="theme-switcher">';
						echo '<button>';
							echo '<span class="dark"><i class="fas fa-moon"></i></span>';
							echo '<span class="light"><i class="fa-solid fa-sun-bright"></i></span>';
						echo '</button>';
					echo '</div>';
				echo '</div>';
			}
			
			echo '<div class="th-header header-layout5 dark-theme">';
				echo '<div class="sticky-wrapper">';
					echo '<div class="container">';
						echo '<div class="row gx-0">';
							echo '<div class="col-lg-2 d-none d-lg-inline-block">';
								if( ! empty( $settings['logo_image']['url'] ) ){
									echo '<div class="header-logo">';
										echo '<a href="'.esc_url( home_url( '/' ) ).'">';
											echo tnews_img_tag( array(
												'url' => esc_url( $settings['logo_image']['url'] ),
											) );
										echo '</a>';
									echo '</div>';
								}
							echo '</div>';
							echo '<div class="col-lg-10">';
								echo '<div class="header-top">';
									echo '<div class="row align-items-center">';
										if( $settings['show_news_ticker'] == 'yes' ){
											echo '<div class="col-xl-9">';
												echo '<div class="news-area">';
													if(!empty($settings['news_ticker_text'])){
														echo '<div class="title">'.esc_html($settings['news_ticker_text']).'</div>';
													}
													echo '<div class="news-wrap">';
														echo '<div class="row slick-marquee">';
															while( $blogpost->have_posts() ){
																$blogpost->the_post(); 
																echo '<div class="col-auto">';
																	echo '<a href="'.esc_url( get_permalink() ).'" class="breaking-news">'.esc_html( get_the_title() ).'</a>';
																echo '</div>';
															} wp_reset_postdata();
														echo '</div>';
													echo '</div>';
												echo '</div>';
											echo '</div>';
										}
										
										echo '<div class="col-xl-3 text-end d-none d-xl-block">';
											if(!empty( $settings['show_social'])){
												echo '<div class="social-links">';
												if(!empty($settings['social_text'])){
													echo '<span class="social-title">'.esc_html($settings['social_text']).'</span>';
												}
												foreach( $settings['social_icon_list'] as $social_icon ){
													$social_target    = $social_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
													$social_nofollow  = $social_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';
						
													echo '<a '.wp_kses_post( $social_target.$social_nofollow ).' href="'.esc_url( $social_icon['icon_link']['url'] ).'">';
														\Elementor\Icons_Manager::render_icon( $social_icon['social_icon'] );
													echo '</a>';
												}
												echo '</div>';
											}										
										echo '</div>';
									echo '</div>';
								echo '</div>';

								echo '<!-- Main Menu Area -->';
								echo '<div class="menu-area">';
									echo '<div class="row align-items-center justify-content-between">';
										if(!empty( $settings['show_offcanvas_btn'])){
											echo '<div class="col-auto d-none d-xl-block">';
												echo '<div class="toggle-icon">';
													echo '<a href="#" class="simple-icon sideMenuToggler"><i class="far fa-bars"></i></a>';
												echo '</div>';
											echo '</div>';
										}
										echo '<div class="col-auto d-lg-none d-block">';
											if( ! empty( $settings['logo_image']['url'] ) ){
												echo '<div class="header-logo">';
													echo '<a href="'.esc_url( home_url( '/' ) ).'">';
														echo tnews_img_tag( array(
															'url' => esc_url( $settings['logo_image']['url'] ),
														) );
													echo '</a>';
												echo '</div>';
											}
										echo '</div>';
										echo '<div class="col-auto">';
											if( has_nav_menu( 'primary-menu' ) ){
												echo '<nav class="main-menu d-none d-lg-inline-block '.esc_attr($menu_icon).'">';
													wp_nav_menu( array(
														"theme_location"    => 'primary-menu',
														"container"         => '',
														"menu_class"        => ''
													) );
												echo '</nav>';
											}
										echo '</div>';
										echo '<div class="col-auto">';
											echo '<div class="header-button">';
												if(!empty( $settings['show_search_btn'])){
													echo '<button type="button" class="simple-icon searchBoxToggler"><i class="far fa-search"></i></button>';
												}
												if(!empty( $settings['show_cart_btn'])){
													if( ! empty( $woocommerce->cart->cart_contents_count ) ){
														$count = $woocommerce->cart->cart_contents_count;
													}else{
														$count = "0";
													}
													echo '<button type="button" class="simple-icon d-none d-lg-block cartToggler">';
														echo '<i class="far fa-cart-shopping"></i><span class="badge">'.esc_html( $count ).'</span>';
													echo '</button>';
												}
												if(!empty($settings['button_text'])){
													echo '<a href="'.esc_url( $settings['button_link']['url'] ).'" class="th-btn style3">'.esc_html( $settings['button_text'] ).'</a>';
												}
												echo '<button type="button" class="th-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i></button>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}else{
			echo '<div class="th-header header-layout2 dark-theme">';

				echo '<div class="header-top">';
					echo '<div class="container">';
						echo '<div class="row justify-content-center justify-content-md-between align-items-center gy-2">';
							echo '<div class="col-auto d-none d-md-inline-block">';
								echo '<div class="header-icon">';
									if(!empty( $settings['show_offcanvas_btn'])){
										echo '<a href="#" class="simple-icon sideMenuToggler"><i class="far fa-bars"></i></a>';
									}
									if( $settings['show_login_btn'] == 'yes' ){

										if(is_user_logged_in()){ 
											echo '<div>';
												echo '<div class="dropdown-link">';
													echo '<a class="dropdown-toggle" href="'.esc_url('#').'" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">';
														echo '<i class="far fa-user"></i>';
														echo esc_html(' Hello ', 'tnews') . esc_html($user->display_name);
													echo '</a>';
													echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">';
														echo '<li>';
															echo '<a href="'.get_permalink( get_option('woocommerce_myaccount_page_id') ).'">'.esc_html('Dashboard', 'tnews').'</a>';
															echo '<a href="'.esc_url( wp_logout_url() ).'">'.esc_html('Logout', 'tnews').'</a>';
														echo '</li>';
													echo '</ul>';
												echo '</div>';
											echo '</div>';
										}else{
											echo '<a class="simple-icon" href="'.esc_url( home_url( '/my-account' ) ).'">'.wp_kses_post($settings['login_btn_text']).'</a>';
										}
									}
								echo '</div>';
								if(!empty( $settings['show_date'])){
									echo '<div class="header-links">';
										echo '<ul>';
											echo '<li><i class="fal fa-calendar-days"></i>'.date('l ').date(get_option('date_format')).'</li>';
										echo '</ul>';
									echo '</div>';
								}
							echo '</div>';
							echo '<div class="col-auto d-none d-lg-inline-block">';
								if( ! empty( $settings['logo_image']['url'] ) ){
									echo '<div class="header-logo">';
										echo '<a href="'.esc_url( home_url( '/' ) ).'">';
											echo tnews_img_tag( array(
												'url' => esc_url( $settings['logo_image']['url'] ),
											) );
										echo '</a>';
									echo '</div>';
								}
							echo '</div>';
							echo '<div class="col-auto text-center text-md-end">';
								if(!empty( $settings['show_color_mode_box'])){
									echo '<div class="header-icon">';
										echo '<div class="theme-switcher">';
											echo '<button>';
												echo '<span class="dark"><i class="fas fa-moon"></i></span>';
												echo '<span class="light"><i class="fa-solid fa-sun-bright"></i></span>';
											echo '</button>';
										echo '</div>';
									echo '</div>';
								}
								if(!empty( $settings['show_top_menu'])){
									echo '<div class="header-links">';
										echo '<ul>';
											foreach($settings['top_menu_lists'] as $data){
												echo '<li><a href="'.esc_url($data['top_menu_link']['url']).'">'.esc_html($data['top_menu_text']).'</a></li>';
											}
										echo '</ul>';
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';

				echo '<div class="sticky-wrapper">';
					echo '<!-- Main Menu Area -->';
					echo '<div class="menu-area">';
						echo '<div class="container">';
							echo '<div class="row align-items-center justify-content-between">';
								echo '<div class="col-auto d-lg-none d-block">';
									if( ! empty( $settings['logo_image']['url'] ) ){
										echo '<div class="header-logo">';
											echo '<a href="'.esc_url( home_url( '/' ) ).'">';
												echo tnews_img_tag( array(
													'url' => esc_url( $settings['logo_image']['url'] ),
												) );
											echo '</a>';
										echo '</div>';
									}
								echo '</div>';
								echo '<div class="col-auto">';
									if( has_nav_menu( 'primary-menu' ) ){
										echo '<nav class="main-menu d-none d-lg-inline-block '.esc_attr($menu_icon).'">';
											wp_nav_menu( array(
												"theme_location"    => 'primary-menu',
												"container"         => '',
												"menu_class"        => ''
											) );
										echo '</nav>';
									}
								echo '</div>';
								echo '<div class="col-auto">';
									echo '<div class="header-button">';
										if(!empty( $settings['show_search_btn'])){
											echo '<button type="button" class="simple-icon searchBoxToggler"><i class="far fa-search"></i></button>';
										}
										if(!empty( $settings['show_cart_btn'])){
											if( ! empty( $woocommerce->cart->cart_contents_count ) ){
												$count = $woocommerce->cart->cart_contents_count;
											}else{
												$count = "0";
											}
											echo '<button type="button" class="simple-icon d-none d-lg-block cartToggler">';
												echo '<i class="far fa-cart-shopping"></i><span class="badge">'.esc_html( $count ).'</span>';
											echo '</button>';
										}
										echo '<button type="button" class="th-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i></button>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';

			echo '</div>';
		}


	}
}