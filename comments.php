<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package codegrabber
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="b_comments clearfix">
	<?php
		global $post_id;
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$arg = array(
			'comment_email' => '',
			'fields' => array(
							'author'	=> '<div class="comment-form-author col-xs-12 col-sm-6 col-md-6">' . '<label for="author">Name *</label>
										<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
							'email'		=> '<div class="comment-form-email col-xs-12 col-sm-6 col-md-6"><label for="email">E-mail *</label>
								<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_email'] ) . '" size="30" /></div>',
							'must_log_in'	=> '<p class="must-log-in col-xs-12">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',

						),
			'comment_field'			=> '<div class="comment-form-comment col-xs-12"><label for="comment">Ваш коментар *</label><br /><textarea id="comment" name="comment" rows="8" cols="10" aria-required="true"></textarea></div>',
			'submit_button'			=> '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s">',
					'submit_field'	=> '<p class="form-submit col-xs-8 col-sm-4">%1$s %2$s</p>',
			);

			comment_form( $arg );
	?>
</div>

<div id="comments">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title ">
			<?php
				// printf( // WPCS: XSS OK.
				// 	esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'codegrabber' ) ),
				// 	number_format_i18n( get_comments_number() ),
				// 	'<span>' . get_the_title() . '</span>'
				// );
			?>
		</h2><!-- .comments-title -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'codegrabber' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'codegrabber' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'codegrabber' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>
		<ul>

			<?php
				wp_list_comments( array('callback' =>'codegrabber_comment') );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'codegrabber' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'codegrabber' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'codegrabber' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'codegrabber' ); ?></p>
	<?php
	endif;
?>

</div><!-- #comments -->
