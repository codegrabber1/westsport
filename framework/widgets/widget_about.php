<?php
/**
 * Plugin Name: Codegrabber: About me
 * Plugin URI:
 * Description: This widget displays the information and the social links.
 * Version: 1.0
 * Author: codegrabber
 * Author URI: https://codegrabber.blogspot.com/
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */

add_action( 'widgets_init', 'codegrabber_about_widgets' );

function codegrabber_about_widgets() {
	register_widget( 'codegrabber_about_widget' );
}

/**
 * Class codegrabber_about_widget.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.
 */
class codegrabber_about_widget extends WP_Widget {
	/**
	 * Widget setup
	 */
	function __construct() {
		/**
		 * Widget settings
		 */
		$widget_ops = array( 'classname' => 'f_widget',
							 'description' => __( 'Displays the information and the social links.', 'codegrabber' ) );
		parent::__construct( 'codegrabber_about_widget', __( 'Codegrabber: About Us', 'codegrabber' ), $widget_ops );
	}

	/**
	 * Display the widget on the screen.
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {
		extract( $args );
		/*  Our variables from the widget settings. */
		$title          = $instance['title'];
		$image          = $instance['image'];
		$state          = $instance['state'];
		$regCity        = $instance['regCity'];
		$street         = $instance['street'];
		$facebook_url   = $instance['facebook_url'];
		$youtube_url    = $instance['youtube_url'];
		$instagram_url  = $instance['instagram_url'];
		$mail_url       = $instance['mail_url'];
		$titlemodal     = $instance['titlemodal'];
		$contentmodal   = $instance['contentmodal'];

		echo $before_widget;
		?>
		<?php if ( $title ) : ?>
			<h3><?php echo $title;?></h3>
		<?php endif;?>
		<div class="social-links clearfix">
			<ul class="list">
				<?php if( !empty( $facebook_url ) ):?>
					<li>
						<a class="facebook" href="<?php echo $facebook_url; ?>" target="_blank"><i class="fab fa-facebook-square"></i></a>
					</li>
				<?php endif;?>
				<?php if( !empty( $youtube_url )) : ?>
					<li >
						<a class="viber" href="tel:<?php echo $youtube_url; ?>" target="_blank"><i class="fab fa-viber"></i></a>
					</li>
				<?php endif;?>
				<?php if( !empty( $instagram_url )) : ?>
					<li >
						<a class="insta" href="<?php echo $instagram_url; ?>" target="_blank"><i class="fab fa-instagram"></i></a>
					</li>
				<?php endif;?>
                <?php if( !empty( $mail_url ) ) : ?>
                    <li>
                        <a class="f_mail" href="mailto:<?php echo $mail_url;?>" target="_blank"><i class="fas fa-envelope-square"></i></a>
                    </li>
                <?php endif;?>
			</ul>
		</div>
		<?php if ( $image ) : ?>
			<img src="<?php echo $image; ?>" alt="<?php echo $title;?>" />
		<?php endif;?>
		<address>
			<?php if( $state ):?>
			<?php echo $state?> </br>
			<?php endif;?>
			<?php if( $regCity ):?>
				<?php echo $regCity?> </br>
			<?php endif;?>
			<?php if( $street ):?>
				<?php echo $street?> </br>
			<?php endif;?>
		</address>
		<a class="lawBase" href="#" id="lowbase">Правові підстави</a>
		<div class="ui modal">

			<div class="header">
				<i class="close icon"></i>
			<?php if( $titlemodal ): ?>
				<?php echo $titlemodal ?>
			<?php endif;?>
			</div>

			<?php if( $contentmodal ):?>
			<div class="scrolling content">
				<p><?php echo $contentmodal?></p>
			</div>
			<?php endif?>
		</div>
		<?php
		echo $after_widget;

	}
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */

	function form( $instance ) {
		$defaults = array(
			'title'             => '',
			'image'             => '',
			'state'             => '',
			'regCity'           => '',
			'street'            => '',
			'facebook_url'      => '',
			'youtube_url'       => '',
			'instagram_url'     => '',
			'mail_url'     => '',
			'titlemodal'        => '',
			'contentmodal'      => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' )?>"><?php _e( 'Title', 'codegrabber' );?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' )?>" name="<?php echo $this->get_field_name( 'title' )?>" value="<?php echo $instance['title']?>" style="width:100%;">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Photo:', 'codegrabber' ); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>"
			       name="<?php echo $this->get_field_name( 'image' ) ?>" value="<?php echo $instance['image'] ?>" style="width:100%;">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'state' );?>"><?php echo  _e( 'State and ZIP Code', 'codegrabber' );?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'state' );?>" name="<?php echo $this->get_field_name( 'state' );?>" value="<?php echo $instance['state']?>" style="width:100%;">

		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'regCity' );?>"><?php echo  _e( 'Region and City', 'codegrabber' );?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'regCity' );?>" name="<?php echo $this->get_field_name( 'regCity' );?>" value="<?php echo $instance['regCity']?>" style="width:100%;">

		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'street' );?>"><?php echo  _e( 'Street', 'codegrabber' );?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'street' );?>" name="<?php echo $this->get_field_name( 'street' );?>" value="<?php echo $instance['street']?>" style="width:100%;">
		</p>
		<p><label for="<?php echo $this->get_field_id( 'facebook_url' )?>"><?php echo  _e( 'Facebook URL:', 'codegrabber' );?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'facebook_url' )?>" name="<?php echo  $this->get_field_name( 'facebook_url' );?>" value="<?php echo $instance['facebook_url']?>"></p>

		<p><label for="<?php echo $this->get_field_id( 'youtube_url' )?>"><?php echo  _e( 'Youtube URL:', 'codegrabber' );?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'youtube_url' )?>" name="<?php echo  $this->get_field_name( 'youtube_url' );?>" value="<?php echo $instance['youtube_url']?>"></p>

		<p><label for="<?php echo $this->get_field_id( 'instagram_url' )?>"><?php echo  _e( 'Instagram URL:', 'codegrabber' );?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'instagram_url' )?>" name="<?php echo  $this->get_field_name( 'instagram_url' );?>" value="<?php echo $instance['instagram_url']?>"></p>
        <p><label for="<?php echo $this->get_field_id( 'mail_url' )?>"><?php echo  _e( 'Your Email :', 'codegrabber' );?></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'mail_url' )?>" name="<?php echo  $this->get_field_name( 'mail_url' );?>" value="<?php echo $instance['mail_url']?>"></p>
		<p>
			<label for="<?php echo $this->get_field_id( 'titlemodal' )?>"><?php _e( 'Title for law', 'codegrabber' );?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'titlemodal' )?>" name="<?php echo $this->get_field_name( 'titlemodal' )?>" value="<?php echo $instance['titlemodal']?>" style="width:100%;">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'contentmodal' )?>"><?php _e( 'Text for law', 'codegrabber' );?></label>
			<textarea style="width:100%;"  id="<?php echo $this->get_field_id( 'contentmodal' )?>" name="<?php echo $this->get_field_name( 'contentmodal' )?>" rows="10"><?php echo $instance['contentmodal']?></textarea>
		</p>

		<?php
	}

}