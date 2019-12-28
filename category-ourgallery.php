<?php
/**
 * The page for Our gallery.
 * Created by codegrabber.
 * @package  codegraber
 * @author   codegrabber
 */
get_header();
?>
<section>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <?php $cat = get_the_category(); ?>
        <div class="breadcrumbs">
          <ul>
            <li><a href="<?php echo home_url();?>"><?php _e( 'Home' );?> </a></li>
          </ul>
        </div>
      </div>
      <div class="col-xs-12">
        <div class="g_main">
          <div class="g_item"><img id="ig-hero" src="http://placehold.it/600x600" /></div>
          <div class="g_item"><img id="ig-hero" src="http://placehold.it/600x600" /></div>
          <div class="g_item"><img id="ig-hero" src="http://placehold.it/600x600" /></div>
          <div class="g_item"><img id="ig-hero" src="http://placehold.it/600x600" /></div>
          <div class="g_item"><img id="ig-hero" src="http://placehold.it/600x600" /></div>
          <div class="g_item"><img id="ig-hero" src="http://placehold.it/600x600" /></div>
          <div class="g_item"><img id="ig-hero" src="http://placehold.it/600x600" /></div>
          <div class="g_item"><img id="ig-hero" src="http://placehold.it/600x600" /></div>
          <div class="g_item"><img id="ig-hero" src="http://placehold.it/600x600" /></div>
          <div class="g_item"><img id="ig-hero" src="http://placehold.it/600x600" /></div>
          <div class="g_item"><img id="ig-hero" src="http://placehold.it/600x600" /></div>

        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer();?>