<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Counter Up Widget .
 *
 */
class Tnews_Counterup extends Widget_Base {

	public function get_name() {
		return 'tnewscounterup';
	}

	public function get_title() {
		return __( 'Counter Up', 'tnews' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'tnews' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'counter_section',
			[
				'label' 	=> __( 'Counterup', 'tnews' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        ); 
        $this->add_control(
			'layout',
			[
				'label' 		=> __( 'Style', 'tnews' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options'		=> [
					'1'  			=> __( 'Style One', 'tnews' ),
				],
			]
		);    
		$repeater = new Repeater();

		$repeater->add_control(
			'counter_number',
			[
				'label'     => __( 'Counter Number', 'tnews' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
				'default' 	=> __( '25', 'tnews' ),
			]
		);
		$repeater->add_control(
			'counter_suffix',
			[
				'label'     => __( 'Counter Suffix', 'tnews' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
				'default' 	=> __( 'k+', 'tnews' ),
			]
		);
		$repeater->add_control(
			'counter_text',
			[
				'label'     => __( 'Counter Text', 'tnews' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
				'default' 	=> __( 'Years Of Experience', 'tnews' ),
			]
		);
		$this->add_control(
			'counter',
			[
				'label' 		=> __( 'Counter', 'tnews' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'counter_text' 		=> __( 'Counter One', 'tnews' ),
					],
				],
				'title_field' 	=> '{{{ counter_text }}}',
			]
		);
		
		$this->end_controls_section();

		//-------------------------General Style-----------------------//
		$this->start_controls_section(
			'style',
			[
				'label' => __( 'Style', 'tnews' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'general_bg',
			[
				'label' 		=> __( 'Background Color', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .th-bg' => 'background: {{VALUE}}!important',
				],
			]
		);

		$this->add_responsive_control(
			'general_padding',
			[
				'label' 		=> __( 'Padding', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th-bg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();

        /*-----------------------------------------Feedback styling------------------------------------*/

		$this->start_controls_section(
			'overview_con_styling',
			[
				'label' 	=> __( 'Content Styling', 'tnews' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->start_controls_tabs(
			'style_tabs2'
		);


		$this->start_controls_tab(
			'style_normal_tab2',
			[
				'label' => esc_html__( 'Number', 'tnews' ),
			]
		);
        $this->add_control(
			'overview_title_color',
			[
				'label' 		=> __( 'Color', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .counter-card_number'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_title_typography',
		 		'label' 		=> __( 'Typography', 'tnews' ),
		 		'selector' 	=> '{{WRAPPER}} .counter-card_number',
			]
		);

        $this->add_responsive_control(
			'overview_title_margin',
			[
				'label' 		=> __( 'Margin', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .counter-card_number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'overview_title_padding',
			[
				'label' 		=> __( 'Padding', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .counter-card_number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
		$this->end_controls_tab();

		//--------------------secound--------------------//

		$this->start_controls_tab(
			'style_hover_tab2',
			[
				'label' => esc_html__( 'Ttitle', 'tnews' ),
			]
		);
		$this->add_control(
			'overview_content_color',
			[
				'label' 		=> __( 'Color', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .counter-card_text'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_content_typography',
		 		'label' 		=> __( 'Typography', 'tnews' ),
		 		'selector' 	=> '{{WRAPPER}} .counter-card_text',
			]
		);

        $this->add_responsive_control(
			'overview_content_margin',
			[
				'label' 		=> __( 'Margin', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .counter-card_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'overview_content_padding',
			[
				'label' 		=> __( 'Padding', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .counter-card_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout'] == '2' ){


		}else{
        	echo '<div class="counter-card-wrap th-bg">';
                foreach( $settings['counter'] as $data ) {  
                    echo '<div class="counter-card">';
                        echo '<h2 class="counter-card_number"><span class="counter-number">'.esc_html( $data['counter_number'] ).'</span>'.esc_html( $data['counter_suffix'] ).'</h2>';
                        echo '<span class="counter-card_text">'.wp_kses_post( $data['counter_text'] ).'</span>';
                    echo '</div>';
                }
            echo '</div>';

	    }


	}
}