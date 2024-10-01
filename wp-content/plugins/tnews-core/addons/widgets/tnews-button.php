<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * Button Widget 
 *
 */
class tnews_Button extends Widget_Base {

	public function get_name() {
		return 'tnewsbutton';
	}
	public function get_title() {
		return __( 'Button', 'tnews' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'tnews' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'button_section',
			[
				'label' 	=> __( 'Button', 'tnews' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'layout_style',
			[
				'label' 	=> __( 'Button Style', 'tnews' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  		=> __( 'Style One', 'tnews' ),
					// '2' 		=> __( 'Style Two', 'tnews' ),
				],
			]
		);

        $this->add_control(
			'button_text',
			[
				'label' 	=> __( 'Button Text', 'tnews' ),
                'type' 		=> Controls_Manager::TEXT,
                'label_block' => true,
                'default'  	=> __( 'Button Text', 'tnews' )
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
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label' 	=> __( 'Button Icon Class', 'tnews' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2
			]
        );

		$this->add_control(
			'button_icon_position',
			[
				'label' 	=> __( 'Button Icon Position', 'tnews' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '2',
				'options' 	=> [
					'1'  		=> __( 'Before Text', 'tnews' ),
					'2' 		=> __( 'After Text', 'tnews' ),
				],
			]
		);

		$this->add_control(
			'button_space',
			[
				'label' => esc_html__( 'Button Icon Spacing (PX)', 'tnews' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .th_btn i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition'	=> [
					'button_icon_position' => ['1']
				]	
			]
		);

		$this->add_control(
			'button_space2',
			[
				'label' => esc_html__( 'Button Icon Spacing (PX)', 'tnews' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .th_btn i' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition'	=> [
					'button_icon_position' => ['2']
				]	
			]
		);

        $this->add_responsive_control(
			'button_align',
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
				'default' 		=> 'left',
				'toggle' 		=> true,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper' => 'text-align: {{VALUE}}',
                ],
			]
        );

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------------------------Button Style-----------------------//
		$this->start_controls_section(
			'button_style_section',
			[
				'label' 	=> __( 'Button Style', 'tnews' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography',
				'label' 	=> __( 'Typography', 'tnews' ),
				'selector' 	=> '{{WRAPPER}} .th_btn',
			]
		);

		$this->start_controls_tabs(
			'style_tabs'
		);

			$this->start_controls_tab(
				'first_style_tab',
				[
					'label' => esc_html__( 'Normal', 'tnews' ),
				]
			);

			$this->add_control(
				'button_color',
				[
					'label' 		=> __( 'Color', 'tnews' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .th_btn' => 'color: {{VALUE}}',
					],
				]
			);
	
			$this->add_control(
				'button_bg',
				[
					'label' 		=> __( 'Background Color', 'tnews' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .th_btn' => 'background-color:{{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'border',
					'selector' => '{{WRAPPER}} .th_btn',
				]
			);

			$this->end_controls_tab();

			//--------------------secound--------------------//
			$this->start_controls_tab(
				'sec_style_tab',
				[
					'label' => esc_html__( 'Hover', 'tnews' ),
				]
			);

			$this->add_control(
				'button_h_color',
				[
					'label' 		=> __( 'Hover Color ', 'tnews' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .th_btn:hover' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'button_h_bg',
				[
					'label' 		=> __( 'Background Hover Color', 'tnews' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .th_btn:before, {{WRAPPER}} .th_btn:after' => 'background-color:{{VALUE}} !important',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'border2',
					'selector' => '{{WRAPPER}} .th_btn:hover',
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label' 		=> __( 'Margin', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> __( 'Padding', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		
		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '2' ){
			$this->add_render_attribute( 'wrapper', 'class', 'btn-wrapper');
		    $this->add_render_attribute( 'button', 'class', 'view-btn th_btn' );
		}else{
			$this->add_render_attribute( 'wrapper', 'class', 'btn-wrapper');
			$this->add_render_attribute( 'button', 'class', 'th-btn th_btn' );
		}

        if( ! empty( $settings['button_link']['url'] ) ) {
            $this->add_render_attribute( 'button', 'href', esc_url( $settings['button_link']['url'] ) );
        }
        if( ! empty( $settings['button_link']['nofollow'] ) ) {
            $this->add_render_attribute( 'button', 'rel', 'nofollow' );
        }
        if( ! empty( $settings['button_link']['is_external'] ) ) {
            $this->add_render_attribute( 'button', 'target', '_blank' );
        }

		echo '<div '.$this->get_render_attribute_string('wrapper').'>';
        	
			if( ! empty( $settings['button_text'] ) ) {
				echo '<a '.$this->get_render_attribute_string('button').'>';
				if( ! empty( $settings['button_icon'] ) && $settings['button_icon_position'] == '1'  ){
					echo wp_kses_post($settings['button_icon']);
				}
				echo esc_html( $settings['button_text'] );
				if( ! empty( $settings['button_icon'] ) && $settings['button_icon_position'] == '2'  ){
					echo wp_kses_post($settings['button_icon']);
				}
				echo '</a>';
			}

		echo '</div>';

	}

}