<?php
/**
 * @Packge     : Tnews
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

// Block direct access
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

echo '<!-- Single Post -->';
?>
<div <?php post_class(); ?>>
<?php

    // Blog Post Content
    do_action( 'tnews_blog_post_content' );


echo '</div>';
echo '<!-- End Single Post -->';