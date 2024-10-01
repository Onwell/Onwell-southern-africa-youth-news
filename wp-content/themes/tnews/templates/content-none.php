<?php

/**
 * @Packge 	   : Tnews
 * @Version    : 1.0
 * @Author 	   : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit;
}
?>
<div class="col-lg-12 filter-item">
	<h2 class="nof-title mb-2"><?php echo esc_html__( 'Nothing Found', 'tnews' ); ?></h2>

	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	    <p  class="nof-desc mb-0"><?php echo sprintf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'tnews' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

	    <p class="nof-desc mb-0"><?php echo esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'tnews' ); ?></p>
    	<div class="content-none-search">
			<div class="widget widget_search">
				<?php get_search_form(); ?>
			</div>
		</div>

	<?php else : ?>

	    <p class="nof-desc mb-0"><?php echo esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'tnews' ); ?></p>
		<?php get_search_form(); ?>

	<?php endif; ?>
</div>