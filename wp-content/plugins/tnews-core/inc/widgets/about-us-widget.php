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
* Creating About Us Widget
***************************************/

class tnews_aboutus_widget extends WP_Widget {

        function __construct() {

            parent::__construct(
                // Base ID of your widget
                'tnews_aboutus_widget',

                // Widget name will appear in UI
                esc_html__( 'Tnews :: About Us Widget', 'tnews' ),

                // Widget description
                array(
                    'customize_selective_refresh'   => true,
                    'description'                   => esc_html__( 'Add About Us Widget', 'tnews' ),
                    'classname'                     => 'no-class',
                )
            );

        }

        // This is where the action happens
        public function widget( $args, $instance ) {

            $about_us   = apply_filters( 'widget_about_us', $instance['about_us'] );
            $social_icon      = isset( $instance['social_icon'] ) ? $instance['social_icon'] : false;
            if ( isset( $instance[ 'logo_img_url' ] ) ) {
                $logo_img_url = $instance[ 'logo_img_url' ];
            }else {
                $logo_img_url = '#';
            }


            //before and after widget arguments are defined by themes
            echo $args['before_widget'];

            echo '<div class="th-widget-about">';
                if( !empty( $logo_img_url )){
                    echo '<div class="about-logo">';
                        echo '<a href="'.esc_url( home_url('/') ).'">';
                            echo tnews_img_tag( array(
                                'url'   => esc_url( $logo_img_url ),
                            ) );
                        echo '</a>';
                    echo '</div>';
                }
                echo '<p class="about-text">'.wp_kses_post( $about_us ).'</p>';
                if($social_icon){
                    echo '<div class="th-social style-black">';
                        echo tnews_social_icon();
                    echo '</div>';
                }
            echo '</div>';

            echo $args['after_widget'];
        }

        // Widget Backend
        public function form( $instance ) {
            
            //Image Url
            if ( isset( $instance[ 'logo_img_url' ] ) ) {
                $logo_img_url = $instance[ 'logo_img_url' ];
            }else {
                $logo_img_url = '';
            }

            if ( isset( $instance[ 'about_us' ] ) ) {
                $about_us = $instance[ 'about_us' ];
            }else {
                $about_us = '';
            }

            $social_icon = isset( $instance['social_icon'] ) ? (bool) $instance['social_icon'] : false;
            
            // Widget admin form
            ?>
            
            <p>
                <label for="<?php echo $this->get_field_id( 'logo_img_url' ); ?>"><?php _e( 'Image URL:' ,'tnews'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'logo_img_url' ); ?>" name="<?php echo $this->get_field_name( 'logo_img_url' ); ?>" type="text" value="<?php echo esc_attr( $logo_img_url ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'about_us' ); ?>">
                    <?php
                        _e( 'About Us:' ,'tnews');
                    ?>
                </label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'about_us' ); ?>" name="<?php echo $this->get_field_name( 'about_us' ); ?>" rows="8" cols="80"><?php echo esc_html( $about_us ); ?></textarea>
            </p>

            <p>
                <input class="checkbox" type="checkbox"<?php checked( $social_icon ); ?> id="<?php echo $this->get_field_id( 'social_icon' ); ?>" name="<?php echo $this->get_field_name( 'social_icon' ); ?>" />
                <label for="<?php echo $this->get_field_id( 'social_icon' ); ?>"><?php _e( 'Display Social Icon?' ); ?></label>
            </p>

            <?php
        }


         // Updating widget replacing old instances with new
         public function update( $new_instance, $old_instance ) {

            $instance = array();
            $instance['logo_img_url']    = ( ! empty( $new_instance['logo_img_url'] ) ) ? strip_tags( $new_instance['logo_img_url'] ) : '';
            $instance['about_us']           = ( ! empty( $new_instance['about_us'] ) ) ? strip_tags( $new_instance['about_us'] ) : '';
            $instance['social_icon']      = isset( $new_instance['social_icon'] ) ? (bool) $new_instance['social_icon'] : false;
            return $instance;
        }
    } // Class tnews_aboutus_widget ends here


    // Register and load the widget
    function tnews_aboutus_load_widget() {
        register_widget( 'tnews_aboutus_widget' );
    }
    add_action( 'widgets_init', 'tnews_aboutus_load_widget' );