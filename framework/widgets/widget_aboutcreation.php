<?php
/**
 * Plugin Name: Codegrabber: About Creation
 * Plugin URI:  codegrabber.blogspot.com
 * Description: The widget shows the basics of the creation.
 * Version: 1.0
 * Author: codegrabber
 * Author URI: https://codegrabber.blogspot.com/
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'codegrabber_basics_creation_widgets' );

function codegrabber_basics_creation_widgets() {
    register_widget( 'codegrabber_basics_creation_widget' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.
 *
 */

class codegrabber_basics_creation_widget extends WP_Widget {
    /**
     * Widget setup
     */
    function __construct() {
        $widget_ops = array( 'classname' => 'widget_creation', 'description' => __( 'The widget shows the basics of the creation.', 'codegrabber' ) );
        parent:: __construct( 'codegrabber_basics_creation_widget', __( 'Codegrabber: The basics of creation', 'codegrabber' ), $widget_ops );
    }

    /**
     * [widget description]
     * @return [type] [description]
     * display the widget on the screen.
     */
   function widget( $args, $instance ) {
        extract( $args );
       $title = apply_filters( 'widget_title', $instance['title'] );
       $text  = $instance['text'];

       echo $before_widget;
        if( $title ) {?>
            <div class="s_date">
                <h3><?php echo $title; ?></h3>
            </div>
        <?php }

        if( $text ) {?>
            <p>
                <?php echo $text;?>
            </p>
        <?php
        }

   }

   /**
    * Displays the widget settings controls on the widget panel.
    * Make use of the get_field_id() and get_field_name() function
    * when creating your form elements. This handles the confusing stuff.
    * @param  [type] $instance [description]
    * @return [type]           [description]
    */
   function form( $instance ) {
        $defaults = array( 'title' => '', );
        $instance = wp_parse_args( (array) $instance, $defaults );
    ?>
    <p>
        <label for="<?php echo $this->get_field_id('title')?>"><?php _e( 'Title', 'codegrabber' );?></label>
        <input type="text" id="<?php echo $this->get_field_id('title')?>" name="<?php echo $this->get_field_name('title')?>" value="<?php echo $instance['title']?>" style="width:100%">
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('text')?>"><?php _e( 'Put your text', 'codegrabber' );?></label>
        <textarea name="<?php echo $this->get_field_name('text')?>" id="<?php echo $this->get_field_id('text')?>" style="width:100%" rows="10"></textarea>
    </p>
   <?php
   }
}