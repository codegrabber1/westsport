<?php
/**
 * The template for displaying the featured carousel on homepage.
 * Gets the category for the posts from the theme options.
 * If no category is selected, displays the latest posts.
 *
 * @package Develop & Design.
 * @file    content-maintabs.php
 * @author  codegrabber <[makecodework@gmail.com]>
 */
?>
<?php
    $cat_id = get_post_meta( $post->ID, 'cg_first_carousel', true );
    $cat2_id = get_post_meta( $post->ID, 'cg_second_carousel', true );
    $title = get_post_meta( $post->ID, 'cg_show_carousel_title', true );
    $tab1_name = get_post_meta( $post->ID, 'cg_carousel_first_tab', true );
    $tab2_name = get_post_meta( $post->ID, 'cg_carousel_second_tab', true );

    $args1 = array(
        'cat'                   => $cat_id,
        'post_status'           => 'publish',
        'ignore_sticky_posts'   => 1,
        'posts_per_page'        => 15
    );
    $args2 = array(
        'cat'                   => $cat2_id,
        'post_status'           => 'publish',
        'ignore_sticky_posts'   => 1,
        'posts_per_page'        => 15
    );
?>
<?php if ( $title ): ?>
    <div class="block_title clearfix">
        <h3 class="entry-title"><?php echo $title;?></h3>
    </div>
    <?php endif;?>
<div class="mainBlock clearfix">

    <div class="tabs clearfix">
        <span class="tab active"><a href="#tab1"><?php echo $tab1_name?></a></span>
        <span class="tab"><a class="" href="#tab2"><?php echo $tab2_name?></a></span>
    </div>
    <div class="tab_content clearfix">
        <div class="tab_item">
            <div class="slider">
                <?php $query = new WP_Query( $args1 );?>
                <div id="latest-news" class="owl-carousel">
                    <?php if( $query->have_posts() ):
                        while( $query->have_posts() ) : $query->the_post();
                        global $post;
                    ?>
                    <div class="item">
                        <?php if( has_post_thumbnail() ):?>
                            <div class="thumb overlay">
                                <a href="<?php the_permalink() ?>"><?php the_post_thumbnail()?></a>
                            </div>
                            <div class="excerpt-wrap">
                                    <h4><a href="<?php the_permalink() ?>"><?php the_title();?></a></h4>
                                </div>
                        <?php endif;?>
                    </div>
                    <?php endwhile; ?>
                <?php endif; wp_reset_query();?>
                </div>
            </div>
        </div>
        <div class="tab_item">
            <div class="slider">
                <?php $query = new WP_Query( $args2 );?>
                <div id="events" class="owl-carousel">
                    <?php if( $query->have_posts() ):
                        while( $query->have_posts() ) : $query->the_post();
                        global $post;
                    ?>
                    <div class="item">
                        <?php if( has_post_thumbnail() ):?>
                            <div class="thumb overlay">
                                <a href="<?php the_permalink() ?>"><?php the_post_thumbnail()?></a>
                                <div class="excerpt-wrap">
                                    <h4><a href="<?php the_permalink() ?>"><?php the_title();?></a></h4>
                                </div>
                            </div>
                        <?php endif;?>
                    </div>
                    <?php endwhile; ?>
                <?php endif; wp_reset_query();?>
                </div>
            </div>
        </div>
    </div>
</div>