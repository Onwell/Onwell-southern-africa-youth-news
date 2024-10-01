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
        exit();
    }

    if( class_exists( 'ReduxFramework' ) ) {
        $tnews404title     = tnews_opt( 'tnews_error_title' );
        $tnews404description  = tnews_opt( 'tnews_error_description' );
        $tnews404btntext      = tnews_opt( 'tnews_error_btn_text' );
    } else {
        $tnews404title     = __( 'Oops! Page Not Found!', 'tnews' );
        $tnews404description  = __( 'The page you are looking for does not exist. It might have been moved or deleted.', 'tnews' );
        $tnews404btntext      = __( ' Back To Home', 'tnews');

    }

    // get header //
    get_header(); ?>

    <section class="space2">
        <div class="container">
            <div class="error-img">
                <?php if(!empty(tnews_opt('tnews_error_img', 'url' ) )): ?>
                    <img class="light-img" src="<?php echo esc_url( tnews_opt('tnews_error_img', 'url' ) ) ?>" alt="<?php echo esc_attr__('404 image', 'tnews'); ?>">
                    <img  class="dark-img" src="<?php echo esc_url( tnews_opt('tnews_error_img2', 'url' ) ) ?>" alt="<?php echo esc_attr__('404 image', 'tnews'); ?>">
                <?php else: ?>
                    <img class="light-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/error.svg" alt="<?php echo esc_attr__('404 image', 'tnews'); ?>">
                    <img class="dark-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/error-dark.svg" alt="<?php echo esc_attr__('404 image', 'tnews'); ?>">
                <?php endif; ?>
            </div>
            <div class="error-content">
                <h2 class="error-title"><?php echo wp_kses_post( $tnews404title ); ?></h2>
                <p class="error-text"><?php echo esc_html( $tnews404description ); ?></p>
                <div class="btn-group justify-content-center">
                    <a href="<?php echo esc_url( home_url('/') ); ?>" class="th-btn error-btn"><i class="fal fa-home me-2"></i><?php echo esc_html( $tnews404btntext ); ?></a>
                </div>
            </div>
        </div>
    </section>
    
    <?php
    //footer
    get_footer();