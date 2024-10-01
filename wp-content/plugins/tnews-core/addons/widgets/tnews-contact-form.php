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
 * Contact Form Widget .
 *
 */
class Tnews_Contact_Form extends Widget_Base {

	public function get_name() {
		return 'tnewscontactform';
	}
	public function get_title() {
		return __( 'Contact Form', 'tnews' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'tnews' ];
	}

	public function get_as_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $as_cfa         = array();
        $as_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $as_forms       = get_posts( $as_cf_args );
        $as_cfa         = ['0' => esc_html__( 'Select Form', 'tnews' ) ];
        if( $as_forms ){
            foreach ( $as_forms as $as_form ){
                $as_cfa[$as_form->ID] = $as_form->post_title;
            }
        }else{
            $as_cfa[ esc_html__( 'No contact form found', 'tnews' ) ] = 0;
        }
        return $as_cfa;
    }

	protected function register_controls() {

		$this->start_controls_section(
			'contact_form_section',
			[
				'label' 	=> __( 'Contact Form', 'tnews' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
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
				],
			]
		);  

		$this->add_control(
			'section_title',
			[
				'label' 	=> __( 'Title', 'tnews' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Send Message', 'tnews' ),
				'rows' => '2',
			]
        );

		$this->add_control(
            'tnews_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'tnews' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_as_contact_form(),
            ]
        );

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

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

		//-------------------------Title Style-----------------------//
		$this->start_controls_section(
			'title_style',
			[
				'label' 	=> __( 'Title Style', 'tnews' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Color', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .th-title' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'label' 	=> __( 'Typography', 'tnews' ),
				'selector' 	=> '{{WRAPPER}} .th-title',
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' 		=> __( 'Margin', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' 		=> __( 'Padding', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();

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

        }else{
            echo '<div class="quote-form-box th-bg">';
                if(!empty($settings['section_title'])){
                    echo '<h4 class="form-title th-title">'.esc_html($settings['section_title']).'</h4>';
                }
                echo '<div class="contact-form ajax-contact">';
                    if( !empty($settings['tnews_select_contact_form']) ){
                        echo do_shortcode( '[contact-form-7  id="'.$settings['tnews_select_contact_form'].'"]' ); 
                    }else{
                        echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'tnews' ). '</p></div>';
                    }
                echo '</div>';
            echo '</div>';
        }


	}

}