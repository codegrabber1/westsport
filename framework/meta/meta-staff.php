<?php
/* ==================
 * Enqueueu scripts and styles.
 * ==================
*/
function cg_register_meta_scripts( $hook_suffix ) {
    if( 'post.php' == $hook_suffix || 'post-new.php' == $hook_suffix ) {
        wp_enqueue_script( 'cg_upload', get_template_directory_uri() . '/framework/options/js/upload.js', array('jquery') );
        wp_enqueue_style( 'meta_css', get_template_directory_uri() . '/framework/meta/css/meta.css' );
    }
}
add_action( 'admin_enqueue_scripts', 'cg_register_meta_scripts' );

/* ==================
 * Adds post layout meta box to post edit screen.
 * ==================
*/
function codegrabber_post_meta_settings() {

    $post_id = '';
    if( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    }

    if( isset($_POST['post_ID']) ) {
        $post_id = $_POST['post_ID'];
    }

    $template_file = get_post_meta( $post_id, '_wp_page_template', TRUE );
    if( $template_file == 'page-staff.php' ){
        add_meta_box( 'cg_meta_staff_page_settings', 'Staff Page Settings', 'cg_meta_staff_page_settings', 'page', 'advanced', 'high' );
    }
}
add_action( 'add_meta_boxes', 'codegrabber_post_meta_settings' );
/**
 * Display staff page settings.
 *
 */
function cg_meta_staff_page_settings() {
    global $post;
    global $pagenow;

    wp_nonce_field( 'codegrabber_save_postmeta_nonce', 'codegrabber_postmeta_nonce' ); ?>

    <div class="meta-section">
        <h3><?php _e( 'The staff of the Western Rehabilitation and Sports Center', 'codegrabber' );?></h3>

        <div class="meta-field field-checkbox" >
            <input type="checkbox" name="cg_meta_show_staff_sec1" id="cg_meta_show_staff_sec1" value="1" <?php checked( get_post_meta( $post->ID, 'cg_meta_show_staff_sec1', true ), 1 )?> />
            <label for="cg_meta_show_staff_sec1"><?php _e( 'Enable Section', 'codegrabber' );?></label>
        </div>
        <div class="meta-field">
            <label for="cg_meta_sec1_title"><?php _e( 'Title', 'codegrabber' );?></label>
            <?php
                $title = get_post_meta( $post->ID, 'cg_meta_sec1_title', true );
                if( empty($title) ) { $title = ""; }
            ?>
            <input name="cg_meta_sec1_title" type="text" id="cg_meta_sec1_title" value="<?php echo $title; ?>"/>
            <div class="desc"><?php _e( 'Set the name of the department.', 'codegrabber' );?></div>
        </div>
        <div class="meta-field">
            <label for="cg_meta_sec1_cat"><?php _e( 'Category', 'codegrabber' );?></label>
            <select name="cg_meta_sec1_cat" id="cg_meta_sec1_cat" class="styled">
                <?php
                    $categories = get_categories( array( 'hide_empty' => 1, 'hierarchical' => 0 ) );
                    $saved_cat = get_post_meta( $post->ID, 'cg_meta_sec1_cat', true );
                ?>
                <option <?php selected( 0 == $saved_cat );?> value="0" ><?php _e( 'All_Categories', 'codegrabber' );?></option>
                <?php
                    if( $categories ):
                       foreach( $categories as $category ):
                    ?>
                        <option <?php selected( $category->term_id == $saved_cat );?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
                    <?php
                    endforeach;
                    endif;
                ?>
            </select>
            <div class="desc"><?php _e( 'Set the chief of the department', 'codegrabber' );?></div>
          </div>
          <div class="meta-field">
            <label for="cg_meta_sec2_cat"><?php _e( 'Category', 'codegrabber' );?></label>
            <select name="cg_meta_sec2_cat" id="cg_meta_sec2_cat" class="styled">
                <?php
                    $categories = get_categories( array( 'hide_empty' => 1, 'hierarchical' => 0 ) );
                    $saved_cat = get_post_meta( $post->ID, 'cg_meta_sec2_cat', true );
                ?>
                <option <?php selected( 0 == $saved_cat );?> value="0" ><?php _e( 'All_Categories', 'codegrabber' );?></option>
                <?php
                    if( $categories ):
                       foreach( $categories as $category ):
                    ?>
                        <option <?php selected( $category->term_id == $saved_cat );?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
                    <?php
                    endforeach;
                    endif;
                ?>
            </select>
            <div class="desc"><?php _e( 'Set the staff of the department.', 'codegrabber' );?></div>
        </div>

        <!-- Sport Service -->
        <h3><?php _e( 'The staff of the SportService', 'codegrabber' );?></h3>

        <div class="meta-field field-checkbox" >
            <input type="checkbox" name="cg_meta_show_staff_sec3" id="cg_meta_show_staff_sec3" value="1" <?php checked( get_post_meta( $post->ID, 'cg_meta_show_staff_sec3', true ), 1 )?> />
            <label for="cg_meta_show_staff_sec3"><?php _e( 'Enable Section', 'codegrabber' );?></label>
        </div>
        <div class="meta-field">
            <label for="cg_meta_sec2_title"><?php _e( 'Title', 'codegrabber' );?></label>
            <?php
                $title = get_post_meta( $post->ID, 'cg_meta_sec2_title', true );
                if( empty($title) ) { $title = ""; }
            ?>
            <input name="cg_meta_sec2_title" type="text" id="cg_meta_sec2_title" value="<?php echo $title; ?>"/>
            <div class="desc"><?php _e( 'Set the name of the department.', 'codegrabber' );?></div>
        </d iv>
        <div class="meta-field">
            <label for="cg_meta_sec1_cat"><?php _e( 'Category', 'codegrabber' );?></label>
            <select name="cg_meta_sec3_cat" id="cg_meta_sec3_cat" class="styled">
                <?php
                    $categories = get_categories( array( 'hide_empty' => 1, 'hierarchical' => 0 ) );
                    $saved_cat = get_post_meta( $post->ID, 'cg_meta_sec3_cat', true );
                ?>
                <option <?php selected( 0 == $saved_cat );?> value="0" ><?php _e( 'All_Categories', 'codegrabber' );?></option>
                <?php
                    if( $categories ):
                       foreach( $categories as $category ):
                    ?>
                        <option <?php selected( $category->term_id == $saved_cat );?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
                    <?php
                    endforeach;
                    endif;
                ?>
            </select>
            <div class="desc"><?php _e( 'Set the chief of the department', 'codegrabber' );?></div>
          </div>
          <div class="meta-field">
            <label for="cg_meta_sec4_cat"><?php _e( 'Category', 'codegrabber' );?></label>
            <select name="cg_meta_sec4_cat" id="cg_meta_sec4_cat" class="styled">
                <?php
                    $categories = get_categories( array( 'hide_empty' => 1, 'hierarchical' => 0 ) );
                    $saved_cat = get_post_meta( $post->ID, 'cg_meta_sec4_cat', true );
                ?>
                <option <?php selected( 0 == $saved_cat );?> value="0" ><?php _e( 'All_Categories', 'codegrabber' );?></option>
                <?php
                    if( $categories ):
                       foreach( $categories as $category ):
                    ?>
                        <option <?php selected( $category->term_id == $saved_cat );?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
                    <?php
                    endforeach;
                    endif;
                ?>
            </select>
            <div class="desc"><?php _e( 'Set the staff of the department.', 'codegrabber' );?></div>
        </div>
    </div>
    <?php
}
/**
 * Save post meta box settings.
 *
 */
function cg_post_meta_save_settings() {
    global $post;

    if( !isset( $_POST['codegrabber_postmeta_nonce'] ) || !wp_verify_nonce( $_POST['codegrabber_postmeta_nonce'], 'codegrabber_save_postmeta_nonce' ) ) return;

    if( !current_user_can( 'edit_posts' ) ) return;

    if( isset( $_POST['cg_meta_tiles_cat'] ) ) {
        update_post_meta( $post->ID, 'cg_meta_tiles_cat', $_POST['cg_meta_tiles_cat'] );
    }

    if( isset( $_POST['cg_meta_show_staff_sec1'] ) && $_POST['cg_meta_show_staff_sec1'] == 1) {
        update_post_meta( $post->ID, 'cg_meta_show_staff_sec1', 1 );
    } else {
        delete_post_meta( $post->ID, 'cg_meta_show_staff_sec1' );
    }

    if( isset( $_POST['cg_meta_show_staff_sec2'] ) && $_POST['cg_meta_show_staff_sec2'] == 1) {
        update_post_meta( $post->ID, 'cg_meta_show_staff_sec2', 1 );
    } else {
        delete_post_meta( $post->ID, 'cg_meta_show_staff_sec2' );
    }

    if( isset( $_POST['cg_meta_show_staff_sec3'] ) && $_POST['cg_meta_show_staff_sec3'] == 1) {
        update_post_meta( $post->ID, 'cg_meta_show_staff_sec3', 1 );
    } else {
        delete_post_meta( $post->ID, 'cg_meta_show_staff_sec3' );
    }

    if( isset( $_POST['cg_meta_sec1_title'] ) ) {
        update_post_meta( $post->ID, 'cg_meta_sec1_title', sanitize_text_field( $_POST['cg_meta_sec1_title'] ) );
    }

    if( isset( $_POST['cg_meta_sec2_title'] ) ) {
        update_post_meta( $post->ID, 'cg_meta_sec2_title', sanitize_text_field( $_POST['cg_meta_sec2_title'] ) );
    }

    if( isset( $_POST['cg_meta_sec1_cat'] ) ) {
        update_post_meta( $post->ID, 'cg_meta_sec1_cat', $_POST['cg_meta_sec1_cat'] );
    }

    if( isset( $_POST['cg_meta_sec2_cat'] ) ) {
        update_post_meta( $post->ID, 'cg_meta_sec2_cat', $_POST['cg_meta_sec2_cat'] );
    }
    if( isset( $_POST['cg_meta_sec3_cat'] ) ) {
        update_post_meta( $post->ID, 'cg_meta_sec3_cat', $_POST['cg_meta_sec3_cat'] );
    }
    if( isset( $_POST['cg_meta_sec4_cat'] ) ) {
        update_post_meta( $post->ID, 'cg_meta_sec4_cat', $_POST['cg_meta_sec4_cat'] );
    }
}
add_action( 'save_post', 'cg_post_meta_save_settings' );
