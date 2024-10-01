<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( );
}
/**
 * @Packge    : Tnews
 * @version   : 1.0
 * @Author    : Themeholy
 * @Author URI: https://themeforest.net/user/themeholy
 * Template Name: Template Builder
 */

//Header
get_header();

// Container or wrapper div
$tnews_layout = tnews_meta( 'custom_page_layout' );

if( $tnews_layout == '1' ){ ?>
	<div class="tnews-main-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
<?php }elseif( $tnews_layout == '2' ){ ?>
    <div class="tnews-main-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
<?php }else{ ?>
	<div class="tnews-fluid">
<?php } ?>
	<div class="builder-page-wrapper">
	<?php 
	// Query
	if( have_posts() ){
		while( have_posts() ){
			the_post();
			the_content();
		}
        wp_reset_postdata();
	} ?>

	</div>
<?php if( $tnews_layout == '1' ){ ?>
				</div>
			</div>
		</div>
	</div>
<?php }elseif( $tnews_layout == '2' ){ ?>
				</div>
			</div>
		</div>
	</div>
<?php }else{ ?>
	</div>
<?php }

//footer
get_footer();