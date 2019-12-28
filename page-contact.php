<?php
session_start();
/**
 * Template Name: Contact Page
 * Description: A Page Template to display contact form with captcha and jQuery validation.
 *
 *
 */
$name_error     = '';
$email_error    = '';
$message_error  = '';
$captcha_error  = '';

if( isset( $_POST['cg_submit'] )) {
    /* validate sender name*/
    if(trim($_POST['sender_name']) === '') {
        $name_error = "Будь ласка, введіть Ваше ім'я.";
        $has_error = true;
    } else {
        $sender_name = trim($_POST['sender_name']);
    }
    /*validate sender email*/
    if(trim($_POST['sender_email']) === '')  {
        $email_error = 'Будь ласка, введіть Ваш email.';
        $has_error = true;
    } else if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", trim($_POST['sender_email']))){
        $email_error = 'Будь ласка, введіть Ваше коректний email.';
        $has_error = true;
    } else {
        $sender_email = trim($_POST['sender_email']);
    }

    /*validate message*/
    if(trim($_POST['message_text']) === '') {
        $message_error = 'Будь ласка, введіть повідомлення.';
        $has_error = true;
    } else {
        if(function_exists('stripslashes')) {
            $message = stripslashes(trim($_POST['message_text']));
        } else {
            $message = trim($_POST['message_text']);
        }
    }

        // include_once( trailingslashit( get_stylesheet_directory() ) . 'framework/lib/recaptcha/recaptchalib.php' );
    if( !isset( $has_error ) ) {
      $email_to = cg_get_option( 'cg_contact_email' );
      $subject = cg_get_option( 'cg_contact_subject' );

      if( !isset( $email_to ) || ( $email_to == '' ) ) {
        $email_to = get_option( 'admin_email' );
    }

    if( !isset( $subject ) || ( $subject == '' ) ) {
        $subject = 'Contact Message From ' . $sender_name;
    }

    $from_user = "=?UTF-8?B?".base64_encode($sender_name)."?=";
    $subject = "=?UTF-8?B?".base64_encode($subject)."?=";

    $headers = "From: $from_user <$sender_email>\r\n".
    "Reply-To: $sender_email" . "\r\n" .
    "MIME-Version: 1.0" . "\r\n" .
    "Content-type: text/html; charset=UTF-8" . "\r\n";

    $body = "Name: $sender_name <br />Email: $sender_email <br />Comments: $message";

    mail($email_to, $subject, $body, $headers);
    $email_sent = true;
}

}
get_header();
?>
<section class="clearfix contact__header">
    <div class="contact-headblock">
        <?php if( cg_get_option( 'cg_headblock_url' ) ):?>
        <img src="<?php echo cg_get_option( 'cg_headblock_url' )?>" alt="<?php bloginfo( 'name' )?>">
    <?php endif;?>
</div>
</section>
<section class="clearfix b_content">
    <script type="text/javascript">
        <!--//--><![CDATA[//><!--
        jQuery(document).ready(function() {
            jQuery('form#cg_contact_form').submit(function() {
                jQuery('form#cg_contact_form .error').remove();
                var hasError = false;
                jQuery('.requiredField').each(function() {
                    if(jQuery.trim(jQuery(this).val()) == '') {

                        if(jQuery(this).hasClass('name_field')) {
                            jQuery(this).parent().append('<span class="error"><?php _e('Please enter your name.', 'codegrabber'); ?></span>');
                        }

                        if(jQuery(this).hasClass('title_field')) {
                            jQuery(this).parent().append('<span class="error"><?php _e('Please enter message title.', 'codegrabber'); ?></span>');
                        }

                        if(jQuery(this).hasClass('email')) {
                            jQuery(this).parent().append('<span class="error"><?php _e('Please enter your email.', 'codegrabber'); ?></span>');
                        }

                        if(jQuery(this).hasClass('message_field')) {
                            jQuery(this).parent().append('<span class="error"><?php _e('Please enter your message.', 'codegrabber'); ?></span>');
                        }

                        if(jQuery(this).hasClass("captcha_field")) {
                            jQuery(this).parent().append('<span class="error"><?php _e('Please enter the security code.', 'codegrabber'); ?></span>');
                        }

                        jQuery(this).addClass('inputError');
                        hasError = true;
                    } else if(jQuery(this).hasClass('email')) {
                        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                        if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
                            jQuery(this).parent().append('<span class="error"><?php _e('Please enter valid email', 'codegrabber'); ?> </span>');
                            jQuery(this).addClass('inputError');
                            hasError = true;
                        }
                    }
                });

if(hasError) {
    return false;
} else{
    return true;
}
});
});
    //-->!]]>
    </script>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="breadcrumbs">
                    <a href="<?php echo home_url();?>">Home </a>&raquo;
                    <strong><?php echo the_title();?></strong>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="contact-infobox">
                    <ul>
                        <?php if( cg_get_option( 'cg_contact_addres' ) ):?>
                        <li>
                            <div class="contact-profile__icon">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                            </div>
                            <div class="contact-profile__text">
                                <?php echo cg_get_option( 'cg_contact_addres' );?>
                            </div>
                        </li>
                    <?php endif;?>
                    <?php if( cg_get_option( 'cg_contact_phone' ) ):?>
                    <li>
                        <div class="contact-profile__icon">
                            <i class="fa fa-phone-square" aria-hidden="true"></i>
                        </div>

                        <div class="contact-profile__text">
                            <?php echo cg_get_option( 'cg_contact_phone' ); ?>
                        </div>

                    </li>
                <?php endif;?>
                <?php if( cg_get_option( 'cg_contact_email' ) ):?>
                <li>
                    <div class="contact-profile__icon">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                    <div class="contact-profile__text">
                        <?php echo cg_get_option( 'cg_contact_email' );?>
                    </div>
                </li>
            <?php endif;?>
        </ul>

    </div>
</div>
<?php if( have_posts() ):?>
    <div class="col-xs-12 col-sm-12 col-md-8">
        <article>
          <?php if(empty($cg_recaptcha_public_key) or (empty($cg_recaptcha_private_key))) { ?>
          <!-- <div class="msgbox msgbox-warning"><?php _e('<strong>Important.</strong> You need to add reCAPTCHA keys in the theme options for contact form to work.', 'codegrabber') ?></div> -->
          <?php } ?>
          <?php if(isset($email_sent) && $email_sent == true) : ?>
          <div class="msgbox msgbox-success"><?php _e( '<strong>Thank you!</strong> Your message has been sent.', 'codegrabber') ?></div>
      <?php else : ?>

      <?php if(isset($has_error)) : ?>
      <div class="msgbox msgbox-error"><?php _e( 'Please, correct the above errors and send the message again.', 'codegrabber') ?></div>
  <?php endif; ?>
<?php endif; ?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="cg_contact_form">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <input type="text" class="name_field requiredField" id="sender_name" name ="sender_name" value="<?php if(isset($_POST['sender_name'])) echo $_POST['sender_name'];?>" placeholder="Name">
        <?php if( $name_error != '' ) : ?>
        <span class="error"><?php echo $name_error;?></span>
    <?php endif;?>
</div>
<div class="col-xs-12 col-sm-6 col-md-6">
    <input type="email" class="email requiredField" id="sender_email " name="sender_email" placeholder="Email &#42;" value="<?php if(isset($_POST['sender_email'])) echo $_POST['sender_email'];?>">
    <?php if( $email_error != '' ) : ?>
    <span class="error"><?php echo $email_error;?></span>
<?php endif;?>
</div>
<div class="col-xs-12">
    <input type="text" id="message_title" class="title_field requiredField" name="message_title" placeholder="Subject" value="<?php if(isset($_POST['message_title'])) echo $_POST['message_title'];?>">
    <?php if( $message_error != '' ) : ?>
    <span class="error"><?php echo $message_error;?></span>
<?php endif;?>
</div>
<div class="col-xs-12">
    <textarea name="message_text" class="message_field requiredField" id="message_text" rows="8" cols="10" placeholder="Your text"><?php if(isset($_POST['message_text'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['message_text']); } else { echo $_POST['message_text']; } } ?></textarea>
    <?php if( $message_error != '' ) : ?>
    <span class="error"><?php echo $message_error;?></span>
<?php endif;?>
</div>
<div id="recaptcha_widget" class='captcha_field' style="display:none">
  <div class="field">
     <div class="recaptcha_only_if_incorrect_sol" style="color:red"><?php _e( 'Error! Please try again.', 'codegrabber'); ?></div>
     <input type="text" id="recaptcha_response_field" class="text requiredField captcha_field" name="recaptcha_response_field"placeholder="<?php _e( 'Confirmation code', 'codegrabber'); ?> &#42;" />
     <?php if($captcha_error != '') { ?>
     <span class="error"><?php echo $captcha_error; ?></span>
     <?php } ?>
 </div>

 <div class="field recaptcha-image">
     <div id="recaptcha_image"></div>
     <div class="recaptcha_refresh"><i class="fa fa-refresh"></i><a href="javascript:Recaptcha.reload()"><?php _e( 'Refresh', 'codegrabber'); ?></a></div>
     <div class="recaptcha_only_if_image"><i class="fa fa-volume-up"></i><a href="javascript:Recaptcha.switch_type('Audio')"><?php _e('Audio ', 'codegrabber'); ?></a></div>
     <div class="recaptcha_only_if_audio"><i class="fa fa-picture-o"></i><a href="javascript:Recaptcha.switch_type( 'Image' )"><?php _e('Image', 'codegrabber'); ?></a></div>
     <div class="recaptcha_help"><i class="fa fa-info-circle"></i><a href="javascript:Recaptcha.showhelp()"><?php _e( 'Help', 'codegrabber'); ?></a></div>
 </div>

 <script type="text/javascript"
 src="http://www.google.com/recaptcha/api/challenge?k=<?php echo $cg_recaptcha_public_key; ?>">
 </script>
 <noscript>
   <iframe src="http://www.google.com/recaptcha/api/noscript?k=<?php echo $cg_recaptcha_public_key; ?>"
    height="300" width="500" frameborder="0"></iframe><br>
    <textarea name="recaptcha_challenge_field" rows="3" cols="40">
    </textarea>
    <input type="hidden" name="recaptcha_response_field"
    value="manual_challenge">
</noscript>
<!-- <div class="g-recaptcha">6LedRCQUAAAAANzorD4GKu4NMBfWMXj69orELAjB</div>-->
<!-- <span class="error"><?php //echo $captcha_error;?></span>  -->
</div>
<div class="col-xs-12 col-sm-6 col-md-4">
    <input type="submit" name="cg_submit" value="<?php _e('Send', 'codegrabber'); ?>">
</div>
<script src='https://www.google.com/recaptcha/api.js'></script>
</form>
</article>
</div>
<?php endif;?>

</div>
</div>
</section>
<?php get_footer();?>
