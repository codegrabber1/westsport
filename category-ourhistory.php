<?php
/**
 * The page for Our History.
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
            //$idObj = get_category_by_slug( 'ourhistory' );
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
              <?php the_content(  )?>
            </div>
        </article>
      <?php endwhile; wp_reset_postdata();?>

        <?php $args = array('posts_per_page' => 10, 'post__not_in' => get_option('sticky_posts'), 'ignore_sticky_posts'=> 1, 'category_name'=>'ourhistory', 'order' => 'ASC');
              $normpost = new WP_Query( $args );
              if( $normpost->have_posts() ) : ?>
                  <div class="timeline-centered">
                     <?php while( $normpost->have_posts() ) : $normpost->the_post();?>
                    <div class="timeline-entry">
                          <div class="timeline-entry-inner">
                             <div class="timeline-icon color-1">
                                <?php the_title();?>
                             </div>
                             <div class="timeline-label wow zoomInUp" data-wow-delay="0.5s">
                                <?php the_content();?>
                                 <footer class="entry-footer clearfix">
                                     <div class="container">
                                         <div class="row">
                                             <?php if( cg_get_option( 'cg_show_post_social' ) == 1 ): ?>
                                                 <div class="single-soc clearfix">
                                                     <ul>
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
                             </div>
                          </div>
                    </div>
                     <?php endwhile;?>
                     <div class="timeline-entry begin">
                    <div class="timeline-entry-inner">
                       <div class="timeline-icon color-none">
                       </div>
                    </div>
                  </div>
                  </div>
           <?php endif;wp_reset_postdata();?>
      </div>
    </div>
  </div>
</section>
<?php get_footer();?>
