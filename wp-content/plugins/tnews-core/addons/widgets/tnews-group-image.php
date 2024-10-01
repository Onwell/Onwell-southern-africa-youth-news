<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
/**
 *
 * Image Widget .
 *
 */
class Tnews_Group_Image extends Widget_Base {

	public function get_name() {
		return 'tnewsgroupimage';
	}
	public function get_title() {
		return __( 'Group Image', 'tnews' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'tnews' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'image_section',
			[
				'label' 	=> __( 'Group Image', 'tnews' ),
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
			'image1',
			[
				'label' 		=> __( 'Image 1', 'tnews' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'image2',
			[
				'label' 		=> __( 'Image 2', 'tnews' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],

			]
		);
        $this->add_control(
			'video_link',
			[
				'label' 		=> __( 'Video Link', 'tnews' ),
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
	
		
        $this->end_controls_section();
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '2' ){
        	
	    }else{
            echo '<div class="img-box1">';
                if (!empty( $settings['image1']['url'] )) {
                    echo '<div class="img1">';
                        echo '<img src="'.esc_url( $settings['image1']['url']  ).'" alt="'.esc_html__('About Photo', 'tnews').'">';
                    echo '</div>';
                }
                if (!empty( $settings['image2']['url'] )) {
                    echo '<div class="img2">';
                        echo '<img src="'.esc_url( $settings['image2']['url']  ).'" alt="'.esc_html__('About Photo', 'tnews').'">';
                    echo '</div>';
                }
                if (!empty( $settings['video_link']['url'] )) {
                    echo '<a href="'.esc_url( $settings['video_link']['url'] ).'" class="icon-btn popup-video"><i class="fas fa-play"></i></a>';
                }
            echo '</div>';

		}


	}

}