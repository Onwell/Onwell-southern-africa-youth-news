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
    exit;
}

 // theme option callback
function tnews_opt( $id = null, $url = null ){
    global $tnews_opt;

    if( $id && $url ){

        if( isset( $tnews_opt[$id][$url] ) && $tnews_opt[$id][$url] ){
            return $tnews_opt[$id][$url];
        }
    }else{
        if( isset( $tnews_opt[$id] )  && $tnews_opt[$id] ){
            return $tnews_opt[$id];
        }
    }
}


// theme logo
function tnews_theme_logo($class = null) {
    // escaping allow html
    $allowhtml = array(
        'a'    => array(
            'href' => array()
        ),
        'span' => array(),
        'i'    => array(
            'class' => array()
        )
    );
    $siteUrl = home_url('/');
    if( has_custom_logo() ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $siteLogo = '';
        $siteLogo .= '<a class="logo" href="'.esc_url( $siteUrl ).'">';
        $siteLogo .= tnews_img_tag( array(
            "class" => "img-fluid $class",
            "url"   => esc_url( wp_get_attachment_image_url( $custom_logo_id, 'full') )
        ) );
        $siteLogo .= '</a>';

        return $siteLogo;
    } elseif( !tnews_opt('tnews_text_title') && tnews_opt('tnews_site_logo', 'url' )  ){

        $siteLogo = '<img class="img-fluid '.$class.'" src="'.esc_url( tnews_opt('tnews_site_logo', 'url' ) ).'" alt="'.esc_attr__( 'logo', 'tnews' ).'" />';
        return '<a class="logo" href="'.esc_url( $siteUrl ).'">'.$siteLogo.'</a>';


    }elseif( tnews_opt('tnews_text_title') ){
        return '<h2 class="mb-0"><a class="logo" href="'.esc_url( $siteUrl ).'">'.wp_kses( tnews_opt('tnews_text_title'), $allowhtml ).'</a></h2>';
    }else{
        return '<h2 class="mb-0"><a class="logo" href="'.esc_url( $siteUrl ).'">'.esc_html( get_bloginfo('name') ).'</a></h2>';
    }
}

// custom meta id callback
function tnews_meta( $id = '' ){
    $value = get_post_meta( get_the_ID(), '_tnews_'.$id, true );
    return $value;
}


// Blog Date Permalink
function tnews_blog_date_permalink() {
    $year  = get_the_time('Y');
    $month_link = get_the_time('m');
    $day   = get_the_time('d');
    $link = get_day_link( $year, $month_link, $day);
    return $link;
}

//audio format iframe match
function tnews_iframe_match() {
    $audio_content = tnews_embedded_media( array('audio', 'iframe') );
    $iframe_match = preg_match("/\iframe\b/i",$audio_content, $match);
    return $iframe_match;
}


//Post embedded media
function tnews_embedded_media( $type = array() ){
    $content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
    $embed   = get_media_embedded_in_content( $content, $type );


    if( in_array( 'audio' , $type) ){
        if( count( $embed ) > 0 ){
            $output = str_replace( '?visual=true', '?visual=false', $embed[0] );
        }else{
           $output = '';
        }

    }else{
        if( count( $embed ) > 0 ){
            $output = $embed[0];
        }else{
           $output = '';
        }
    }
    return $output;
}


// WP post link pages
function tnews_link_pages(){
    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'tnews' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'tnews' ) . ' </span>%',
        'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
}


// Data Background image attr
function tnews_data_bg_attr( $imgUrl = '' ){
    return 'data-bg-img="'.esc_url( $imgUrl ).'"';
}

// image alt tag
function tnews_image_alt( $url = '' ){
    if( $url != '' ){
        // attachment id by url
        $attachmentid = attachment_url_to_postid( esc_url( $url ) );
       // attachment alt tag
        $image_alt = get_post_meta( esc_html( $attachmentid ) , '_wp_attachment_image_alt', true );
        if( $image_alt ){
            return $image_alt ;
        }else{
            $filename = pathinfo( esc_url( $url ) );
            $alt = str_replace( '-', ' ', $filename['filename'] );
            return $alt;
        }
    }else{
       return;
    }
}


// Flat Content wysiwyg output with meta key and post id

function tnews_get_textareahtml_output( $content ) {
    global $wp_embed;

    $content = $wp_embed->autoembed( $content );
    $content = $wp_embed->run_shortcode( $content );
    $content = wpautop( $content );
    $content = do_shortcode( $content );

    return $content;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */

function tnews_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'tnews_pingback_header' );


// Excerpt More
function tnews_excerpt_more( $more ) {
    return '...';
}

add_filter( 'excerpt_more', 'tnews_excerpt_more' );


// tnews comment template callback
function tnews_comment_callback( $comment, $args, $depth ) {
        $add_below = 'comment';
    ?>
    <li <?php comment_class( array('th-comment-item') ); ?>>
        <div id="comment-<?php comment_ID() ?>" class="th-post-comment">
            <?php
                if( get_avatar( $comment, 100 )  ) :
            ?>
            <!-- Author Image -->
            <div class="comment-avater">
                <?php
                    if ( $args['avatar_size'] != 0 ) {
                        echo get_avatar( $comment, 110 );
                    }
                ?>
            </div>
            <!-- Author Image -->
            <?php endif; ?>
            <!-- Comment Content -->
            <div class="comment-content">
                <span class="commented-on"><i class="fas fa-calendar-alt"></i><?php printf( esc_html__('%1$s', 'tnews'), get_comment_date() ); ?></span>
                <h3 class="name"><?php echo esc_html( ucwords( get_comment_author() ) ); ?></h3>
                <p class="text"><?php echo get_comment_text(); ?></p>
                <div class="reply_and_edit">
                    <?php
                        $reply_text = wp_kses_post( '<i class="fas fa-reply"></i> Reply', 'tnews' );

                        $edit_reply_text = wp_kses_post( '<i class="fas fa-pencil-alt"></i> Edit', 'tnews' );

                        comment_reply_link(array_merge( $args, array( 'add_below' => $add_below, 'depth' => 3, 'max_depth' => 5, 'reply_text' => $reply_text ) ) );
                    ?>  
                </div>
                <?php if ( $comment->comment_approved == '0' ) : ?>
                <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'tnews' ); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <!-- Comment Content -->
<?php
}

//body class
add_filter( 'body_class', 'tnews_body_class' );
function tnews_body_class( $classes ) {
    if( class_exists('ReduxFramework') ) {
        $tnews_blog_single_sidebar = tnews_opt('tnews_blog_single_sidebar');
        if( ($tnews_blog_single_sidebar != '2' && $tnews_blog_single_sidebar != '3' ) || ! is_active_sidebar('tnews-blog-sidebar') ) {
            $classes[] = 'no-sidebar';
        }
        $new_class = is_page() ? tnews_meta('custom_body_class') : null;

        if ( $new_class ) {
            $classes[] = $new_class;
        }
    } else {
        if( !is_active_sidebar('tnews-blog-sidebar') ) {
            $classes[] = 'no-sidebar';
        }
    }
    // $classes[] = 'dark-theme';
    return $classes;
}

//Global Footer
function tnews_footer_global_option(){
    // Tnews Widget Enable Disable
    if( class_exists( 'ReduxFramework' ) ){
        $tnews_footer_widget_enable = tnews_opt( 'tnews_footerwidget_enable' );
        $tnews_footer_bottom_active = tnews_opt( 'tnews_disable_footer_bottom' );
    }else{
        $tnews_footer_widget_enable = '';
        $tnews_footer_bottom_active = '1';
    }
    $allowhtml = array(
        'p'         => array(
            'class'     => array()
        ),
        'i'         => array(
            'class'     => array()
        ),
        'span'      => array(
            'class'     => array(),
        ),
        'a'         => array(
            'href'      => array(),
            'title'     => array(),
            'class'     => array(),
        ),
        'br'        => array(),
        'em'        => array(),
        'strong'    => array(),
        'b'         => array(),
    );
    if( $tnews_footer_widget_enable == '1' || $tnews_footer_bottom_active == '1' ){
        $bg = tnews_opt('tnews_footer_background', 'background-image' );
        $footer_bg = $bg ? $bg : '#';

        echo '<!---footer-wrapper start-->';
        echo '<footer class="footer-wrapper footer-layout1" data-bg-src="'.esc_url(  $footer_bg ).'">';
            if( $tnews_footer_widget_enable == '1' ){
                if( ( is_active_sidebar( 'tnews-footer-1' ) || is_active_sidebar( 'tnews-footer-2' ) || is_active_sidebar( 'tnews-footer-3' ) )) {
                    echo '<div class="widget-area">';
                        echo '<div class="container">';
                                echo '<div class="row justify-content-between">';
                                    if( is_active_sidebar( 'tnews-footer-1' )){
                                    dynamic_sidebar( 'tnews-footer-1' ); 
                                    }
                                    if( is_active_sidebar( 'tnews-footer-2' )){
                                    dynamic_sidebar( 'tnews-footer-2' ); 
                                    }
                                    if( is_active_sidebar( 'tnews-footer-3' )){
                                    dynamic_sidebar( 'tnews-footer-3' ); 
                                    } 
                                    if( is_active_sidebar( 'tnews-footer-4' )){
                                    dynamic_sidebar( 'tnews-footer-4' ); 
                                    }  
                                echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            }

            if( $tnews_footer_bottom_active == '1' ){
                echo '<div class="copyright-wrap">';
                    echo '<div class="container">';
                        echo '<div class="row jusity-content-between align-items-center">';
                            echo '<div class="col-lg-5">';
                                echo '<p class="copyright-text">'.wp_kses( tnews_opt( 'tnews_copyright_text' ), $allowhtml ).'</p>';
                            echo '</div>';
                            echo '<div class="col-lg-auto ms-auto d-none d-lg-block">';
                                echo '<div class="footer-links">';
                                    wp_nav_menu( array(
                                        "theme_location"    => 'footer-menu',
                                        "container"         => '',
                                        "menu_class"        => ''
                                    ) ); 
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';

                           
                    echo '</div>';
                echo '</div>';
            }

        echo '</footer>';
        echo '<!---footer-wrapper end-->';
    }
}

// Social link
function tnews_social_icon(){
    $tnews_social_icon = tnews_opt( 'tnews_social_links' );
    if( ! empty( $tnews_social_icon ) && isset( $tnews_social_icon ) ){
        foreach( $tnews_social_icon as $social_icon ){
                echo '<a href="'.esc_url( $social_icon['url'] ).'"><i class="'.esc_attr( $social_icon['title'] ).'"></i>'.esc_attr( $social_icon['description'] ).'</a>';
        }
    }
}


// global header
function tnews_global_header_option() {

    if( class_exists( 'ReduxFramework' ) ){ ?>
        <header class="th-header header-layout1 prebuilt">
        <?php

        echo tnews_header_cart_offcanvas();
        echo tnews_header_offcanvas();
        echo tnews_mobile_menu();
        echo tnews_search_box();

        if(tnews_opt('tnews_menu_icon')){
            $menu_icon = '';
        }else{
            $menu_icon = 'hide-icon';
        }

        echo tnews_header_menu_topbar();
        ?>

        <div class="header-middle">
            <div class="container">
                <div class="row justify-content-center justify-content-lg-between align-items-center">
                    <div class="col-auto d-none d-lg-block">
                        <div class="col-auto">
                            <div class="header-logo">
                                <?php 
                                echo tnews_theme_logo('light-img'); 
                                echo '<a href="'.esc_url( home_url( '/' ) ).'"><img class="dark-img" src="'.tnews_opt('tnews_site_logo2', 'url').'" alt="Tnews"></a>';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 text-end">
                        <div class="header-ads">
                            <?php  
                            if(tnews_opt('tnews_ads_img', 'url')){
                                echo '<a href="'.esc_url( tnews_opt('tnews_ads__url') ).'">';
                                    echo '<img class="light-img" src="'.tnews_opt('tnews_ads_img', 'url').'" alt="Tnews">';
                                    echo '<img class="dark-img" src="'.tnews_opt('tnews_ads_img', 'url').'" alt="Tnews">';
                                echo '</a>'; 
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sticky-wrapper">
            <!-- Main Menu Area -->
            <div class="menu-area">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto d-lg-none d-block">
                            <div class="header-logo">
                               <?php echo '<a href="'.esc_url( home_url( '/' ) ).'"><img src="'.tnews_opt('tnews_site_logo2', 'url').'" alt="Tnews"></a>'; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <nav class="main-menu d-none d-lg-inline-block <?php echo esc_attr($menu_icon); ?>">
                                <?php 
                                    wp_nav_menu( array(
                                        "theme_location"    => 'primary-menu',
                                        "container"         => '',
                                        "menu_class"        => ''
                                    ) ); 
                                ?>
                            </nav>
                        </div>
                        <div class="col-auto">
                            <div class="header-button">
                                <?php if(!empty(tnews_opt( 'tnews_header_search_switcher' )) ): ?>
                                    <button type="button" class="simple-icon searchBoxToggler"><i class="far fa-search"></i></button>
                                <?php endif; ?> 
                                <?php if(!empty(tnews_opt( 'tnews_header_cart_switcher' )) ): 
                                        if( class_exists( 'woocommerce' ) ):
                                            global $woocommerce;
                                            if( ! empty( $woocommerce->cart->cart_contents_count ) ){
                                                $count = $woocommerce->cart->cart_contents_count;
                                            }else{
                                                $count = "0";
                                            }
                                    ?>
                                    <button type="button" class="simple-icon d-none d-lg-block cartToggler">
                                        <i class="far fa-cart-shopping"></i>
                                        <span class="badge"><?php echo esc_html( $count ) ?></span>
                                    </button>
                                <?php endif; endif; ?> 
                                <?php if(!empty(tnews_opt( 'tnews_header_offcanvas_switcher' )) ): ?>
                                    <a href="#" class="icon-btn sideMenuToggler d-none d-lg-block"><i class="far fa-bars"></i></a>
                                <?php endif; ?> 
                                <button type="button" class="th-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </header>
    <?php
    }else{
        echo tnews_global_header();
    }
}

if( ! function_exists( 'tnews_header_menu_topbar' ) ){
    function tnews_header_menu_topbar(){
        if( class_exists( 'ReduxFramework' ) ){
            $tnews_header_topbar_switcher  = tnews_opt( 'tnews_header_topbar_switcher' );
            $tnews_show_social_switcher      = tnews_opt( 'tnews_header_social_switcher' );
            $tnews_custom_menu = tnews_opt( 'tnews_custom_menu' );
            $tnews_color_mode_box_switcher = tnews_opt( 'tnews_color_mode_box_switcher' );
            $tnews_btn_switcher = tnews_opt( 'tnews_btn_switcher' );

            $user_id                   = get_current_user_id();
            $user                      = get_user_by('ID', $user_id);


            if( $tnews_header_topbar_switcher ){
                echo '<div class="header-top">';
                    echo '<div class="container">';
                        echo '<div class="row justify-content-center justify-content-lg-between align-items-center gy-2">';
                            echo '<div class="col-auto d-none d-lg-block">';
                                echo '<div class="header-links">';
                                    echo '<ul>';
                                        echo '<li><i class="fal fa-calendar-days"></i><a href="#">'.date(get_option('date_format')).'</a></li>';
                                            if( ! empty( $tnews_custom_menu ) && isset( $tnews_custom_menu ) ){
                                                foreach( $tnews_custom_menu as $data ){
                                                    if( ! empty( $data['title'] ) ){
                                                        echo '<li><a href="'.esc_url( $data['url'] ).'">'.esc_html( $data['title'] ).'</a></li>';
                                                    }
                                                }
                                            }
                                            if(!empty($tnews_color_mode_box_switcher) ){
                                            echo '<li>';
                                                echo '<a class="theme-toggler" href="#">';
                                                        echo '<span class="dark"><i class="fas fa-moon"></i>Dark Mode</span>';
                                                        echo '<span class="light"><i class="fa-solid fa-sun-bright"></i>Light Mode</span>';
                                                echo '</a>';
                                            echo '</li>';
                                            }
                                    echo '</ul>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="col-auto">';
                                echo '<div class="header-links">';
                                    echo '<ul>';
                                        if(!empty($tnews_btn_switcher) ){
                                            if(is_user_logged_in()){ 
                                                echo '<li class="d-none d-sm-inline-block">';
                                                    echo '<div class="dropdown-link">';
                                                        echo '<a class="dropdown-toggle" href="'.esc_url('#').'" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">';
                                                            echo '<i class="far fa-user"></i>';
                                                            echo esc_html(' Hello ', 'tnews') . esc_html($user->display_name);
                                                        echo '</a>';
                                                        echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">';
                                                            echo '<li>';
                                                                echo '<a href="'.get_permalink( get_option('woocommerce_myaccount_page_id') ).'">'.esc_html('Dashboard', 'tnews').'</a>';
                                                                echo '<a href="'.esc_url( wp_logout_url() ).'">'.esc_html('Logout', 'tnews').'</a>';
                                                            echo '</li>';
                                                        echo '</ul>';
                                                    echo '</div>';
                                                echo '</li>';
                                            }else{
                                                echo '<li class="d-none d-sm-inline-block"><i class="far fa-user"></i><a href="'.esc_url( home_url( '/my-account' ) ).'">'.wp_kses_post(tnews_opt('tnews_btn_text')).'</a></li>';
                                            }
                                        }

                                        // if(!empty($tnews_btn_switcher && !empty(tnews_opt('tnews_btn_text'))) ){
                                        //     echo '<li class="d-none d-sm-inline-block"><i class="far fa-user"></i><a href="'.esc_url(tnews_opt('tnews_btn_url')).'">'.tnews_opt('tnews_btn_text').'</a></li>';
                                        // }
                                        if(!empty($tnews_show_social_switcher) ){
                                            echo '<li>';
                                                echo '<div class="social-links">';
                                                    echo tnews_social_icon();
                                                echo '</div>';
                                            echo '</li>';
                                        }
                                    echo '</ul>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
        }

    }
}

// tnews woocommerce breadcrumb
function tnews_woo_breadcrumb( $args ) {
    return array(
        'delimiter'   => '',
        'wrap_before' => '<ul class="breadcumb-menu">',
        'wrap_after'  => '</ul>',
        'before'      => '<li>',
        'after'       => '</li>',
        'home'        => _x( 'Home', 'breadcrumb', 'tnews' ),
    );
}

add_filter( 'woocommerce_breadcrumb_defaults', 'tnews_woo_breadcrumb' );

function tnews_custom_search_form( $class ) {
    echo '<!-- Search Form -->';

    echo '<form role="search" method="get" action="'.esc_url( home_url( '/' ) ).'" class="'.esc_attr( $class ).'">';
        echo '<label class="searchIcon">';
            echo tnews_img_tag( array(
                "url"   => esc_url( get_theme_file_uri( '/assets/img/search-2.svg' ) ),
                "class" => "svg"
            ) );
            echo '<input value="'.esc_html( get_search_query() ).'" name="s" required type="search" placeholder="'.esc_attr__('What are you looking for?', 'tnews').'">';
        echo '</label>';
    echo '</form>';
    echo '<!-- End Search Form -->';
}



//Fire the wp_body_open action.
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

//Remove Tag-Clouds inline style
add_filter( 'wp_generate_tag_cloud', 'tnews_remove_tagcloud_inline_style',10,1 );
function tnews_remove_tagcloud_inline_style( $input ){
   return preg_replace('/ style=("|\')(.*?)("|\')/','',$input );
}

/* This code filters the Categories archive widget to include the post count inside the link */
add_filter( 'wp_list_categories', 'tnews_cat_count_span' );
function tnews_cat_count_span( $links ) {
    $links = str_replace('</a> (', '</a> <span class="category-number">', $links);
    $links = str_replace(')', '</span>', $links);
    return $links;
}

/* This code filters the Archive widget to include the post count inside the link */
add_filter( 'get_archives_link', 'tnews_archive_count_span' );
function tnews_archive_count_span( $links ) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="category-number">', $links);
    $links = str_replace(')', '</span>', $links);
    return $links;
}

//header search box
if(! function_exists('tnews_search_box')){
    function tnews_search_box(){
        echo '<div class="popup-search-box">';
            echo '<button class="searchClose"><i class="fal fa-times"></i></button>';
            echo '<form role="search" method="get" action="'.esc_url( home_url( '/' ) ).'">';
                echo '<input value="'.esc_html( get_search_query() ).'" name="s" required type="search" placeholder="'.esc_attr__('What are you looking for?', 'tnews').'">';
                echo '<button type="submit"><i class="fal fa-search"></i></button>';
            echo '</form>';
        echo '</div>';
    }
}


// Tnews Default Header
if( ! function_exists( 'tnews_global_header' ) ){
    function tnews_global_header(){ ?>

        <!--Mobile menu & Search box-->
        <?php 
        echo tnews_search_box(); 
        echo tnews_mobile_menu(); 
        
        ?>

        <!--======== Header ========-->
        <header class="th-header header-layout1 unittest-header">
            <div class="sticky-wrapper">
                <div class="sticky-active">
                    <div class="menu-area">
                        <div class="container">
                            <div class="row gx-20 align-items-center justify-content-between">

                                <div class="col-auto">
                                    <div class="header-logo">
                                       <?php echo tnews_theme_logo(); ?>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <?php
                                    if( has_nav_menu( 'primary-menu' ) ) { ?>
                                        <nav class="main-menu d-none d-lg-inline-block">
                                            <?php
                                            wp_nav_menu( array(
                                                "theme_location"    => 'primary-menu',
                                                "container"         => '',
                                                "menu_class"        => ''
                                            ) ); ?>
                                        </nav>
                                    <?php } ?>                                   
                                    </nav>
                                    <button type="button" class="th-menu-toggle d-inline-block d-lg-none"><i class="far fa-bars"></i></button>
                                </div>
                                <div class="col-auto d-none d-xl-block">
                                    <div class="header-button">
                                        <button type="button" class="icon-btn searchBoxToggler"><i class="far fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="menu-bg"></div>
                </div>
            </div>
        </header>
    <?php
    }
}


//header Offcanvas
if( ! function_exists( 'tnews_header_offcanvas' ) ){
    function tnews_header_offcanvas(){
    ?>
    <div class="sidemenu-wrapper sidemenu-1 d-none d-md-block">
        <div class="sidemenu-content">
        <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
            <?php 
                if(is_active_sidebar('tnews-offcanvas')){
                    dynamic_sidebar( 'tnews-offcanvas' );
                }else{
                    echo '<h4 class="">No Widget Added </h4>';
                    echo '<p>Please add some widget in Offcanvs Sidebar</p>';
                }
            ?>
        </div>
    </div>
    
<?php
    }
}

//header Cart Offcanvas
if( ! function_exists( 'tnews_header_cart_offcanvas' ) ){
    function tnews_header_cart_offcanvas(){
        ?>
        <div class="sidemenu-wrapper cart-side-menu d-none d-lg-block">
            <div class="sidemenu-content">
            <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
                <div class="widget woocommerce widget_shopping_cart">
                    <h3 class="widget_title"><?php echo esc_html__( 'Shopping cart', 'tnews' ); ?></h3>
                    <div class="widget_shopping_cart_content">
                    
                    </div>
                </div>
            </div>
        </div>

    <?php
    }
}

// mobile logo
function tnews_mobile_logo() {
    $logo_url = tnews_opt('tnews_mobile_logo', 'url' );
    $mobile_menu = '';
    if( !empty($logo_url )){
        $mobile_menu = '<div class="mobile-logo"><a href="'.home_url('/').'"><img src="'.esc_url($logo_url).'" alt="'.esc_attr__( 'logo', 'tnews' ).'"></a></div>';
    }else{
        $mobile_menu .= '<div class="mobile-logo">';
        $mobile_menu .= tnews_theme_logo();
        $mobile_menu .= '</div>';
    }

    return $mobile_menu;
 }

//header Mobile Menu
if( ! function_exists( 'tnews_mobile_menu' ) ){
    function tnews_mobile_menu(){
    ?>
    <div class="th-menu-wrapper">
        <div class="th-menu-area text-center">
            <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
            <?php  if( class_exists('ReduxFramework') ):?>
                <?php 
                    if(!empty(tnews_opt('tnews_menu_menu_show') )){
                        echo tnews_mobile_logo(); 
                    }
                ?>
            <?php else: ?>
                <div class="mobile-logo">
                    <?php echo tnews_theme_logo(); ?>
                </div>
            <?php endif; ?>
            <div class="th-mobile-menu">
                <?php 
                    if( has_nav_menu( 'primary-menu' ) ){
                        wp_nav_menu( array(
                            "theme_location"    => 'primary-menu',
                            "container"         => '',
                            "menu_class"        => ''
                        ) );
                    }
                ?>
            </div>
        </div>
    </div>

<?php
    }
}


// Blog post views function
function tnews_setPostViews( $postID ) {
    $count_key  = 'post_views_count';
    $count      = get_post_meta( $postID, $count_key, true );
    if( $count == '' ){
        $count = 0;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
    }else{
        $count++;
        update_post_meta( $postID, $count_key, $count );
    }
}

function tnews_getPostViews( $postID ){
    $count_key  = 'post_views_count';
    $count      = get_post_meta( $postID, $count_key, true );
    if( $count == '' ){
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
        return __( '0', 'tnews' );
    }
    return $count;
}

// Blog post reading time function (Calculate estimated reading time based on word count)
function tnews_get_estimated_reading_time($post_id) {
    $post = get_post($post_id);
    $content = $post->post_content;
  
    // Count words in the post content
    $word_count = str_word_count(strip_tags($content));
  
    // Assuming average reading speed of 200 words per minute
    $average_reading_speed = 200;
  
    // Calculate estimated reading time in minutes
    $estimated_minutes = ceil($word_count / $average_reading_speed);
  
    return $estimated_minutes;
  }


// Add Extra Class On Comment Reply Button
function tnews_custom_comment_reply_link( $content ) {
    $extra_classes = 'reply-btn';
    return preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $extra_classes, $content);
}

add_filter('comment_reply_link', 'tnews_custom_comment_reply_link', 99);

// Add Extra Class On Edit Comment Link
function tnews_custom_edit_comment_link( $content ) {
    $extra_classes = 'reply-btn';
    return preg_replace( '/comment-edit-link/', 'comment-edit-link ' . $extra_classes, $content);
}

add_filter('edit_comment_link', 'tnews_custom_edit_comment_link', 99);


function tnews_post_classes( $classes, $class, $post_id ) {
    if ( get_post_type() === 'post' ) {
        $tnews_post_slider_thumbnail = tnews_meta( 'post_format_slider' );
        $tnews_audio = tnews_meta( 'post_format_audio' );
        if(has_post_thumbnail() || !empty($tnews_audio) || !empty($tnews_post_slider_thumbnail)){
            $classes[] = "th-blog blog-single has-post-thumbnail";
        }else{
            $classes[] = "th-blog blog-single";
        }
    }elseif( get_post_type() === 'product' ){
        // Return Class
    }elseif( get_post_type() === 'page' ){
        $classes[] = "page--item";
    }
    
    return $classes;
}
add_filter( 'post_class', 'tnews_post_classes', 10, 3 );

// Contact form 7
add_filter('wpcf7_autop_or_not', '__return_false');

//Related Post Slider
if( ! function_exists( 'tnews_related_post_slider' ) ){
    function tnews_related_post_slider(){

        //Demo style show by get url varibale
        if ( isset( $_GET['items'] ) ) {
            $items_value = sanitize_text_field( $_GET['items'] );
        }
        if( isset( $_GET['items'] ) && $items_value === '4' ){
            if ( !empty($items_value) ) {
                $tnews_related_post_items = $items_value;
            }
        }else{
            //Redux option work
            if( class_exists('ReduxFramework') ) {
                $tnews_related_post_items = tnews_opt('tnews_related_post_items');
            }else{
                $tnews_related_post_items = '3';
            }
        }//End - Demo style show by get url varibale

        if( class_exists('ReduxFramework') ) {
            $tnews_display_related_post = tnews_opt('tnews_display_related_post');
            $tnews_related_post_title = tnews_opt('tnews_related_post_title');
            $tnews_related_post_title_count = tnews_opt('tnews_related_post_title_count');
        }else{
            $tnews_display_related_post = '';
            $tnews_related_post_title = 'Related Post';
            $tnews_related_post_title_count = '5';
        }

        if($tnews_display_related_post){
            echo '<div class="related-post-wrapper pt-30 mb-30">';

                echo '<div class="row align-items-center">';
                    echo '<div class="col">';
                        echo '<h2 class="sec-title has-line">'.esc_html($tnews_related_post_title).'</h2>';
                    echo '</div>';
                    echo '<div class="col-auto">';
                        echo '<div class="sec-btn">';
                            echo '<div class="icon-box">';
                                echo '<button data-slick-prev="#related-post-slide" class="slick-arrow default"><i class="far fa-arrow-left"></i></button>';
                                echo '<button data-slick-next="#related-post-slide" class="slick-arrow default"><i class="far fa-arrow-right"></i></button>';
                            echo '</div>';
                        echo '</div>';
                echo ' </div>';
                echo '</div>';

                echo '<div class="row slider-shadow related-post-carousel" id="related-post-slide">';

                $current_post_id = get_the_ID();  // Get the ID of the current post
                $tags = wp_get_post_tags($current_post_id);  // Get the tags of the current post

                $related_args = array(
                    'tag__in' => wp_list_pluck($tags, 'term_id'),  // Include related tags
                    'post__not_in' => array($current_post_id),  // Exclude the current post
                    'posts_per_page' => 6,
                    'post_status' => 'publish',
                );

                $related_query = new WP_Query($related_args);

                    while ( $related_query->have_posts() ){
                        $related_query->the_post();
                        echo '<div class="col-sm-6 col-xl-4">';
                            echo '<div class="blog-style1">';
                                // Blog Post Thumbnail
                                do_action( 'tnews_blog_post_thumb', 'tnews_392X250', false, true );

                                echo '<h3 class="box-title-20"><a class="hover-line" href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $tnews_related_post_title_count, '' ) ).'</a></h3>';
                                // Blog Post Meta
                                echo '<div class="blog-meta">';
                                    echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'"><i class="far fa-user"></i>'.esc_html__('BY-', 'tnews').esc_html( ucwords( get_the_author() ) ).'</a>';
                                    echo ' <a href="'.esc_url( tnews_blog_date_permalink() ).'"><i class="fal fa-calendar-days"></i>'.esc_html( get_the_date() ).'</a>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                echo '</div>';

            echo '</div>';

            ?>
            <script>
                jQuery(document).ready(function($) {
                    jQuery('.related-post-carousel').slick({
                        dots: false,
                        infinite: true,
                        arrows: false,
                        autoplay: true,
                        autoplaySpeed: 4000,
                        fade: false,
                        speed: 1000,
                        slidesToShow: <?php echo esc_html($tnews_related_post_items); ?>,
                        slidesToScroll: 1,
                        responsive: [{
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 2,
                                    arrows: false,
                                }
                            },
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 2,
                                    arrows: false,
                                }
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 2,
                                    arrows: false,
                                }
                            },
                            {
                                breakpoint: 576,
                                settings: {
                                    slidesToShow: 1,
                                    arrows: false,
                                }
                            }
                        ]
                    });
                });
            </script>
            <?php
        }//end $tnews_display_related_post

    }
}