<?php

/**
 * @Packge     : Tnews
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */


// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit;
}

if ( ! is_active_sidebar( 'tnews-blog-sidebar' ) ) {
    return;
}

//Demo style show by get url varibale
if ( isset( $_GET['layout'] ) ) {
    $layout_value = sanitize_text_field( $_GET['layout'] );
}else{
    $layout_sidebar = '';
}
if ( isset( $_GET['sidebar']) ) {
    $layout_sidebar = sanitize_text_field( $_GET['sidebar'] );
}else{
    $layout_sidebar = '';
}
if( isset( $_GET['layout'] ) && ($layout_value === '2' || $layout_value === '3' || $layout_value === '4' || $layout_value === '5' )){
    if ( !empty($layout_value) ) {
        $tnews_blog_single_layout = $layout_value;
    }else{
        $tnews_blog_single_layout = 1;
    }
}else{
    //Redux option work
    if( class_exists('ReduxFramework') ) {
        $tnews_blog_single_layout = tnews_opt('tnews_blog_single_layout');
    }else{
        $tnews_blog_single_layout = 1;
    }
}//End - Demo style show by get url varibale

 //Blog details style 2 & 3
if( is_single() && $tnews_blog_single_layout == 2 ) {
    $class = 'style-bg';
}else{
    $class = '';
}
if( is_single() && ($tnews_blog_single_layout == 2 || $tnews_blog_single_layout == 3) ) {
    $col = 'col-lg-4';
}else{
    $col = 'col-xxl-3 col-lg-4';
}

//Sidebar part
if( is_single() && ($tnews_blog_single_layout == 4 || $tnews_blog_single_layout == 5) && $layout_sidebar == 'no') {

}else{
    echo '<div class="'.esc_attr($col).' sidebar-wrap">';
        echo '<aside class="sidebar-area '.esc_attr($class).'">';
            dynamic_sidebar( 'tnews-blog-sidebar' );
        echo '</aside>';
    echo '</div>';
}