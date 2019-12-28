<?php
/**
 * The Theme Options page
 *
 * This page is implemented using the Settings API
 * http://codex.wordpress.org/Settings_API
 *
 * @package  codegrabber
 * @file     widget_options.php
 * @author   codegrabber
 * @link
 */
/**
 * Properly enqueue styles and scripts for our theme options page.
 *
 * This function is attached to the admin_enqueue_scripts action hook.
 *
 */

add_action( 'admin_init', 'cg_register_admin_scripts' );

function cg_register_admin_scripts(){
	wp_enqueue_style( 'cg_theme_options_css', get_template_directory_uri() . '/framework/options/css/cg-options.css');
	wp_enqueue_style('thickbox');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('cg_colorpicker', get_template_directory_uri() . '/framework/options/js/colorpicker.js', array( 'jquery' ));
	wp_enqueue_script('cg_select_js', get_template_directory_uri() . '/framework/options/js/jquery.customSelect.min.js', array( 'jquery' ));
	wp_enqueue_script( 'cg_theme_optionsjs', get_template_directory_uri() . '/framework/options/js/options.js', array( 'jquery', 'cg_select_js' ) );
}

global $pagenow;
if( ( 'themes.php' == $pagenow ) && ( isset( $_GET['activated'] ) && ( $_GET['activated'] == 'true' ) ) ) :
	/**
	 * Set default options on activation
	 */
function cg_init_options() {
		//delete_option( 'cg_options' );
  $options = get_option( 'cg_options' );
  if ( false === $options ) {
     $options = cg_default_options();
 }
 update_option( 'cg_options', $options );
}
add_action( 'after_setup_theme', 'cg_init_options', 9 );
endif;

/**
 * Register the theme options setting
 */
function cg_register_settings() {
	register_setting( 'cg_options', 'cg_options', 'cg_validate_options' );
}
add_action( 'admin_init', 'cg_register_settings' );

/**
 * Register the options page
 */
function cg_theme_add_page() {
	$cg_options_page = add_theme_page( __( 'Theme options', 'codegrabber' ), __( 'Theme options', 'codegrabber' ), 'edit_theme_options', 'cg_options', 'cg_theme_options_page' );
	add_action( 'admin_print_styles-' . $cg_options_page, 'cg_theme_options_scripts' );
}
add_action( 'admin_menu', 'cg_theme_add_page' );

/**
 * Include scripts to the options page only
 */
function cg_theme_options_scripts(){
	if ( ! did_action( 'cg_enqueue_media' ) ){
		wp_enqueue_media();
	}
	wp_enqueue_script('cg_upload', get_template_directory_uri() .'/framework/options/js/upload.js', array('jquery'));
}
/**
 * Output the options page
 */
function cg_theme_options_page() {
	?>

	<div id="cg_admin">
		<header class="header">
			<div class="main">
				<div class="left">
					<h2><?php echo _e('Theme settings', 'codegrabber'); ?></h2>
				</div>
				<div class="theme_info">Theme_info</div>
			</div>
		</header> <!-- /header -->
		<div class="options-wrap">
			<div class="tabs">
				<ul>
					<li class="general first"><a href="#general"><i class="icon-cogs"></i><?php echo _e('General', 'codegrabber'); ?></a></li>
                    <li class="posts"><a href="#posts"><i class="icon-cogs"></i><?php echo _e('Posts', 'codegrabber'); ?></a></li>
					<li class="booking"><a href="#booking"><i class="icon-cogs"></i><?php echo _e('Booking', 'codegrabber'); ?></a></li>
                    <li class="contact"><a href="#contact"><i class="icon-cogs"></i><?php echo _e('Contact', 'codegrabber'); ?></a></li>
                    <li class="reset"><a href="#reset"><i class="icon-refresh"></i><?php echo _e( 'Reset', 'codegrabber' );?></a></li>
                </ul>
            </div>
            <div class="options_form">
                <?php if( isset( $_GET['settings-updated'] ) ):?>
                <div class="update fade">
                    <p>
                        <?php _e( 'Theme setup has been updated successfully', 'codegrabber' );?>
                    </p>
                </div>
            <?php endif;?>
            <form action="options.php" method="post">
                <?php settings_fields( 'cg_options' )?>
                <?php $options = get_option( 'cg_options' );?>
                <div class="tab_content">
                 <div id="general" class="tab_block">
                     <h2><?php _e( 'Main settings', 'codegrabber' );?></h2>
                     <div class="fields_wrap">
                         <div class="field infobox">
                             <p><strong>
                                 <?php _e( 'How to upload an image?', 'codegrabber' );?>
                             </strong></p>
                             <?php _e( 'You can manually specify the URL for the logo and other images or download the image from your computer.', 'codegrabber' );?>
                         </div>
                         <h3><?php _e( 'Header settings', 'codegrabber' );?></h3>
                         <div class="field field-upload">
                             <label for="cg_logo_url"><?php _e( 'Download the logo', 'codegrabber' );?></label>
                             <input type="text" id="cg_options[cg_logo_url]" class="upload_image" name="cg_options[cg_logo_url]" value="<?php echo esc_attr($options['cg_logo_url']); ?>">

                             <input class="upload_image_button" id="cg_logo_upload_button" type="button" value="Upload" />
                             <span class="description long updesc"><?php _e('Upload a logo image or specify a path. Max width: 300px.', 'codegrabber'); ?>
                             </span>
                         </div>
                         <div class="field field-upload">
                             <label for="cg_slogan_url"><?php _e( 'Upload the slogan', 'codegrabber' );?></label>
                             <input id="cg_options[cg_slogan_url]" class="upload_image" type="text" name="cg_options[cg_slogan_url]" value="<?php echo esc_attr($options['cg_slogan_url']); ?>" />

                             <input class="upload_image_button" id="cg_logo_upload_button" type="button" value="Upload" />
                             <span class="description long updesc"><?php _e('Upload a slogan image or specify a path. Max width: 300px.', 'codegrabber'); ?>
                             </span>
                         </div>
                         <div class='field'>
                           <label><?php _e( 'Choose the color', 'codegrabber' );?></label>
                           <div id="cg_topheader_color_selector" class="color-pic"><div style="background-color:<?php echo $options['cg_topheader_color']?>"></div></div>
                           <input style="width: 80px; margin-right: 5px" id="cg_topheader_color" type="text" name="cg_options[cg_topheader_color]" value="<?php echo $options['cg_topheader_color'];?>">
                           <span class="description chkdesc"><?php _e( 'Choose a color for the main elements of the template (lines, buttons, top menu of the site).', 'codegrabber' ); ?></span>
                       </div>
                       <div class='field'>
                           <label><?php _e( 'Choose the links color', 'codegrabber' );?></label>
                           <div id="cg_links_color_selector" class="color-pic"><div style="background-color:<?php echo $options['cg_links_color']?>"></div></div>
                           <input style="width: 80px; margin-right: 5px" id="cg_links_color" type="text" name="cg_options[cg_links_color]" value="<?php echo $options['cg_links_color'];?>">
                           <span class="description chkdesc"><?php _e( 'Choose a color of the links.', 'codegrabber' ); ?></span>
                       </div>
                       <h3><?php _e( 'Set social links', 'codegrabber' );?></h3>
                       <div class="field">
                           <label for="cg_options[cg_excerpt_slider]"><?php _e( 'Short text on homepage', 'codegrabber' )?></label>
                           <input id="cg_options[cg_excerpt_slider]" name="cg_options[cg_excerpt_slider]" type="checkbox" value="1" <?php isset($options['cg_excerpt_slider']) ? checked( '1', $options['cg_excerpt_slider'] ) : checked('0', '1'); ?> />

                           <span class='description chkdesc'><?php _e( 'Display short text on the slide of homepage', 'codegrabber' );?></span>
                       </div>
                       <div class="field">
                         <label for="cg_options[cg_fb_url]"><?php _e( 'Facebook URL', 'codegrabber' );?></label>
                         <input type="text" id="cg_options[cg_fb_url]" name="cg_options[cg_fb_url]" value="<?php echo esc_attr( $options['cg_fb_url'] );?>" />
                         <span class="description long"><?php _e( "Enter full facebook-URL starting with <strong> https:// </strong>, or leave blank.", 'codegrabber' );?></span>
                     </div>

                     <div class="field">
                         <label for="cg_options[cg_instagram_url]"><?php _e( 'Instagram URL', 'codegrabber' );?></label>
                         <input type="text" id="cg_options[cg_instagram_url]" name="cg_options[cg_instagram_url]" value="<?php echo esc_attr( $options['cg_instagram_url'] );?>" />
                         <span class="description long"><?php _e( "Enter full instagram-URL starting with <strong> https:// </strong>, or leave blank.", 'codegrabber' );?></span>
                     </div>

                     <div class="field">
                         <label for="cg_options[cg_youtube_url]"><?php _e('Youtube URL', 'codegrabber'); ?></label>
                         <input id="cg_options[cg_youtube_url]" name="cg_options[cg_youtube_url]" type="text" value="<?php echo esc_attr($options['cg_youtube_url']); ?>" />
                         <span class="description long"><?php _e( "Enter full youtube-URL starting with <strong> https:// </strong>, or leave blank.", 'codegrabber' ); ?></span>
                     </div>

                     <div class="field">
                         <label for="cg_options[cg_phone_num]"><?php _e( 'Phone number', 'codegrabber'); ?></label>
                         <input id="cg_options[cg_phone_num]" name="cg_options[cg_phone_num]" type="text" value="<?php echo esc_attr($options['cg_phone_num']); ?>" />
                         <span class="description long"><?php _e( "Enter full phone number or leave blank.", 'codegrabber' ); ?></span>
                     </div>

                     <div class="field">
                         <label for="cg_options[cg_email_url]"><?php _e('Email', 'codegrabber'); ?></label>
                         <input id="cg_options[cg_email_url]" name="cg_options[cg_email_url]" type="text" value="<?php echo esc_attr($options['cg_email_url']); ?>" />
                         <span class="description long"><?php _e( "Enter full email address or leave blank.", 'codegrabber' ); ?></span>
                     </div>

                     <div class="field">
                         <label for="cg_options[cg_viber_num]"><?php _e( 'Viber', 'codegrabber' );?></label>
                         <input type="text" id="cg_options[cg_viber_num]" name="cg_options[cg_viber_num]" value="<?php echo esc_attr( $options['cg_viber_num'] );?>" />
                         <span class="description long"><?php _e( "Enter the viber number or leave blank.", 'codegrabber' );?></span>
                     </div>
                     <h3><?php _e( 'Animation', 'codegrabber' ); ?></h3>
                     <div class="field">
                        <label for="cg_options[cg_enable_animation]"><?php _e( 'Enable animation', 'codegrabber' ); ?></label>
                        <input id="cg_options[cg_enable_animation]" name="cg_options[cg_enable_animation]" type="checkbox" value="1" <?php isset($options['cg_enable_animation']) ? checked( '1', $options['cg_enable_animation'] ) : checked('0', '1'); ?> />
                        <span class="description chkdesc"><?php _e( 'Activate animation.', 'codegrabber' ); ?></span>
                    </div>

                    </div>
                </div> <!-- #general-->
                <div id="posts" class="tab_block">
                  <h2><?php _e( 'Settings Articles', 'codegrabber' );?></h2>
                  <div class="fields_wrap">
                    <div class="field infobox">
                        <p><strong><?php _e( 'Settings for individual posts, pages, images and archives.', 'codegrabber' ); ?></strong></p>
                        <?php _e( 'You can adjust the settings of individual posts, pages, images and archives.', 'codegrabber' ); ?>
                    </div>
                    <h3><?php _e( 'Blog Settings.', 'codegrabber' );?></h3>
                    <div class="field">
                        <label for="cg_options[cg_show_post_img]"><?php _e( 'Show post image', 'codegrabber' );?></label>
                        <input type="checkbox" id="cg_options[cg_show_post_img]" name="cg_options[cg_show_post_img]" value="1" <?php if ( isset( $options['cg_show_post_img'] ) ? checked( '1', $options['cg_show_post_img'] ) : checked( '0', '1' ) );?> />
                        <span class="description chkdesc"><?php _e( 'Choose if you want to display images at the top of the post.', 'codegrabber' );?></span>
                    </div> <!-- #show_post_img -->
                    <div class="field">
                        <label for="cg_options[cg_show_post_social]"><?php _e( 'Show post social', 'codegrabber' );?></label>
                        <input type="checkbox" id="cg_options[cg_show_post_social]" name="cg_options[cg_show_post_social]" value="1" <?php if ( isset( $options['cg_show_post_social'] )  ? checked( '1', $options['cg_show_post_social'] ) : checked( '0', '1' ) );?> />
                        <span class="description chkdesc"><?php _e( 'Choose if you want to display the social icons on the side of the image of the article.', 'codegrabber' );?></span>
                    </div> <!-- #post_social -->
                    <div class="field">
                        <label for="cg_options[cg_show_related_posts]"><?php _e( 'Show related posts', 'codegrabber'); ?></label>
                        <input id="cg_options[cg_show_related_posts]" name="cg_options[cg_show_related_posts]" type="checkbox" value="1" <?php if ( isset($options['cg_show_related_posts'] ) ? checked( '1', $options['cg_show_related_posts'] ) : checked('0', '1') ); ?> />
                        <span class="description chkdesc"><?php _e( 'Choose if you want to display related post.', 'codegrabber' ); ?></span>
                    </div> <!-- #related_posts -->

                    <h3><?php _e( 'Ad settings', 'codegrabber' );?></h3>

                    <div class="field">
                        <label for="cg_options[cg_post_banner1]"><?php _e( 'Ads in the header of the post', 'codegrabber' ); ?></label>
                        <textarea id="cg_options[cg_post_banner1]" class="textarea" name="cg_options[cg_post_banner1]"><?php echo esc_attr($options['cg_post_banner1']); ?></textarea>
                        <span class="description"><?php _e( 'Enter the ad code.', 'codegrabber' );?></span>
                    </div>

                    <div class="field">
                        <label for="cg_options[cg_post_banner2]"><?php _e( 'Ads in the footer of the post', 'codegrabber' ); ?></label>
                        <textarea id="cg_options[cg_post_banner2]" class="textarea" name="cg_options[cg_post_banner2]"><?php echo esc_attr($options['cg_post_banner2']); ?></textarea>
                        <span class="description"><?php _e( 'Enter the ad code.', 'codegrabber' );?></span>
                    </div>
                </div>
                </div> <!-- #posts-->
                <!-- booking -->
                <div id="booking" class="tab_block">
                    <h2><?php _e( 'Hotels and Booking Settings', 'codegrabber' );?></h2>
                    <div class="fields_wrap">
                        <div class="field infobox">
                            <p><strong><?php _e( 'Settings for booking', 'codegrabber' );?></strong></p>
                            <?php _e( 'You can adjust the settings of ... ', 'codegrabber' );?>
                        </div>
                        <h3><?php _e( 'Hotel Settings', 'codegrabber' ); ?></h3>
                        <div class="field"></div>
                        <div class="field"></div>
                    </div>
                </div>
                <!-- #booking -->
                <div id="contact" class="tab_block">
                    <h2><?php _e( 'Contact settings', 'codegrabber' );?></h2>
                    <div class="fields_wrap">
                     <div class="field infobox">
                        <p><strong><?php _e( 'reCAPTCHA', 'codegrabber' );?></strong></p>
                        <?php _e( 'reCAPTCHA helps to avoid spam by email. Using CAPTCHA confirms that sending a message is done by a person.', 'codegrabber' );?>
                    </div>
                    <h3><?php _e( 'Contact Card', 'codegrabber' );?></h3>
                    <div class="field field-upload">
                       <label for="cg_headblock_url"><?php _e( 'Download the image', 'codegrabber' );?></label>
                       <input type="text" id="cg_options[cg_headblock_url]" class="upload_image" name="cg_options[cg_headblock_url]" value="<?php echo esc_attr($options['cg_headblock_url']); ?>">

                       <input class="upload_image_button" id="cg_logo_upload_button" type="button" value="Upload" />
                       <span class="description long updesc"><?php _e('Upload a logo image or specify a path.', 'codegrabber'); ?>
                       </span>
                   </div>

                   <div class="field">
                    <label for="cg_options[cg_contact_addres]"><?php _e( 'Address', 'codegrabber' )?></label>
                    <textarea type="text" id="cg_options[cg_contact_addres]" name="cg_options[cg_contact_addres]"><?php echo esc_attr( $options['cg_contact_addres'] )?></textarea>
                    <span class="description"><?php _e( 'Enter the addres to display on the contact page.', 'codegrabber' );?></span>
                </div>

                <div class="field">
                    <label for="cg_options[cg_contact_email]"><?php _e( 'Email', 'codegrabber' )?></label>
                    <input type="text" id="cg_options[cg_contact_email]" name="cg_options[cg_contact_email]" value="<?php echo esc_attr( $options['cg_contact_email'] )?>">
                    <span class="description long"><?php _e( 'The address to which messages from the site will come.', 'codegrabber' );?></span>
                </div>

        <div class="field">
            <label for="cg_options[cg_contact_phone]"><?php _e( 'Phone', 'codegrabber' )?></label>
            <input type="text" id="cg_options[cg_contact_phone]" name="cg_options[cg_contact_phone]" value="<?php echo esc_attr( $options['cg_contact_phone'] )?>">
            <span class="description long"><?php _e( 'Enter the phone number to display on the contact page.', 'codegrabber' );?></span>
        </div>

        <div class="field">
            <label for="cg_options[cg_contact_subject]"><?php _e( 'Subject', 'codegrabber' )?></label>
            <input type="text" id="cg_options[cg_contact_subject]" name="cg_options[cg_contact_subject]" value="<?php echo esc_attr( $options['cg_contact_subject'] )?>">
            <span class="description long"><?php _e( 'Enter the subject of the message.', 'codegrabber' );?></span>
        </div>

        <h3><?php _e( 'reCAPTCHA Settings', 'codegrabber' );?></h3>
        <div class="field">
            <label for="cg_options[cg_recapcha_public_key]"><?php _e( 'Public Key', 'codegrabber' );?></label>
            <input type="text" id="cg_options[cg_recapcha_public_key]" name="cg_options[cg_recapcha_public_key]" value="<?php echo esc_attr( $options['cg_recapcha_public_key'] )?>">
            <span class="description long"><?php _e( 'Enter reCaptcha public key for contact reCaptcha', 'codegrabber' );?></span>
        </div>

        <div class="field">
            <label for="cg_options[cg_recaptcha_private_key]"><?php _e('Private Key', 'wellthemes'); ?></label>
            <input id="cg_options[cg_recaptcha_private_key]" name="cg_options[cg_recaptcha_private_key]" type="text" value="<?php echo esc_attr($options['cg_recaptcha_private_key']); ?>" />
            <span class="description long"><?php _e( 'Enter reCaptcha private key for contact reCaptcha.', 'codegrabber' ); ?></span>
        </div>
    </div>
</div>
<div id="reset" class="tab_block">
   <h2><?php _e( 'Reset', 'codegrabber' )?></h2>
   <div class="fielsd_wrap">
      <div class="field warningbox">
         <p><strong><?php _e( 'Atention!', 'codegrabber' );?></strong></p>
         <?php _e( 'You will lose all your theme settings and your own side panels. The theme will reset the original settings.', 'codegrabber' );?>
     </div>
     <div class="field">
         <p class="reset-info"><?php _e( 'If you want to restore the initial settings, click on the button.', 'codegrabber' );?></p>
         <input type="submit" name="cg_option[reset]" class="button-primary" value="<?php _e( 'Reset the initial settings', 'codegrabber' );?>">
     </div>
 </div>
</div>
</div>
</div> <!-- /options-form -->
</div> <!-- /options_wrap -->
<div class="options-footer">
 <input type="submit" name="cg_options[submit]" class="button-primary" value="<?php _e( 'Зберегти налаштування', 'codegrabber' ); ?>" />
</div>
</form>
</div> <!-- /cg-admin -->
<?php
}

/*
 * ==================
 * Return default array of options.
 * ==================
*/
function cg_default_options() {
	$options = array(
		'cg_logo_url' => get_template_directory_uri().'/images/logo.png',
		'cg_slogan_url' => '',
		'cg_fb_url' => '',
		'cg_viber_num' => '',
		'cg_instagram_url' => '',
		'cg_youtube_url' => '',
		'cg_email_url' => '',
		'cg_topheader_color' => '',
		'cg_links_color' => '',
		'cg_phone_num' => '',
		'cg_enable_animation' => 1,
		'cg_headblock_url' => '',
		'cg_contact_addres' => '',
		'cg_contact_email' => '',
		'cg_contact_phone' => '',
		'cg_contact_subject' => '',
		'cg_recaptcha_public_key' => '',
		'cg_recaptcha_private_key' => '',
		'cg_show_post_img'	=> 1,
		'cg_show_post_social'	=> 1,
		'cg_show_related_posts'	=> 1,
		'cg_post_banner1'	=> '',
		'cg_post_banner2'	=> '',
       );

	return $options;
}
/*
 * ==================
 * Sanitize and validate options.
 * ==================
*/
function cg_validate_options( $input ){
	$submit    = ( ! empty( $input['submit'] ) ? true : false );
	$reset     = ( ! empty( $input['reset'] ) ? true : false );
	if( $submit ) :
        $input['cg_logo_url'] = esc_url_raw($input['cg_logo_url']);
    $input['cg_slogan_url'] = esc_url_raw($input['cg_slogan_url']);
    $input['cg_topheader_color'] = wp_filter_nohtml_kses($input['cg_topheader_color']);
    $input['cg_links_color'] = wp_filter_nohtml_kses($input['cg_links_color']);

    $input['cg_fb_url'] = esc_url_raw($input['cg_fb_url'], array( 'http', 'https' ) );
    $input['cg_instagram_url'] = esc_url_raw($input['cg_instagram_url'], array( 'http', 'https' ) );
    $input['cg_youtube_url'] = esc_url_raw($input['cg_youtube_url'], array( 'http', 'https' ) );

    $input['cg_viber_num'] = esc_html($input['cg_viber_num']);
    $input['cg_email_url'] = sanitize_email($input['cg_email_url']);
    $input['cg_phone_num'] = esc_html($input['cg_phone_num']);

    if ( ! isset( $input['cg_enable_animation'] ) )
        $input['cg_enable_animation'] = null;
    $input['cg_enable_animation'] = ( $input['cg_enable_animation'] == 1 ? 1 : 0 );

    if( !isset( $input['cg_excerpt_slider'] ) )
        $input['cg_excerpt_slider'] = null;
    $input['cg_excerpt_slider'] = ( $input['cg_excerpt_slider'] == 1 ? 1 : 0 );

    $input['cg_headblock_url'] = esc_url_raw($input['cg_headblock_url']);
    $input['cg_contact_email'] = wp_filter_nohtml_kses($input['cg_contact_email']);
    $input['cg_recaptcha_public_key'] = wp_filter_nohtml_kses($input['cg_recaptcha_public_key']);
    $input['cg_recaptcha_private_key'] = wp_filter_nohtml_kses($input['cg_recaptcha_private_key']);

    if ( ! isset( $input['cg_show_post_img'] ) )
       $input['cg_show_post_img'] = null;
   $input['cg_show_post_img'] = ( $input['cg_show_post_img'] == 1 ? 1 : 0 );

   if ( ! isset( $input['cg_show_post_social'] ) )
       $input['cg_show_post_social'] = null;
   $input['cg_show_post_social'] = ( $input['cg_show_post_social'] == 1 ? 1 : 0 );

   if ( ! isset( $input['cg_show_related_posts'] ) )
       $input['cg_show_related_posts'] = null;
   $input['cg_show_related_posts'] = ( $input['cg_show_related_posts'] == 1 ? 1 : 0 );

   $input['cg_post_banner1'] = wp_kses_stripslashes( $input['cg_post_banner1'] );
   $input['cg_post_banner2'] = wp_kses_stripslashes( $input['cg_post_banner2'] );

   return $input;
   elseif( $reset ) :
    $input = cg_default_options();
return $input;
endif;
}
if ( ! function_exists( 'cg_get_option' ) ) :
    /*
     * ==================
     * Used to output theme options is an elegant way.
     * @uses get_option() To retrieve the options array.
     * ==================
    */
function cg_get_option( $option ) {
  $options = get_option( 'cg_options', cg_default_options() );
  return isset( $options[ $option ]) ?  $options[ $option ] : '';
}
endif;
