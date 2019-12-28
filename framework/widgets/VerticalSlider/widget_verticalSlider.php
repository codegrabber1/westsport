<?php
/**
 * Plugin Name: Codegrabber: Big vertical Slider Widget
 * Plugin URI:
 * Description: This widget displays latest articles from specific category.
 * Version: 1.0
 * Author: codegrabber
 * Author URI:
 *
 */
/* ===================
 * Add function to widgets_init that'll load our widget.
 =================== */
add_action( 'widgets_init', 'codegrabber_vSlider_widgets' );
/* ===================
 * Add style and scripts.
 =================== */
add_action( 'admin_print_scripts', 'my_styles_scripts' );

function codegrabber_vSlider_widgets() {
	register_widget( 'codegrabber_vSlider_widget' );
}


function my_styles_scripts(  ) {

	// wp_enqueue_script( 'cg-jq-js', get_template_directory_uri() . '/framework/widgets/VerticalSlider/js/custom.js', array( 'jquery' ), '', true);
	wp_enqueue_style( 'cg-style', get_template_directory_uri() . '/framework/widgets/VerticalSlider/css/style.css' );
}

/* ===================
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 =================== */
class codegrabber_vSlider_widget extends WP_Widget {

	/* ===================
	 * Widget setup.
	 =================== */

	function __construct() {
		/* ===================
		* Widget settings.
		=================== */

		$widget_ops = array( 'classname' => 'f_widget', 'description' => __( 'Displays latest articles from specific category.', 'codegrabber' ) );
		parent::__construct( 'codegrabber_vSlider_widget', __( 'Codegrabber: Big Vertical Slider', 'codegrabber' ), $widget_ops);
	}
	/* ===================
	 * display the widget on the screen.
	 =================== */
	public function widget( $args, $instance ) {
		extract( $args );
		$tab_name 	= $instance['tab_name'];
		$tab_name2	= $instance['tab_name2'];
		$categories = $instance['categories'];
		$posts 		= $instance['posts'];

		if( $categories != 'all' ){
			$categories_array = array( $categories );
		}

		$recent_posts = new WP_Query( array( 'showposts' => $posts, 'post_type' => 'post', 'cat' => $categories, 'ignore_sticky_posts' => 1 ) );
		echo $before_widget;
		?>

		<div class="col-xs-12">
			<div class="mainBlock clearfix">
				<div class="tabs clearfix">
					<span class="tab active"><a href="#tab1"><?php echo $tab_name; ?></a></span>
					<span class="tab"><a class="" href="#tab2"><?php echo $tab_name2; ?></a></span>
				</div>
				<div class="tab_content clearfix">
					<div class="tab_item">
						<div class="slider">
							<div id="latest-news" class="owl-carousel">
								<?php while( $recent_posts->have_posts() ) : $recent_posts->the_post();
									global $post;
								?>
								<div class="item">
									<?php if( has_post_thumbnail() ):?>
										<div class="thumb overlay">
											<a href="<?php the_permalink() ?>"><?php the_post_thumbnail()?></a>
											<div class="exerpt-wrap">
												<h4><a href="<?php the_permalink() ?>"><?php the_title();?></a></h4>
											</div>
										</div>
									<?php endif;?>
								</div>
								<?php endwhile; wp_reset_query();?>
							</div>
						</div>
					</div>
					<div class="tab_item">
						<div class="slider">
							<div id="events" class="owl-carousel">
								<?php while( $recent_posts->have_posts() ) : $recent_posts->the_post();
									global $post;
								?>
								<div class="item">
									<?php if( has_post_thumbnail() ):?>
										<div class="thumb overlay">
											<a href="<?php the_permalink() ?>"><?php the_post_thumbnail()?></a>
											<div class="exerpt-wrap">
												<h4><a href="<?php the_permalink() ?>"><?php the_title();?></a></h4>
											</div>
										</div>
									<?php endif;?>
								</div>
								<?php endwhile; wp_reset_query();?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php

		echo $after_widget;
	}

	/* ===================
	 * update widget settings.
	 =================== */
	function update( $new_instance, $old_instance ){
		$instance = $old_instance;

		$instance['tab_name'] = $new_instance['tab_name'];
		$instance['tab_name2'] = $new_instance['tab_name2'];
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		return $instance;
	}

	public function form( $instance ) {
		$defaults = array( 'tab_name' => "", 'tab_name2' => "", 'categories' => 'all', 'posts' => 3 );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<div class="widget_block">
			<div class="tabs">
				<div class="tab active"><a href="#">tab1</a></div>
				<div class="tab "><a href="#">tab2</a></div>
			</div>
			<div class="tab_content">
				<div class="tab_item active">
					<p>
						<label for="<?php echo $this->get_field_id( 'tab_name' );?>"><?php _e( 'The name of tab', 'codegrabber' );?></label>
						<input class="widwfat" id="<?php echo $this->get_field_id( 'tab_name' );?>" name="<?php echo $this->get_field_name( 'tab_name' );?>" value="<?php echo $instance['tab_name']?>">
					</p>

					<p>
						<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Filter by Category:', 'codegrabber'); ?></label>
						<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
							<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
							<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
							<?php foreach($categories as $category) { ?>
							<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
							<?php } ?>
						</select>
					</p>
					<p>
						<label for="<?php echo $this->get_field_id( 'posts' );?>"><?php _e( 'Number of post', 'codegrabber' );?></label>
						<input class="widwfat" id="<?php echo $this->get_field_id( 'posts' );?>" name="<?php echo $this->get_field_name( 'posts' );?>" value="<?php echo $instance['posts']?>">
					</p>
				</div>
				<div class="tab_item">
					<p>
						<label for="<?php echo $this->get_field_id( 'tab_name2' );?>"><?php _e( 'The name of tab', 'codegrabber' );?></label>
						<input class="widwfat" id="<?php echo $this->get_field_id( 'tab_name2' );?>" name="<?php echo $this->get_field_name( 'tab_name2' );?>" value="<?php echo $instance['tab_name2']?>">
					</p>
				</div>
			</div>
		</div>

		<?php
	}
}