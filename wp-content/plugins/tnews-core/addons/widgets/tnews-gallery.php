<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Gallery Widget .
 *
 */
class Tnews_Gallery extends Widget_Base {

	public function get_name() {
		return 'tnewsgallery';
	}
	public function get_title() {
		return __( 'Gallery', 'tnews' );
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
				'label' 	=> __( 'Gallery', 'tnews' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
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
				],
			]
		);

		$this->add_control(
			'gallery',
			[
				'label' => esc_html__( 'Add Gallery Slider', 'tnews' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
			]
		);

        $this->add_control(
			'gallery_icon',
            [
				'label'         => __( 'Gallery Icon', 'tnews' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( '<i class="fab fa-instagram"></i>' , 'tnews' ),
				'label_block'   => true,
				'rows' => '4',
			]
		);

		$this->end_controls_section();

		//---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------------------------General Style-----------------------//
        $this->start_controls_section(
            'gallery_style_section',
            [
                'label' => __( 'Gallery Style', 'tnews' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'gallery_overlay_color',
            [
                'label' 	=> __( 'Overlay Color', 'tnews' ),
                'type' 		=> Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gallery-card .gallery-img:before' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->end_controls_section();	

	}


	protected function render() {

		$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '2' ){
		
		}else{
			echo '<div class="sidebar-gallery">';
				foreach ( $settings['gallery'] as $data ){
					echo '<div class="gallery-thumb">';
						echo tnews_img_tag( array(
							'url'   => esc_url( $data['url'] ),
						) );
						echo '<a href="'.esc_url( $data['url'] ).'" class="gallery-btn popup-image">'.wp_kses_post($settings['gallery_icon']).'</a>';
					echo '</div>';
				}
			echo '</div>';

		}

	}

}