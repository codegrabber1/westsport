<?php
/**
 * The template for displaying services block on homepage.
 * Gets the category for the posts from the theme options.
 *
 * @package Develop & Design.
 * @file    content-services.php
 * @author  codegrabber <[makecodework@gmail.com]>
 */
$serv_id = get_post_meta( $post->ID, 'cg_suggetions_cat', false );
$title = get_post_meta( $post->ID, 'cg_show_suggetions_title', true );


    $serve_args = array(
        'cat' => $serv_id,
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
        'taxonomy' => 'category',
        'paged' => $paged

     );
?>
    <div class="col-xs-12">
        <?php if( $title ):?>
            <div class="s_title clearfix">
                <h3 class='entry-title'><?php echo $title ?></h3>
            </div>
        <?php endif;?>
    </div>
<?php
    $query = new WP_Query( $serve_args );
    if( $query -> have_posts() ):
        while( $query->have_posts() ) : $query->the_post();
?>
<div class="col-xs-12 col-sm-12 col-md-6">
    <div class="b_block clearfix">
            <div class="b_title clearfix">
                <h3><?php //the_title(); ?></h3>
            </div>
        <?php the_post_thumbnail( 'full' )?>
        <?php if( isset($excerpt) ):?>
        <div class="short-text in_block clearfix hidden-xs">
            <?php $excerpt = get_the_excerpt();
            $trimmed_excerpt = wp_trim_words( $excerpt, 15, ' ...' );
            echo $trimmed_excerpt; ?>
        </div>
        <?php endif;?>
        <div class="in_block_btn clearfix">
            <a href="<?php the_permalink(  ) ?>"><?php _e( 'Details', 'codegrabber' );?></a>
        </div>
    </div>
</div>
<?php endwhile;endif;wp_reset_query();?>
