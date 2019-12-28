<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package codegrabber
 */

get_header();
?>
<div class="container">
	<div class="row">
		<div class="breadcrumbs">
                <ul>
                    <li><a href="<?php echo home_url();?>"><?php _e( 'Home' );?> </a></li>
                    <li ><a class="current" href=""><?php echo the_title();?></a></li>
                </ul>
        </div>
		<div class="col-xs-12 col-sm-6 col-md-8">
			<div id="primary" class="content-area">
				<main id="main" class="site-main">

				<?php if ( have_posts() ) : ?>
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', get_post_type() );
					endwhile;
					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<?php get_sidebar();?>
		</div>
	</div>
</div>

<?php

get_footer();
