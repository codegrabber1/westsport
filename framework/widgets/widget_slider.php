<?php
/**
 * Plugin Name: Codegrabber: Slider Widget
 * Plugin URI:
 * Description: This widget allows to display latest posts carousel with thumbnails and post title in the sidebar.
 * Version: 1.0
 * Author: codegrabber
 * Author URI:
 *
 */
/* ===================
 * Add function to widgets_init that'll load our widget.
 =================== */
add_action( 'widgets_init', 'codegrabber_slider_widgets' );

function codegrabber_slider_widgets() {
	register_widget( 'codegrabber_slider_widget' );
}
/* ===================
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 =================== */
class codegrabber_slider_widget extends WP_Widget{

	/* ===================
	 * Widget setup.
	 =================== */
	function __construct() {

		/* ===================
	     * Widget settings.
	     =================== */

		$widget_ops = array( 'classname' => 'f_widget', 'description' => __( 'Displays the slider in the sidebar.', 'codegrabber' ) );
		parent::__construct( 'codegrabber_slider_widget', __( 'Codegrabber: Slider', 'codegrabber' ), $widget_ops );
	}
	/* ===================
	 * display the widget on the screen.
	 =================== */
	public function widget( $args, $instance ) {
		extract( $args );

		echo $before_widget;
		$title       = $instance['title'];
		$categories  = $instance['categories'];
		$posts       = $instance['posts'];


		if( $categories != 'all' ) {
			$categories_array = array( $categories );
		}

		$recent_posts = new WP_Query( array( 'showposts' => $posts, 'post_type' => 'post', 'cat' => $categories, 'ignore_sticky_posts' => 1 ) );

		if( $title ) {?>
			<div class="widget-title">
				<h3><?php echo $title;?></h3>
			</div>
			<?php
		} ?>
        <script>
            jQuery(document).ready(function($) {
                $("#sidebar-slider").owlCarousel({
                    nav: true,
                    loop: true,
                    items: 1,
                    navText: "",
										autoplay: true
                });
            });
        </script>
		<div id="sidebar-slider" class="owl-carousel">
				<?php while( $recent_posts->have_posts() ) : $recent_posts->the_post();
					global $post;
				?>
				<?php if( has_post_thumbnail() ):?>
					<div class="item">
						<?php if ( has_post_thumbnail() ) {
							?>
							<div class="thumb overlay">
								<a href="<?php the_permalink() ?>"><?php the_post_thumbnail(  ); ?></a>
                  <div class="excerpt-wrap">
                      <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                  </div>
							</div>
							<?php
						}?>
					</div>
				<?php endif;?>
				<?php endwhile;?>
				<?php wp_reset_query();?>

		</div>
		<?php
		echo $after_widget;
	}

	/* ===================
	 * @param array $new_instance
	 * @param array $old_instance
	 * update widget settings.
	 * @return array
	 =================== */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']      = $new_instance['title'];
		$instance['categories'] = $new_instance['categories'];
		$instance['posts']      = $new_instance['posts'];
		return $instance;

	}

	/* ===================
	 * @param array $instance
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 * @return string
	=================== */
	public function form( $instance ) {
		$defaults = array( 'title' => 'Features Posts', 'categories' => 'all', 'posts' => 5 );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'codegrabber'); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e( 'Filter by Category:', 'codegrabber' ); ?></label>
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
					<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e('Number of posts:', 'codegrabber'); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
		</p>

		<?php
	}

}
?>
