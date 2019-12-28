<?php
/**
 * Plugin Name: Codegrabber: Popular Tags
 * Plugin URI:  codegrabber.blogspot.com
 * Description: This widget displays displays the popular tags.
 * Version: 1.0
 * Author: codegrabber
 * Author URI: https://codegrabber.blogspot.com/
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'codegrabber_recent_tags_widgets' );

function codegrabber_recent_tags_widgets() {
    register_widget( 'codegrabber_recent_tags' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.
 *
 */

class codegrabber_recent_tags extends WP_Widget {
    /**
     * Widget setup
     */
    function __construct() {
        $widget_ops = array( 'classname' => 'f_widget clearfix', 'description' => __( 'Displays the popular tags with the post count.', 'codegrabber' ) );
        parent:: __construct( 'codegrabber_recent_tags_widget', __( 'Codegrabber: Popular Tags', 'codegrabber' ), $widget_ops );
    }

    /**
     *display the widget on the screen.
     */
    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $before_widget;
        if( $title ) {?>
        <div class="s_date">
            <h3><?php echo $title; ?></h3>
        </div>
        <?php }

        $entries_display = $instance['entries_display'];

        if( empty($entries_display) ) {
            $entries_display = 10;
        }

        $args = array(
            'number'    => $entries_display,
            'orderby'   => 'count',
            'order'     => 'DESC'
        );

        $tags = get_tags( $args );
        if( $tags ) : ?>
        <div class="tagcloud">
            <?php foreach( $tags as $tag ) : ?>
            <a href="<?php echo get_tag_link( $tag->term_id )?>" title="<?php echo sprintf( __( "View all posts in %s" ), $tag->name )?>"><i class="fas fa-tags"></i><?php echo $tag->name?></a>
            <?php endforeach; ?>
        </div>
    <?php
    endif;
    /* After widget (defined by themes). */
    echo $after_widget;
}

/**
 * Displays the widget settings controls on the widget panel.
 * Make use of the get_field_id() and get_field_name() function
 * when creating your form elements. This handles the confusing stuff.
 */
function form( $instance ) {
    $default = array( 'title' => 'Popular Topics', 'entries_display' => 10 );
    $instance = wp_parse_args( (array) $instance, $default );
    ?>
    <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'codegrabber'); ?></label>
        <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>

    <p><label for="<?php echo $this->get_field_id( 'entries_display' ); ?>"><?php _e('How many entries to display?', 'codegrabber'); ?></label>
        <input type="text" id="<?php echo $this->get_field_id('entries_display'); ?>" name="<?php echo $this->get_field_name('entries_display'); ?>" value="<?php echo $instance['entries_display']; ?>" style="width:100%;" /></p>
     <?php
        }
    }
