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

    tnews_setPostViews( get_the_ID() );

//Demo style show by get url varibale
if ( isset( $_GET['layout'] ) ) {
    $layout_value = sanitize_text_field( $_GET['layout'] );
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

if(  $tnews_blog_single_layout == 2 ) {   
    echo '<div class="blog-single style-bg">';
}

if(  $tnews_blog_single_layout == 4 || $tnews_blog_single_layout == 5 ) {
    require_once get_parent_theme_file_path() . '/templates/single-content-full.php';
}else{
    require_once get_parent_theme_file_path() . '/templates/single-content-default.php';
}
?>


<?php
if( $tnews_blog_single_layout == 2 ) {  
    echo '</div>';
}
