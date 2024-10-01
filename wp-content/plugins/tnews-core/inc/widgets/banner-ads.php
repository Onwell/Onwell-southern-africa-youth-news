<?php
/**
* @version  1.0
* @package  tnews
* @author   Themeholy <themeholy@gmail.com>
*
* Websites: https://themeholy.com/
*
*/

/**************************************
* Creating Offer Banner Widget
***************************************/

class tnews_offer_banner_widget extends WP_Widget {

        function __construct() {

            parent::__construct(
                // Base ID of your widget
                'tnews_offer_banner_widget',

                // Widget name will appear in UI
                esc_html__( 'Tnews :: Ads Banner Widget', 'tnews' ),

                // Widget description
                array(
                    'customize_selective_refresh'   => true,
                    'description'                   => esc_html__( 'Add Banner Ads Widget', 'tnews' ),
                    'classname'                     => 'no-banner-widget',
                )
            );

        }

        // This is where the action happens
        public function widget( $args, $instance ) {

            if ( isset( $instance[ 'banner_img_url' ] ) ) {
                $banner_img_url = $instance[ 'banner_img_url' ];
            }   

            if ( isset( $instance[ 'button_url' ] ) ) {
                $button_url = $instance[ 'button_url' ];
            }else {
                $button_url = '#';
            }

        	echo $args['before_widget'];

                echo '<div class="widget-ads">';
                    echo '<a href="'.esc_url( $button_url ).'">';
                        echo tnews_img_tag( array(
                            'url'   => esc_url($banner_img_url),
                            'class' => 'w-100'
                        )); 
                    echo '</a>';
                echo '</div>';

           echo $args['after_widget'];
        }

        // Widget Backend
        public function form( $instance ) {

             //Image Url
            if ( isset( $instance[ 'banner_img_url' ] ) ) {
                $banner_img_url = $instance[ 'banner_img_url' ];
            }else {
                $banner_img_url = '';
            }          

            if ( isset( $instance[ 'button_url' ] ) ) {
                $button_url = $instance[ 'button_url' ];
            }else {
                $button_url = '';
            }

        	?>
            <p>
                <label for="<?php echo $this->get_field_id( 'banner_img_url' ); ?>"><?php _e( 'Ads Image URL:' ,'tnews'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'banner_img_url' ); ?>" name="<?php echo $this->get_field_name( 'banner_img_url' ); ?>" type="text" value="<?php echo esc_attr( $banner_img_url ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php _e( 'Ads Image URL:' ,'tnews'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text" value="<?php echo esc_attr( $button_url ); ?>" />
            </p>

        	<?php
           
        }


         // Updating widget replacing old instances with new
         public function update( $new_instance, $old_instance ) {
                $instance = array();
                $instance['banner_img_url']    = ( ! empty( $new_instance['banner_img_url'] ) ) ? strip_tags( $new_instance['banner_img_url'] ) : ''; 
                $instance['button_url']     = ( ! empty( $new_instance['button_url'] ) ) ? strip_tags( $new_instance['button_url'] ) : '';
                return $instance;
           
        }

    } // Class tnews_offer_banner_widget ends here


    // Register and load the widget
    function tnews_offer_banner_load_widget() {
        register_widget( 'tnews_offer_banner_widget' );
    }
    add_action( 'widgets_init', 'tnews_offer_banner_load_widget' );