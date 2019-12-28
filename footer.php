<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package codegrabber
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="topfooter">
			<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div class="widget wow zoomInUp">
						<?php if ( ! dynamic_sidebar( 'Footer-1' ) ):?>
							<!-- <h3>Set the widget here</h3> -->
						<?php endif; ?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div class="widget wow zoomInUp">
						<?php if ( !dynamic_sidebar( 'Footer-2' ) ): ?>
							<!-- <h3>Set the widget here</h3> -->
						<?php endif; ?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4">
					<div class="widget wow zoomInUp">
						<?php if ( !dynamic_sidebar( 'Footer-3' ) ) : ?>
							<!-- <h3>Set the widget here</h3> -->
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		</div>
		<div class="subfooter">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-3">
						&copy;&nbsp;<?php echo date('Y')?>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-9">
						<div class="site-info">
							Західний реабілітаційно-спортивний центр» НКСІУ
						</div><!-- .site-info -->
					</div>

				</div>
			</div>
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
 	new WOW().init();
</script>
</body>
</html>
