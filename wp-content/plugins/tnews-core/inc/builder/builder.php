<?php
    /**
     * Class For Builder
     */
    class TnewsBuilder{

        function __construct(){
            // register admin menus
        	add_action( 'admin_menu', [$this, 'register_settings_menus'] );

            // Custom Footer Builder With Post Type
			add_action( 'init',[ $this,'post_type' ],0 );

 		    add_action( 'elementor/frontend/after_enqueue_scripts', [ $this,'widget_scripts'] );

			add_filter( 'single_template', [ $this, 'load_canvas_template' ] );

            add_action( 'elementor/element/wp-page/document_settings/after_section_end', [ $this,'tnews_add_elementor_page_settings_controls' ],10,2 );

		}

		public function widget_scripts( ) {
			wp_enqueue_script( 'tnews-core',TNEWS_PLUGDIRURI.'assets/js/tnews-core.js',array( 'jquery' ),'1.0',true );
		}


        public function tnews_add_elementor_page_settings_controls( \Elementor\Core\DocumentTypes\Page $page ){

			$page->start_controls_section(
                'tnews_header_option',
                [
                    'label'     => __( 'Header Option', 'tnews' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );


            $page->add_control(
                'tnews_header_style',
                [
                    'label'     => __( 'Header Option', 'tnews' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'tnews' ),
    					'header_builder'       => __( 'Header Builder', 'tnews' ),
    				],
                    'default'   => 'prebuilt',
                ]
			);

            $page->add_control(
                'tnews_header_builder_option',
                [
                    'label'     => __( 'Header Name', 'tnews' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->tnews_header_choose_option(),
                    'condition' => [ 'tnews_header_style' => 'header_builder'],
                    'default'	=> ''
                ]
            );

            $page->end_controls_section();

            $page->start_controls_section(
                'tnews_footer_option',
                [
                    'label'     => __( 'Footer Option', 'tnews' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );
            $page->add_control(
    			'tnews_footer_choice',
    			[
    				'label'         => __( 'Enable Footer?', 'tnews' ),
    				'type'          => \Elementor\Controls_Manager::SWITCHER,
    				'label_on'      => __( 'Yes', 'tnews' ),
    				'label_off'     => __( 'No', 'tnews' ),
    				'return_value'  => 'yes',
    				'default'       => 'yes',
    			]
    		);
            $page->add_control(
                'tnews_footer_style',
                [
                    'label'     => __( 'Footer Style', 'tnews' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'tnews' ),
    					'footer_builder'       => __( 'Footer Builder', 'tnews' ),
    				],
                    'default'   => 'prebuilt',
                    'condition' => [ 'tnews_footer_choice' => 'yes' ],
                ]
            );
            $page->add_control(
                'tnews_footer_builder_option',
                [
                    'label'     => __( 'Footer Name', 'tnews' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->tnews_footer_build_choose_option(),
                    'condition' => [ 'tnews_footer_style' => 'footer_builder','tnews_footer_choice' => 'yes' ],
                    'default'	=> ''
                ]
            );

			$page->end_controls_section();

        }

		public function register_settings_menus(){
			add_menu_page(
				esc_html__( 'Tnews Builder', 'tnews' ),
            	esc_html__( 'Tnews Builder', 'tnews' ),
				'manage_options',
				'tnews',
				[$this,'register_settings_contents__settings'],
				'dashicons-admin-site',
				2
			);

			add_submenu_page('tnews', esc_html__('Footer Builder', 'tnews'), esc_html__('Footer Builder', 'tnews'), 'manage_options', 'edit.php?post_type=tnews_footerbuild');
			add_submenu_page('tnews', esc_html__('Header Builder', 'tnews'), esc_html__('Header Builder', 'tnews'), 'manage_options', 'edit.php?post_type=tnews_header');
			add_submenu_page('tnews', esc_html__('Tab Builder', 'tnews'), esc_html__('Tab Builder', 'tnews'), 'manage_options', 'edit.php?post_type=tnews_tab_builder');
		}

		// Callback Function
		public function register_settings_contents__settings(){
            echo '<h2>';
			    echo esc_html__( 'Welcome To Header And Footer Builder Of This Theme','tnews' );
            echo '</h2>';
		}

		public function post_type() {

			$labels = array(
				'name'               => __( 'Footer', 'tnews' ),
				'singular_name'      => __( 'Footer', 'tnews' ),
				'menu_name'          => __( 'Tnews Footer Builder', 'tnews' ),
				'name_admin_bar'     => __( 'Footer', 'tnews' ),
				'add_new'            => __( 'Add New', 'tnews' ),
				'add_new_item'       => __( 'Add New Footer', 'tnews' ),
				'new_item'           => __( 'New Footer', 'tnews' ),
				'edit_item'          => __( 'Edit Footer', 'tnews' ),
				'view_item'          => __( 'View Footer', 'tnews' ),
				'all_items'          => __( 'All Footer', 'tnews' ),
				'search_items'       => __( 'Search Footer', 'tnews' ),
				'parent_item_colon'  => __( 'Parent Footer:', 'tnews' ),
				'not_found'          => __( 'No Footer found.', 'tnews' ),
				'not_found_in_trash' => __( 'No Footer found in Trash.', 'tnews' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'tnews_footerbuild', $args );

			$labels = array(
				'name'               => __( 'Header', 'tnews' ),
				'singular_name'      => __( 'Header', 'tnews' ),
				'menu_name'          => __( 'Tnews Header Builder', 'tnews' ),
				'name_admin_bar'     => __( 'Header', 'tnews' ),
				'add_new'            => __( 'Add New', 'tnews' ),
				'add_new_item'       => __( 'Add New Header', 'tnews' ),
				'new_item'           => __( 'New Header', 'tnews' ),
				'edit_item'          => __( 'Edit Header', 'tnews' ),
				'view_item'          => __( 'View Header', 'tnews' ),
				'all_items'          => __( 'All Header', 'tnews' ),
				'search_items'       => __( 'Search Header', 'tnews' ),
				'parent_item_colon'  => __( 'Parent Header:', 'tnews' ),
				'not_found'          => __( 'No Header found.', 'tnews' ),
				'not_found_in_trash' => __( 'No Header found in Trash.', 'tnews' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'tnews_header', $args );

			$labels = array(
				'name'               => __( 'Tab Builder', 'tnews' ),
				'singular_name'      => __( 'Tab Builder', 'tnews' ),
				'menu_name'          => __( 'Gesund Tab Builder', 'tnews' ),
				'name_admin_bar'     => __( 'Tab Builder', 'tnews' ),
				'add_new'            => __( 'Add New', 'tnews' ),
				'add_new_item'       => __( 'Add New Tab Builder', 'tnews' ),
				'new_item'           => __( 'New Tab Builder', 'tnews' ),
				'edit_item'          => __( 'Edit Tab Builder', 'tnews' ),
				'view_item'          => __( 'View Tab Builder', 'tnews' ),
				'all_items'          => __( 'All Tab Builder', 'tnews' ),
				'search_items'       => __( 'Search Tab Builder', 'tnews' ),
				'parent_item_colon'  => __( 'Parent Tab Builder:', 'tnews' ),
				'not_found'          => __( 'No Tab Builder found.', 'tnews' ),
				'not_found_in_trash' => __( 'No Tab Builder found in Trash.', 'tnews' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'tnews_tab_builder', $args );
		}

		function load_canvas_template( $single_template ) {

			global $post;

			if ( 'tnews_footerbuild' == $post->post_type || 'tnews_header' == $post->post_type || 'tnews_tab_build' == $post->post_type ) {

				$elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

				if ( file_exists( $elementor_2_0_canvas ) ) {
					return $elementor_2_0_canvas;
				} else {
					return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
				}
			}

			return $single_template;
		}

        public function tnews_footer_build_choose_option(){

			$tnews_post_query = new WP_Query( array(
				'post_type'			=> 'tnews_footerbuild',
				'posts_per_page'	    => -1,
			) );

			$tnews_builder_post_title = array();
			$tnews_builder_post_title[''] = __('Select a Footer','tnews');

			while( $tnews_post_query->have_posts() ) {
				$tnews_post_query->the_post();
				$tnews_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $tnews_builder_post_title;

		}

		public function tnews_header_choose_option(){

			$tnews_post_query = new WP_Query( array(
				'post_type'			=> 'tnews_header',
				'posts_per_page'	    => -1,
			) );

			$tnews_builder_post_title = array();
			$tnews_builder_post_title[''] = __('Select a Header','tnews');

			while( $tnews_post_query->have_posts() ) {
				$tnews_post_query->the_post();
				$tnews_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $tnews_builder_post_title;

        }

    }

    $builder_execute = new TnewsBuilder();