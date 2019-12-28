<?php
/**
 * The page for Sushkevich V.M.
 * Created by codegrabber.
 * @package  codegraber
 * @author   codegrabber
 */
 get_header();
?>
<section>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
      
        <?php
            // $idObj = get_category_by_slug( 'sushkevich' );
            $cat_id = get_queried_object()->term_id;
            $args = array(
                'cat' => $cat_id,
                'posts_per_page' => 1,
                'post__in' => get_option('sticky_posts')
            );
            $stickyposts = new WP_Query( $args );
            while( $stickyposts->have_posts() ): $stickyposts->the_post();
        ?>
        <article class="sticky">
            <div class="sticky_thumb col-xs-12 col-sm-4 col-md-4">
              <?php the_post_thumbnail( $size = 'post-thumbnail', $attr = '' )?>
            </div>
            <div class="sticky_content col-xs-12 col-sm-8 col-md-8">
              <h1><?php the_title( $before = '', $after = '', $echo = true )?></h1>
              <p><?php the_content(  )?></p>
            </div>
        </article>
      <?php endwhile; wp_reset_postdata();?>

        <?php
            $args = array(
                  'posts_per_page' => 10,
                  'post__not_in' => get_option('sticky_posts'),
                  'ignore_sticky_posts'=> 1,
                  'category_name'=>'sushkevich'
            );
              $normpost = new WP_Query( $args );
              if( $normpost->have_posts() ) : ?>
        <div class="grid">
          <?php while( $normpost->have_posts() ) : $normpost->the_post();?>
            <div class="block_lstart grid-item">
                <?php get_template_part( 'template-parts/content', 'grid' ); ?>
            </div>
          <?php endwhile;?>
        </div>
        <?php endif;wp_reset_postdata();?>
      </div>
    </div>
  </div>
</section>
<?php get_footer();?>
