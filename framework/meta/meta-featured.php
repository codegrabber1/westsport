<?php
/*
 * ==================
 * Enqueueu scripts and styles.
 * ==================
*/
    function cg_register_feat_scripts( $hook_suffix ) {
    if( 'post.php' == $hook_suffix || 'post-new.php' == $hook_suffix ) {
        wp_enqueue_script( 'cg_upload', get_template_directory_uri() . '/framework/options/js/upload.js', array('jquery') );
        wp_enqueue_style( 'meta_css', get_template_directory_uri() . '/framework/meta/css/meta.css' );
    }
}
add_action( 'admin_enqueue_scripts', 'cg_register_meta_scripts' );

/*
 * ==================
 * Adds post layout meta box to post edit screen.
 * ==================
*/
function codegrabber_post_feat_settings() {
    $post_id = '';
    if( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    }

    if( isset($_POST['post_ID']) ) {
        $post_id = $_POST['post_ID'];
    }

    $template_file = get_post_meta( $post_id, '_wp_page_template', TRUE );
    if( $template_file == 'page-featured.php' ){
        $post_type = get_post_types();
        add_meta_box( 'cg_meta_feat_page_settings', 'Featured Page Settings', 'cg_meta_feat_page_settings', $post_type , 'normal', 'high' );
    }
}
add_action( 'add_meta_boxes', 'codegrabber_post_feat_settings' );
/*
 * ==================
 * Display featured page settings.
 * ==================
*/
function cg_meta_feat_page_settings() {
    global $post;
    global $pagenow;

    wp_nonce_field( 'codegrabber_save_featpost_nonce', 'codegrabber_featpost_nonce'); ?>
       <!-- Big slider on the top on homepage. -->
    <div class="meta-section">
       <h3><?php _e( 'Big Slider on the top on homepage. ' );?></h3>

       <div class="meta-field field-checkbox">
           <input type="checkbox" name="cg_show_bigslider" id="cg_show_bigslider" value="1" <?php checked( get_post_meta( $post->ID, 'cg_show_bigslider', true ), 1 )?> />
           <label for="cg_show_bigslider"><?php _e( 'Enable Section', 'codegrabber' );?></label>
       </div>

    </div><!-- !Big slider on the top on homepage. -->
    <!-- Suggestions on the top of homepage -->
    <div class="meta-section">
      <h3><?php _e( 'Set Services block' );?></h3>
      <div class="meta-field field-checkbox">
            <input type="checkbox" name="cg_show_suggetions" id="cg_show_suggetions" value="1" <?php checked( get_post_meta( $post->ID, 'cg_show_suggetions', true ), 1 )?> />
           <label for="cg_show_suggetions"><?php _e( 'Enable Section', 'codegrabber' );?></label>
       </div>
      <div class="meta-field">
         <label for="cg_show_suggetions_title"><?php _e( 'Title', 'codegrabber' );?></label>
         <?php
            $title = get_post_meta( $post->ID, 'cg_show_suggetions_title', true );
            if( empty( $title ) ){
              $title = "";
            }
         ?>
         <input type="text" name="cg_show_suggetions_title" id="cg_show_suggetions_title" value="<?php echo $title;?>">
       </div>
      <div class="meta-field">
        <label for="cg_suggetions_cat"><?php _e( 'Category', 'codegrabber' );?></label>
        <select id="cg_suggetions_cat" name="cg_suggetions_cat" class="styled">
          <?php
            $categories = get_categories( array( 'hide_empty' => 1 ) );
            $save_cat = get_post_meta( $post->ID, 'cg_suggetions_cat', true );
          ?>
          <option <?php selected( 0 == $save_cat );?> value="0">
            <?php _e( 'All categories', 'codegrabber' );?>
          </option>
          <?php
                if( $categories ) :
                    foreach( $categories as $cat ) : ?>
                    <option <?php selected( $cat->term_id == $save_cat );?> value="<?php echo $cat->term_id; ?>"><?php echo $cat->cat_name;?></option>
                <?php
                    endforeach;
                    endif;
               ?>
        </select>
      </div>
    </div>
    <!-- !Suggestions on the top of homepage -->

    <!-- Latest news on homepage. -->
    <div class="meta-section">
       <h3><?php _e( 'Set the Latest news on homepage. ' );?></h3>
       <div class="meta-field field-checkbox">
            <input type="checkbox" name="cg_show_latest_news" id="cg_show_latest_news" value="1" <?php checked( get_post_meta( $post->ID, 'cg_show_latest_news', true ), 1 )?> />
           <label for="cg_show_latest_news"><?php _e( 'Enable Section', 'codegrabber' );?></label>
       </div>
       <div class="meta-field">
         <label for="cg_show_latest_title"><?php _e( 'Title', 'codegrabber' );?></label>
         <?php
            $title = get_post_meta( $post->ID, 'cg_show_latest_title', true );
            if( empty( $title ) ){
              $title = "";
            }
         ?>
         <input type="text" name="cg_show_latest_title" id="cg_show_latest_title" value="<?php echo $title;?>">
       </div>
        <div class="meta-field">
          <label for="cg_show_latest_post_ids"><?php _e( 'Post IDs:', 'codegrabber' ); ?></label>
          <input name="cg_show_latest_post_ids" type="text" class="compact-input" id="cg_show_latest_post_ids" value="<?php echo get_post_meta( $post->ID, 'cg_show_latest_post_ids', true ); ?>" />
          <div class="desc"><?php _e( 'Enter post IDs separated by commas, eg. 2,5,7', 'codegrabber' ); ?></div>
        </div>
       <div class="meta-field">
           <label for="cg_last_cat"><?php _e( 'Category', 'codegrabber' );?></label>
           <select id="cg_last_cat" name="cg_last_cat" class="styled" >
               <?php
                $categories = get_categories( array( 'hide_empty' => 1 ) );
                $save_cat = get_post_meta( $post->ID, 'cg_last_cat', true);
               ?>
               <option <?php selected( 0 == $save_cat ); ?> value="0">
                    <?php _e( 'All Categories', 'codegrabber' );?>
               </option>
               <?php
                if( $categories ) :
                    foreach( $categories as $cat ) : ?>
                    <option <?php selected( $cat->term_id == $save_cat );?> value="<?php echo $cat->term_id; ?>"><?php echo $cat->cat_name;?></option>
                <?php
                    endforeach;
                    endif;
               ?>
           </select>
       </div>
    </div><!-- !Latest news on homepage. -->
    <!--  Events calendar -->
    <div class="meta-section">
      <h3><?php _e( 'Set the Events calendar on homepage. ' );?></h3>
      <div class="meta-field field-checkbox">
           <input type="checkbox" name="cg_show_calendar" id="cg_show_calendar" value="1" <?php checked( get_post_meta( $post->ID, 'cg_show_calendar', true ), 1 )?> />
          <label for="cg_show_calendar"><?php _e( 'Enable Section', 'codegrabber' );?></label>
      </div>
      <div class="meta-field">
        <label for="cg_show_calendar_title"><?php _e( 'Title', 'codegrabber' );?></label>
        <?php
           $title = get_post_meta( $post->ID, 'cg_show_calendar_title', true );
           if( empty( $title ) ){
             $title = "";
           }
        ?>
        <input type="text" name="cg_show_calendar_title" id="cg_show_calendar_title" value="<?php echo $title;?>">
      </div>
      <!-- Short description in tabs. -->
      <div class="meta-field">
        <label for="cg_short_desc"><?php _e( 'Category', 'codegrabber' );?></label>
        <select id="cg_short_desc" name="cg_short_desc" class="styled">
          <?php
            $categories = get_categories( array( 'hide_empty' => 1 ) );
            $save_cat = get_post_meta( $post->ID, 'cg_short_desc', true );
          ?>
          <option <?php selected( 0 == $save_cat );?> value="0">
            <?php _e( 'All categories', 'codegrabber' );?>
          </option>
          <?php
                if( $categories ) :
                    foreach( $categories as $cat ) : ?>
                    <option <?php selected( $cat->term_id == $save_cat );?> value="<?php echo $cat->term_id; ?>"><?php echo $cat->cat_name;?></option>
                <?php
                    endforeach;
                    endif;
               ?>
        </select>
      </div><!-- #Short description. -->
    </div><!--  #Events calendar-->
      <!-- Special news in sliderblocks on homepage. -->
    <div class="meta-section">
          <h3><?php _e( 'Set the blocks of special news on homepage. ' );?></h3>
          <div class="meta-field field-checkbox">
              <input type="checkbox" name="cg_show_special_news" id="cg_show_special_news" value="1" <?php checked( get_post_meta( $post->ID, 'cg_show_special_news', true ), 1 )?> />
              <label for="cg_show_special_news"><?php _e( 'Enable Section', 'codegrabber' );?></label>
          </div>

          <div class="meta-field">
              <h4><?php _e( 'Set the block. ' );?></h4>
             <label for="cg_special_news"><?php _e( 'Category', 'codegrabber' );?></label>
             <select id='cg_special_news' name="cg_special_news" class="styled">
                 <?php
                    $categories = get_categories( array( 'hide_empty' => 1 ) );
                    $saved_cat = get_post_meta( $post->ID, 'cg_special_news', true );
                 ?>
                 <option <?php selected( 0 == $saved_cat );?> value="0"><?php _e( 'All Categories', 'codegrabber' )?></option>
                 <?php
                  if( $categories ):
                    foreach( $categories as $category ) :
                 ?>
                  <option <?php selected( $category->term_id == $saved_cat ); ?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>

                  <?php endforeach; endif;?>
             </select>
          </div>
    </div><!-- Latest news in sliderblocks on homepage. -->

    <!-- Carousels in tabs on homepage. -->
    <div class="meta-section">
         <h3><?php _e( 'Set Carousels in tabs on homepage. ' );?></h3>
         <div class="meta-field field-checkbox">
            <input type="checkbox" name="cg_show_carousel" id="cg_show_carousel" value="1" <?php checked( get_post_meta( $post->ID, 'cg_show_carousel', true ), 1 )?> />
           <label for="cg_show_carousel"><?php _e( 'Enable Section', 'codegrabber' );?></label>
       </div>
         <div class="meta-field">
         <label for="cg_show_carousel_title"><?php _e( 'Title', 'codegrabber' );?></label>
         <?php
            $title = get_post_meta( $post->ID, 'cg_show_carousel_title', true );
            if( empty( $title ) ){
              $title = "";
            }
         ?>
         <input type="text" name="cg_show_carousel_title" id="cg_show_carousel_title" value="<?php echo $title;?>">
         <div class="desc"><?php _e( 'Set the name of section or leave blank.' );?></div>
       </div>
         <h4><?php _e( 'Set the first carousel in tab. ' );?></h4>
         <div class="meta-field">
         <label for="cg_carousel_first_tab"><?php _e( 'The first tab name', 'codegrabber' );?></label>
         <?php
            $tab1_name = get_post_meta( $post->ID, 'cg_carousel_first_tab', true );
            if( empty( $tab1_name ) ) {
              $tab1_name = "Tab name";
            }
         ?>
         <input type='text' name="cg_carousel_first_tab" id="cg_carousel_first_tab" value="<?php echo $tab1_name;?>">
       </div>
         <div class="meta-field">
           <label for="cg_first_carousel"><?php _e( 'Category', 'codegrabber' );?></label>
           <select id='cg_first_carousel' name="cg_first_carousel" class="styled">
           <?php
            $categories = get_categories( array( 'hide_empty' => 1 ) );
            $saved_cat = get_post_meta( $post->ID, 'cg_first_carousel', true );
           ?>
           <option <?php selected( 0 == $saved_cat );?> value="0"><?php _e( 'All Categories', 'codegrabber' )?></option>
           <?php
            if( $categories ):
              foreach( $categories as $category ) :
           ?>
              <option <?php selected( $category->term_id == $saved_cat ); ?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>

            <?php endforeach; endif;?>
         </select>
         </div>
        <h4><?php _e( 'Set the second carousel in tab. ' );?></h4>
        <div class="meta-field">
         <label for="cg_carousel_second_tab"><?php _e( 'The second tab name', 'codegrabber' );?></label>
         <?php
            $tab2_name = get_post_meta( $post->ID, 'cg_carousel_second_tab', true );
            if( empty( $tab2_name ) ) {
              $tab2_name = "Tab name";
            }
         ?>
         <input type='text' name="cg_carousel_second_tab" id="cg_carousel_second_tab" value="<?php echo $tab1_name;?>">
       </div>
       <div class="meta-field">
       <label for="cg_second_carousel"><?php _e( 'Category', 'codegrabber' );?></label>
       <select id='cg_second_carousel' name="cg_second_carousel" class="styled">
         <?php
          $categories = get_categories( array( 'hide_empty' => 1 ) );
          $saved_cat = get_post_meta( $post->ID, 'cg_second_carousel', true );
         ?>
         <option <?php selected( 0 == $saved_cat );?> value="0"><?php _e( 'All Categories', 'codegrabber' )?></option>
         <?php
          if( $categories ):
            foreach( $categories as $category ) :
         ?>
            <option <?php selected( $category->term_id == $saved_cat ); ?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>

          <?php endforeach; endif;?>
       </select>
      </div>
    </div><!-- !Carousels in tabs on homepage. -->

    <!-- Partners carousel -->
    <div class="meta-section">
      <h3><?php _e( "Set partner's links on homepage." );?></h3>
      <div class="meta-field field-checkbox">
          <input type="checkbox" name="cg_show_partners" id="cg_show_partners" value="1" <?php checked( get_post_meta( $post->ID, 'cg_show_partners', true ), 1 )?> />
         <label for="cg_show_partners"><?php _e( 'Enable Section', 'codegrabber' );?></label>
       </div>
     <div class="meta-field">
       <label for="cg_show_partners_title"><?php _e( 'Title', 'codegrabber' );?></label>
       <?php
          $title = get_post_meta( $post->ID, 'cg_show_partners_title', true );
          if( empty( $title ) ){
            $title = "";
          }
       ?>
       <input type="text" name="cg_show_partners_title" id="cg_show_partners_title" value="<?php echo $title;?>">
       <div class="desc"><?php _e( 'Set the name of section or leave blank.' );?></div>
     </div>
     <div class="meta-field">
     <label for="cg_show_partners_carousel"><?php _e( 'Category', 'codegrabber' );?></label>
     <select id='cg_show_partners_carousel' name="cg_show_partners_carousel" class="styled">
       <?php
        $categories = get_categories( array( 'hide_empty' => 1 ) );
        $saved_cat = get_post_meta( $post->ID, 'cg_show_partners_carousel', true );
       ?>
       <option <?php selected( 0 == $saved_cat );?> value="0"><?php _e( 'All Categories', 'codegrabber' )?></option>
       <?php
        if( $categories ):
          foreach( $categories as $category ) :
       ?>
          <option <?php selected( $category->term_id == $saved_cat ); ?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>

        <?php endforeach; endif;?>
     </select>
    </div>
    </div><!-- !Partners carousel -->

    <div class='meta-section'>
      <h3><?php _e( "Set linear block on homepage." );?></h3>
      <div class="meta-field field-checkbox">
          <input type="checkbox" name="cg_show_block" id="cg_show_block" value="1" <?php checked( get_post_meta( $post->ID, 'cg_show_block', true ), 1 )?> />
         <label for="cg_show_block"><?php _e( 'Enable Section', 'codegrabber' );?></label>
      </div>
      <div class="meta-field">
        <label for="cg_show_linear_category1"><?php _e( 'Category', 'codegrabber' );?></label>
        <select id='cg_show_linear_category1' name="cg_show_linear_category1" class="styled">
          <?php
           $categories = get_categories( array( 'hide_empty' => 1 ) );
           $saved_cat = get_post_meta( $post->ID, 'cg_show_linear_category1', true );
          ?>
          <option <?php selected( 0 == $saved_cat );?> value="0"><?php _e( 'All Categories', 'codegrabber' )?></option>
          <?php
           if( $categories ):
             foreach( $categories as $category ) :
          ?>
             <option <?php selected( $category->term_id == $saved_cat ); ?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>

           <?php endforeach; endif;?>
        </select>
      </div>
      <div class="meta-field">
        <label for="cg_show_linear_category2"><?php _e( 'Category', 'codegrabber' );?></label>
        <select id='cg_show_linear_category2' name="cg_show_linear_category2" class="styled">
          <?php
           $categories = get_categories( array( 'hide_empty' => 1 ) );
           $saved_cat = get_post_meta( $post->ID, 'cg_show_linear_category2', true );
          ?>
          <option <?php selected( 0 == $saved_cat );?> value="0"><?php _e( 'All Categories', 'codegrabber' )?></option>
          <?php
           if( $categories ):
             foreach( $categories as $category ) :
          ?>
             <option <?php selected( $category->term_id == $saved_cat ); ?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>

           <?php endforeach; endif;?>
        </select>
      </div>
    </div>
    <?php

}
/*
 * ==================
 * Save post meta box settings.
 * ==================
*/
function cg_post_feat_save_settings(){
    global $post;
    if( !isset( $_POST['codegrabber_featpost_nonce'] ) || !wp_verify_nonce( $_POST['codegrabber_featpost_nonce'], 'codegrabber_save_featpost_nonce' ) ) return;
    if( !current_user_can( 'edit_post' ) ) return;

    // ========= Checkboxes ============ //
    if( isset( $_POST['cg_show_bigslider'] ) && $_POST['cg_show_bigslider'] == 1 ) {
        update_post_meta( $post->ID, 'cg_show_bigslider', 1 );
    }else {
        delete_post_meta( $post->ID, 'cg_show_bigslider' );
    }
    if( isset( $_POST['cg_show_calendar'] ) && $_POST['cg_show_calendar'] == 1 ) {
        update_post_meta( $post->ID, 'cg_show_calendar', 1 );
    }else {
        delete_post_meta( $post->ID, 'cg_show_calendar' );
    }
    if( isset( $_POST['cg_show_suggetions'] ) && $_POST['cg_show_suggetions'] == 1 ) {
        update_post_meta( $post->ID, 'cg_show_suggetions', 1 );
    }else {
        delete_post_meta( $post->ID, 'cg_show_suggetions' );
    }
    if( isset( $_POST['cg_show_latest_news'] ) &&  $_POST['cg_show_latest_news'] == 1){
        update_post_meta( $post->ID, 'cg_show_latest_news', 1 );
    }else{
        delete_post_meta( $post->ID, 'cg_show_latest_news' );
    }
    if( isset( $_POST['cg_show_special_news'] ) &&  $_POST['cg_show_special_news'] == 1){
        update_post_meta( $post->ID, 'cg_show_special_news', 1 );
    }else{
        delete_post_meta( $post->ID, 'cg_show_special_news' );
    }
    if( isset( $_POST['cg_show_carousel'] ) &&  $_POST['cg_show_carousel'] == 1){
        update_post_meta( $post->ID, 'cg_show_carousel', 1 );
    }else{
        delete_post_meta( $post->ID, 'cg_show_carousel' );
    }
    if( isset( $_POST['cg_show_partners'] ) &&  $_POST['cg_show_partners'] == 1){
        update_post_meta( $post->ID, 'cg_show_partners', 1 );
    }else{
        delete_post_meta( $post->ID, 'cg_show_partners' );
    }
    if( isset( $_POST['cg_show_block'] ) && $_POST['cg_show_block'] == 1 ) {
      update_post_meta( $post->ID, 'cg_show_block', 1 );
    }else {
      delete_post_meta( $post->ID, 'cg_show_block' );
    }

    // ========= !Checkboxes ============ //

    // ========= Titles ============ //
      if( isset( $_POST['cg_show_latest_title'] ) ){
        update_post_meta( $post->ID, 'cg_show_latest_title', sanitize_text_field( $_POST['cg_show_latest_title'] ) );
      }
      if( isset( $_POST['cg_show_suggetions_title'] ) ){
        update_post_meta( $post->ID, 'cg_show_suggetions_title', sanitize_text_field( $_POST['cg_show_suggetions_title'] ) );
      }
      if( isset( $_POST['cg_show_calendar_title'] ) ){
        update_post_meta( $post->ID, 'cg_show_calendar_title', sanitize_text_field( $_POST['cg_show_calendar_title'] ) );
      }


      if( isset( $_POST['cg_show_latest_post_ids'] ) ) {
        update_post_meta( $post->ID, 'cg_show_latest_post_ids', sanitize_text_field( $_POST['cg_show_latest_post_ids'] ) );
      }
      if( isset( $_POST['cg_show_carousel_title'] ) ) {
        update_post_meta( $post->ID, 'cg_show_carousel_title', sanitize_text_field( $_POST['cg_show_carousel_title'] ) );
      }
      if( isset( $_POST['cg_carousel_first_tab'] ) ) {
        update_post_meta( $post->ID, 'cg_carousel_first_tab', sanitize_text_field( $_POST['cg_carousel_first_tab'] ) );
      }
      if( isset( $_POST['cg_carousel_second_tab'] ) ) {
        update_post_meta( $post->ID, 'cg_carousel_second_tab', sanitize_text_field( $_POST['cg_carousel_second_tab'] ) );
      }
      if( isset( $_POST['cg_show_partners_title'] ) ) {
        update_post_meta( $post->ID, 'cg_show_partners_title', sanitize_text_field( $_POST['cg_show_partners_title'] ) );
      }
    // ========= !Titles ============ //

    // ========= Categories ============ //
    if( isset( $_POST['cg_short_desc'] ) ) {
        update_post_meta( $post->ID, 'cg_short_desc', $_POST['cg_short_desc'] );
    }
    if( isset( $_POST['cg_last_cat'] ) ) {
        update_post_meta( $post->ID, 'cg_last_cat', $_POST['cg_last_cat'] );
    }
    if( isset( $_POST['cg_suggetions_cat'] ) ) {
        update_post_meta( $post->ID, 'cg_suggetions_cat', $_POST['cg_suggetions_cat'] );
    }
    if( isset( $_POST['cg_special_news'] ) ) {
        update_post_meta( $post->ID, 'cg_special_news', $_POST['cg_special_news'] );
    }

    if( isset( $_POST['cg_first_carousel'] ) ) {
        update_post_meta( $post->ID, 'cg_first_carousel', $_POST['cg_first_carousel'] );
    }
    if( isset( $_POST['cg_second_carousel'] ) ) {
        update_post_meta( $post->ID, 'cg_second_carousel', $_POST['cg_second_carousel'] );
    }
    if( isset( $_POST['cg_show_partners_carousel'] ) ) {
        update_post_meta( $post->ID, 'cg_show_partners_carousel', $_POST['cg_show_partners_carousel'] );
    }
    if( isset( $_POST['cg_show_linear_category1'] ) ) {
        update_post_meta( $post->ID, 'cg_show_linear_category1', $_POST['cg_show_linear_category1'] );
    }
    if( isset( $_POST['cg_show_linear_category2'] ) ) {
        update_post_meta( $post->ID, 'cg_show_linear_category2', $_POST['cg_show_linear_category2'] );
    }
    // ========= !Categories ============ //

}
add_action( 'save_post', 'cg_post_feat_save_settings' );
?>
