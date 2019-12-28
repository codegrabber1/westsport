<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package codegrabber
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
            if ( is_singular() ) :
                the_title( '<h3 class="entry-title">', '</h3>' );
            else :
                the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		endif; ?>
	</header><!-- .entry-header -->

	<div class="spost_thumb clearfix">
		<?php
			if( cg_get_option( 'cg_show_post_img' ) == 1 ) {
				codegrabber_post_thumbnail();
			}
			 ?>

	</div>

	<div class="entry-content clearfix">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'codegrabber' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'codegrabber' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer clearfix">
		<div class="container">
			<div class="row">
		<?php if( cg_get_option( 'cg_show_post_social' ) == 1 ): ?>
			<div class="single-soc clearfix">
				<ul>
					<li><?php _e( 'Share: ' );?></li>
					<li><a class="fb" href="https://facebook.com/share.php?u=<?php echo urlencode( get_the_permalink() ); ?>&amp;t=<?php echo urlencode( get_the_title() ); ?>" target="_blank"><i class="fab fa-facebook"></i></a></li>
					<li><a class="tw" href="https://twitter.com/home?status=<?php echo urlencode( get_the_title() ); ?>%20<?php echo urlencode( get_the_permalink() ); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
					<!--<li><a class="ins" href="#"><i class="fab fa-instagram"></i></a></li> -->
				</ul>
			</div>
		<?php endif;?>

		<span>
		<?php the_tags( '<i class="fas fa-tags"></i> ', ', ', '<br />' ); ?>
		</span>
			</div>
		</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
