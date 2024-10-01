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
 * About Info Widget .
 *
 */
class Tnews_About_Info extends Widget_Base {

	public function get_name() {
		return 'tnewsaboutinfo';
	}

	public function get_title() {
		return __( 'About Info', 'tnews' );
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
				'label'		 	=> __( 'About Info', 'tnews' ),
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
					'3'  		=> __( 'Style Three', 'tnews' ),												
				],
			]
		);
		
		$this->add_control(
			'logo',
			[
				'label' 		=> __( 'Choose Logo', 'tnews' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
			]
		); 
		$this->add_control(
			'logo2',
			[
				'label' 		=> __( 'Choose Logo', 'tnews' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'condition' => [
					'layout_style' => ['2']
				]
			]
		); 
		
		$this->add_control(
			'logo_url',
			[
				'label' 		=> esc_html__( 'Site URL', 'tnews' ),
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

		$this->add_control(
			'desc',
            [
				'label'         => __( 'Description', 'tnews' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Description here' , 'tnews' ),
				'label_block'   => true,
				'rows' => '4',
				'condition' => [
					'layout_style' => ['1', '2']
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_icon',
			[
				'label' 	=> __( 'Social Icon', 'tnews' ),
				'type' 		=> Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
			]
		);
		$repeater->add_control(
			'social_link',
			[
				'label' 		=> esc_html__( 'Social Link', 'tnews' ),
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

		$this->add_control(
			'social_lists',
			[
				'label' 		=> __( 'Social List', 'tnews' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'social_icon' => [
							'value' => 'fab fa-facebook-f'
						],
					]
				],
				'title_field' => '{{{ social_icon.value }}}',
			]
		);

		$menus = $this->tnews_menu_select();

		if( !empty( $menus ) ){
	        $this->add_control(
				'tnews_menu_select',
				[
					'label'     	=> __( 'Select Tnews Menu', 'tnews' ),
					'type'      	=> Controls_Manager::SELECT,
					'options'   	=> $menus,
					'description' 	=> sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'tnews' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		}else {
			$this->add_control(
				'no_menu',
				[
					'type' 				=> Controls_Manager::RAW_HTML,
					'raw' 				=> '<strong>' . __( 'There are no menus in your site.', 'tnews' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'tnews' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' 		=> 'after',
					'content_classes' 	=> 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------------------------Content Style-----------------------//
		$this->start_controls_section(
			'section_desc_style_section2',
			[
				'label' => __( 'Content Style', 'tnews' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout_style' => ['1', '2']
				]
			]
		);

		$this->add_control(
			'section_desc_color2',
			[
				'label' 		=> __( 'Color', 'tnews' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .th-desc' => 'color: {{VALUE}}!important',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'section_desc_typography2',
				'label' 	=> __( 'Typography', 'tnews' ),
                'selector' 	=> '{{WRAPPER}} .th-desc',
			]
        );

        $this->add_responsive_control(
			'section_desc_margin2',
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
			'section_desc_padding2',
			[
				'label' 		=> __( 'Padding', 'tnews' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->end_controls_section();

	}

	public function tnews_menu_select(){ 
	    $tnews_menu = wp_get_nav_menus();
	    $menu_array  = array();
		$menu_array[''] = __( 'Select A Menu', 'tnews' );
	    foreach( $tnews_menu as $menu ){
	        $menu_array[ $menu->slug ] = $menu->name;
	    }
	    return $menu_array;
	}


	protected function render() {

        $settings = $this->get_settings_for_display();

		 //Menu by menu select
		 $tnews_avaiable_menu   = $this->tnews_menu_select();

		 if( ! $tnews_avaiable_menu ){
			 return;
		 }
		 $args = [
			 'menu' 		=> $settings['tnews_menu_select'],
			 'menu_class' 	=> 'tnews-menu',
			 'container' 	=> '',
		 ];


		if( $settings['layout_style'] == '2' ){
			echo '<div class="th-widget-about">';
				if($settings['logo']['url']){
					echo '<div class="about-logo">';
						echo '<a href="'.esc_url( $settings['logo_url']['url'] ).'">';
							echo tnews_img_tag( array(
								'url'   => esc_url( $settings['logo']['url'] ),
								'class' => 'light-img'
							));
							echo tnews_img_tag( array(
								'url'   => esc_url( $settings['logo2']['url'] ),
								'class' => 'dark-img'
							));
						echo '</a>';
					echo '</div>';
				}
				if($settings['desc']){
					echo '<p class="about-text th-desc">'.esc_html( $settings['desc'] ).'</p>';
				}
				echo '<div class="th-social style-black">';
					foreach( $settings['social_lists'] as $data ){
						$target = $data['social_link']['is_external'] ? ' target="_blank"' : '';
						$nofollow = $data['social_link']['nofollow'] ? ' rel="nofollow"' : '';
						echo '<a '.esc_attr( $nofollow.$target ).' href="'.$data['social_link']['url'].'"><i class="'.$data['social_icon']['value'].'"></i></a>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="text-center">';
				if($settings['logo']['url']){
					echo '<div class="mb-30">';
						echo '<a href="'.esc_url( $settings['logo_url']['url'] ).'">';
							echo tnews_img_tag( array(
								'url'   => esc_url( $settings['logo']['url'] ),
							));
						echo '</a>';
					echo '</div>';
				}
				echo '<div class="th-social style-black">';
					foreach( $settings['social_lists'] as $data ){
						$target = $data['social_link']['is_external'] ? ' target="_blank"' : '';
						$nofollow = $data['social_link']['nofollow'] ? ' rel="nofollow"' : '';
						echo '<a '.esc_attr( $nofollow.$target ).' href="'.$data['social_link']['url'].'"><i class="'.$data['social_icon']['value'].'"></i></a>';
					}
				echo '</div>';
				if( ! empty( $settings['tnews_menu_select'] ) ){
					echo '<div class="footer-menu mb-30">';
						wp_nav_menu( $args );
					echo '</div>';
				} 
			echo '</div>';

		}else{
			echo '<div class="th-widget-about">';
				if($settings['logo']['url']){
					echo '<div class="about-logo">';
						echo '<a href="'.esc_url( $settings['logo_url']['url'] ).'">';
							echo tnews_img_tag( array(
								'url'   => esc_url( $settings['logo']['url'] ),
							));
						echo '</a>';
					echo '</div>';
				}
				if($settings['desc']){
					echo '<p class="about-text th-desc">'.esc_html( $settings['desc'] ).'</p>';
				}
				echo '<div class="th-social style-black">';
					foreach( $settings['social_lists'] as $data ){
						$target = $data['social_link']['is_external'] ? ' target="_blank"' : '';
						$nofollow = $data['social_link']['nofollow'] ? ' rel="nofollow"' : '';
						echo '<a '.esc_attr( $nofollow.$target ).' href="'.$data['social_link']['url'].'"><i class="'.$data['social_icon']['value'].'"></i></a>';
					}
				echo '</div>';
			echo '</div>';

		}


	}

}
