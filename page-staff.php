<?php
/**
 * Template Name: Staff page
 * Description: A Page Template to display stuff.
 *
 * @package  Design & Develop
 * @file     page-staff.php
 * @author   codegrabber <makecodework@gmail.com>
 */
?>

<?php get_header(); ?>
<?php
    $staff_sec1 = get_post_meta( $post->ID, 'cg_meta_show_staff_sec1', true );
    $staff_sec2 = get_post_meta( $post->ID, 'cg_meta_show_staff_sec2', true );
    $staff_sec3 = get_post_meta( $post->ID, 'cg_meta_show_staff_sec3', true );

    $sec1_title = get_post_meta($post->ID, 'cg_meta_sec1_title', true);
    $sec2_title = get_post_meta($post->ID, 'cg_meta_sec2_title', true);
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="<?php echo home_url();?>">Home </a></li>
                    <li ><a class="current" href=""><?php echo the_title();?></a></li>
                </ul>
            </div>
        </div>
        <?php if( $staff_sec1 == 1 ):?>
        <section class="staff-dep">
          <div class="col-s-12">
              <?php
                  if( $staff_sec1 ) {
                      echo "<h2>" . $sec1_title . "</h2>";
                  }
              ?>
              <div class="main-post clearfix">
                  <?php
                      $cat_id = get_post_meta( $post->ID, 'cg_meta_sec1_cat', true );
                      $cat2_id = get_post_meta( $post->ID, 'cg_meta_sec2_cat', true );
                      $args = array(
                          'cat' => $cat_id,
                          'post__in' => $ids_array,
                          'post_status' => 'publish',
                          'ignore_sticky_posts' => 1,
                      );
                      $query = new WP_Query( $args );
                      if( $query -> have_posts() ):
                          while( $query->have_posts() ) : $query->the_post();
                          if( has_post_thumbnail(  ) ):
                      ?>
                          <div class="col-xs-12 col-sm-6 col-md-6">
                              <div class="overlay">
                                  <a href="<?php the_permalink()?>"><?php the_post_thumbnail(  )?></a>
                              </div>
                              <h2 class="staff-title"><?php the_title(); ?></h2>
                          </div>
                          <div class="col-xs-12 col-sm-6 col-md-6">
                              <p>
                                  <?php the_content();?>
                              </p>
                          </div>
                      <?php
                          endif;
                          endwhile;
                          endif;
                          wp_reset_query();
                  ?>
              </div>
              <div class="staff_block clearfix">
                  <?php
                      $args = array(
                          'cat' => $cat2_id,
                          'post__in' => $ids_array,
                          'post_status' => 'publish',
                          'ignore_sticky_posts' => 1,
                          'orderby' => 'time',
                          'order' => 'ASC',
                          'posts_per_page' => -1
                      );
                      $query = new WP_Query( $args );
                      if( $query -> have_posts() ):
                          while( $query->have_posts() ) : $query->the_post();
                          if( has_post_thumbnail(  ) ):
                      ?>
                          <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="overlay">
                                  <?php the_post_thumbnail(  )?>
                              </div>
                              <h4 class="staff-title"><?php the_title(); ?></h4>
                              <p>
                                  <?php the_content();?>
                              </p>

                          </div>

                      <?php
                          endif;
                          endwhile;
                          endif;
                          wp_reset_query();
                  ?>
              </div>

          </div>
        </section>
        <?php endif;?>
        <?php if( $staff_sec3 == 1 ):?>
        <section class="staff-dep">
            <div class="col-s-12">
                <?php
                if( $staff_sec3 ) {
                    echo "<h2>" . $sec2_title . "</h2>";
                }
                ?>
                <div class="main-post clearfix">
                <?php
                    $cat3_id = get_post_meta( $post->ID, 'cg_meta_sec3_cat', true );
                    $cat4_id = get_post_meta( $post->ID, 'cg_meta_sec4_cat', true );
                    $args = array(
                        'cat' => $cat3_id,
                        'post__in' => $ids_array,
                        'post_status' => 'publish',
                        'ignore_sticky_posts' => 1,

                    );
                    $query = new WP_Query( $args );
                    if( $query -> have_posts() ):
                        while( $query->have_posts() ) : $query->the_post();
                        if( has_post_thumbnail(  ) ):
                    ?>
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="overlay">
                                <a href="<?php the_permalink()?>"><?php the_post_thumbnail(  )?></a>
                            </div>
                            <h2 class="staff-title"><?php the_title(); ?></h2>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <p>
                                <?php the_content();?>
                            </p>
                        </div>
                    <?php
                        endif;
                        endwhile;
                        endif;
                        wp_reset_query();
                ?>
            </div>
            <div class="staff_block clearfix">
                <?php
                    $args = array(
                        'cat' => $cat4_id,
                        'post__in' => $ids_array,
                        'post_status' => 'publish',
                        'ignore_sticky_posts' => 1,
                        'orderby' => 'time',
                        'order' => 'DESC'
                    );
                    $query = new WP_Query( $args );
                    if( $query -> have_posts() ):
                        while( $query->have_posts() ) : $query->the_post();
                        if( has_post_thumbnail(  ) ):
                    ?>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="overlay">
                                <?php the_post_thumbnail(  )?>
                            </div>
                            <h4 class="staff-title"><?php the_title(); ?></h4>
                            <p>
                                <?php the_content();?>
                            </p>

                        </div>

                    <?php
                        endif;
                        endwhile;
                        endif;
                        wp_reset_query();
                ?>
            </div>
            </div>
        </section>
      <?php endif;?>
    </div>
</div>

<?php get_footer();?>
