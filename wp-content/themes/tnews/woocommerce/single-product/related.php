<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( class_exists('ReduxFramework') ) {
    $tnews_woo_relproduct_display = tnews_opt('tnews_woo_relproduct_display');
    $tnews_woo_relproduct_num = tnews_opt('tnews_woo_relproduct_num');
    $tnews_woo_relproduct_slider = tnews_opt('tnews_woo_relproduct_slider');

    $title = tnews_opt('tnews_woo_relproduct_title');
}else{
    $tnews_woo_relproduct_display ='';
    $tnews_woo_relproduct_num = '';
    $tnews_woo_relproduct_slider = '';

    $title = esc_html__('Related Shop','tnews');
}
$slider_active = $tnews_woo_relproduct_slider ? 'related-products-carousel' : '';

if ( $related_products && $tnews_woo_relproduct_display) : ?>

    <div class="space-extra-top">

        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <h2 class="sec-title"><?php echo esc_html($title); ?></h2>
            </div>
            <?php if($tnews_woo_relproduct_num > 4){ ?>
            <div class="col d-none d-sm-block">
                <hr class="title-line">
            </div>
            <div class="col-auto">
                <div class="sec-btn">
                    <div class="icon-box">
                        <button data-slick-prev="#productCarousel" class="slick-arrow default"><i class="far fa-arrow-left"></i></button>
                        <button data-slick-next="#productCarousel" class="slick-arrow default"><i class="far fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

        <div class="row <?php echo esc_attr($slider_active); ?>" id="productCarousel">

        <?php
            if( class_exists('ReduxFramework') ) {
                $tnews_woo_related_product_col = tnews_opt('tnews_woo_related_product_col');
                if( $tnews_woo_related_product_col == '2' ) {
                    $tnews_woo_product_col_val = 'col-xl-2 col-lg-4 col-sm-6 mb-30';
                } elseif( $tnews_woo_related_product_col == '3' ) {
                    $tnews_woo_product_col_val = 'col-xl-3 col-lg-4 col-sm-6 mb-30';
                } elseif( $tnews_woo_related_product_col == '4' ) {
                    $tnews_woo_product_col_val = 'col-xl-4 col-lg-4 col-sm-6 mb-30';
                } elseif( $tnews_woo_related_product_col == '6' ) {
                    $tnews_woo_product_col_val = 'col-lg-6 col-sm-6 mb-30';
                }
            } else {
                $tnews_woo_product_col_val = 'col-xl-3 col-lg-4 col-sm-6 mb-30';
            }
        ?>

            <?php foreach ( $related_products as $related_product ) : ?>
                <div class="<?php echo esc_attr($tnews_woo_product_col_val) ?>">
                    <?php
                        $post_object = get_post( $related_product->get_id() );

                        setup_postdata( $GLOBALS['post'] =& $post_object );

                        wc_get_template_part( 'content', 'product' );
                    ?>
                </div>

            <?php endforeach; ?>

        </div>

    </div>

<?php endif;

wp_reset_postdata();