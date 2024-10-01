<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Tnews Core Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */

final class Tnews_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */

	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';


	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */

	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version

		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}


		// Add Plugin actions

		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );


        // Register widget scripts

		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ]);


		// Specific Register widget scripts

		// add_action( 'elementor/frontend/after_register_scripts', [ $this, 'tnews_regsiter_widget_scripts' ] );
		// add_action( 'elementor/frontend/before_register_scripts', [ $this, 'tnews_regsiter_widget_scripts' ] );


        // category register

		add_action( 'elementor/elements/categories_registered',[ $this, 'tnews_elementor_widget_categories' ] );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'tnews' ),
			'<strong>' . esc_html__( 'Tnews Core', 'tnews' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'tnews' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */

			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'tnews' ),
			'<strong>' . esc_html__( 'Tnews Core', 'tnews' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'tnews' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(

			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'tnews' ),
			'<strong>' . esc_html__( 'Tnews Core', 'tnews' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'tnews' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */

	public function init_widgets() {

		$widget_register = \Elementor\Plugin::instance()->widgets_manager;

		// Header Include file & Widget Register
		require_once( TNEWS_ADDONS . '/header/header.php' );
		$widget_register->register ( new \Tnews_Header() );

		// Include All Widget Files
		foreach($this->Tnews_Include_File() as $widget_file_name){
			require_once( TNEWS_ADDONS . '/widgets/tnews-'."$widget_file_name".'.php' );
		}

		// All Widget Register
		foreach($this->Tnews_Register_File() as $name){
			$widget_register->register ( $name );
		}
		
	}

	public function Tnews_Include_File(){
		return [
			'section-title', 
			'button', 

			'blog',   
			'blog-overlay',   
			'blog-slider',  
			'blog-tab',  
			'blog-filter', 
			'blog-banner', 
			'blog-video', 

			'menu-select', 
			'newsletter', 
			'gallery', 
			'about-info', 
			'news-ticker',
			'group-image',
			'counterup',
			'timeline',
			'custom-cate',
			'team',
			'contact-form',
			'contact-info',

		];
	}

	public function Tnews_Register_File(){
		return [
			new \Tnews_Section_Title(),
			new \Tnews_Button(),

			new \Tnews_Blog(),
			new \Tnews_Overlay_Blog(),
			new \Tnews_Blog_Slider(),
			new \Tnews_Blog_Tab(),
			new \Tnews_Blog_Filter(),
			new \Tnews_Blog_Banner(),
			new \Tnews_Blog_Video(),

			new \Tnews_Menu(),
			new \tnews_Newsletter(),
			new \Tnews_Gallery(),
			new \Tnews_About_Info(),
			new \Tnews_News_Ticker() ,
			new \Tnews_Group_Image() ,
			new \Tnews_Counterup() ,
			new \Tnews_Timeline() ,
			new \Tnews_Custom_Category() ,
			new \Tnews_Team() ,
			new \Tnews_Contact_Form() ,
			new \Tnews_Contact_Info() ,

		];
	}

    public function widget_scripts() {

        wp_enqueue_script(
            'tnews-frontend-script',
            TNEWS_PLUGDIRURI . 'assets/js/tnews-frontend.js',
            array('jquery'),
            false,
            true
		);

	}


	// public function tnews_regsiter_widget_scripts( ) {

	// 	wp_register_script(
 //            'tnews-tilt',
 //            TNEWS_PLUGDIRURI . 'assets/js/tilt.jquery.min.js',
 //            array('jquery'),
 //            false,
 //            true
	// 	);
	// }


    function tnews_elementor_widget_categories( $elements_manager ) {

        $elements_manager->add_category(
            'tnews',
            [
                'title' => __( 'Tnews', 'tnews' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );

        $elements_manager->add_category(
            'tnews_footer_elements',
            [
                'title' => __( 'Tnews Footer Elements', 'tnews' ),
                'icon' 	=> 'fa fa-plug',
            ]
		);

		$elements_manager->add_category(
            'tnews_header_elements',
            [
                'title' => __( 'Tnews Header Elements', 'tnews' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );
	}
}

Tnews_Extension::instance();