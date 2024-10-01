<!doctype html>
<?php
if( class_exists('ReduxFramework') ) {
    $mode = (tnews_opt( 'tnews_color_mode_switcher' )) ? 'light':'dark'; 
} else {
    $mode = 'light';
}

?>
<html <?php language_attributes(); ?> data-theme="<?php echo esc_attr($mode); ?>" class="<?php echo esc_attr($mode); ?>-theme">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head();?>
</head>
<body <?php body_class(); ?>>

<?php
    wp_body_open();

    /**
    *
    * Preloader
    *
    * Hook tnews_preloader_wrap
    *
    * @Hooked tnews_preloader_wrap_cb 10
    *
    */
    do_action( 'tnews_preloader_wrap' );

    /**
    *
    * Preloader
    *
    * Hook tnews_subscribe_popup_wrap
    *
    * @Hooked tnews_subscribe_popup_wrap_cb 10
    *
    */
    do_action( 'tnews_subscribe_popup_wrap' );

    /**
    *
    * tnews header
    *
    * Hook tnews_header
    *
    * @Hooked tnews_header_cb 10
    *
    */
    do_action( 'tnews_header' );