<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit();
}
/**
 * @Packge     : Tnews
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

// enqueue css
function tnews_common_custom_css(){

    $CustomCssOpt  = tnews_opt( 'tnews_css_editor' );
	if( $CustomCssOpt ){
		$CustomCssOpt = $CustomCssOpt;
	}else{
		$CustomCssOpt = '';
	}

    $customcss = "";
    
    if( get_header_image() ){
        $tnews_header_bg =  get_header_image();
    }else{
        if( tnews_meta( 'page_breadcrumb_settings' ) == 'page' ){
            if( ! empty( tnews_meta( 'breadcumb_image' ) ) ){
                $tnews_header_bg = tnews_meta( 'breadcumb_image' );
            }
        }
    }
    
    if( !empty( $tnews_header_bg ) ){
        $customcss .= ".breadcumb-wrapper{
            background-image:url('{$tnews_header_bg}')!important;
        }";
    }
    
	// Theme color
	$tnewsthemecolor = tnews_opt('tnews_theme_color'); 
    if( !empty( $tnewsthemecolor ) ){
        list($r, $g, $b) = sscanf( $tnewsthemecolor, "#%02x%02x%02x");

        $tnews_real_color = $r.','.$g.','.$b;
        if( !empty( $tnewsthemecolor ) ) {
            $customcss .= ":root {
            --theme-color: rgb({$tnews_real_color});
            }";
        }
    }
    // Heading  color
	$tnewsheadingcolor = tnews_opt('tnews_heading_color');
    if( !empty( $tnewsheadingcolor ) ){
        list($r, $g, $b) = sscanf( $tnewsheadingcolor, "#%02x%02x%02x");

        $tnews_real_color = $r.','.$g.','.$b;
        if( !empty( $tnewsheadingcolor ) ) {
            $customcss .= ":root {
                --title-color: rgb({$tnews_real_color});
            }";
        }
    }
    // Body color
	$tnewsbodycolor = tnews_opt('tnews_body_color');
    if( !empty( $tnewsbodycolor ) ){
        list($r, $g, $b) = sscanf( $tnewsbodycolor, "#%02x%02x%02x");

        $tnews_real_color = $r.','.$g.','.$b;
        if( !empty( $tnewsbodycolor ) ) {
            $customcss .= ":root {
                --body-color: rgb({$tnews_real_color});
            }";
        }
    }

     // Body font
     $tnewsbodyfont = tnews_opt('tnews_theme_body_font', 'font-family');
     if( !empty( $tnewsbodyfont ) ) {
         $customcss .= ":root {
             --body-font: $tnewsbodyfont ;
         }";
     }
 
     // Heading font
     $tnewsheadingfont = tnews_opt('tnews_theme_heading_font', 'font-family');
     if( !empty( $tnewsheadingfont ) ) {
         $customcss .= ":root {
             --title-font: $tnewsheadingfont ;
         }";
     }


    if(tnews_opt('tnews_menu_icon_class')){
        $menu_icon_class = tnews_opt( 'tnews_menu_icon_class' );
    }else{
        $menu_icon_class = 'f054';
    }

    if( !empty( $menu_icon_class ) ) {
        $customcss .= ":root {
            .main-menu ul.sub-menu li a:before {
                content: \"\\$menu_icon_class\";
            }
        }";
    }

	if( !empty( $CustomCssOpt ) ){
		$customcss .= $CustomCssOpt;
	}

    wp_add_inline_style( 'tnews-color-schemes', $customcss );
}
add_action( 'wp_enqueue_scripts', 'tnews_common_custom_css', 100 );