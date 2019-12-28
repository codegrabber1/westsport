<?php
/**
 * The page for news.
 * Created by codegrabber.
 * @package  codegraber
 * @author   codegrabber
 */
    get_header();
?>

<?php if( have_posts() ) : ?>
    <section>
        <div class="container">
            <div class="row">
          <div class="col-xs-12">
              <?php $cat = get_the_category(); ?>
              <div class="breadcrumbs hidden-xs">
                  <ul>
                      <li><a href="<?php echo home_url();?>"><?php _e( 'Home' );?> </a></li>
                      <li ><a class="current" href="<?php echo get_category_link( $cat[0]->cat_ID );?>"><?=$cat[0]->name;?></a></li>
                  </ul>
              </div>
              <div class="grid">
                    <?php while( have_posts() ) : the_post(); ?>
                    <div class="block_lstart grid-item">
                        <?php get_template_part( 'template-parts/content', 'grid' ); ?>
                    </div>
                    <?php endwhile;?>
              </div>
	            <?php cg_pagination(); ?>
            </div>
        </div>
    </section>
<?php endif;?>
<?php get_footer();?>
