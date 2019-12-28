<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package codegrabber
 */

get_header();
?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
                    <?php $cat = get_the_category(); ?>
                    <div class="breadcrumbs hidden-xs hidden-sm">
                        <ul>
                            <li><a href="<?php echo home_url();?>">Home </a></li>
                            <li ><a href="<?php echo get_category_link( $cat[0]->cat_ID );?>"><?=$cat[0]->name;?></a></li>
                            <li ><a class="current" href=""><?php echo the_title();?></a></li>
                        </ul>
                    </div>
            </div>
			<div class="col-xs-12 col-sm-8 col-md-8">
				<div id="primary" class="content-area">
					<main id="main" class="site-main">
                        <?php
                            while ( have_posts() ) :
                                the_post();
                                get_template_part( 'template-parts/content', get_post_type() );
                              if( cg_get_option( 'cg_show_related_posts' ) == 1 ) {
									get_template_part( 'template-parts/related-posts' );
								}
	                            // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;
                            endwhile; // End of the loop.
                        ?>

					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<?php get_sidebar();?>
			</div>
		</div>
	</div>


<?php

get_footer();
