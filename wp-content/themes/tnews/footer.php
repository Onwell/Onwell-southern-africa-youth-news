<?php
/**
 * @Packge     : Tnews
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
    
    /**
    *
    * Hook for Footer Content
    *
    * Hook tnews_footer_content
    *
    * @Hooked tnews_footer_content_cb 10
    *
    */
    do_action( 'tnews_footer_content' );


    /**
    *
    * Hook for Back to Top Button
    *
    * Hook tnews_back_to_top
    *
    * @Hooked tnews_back_to_top_cb 10
    *
    */
    do_action( 'tnews_back_to_top' );

    /**
    *
    * tnews grid lines
    *
    * Hook tnews_grid_lines
    *
    * @Hooked tnews_grid_lines_cb 10
    *
    */
    do_action( 'tnews_grid_lines' );

    wp_footer();
    ?>
</body>
</html>