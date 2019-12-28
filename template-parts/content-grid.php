<?php
/**
 * The template for displaying content for ato
 *
 * @package  codegrabber
 * @file     blog-excerpt.php
 * @author   codegrabber
 *
 */
?>
<div class="grid-imgblock clearfix">
    <a href="<?php the_permalink()?>"><?php the_post_thumbnail()?></a>
    <h3 class="wow fadeIn animated grid-title" data-wow-delay="0.3s"><?php the_title()?></h3>
</div>

<p class=" wow fadeIn animated clearfix" data-wow-delay="0.3s">
    <?php
    $excerpt = get_the_excerpt();

    $trimmed_excerpt = wp_trim_words( $excerpt, 15, ' ...' );
    echo $trimmed_excerpt;
    ?>
</p>
<div class="clearfix">
    <p class=" "><a href="<?php the_permalink()?>"><?php echo __( 'Read more' )?></a></p>
</div>
