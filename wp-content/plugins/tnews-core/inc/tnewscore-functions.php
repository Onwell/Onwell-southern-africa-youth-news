<?php

/**
 * @Packge     : Tnews
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

    // Block direct access

    if( ! defined( 'ABSPATH' ) ){

        exit();

    }

/**

 * Admin Custom Login Logo

 */

function tnews_custom_login_logo() {

    $logo = ! empty( tnews_opt( 'tnews_admin_login_logo', 'url' ) ) ? tnews_opt( 'tnews_admin_login_logo', 'url' ) : '' ;

    if( isset( $logo ) && ! empty( $logo ) ){

        echo '<style type="text/css">body.login div#login h1 a { background-image:url('.esc_url( $logo ).'); }</style>';
    }
}

add_action( 'login_enqueue_scripts', 'tnews_custom_login_logo' );

/**
* Admin Custom css
*/

add_action( 'admin_enqueue_scripts', 'tnews_admin_styles' );

function tnews_admin_styles() {

  if ( ! empty( $tnews_admin_custom_css ) ) {
        $tnews_admin_custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '    '), '', $tnews_admin_custom_css);
        echo '<style rel="stylesheet" id="tnews-admin-custom-css" >';
            echo esc_html( $tnews_admin_custom_css );
        echo '</style>';
    }
}

// share button code

 function tnews_social_sharing_buttons( ) {

    // Get page URL

    $URL        = get_permalink();
    $Sitetitle  = get_bloginfo('name');
    // Get page title

    $Title  = str_replace( ' ', '%20', get_the_title());

    // Construct sharing URL without using any script

    $twitterURL     = 'https://twitter.com/share?text='.esc_html( $Title ).'&url='.esc_url( $URL );
    $facebookURL    = 'https://www.facebook.com/sharer/sharer.php?u='.esc_url( $URL );
    $pinterest   = 'http://pinterest.com/pin/create/link/?url='.esc_url( $URL ).'&media='.esc_url(get_the_post_thumbnail_url()).'&description='.wp_kses_post(get_the_title());
    $linkedin       = 'https://www.linkedin.com/shareArticle?mini=true&url='.esc_url( $URL ).'&title='.esc_html( $Title );
    // Add sharing button at the end of page/page content

    $content = '';

    $content .= '<a href="'.esc_url( $facebookURL ).'" target="_blank"><i class="fab fa-facebook-f"></i></a>';
    $content .= '<a href="'. esc_url( $twitterURL ) .'" target="_blank"><i class="fab fa-twitter"></i></a>';
    $content .= '<a href="'.esc_url( $linkedin ).'" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
    $content .= '<a href="'.esc_url( $pinterest ).'" target="_blank"><i class="fa-brands fa-pinterest-p"></i></a>';


    return $content;

};


//Post Reading Time Count

function tnews_estimated_reading_time() {
    global $post;
    // get the content
    $the_content = $post->post_content;
    // count the number of words
    $words = str_word_count( strip_tags( $the_content ) );
    // rounding off and deviding per 100 words per minute
    $minute = floor( $words / 100 );
    // rounding off to get the seconds
    $second = floor( $words % 100 / ( 100 / 60 ) );
    // calculate the amount of time needed to read
    $estimate = $minute . esc_html__(' Min', 'tnews') . ( $minute == 1 ? '' : 's' ) . esc_html__(' Read', 'tnews');
    // create output
    $output = $estimate;
    // return the estimate
    return $output;
}



//add SVG to allowed file uploads

function tnews_mime_types( $mimes ) {

    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svgz+xml';
    $mimes['exe'] = 'program/exe';
    $mimes['dwg'] = 'image/vnd.dwg';
    return $mimes;
}

add_filter('upload_mimes', 'tnews_mime_types');



function tnews_wp_check_filetype_and_ext( $data, $file, $filename, $mimes ) {

    $wp_filetype = wp_check_filetype( $filename, $mimes );
    $ext         = $wp_filetype['ext'];
    $type        = $wp_filetype['type'];
    $proper_filename = $data['proper_filename'];

    return compact( 'ext', 'type', 'proper_filename' );

}

add_filter( 'wp_check_filetype_and_ext', 'tnews_wp_check_filetype_and_ext', 10, 4 );


// if ( ! function_exists( 'etlms_course_categories' ) ) {
//     function etlms_course_categories() {
//         $course_categories      = array();
//         $course_categories_term = tutils()->get_course_categories_term();
//         foreach ( $course_categories_term as $term ) {
//             $course_categories[ $term->term_id ] = $term->name;
//         }

//         return $course_categories;
//     }
// }

// if ( ! function_exists( 'etlms_course_authors' ) ) {
//     function etlms_course_authors() {
//         $course_authors = array();
//         $authors        = get_users( array( 'role__in' => array( 'author', tutor()->instructor_role ) ) );
//         foreach ( $authors as $author ) {
//             $course_authors[ $author->ID ] = $author->display_name;
//         }

//         return $course_authors;
//     }
// }


// Event Post Type

// add_action( 'init','tnews_event', 0 );

function tnews_event(){

    $labels = array(

        'name'               => esc_html__( 'Events', 'post Category general name', 'tnews' ),
        'singular_name'      => esc_html__( 'Event', 'post Category singular name', 'tnews' ),
        'menu_name'          => esc_html__( 'Events', 'admin menu', 'tnews' ),
        'name_admin_bar'     => esc_html__( 'Event', 'add new on admin bar', 'tnews' ),
        'add_new'            => esc_html__( 'Add New', 'Event', 'tnews' ),
        'add_new_item'       => esc_html__( 'Add New Event', 'tnews' ),
        'new_item'           => esc_html__( 'New Event', 'tnews' ),
        'edit_item'          => esc_html__( 'Edit Event', 'tnews' ),
        'view_item'          => esc_html__( 'View Event', 'tnews' ),
        'all_items'          => esc_html__( 'All Events', 'tnews' ),
        'search_items'       => esc_html__( 'Search Events', 'tnews' ),
        'parent_item_colon'  => esc_html__( 'Parent Events:', 'tnews' ),
        'not_found'          => esc_html__( 'No Events found.', 'tnews' ),
        'not_found_in_trash' => esc_html__( 'No Events found in Trash.', 'tnews' ),
    );

    $args = array(

        'labels'             => $labels,
        'description'        => esc_html__( 'Description.', 'tnews' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-list-view',
        'supports'           => array( 'title', 'thumbnail', 'editor', 'elementor' ),
        'rewrite'            => array( 'slug' => 'events' ),
        'menu_position' => 10,
    );

    register_post_type( 'tnews_event', $args );


    $labels = array(

        'name'                       => esc_html__( 'Categories', 'taxonomy general name', 'tnews' ),
        'singular_name'              => esc_html__( 'Category', 'taxonomy singular name', 'tnews' ),
        'search_items'               => esc_html__( 'Search Categorys', 'tnews' ),
        'popular_items'              => esc_html__( 'Popular Categorys', 'tnews' ),
        'all_items'                  => esc_html__( 'All Categorys', 'tnews' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => esc_html__( 'Edit Category', 'tnews' ),
        'update_item'                => esc_html__( 'Update Category', 'tnews' ),
        'add_new_item'               => esc_html__( 'Add New Category', 'tnews' ),
        'new_item_name'              => esc_html__( 'New Category Name', 'tnews' ),
        'separate_items_with_commas' => esc_html__( 'Separate Categorys with commas', 'tnews' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove Categorys', 'tnews' ),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used Categorys', 'tnews' ),
        'not_found'                  => esc_html__( 'No Categorys found.', 'tnews' ),
        'menu_name'                  => esc_html__( 'Categories', 'tnews' ),
    );



    $args = array(

        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'show_in_rest'          => true,
        'rewrite'               => array( 'slug' => 'event-category' ),
    );

    register_taxonomy( 'event_category', 'tnews_event', $args );



    // Add new taxonomy, NOT hierarchical (like tags)

    $labels = array(

        'name'                       => esc_html__( 'Tags', 'taxonomy general name', 'tnews' ),
        'singular_name'              => esc_html__( 'Tag', 'taxonomy singular name', 'tnews' ),
        'search_items'               => esc_html__( 'Search Tags', 'tnews' ),
        'popular_items'              => esc_html__( 'Popular Tags', 'tnews' ),
        'all_items'                  => esc_html__( 'All Tags', 'tnews' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => esc_html__( 'Edit Tag', 'tnews' ),
        'update_item'                => esc_html__( 'Update Tag', 'tnews' ),
        'add_new_item'               => esc_html__( 'Add New Tag', 'tnews' ),
        'new_item_name'              => esc_html__( 'New Tag Name', 'tnews' ),
        'separate_items_with_commas' => esc_html__( 'Separate Tags with commas', 'tnews' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove Tags', 'tnews' ),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used Tags', 'tnews' ),
        'not_found'                  => esc_html__( 'No Tags found.', 'tnews' ),
        'menu_name'                  => esc_html__( 'Tags', 'tnews' ),

    );

    $args = array(

        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'show_in_rest'          => true,
        'rewrite'               => array( 'slug' => 'event-tag' ),
    );

    register_taxonomy( 'event_tag', 'tnews_event', $args );
}

/**
 * Single Template
 */

// add_filter( 'single_template', 'tnews_core_template_redirect' );

if( ! function_exists( 'tnews_core_template_redirect' ) ){

    function tnews_core_template_redirect( $single_template ){
        global $post;

        if( $post ){

            if( $post->post_type == 'tnews_event' ){

                $single_template = TNEWS_CORE_PLUGIN_TEMP . 'single-tnews_event.php';

            }
        }

        return $single_template;
    }

}


/**
 * Archive Template
 */

// add_filter( 'archive_template', 'tnews_core_template_archive' );

if( ! function_exists( 'tnews_core_template_archive' ) ){

    function tnews_core_template_archive( $archive_template ){

        global $post;


        if( $post ){

            if( $post->post_type == 'tnews_event' ){

                $archive_template = TNEWS_CORE_PLUGIN_TEMP . 'archive-tnews_event.php';
            }
        }

        return $archive_template;
    }

}



// Add Image Size
//Home one
add_image_size( 'tnews_80X80', 80, 80, true );
add_image_size( 'tnews_100X100', 100, 100, true );
add_image_size( 'tnews_110X110', 110, 110, true );
add_image_size( 'tnews_288X187', 288, 187, true );
add_image_size( 'tnews_300X200', 300, 200, true );
add_image_size( 'tnews_392X310', 392, 310, true );
add_image_size( 'tnews_600X490', 600, 490, true );

add_image_size( 'tnews_600X625', 600, 625, true );
add_image_size( 'tnews_780X378', 780, 378, true );
add_image_size( 'tnews_288X288', 288, 288, true );
//Home two
add_image_size( 'tnews_220X210', 220, 210, true );
add_image_size( 'tnews_288X233', 288, 233, true ); //home 2 (288*220) , home 3 - (288*240)
add_image_size( 'tnews_392X450', 392, 450, true ); //392*420 home 3 (392*450)
add_image_size( 'tnews_496X480', 496, 480, true );
//Home three
add_image_size( 'tnews_392X250', 392, 250, true );
add_image_size( 'tnews_444X300', 444, 300, true );
add_image_size( 'tnews_445X317', 445, 317, true );
add_image_size( 'tnews_600X443', 600, 443, true );
add_image_size( 'tnews_808X450', 808, 450, true ); //home 5 (808*437)
add_image_size( 'tnews_912X500', 912, 500, true );
add_image_size( 'tnews_915X658', 915, 658, true );
//Home Four
add_image_size( 'tnews_446X545', 446, 545, true );
add_image_size( 'tnews_915X545', 915, 545, true );
add_image_size( 'tnews_600X612', 600, 612, true );
add_image_size( 'tnews_600X300', 600, 300, true );
add_image_size( 'tnews_352X446', 352, 446, true );
add_image_size( 'tnews_912X400', 912, 400, true );
//Home Five
add_image_size( 'tnews_130X122', 130, 122, true );
add_image_size( 'tnews_184X80', 184, 80, true );
add_image_size( 'tnews_270X220', 270, 220, true );
add_image_size( 'tnews_288X350', 288, 350, true );
add_image_size( 'tnews_392X414', 392, 414, true );
add_image_size( 'tnews_912X600', 912, 600, true ); 



remove_filter( 'render_block', 'wp_render_layout_support_flag', 10, 2 );
remove_filter( 'render_block', 'gutenberg_render_layout_support_flag', 10, 2 );



function custom_add_like_meta_box() {
    add_meta_box('custom-like-box', 'Likes', 'custom_render_like_box', 'post', 'side', 'high');
}
add_action('add_meta_boxes', 'custom_add_like_meta_box');

function custom_render_like_box($post) {
    $like_count = get_post_meta($post->ID, '_custom_like_count', true);
    echo '<label for="custom-like-count">Like Count:</label>';
    echo '<input type="text" id="custom-like-count" name="custom-like-count" value="' . esc_attr($like_count) . '" readonly>';
}



function custom_enqueue_scripts() {
    wp_enqueue_script('custom-like-script', TNEWS_PLUGDIRURI . 'assets/js/like.js', array('jquery'), '1.0', true);

    // Localize the script with the ajax_url
    wp_localize_script('custom-like-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');


// wp_enqueue_script('tnews-ajax',TNEWS_PLUGDIRURI.'assets/js/tnews.ajax.js',array( 'jquery' ),'1.0',true);


// function custom_like_action() {
//     $post_id = $_POST['post_id'];
//     $like_count = get_post_meta($post_id, '_custom_like_count', true);
//     $like_count = empty($like_count) ? 1 : intval($like_count) + 1;

//     update_post_meta($post_id, '_custom_like_count', $like_count);
//     echo $like_count;
//     wp_die();
// }


function custom_like_action() {
    $post_id = $_POST['post_id'];
    $user_id = get_current_user_id();
    $liked_posts = get_user_meta($user_id, 'liked_posts', true);

    if (!is_array($liked_posts)) {
        $liked_posts = array();
    }

    if (!in_array($post_id, $liked_posts)) {
        $liked_posts[] = $post_id;
        update_user_meta($user_id, 'liked_posts', $liked_posts);

        $like_count = get_post_meta($post_id, '_custom_like_count', true);
        $like_count = empty($like_count) ? 1 : intval($like_count) + 1;

        update_post_meta($post_id, '_custom_like_count', $like_count);
        echo $like_count;
    } else {
        echo 'already_liked';
    }

    wp_die();
}

function custom_unlike_action() {
    $post_id = $_POST['post_id'];
    $user_id = get_current_user_id();
    $liked_posts = get_user_meta($user_id, 'liked_posts', true);

    if (!is_array($liked_posts)) {
        $liked_posts = array();
    }

    if (in_array($post_id, $liked_posts)) {
        $like_count = get_post_meta($post_id, '_custom_like_count', true);
        $like_count = max(0, intval($like_count) - 1);

        update_post_meta($post_id, '_custom_like_count', $like_count);

        $liked_posts = array_diff($liked_posts, array($post_id));
        update_user_meta($user_id, 'liked_posts', $liked_posts);

        echo $like_count;
    } else {
        echo 'not_liked';
    }

    wp_die();
}
add_action('wp_ajax_custom_unlike_action', 'custom_unlike_action');
add_action('wp_ajax_nopriv_custom_unlike_action', 'custom_unlike_action');


add_action('wp_ajax_custom_like_action', 'custom_like_action');
add_action('wp_ajax_nopriv_custom_like_action', 'custom_like_action');
