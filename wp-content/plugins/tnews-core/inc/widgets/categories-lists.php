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
* Creating Category List Widget
***************************************/

class tnews_category_list_widget extends WP_Widget {

        function __construct() {

            parent::__construct(

                // Base ID of your widget

                'tnews_category_list_widget',

                // Widget name will appear in UI

                esc_html__( 'Tnews :: Category List', 'tnews' ),

                // Widget description

                array(
                    'classname'                     => 'widget widget_categories',
                    'customize_selective_refresh'   => true,
                    'description'                   => esc_html__( 'Add Category List Widget', 'tnews' ),
                )
            );
        }



        // This is where the action happens

        public function widget( $args, $instance ) {

            $title  = apply_filters( 'widget_title', $instance['title'] );
            $show_cate_bg      = isset( $instance['show_cate_bg'] ) ? $instance['show_cate_bg'] : false;

            //before and after widget arguments are defined by themes

            echo $args['before_widget'];

           if( !empty( $title  ) ){
                echo '<h3 class="widget_title">'.esc_html( $title ).'</h3>';
            }

            if ( isset( $instance[ 'number' ] ) ) {
                $number = $instance[ 'number' ];
            }else {
                $number = '5';
            }

			$categories = get_categories();
            $limit= $number;
            $counter=0;
			?>
            <ul>
                <?php 
                    foreach($categories as $single_category){
                        //catergory term id
                        $term_id = $single_category->term_id;
                        //Category image link -> CMB2 meta
                        $image = get_term_meta( $term_id, '_tnews_term_avatar', 1 );

                        $category_count = $single_category->category_count;
                        if($show_cate_bg){
                            if($counter<$limit){
                                echo '<li><a data-bg-src="'.esc_url($image).'" href="'.esc_url( get_category_link( $single_category->term_id ) ).'">'.$single_category->name.'</a></li>';
                            }
                        }else{
                            if($counter<$limit){
                                echo '<li><a href="'.esc_url( get_category_link( $single_category->term_id ) ).'">'.$single_category->name.'</a></li>';
                            }
                        }
                        $counter++; 
                    }
                    ?>
            </ul>

		<?php
            echo $args['after_widget'];
        }

        // Widget Backend
        public function form( $instance ) {

             //Title
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }else {
                $title = 'Categories';
            }

             //Number
            if ( isset( $instance[ 'number' ] ) ) {
                $number = $instance[ 'number' ];
            }else {
                $number = '5';
            }

            // Widget admin form

            ?>
             <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'tnews'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of Category:' ,'tnews'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
            </p>
            <p>
                <input class="checkbox" type="checkbox"<?php checked( $show_cate_bg ); ?> id="<?php echo $this->get_field_id( 'show_cate_bg' ); ?>" name="<?php echo $this->get_field_name( 'show_cate_bg' ); ?>" />
                <label for="<?php echo $this->get_field_id( 'show_cate_bg' ); ?>"><?php _e( 'Display Category Background?' ); ?></label>
            </p>

            <?php
        }


        // Updating widget replacing old instances with new

        public function update( $new_instance, $old_instance ) {

            $instance = array();
            $instance['title']          = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['number']          = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
            $instance['show_cate_bg']      = isset( $new_instance['show_cate_bg'] ) ? (bool) $new_instance['show_cate_bg'] : false;

            return $instance;
        }
    } // Class tnews_category_list_widget ends here


    // Register and load the widget
    function tnews_category_list_load_widget() {
        register_widget( 'tnews_category_list_widget' );
    }
    add_action( 'widgets_init', 'tnews_category_list_load_widget' );