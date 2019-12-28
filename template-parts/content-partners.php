<?php
/**
 * The template for displaying partners links.
 *
 * @package Develop & Design.
 * @file    content-partners.php
 * @author  codegrabber <[makecodework@gmail.com]>
 */
$cat_id = get_post_meta( $post->ID, 'cg_show_partners_carousel', false );
$title = get_post_meta( $post->ID, 'cg_show_partners_title', true );
$args = array(
    'cat'                   => $cat_id,
    'post_status'           => 'publish',
    'ignore_sticky_posts'   => 1,
    'taxonomy'              => 'category'
);

?>
<?php if ( $title ): ?>
    <div class="block_title clearfix">
        <h3 class="entry-title"><?php echo $title;?></h3>
    </div>
    <?php endif;?>
<div class="mainBlock clearfix">

    <div class="slider">
        <?php
            $query = new WP_Query( $args );?>

        <div id="partners" class="owl-carousel">
            <?php
                if( $query -> have_posts() ):
                    while( $query -> have_posts() ) : $query -> the_post();
                    global $post;
            ?>
            <div class="partner_block">
               <?php if( has_post_thumbnail(  ) ):?>
                  <div class="thumb overlay">
                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail()?></a>
                </div>
               <?php endif;?>
            </div>
            <?php endwhile; endif; wp_reset_query();?>
        </div>

    </div>
</div>