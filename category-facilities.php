<?php
/**
 * The page for sports facilities.
 * Created by codegrabber.
 * @package  codegraber
 * @author   codegrabber
 */
get_header();
?>
<section>
    <div class="container">
        <div class="row">
            <?php
                // $idObj = get_category_by_slug( 'facilities' );
                $id = $id = get_queried_object()->term_id;
                $args = array(
                    'cat' => $id,
                    'posts_per_page' => 1,
                    'post__in' => get_option('sticky_posts')
                );
                $stpost = new WP_Query( $args );
                if( $stpost ) :
                    while( $stpost->have_posts() ): $stpost->the_post();
            ?>
            <article class="sticky">
                <div class="sticky_thumb col-xs-12 col-sm-4 col-md-4">
                    <?php the_post_thumbnail( $size = 'post-thumbnail', $attr = '' )?>
                </div>
                <div class="sticky_content col-xs-12 col-sm-8 col-md-8">
                  <h1><?php the_title( $before = '', $after = '', $echo = true )?></h1>
                  <?php the_content(  )?>
                </div>
            </article>
            <?php endwhile; endif; wp_reset_postdata(); ?>
            <div class="gallery-filter">
                <ul>
                    <li class="filter active" data-filter="all"><span>Все</span></li>
                    <li class="filter" data-filter=".ski"><span>Лижна траса</span></li>
                    <li class="filter" data-filter=".biathlon"><span>Біатлонна траса</span></li>
                    <li class="filter" data-filter=".cableway"><span>Канатна дорога</span></li>
                </ul>
            </div>
            <div id="image-gallery" class="gallery-post clearfix">
                <?php
                    $fObj = get_category_by_slug( 'ski' );
                    $cat_id = $fObj->term_id;
                    $slug = $fObj->slug;
                    $args = array(
                        'cat' => $cat_id,
                        'category_name' => $slug,
                        'ignore_sticky_posts'=> 1,
                        'post__not_in' => get_option('sticky_posts'),
                        );

                    $picsgall = new WP_Query( $args );
                    if( $picsgall ):
                        while( $picsgall->have_posts() ) : $picsgall->the_post();
                        $getPost = get_post();
                        $images = get_post_gallery( $getPost, false ); ;
                        $img_sl = explode( ',', $images['ids']);
                        foreach( $img_sl as $v ) :
                ?>
                <div class="gallery-img mix ski">
                   <a href="<?php the_permalink()?>"> <img src="<?php echo wp_get_attachment_image_url($v, 'full');?>"></a>
                </div>
                <?php endforeach; endwhile; endif;wp_reset_postdata();?>
                <!-- Biathlon -->

                <?php
                    $bObj = get_category_by_slug( 'biathlon' );
                    $cat_id = $bObj->term_id;
                    $slug = $bObj->slug;
                    $args = array(
                        'cat' => $cat_id,
                        'category_name' => $slug,
                        'ignore_sticky_posts'=> 1,
                        'post__not_in' => get_option('sticky_posts'),
                        );

                    $picsgall = new WP_Query( $args );
                    if( $picsgall ):
                        while( $picsgall->have_posts() ) : $picsgall->the_post();
                        $getPost = get_post();
                        $images = get_post_gallery( $getPost, false ); ;
                        $img_sl = explode( ',', $images['ids']);
                        foreach( $img_sl as $b ) :
                ?>
                 <div class="gallery-img mix biathlon">
                    <a href="<?php the_permalink()?>"> <img src="<?php echo wp_get_attachment_image_url($b, 'full');?>"/></a>
                </div>
                <?php endforeach; endwhile;endif;wp_reset_postdata();?><!-- Biathlon -->
                <?php
                    $Obj = get_category_by_slug( 'cableway' );
                    $id = $Obj->cat_ID;
                    $slug = $Obj->slug;
                    $args = array(
                        'cat' => $id,
                        'category_name' => $slug,
                        'ignore_sticky_posts'=> 1,
                        'post__not_in' => get_option('sticky_posts'),
                        );
                    $cablesgall = new WP_Query( $args );
                    if( $cablesgall):
                        while( $cablesgall->have_posts() ) : $cablesgall->the_post();
                            $getPost = get_post();
                            $images = get_post_gallery( $getPost, false ); ;
                            $img_sl = explode( ',', $images['ids']);
                            foreach( $img_sl as $k ) :
                ?>
                <div class="gallery-img mix cableway">
                    <a href="<?php the_permalink()?>"> <img src="<?php echo wp_get_attachment_image_url($k, 'full');?>"/></a>
                </div>
                <?php endforeach; endwhile;endif;wp_reset_postdata();?>
            </div>
        </div>
    </div>
</section>

<?php get_footer();?>