<?php
/**
 * The template for displaying linear block.
 *
 * @package Develop & Design.
 * @file    content-linear.php
 * @author  codegrabber <[makecodework@gmail.com]>
 */
$cat1_id = get_post_meta( $post->ID, 'cg_show_linear_category1', true );
$cat2_id = get_post_meta( $post->ID, 'cg_show_linear_category1', true );

$args1 = array(
 'cat'                  => $cat1_id,
 'post_status'          => 'publish',
 'posts_per_page'       => 2,
 'post__not_in'         =>get_option('sticky_posts'),
 'taxonomy'             => 'category',
 
 );

$args2 = array(
  'cat'                  => $cat2_id,
  'post_status'          => 'publish',
  'post__in'             => get_option('sticky_posts'),
  'taxonomy'             => 'category'
  );
  ?>
<div class="col-xs-12 col-sm-6 col-md-7">
    <div class="ui piled segment">
    <?php
        $cg_query = new WP_Query( $args1 );
        
        if( $cg_query -> have_posts() ):
            while( $cg_query -> have_posts() ) : $cg_query -> the_post();
          $category_id = get_category_by_slug( 'sushkevich' );
          $category_link = get_category_link( $category_id );  
    ?>
    
      <h4 class="ui header ui right floated header"><a href="<?php echo $category_link;?>"><?php the_title( );?></a></h4>
      <div class="ui clearing divider"></div>
      <p>
          <?php $excerpt = get_the_excerpt();
          $trimmed_excerpt = wp_trim_words( $excerpt, 56, ' [ ... ]' );
          echo $trimmed_excerpt; ?>

      </p>
    <?php endwhile; endif; wp_reset_query();?>
    </div>
        
</div>
<div class="col-xs-12 col-sm-6 col-md-5">
  <?php $query = new WP_Query( $args2 );
      if( $query->have_posts() ):
        while( $query->have_posts() ): $query->the_post();
      $custom_fields = get_post_custom(  );
      ?>
    <?php if( isset ($custom_fields['photo_sushkevich'][0] ) ) : ?>
      <div class="">
        <?php
        $category_id = get_category_by_slug( 'sushkevich' );
        $category_link = get_category_link( $category_id );
        ?>
        <a href="<?php echo $category_link;?>"><img src="<?php echo $custom_fields['photo_sushkevich'][0]?>"> </a>
      </div>
    <?php endif; endwhile; endif; wp_reset_query();?>
</div>
