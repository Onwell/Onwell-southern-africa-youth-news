<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "tnews_opt";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }


    $alowhtml = array(
        'p' => array(
            'class' => array()
        ),
        'span' => array()
    );


    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        // 'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Tnews Options', 'tnews' ),
        'page_title'           => esc_html__( 'Tnews Options', 'tnews' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );


    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'tnews' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'tnews' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'tnews' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'tnews' )
        )
    );
    Redux::set_help_tab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'tnews' );
    Redux::set_help_sidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */


    // -> START General Fields

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'tnews' ),
        'id'               => 'tnews_general',
        'customizer_width' => '450px',
        'icon'             => 'el el-cog',
        'fields'           => array(
            array(
                'id'    => 'theme_2',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Global Color', 'tnews'),
            ),
            array(
                'id'       => 'tnews_theme_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Theme Color', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_heading_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Heading Color (H1-H6)', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_body_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Body Color (Default Text Color)', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_link_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Links Color', 'tnews' ), 
                'output'   => array( 'color'    =>  'a' ),
            ),
 
        )

    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Typography', 'tnews' ),
        'id'               => 'tnews_typography',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'tnews_theme_body_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'Body Font Family', 'tnews' ),
                'google'      => true, 
                'font-size' => false,
                'line-height' => false,
                'subsets' => false,
                'text-align' => false,
                'color' => false,
                'font-style' => false,
                'font-weight' => false,
                'output'      => array(''),
            ),
            array(
                'id'       => 'tnews_theme_heading_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'Heading Font Family', 'tnews' ),
                'google'      => true, 
                'font-size' => false,
                'line-height' => false,
                'subsets' => false,
                'text-align' => false,
                'color' => false,
                'font-style' => false,
                'font-weight' => false,
                'output'      => array(''),
            ),
            array(
                'id'    => 'info_11',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Heading Fonts', 'tnews'),
            ),
            array(
                'id'       => 'tnews_theme_h1_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H1 Font', 'tnews' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h1'),
            ),
            array(
                'id'       => 'tnews_theme_h2_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H2 Font', 'tnews' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h2'),
            ),
            array(
                'id'       => 'tnews_theme_h3_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H3 Font', 'tnews' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h3'),
            ),
            array(
                'id'       => 'tnews_theme_h4_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H4 Font', 'tnews' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h4'),
            ),
            array(
                'id'       => 'tnews_theme_h5_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H5 Font', 'tnews' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h5'),
            ),
            array(
                'id'       => 'tnews_theme_h6_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H6 Font', 'tnews' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h6'),
            ),
            array(
                'id'    => 'info_22',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Paragraph Fonts', 'tnews'),
            ),
            array(
                'id'       => 'tnews_theme_p_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'P Font', 'tnews' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('p'),
            ),
           
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Back To Top', 'tnews' ),
        'id'               => 'tnews_backtotop',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'tnews_display_bcktotop',
                'type'     => 'switch',
                'title'    => esc_html__( 'Back To Top Button', 'tnews' ),
                'subtitle' => esc_html__( 'Switch On to Display back to top button.', 'tnews' ),
                'default'  => true,
                'on'       => esc_html__( 'Enabled', 'tnews' ),
                'off'      => esc_html__( 'Disabled', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_bcktotop_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Background Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Back to top button Background Color.', 'tnews' ),
                'required' => array('tnews_display_bcktotop','equals','1'),
                'output'   => array( 'background-color' =>'.scroll-top svg' ),
            ),
            array(
                'id'       => 'tnews_bcktotop_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Back to top Icon Color.', 'tnews' ),
                'required' => array('tnews_display_bcktotop','equals','1'),
                'output'   => array( '--theme-color' =>'.scroll-top:after' ),
            ),
            array(
                'id'       => 'tnews_bcktotop_color2',
                'type'     => 'color',
                'title'    => esc_html__( 'Circle Line Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Back to top Circle Line Color.', 'tnews' ),
                'required' => array('tnews_display_bcktotop','equals','1'),
                'output'   => array( '--theme-color' =>'.scroll-top .progress-circle path' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Preloader', 'tnews' ),
        'id'               => 'tnews_preloader',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'tnews_display_preloader', 
                'type'     => 'switch',
                'title'    => esc_html__( 'Preloader', 'tnews' ),
                'subtitle' => esc_html__( 'Switch Enabled to Display Preloader.', 'tnews' ),
                'default'  => true,
                'on'       => esc_html__('Enabled','tnews'),
                'off'      => esc_html__('Disabled','tnews'),
            ),
        )
    ));

    /* Admin Lebel Fields */
    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Admin Label', 'tnews' ),
        'id'                => 'tnews_admin_label',
        'customizer_width'  => '450px',
        'subsection'        => true,
        'fields'            => array(
            array(
                'title'     => esc_html__( 'Admin Login Logo', 'tnews' ),
                'subtitle'  => esc_html__( 'It belongs to the back-end of your website to log-in to admin panel.', 'tnews' ),
                'id'        => 'tnews_admin_login_logo',
                'type'      => 'media',
            ),
            array(
                'title'     => esc_html__( 'Custom CSS For admin', 'tnews' ),
                'subtitle'  => esc_html__( 'Any CSS your write here will run in admin.', 'tnews' ),
                'id'        => 'tnews_theme_admin_custom_css',
                'type'      => 'ace_editor',
                'mode'      => 'css',
                'theme'     => 'chrome',
                'full_width'=> true,
            ),
        ),
    ) );


    /* End General Fields */

    // -> START Popup Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Popup', 'tnews' ),
        'id'               => 'tnews_popup',
        'customizer_width' => '450px',
        'icon'             => 'el el-gift',
        'fields'           => array(
            array(
                'id'       => 'tnews_display__popup',
                'type'     => 'switch',
                'title'    => esc_html__( 'Subscribe Popup', 'tnews' ),
                'subtitle' => esc_html__( 'Switch On to Display subscribe popup.', 'tnews' ),
                'default'  => false,
                'on'       => esc_html__( 'Enabled', 'tnews' ),
                'off'      => esc_html__( 'Disabled', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_popup_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Title', 'tnews' ),
                'subtitle' => esc_html__( 'Set your popup title', 'tnews' ),
                'default'  => esc_html__( 'Subscribe', 'tnews' ),
                'required' => array('tnews_display_popup','equals','1'),
            ),
            array(
                'id'       => 'tnews_popup_desc',
                'type'     => 'text',
                'title'    => esc_html__( 'Description', 'tnews' ),
                'subtitle' => esc_html__( 'Set your popup description', 'tnews' ),
                'default'  => esc_html__( 'Sign up to get update about us. Don\'t be hasitate your email is safe.', 'tnews' ),
                'required' => array('tnews_display_popup','equals','1'),
            ),
            array(
                'id'        => 'tnews_popup_image',
                'title'     => esc_html__( 'Popup Image', 'tnews' ),
                'subtitle'  => esc_html__( 'Set your pupup image', 'tnews' ),
                'type'      => 'media',
                'required' => array('tnews_display_popup','equals','1'),
            ),
            array(
                'id'       => 'tnews_popup_placeholder',
                'type'     => 'text',
                'title'    => esc_html__( 'Placeholder Text', 'tnews' ),
                'subtitle' => esc_html__( 'Set your popup placeholder text', 'tnews' ),
                'default'  => esc_html__( 'Enter Email', 'tnews' ),
                'required' => array('tnews_display_popup','equals','1'),
            ),
            array(
                'id'       => 'tnews_popup_note',
                'type'     => 'text',
                'title'    => esc_html__( 'Check Box Text', 'tnews' ),
                'subtitle' => esc_html__( 'Set your popup check box text', 'tnews' ),
                'default'  => esc_html__( 'I don\'t want to see this popup again.', 'tnews' ),
                'required' => array('tnews_display_popup','equals','1'),
            ),
            array(
                'id'    => 'info_9',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Popup Style', 'tnews'),
            ),
            array(
                'id'       => 'tnews_popup_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Background Color', 'tnews' ),
                'output'   => array( 'background-color'    =>  '.popup-subscribe' ),
            ),
            array(
                'id'       => 'tnews_popup_title_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Title Color', 'tnews' ),
                'output'   => array( 'color'    =>  '.popup-subscribe .widget_title' ),
            ),
            array(
                'id'       => 'tnews_popup_desc_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Description Color', 'tnews' ),
                'output'   => array( 'color'    =>  '.popup-subscribe .footer-text' ),
            ),
            array(
                'id'       => 'tnews_popup_checkbox_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Note Color', 'tnews' ),
                'output'   => array( 'color'    =>  '.popup-subscribe .note label' ),
            ),
        )

    ) );

    
    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header', 'tnews' ),
        'id'               => 'tnews_header',
        'customizer_width' => '400px',
        'icon'             => 'el el-credit-card',
        'fields'           => array(
            array(
                'id'       => 'tnews_header_options',
                'type'     => 'button_set',
                'default'  => '1',
                'options'  => array(
                    "1"   => esc_html__('Prebuilt','tnews'),
                    "2"      => esc_html__('Header Builder','tnews'),
                ),
                'title'    => esc_html__( 'Header Options', 'tnews' ),
                'subtitle' => esc_html__( 'Select header options.', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_header_select_options',
                'type'     => 'select',
                'data'     => 'posts',
                'args'     => array(
                    'post_type'     => 'tnews_header'
                ),
                'title'    => esc_html__( 'Header', 'tnews' ),
                'subtitle' => esc_html__( 'Select header.', 'tnews' ),
                'required' => array( 'tnews_header_options', 'equals', '2' )
            ),
            array(
                'id'       => 'tnews_header_topbar_switcher',
                'type'     => 'switch',
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'tnews' ),
                'off'      => esc_html__( 'Hide', 'tnews' ),
                'title'    => esc_html__( 'Header Topbar?', 'tnews' ),
                'subtitle' => esc_html__( 'Control Header Topbar By Show Or Hide System.', 'tnews'),
                'required' => array( 'tnews_header_options', 'equals', '1' )
            ),    
            array(
                'id'          => 'tnews_custom_menu',
                'type'        => 'slides',
                'title'       => esc_html__('Custom Menu', 'tnews'),
                'subtitle'    => esc_html__('Add menu.', 'tnews'),
                'show'        => array(
                    'title'          => true,
                    'description'    => false,
                    'progress'       => false,
                    'facts-number'   => false,
                    'facts-title1'   => false,
                    'facts-title2'   => false,
                    'facts-number-2' => false,
                    'facts-title3'   => false,
                    'facts-number-3' => false,
                    'url'            => true,
                    'project-button' => false,
                    'image_upload'   => false,
                ),
                'placeholder'   => array(
                    'title'         => esc_html__( 'Menu Name', 'tnews' ),
                    'url'           => esc_html__( '#', 'tnews' ),
                ),
                'required' => array( 'tnews_header_topbar_switcher', 'equals', '1' ),
            ),
            array(
                'id'       => 'tnews_color_mode_box_switcher',
                'type'     => 'switch',
                'default'  => 1,
                'on'       => esc_html__( 'On', 'tnews' ),
                'off'      => esc_html__( 'Off', 'tnews' ),
                'title'    => esc_html__( 'Color Mode Box?', 'tnews' ),
                'subtitle' => esc_html__( 'Click Show To Display Color mode box?', 'tnews'),
                'required' => array( 'tnews_header_topbar_switcher', 'equals', '1' )
            ),  
            array(
                'id'       => 'tnews_color_mode_switcher',
                'type'     => 'switch',
                'default'  => 1,
                'on'       => esc_html__( 'Light Mode', 'tnews' ),
                'off'      => esc_html__( 'Dark Mode', 'tnews' ),
                'title'    => esc_html__( 'Site Color Mode?', 'tnews' ),
                'subtitle' => esc_html__( 'Click Show To Change Color Mode Dark or Light?', 'tnews'),
                'required' => array( 'tnews_header_topbar_switcher', 'equals', '1' )
            ),  
            array(
                'id'       => 'tnews_header_social_switcher',
                'type'     => 'switch',
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'tnews' ),
                'off'      => esc_html__( 'Hide', 'tnews' ),
                'title'    => esc_html__( 'Header Social Icon?', 'tnews' ),
                'subtitle' => esc_html__( 'Click Show To Display Social Icon?', 'tnews'),
                'required' => array( 'tnews_header_topbar_switcher', 'equals', '1' )
            ),  
            array(
                'id'       => 'tnews_btn_switcher',
                'type'     => 'switch',
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'tnews' ),
                'off'      => esc_html__( 'Hide', 'tnews' ),
                'title'    => esc_html__( 'Login/Register Show?', 'tnews' ),
                'subtitle' => esc_html__( 'Click Show To Display Buttion?', 'tnews'),
                'required' => array( 'tnews_header_options', 'equals', '1' ),
            ),
            array(
                'id'       => 'tnews_btn_text',
                'type'     => 'text',
                'validate' => 'html',
                'default'  => esc_html__( 'Login / register', 'tnews' ),
                'title'    => esc_html__( 'Button Text', 'tnews' ),
                'subtitle' => esc_html__( 'Set Button Text', 'tnews' ),
                'required' => array( 
                    array('tnews_btn_switcher','equals','1') 
                )
            ),
            array(
                'id'    => 'info_1',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Header Bottom', 'tnews'),
            ),
            array(
                'id'       => 'tnews_header_search_switcher',
                'type'     => 'switch',
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'tnews' ),
                'off'      => esc_html__( 'Hide', 'tnews' ),
                'title'    => esc_html__( 'Show Search Icon?', 'tnews' ),
                'subtitle' => esc_html__( 'Click Show To Display Search Icon?', 'tnews'),
                'required' => array( 'tnews_header_options', 'equals', '1' )
            ),
            array(
                'id'       => 'tnews_header_cart_switcher',
                'type'     => 'switch',
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'tnews' ),
                'off'      => esc_html__( 'Hide', 'tnews' ),
                'title'    => esc_html__( 'Show Cart Icon?', 'tnews' ),
                'subtitle' => esc_html__( 'Click Show To Display Cart Icon?', 'tnews'),
                'required' => array( 'tnews_header_options', 'equals', '1' ),
            ),
            array(
                'id'       => 'tnews_header_offcanvas_switcher',
                'type'     => 'switch',
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'tnews' ),
                'off'      => esc_html__( 'Hide', 'tnews' ),
                'title'    => esc_html__( 'Show Offcanvas Icon?', 'tnews' ),
                'subtitle' => esc_html__( 'Click Show To Display Offcanvas Icon?', 'tnews'),
                'required' => array( 'tnews_header_options', 'equals', '1' ),
            ),
          
        ),
    ) );
    // -> END Basic Fields

    // -> START Header Logo
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header Logo', 'tnews' ),
        'id'               => 'tnews_header_logo_option',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'tnews_site_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Logo', 'tnews' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload your site logo for header ( recommendation png format ).', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_site_logo2',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'White Logo', 'tnews' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload your site logo for header ( recommendation png format ).', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_site_logo_dimensions',
                'type'     => 'dimensions',
                'units'    => array('px'),
                'title'    => esc_html__('Logo Dimensions (Width/Height).', 'tnews'),
                'output'   => array('.header-logo .logo img'),
                'subtitle' => esc_html__('Set logo dimensions to choose width, height, and unit.', 'tnews'),
            ),
            array(
                'id'       => 'tnews_site_logomargin_dimensions',
                'type'     => 'spacing',
                'mode'     => 'margin',
                'output'   => array('.header-logo .logo img'),
                'units_extended' => 'false',
                'units'    => array('px'),
                'title'    => esc_html__('Logo Top and Bottom Margin.', 'tnews'),
                'left'     => false,
                'right'    => false,
                'subtitle' => esc_html__('Set logo top and bottom margin.', 'tnews'),
                'default'            => array(
                    'units'           => 'px'
                )
            ),
            array(
                'id'       => 'tnews_text_title',
                'type'     => 'text',
                'validate' => 'html',
                'title'    => esc_html__( 'Text Logo', 'tnews' ),
                'subtitle' => esc_html__( 'Write your logo text use as logo ( You can use span tag for text color ).', 'tnews' ),
            )
        )
    ) );
    // -> End Header Logo

     // -> START Header Logo
     Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header Ads', 'tnews' ),
        'id'               => 'tnews_header_ads_option',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'tnews_ads_img',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Header Ads Image', 'tnews' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload your ads image for header.', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_ads__url',
                'type'     => 'text',
                'default'  => esc_html__( '#', 'tnews' ),
                'title'    => esc_html__( 'Ads URL?', 'tnews' ),
                'subtitle' => esc_html__( 'Set Ads URL Here', 'tnews' ),
            ),
        )
    ) );
    // -> End Header Logo

    // -> START Header Menu
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header Style', 'tnews' ),
        'id'               => 'tnews_header_menu_option',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'    => 'info_32',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Navbar Sub-menu', 'tnews'),
            ),
            array(
                'id'       => 'tnews_menu_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Navbar Sub-menu Icon Hide/Show', 'tnews' ),
                'subtitle' => esc_html__( 'Hide / Show menu icon ( Default settings SHOW ).', 'tnews' ),
                'default'  => '1',
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
            array(
                'id'       => 'tnews_menu_icon_class',
                'type'     => 'text',
                'validate' => 'html',
                'default'  => esc_html__( 'f054', 'tnews' ),
                'title'    => esc_html__( 'Sub Menu Icon', 'tnews' ),
                'subtitle' => esc_html__( 'If you change icon need to use Font-Awesome Unicode icon ( Example: f0c9 | e00d ).', 'tnews' ),
                'required' => array( 'tnews_menu_icon', 'equals', '1' )
            ),
            array(
                'id'    => 'info_2',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Background', 'tnews'),
            ),
            array(
                'id'       => 'tnews_header_topbar_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Header Topbar Backgound', 'tnews' ),
                'subtitle' => esc_html__( 'Set Topbar Background Color', 'tnews' ),
                'output'   => array( 'background-color'    =>  '.prebuilt .header-top' ),
            ),
            array(
                'id'       => 'tnews_header_topbar_middle',
                'type'     => 'color',
                'title'    => esc_html__( 'Header Middle Backgound', 'tnews' ),
                'subtitle' => esc_html__( 'Set Topbar Background Color', 'tnews' ),
                'output'   => array( 'background-color'    =>  '.prebuilt .header-middle' ),
            ),
            array(
                'id'       => 'tnews_header_menu_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Header Bottom Backgound', 'tnews' ),
                'subtitle' => esc_html__( 'Set Bottom Background Color', 'tnews' ),
                'output'   => array( 'background-color'  =>  '.prebuilt .menu-area' ),
            ),
            array(
                'id'    => 'info_3',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Menu Style', 'tnews'),
            ),
            array(
                'id'       => 'tnews_header_menu_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Menu Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Menu Color', 'tnews' ),
                'output'   => array( 'color'    =>  '.prebuilt .main-menu>ul>li>a' ),
            ),
            array(
                'id'       => 'tnews_header_menu_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Menu Hover Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Menu Hover Color', 'tnews' ),
                'output'   => array( 'color'    =>  '.prebuilt .main-menu>ul>li>a:hover' ),
            ),
            array(
                'id'       => 'tnews_header_submenu_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Submenu Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Submenu Color', 'tnews' ),
                'output'   => array( 'color'    =>  '.prebuilt .main-menu ul.sub-menu li a' ),
            ),
            array(
                'id'       => 'tnews_header_submenu_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Submenu Hover Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Submenu Hover Color', 'tnews' ),
                'output'   => array( 'color'    =>  '.prebuilt .main-menu ul.sub-menu li a:hover' ),
            ),
            array(
                'id'       => 'tnews_header_submenu_icon_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Submenu Icon Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Icon Hover Color', 'tnews' ),
                'output'   => array( 'color'    =>  '.prebuilt .main-menu ul.sub-menu li a:before' ),
            ),


        )
    ) );
    // -> End Header Menu

     // -> START Mobile Menu
     Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Mobile Menu', 'tnews' ), 
        'id'               => 'tnews_mobile_menu_option',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'tnews_menu_menu_show',
                'type'     => 'switch',
                'title'    => esc_html__( 'Mobile Logo Hide/Show', 'tnews' ),
                'subtitle' => esc_html__( 'Hide / Show mobile menu logo ( Default settings SHOW ).', 'tnews' ),
                'default'  => '1',
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
            array(
                'id'       => 'tnews_mobile_logo', 
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Logo', 'tnews' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload your mobile logo for mobile menu ( recommendation png format ).', 'tnews' ),
                'required' => array( 
                    array('tnews_menu_menu_show','equals','1') 
                )
            ),
            array(
                'id'       => 'tnews_mobile_logo_dimensions',
                'type'     => 'dimensions',
                'units'    => array('px'),
                'title'    => esc_html__('Logo Dimensions (Width/Height).', 'tnews'),
                'output'   => array('.th-menu-wrapper .mobile-logo img'),
                'subtitle' => esc_html__('Set logo dimensions to choose width, height, and unit.', 'tnews'),
                'required' => array( 
                    array('tnews_menu_menu_show','equals','1') 
                )
            ),
            array(
                'id'       => 'tnews_mobile_menu_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Logo Background', 'tnews' ),
                'subtitle' => esc_html__( 'Set logo backgorund', 'tnews' ),
                'output'   => array( 'background-color'    =>  '.th-menu-wrapper .mobile-logo' ),
                'required' => array( 
                    array('tnews_menu_menu_show','equals','1') 
                )
            ),
    
        )
    ) );
    // -> End Mobile Menu


     // -> START Offcanvas Menu
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Offcanvas', 'tnews' ),
        'id'               => 'tnews_offcanvas_panel',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'tnews_offcanvas_panel_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Offcanvas Panel Background', 'tnews' ),
                'output'   => array('.sidemenu-wrapper .sidemenu-content'),
                'subtitle' => esc_html__( 'Set Offcanvas Panel Background Color', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_offcanvas_title_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Offcanvas Title Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Offcanvas Title color.', 'tnews' ),
                'output'   => array( '.sidemenu-content .widget_title' )
            ),
        )
    ) );
    // -> End Offcanvas

    // -> START Blog Page
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog', 'tnews' ),
        'id'         => 'tnews_blog_page',
        'icon'  => 'el el-blogger',
        'fields'     => array(

            array(
                'id'       => 'tnews_blog_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Layout', 'tnews' ),
                'subtitle' => esc_html__( 'Choose blog layout from here. If you use this option then you will able to change three type of blog layout ( Default Left Sidebar Layour ). ', 'tnews' ),
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','tnews'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','tnews'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'tnews_blog_grid',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Post Column', 'tnews' ),
                'subtitle' => esc_html__( 'Select your blog post column from here. If you use this option then you will able to select three type of blog post layout ( Default Two Column ).', 'tnews' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','tnews'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/1column.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','tnews'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/2column.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/3column.png' )
                    ),

                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'tnews_blog_page_title_switcher',
                'type'     => 'switch',
                'default'  => 1,
                'on'       => esc_html__('Show','tnews'),
                'off'      => esc_html__('Hide','tnews'),
                'title'    => esc_html__('Blog Page Title', 'tnews'),
                'subtitle' => esc_html__('Control blog page title show / hide. If you use this option then you will able to show / hide your blog page title ( Default Setting Show ).', 'tnews'),
            ),
            array(
                'id'       => 'tnews_blog_page_title_setting',
                'type'     => 'button_set',
                'title'    => esc_html__('Blog Page Title Setting', 'tnews'),
                'subtitle' => esc_html__('Control blog page title setting. If you use this option then you can able to show default or custom blog page title ( Default Blog ).', 'tnews'),
                'options'  => array(
                    "predefine"   => esc_html__('Default','tnews'),
                    "custom"      => esc_html__('Custom','tnews'),
                ),
                'default'  => 'predefine',
                'required' => array("tnews_blog_page_title_switcher","equals","1")
            ),
            array(
                'id'       => 'tnews_blog_page_custom_title',
                'type'     => 'text',
                'title'    => esc_html__('Blog Custom Title', 'tnews'),
                'subtitle' => esc_html__('Set blog page custom title form here. If you use this option then you will able to set your won title text.', 'tnews'),
                'required' => array('tnews_blog_page_title_setting','equals','custom')
            ),
            array(
                'id'            => 'tnews_blog_postExcerpt',
                'type'          => 'slider',
                'title'         => esc_html__('Blog Posts Excerpt', 'tnews'),
                'subtitle'      => esc_html__('Control the number of characters you want to show in the blog page for each post.. If you use this option then you can able to control your blog post characters from here ( Default show 10 ).', 'tnews'),
                "default"       => 46,
                "min"           => 0,
                "step"          => 1,
                "max"           => 100,
                'resolution'    => 1,
                'display_value' => 'text',
            ),
            array(
                'id'       => 'tnews_blog_readmore_setting',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Read More Text Setting', 'tnews' ),
                'subtitle' => esc_html__( 'Control read more text from here.', 'tnews' ),
                'options'  => array(
                    "default"   => esc_html__('Default','tnews'),
                    "custom"    => esc_html__('Custom','tnews'),
                ),
                'default'  => 'default',
            ),
            array(
                'id'       => 'tnews_blog_custom_readmore',
                'type'     => 'text',
                'title'    => esc_html__('Read More Text', 'tnews'),
                'subtitle' => esc_html__('Set read moer text here. If you use this option then you will able to set your won text.', 'tnews'),
                'required' => array('tnews_blog_readmore_setting','equals','custom')
            ),
            array(
                'id'    => 'info_3',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Title & Content Style', 'tnews'),
            ),
            array(
                'id'       => 'tnews_blog_title_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Title Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Blog Title Color.', 'tnews' ),
                'output'   => array( '--title-color' => '.th-blog .blog-title' ),
            ),
            array(
                'id'       => 'tnews_blog_title_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Title Hover Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Blog Title Hover Color.', 'tnews' ),
                'output'   => array( '--theme-color' => '.th-blog .blog-title a:hover' ),
            ),
            array(
                'id'       => 'tnews_blog_contant_color',
                'output'   => array( '.blog-content p'),
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Excerpt / Content Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Blog Excerpt / Content Color.', 'tnews' ),
            ),
            array(
                'id'    => 'info_4',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Button Style', 'tnews'),
            ),
            array(
                'id'       => 'tnews_blog_read_more_button_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Read More Button Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Read More Button Color.', 'tnews' ),
                'output'   => array( 'color' => '.th-blog .blog-content .th-btn' ),
            ),
            array(
                'id'       => 'tnews_blog_read_more_button_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Read More Button Background', 'tnews' ),
                'subtitle' => esc_html__( 'Set Read More Button Background Color.', 'tnews' ),
                'output'   => array( 'background-color' => '.th-blog .blog-content .th-btn' ),
            ),
            array(
                'id'       => 'tnews_blog_read_more_button_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Read More Button Hover Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Read More Button Hover Color.', 'tnews' ),
                'output'   => array( 'color' => '.th-blog .blog-content .th-btn:hover' ),
            ),
            array(
                'id'       => 'tnews_blog_read_more_button_hover_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Read More Button Hover Background', 'tnews' ),
                'subtitle' => esc_html__( 'Set Read More Button Hover Background Color.', 'tnews' ),
                'output'   => array( 'background-color' => '.th-blog .blog-content .th-btn:before' ),
            ),
            array(
                'id'    => 'info_5',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Pagination Style', 'tnews'),
            ),
            array(
                'id'       => 'tnews_blog_pagination_color',
                'output'   => array( '.th-pagination a'),
                'type'     => 'color',
                'title'    => esc_html__('Blog Pagination Color', 'tnews'),
                'subtitle' => esc_html__('Set Blog Pagination Color.', 'tnews'),
            ),
            array(
                'id'       => 'tnews_blog_pagination_bg_color',
                'output'   => array( 'background-color' => '.th-pagination a'),
                'type'     => 'color',
                'title'    => esc_html__('Blog Pagination Background', 'tnews'),
                'subtitle' => esc_html__('Set Blog Pagination Backgorund Color.', 'tnews'),
            ),
            array(
                'id'       => 'tnews_blog_pagination_hover_color',
                'output'   => array( '.th-pagination a:hover, .th-pagination a.active'),
                'type'     => 'color',
                'title'    => esc_html__('Blog Pagination Hover & Active Color', 'tnews'),
                'subtitle' => esc_html__('Set Blog Pagination Hover & Active Color.', 'tnews'),
            ),
            array(
                'id'       => 'tnews_blog_pagination_bg_hover_color',
                'output'   => array( '--theme-color' => '.th-pagination a:hover, .th-pagination a.active'),
                'type'     => 'color',
                'title'    => esc_html__('Blog Pagination Hover & Active Background', 'tnews'),
                'subtitle' => esc_html__('Set Blog Pagination Background Hover & Active Color.', 'tnews'),
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Single Blog Page', 'tnews' ),
        'id'         => 'tnews_post_detail_styles',
        'subsection' => true,
        'fields'     => array(

            array(
                'id'       => 'tnews_blog_single_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Layout', 'tnews' ),
                'subtitle' => esc_html__( 'Choose blog single page layout from here. If you use this option then you will able to change three type of blog single page layout ( Default Left Sidebar Layour ). ', 'tnews' ),
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','tnews'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','tnews'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'tnews_blog_single_layout',
                'type'     => 'image_select',
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('Single Blog 1','tnews'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/blog_post_style_1.jpg')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('Single Blog 2','tnews'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/blog_post_style_2.jpg')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('Single Blog 3','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/blog_post_style_3.jpg' )
                    ),
                    '4' => array(
                        'alt' => esc_attr__('Single Blog 4','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/blog_post_style_4.jpg' )
                    ),
                    '5' => array(
                        'alt' => esc_attr__('Single Blog 5','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/blog_post_style_5.jpg' )
                    ),

                ),
                'title'    => esc_html__( 'Blog Details Layout Style', 'tnews' ),
                'subtitle' => esc_html__( 'Select blog details layout style. If you use this option then you can able to change blog details layout style', 'tnews' ),
                'default'  => '1',
            ),

            array(
                'id'       => 'tnews_display_related_post',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Posts', 'tnews' ),
                'subtitle' => esc_html__( 'Switch On to Display Related Post.', 'tnews' ),
                'default'  => true,
                'on'        => esc_html__('Show','tnews'),
                'off'       => esc_html__('Hide','tnews'),
            ),
            array(
                'id'       => 'tnews_related_post_title',
                'type'     => 'text',
                'title'    => esc_html__('Related Post Title', 'tnews'),
                'subtitle' => esc_html__('This title will show in Related title.', 'tnews'),
                'default'  => esc_html__( 'Related Post', 'tnews' ),
                'required' => array( 
                    array('tnews_display_related_post','equals','1') 
                )
            ),
            array(
                'id'       => 'tnews_related_post_items',
                'type'     => 'select',
                'options'  => array(
                    '3'        => esc_html__('3 Items','tnews'),
                    '4'       => esc_html__('4 Items','tnews'),
                ),
                'title'    => esc_html__( 'Related Post Items', 'tnews' ),
                'subtitle' => esc_html__( 'Select related post items 3 or 4', 'tnews' ),
                'default'  => '3',
                'required' => array( 
                    array('tnews_display_related_post','equals','1') 
                )
            ),
            array(
                'id'       => 'tnews_related_post_title_count',
                'type'     => 'text',
                'title'    => esc_html__('Related Post Title Words Count', 'tnews'),
                'default'  => esc_html__( '5', 'tnews' ),
                'required' => array( 
                    array('tnews_display_related_post','equals','1') 
                )
            ),

            array(
                'id'       => 'tnews_post_details_title_position',
                'type'     => 'button_set',
                'default'  => 'below',
                'options'  => array(
                    'header'        => esc_html__('On Header','tnews'),
                    'below'         => esc_html__('Below Thumbnail','tnews'),
                ),
                'title'    => esc_html__('Blog Post Title Position', 'tnews'),
                'subtitle' => esc_html__('Control blog post title position from here.', 'tnews'),
            ),
            array(
                'id'       => 'tnews_post_details_custom_title',
                'type'     => 'text',
                'title'    => esc_html__('Blog Details Custom Title', 'tnews'),
                'subtitle' => esc_html__('This title will show in Breadcrumb title.', 'tnews'),
                'required' => array('tnews_post_details_title_position','equals','below')
            ),
            array(
                'id'       => 'tnews_display_post_print',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Print', 'tnews' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Print.', 'tnews' ),
                'default'  => true,
                'on'        => esc_html__('Show','tnews'),
                'off'       => esc_html__('Hide','tnews'),
            ),
            array(
                'id'       => 'tnews_display_post_email',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Author Email', 'tnews' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Author Email.', 'tnews' ),
                'default'  => true,
                'on'        => esc_html__('Show','tnews'),
                'off'       => esc_html__('Hide','tnews'),
            ),
            array(
                'id'       => 'tnews_display_post_likes',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Likes', 'tnews' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Likes.', 'tnews' ),
                'default'  => true,
                'on'        => esc_html__('Show','tnews'),
                'off'       => esc_html__('Hide','tnews'),
            ),
            array(
                'id'       => 'tnews_display_post_views',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Views', 'tnews' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Views.', 'tnews' ),
                'default'  => true,
                'on'        => esc_html__('Show','tnews'),
                'off'       => esc_html__('Hide','tnews'),
            ),
            array(
                'id'       => 'tnews_post_details_share_options',
                'type'     => 'switch',
                'title'    => esc_html__('Share Options', 'tnews'),
                'subtitle' => esc_html__('Control post share options from here. If you use this option then you will able to show or hide post share options.', 'tnews'),
                'on'        => esc_html__('Show','tnews'),
                'off'       => esc_html__('Hide','tnews'),
                'default'   => '0',
            ),
            array(
                'id'       => 'tnews_display_post_tags',
                'type'     => 'switch',
                'title'    => esc_html__( 'Tags', 'tnews' ),
                'subtitle' => esc_html__( 'Switch On to Display Tags.', 'tnews' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','tnews'),
                'off'       => esc_html__('Disabled','tnews'),
            ),
            array(
                'id'       => 'tnews_post_details_post_navigation',
                'type'     => 'switch',
                'title'    => esc_html__('Single Post Navigation', 'tnews'),
                'subtitle' => esc_html__('Switch On to Display Single Post Navigation Box', 'tnews'),
                'on'        => esc_html__('Show','tnews'),
                'off'       => esc_html__('Hide','tnews'),
                'default'   => '0',
            ),
            array(
                'id'       => 'tnews_post_details_author_box',
                'type'     => 'switch',
                'title'    => esc_html__('Single Post Author Box', 'tnews'),
                'subtitle' => esc_html__('Switch On to Display Single Post Author Box', 'tnews'),
                'on'        => esc_html__('Show','tnews'),
                'off'       => esc_html__('Hide','tnews'),
                'default'   => '0',
            ),
           
        )
    ));

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Archive Page', 'tnews' ),
        'id'         => 'tnews_archive_styles',
        'subsection' => true,
        'fields'     => array(

            array(
                'id'       => 'tnews_blog_archive_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Layout', 'tnews' ),
                'subtitle' => esc_html__( 'Choose blog single page layout from here. If you use this option then you will able to change three type of blog single page layout ( Default Left Sidebar Layour ). ', 'tnews' ),
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','tnews'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','tnews'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'tnews_archive_grid',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Post Column', 'tnews' ),
                'subtitle' => esc_html__( 'Select your blog post column from here. If you use this option then you will able to select three type of blog post layout ( Default Two Column ).', 'tnews' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','tnews'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/1column.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column','tnews'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/2column.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('3 Column','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/3column.png' )
                    ),
                    '4' => array(
                        'alt' => esc_attr__('4 Column','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/4column.png' )
                    ),

                ),
                'default'  => '4'
            ),
           
        )
    ));

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Meta Data', 'tnews' ),
        'id'         => 'tnews_common_meta_data',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'tnews_display_post_author',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post author', 'tnews' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Author.', 'tnews' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','tnews'),
                'off'       => esc_html__('Disabled','tnews'),
            ),
            array(
                'id'       => 'tnews_display_post_date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Date', 'tnews' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Date.', 'tnews' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','tnews'),
                'off'       => esc_html__('Disabled','tnews'),
            ),
            array(
                'id'       => 'tnews_display_post_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Comment', 'tnews' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Comment Number.', 'tnews' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','tnews'),
                'off'       => esc_html__('Disabled','tnews'),
            ),
            array(
                'id'       => 'tnews_display_post_read_time',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Read Time', 'tnews' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Read Time.', 'tnews' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','tnews'),
                'off'       => esc_html__('Disabled','tnews'),
            ),
            array(
                'id'       => 'tnews_display_post_cate',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Category', 'tnews' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Category.', 'tnews' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','tnews'),
                'off'       => esc_html__('Disabled','tnews'),
            ),
            array(
                'id'    => 'info_7',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Meta Style', 'tnews'),
            ),
            array(
                'id'       => 'tnews_blog_meta_icon_color',
                'output'   => array( '.blog-meta a i'),
                'type'     => 'color',
                'title'    => esc_html__('Blog Meta Icon Color', 'tnews'),
                'subtitle' => esc_html__('Set Blog Meta Icon Color.', 'tnews'),
            ),
            array(
                'id'       => 'tnews_blog_meta_text_color',
                'output'   => array( '.blog-meta a,.blog-meta span'),
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Meta Text Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Blog Meta Text Color.', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_blog_meta_text_hover_color',
                'output'   => array( '.blog-meta a:hover'),
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Meta Hover Text Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Blog Meta Hover Text Color.', 'tnews' ),
            ),
        )
    ));

    /* End blog Page */

    // -> START Page Option
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page & Breadcrumb', 'tnews' ),
        'id'         => 'tnews_page_page',
        'icon'  => 'el el-file',
        'fields'     => array(
            array(
                'id'       => 'tnews_page_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Select layout', 'tnews' ),
                'subtitle' => esc_html__( 'Choose your page layout. If you use this option then you will able to choose three type of page layout ( Default no sidebar ). ', 'tnews' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','tnews'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','tnews'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'tnews_page_layoutopt',
                'type'     => 'button_set',
                'title'    => esc_html__('Sidebar Settings', 'tnews'),
                'subtitle' => esc_html__('Set page sidebar. If you use this option then you will able to set three type of sidebar ( Default no sidebar ).', 'tnews'),
                //Must provide key => value pairs for options
                'options' => array(
                    '1' => esc_html__( 'Page Sidebar', 'tnews' ),
                    '2' => esc_html__( 'Blog Sidebar', 'tnews' )
                 ),
                'default' => '1',
                'required'  => array('tnews_page_sidebar','!=','1')
            ),
            array(
                'id'       => 'tnews_page_breadcumb_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Select Breadcumb layout', 'tnews' ),
                'subtitle' => esc_html__( 'Choose your page breadcumb layout. If you use this option then you will able to choose two type of page layout ( Default Only breadcumb menu). ', 'tnews' ),
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('No Title','tnews'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/breadcumb.jpg')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('With Title','tnews'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/breadcumb2.png')
                    ),
                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'tnews_page_title_switcher',
                'type'     => 'switch',
                'title'    => esc_html__('Title', 'tnews'),
                'subtitle' => esc_html__('Switch enabled to display page title. Fot this option you will able to show / hide page title.  Default setting Enabled', 'tnews'),
                'default'  => '1',
                'on'        => esc_html__('Enabled','tnews'),
                'off'       => esc_html__('Disabled','tnews'),
            ),
            array(
                'id'       => 'tnews_page_title_tag',
                'type'     => 'select',
                'options'  => array(
                    'h1'        => esc_html__('H1','tnews'),
                    'h2'        => esc_html__('H2','tnews'),
                    'h3'        => esc_html__('H3','tnews'),
                    'h4'        => esc_html__('H4','tnews'),
                    'h5'        => esc_html__('H5','tnews'),
                    'h6'        => esc_html__('H6','tnews'),
                ),
                'default'  => 'h1',
                'title'    => esc_html__( 'Title Tag', 'tnews' ),
                'subtitle' => esc_html__( 'Select page title tag. If you use this option then you can able to change title tag H1 - H6 ( Default tag H1 )', 'tnews' ),
                'required' => array("tnews_page_title_switcher","equals","1")
            ),
            array(
                'id'       => 'tnews_allHeader_title_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Title Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Title Color', 'tnews' ),
                'output'   => array( 'color' => '.breadcumb-title' ),
                'required' => array("tnews_page_title_switcher","equals","1")
            ),
            array(
                'id'       => 'tnews_allHeader_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Background', 'tnews' ),
                'subtitle' => esc_html__( 'Setting page header background. If you use this option then you will able to set Background Color, Background Image, Background Repeat, Background Size, Background Attachment, Background Position.', 'tnews' ),
                'output'   => array( 'background' => '.breadcumb-wrapper' ),
            ),
             array(
                'id'       => 'tnews_shoppage_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Background For Shop Pages', 'tnews' ),
                'output'   => array( 'background' => '.custom-woo-class' ),
            ),
            array(
                'id'       => 'tnews_archivepage_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Background For Archive Pages', 'tnews' ),
                'output'   => array( 'background' => '.custom-archive-class' ),
            ),
            array(
                'id'       => 'tnews_searchpage_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Background For Search Pages', 'tnews' ),
                'output'   => array( 'background' => '.custom-search-class' ),
            ),
            array(
                'id'       => 'tnews_errorpage_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Background For Error Pages', 'tnews' ),
                'output'   => array( 'background' => '.custom-error-class' ),
            ),
            array(
                'id'       => 'tnews_enable_breadcrumb',
                'type'     => 'switch',
                'title'    => esc_html__( 'Breadcrumb Hide/Show', 'tnews' ),
                'subtitle' => esc_html__( 'Hide / Show breadcrumb from all pages and posts ( Default settings hide ).', 'tnews' ),
                'default'  => '1',
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
            array(
                'id'    => 'info_8',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Breadcrumb Style', 'tnews'),
            ),
            array(
                'id'       => 'tnews_allHeader_breadcrumbtextcolor',
                'type'     => 'color',
                'title'    => esc_html__( 'Breadcrumb Color', 'tnews' ),
                'subtitle' => esc_html__( 'Choose page header breadcrumb text color here.If you user this option then you will able to set page breadcrumb color.', 'tnews' ),
                'required' => array("tnews_enable_breadcrumb","equals","1"),
                'output'   => array( 'color' => '.breadcumb-wrapper .breadcumb-content ul li a' ),
            ),
            array(
                'id'       => 'tnews_allHeader_breadcrumbtextactivecolor',
                'type'     => 'color',
                'title'    => esc_html__( 'Breadcrumb Active Color', 'tnews' ),
                'subtitle' => esc_html__( 'Choose page header breadcrumb text active color here.If you user this option then you will able to set page breadcrumb active color.', 'tnews' ),
                'required' => array( "tnews_enable_breadcrumb", "equals", "1" ),
                'output'   => array( 'color' => '.breadcumb-wrapper .breadcumb-content ul li:last-child' ),
            ),
            array(
                'id'       => 'tnews_allHeader_dividercolor',
                'type'     => 'color',
                'title'    => esc_html__( 'Breadcrumb Divider Color', 'tnews' ),
                'subtitle' => esc_html__( 'Choose breadcrumb divider color.', 'tnews' ),
                'required' => array( "tnews_enable_breadcrumb", "equals", "1" ),
                'output'   => array( 'color'=>'.breadcumb-wrapper .breadcumb-content ul li:after' ),
            ),
        ),
    ) );
    /* End Page option */

    // -> START 404 Page

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( '404 Page', 'tnews' ),
        'id'         => 'tnews_404_page',
        'icon'       => 'el el-ban-circle',
        'fields'     => array(
            array(
                'id'       => 'tnews_error_img',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Error Light Image', 'tnews' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload your error image ( recommendation png format ).', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_error_img2',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Error Dark Image', 'tnews' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload your error image ( recommendation png format ).', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_error_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Page Title', 'tnews' ),
                'subtitle' => esc_html__( 'Set Page title ', 'tnews' ),
                'default'  => esc_html__( 'Sorry! Page did not found', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_error_title_color',
                'type'     => 'color',
                'output'   => array( '.error-title' ),
                'title'    => esc_html__( 'Title Color', 'tnews' ),
                'subtitle' => esc_html__( 'Pick a subtitle color', 'tnews' ),
                'validate' => 'color'
            ), 
            array(
                'id'       => 'tnews_error_description',
                'type'     => 'text',
                'title'    => esc_html__( 'Page Description', 'tnews' ),
                'subtitle' => esc_html__( 'Set Page Subtitle ', 'tnews' ),
                'default'  => esc_html__( 'Unfortunately, something went wrong and this page does not exist. Try using the search or return to the previous page.', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_error_desc_color',
                'type'     => 'color',
                'output'   => array( '.error-text' ),
                'title'    => esc_html__( 'Description Color', 'tnews' ),
                'subtitle' => esc_html__( 'Pick a description color', 'tnews' ),
                'validate' => 'color'
            ),
            array(
                'id'       => 'tnews_error_btn_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Button Text', 'tnews' ),
                'subtitle' => esc_html__( 'Set Button Text ', 'tnews' ),
                'default'  => esc_html__( 'Return To Home', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_error_btn_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Color', 'tnews' ),
                'subtitle' => esc_html__( 'Button Color.', 'tnews' ),
                'output'   => array( 'color' => '.th-btn.error-btn' ),
            ),
            array(
                'id'       => 'tnews_error_btn_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Background', 'tnews' ),
                'subtitle' => esc_html__( 'Button Color.', 'tnews' ),
                'output'   => array( '--theme-color' => '.th-btn.error-btn' ),
            ),
            array(
                'id'       => 'tnews_error_btn_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Hover Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set Button Hover Color.', 'tnews' ),
                'output'   => array( 'color' => '.th-btn.error-btn:hover',  ),
            ),
            array(
                'id'       => 'tnews_error_btn_hover_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Hover Background', 'tnews' ),
                'subtitle' => esc_html__( 'Set Button Hover Color.', 'tnews' ),
                'output'   => array( '--title-color' => '.th-btn:before' ),
            ),
        ),
    ) );

    /* End 404 Page */
    // -> START Woo Page Option

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Woocommerce Page', 'tnews' ),
        'id'         => 'tnews_woo_page_page',
        'icon'  => 'el el-shopping-cart',
        'fields'     => array(
            array(
                'id'       => 'tnews_woo_shoppage_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Set Shop Page Sidebar.', 'tnews' ),
                'subtitle' => esc_html__( 'Choose shop page sidebar', 'tnews' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','tnews'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','tnews'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'tnews_woo_product_col',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Product Column', 'tnews' ),
                'subtitle' => esc_html__( 'Set your woocommerce product column.', 'tnews' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '2' => array(
                        'alt' => esc_attr__('2 Columns','tnews'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/2col.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('3 Columns','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/3col.png' )
                    ),
                    '4' => array(
                        'alt' => esc_attr__('4 Columns','tnews'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/4col.png')
                    ),
                    '5' => array(
                        'alt' => esc_attr__('5 Columns','tnews'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/5col.png')
                    ),
                    '6' => array(
                        'alt' => esc_attr__('6 Columns','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/6col.png' )
                    ),
                    '5' => array(
                        'alt' => esc_attr__('5 Columns','tnews'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/5col.png')
                    ),
                    '6' => array(
                        'alt' => esc_attr__('6 Columns','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/6col.png' )
                    ),),
                'default'  => '4'
            ),
            array(
                'id'       => 'tnews_woo_product_perpage',
                'type'     => 'text',
                'title'    => esc_html__( 'Product Per Page', 'tnews' ),
                'default' => '10'
            ),
            array(
                'id'       => 'tnews_woo_singlepage_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Product Single Page sidebar', 'tnews' ),
                'subtitle' => esc_html__( 'Choose product single page sidebar.', 'tnews' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','tnews'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','tnews'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'tnews_product_details_title_position',
                'type'     => 'button_set',
                'default'  => 'below',
                'options'  => array(
                    'header'        => esc_html__('On Header','tnews'),
                    'below'         => esc_html__('Below Thumbnail','tnews'),
                ),
                'title'    => esc_html__('Product Details Title Position', 'tnews'),
                'subtitle' => esc_html__('Control product details title position from here.', 'tnews'),
            ),
            array(
                'id'       => 'tnews_product_details_custom_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Product Details Title', 'tnews' ),
                'default'  => esc_html__( 'Shop Details', 'tnews' ),
                'required' => array('tnews_product_details_title_position','equals','below'),
            ),
            array(
                'id'       => 'tnews_product_details_custom_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Product Details Title', 'tnews' ),
                'default'  => esc_html__( 'Shop Details', 'tnews' ),
                'required' => array('tnews_product_details_title_position','equals','below'),
            ),
            array(
                'id'       => 'tnews_woo_relproduct_display',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related product Hide/Show', 'tnews' ),
                'subtitle' => esc_html__( 'Hide / Show related product in single page (Default Settings Show)', 'tnews' ),
                'default'  => '1',
                'on'       => esc_html__('Show','tnews'),
                'off'      => esc_html__('Hide','tnews')
            ),
            array(
                'id'       => 'tnews_woo_relproduct_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Related products Title', 'tnews' ),
                'default'  => esc_html__( 'Related products', 'tnews' ),
                'required' => array('tnews_woo_relproduct_display','equals',true)
            ),
            array(
                'id'       => 'tnews_woo_relproduct_slider', 
                'type'     => 'switch',
                'title'    => esc_html__( 'Related product Sldier On/Off', 'tnews' ),
                'subtitle' => esc_html__( 'Slider On/Off related product slider in single page (Default Settings Slider On)', 'tnews' ),
                'default'  => '1',
                'on'       => esc_html__('Slider On','tnews'),
                'off'      => esc_html__('Slider Off','tnews')
            ),
            array(
                'id'       => 'tnews_woo_relproduct_num',
                'type'     => 'text',
                'title'    => esc_html__( 'Related products number', 'tnews' ),
                'subtitle' => esc_html__( 'Set how many related products you want to show in single product page.', 'tnews' ),
                'default'  => 5,
                'required' => array('tnews_woo_relproduct_display','equals',true)
            ),

            array(
                'id'       => 'tnews_woo_related_product_col',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Related Product Column', 'tnews' ),
                'subtitle' => esc_html__( 'Set your woocommerce related product column. it works if slider is off', 'tnews' ),
                'required' => array('tnews_woo_relproduct_display','equals',true),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '6' => array(
                        'alt' => esc_attr__('2 Columns','tnews'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/2col.png')
                    ),
                    '4' => array(
                        'alt' => esc_attr__('3 Columns','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/3col.png' )
                    ),
                    '3' => array(
                        'alt' => esc_attr__('4 Columns','tnews'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/4col.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('6 Columns','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/6col.png' )
                    ),

                ),
                'default'  => '4'
            ),
            array(
                'id'       => 'tnews_woo_upsellproduct_display',
                'type'     => 'switch',
                'title'    => esc_html__( 'Upsell product Hide/Show', 'tnews' ),
                'subtitle' => esc_html__( 'Hide / Show upsell product in single page (Default Settings Show)', 'tnews' ),
                'default'  => '1',
                'on'       => esc_html__('Show','tnews'),
                'off'      => esc_html__('Hide','tnews'),
            ),
            array(
                'id'       => 'tnews_woo_upsellproduct_num',
                'type'     => 'text',
                'title'    => esc_html__( 'Upsells products number', 'tnews' ),
                'subtitle' => esc_html__( 'Set how many upsells products you want to show in single product page.', 'tnews' ),
                'default'  => 3,
                'required' => array('tnews_woo_upsellproduct_display','equals',true),
            ),

            array(
                'id'       => 'tnews_woo_upsell_product_col',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Upsells Product Column', 'tnews' ),
                'subtitle' => esc_html__( 'Set your woocommerce upsell product column.', 'tnews' ),
                'required' => array('tnews_woo_upsellproduct_display','equals',true),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '6' => array(
                        'alt' => esc_attr__('2 Columns','tnews'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/2col.png')
                    ),
                    '4' => array(
                        'alt' => esc_attr__('3 Columns','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/3col.png' )
                    ),
                    '3' => array(
                        'alt' => esc_attr__('4 Columns','tnews'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/4col.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('6 Columns','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/6col.png' )
                    ),

                ),
                'default'  => '4'
            ),
            array(
                'id'       => 'tnews_woo_crosssellproduct_display',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cross sell product Hide/Show', 'tnews' ),
                'subtitle' => esc_html__( 'Hide / Show cross sell product in single page (Default Settings Show)', 'tnews' ),
                'default'  => '1',
                'on'       => esc_html__( 'Show', 'tnews' ),
                'off'      => esc_html__( 'Hide', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_woo_crosssellproduct_num',
                'type'     => 'text',
                'title'    => esc_html__( 'Cross sell products number', 'tnews' ),
                'subtitle' => esc_html__( 'Set how many cross sell products you want to show in single product page.', 'tnews' ),
                'default'  => 3,
                'required' => array('tnews_woo_crosssellproduct_display','equals',true),
            ),

            array(
                'id'       => 'tnews_woo_crosssell_product_col',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Cross sell Product Column', 'tnews' ),
                'subtitle' => esc_html__( 'Set your woocommerce cross sell product column.', 'tnews' ),
                'required' => array( 'tnews_woo_crosssellproduct_display', 'equals', true ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '6' => array(
                        'alt' => esc_attr__('2 Columns','tnews'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/2col.png')
                    ),
                    '4' => array(
                        'alt' => esc_attr__('3 Columns','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/3col.png' )
                    ),
                    '3' => array(
                        'alt' => esc_attr__('4 Columns','tnews'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/4col.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('6 Columns','tnews'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/6col.png' )
                    ),

                ),
                'default'  => '4'
            ),
        ),
    ) );

    /* End Woo Page option */
    // -> START Gallery
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Gallery', 'tnews' ),
        'id'         => 'tnews_gallery_widget',
        'icon'       => 'el el-gift',
        'fields'     => array(
            array(
                'id'          => 'tnews_gallery_image_widget',
                'type'        => 'slides',
                'title'       => esc_html__('Add Gallery Image', 'tnews'),
                'subtitle'    => esc_html__('Add gallery Image and url.', 'tnews'),
                'show'        => array(
                    'title'          => false,
                    'description'    => false,
                    'progress'       => false,
                    'icon'           => false,
                    'facts-number'   => false,
                    'facts-title1'   => false,
                    'facts-title2'   => false,
                    'facts-number-2' => false,
                    'facts-title3'   => false,
                    'facts-number-3' => false,
                    'url'            => true,
                    'project-button' => false,
                    'image_upload'   => true,
                ),
            ),
        ),
    ) );
    // -> START Subscribe
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Subscribe', 'tnews' ),
        'id'         => 'tnews_subscribe_page',
        'icon'       => 'el el-eject',
        'fields'     => array(

            array(
                'id'       => 'tnews_subscribe_apikey',
                'type'     => 'text',
                'title'    => esc_html__( 'Mailchimp API Key', 'tnews' ),
                'subtitle' => esc_html__( 'Set mailchimp api key.', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_subscribe_listid',
                'type'     => 'text',
                'title'    => esc_html__( 'Mailchimp List ID', 'tnews' ),
                'subtitle' => esc_html__( 'Set mailchimp list id.', 'tnews' ),
            ),
        ),
    ) );

    /* End Subscribe */

    // -> START Social Media

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social', 'tnews' ),
        'id'         => 'tnews_social_media',
        'icon'      => 'el el-globe',
        'desc'      => esc_html__( 'Social', 'tnews' ),
        'fields'     => array(
            array(
                'id'          => 'tnews_social_links',
                'type'        => 'slides',
                'title'       => esc_html__('Social Profile Links', 'tnews'),
                'subtitle'    => esc_html__('Add social icon and url.', 'tnews'),
                'show'        => array(
                    'title'          => true,
                    'description'    => true,
                    'progress'       => false,
                    'facts-number'   => false,
                    'facts-title1'   => false,
                    'facts-title2'   => false,
                    'facts-number-2' => false,
                    'facts-title3'   => false,
                    'facts-number-3' => false,
                    'url'            => true,
                    'project-button' => false,
                    'image_upload'   => false,
                ),
                'placeholder'   => array(
                    'icon'          => esc_html__( 'Icon (example: fa fa-facebook) ','tnews'),
                    'title'         => esc_html__( 'Social Icon Class', 'tnews' ),
                    'description'   => esc_html__( 'Social Icon Title', 'tnews' ),
                ),
            ),
        ),
    ) );
    /* End social Media */


    // -> START Footer Media
    Redux::setSection( $opt_name , array(
       'title'            => esc_html__( 'Footer', 'tnews' ),
       'id'               => 'tnews_footer',
       'desc'             => esc_html__( 'tnews Footer', 'tnews' ),
       'customizer_width' => '400px',
       'icon'              => 'el el-photo',
   ) );

   Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Pre-built Footer / Footer Builder', 'tnews' ),
        'id'         => 'tnews_footer_section',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'tnews_footer_builder_trigger',
                'type'     => 'button_set',
                'default'  => 'prebuilt',
                'options'  => array(
                    'footer_builder'        => esc_html__('Footer Builder','tnews'),
                    'prebuilt'              => esc_html__('Pre-built Footer','tnews'),
                ),
                'title'    => esc_html__( 'Footer Builder', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_footer_builder_select',
                'type'     => 'select',
                'required' => array( 'tnews_footer_builder_trigger','equals','footer_builder'),
                'data'     => 'posts',
                'args'     => array(
                    'post_type'     => 'tnews_footerbuild'
                ),
                'on'       => esc_html__( 'Enabled', 'tnews' ),
                'off'      => esc_html__( 'Disable', 'tnews' ),
                'title'    => esc_html__( 'Select Footer', 'tnews' ),
                'subtitle' => esc_html__( 'First make your footer from footer custom types then select it from here.', 'tnews' ),
            ),
            array(
                'id'       => 'tnews_footerwidget_enable',
                'type'     => 'switch',
                'title'    => esc_html__( 'Footer Widget', 'tnews' ),
                'default'  => 1,
                'on'       => esc_html__( 'Enabled', 'tnews' ),
                'off'      => esc_html__( 'Disable', 'tnews' ),
                'required' => array( 'tnews_footer_builder_trigger','equals','prebuilt'),
            ),
            array(
                'id'       => 'tnews_footer_background',
                'type'     => 'background',
                'title'    => esc_html__( 'Footer Widget Background', 'tnews' ),
                'subtitle' => esc_html__( 'Set footer background.', 'tnews' ),
                'output'   => array( '.footer-layout4' ),
                'required' => array( 'tnews_footerwidget_enable','=','1' ),
            ),
            array(
                'id'       => 'tnews_footer_widget_title_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Widget Title Color', 'tnews' ),
                'required' => array('tnews_footerwidget_enable','=','1'),
                'output'   => array( '.footer-widget .widget_title' ),
            ),
            array(
                'id'       => 'tnews_footer_widget_anchor_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Widget Anchor Color', 'tnews' ),
                'required' => array('tnews_footerwidget_enable','=','1'),
                'output'   => array( '.footer-widget.widget_nav_menu a' ),
            ),
            array(
                'id'       => 'tnews_footer_widget_anchor_hov_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Widget Anchor Hover Color', 'tnews' ),
                'required' => array('tnews_footerwidget_enable','=','1'),
                'output'   => array( '--theme-color'    =>  '.footer-widget.widget_nav_menu a:hover' ),
            ),

        ),
    ) );


    // -> START Footer Bottom
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer Bottom', 'tnews' ),
        'id'         => 'tnews_footer_bottom',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'tnews_disable_footer_bottom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Footer Bottom?', 'tnews' ),
                'default'  => 1,
                'on'       => esc_html__('Enabled','tnews'),
                'off'      => esc_html__('Disable','tnews'),
                'required' => array('tnews_footer_builder_trigger','equals','prebuilt'),
            ),
            array(
                'id'       => 'tnews_footer_bottom_background2',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Bottom Background Color', 'tnews' ),
                'required' => array( 'tnews_disable_footer_bottom','=','1' ),
                'output'   => array( 'background-color'   =>   '.footer-wrapper .copyright-wrap' ),
            ),
            array(
                'id'       => 'tnews_copyright_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Copyright Text', 'tnews' ),
                'subtitle' => esc_html__( 'Add Copyright Text', 'tnews' ),
                'default'  => sprintf( 'Copyright <i class="fal fa-copyright"></i> %s By <a href="%s">%s</a>. All Rights Reserved.',date('Y'),esc_url('#'),__( 'Tnews.','tnews' ) ),
                'required' => array( 'tnews_disable_footer_bottom','equals','1' ),
            ),
            array(
                'id'       => 'tnews_footer_copyright_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Copyright Text Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set footer copyright text color', 'tnews' ),
                'required' => array( 'tnews_disable_footer_bottom','equals','1'),
                'output'   => array( '.footer-layout1 .copyright-wrap .copyright-text' ),
            ),
            array(
                'id'       => 'tnews_footer_copyright_acolor',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Copyright Ancor Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set footer copyright ancor color', 'tnews' ),
                'required' => array( 'tnews_disable_footer_bottom','equals','1'),
                'output'    => array('color' => '.copyright-wrap a, .copyright-wrap .footer-links ul li a')
            ),
            array(
                'id'       => 'tnews_footer_copyright_a_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Copyright Ancor Hover Color', 'tnews' ),
                'subtitle' => esc_html__( 'Set footer copyright ancor Hover color', 'tnews' ),
                'required' => array( 'tnews_disable_footer_bottom','equals','1'),
                'output'    => array('color' => '.copyright-wrap a:hover, .copyright-wrap .footer-links ul li a:hover')
            ), 

        )
    ));

    /* End Footer Media */

    // -> START Custom Css
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom Css', 'tnews' ),
        'id'         => 'tnews_custom_css_section',
        'icon'  => 'el el-css',
        'fields'     => array(
            array(
                'id'       => 'tnews_css_editor',
                'type'     => 'ace_editor',
                'title'    => esc_html__('CSS Code', 'tnews'),
                'subtitle' => esc_html__('Paste your CSS code here.', 'tnews'),
                'mode'     => 'css',
                'theme'    => 'monokai',
            )
        ),
    ) );

    /* End custom css */



    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'tnews' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'tnews' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'tnews' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }