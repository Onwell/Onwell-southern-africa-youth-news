<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Timeline Widget .
 *
 */
class Tnews_Timeline extends Widget_Base {

	public function get_name() {
		return 'tnewstimeline';
	}

	public function get_title() {
		return __( 'Timeline', 'tnews' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'tnews' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'timeline_section',
			[
				'label' 	=> __( 'Timeline', 'tnews' ),
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
					// '2'  			=> __( 'Style Two', 'tnews' ),
				],
			]
		);   
        $this->add_control(
			'bg',
			[
				'label' 		=> __( 'Shape', 'tnews' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
			]
		); 
		$repeater = new Repeater();

        $repeater->add_control(
			'image',
			[
				'label' 		=> __( 'Image', 'tnews' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'timeline_year',
			[
				'label'     => __( 'Year', 'tnews' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
				'default' 	=> __( '1990', 'tnews' ),
			]
		);
		$repeater->add_control(
			'timeline_title',
			[
				'label'     => __( 'Title', 'tnews' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
				'default' 	=> __( 'We Start Company', 'tnews' ),
			]
		);
		$repeater->add_control(
			'timeline_desc',
			[
				'label'     => __( 'Description', 'tnews' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
				'default' 	=> __( 'Forward-thinking and innovative venture born from a vision to Create positive', 'tnews' ),
			]
		);
		$this->add_control(
			'timeline_list',
			[
				'label' 		=> __( 'Timeline Lists', 'tnews' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'timeline_title' 		=> __( 'We Start Company', 'tnews' ),
					],
				],
			]
		);

        $this->add_control(
			'end',
			[
				'label'     => __( 'End Text', 'tnews' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
				'default' 	=> __( 'End', 'tnews' ),
			]
		);
		
		$this->end_controls_section();

        /*-----------------------------------------Content styling------------------------------------*/
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
				'label' => esc_html__( 'Title', 'tnews' ),
			]
		);
        $this->add_control(
			'overview_title_color',
			[
				'label' 		=> __( 'Color', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .box-title'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_title_typography',
		 		'label' 		=> __( 'Typography', 'tnews' ),
		 		'selector' 	=> '{{WRAPPER}} .box-title',
			]
		);

        $this->add_responsive_control(
			'overview_title_margin',
			[
				'label' 		=> __( 'Margin', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .box-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
		$this->end_controls_tab();

		//--------------------secound--------------------//
		$this->start_controls_tab(
			'style_hover_tab2',
			[
				'label' => esc_html__( 'Description', 'tnews' ),
			]
		);
		$this->add_control(
			'overview_content_color',
			[
				'label' 		=> __( 'Color', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .box-text'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_content_typography',
		 		'label' 		=> __( 'Typography', 'tnews' ),
		 		'selector' 	=> '{{WRAPPER}} .box-text',
			]
		);

        $this->add_responsive_control(
			'overview_content_margin',
			[
				'label' 		=> __( 'Margin', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .box-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .box-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

		$this->end_controls_tab();

		//--------------------Third--------------------//
		$this->start_controls_tab(
			'style_hover_tab3',
			[
				'label' => esc_html__( 'Year', 'tnews' ),
			]
		);
		$this->add_control(
			'overview_year_color',
			[
				'label' 		=> __( 'Color', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .story-year'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
		$this->add_control(
			'overview_year_color2',
			[
				'label' 		=> __( 'Hover Color', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .story-box-wrap:hover .story-year'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
		$this->add_control(
			'overview_year_bg',
			[
				'label' 		=> __( 'Background', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .story-year'	=> 'background-color: {{VALUE}}!important;',
				],
			]
        );
		$this->add_control(
			'overview_year_bg2',
			[
				'label' 		=> __( 'Hover Background', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .story-box-wrap:hover .story-year'	=> 'background-color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_year_typography',
		 		'label' 		=> __( 'Typography', 'tnews' ),
		 		'selector' 	=> '{{WRAPPER}} .story-year',
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
        	echo '<div class="story-box-area" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
                foreach( $settings['timeline_list'] as $data ) { 
                    echo '<div class="story-box-wrap">';
                        echo '<div class="story-box">';
                            if (!empty( $data['image']['url'] )) {
                                echo '<div class="box-img">';
                                    echo tnews_img_tag( array(
                                        'url'   => esc_url( $data['image']['url'] ),
                                    ));
                                echo '</div>';
                            }
                            echo '<div class="box-content">';
                                if(!empty($data['timeline_title'])){
                                    echo '<h3 class="box-title">'.esc_html( $data['timeline_title'] ).'</h3>';
                                }
                                if(!empty($data['timeline_desc'])){
                                    echo '<p class="box-text">'.esc_html( $data['timeline_desc'] ).'</p>';
                                }
                            echo '</div>';
                        echo '</div>';
                        if(!empty($data['timeline_year'])){
                            echo '<div class="story-year">'.esc_html( $data['timeline_year'] ).'</div>';
                        }
                    echo '</div>';
                }
                if(!empty($settings['end'])){
                    echo '<div class="story-box-wrap">';
                        echo '<div class="story-year">'.esc_html( $settings['end'] ).'</div>';
                    echo '</div>';
                }
            echo '</div>';

	    }


	}
}