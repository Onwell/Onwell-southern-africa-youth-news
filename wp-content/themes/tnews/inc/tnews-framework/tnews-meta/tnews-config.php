<?php

/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

 /**
 * Only return default value if we don't have a post ID (in the 'post' query variable)
 *
 * @param  bool  $default On/Off (true/false)
 * @return mixed          Returns true or '', the blank default
 */
function tnews_set_checkbox_default_for_new_post( $default ) {
	return isset( $_GET['post'] ) ? '' : ( $default ? (string) $default : '' );
}

add_action( 'cmb2_admin_init', 'tnews_register_featured_metabox' );

function tnews_register_featured_metabox() {

	$prefix = '_tnews_';

    $tnews_post_meta = new_cmb2_box( array(
        'id'           => 'featured_metabox',
        'title'        => __( 'Post ( Featured & Favorite )', 'tnews' ),
        'object_types' => array( 'post' ),
        // Add other options as needed
    ) );

    $tnews_post_meta->add_field( array(
        'name' => __( 'Featured Post', 'tnews' ),
        'id'   => $prefix . 'featured_post',
        'type' => 'checkbox',
        // Add other options as needed
    ) );
    $tnews_post_meta->add_field( array(
        'name' => __( 'Favorite Post', 'tnews' ),
        'id'   => $prefix . 'favorite_post',
        'type' => 'checkbox',
        // Add other options as needed
    ) );
	
}

add_action( 'cmb2_admin_init', 'tnews_register_metabox' );

/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */

function tnews_register_metabox() {

	$prefix = '_tnews_';

	$prefixpage = '_tnewspage_';
  
	$tnews_post_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'blog_post_control',
		'title'         => esc_html__( 'Post Thumb Controller', 'tnews' ),
		'object_types'  => array( 'post' ), // Post type
		'closed'        => true
	) );

    $tnews_post_meta->add_field( array(
        'name' => esc_html__( 'Post Format Video', 'tnews' ),
        'desc' => esc_html__( 'Use This Field When Post Format Video', 'tnews' ),
        'id'   => $prefix . 'post_format_video',
        'type' => 'text_url',
    ) );
	$tnews_post_meta->add_field( array(
		'name' => esc_html__( 'Post Format Audio', 'tnews' ),
		'desc' => esc_html__( 'Use This Field When Post Format Audio', 'tnews' ),
		'id'   => $prefix . 'post_format_audio',
        'type' => 'oembed',
    ) );
	$tnews_post_meta->add_field( array(
		'name' => esc_html__( 'Post Thumbnail For Slider', 'tnews' ),
		'desc' => esc_html__( 'Use This Field When You Want A Slider In Post Thumbnail', 'tnews' ),
		'id'   => $prefix . 'post_format_slider',
        'type' => 'file_list',
    ) );
	
	$tnews_page_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'page_meta_section',
		'title'         => esc_html__( 'Page Meta', 'tnews' ),
		'object_types'  => array( 'page', 'tnews_event' ), // Post type
        'closed'        => true
    ) );

    $tnews_page_meta->add_field( array(
		'name' => esc_html__( 'Page Breadcrumb Area', 'tnews' ),
		'desc' => esc_html__( 'check to display page breadcrumb area.', 'tnews' ),
		'id'   => $prefix . 'page_breadcrumb_area',
        'type' => 'select',
        'default' => '1',
        'options'   => array(
            '1'   => esc_html__('Show','tnews'),
            '2'     => esc_html__('Hide','tnews'),
        )
    ) );


    $tnews_page_meta->add_field( array(
		'name' => esc_html__( 'Page Breadcrumb Settings', 'tnews' ),
		'id'   => $prefix . 'page_breadcrumb_settings',
        'type' => 'select',
        'default'   => 'global',
        'options'   => array(
            'global'   => esc_html__('Global Settings','tnews'),
            'page'     => esc_html__('Page Settings','tnews'),
        )
	) );

    $tnews_page_meta->add_field( array(
        'name'    => esc_html__( 'Breadcumb Image', 'tnews' ),
        'desc'    => esc_html__( 'Upload an image or enter an URL.', 'tnews' ),
        'id'      => $prefix . 'breadcumb_image',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => __( 'Add File', 'tnews' ) // Change upload button text. Default: "Add or Upload File"
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ) );

    $tnews_page_meta->add_field( array(
		'name' => esc_html__( 'Page Title', 'tnews' ),
		'desc' => esc_html__( 'check to display Page Title.', 'tnews' ),
		'id'   => $prefix . 'page_title',
        'type' => 'select',
        'default' => '1',
        'options'   => array(
            '1'   => esc_html__('Show','tnews'),
            '2'     => esc_html__('Hide','tnews'),
        )
	) );

    $tnews_page_meta->add_field( array(
		'name' => esc_html__( 'Page Title Settings', 'tnews' ),
		'id'   => $prefix . 'page_title_settings',
        'type' => 'select',
        'options'   => array(
            'default'  => esc_html__('Default Title','tnews'),
            'custom'  => esc_html__('Custom Title','tnews'),
        ),
        'default'   => 'default'
    ) );

    $tnews_page_meta->add_field( array(
		'name' => esc_html__( 'Custom Page Title', 'tnews' ),
		'id'   => $prefix . 'custom_page_title',
        'type' => 'text'
    ) );

    $tnews_page_meta->add_field( array(
		'name' => esc_html__( 'Breadcrumb', 'tnews' ),
		'desc' => esc_html__( 'Select Show to display breadcrumb area', 'tnews' ),
		'id'   => $prefix . 'page_breadcrumb_trigger',
        'type' => 'switch_btn',
        'default' => tnews_set_checkbox_default_for_new_post( true ),
    ) );

    $tnews_layout_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'page_layout_section',
		'title'         => esc_html__( 'Page Layout', 'tnews' ),
        'context' 		=> 'side',
        'priority' 		=> 'high',
        'object_types'  => array( 'page' ), // Post type
        'closed'        => true
	) );

	$tnews_layout_meta->add_field( array(
		'desc'       => esc_html__( 'Set page layout container,container fluid,fullwidth or both. It\'s work only in template builder page.', 'tnews' ),
		'id'         => $prefix . 'custom_page_layout',
		'type'       => 'radio',
        'options' => array(
            '1' => esc_html__( 'Container', 'tnews' ),
            '2' => esc_html__( 'Container Fluid', 'tnews' ),
            '3' => esc_html__( 'Fullwidth', 'tnews' ),
        ),
	) );

	// code for body class//

    $tnews_layout_meta->add_field( array(
	'name' => esc_html__( 'Insert Your Body Class', 'tnews' ),
	'id'   => $prefix . 'custom_body_class',
	'type' => 'text'
    ) );

}

add_action( 'cmb2_admin_init', 'tnews_register_taxonomy_metabox' );
/**
 * Hook in and add a metabox to add fields to taxonomy terms
 */
function tnews_register_taxonomy_metabox() {

    $prefix = '_tnews_';
	/**
	 * Metabox to add fields to categories and tags
	 */
	$tnews_term_meta = new_cmb2_box( array(
		'id'               => $prefix.'term_edit',
		'title'            => esc_html__( 'Category Metabox', 'tnews' ),
		'object_types'     => array( 'term' ),
		'taxonomies'       => array( 'category'),
	) );
	$tnews_term_meta->add_field( array(
		'name'     => esc_html__( 'Extra Info', 'tnews' ),
		'id'       => $prefix.'term_extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );
    $tnews_term_meta->add_field( array(
        'name'    => esc_html__( 'Category BG Color', 'tnews' ),
        'desc' => esc_html__( 'Set Category Background Color', 'tnews' ),
        'id'      => $prefix.'term_bg_color',
        'type'    => 'colorpicker',
        'default' => '#4E4BD0',
    ) );
    $tnews_term_meta->add_field( array(
        'name' => esc_html__( 'Category Icon', 'tnews' ),
		'desc' => esc_html__( 'Set Category Icon Image', 'tnews' ),
        'id'      => $prefix.'term_icon',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false,
        ),
        'preview_size' => 'large',
    ) );
    $tnews_term_meta->add_field( array(
        'name' => esc_html__( 'Category Background Image', 'tnews' ),
		'desc' => esc_html__( 'Set Category Background Image', 'tnews' ),
        'id'      => $prefix.'term_avatar',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false,
        ),
        'preview_size' => 'large',
    ) );


	/**
	 * Metabox for the user profile screen
	 */
	$tnews_user = new_cmb2_box( array(
		'id'               => $prefix.'user_edit',
		'title'            => esc_html__( 'User Profile Metabox', 'tnews' ), // Doesn't output for user boxes
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta as post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );
    $tnews_user->add_field( array(
		'name' => esc_html__( 'Author Designation', 'tnews' ),
		'desc' => esc_html__( 'Use This Field When Author Designation', 'tnews' ),
		'id'   => $prefix . 'author_desig',
        'type' => 'text',
    ) );
    $tnews_user->add_field( array(
		'name' => esc_html__( 'Author Phone', 'tnews' ),
		'desc' => esc_html__( 'Use This Field When Author Phone', 'tnews' ),
		'id'   => $prefix . 'author_phone',
        'type' => 'text',
    ) );
	$tnews_user->add_field( array(
		'name'     => esc_html__( 'Social Profile', 'tnews' ),
		'id'       => $prefix.'user_extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$group_field_id = $tnews_user->add_field( array(
        'id'          => $prefix .'social_profile_group',
        'type'        => 'group',
        'description' => __( 'Social Profile', 'tnews' ),
        'options'     => array(
            'group_title'       => __( 'Social Profile {#}', 'tnews' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __( 'Add Another Social Profile', 'tnews' ),
            'remove_button'     => __( 'Remove Social Profile', 'tnews' ),
            'closed'         => true
        ),
    ) );

    $tnews_user->add_group_field( $group_field_id, array(
        'name'        => __( 'Icon Class', 'tnews' ),
        'id'          => $prefix .'social_profile_icon',
        'type'        => 'text', // This field type
    ) );

    $tnews_user->add_group_field( $group_field_id, array(
        'desc'       => esc_html__( 'Set social profile link.', 'tnews' ),
        'id'         => $prefix . 'lawyer_social_profile_link',
        'name'       => esc_html__( 'Social Profile link', 'tnews' ),
        'type'       => 'text'
    ) );
}
