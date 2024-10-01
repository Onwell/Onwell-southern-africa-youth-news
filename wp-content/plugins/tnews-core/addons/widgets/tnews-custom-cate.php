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
 * Custom Category Widget .
 *
 */
class Tnews_Custom_Category extends Widget_Base {

	public function get_name() {
		return 'tnewscustomcategory';
	}
	public function get_title() {
		return __( 'Custom Category', 'tnews' );
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
				'label'		 	=> __( 'Custom Category', 'tnews' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
            'selected_category',
            [
                'label' => __('Select Category', 'tnews'),
                // 'description' => __('Select Category if you show only category post.', 'tnews'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => true,
                'options' => $this->get_categories_options(),
            ]
        );

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------


	}

    //get category list
    public function get_categories_options() {
        $categories = get_categories(array('hide_empty' => false));
        $options = array();
        foreach ($categories as $category) {
            $options[$category->slug] = $category->name; 
        }
        return $options;
    }

	protected function render() {

	$settings = $this->get_settings_for_display();

        $cus_cate = $settings['selected_category'];
        

        echo '<div class="widget">';
            echo '<div class="row g-10">';
            
                foreach($cus_cate as $cate){
                    $term_id = get_term_by('slug', $cate, 'category')->term_id;
                    $name = get_term_by('slug', $cate, 'category')->name;

                    // $category = get_category($cate);
                    // $term_id = $category->slug;
                    $image = get_term_meta( $term_id, '_tnews_term_avatar', 1 );
                    $icon = get_term_meta( $term_id, '_tnews_term_icon', 1 );

                    echo '<div class="col-xl-6 col-md-3 col-6">';
                        echo '<div class="category-card" data-bg-src="'.esc_url($image).'">';
                            if(!empty($icon)){
                                echo '<div class="box-icon">';
                                    echo '<img src="'.esc_url($icon).'" alt="Icon">';
                                echo '</div>';
                            }
                            echo '<h3 class="box-title"><a href="'.esc_url( get_category_link( $term_id ) ).'">'.esc_html($name).'</a></h3>';
                        echo '</div>';
                    echo '</div>'; 
                }

            echo '</div>  ';
        echo '</div>';

	}

}