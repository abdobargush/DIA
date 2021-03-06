<?php if ( post_password_required() ) {
	return;
} ?>

<div id="comments" class="comments-area">
<?php 
$class_form = '<div class="form-group"><div class="col-sm-12"><label for="comment" class="control-label">' . __('Comment', 'dia') . '</label>' . '<textarea id="comment" class="form-control" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea>' . '</div></div>';

$author_field = '<div class="form-group"><div class="col-sm-6">' . '<label for="author" class="control-label">'. __('Name', 'dia') .'</label><input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' />' . '</div>';

$email_field = '<div class="col-sm-6">' . '<label for="email" class="control-label">' . __('E-mail', 'dia') . '</label><input id="email" class="form-control" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' />' . '</div></div>';

$sumit_button = '<div class="form-group"><div class="col-sm-12 text-center">' . '<button name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-primary">'. __('Post Comment', 'dia') . '</button>' . '</div></div>';

$logged_in_as = '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'dia'), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>';

comment_form( array (
	'class_form' => 'form-horizontal comment-form',
	'comment_field' => $class_form,
	'fields' => array (
		'author' => $author_field,
		'email' => $email_field,
	),
	'submit_button' => $sumit_button,
	'format' => 'html5',
	'comment_notes_before' => false,
	'logged_in_as' => $logged_in_as,
)); ?>
	
<?php if ( have_comments() ) : ?>
	<h3 class="comments-title">
		<?php
		printf( _nx( __('One comment', 'dia'), __('%1$s Comments', 'dia'), get_comments_number(), 'comments title'),
			number_format_i18n( get_comments_number() ) );
		?>
	</h3>
	<ul class="comment-list media-list">
		<?php 
			wp_list_comments( array(
				'format' => 'html5',
				'callback' => 'dia_comments',
			) );
		?>
	</ul>
	
	<?php if ( get_the_comments_navigation() ) : ?>
		<div class="text-center">
			<?php echo get_the_comments_pagination( 
				array(
					'screen_reader_text' => ' ',
					'next_text' => '<svg id="i-arrow-right" viewBox="0 0 32 32" width="18" height="18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
							<path d="M22 6 L30 16 22 26 M30 16 L2 16" />
						</svg>',
					'prev_text' => '<svg id="i-arrow-left" viewBox="0 0 32 32" width="18" height="18" fill="none" 	stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
						<path d="M10 6 L2 16 10 26 M2 16 L30 16" />
						</svg>'
				) ) ?>
		</div>
	<?php endif; ?>
	
<?php endif; ?>
<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<p class="no-comments">
		<?php _e( 'Comments are closed.', 'dia'); ?>
	</p>
<?php endif; ?>

</div>