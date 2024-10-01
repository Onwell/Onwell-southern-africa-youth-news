<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background;
/**
 * 
 * Newsletter Widget .
 *
 */
class Tnews_Newsletter extends Widget_Base {

	public function get_name() {
		return 'tnewsnewsletter';
	}
	public function get_title() {
		return __( 'Newsletter', 'tnews' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'tnews' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'layout_section',
			[
				'label'     => __( 'Newsletter Style', 'tnews' ),
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
					'2' 		=> __( 'Style Two', 'tnews' ),
					'3' 		=> __( 'Style Three', 'tnews' ),
					'4' 		=> __( 'Style Four', 'tnews' ),
				],
			]
		); 
		$this->add_control(
			'image',
			[
				'label' 		=> __( 'Image', 'tnews' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'condition' => [
					'layout_style' => ['2', '3', '4']
				]
			]
		);
		$this->add_control(
			'image2',
			[
				'label' 		=> __( 'Image Bg', 'tnews' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'condition' => [
					'layout_style' => ['4']
				]
			]
		);
        $this->add_control(
			'title',
            [
				'label'         => __( 'Title', 'tnews' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Title' , 'tnews' ),
				'label_block'   => true,
				'rows' 		=> 3,
				'condition' => [
					'layout_style' => ['2', '3', '4']
				]
			]
		);

		$this->add_control(
			'desc',
            [
				'label'         => __( 'Description', 'tnews' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Description' , 'tnews' ),
				'label_block'   => true,
				'rows' 		=> 3,
				'condition' => [
					'layout_style' => ['1']
				]
			]
		);

		$this->add_control(
			'newsletter_placeholder',
			[
				'label' 		=> __( 'Newsletter Placeholder Text', 'tnews' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
				'default' 		=> __( 'Enter Your Email', 'tnews' ),
			]
		);

		$this->add_control(
			'newsletter_button',
			[
				'label' 		=> __( 'Newsletter Button Text', 'tnews' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Subscribe', 'tnews' ),
			]
		);

		$this->add_control(
			'agree',
            [
				'label'         => __( 'Agree Text', 'tnews' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'I have read and accept the Terms & Policy' , 'tnews' ),
				'label_block'   => true,
				'rows' 		=> 3,
				'condition' => [
					'layout_style' => ['1']
				]
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
				'label'     => __( 'General Styling', 'tnews' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'layout_style' => ['2', '3', '4']
				]	
			]
		);

		$this->add_control(
			'general_bg',
			[
				'label' 		=> __( 'Background', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .th-bg' => 'background-color: {{VALUE}} !important;',
				],
			]
		);   

		$this->end_controls_section();

		//-------------------------Title Style-----------------------//
        $this->start_controls_section(
			'section_title_style_section',
			[
				'label' => __( 'Title Style', 'tnews' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'layout_style' => ['2', '3', '4']
				]	
			]
		);
        $this->add_control(
			'section_title_color',
			[
				'label' 	=> __( 'Color', 'tnews' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-title' => 'color: {{VALUE}}!important;',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'section_title_typography',
				'label' 	=> __( 'Typography', 'tnews' ),
                'selector' 	=> '{{WRAPPER}} .th-title',
			]
		);
        $this->add_responsive_control(
			'section_title_margin',
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
			'section_title_padding',
			[
				'label' 		=> __( 'Padding', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

        $this->end_controls_section();

		//-------------------------Description Style-----------------------//
		$this->start_controls_section(
			'desc_style',
			[
				'label' 	=> __( 'Description Style', 'tnews' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'layout_style' => ['1']
				]	
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' 		=> __( 'Color', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .th-desc' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'desc_typography',
				'label' 	=> __( 'Typography', 'tnews' ),
				'selector' 	=> '{{WRAPPER}} .th-desc',
			]
		);
		$this->add_responsive_control(
			'desc_margin',
			[
				'label' 		=> __( 'Margin', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'desc_padding',
			[
				'label' 		=> __( 'Padding', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();

		//-------------------------Agree Style-----------------------//
		$this->start_controls_section(
			'agree_style',
			[
				'label' 	=> __( 'Agree Style', 'tnews' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'layout_style' => ['1']
				]	
			]
		);
		$this->add_control(
			'agree_color',
			[
				'label' 		=> __( 'Color', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .agree label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'agree_color2',
			[
				'label' 		=> __( 'Link Color', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .agree label a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'agree_typography',
				'label' 	=> __( 'Typography', 'tnews' ),
				'selector' 	=> '{{WRAPPER}} .agree label',
			]
		);
		$this->add_responsive_control(
			'agree_margin',
			[
				'label' 		=> __( 'Margin', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .agree label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'agree_padding',
			[
				'label' 		=> __( 'Padding', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .agree label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '2' ){
			echo '<div class="widget newsletter-widget2 th-bg mb-30" data-bg-src="'.esc_url($settings['image']['url']).'">';
				if($settings['title']){
					echo '<h3 class="box-title-24 th-title">'.esc_html($settings['title']).'</h3>';
				}
				echo '<form class="newsletter-form">';
					echo '<input class="form-control" type="email" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'" required="">';
					echo '<button type="submit" class="th-btn btn-fw">'.wp_kses_post( $settings['newsletter_button'] ).'</button>';
				echo '</form>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="bg-smoke py-lg-4 th-bg">';
				echo '<div class="container">';
					echo '<div class="row flex-row-reverse justify-content-center justify-content-lg-between align-items-center">';
						echo '<div class="col-lg-5 mb-n3 mb-lg-0">';
							echo '<div class="text-center text-lg-end pt-4 pt-lg-0">';
								echo tnews_img_tag( array(
									'url'   => esc_url( $settings['image']['url'] ),
								));
							echo '</div>';
						echo '</div>';
						echo '<div class="col-lg-7 py-4 text-center text-lg-start">';
							echo '<h2 class="box-title-30 th-title mb-30">'.wp_kses_post($settings['title']).'</h2>';
							echo '<form class="newsletter-form width2">';
								echo '<input class="form-control" type="email" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'" required="">';
								echo '<button type="submit" class="th-btn">'.wp_kses_post( $settings['newsletter_button'] ).'</button>';
							echo '</form>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){
			echo '<div class="widget newsletter-widget3 th-bg " data-bg-src="'.esc_url($settings['image2']['url']).'">';
				echo '<div class="mb-4">';
					echo tnews_img_tag( array(
						'url'   => esc_url( $settings['image']['url'] ),
					));
				echo '</div>';
				echo '<h3 class="box-title-24  th-title mb-20">'.wp_kses_post($settings['title']).'</h3>';
				echo '<form class="newsletter-form">';
					echo '<input class="form-control" type="email" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'" required="">';
					echo '<button type="submit" class="icon-btn">'.wp_kses_post( $settings['newsletter_button'] ).'</button>';
				echo '</form>';
			echo '</div>';

		}else{
			if($settings['desc']){
				echo '<p class="footer-text th-desc">'.wp_kses_post($settings['desc']).'</p>';
			}
			echo '<form class="newsletter-form">';
				echo '<input class="form-control" type="email" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'" required="">';
				echo '<button type="submit" class="icon-btn">'.wp_kses_post( $settings['newsletter_button'] ).'</button>';
			echo '</form>';
			if($settings['agree']){
				echo '<div class="mt-30 agree">';
					echo '<input type="checkbox" id="Agree">';
					echo '<label for="Agree">'.wp_kses_post($settings['agree']).'</label>';
				echo '</div>';
			}
		}


	}
}
						