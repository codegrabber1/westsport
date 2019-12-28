<?php
/**
 * Template Name: Main Page
 * Template post type: post, page
 * Description: A page Template to display content on the maim page.
 *
 * @package Develop & Design.
 * @file    page-featured.php
 * @author  codegrabber <[makecodework@gmail.com]>
 */
get_header( );

//<!-- top main slider -->
$feat_bigslider = get_post_meta( $post->ID, 'cg_show_bigslider', true );
if( $feat_bigslider == 1) {
    get_template_part( 'template-parts/content', 'bigslider' );
}

?>
<!-- #top main slider -->
<div id="primary" class="content-area clearfix">
    <main id="main" class="site-main">
      <?php
        $show_services = get_post_meta( $post->ID, 'cg_show_suggetions', true );
        if( $show_services == 1 ):
      ?>
        <section class="wow fadeIn clearfix" data-wow-delay="0.3s">
            <div class="container">
                <div class="row">
                    <?php
                      get_template_part( 'template-parts/content', 'services' );
                    ?>
                </div>
            </div>
        </section>
      <?php endif;?>
      <?php
        $show_specialnews = get_post_meta( $post->ID, 'cg_show_special_news', true );
        if( $show_specialnews == 1 ):
      ?>
        <section class="wow fadeIn clearfix" data-wow-delay="0.3s">
            <div class="container">
                <div class="row">
                    <?php
                        get_template_part( 'template-parts/content', 'infobox' );
                    ?>
                  </div>
              </div>
        </section>
          <?php endif;?>
          <!-- Latest news -->
          <?php
              $show_latestnews = get_post_meta( $post->ID, 'cg_show_latest_news', true );
              if( $show_latestnews == 1 ):
          ?>
          <section class="wow fadeIn clearfix" data-wow-delay="0.3s">
            <div class="container">
              <div class="row">
                  <?php
                      get_template_part( 'template-parts/content', 'latest' );
                  ?>
              </div>
            </div>
          </section>
          <?php endif;?>
          <?php
              $show_intro = get_post_meta( $post->ID, 'cg_show_calendar', true );
              if( $show_intro == 1 ) :
          ?>
          <section class="wow fadeIn clearfix" data-wow-delay="0.3s">
            <div class="container">
                <div class="row">
                  <?php
                      get_template_part( 'template-parts/content', 'latestTabs' );
                  ?>
                </div>
            </div>
          </section>
        <?php endif; ?>
        <!-- !Latest news -->
        <!-- Linear block -->
        <?php
            $show_block = get_post_meta( $post->ID, 'cg_show_block', true );
            if( $show_block == 1 ):
        ?>
          <section class="wow fadeIn clearfix linear" data-wow-delay="0.3s">
              <div class="container">
                <div class="row">
                  <?php
                      get_template_part( 'template-parts/content', 'linear' );
                    ?>
                </div>
              </div>
          </section>
        <?php endif;?>
        <!-- !Linear block -->
        <!-- carousel -->
        <?php
          $show_carousel = get_post_meta( $post->ID, 'cg_show_carousel', true );
          if( $show_carousel == 1):
        ?>
        <section class="wow fadeIn clearfix" data-wow-delay="0.3s">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <?php
                          get_template_part( 'template-parts/content', 'maintabs' );
                        ?>
                    </div>
                </div>
            </div>
        </section>
      <?php endif;?>
        <!-- !carousel -->
        <!-- partners -->
        <?php
          $show_partners = get_post_meta( $post->ID, 'cg_show_partners', true );
          if( $show_partners == 1 ):
        ?>
        <section class="wow fadeIn clearfix" data-wow-delay="0.3s">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <?php
                            get_template_part( 'template-parts/content', 'partners' );
                        ?>
                    </div>
                </div>
            </div>
        </section>
      <?php endif;?>
        <!-- !partners -->
    </main><!-- #main -->
</div><!-- #primary -->
<?php get_footer( );?>
