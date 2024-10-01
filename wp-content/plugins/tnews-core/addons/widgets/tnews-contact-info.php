
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
 * Contact Info Widget .
 *
 */
class Tnews_Contact_Info extends Widget_Base {

	public function get_name() {
		return 'tnewscontactinfo';
	}
	public function get_title() {
		return __( 'Contact Info', 'tnews' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'tnews' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'title_section',
			[
				'label' 	=> __( 'Contact Info', 'tnews' ),
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
			'title',
            [
				'label'         => __( 'Title', 'tnews' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Get in Touch' , 'tnews' ),
				'rows'   => 2,
			]
		);	
		$this->add_control(
			'desc',
            [
				'label'         => __( 'Description', 'tnews' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( '' , 'tnews' ),
				'rows'   => 4,
			]
		);	
	
        $this->add_control(
			'address_icon',
			[
				'label' 		=> esc_html__( 'Address Icon', 'tnews' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
        );
        $this->add_control(
			'address_title',
            [
				'label'         => __( 'Address Title', 'tnews' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Our Address' , 'tnews' ),
				'label_block'   => true,
			]
		);	
		$this->add_control(
			'address_name',
            [
				'label'         => __( 'Address Name', 'tnews' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( '25 Street, 145 City, USA' , 'tnews' ),
				'rows' 		=> 3,
			]
		);

        $this->add_control(
			'email_icon',
			[
				'label' 		=> esc_html__( 'Email Icon', 'tnews' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
        );
        $this->add_control(
			'email_title',
            [
				'label'         => __( 'Email Title', 'tnews' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Email Address' , 'tnews' ),
				'label_block'   => true,
			]
		);	
        $this->add_control(
			'email_address',
            [
				'label'         => __( 'Email Address', 'tnews' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'info@tnews.com' , 'tnews' ),
				'label_block'   => true,
			]
		);
        $this->add_control(
			'email_address2',
            [
				'label'         => __( 'Email Address 2', 'tnews' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'info@tnews.com' , 'tnews' ),
				'label_block'   => true,
			]
		);

        $this->add_control(
			'phone_icon',
			[
				'label' 		=> esc_html__( 'Phone Icon', 'tnews' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
        );
        $this->add_control(
			'phone_title',
            [
				'label'         => __( 'Phone Title', 'tnews' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Phone Number' , 'tnews' ),
				'label_block'   => true,
			]
		);	
		$this->add_control(
			'phone_number',
            [
				'label'         => __( 'Phone Number', 'tnews' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( '+123 (405) 555-0128' , 'tnews' ),
				'label_block'   => true,
			]
		);
		$this->add_control(
			'phone_number2',
            [
				'label'         => __( 'Phone Number 2', 'tnews' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( '(702) 555-0122' , 'tnews' ),
				'label_block'   => true,
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
			'style_tabs2'
		);

			$this->start_controls_tab(
				'first_style_tab2',
				[
					'label' => esc_html__( 'Title', 'tnews' ),
				]
			);
			$this->add_control(
				'first_tab_color2',
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
					'name' 			=> 'first_tab_typography2',
						'label' 		=> __( 'Typography', 'tnews' ),
						'selector' 	=> '{{WRAPPER}} .th-title',
				]
			);
			$this->add_responsive_control(
				'first_tab_margin2',
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
				'first_tab_padding2',
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
				'sec_style_tab2',
				[
					'label' => esc_html__( 'Description', 'tnews' ),
				]
			);

			$this->add_control(
				'sec_tab_color22',
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
					'name' 			=> 'sec_tab_typography2',
						'label' 		=> __( 'Typography', 'tnews' ),
						'selector' 	=> '{{WRAPPER}} .th-desc',
				]
			);
			$this->add_responsive_control(
				'sec_tab_margin2',
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
				'sec_tab_padding2',
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

		$this->start_controls_tabs(
			'style_tabs'
		);

			$this->start_controls_tab(
				'first_style_tab',
				[
					'label' => esc_html__( 'Label', 'tnews' ),
				]
			);
			$this->add_control(
				'first_tab_color',
				[
					'label' 		=> __( 'Color', 'tnews' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .th-title2'	=> 'color: {{VALUE}}!important;',
					],
				]
			);
			$this->add_group_control(
			Group_Control_Typography::get_type(),
					[
					'name' 			=> 'first_tab_typography',
						'label' 		=> __( 'Typography', 'tnews' ),
						'selector' 	=> '{{WRAPPER}} .th-title2',
				]
			);
			$this->add_responsive_control(
				'first_tab_margin',
				[
					'label' 		=> __( 'Margin', 'tnews' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em' ],
					'selectors' 	=> [
						'{{WRAPPER}} .th-title2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .th-title2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_tab();

			//--------------------secound--------------------//
			$this->start_controls_tab(
				'sec_style_tab',
				[
					'label' => esc_html__( 'Content', 'tnews' ),
				]
			);

			$this->add_control(
				'sec_tab_color',
				[
					'label' 		=> __( 'Color', 'tnews' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .box-text, {{WRAPPER}} .box-text a'	=> 'color: {{VALUE}}!important;',
					],
				]
			);
			$this->add_control(
				'sec_tab_color2',
				[
					'label' 		=> __( 'Hover Color', 'tnews' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .box-text a:hover'	=> 'color: {{VALUE}}!important;',
					],
				]
			);
			$this->add_group_control(
			Group_Control_Typography::get_type(),
					[
					'name' 			=> 'sec_tab_typography',
						'label' 		=> __( 'Typography', 'tnews' ),
						'selector' 	=> '{{WRAPPER}} .box-text',
				]
			);
			$this->add_responsive_control(
				'sec_tab_margin',
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
				'sec_tab_padding',
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

		$this->end_controls_tabs();

		$this->end_controls_section();
		
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        $email    	= $settings['email_address'];
        $email2    	= $settings['email_address2'];
		$phone    	= $settings['phone_number'];              
		$phone2    	= $settings['phone_number2'];              

		$email          = is_email( $email );

		$replace        = array(' ','-',' - ');
		$replace_phone        = array(' ','-',' - ', '(', ')');
		$with           = array('','','');

		$emailurl       = str_replace( $replace, $with, $email );
		$emailurl2       = str_replace( $replace, $with, $email2 );
		$phoneurl       = str_replace( $replace_phone, $with, $phone );		
		$phoneurl2       = str_replace( $replace_phone, $with, $phone2 );		
        
        if( $settings['layout_style'] == '2' ){

        }else{
            echo '<div class="pe-xxl-4 me-xl-3 text-center text-xl-start mb-40 mb-lg-0">';
                echo '<div class="title-area mb-32">';
                    if($settings['title']){
                        echo '<h2 class="sec-title2 th-title">'.esc_html($settings['title']).'</h2>';
                    }
                    if($settings['desc']){
                        echo '<p class="sec-text th-desc">'.esc_html($settings['desc']).'</p>';
                    }
                echo '</div>';

                echo '<div class="contact-feature-wrap">';
                    echo '<div class="contact-feature">';
                        if( $settings['address_icon']['url'] ){
                            echo '<div class="box-icon">';
                                echo tnews_img_tag( array(
                                    'url'   => esc_url( $settings['address_icon']['url'] ),
                                ));
                            echo '</div>';
                        }
                        echo '<div class="box-content">';
                            if($settings['address_title']){
                                echo '<h3 class="box-title-22 th-title2">'.esc_html($settings['address_title']).'</h3>';
                            }
                            echo '<p class="box-text">'.wp_kses_post($settings['address_name']).'</p>';
                        echo '</div>';
                    echo '</div>';

                    echo '<div class="contact-feature">';
                        if( $settings['email_icon']['url'] ){
                            echo '<div class="box-icon">';
                                echo tnews_img_tag( array(
                                    'url'   => esc_url( $settings['email_icon']['url'] ),
                                ));
                            echo '</div>';
                        }
                        echo '<div class="box-content">';
                            if($settings['email_title']){
                                echo '<h3 class="box-title-22 th-title2">'.esc_html($settings['email_title']).'</h3>';
                            }
                            echo '<p class="box-text">';
                                echo '<a href="'.esc_attr( 'mailto:'.$emailurl).'">'.esc_html($email).'</a>';
                                echo '<a href="'.esc_attr( 'mailto:'.$emailurl2).'">'.esc_html($email2).'</a>';
                           echo ' </p>';
                        echo '</div>';
                    echo '</div>';

                    echo '<div class="contact-feature">';
                        if( $settings['phone_icon']['url'] ){
                            echo '<div class="box-icon">';
                                echo tnews_img_tag( array(
                                    'url'   => esc_url( $settings['phone_icon']['url'] ),
                                ));
                            echo '</div>';
                        }
                        echo '<div class="box-content">';
                            if($settings['phone_title']){
                                echo '<h3 class="box-title-22 th-title2">'.esc_html($settings['phone_title']).'</h3>';
                            }
                            echo '<p class="box-text">';
                                echo '<a href="'.esc_attr( 'tel:'.$phoneurl).'">'.esc_html($phone).'</a>';
                                echo '<a href="'.esc_attr( 'tel:'.$phoneurl2).'">'.esc_html($phone2).'</a>';
                            echo '</p>';
                        echo '</div>';
                    echo '</div>';

                echo '</div>';
            echo '</div>';
        }


	}

}
