<?php
/**
 * The template for displaying latest news on homepage.
 * Gets the category for the posts from the theme options.
 * If no category is selected, displays the latest posts.
 *
 * @package Develop & Design.
 * @file    content-maintabs.php
 * @author  codegrabber <[makecodework@gmail.com]>
 */
?>
<?php
    $cat_id = get_post_meta( $post->ID, 'cg_last_cat', true );
    $title = get_post_meta( $post->ID, 'cg_show_latest_title', true );

    $news_args = array(
        'cat' => $cat_id,
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
        'taxonomy'     => 'category',
        'paged' => $paged,
        'posts_per_page' => 6
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
        $cg_query = new WP_Query( $news_args );
        if( $cg_query -> have_posts() ):
            while( $cg_query -> have_posts() ) : $cg_query -> the_post();
    ?>

<div class="col-xs-12 col-sm-4 col-md-4">
    <div class="block_lstart wow slideInUp animated clearfix" data-wow-delay="0.3s">
        <!-- <div class="limg clearfix">
            <a href="<?php the_permalink();?>">
              <?php the_post_thumbnail( );?>
            </a>
        </div> -->
        <div class="ltext clearfix">
            <h3><a href="<?php the_permalink();?>"><?php the_title( );?></a></h3>
            <p>
                <?php $excerpt = get_the_excerpt();
                $trimmed_excerpt = wp_trim_words( $excerpt, 20, ' [ ... ]' );
                echo $trimmed_excerpt; ?>

            </p>
        </div>
    </div>
</div>
<?php endwhile; endif; wp_reset_query();?>
