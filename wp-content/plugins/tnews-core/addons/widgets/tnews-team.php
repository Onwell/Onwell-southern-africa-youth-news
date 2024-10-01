<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
/**
 *
 * Team Widget .
 *
 */
class Tnews_Team extends Widget_Base {

	public function get_name() {
		return 'tnewsteam';
	}
	public function get_title() {
		return __( 'Team', 'tnews' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'tnews' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'team_section',
			[
				'label'     => __( 'Team Content', 'tnews' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
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
					// '2'  		=> __( 'Style Two', 'tnews' ),
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'name', [
				'label' 		=> __( 'Name', 'tnews' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Lilar Dikeoa' , 'tnews' ),
				'rows' 			=> 2,
				'label_block' 	=> true,
			]
        );

        $repeater->add_control(
			'profile_link',
			[
				'label' 		=> esc_html__( 'Profile Link', 'tnews' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'tnews' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);

		$repeater->add_control(
			'designation', [
				'label' 		=> __( 'Designation', 'tnews' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Customer' , 'tnews' ),
				'label_block' 	=> true,
			]
        );		
     
        $repeater->add_control(
			'team_image',
			[
				'label' 		=> esc_html__( 'Member Image', 'tnews' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
        );

       $repeater->add_control(
			'fb_link',
			[
				'label' 		=> esc_html__( 'Facebook Link', 'tnews' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'tnews' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);

		$repeater->add_control(
			'twitter_link',
			[
				'label' 		=> esc_html__( 'Twitter Link', 'tnews' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'tnews' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);

		$repeater->add_control(
			'instagram_link',
			[
				'label' 		=> esc_html__( 'Instagram Link', 'tnews' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'tnews' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);

		$repeater->add_control(
			'linkedin_link',
			[
				'label' 		=> esc_html__( 'Linkedin Link', 'tnews' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'tnews' ),
				'show_external' => true,
			]
		);

		$this->add_control(
			'team_lists',
			[
				'label' 		=> __( 'Member Lists', 'tnews' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'name' 		=> __( 'Mishel D. Marsh', 'tnews' ),
					],
					[
						'name' 		=> __( 'Famhida Ruko Jon', 'tnews' ),
					],
				],
				'title_field' 	=> '{{{ name }}}',
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------------------------Content Style-----------------------//
		$this->start_controls_section(
			'tab_styling',
			[
				'label' 	=> __( 'Content Styling', 'tnews' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'style_tabs'
		);

			$this->start_controls_tab(
				'first_style_tab',
				[
					'label' => esc_html__( 'Name', 'tnews' ),
				]
			);

			$this->add_control(
				'first_tab_color',
				[
					'label' 		=> __( 'Color', 'tnews' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .th-title'	=> 'color: {{VALUE}}!important;',
					],
				]
			);
			$this->add_group_control(
			Group_Control_Typography::get_type(),
					[
					'name' 			=> 'first_tab_typography',
						'label' 		=> __( 'Typography', 'tnews' ),
						'selector' 	=> '{{WRAPPER}} .th-title',
				]
			);
			$this->add_responsive_control(
				'first_tab_margin',
				[
					'label' 		=> __( 'Margin', 'tnews' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em' ],
					'selectors' 	=> [
						'{{WRAPPER}} .th-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'first_tab_padding',
				[
					'label' 		=> __( 'Padding', 'tnews' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em' ],
					'selectors' 	=> [
						'{{WRAPPER}} .th-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_tab();

			//--------------------secound--------------------//
			$this->start_controls_tab(
				'sec_style_tab',
				[
					'label' => esc_html__( 'Designation', 'tnews' ),
				]
			);

			$this->add_control(
				'sec_tab_color',
				[
					'label' 		=> __( 'Color', 'tnews' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .th-desc'	=> 'color: {{VALUE}}!important;',
					],
				]
			);
			$this->add_group_control(
			Group_Control_Typography::get_type(),
					[
					'name' 			=> 'sec_tab_typography',
						'label' 		=> __( 'Typography', 'tnews' ),
						'selector' 	=> '{{WRAPPER}} .th-desc',
				]
			);
			$this->add_responsive_control(
				'sec_tab_margin',
				[
					'label' 		=> __( 'Margin', 'tnews' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em' ],
					'selectors' 	=> [
						'{{WRAPPER}} .th-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'sec_tab_padding',
				[
					'label' 		=> __( 'Padding', 'tnews' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em' ],
					'selectors' 	=> [
						'{{WRAPPER}} .th-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_tab();

			//--------------------threth--------------------//
			$this->start_controls_tab(
				'third_style_tab',
				[
					'label' => esc_html__( 'Social', 'tnews' ),
				]
			);

			$this->add_control(
				'third_tab_color',
				[
					'label' 		=> __( 'Color', 'tnews' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .th-social a'	=> 'color: {{VALUE}}!important;',
					],
				]
			);
			$this->add_control(
				'third_tab_color2',
				[
					'label' 		=> __( 'Hover Color', 'tnews' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .th-social a:hover'	=> 'color: {{VALUE}}!important;',
					],
				]
			);
			$this->add_control(
				'third_tab_bg',
				[
					'label' 		=> __( 'Background', 'tnews' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .th-social a'	=> 'background-color: {{VALUE}}!important;',
					],
				]
			);
			$this->add_control(
				'third_tab_bg2',
				[
					'label' 		=> __( 'Hover Background', 'tnews' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .th-social a:hover'	=> 'background-color: {{VALUE}}!important;',
					],
				]
			);
			$this->add_group_control(
			Group_Control_Typography::get_type(),
					[
					'name' 			=> 'third_tab_typography',
						'label' 		=> __( 'Typography', 'tnews' ),
						'selector' 	=> '{{WRAPPER}} .th-social a',
				]
			);
			$this->add_responsive_control(
				'third_tab_margin',
				[
					'label' 		=> __( 'Margin', 'tnews' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em' ],
					'selectors' 	=> [
						'{{WRAPPER}} .th-social a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '2' ){

        }else{
            echo '<div class="row gy-30">';
                foreach( $settings['team_lists'] as $data ){
                    $target = $data['profile_link']['is_external'] ? ' target="_blank"' : '';
                    $nofollow = $data['profile_link']['nofollow'] ? ' rel="nofollow"' : '';

                    $f_target = $data['fb_link']['is_external'] ? ' target="_blank"' : '';
                    $f_nofollow = $data['fb_link']['nofollow'] ? ' rel="nofollow"' : '';

                    $t_target = $data['twitter_link']['is_external'] ? ' target="_blank"' : '';
                    $t_nofollow = $data['twitter_link']['nofollow'] ? ' rel="nofollow"' : '';

                    $i_target = $data['instagram_link']['is_external'] ? ' target="_blank"' : '';
                    $i_nofollow = $data['instagram_link']['nofollow'] ? ' rel="nofollow"' : '';

                    $l_target = $data['linkedin_link']['is_external'] ? ' target="_blank"' : '';
                    $l_nofollow = $data['linkedin_link']['nofollow'] ? ' rel="nofollow"' : '';

                    echo '<div class="col-sm-6 col-lg-4 col-xl-3">';
                        echo '<div class="team-card">';
                            echo '<div class="box-img">';
                                echo tnews_img_tag( array(
                                    'url'   => esc_url( $data['team_image']['url']  ),
                                ));
                                echo '<div class="th-social">';
                                    if( ! empty( $data['fb_link']['url']) ){
                                        echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['fb_link']['url'] ).'"><i class="fab fa-facebook-f"></i></a>';
                                    }
                                    if( ! empty( $data['twitter_link']['url']) ){
                                        echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_link']['url'] ).'"><i class="fab fa-twitter"></i></a>';
                                    }
                                    if( ! empty( $data['instagram_link']['url']) ){
                                        echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_link']['url'] ).'"><i class="fab fa-instagram"></i></a>';
                                    }
                                    if( ! empty( $data['linkedin_link']['url']) ){
                                        echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_link']['url'] ).'"><i class="fab fa-linkedin-in"></i></a>';
                                    }
                                echo '</div>';
                            echo '</div>';
                            if( ! empty( $data['name'] ) ){
                                echo '<h3 class="box-title th-title"><a '.wp_kses_post( $nofollow.$target ).' href="'.esc_url( $data['profile_link']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
                            }
                            if( ! empty( $data['designation'] ) ){
							    echo '<span class="box-text th-desc">'.esc_html($data['designation']).'</span>';
                            }

                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';
        }

			
	}
}