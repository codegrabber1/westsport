<?php
/**
 * The template for displaying latest news in slider block on homepage.
 * Gets the category for the posts from the theme options.
 *
 * @package Develop & Design.
 * @file    content-maintabs.php
 * @author  codegrabber <[makecodework@gmail.com]>
 */

?>
<?php
    $spec_id = get_post_meta( $post->ID, 'cg_special_news', false );

    $spec_args = array(
        'cat' => $spec_id,
        'post_ststus' => 'publish',
        'ignore_sticky_posts' => 1,
        'taxonomy' => 'category'
    );
    $spec2_args = array(
        'cat' => $spec2_id,
        'post_ststus' => 'publish',
        'ignore_sticky_posts' => 1,
        'taxonomy' => 'category'
    );
?>
<?php
    $query = new WP_Query( $spec_args );
    if( $query -> have_posts() ):
        while( $query -> have_posts() ) : $query -> the_post();
?>
<div class="col-xs-12 col-sm-6 col-md-6">
    <div class="block_lstart">
        <?php if( $title ):?>
            <div class="s_title clearfix">
                <h3 class='entry-title'><?php echo $title ?></h3>
            </div>

        <?php endif;?>
        <?php the_content();?>
    </div>
</div>
<?php endwhile;endif; wp_reset_query();?>