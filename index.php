<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package codegrabber
 */

get_header();
?>
<!-- top main slider -->
<!-- main content -->
<div id="primary" class="content-area clearfix">
	<main id="main" class="site-main">
		<!-- main text -->
		<?php
		if ( have_posts() ) :
		if ( is_home() && is_front_page() ) :
		?>
		<section class="wow fadeIn" data-wow-delay="0.3s">
			<div class="container">
				<div class="row">
						<?php
							///* Start the Loop */
							while ( have_posts() ) :  the_post(); ?>
								<div class="col-xs-12 col-sm-6 col-md-4">
									<div class="block_lstart wow slideInUp animated" data-wow-delay="0.3s">
										<a href="<?php the_permalink();?>">
											<?php the_post_thumbnail( );?>
										</a>
										<h3><a href="<?php the_permalink();?>"><?php the_title( );?></a></h3>
										<p>
											<?php $excerpt = get_the_excerpt();

											$trimmed_excerpt = wp_trim_words( $excerpt, 20, ' ...' );
											echo $trimmed_excerpt; ?>
										</p>
										<p class="m_button"><a href="<?php the_permalink();?>"><?php _e( 'Read more' );?></a></p>
									</div>
								</div>
						<?php
							endwhile;
							the_posts_navigation();
					   ?>
			</div>
		</section><!-- !main text -->

		<!-- Events -->
		<section class="wow fadeIn" data-wow-delay="0.5s">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="mainBlock clearfix">
							<h3 class="entry-title"><?php _e( 'Responce', 'codegrabber' );?></h3>
							<div class="col-xs-12">
								<div class="slider">
									<div id="responce" class="owl-carousel">
										<div class="r_block clearfix">
											<div class="col-md-4">text1</div>
											<div class="col-md-8">
												<h3>The Author of responce</h3>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores facere, itaque laboriosam nihil nulla obcaecati odio quae ratione saepe. Dicta?
											</div>

										</div>
										<div class="r_block clearfix">
											<div class="col-md-4">text1</div>
											<div class="col-md-8">
												<h3>The Author of responce</h3>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores facere, itaque laboriosam nihil nulla obcaecati odio quae ratione saepe. Dicta?
											</div>

										</div>
										<div class="r_block clearfix">
											<div class="col-md-4">text1</div>
											<div class="col-md-8">
												<h3>The Author of responce</h3>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores facere, itaque laboriosam nihil nulla obcaecati odio quae ratione saepe. Dicta?
											</div>

										</div>
										<div class="r_block clearfix">
											<div class="col-md-4">text1</div>
											<div class="col-md-8">
												<h3>The Author of responce</h3>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores facere, itaque laboriosam nihil nulla obcaecati odio quae ratione saepe. Dicta?
											</div>

										</div>
										<div class="r_block clearfix">
											<div class="col-md-4">text1</div>
											<div class="col-md-8">
												<h3>The Author of responce</h3>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores facere, itaque laboriosam nihil nulla obcaecati odio quae ratione saepe. Dicta?
											</div>

										</div>
										<div class="r_block clearfix">
											<div class="col-md-4">text1</div>
											<div class="col-md-8">
												<h3>The Author of responce</h3>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores facere, itaque laboriosam nihil nulla obcaecati odio quae ratione saepe. Dicta?
											</div>

										</div>
										<div class="r_block clearfix">
											<div class="col-md-4">text1</div>
											<div class="col-md-8">
												<h3>The Author of responce</h3>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores facere, itaque laboriosam nihil nulla obcaecati odio quae ratione saepe. Dicta?
											</div>

										</div>
										<div class="r_block clearfix">
											<div class="col-md-4">text1</div>
											<div class="col-md-8">
												<h3>The Author of responce</h3>
												Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores facere, itaque laboriosam nihil nulla obcaecati odio quae ratione saepe. Dicta?
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</section><!-- !Events -->
		<?php
		else :
			get_template_part( 'template-parts/content', 'none' );
		 endif;
		endif; ?>
	</main><!-- #main -->
</div><!-- #primary -->
<!-- #main content -->
<?php
	get_footer();
