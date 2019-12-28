<?php
/**
 * Plugin Name: Codegrabber: Square thumbnails of Recent Posts.
 * Plugin URI:
 * Description: This widget displays square thumbnails of recent posts in the sidebar and footer.
 * Version: 1.0
 * Author: codegrabber <[makecodework@gmail.com]>.
 * Author URI:
 * @package Develop & Design.
 */

 /* ===================
  * Add public function to widgets_init that'll load our widget.
 =================== */
 add_action( 'widgets_init', 'codegrabber_srp_widgets' );
 function codegrabber_srp_widgets(){
  register_widget( 'codegrabber_srp_widget' );
}

/* ===================
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
=================== */
class codegrabber_srp_widget extends WP_Widget{
  /* ===================
	 * Widget setup.
  =================== */
  function __construct(){
     /* ===================
 	     * Widget settings.
     =================== */
     $widget_ops = array( 'classname' => 'f_widget', 'description' => __( 'This widget displays the most recent posts with big and small thumbnails in the sidebar.', 'codegrabber' ) );
     parent::__construct( 'codegrabber_srp_widget', __( 'Codegrabber: Square Pic', 'codegrabber' ), $widget_ops );
   }
   /* ===================
 	 * display the widget on the screen.
   =================== */
   public function widget( $args, $instance ) {
     extract( $args );
     $title           = apply_filters( 'widget_title', $instance['title'] );
     $categories      = $instance['category'];
     $entries_display = $instance['entries_display'];

     if( empty( $entries_display ) ){
       $entries_display = '6';
     }
     echo $before_widget;
     if( $title ): ?>
     <div class="widget_title">
      <h3><?php echo $title;?></h3>
    </div>
    <?php
    endif;
    $args = array(
      'cat' => $categories,
      'post_type' => 'post',
      'ignore_sticky_posts' => 1,
      'posts_per_page'      => $entries_display
      );
    $query = new WP_Query( $args );
    if( $query->have_posts() ):

      ?>
    <div class="pic-post">
      <?php
      while( $query->have_posts() ) : $query->the_post();
      if( has_post_thumbnail() ) :?>
      <div class="pic">
        <a href="<?php the_permalink( )?>">
          <?php the_post_thumbnail( )?>
        </a>
      </div>
      <?php
      endif;
      endwhile;?>
    </div>
    <?php
    endif;
    wp_reset_query();
  }

   /* ===================
    * @param array $new_instance
    * @param array $old_instance
    * update widget settings.
    * @return array
   =================== */
   public function update( $new_instance, $old_instance ) {
     $instance = $old_instance;

     $instance['title']            = $new_instance['title'];
     $instance['category']         = $new_instance['category'];
     $instance['entries_display']  = $new_instance['entries_display'];
     return $instance;

  }

   /* ===================
     * Displays the widget settings controls on the widget panel.
     * Make use of the get_field_id() and get_field_name() public function
     * when creating your form elements. This handles the confusing stuff.
   =================== */
   public function form( $instance ) {
    $defaults = array( 'title' => 'Square Pic', 'entries_display' => 6, 'category' => '' );
    $instance = wp_parse_args( (array) $instance, $defaults );
    ?>
    <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'codegrabber'); ?></label>
     <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>

     <p><label for="<?php echo $this->get_field_id( 'entries_display' ); ?>"><?php _e('How many entries to display?', 'codegrabber'); ?></label>
      <input type="text" id="<?php echo $this->get_field_id('entries_display'); ?>" name="<?php echo $this->get_field_name('entries_display'); ?>" value="<?php echo $instance['entries_display']; ?>" style="width:100%;" /></p>

      <p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Filter by Category:', 'codegrabber' ); ?></label>
        <select name="<?php echo $this->get_field_name( 'category' )?>" id="<?php echo $this->get_field_id( 'category' )?>" class="widefat categories" style="width:100%;">
          <?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' )?>
          <?php foreach( $categories as $cat ):?>
          <option value="<?php echo $cat->term_id; ?>" <?php if( $cat->term_id == $instance['category'] ) echo 'selected="selected"'?>>
            <?php echo $cat->cat_name; ?>
          </option>
        <?php endforeach?>
      </select>

      <?php
    }
  }
