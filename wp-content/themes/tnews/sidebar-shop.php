<?php
	// Block direct access
	if( ! defined( 'ABSPATH' ) ){
		exit( );
	}
	/**
	* @Packge 	   : Tnews
	* @Version     : 1.0
	* @Author     : Themeholy
    * @Author URI : https://themeforest.net/user/themeholy
	*
	*/

	if( ! is_active_sidebar( 'tnews-woo-sidebar' ) ){
		return;
	}
?>
<div class="col-xl-3 col-lg-4">
	<!-- Sidebar Begin -->
	<aside class="sidebar-area shop-sidebar">
		<?php
			dynamic_sidebar( 'tnews-woo-sidebar' );
		?>
	</aside>
	<!-- Sidebar End -->
</div>