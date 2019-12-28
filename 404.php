<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package codegrabber
 */

get_header();
?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-8">
				<div id="primary" class="content-area">
					<main id="main" class="site-main">
						<section class="error-404 not-found">
							<header class="page-header">
								<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'codegrabber' ); ?></h1>
							</header><!-- .page-header -->

							<div class="page-content">
								<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'codegrabber' ); ?></p>
								<?php
									get_search_form();

									get_template_part( 'template-parts/related-posts' );
								?>
							</div><!-- .page-content -->
						</section><!-- .error-404 -->
					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="widget widget_categories">
					<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'codegrabber' ); ?></h2>
					<ul>
						<?php
						wp_list_categories( array(
							'orderby'    => 'count',
							'order'      => 'DESC',
							'show_count' => 1,
							'title_li'   => '',
							'number'     => 10,
						) );
						?>
					</ul>
				</div><!-- .widget -->

				<?php
				/* translators: %1$s: smiley */
				$codegrabber_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'codegrabber' ), convert_smilies( ':)' ) ) . '</p>';
				the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$codegrabber_archive_content" );

				the_widget( 'WP_Widget_Tag_Cloud' );
				?>
			</div>
		</div>
	</div>
<?php
get_footer();
