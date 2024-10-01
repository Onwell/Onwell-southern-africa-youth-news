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
 * Menu Select Widget .
 *
 */
class Tnews_Menu extends Widget_Base {

	public function get_name() {
		return 'tnewsmenuselect';
	}
	public function get_title() {
		return __( 'Menu Select', 'tnews' );
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
				'label'		 	=> __( 'Navigation Menu', 'tnews' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
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

        if( ! empty( $settings['tnews_menu_select'] ) ){
            wp_nav_menu( $args );
        } 


	}

}