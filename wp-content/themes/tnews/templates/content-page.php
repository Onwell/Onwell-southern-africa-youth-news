<?php
/**
 * @Packge     : Tnews
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

// Block direct access
if (!defined('ABSPATH')) {
    exit;
}
?>
<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 

	/**
	 * page content 
	 * Comments Template
	 * @Hook  tnews_page_content
	 *
	 * @Hooked tnews_page_content_cb
	 * 
	 *
	 */
	do_action( 'tnews_page_content' );
	?>
</div>