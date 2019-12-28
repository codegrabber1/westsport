<?php
/**
 * The page for projects of Western Rehabilitation and Sports Center.
 * Created by codegrabber.
 * @package  codegraber
 * @author   codegrabber
 */
get_header();

?>

  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <?php
        $cat_id = get_queried_object()->term_id;
        $args = array(
          'cat' => $cat_id,
          'posts_per_page' => 1,
          'post__in' => get_option('sticky_posts')
          );
        $stickyposts = new WP_Query( $args );
        while( $stickyposts->have_posts() ): $stickyposts->the_post();
        ?>
        <article class="sticky">
          <div class="sticky_thumb col-xs-12 col-sm-12 col-md-4">
            <?php the_post_thumbnail( $size = 'post-thumbnail', $attr = '' )?>
          </div>
          <div class="sticky_content col-xs-12 col-sm-12 col-md-8">
            <h1><?php the_title( $before = '', $after = '', $echo = true )?></h1>
            <p><?php the_content()?></p>
          </div>
        </article>
      <?php endwhile; wp_reset_postdata();?>
    </div>
  </div>
</div>
</section>
<section class="b_year">
  <div class="container">
    <div class="row">
      <?php
        $catObj = get_queried_object();
        $args = array(
          'parent' => $catObj->parent,
          'ignore_sticky_posts'=> 1,
        );

        $cat2 = get_query_var('cat');
        $sub_projectpost = get_categories( $args );
        if( $sub_projectpost ) :
          foreach( $sub_projectpost as $cat ):
            if( $cat->term_id == $cat2 ) :
      ?>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <span class="active">
                <a  href="<?php echo get_category_link( $cat->term_id )?>">
              <?php echo $cat->name;?></a>
            </span>
        </div>
      <?php
          else:
      ?>
      <div class="col-xs-12 col-sm-4 col-md-4">
        <span><a  href="<?php echo get_category_link( $cat->term_id )?>">
          <?php echo $cat->name;?></a></span>
      </div>
       <?php
          endif;
          endforeach;
          endif;
      ?>
    </div>
  </div>
</section>
<section id='timeline'>
  <?php
    $dataObj = get_queried_object();
    $args = array(
      'cat' => $dataObj->term_id,
      'post__not_in' => get_option('sticky_posts'),
      'ignore_sticky_posts'=> 1,
      'order' => 'ASC',
      'post_type' => 'post',
      );
    $projectpost = new WP_Query( $args );
    if( $projectpost->have_posts() ) :
      while( $projectpost->have_posts()  ): $projectpost->the_post();
  ?>
    <div class="inner ">
      <div class="inner_block">
        <h2><?php the_title()?></h2>
        <div class="inner_block_content">
            <?php
              $excerpt = get_the_excerpt();
              $trimmed_excerpt = wp_trim_words( $excerpt, 15, ' ...' );
              echo $trimmed_excerpt;
            ?>
        </div>
        <a href="<?php the_permalink()?>"><?php the_post_thumbnail(  );?></a>
      </div>
    </div>
  <?php endwhile; endif; wp_reset_query();?>
</section>
<section>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <?php get_template_part( 'template-parts/related-posts' );?>
      </div>
    </div>
  </div>
</section>
<?php
  get_footer();