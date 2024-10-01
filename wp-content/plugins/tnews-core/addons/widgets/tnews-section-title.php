<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
/**
 *
 * Section Title Widget .
 *
 */
class Tnews_Section_Title extends Widget_Base {

	public function get_name() {
		return 'tnewssectiontitle';
	}
	public function get_title() {
		return __( 'Section Title', 'tnews' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'tnews' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_title_section',
			[
				'label'		 	=> __( 'Section Title', 'tnews' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

		$this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Layout Style', 'tnews' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'tnews' ),
					'2'  		=> __( 'Style Two', 'tnews' ),
				],
			]
		); 

        $this->add_control(
			'section_subtitle',
			[
				'label' 	=> __( 'Section Subtitle', 'tnews' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Section Subtitle', 'tnews' ),
                'rows' => '2',
				'condition'	=> [ 
					'layout_style' => ['2']
				]
			]
        );
		$this->add_control(
			'section_subtitle_tag',
			[
				'label' 	=> __( 'Subitle Tag', 'edura' ),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'p'  => 'P',
					'span'  => 'span',
				],
				'default' 	=> 'span',
				'condition'	=> [ 
					'layout_style' => ['2'],
					'section_subtitle!' => ''
				]
			]
		);
		$this->add_control(
			'section_title',
			[
				'label' 	=> __( 'Section Title', 'tnews' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Section Title', 'tnews' )
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
				'condition'	=> [ 
					'section_title!' => ''
				]
			]
        );
        $this->add_control(
			'section_desc',
			[
				'label' 	=> __( 'Section Description', 'tnews' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( '', 'tnews' ),
				'condition'	=> [ 
					'layout_style' => ['2']
				]
			]
        );
        $this->add_responsive_control(
			'section_align',
			[
				'label' 		=> __( 'Alignment', 'tnews' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' 	=> [
						'title' 		=> __( 'Left', 'tnews' ),
						'icon' 			=> 'eicon-text-align-left',
					],
					'center' 	=> [
						'title' 		=> __( 'Center', 'tnews' ),
						'icon' 			=> 'eicon-text-align-center',
					],
					'right' 	=> [
						'title' 		=> __( 'Right', 'tnews' ),
						'icon' 			=> 'eicon-text-align-right',
					],
				],
				'default' 	=> 'left',
				'toggle' 	=> true,
				'selectors' 	=> [
					'{{WRAPPER}} .title-area' => 'text-align: {{VALUE}};',
                ],
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

		 $this->add_responsive_control(
			'general_margin',
			[
				'label' 		=> __( 'Margin', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .title-area, {{WRAPPER}} .th-title-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

		$this->end_controls_section();

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
					'label' => esc_html__( 'Sub Title', 'tnews' ),
				]
			);

			$this->add_control(
				'first_tab_color',
				[
					'label' 		=> __( 'Color', 'tnews' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .th-sub'	=> '--theme-color: {{VALUE}}!important;',
					],
				]
			);

			$this->add_group_control(
			Group_Control_Typography::get_type(),
					[
					'name' 			=> 'first_tab_typography',
						'label' 		=> __( 'Typography', 'tnews' ),
						'selector' 	=> '{{WRAPPER}} .th-sub',
				]
			);

			$this->add_responsive_control(
				'first_tab_margin',
				[
					'label' 		=> __( 'Margin', 'tnews' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em' ],
					'selectors' 	=> [
						'{{WRAPPER}} .th-sub' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .th-sub' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_tab();

			//--------------------secound--------------------//
			$this->start_controls_tab(
				'sec_style_tab',
				[
					'label' => esc_html__( 'Title', 'tnews' ),
				]
			);

			$this->add_control(
				'sec_tab_color',
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
					'name' 			=> 'sec_tab_typography',
						'label' 		=> __( 'Typography', 'tnews' ),
						'selector' 	=> '{{WRAPPER}} .th-title',
				]
			);

			$this->add_responsive_control(
				'sec_tab_margin',
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
				'sec_tab_padding',
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

			//--------------------threth--------------------//
			$this->start_controls_tab(
				'third_style_tab',
				[
					'label' => esc_html__( 'Description', 'tnews' ),
				]
			);

			$this->add_control(
				'third_tab_color',
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
					'name' 			=> 'third_tab_typography',
						'label' 		=> __( 'Typography', 'tnews' ),
						'selector' 	=> '{{WRAPPER}} .th-desc',
				]
			);

			$this->add_responsive_control(
				'third_tab_margin',
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
				'third_tab_padding',
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

		$this->end_controls_tabs();
		$this->end_controls_section();

	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		$this->add_render_attribute('title_args', 'class', 'sec-title th-title');
		$this->add_render_attribute('subtitle_args', 'class', 'sub-title th-sub');

		if( $settings['layout_style'] == '2' ){
			echo '<div class="title-area">';
				if( ! empty( $settings['section_subtitle'] ) ) {
					echo '<'.esc_attr($settings['section_subtitle_tag']).' class="sub-title th-sub">';
					echo wp_kses_post( $settings['section_subtitle'] ).'</'.esc_attr($settings['section_subtitle_tag']).'>';
				}
				if( !empty( $settings['section_title'] ) ) {
					
					echo '<'.esc_attr($settings['section_title_tag']).' class="sec-title2 th-title">'.wp_kses_post( $settings['section_title'] ).'</'.esc_attr($settings['section_title_tag']).'>';
				}
				if( ! empty( $settings['section_desc'] ) ){
					echo tnews_paragraph_tag( array(
						'text'	=> wp_kses_post( $settings['section_desc'] ),
						'class'	=> 'sec-text th-desc'
					) );
				}		
			echo '</div>';

		}else{
			if( !empty( $settings['section_title'] ) ) {
				echo '<'.esc_attr($settings['section_title_tag']).' class="sec-title has-line th-title text-'.$settings['section_align'].'">'.wp_kses_post( $settings['section_title'] ).'</'.esc_attr($settings['section_title_tag']).'>';
			}
		}

		
	}
}