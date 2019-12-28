<?php
/**
 * [$bigslider description]
 * @var WP_Query
 */

$bigslider = new WP_Query( array( 'post_type' => 'bigslider' ) );
if( $bigslider->have_posts() ):?>
    <section class="clearfix">
        <div class="main-slider">
                <div class="owl-carousel bigslider-carousel">
                    <?php while( $bigslider->have_posts() ): $bigslider->the_post(); ?>
                        <div>
                            <?php the_post_thumbnail( 'full' )?>
                            <?php
                              $custom_fields = get_post_custom();
                              if( isset( $custom_fields['slider_title'][0] ) ) :
                             ?>
                                 <div class="short-text hidden-xs">

                                     <h2><?php echo $custom_fields['slider_title'][0]?></h2>
                                    <?php endif;?>
                                    <?php if( isset( $custom_fields['slider_text'][0] ) ):?>
                                        <?php echo $custom_fields['slider_text'][0]?>

                                 </div>
                            <?php endif;?>
                        </div>
                <?php endwhile;?>
                </div>
            <div class="sliderborton clearfix">
                <div class="container">
                    <div class="row">
                        <div class="slider__soc-block">
                            <?php if( cg_get_option( 'cg_phone_num' ) ):?>
                            <div class="col-xs-6 col-sm-4 col-md-4 slideBlock">
                                <div class="icon-box">
                                    <i class="fas fa-phone-square"></i>
                                    <div class="icon-box__text">
                                        <h4>Phone number:</h4>
                                        <span><?php echo cg_get_option( 'cg_phone_num' ) ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>
                            <?php if( cg_get_option( 'cg_email_url' ) ):?>
                            <div class="col-xs-6 col-sm-4 col-md-4 slideBlock">
                                <div class="icon-box">
                                    <i class="far fa-envelope"></i>
                                    <div class="icon-box__text">
                                        <h4>E-mail address:</h4>
                                        <span><?php echo cg_get_option( 'cg_email_url' )?></span>
                                    </div>

                                </div>
                            </div>
                            <?php endif;?>
                            <div class="col-xs-12 col-sm-4 col-md-4 hidden-xs slideBlock">
                                <div class="icon-box">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; wp_reset_query();?>
