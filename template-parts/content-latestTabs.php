<?php
/**
 * The template for displaying latest news in tabs on homepage.
 * Gets the category for the posts from the theme options.
 * If no category is selected, displays the latest posts.
 *
 * @package Develop & Design.
 * @file    content-latestTabs.php
 * @author  codegrabber <[makecodework@gmail.com]>
 */
?>
<?php
$cat_id     = get_post_meta( $post->ID, 'cg_short_desc', true );
$title      = get_post_meta( $post->ID, 'cg_show_calendar_title', true );

$args = array(
    'cat' => $cat_id,
    'post_status' => 'publish',
    'ignore_sticky_posts' => 1,
    'taxonomy' => 'category',
    'posts_per_page' => 5
 );
?>
<div class="col-xs-12">
    <?php if( $title ):?>
        <div class="s_title clearfix">
            <h3 class='entry-title'><?php echo $title ?></h3>
        </div>
    <?php endif;?>
</div>
<div class="col-xs-12" id="newstab">
  <?php

     $query = new WP_Query( $args );
     if( $query->have_posts() ):

  ?>
  <div class="small_tabs clearfix">
    <div class="leftSide clearfix">
      <?php while( $query->have_posts() ) : $query->the_post();?>
          <span class="left-tab"><?php the_title();?> </span>
      <?php endwhile; ?>
    </div>
    <div class="rightSide clearfix">
    <?php while( $query->have_posts() ) : $query->the_post(); ?>
    <div class="right-item">
      <?php if( has_post_thumbnail(  ) ) : ?>
      <div class="tab_thumb">
          <?php the_post_thumbnail( )?>
      </div>
      <?php endif;?>
      <div class="tab_content">
        <?php
          $excerpt = get_the_excerpt( );
          $trimmed_excerpt = wp_trim_words( $excerpt, 15 );
          echo $trimmed_excerpt;
        ?>
      </div>
      </div>
    <?php endwhile;?>
  </div>
  </div>
  <?php endif; wp_reset_query();?>
</div>
