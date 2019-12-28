<?php
/**
 * The template for displaying linear block.
 *
 * @package Develop & Design.
 * @file    content-linear.php
 * @author  codegrabber <[makecodework@gmail.com]>
 */
$cat1_id = get_post_meta( $post->ID, 'cg_show_linear_category1', true );
$cat2_id = get_post_meta( $post->ID, 'cg_show_linear_category2', true );

$args1 = array(
 'cat'                  => $cat1_id,
 'post_status'          => 'publish',
 'posts_per_page'       => 1,
 'post__in'             => get_option('sticky_posts'),
 'taxonomy'             => 'category'
 );

$args2 = array(
  'cat'                  => $cat2_id,
  'post_status'          => 'publish',
  'ignore_sticky_posts'  => 1,
  'taxonomy'             => 'category'
  );
  ?>
  <div class="col-xs-12 col-sm-6 col-md-6">
    <?php $query = new WP_Query( $args1 );
    if( $query->have_posts() ):
      while( $query->have_posts() ): $query->the_post();
    $custom_fields = get_post_custom(  );
    ?>
    <?php if( isset ($custom_fields['photo_sushkevich'][0] ) ) : ?>
    <div class="l_thumb">
      <?php
      $category_id = get_category_by_slug( 'sushkevich' );
      $category_link = get_category_link( $category_id );
      ?>
      <a href="<?php echo $category_link;?>"><img src="<?php echo $custom_fields['photo_sushkevich'][0]?>"> </a>
    </div>
  <?php endif;?>
  <?php if( isset ( $custom_fields['desc_sushkevich'][0] ) ) : ?>
  <div class="linear_content">
    <h2><?php echo $custom_fields['desc_sushkevich'][0];?></h2>
  </div>
<?php endif;?>
<?php endwhile; endif;wp_reset_query();?>

</div>
<div class="col-xs-12 col-sm-6 col-md-6">
  <?php $query = new WP_Query( $args2 );
  if( $query->have_posts() ):
    while( $query->have_posts() ): $query->the_post();
  $custom_fields = get_post_custom(  );
          // var_dump($custom_fields);
  ?>
  <?php if( isset( $custom_fields['photo_rozbud'][0] ) ) : ?>
  <div class="l_thumb">
    <?php
    $category_id    = get_category_by_slug( 'ourhistory' );
    $category_link  = get_category_link( $category_id );
    ?>
    <a href="<?php echo $category_link;?>"><img src="<?php echo $custom_fields['photo_rozbud'][0]?>"> </a>
  </div>
<?php endif;?>
<?php if( isset( $custom_fields['desc_rozbud'][0] ) ) : ?>
  <div class="linear_content">
    <h2><?php echo $custom_fields['desc_rozbud'][0];?></h2>
  </div>
<?php endif;?>
<?php endwhile; endif;wp_reset_query();?>
</div>
