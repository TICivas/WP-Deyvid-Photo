<?php 
	$custom_comment_form = array( 
		'fields' => apply_filters( 'comment_form_default_fields', array(
		    'author' => '<div class="name-field">
		    			 <input type="text" id="author" name="author" placeholder="' . esc_html__( 'Name *', 'lydia' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" />
		    			 </div>',
		    'email'  => '<div class="email-field">
		    			 <input name="email" type="text" id="email" placeholder="' . esc_html__( 'Email *', 'lydia' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" />
		    			 </div>',
		    'url'    => '<div class="website-field">
		    			 <input name="url" type="text" id="url" placeholder="' . esc_html__( 'Website', 'lydia') . '" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" />
		    			 </div>') 
		),
		'comment_field' => '<div class="message-field">
							<textarea name="comment" placeholder="' . esc_html__( 'Enter your comment here...', 'lydia' ) . '" id="comment" aria-required="true"></textarea>
							</div>',
		'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a> <a href="%3$s">Log out?</a>','lydia' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',
		'cancel_reply_link' => esc_html__( 'Cancel' , 'lydia' ),
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'label_submit' => esc_html__( 'Submit' , 'lydia' )
	);
	
	if( get_option('disqus_username') )
		get_template_part('inc/content','disqus-comments');
?>
          
<div class="divide30"></div>

<div class="box">

	<h3><?php comments_number( esc_html__( '0 Comments', 'lydia' ), esc_html__( '1 Comment', 'lydia' ), esc_html__( '% Comments', 'lydia' ) ); ?></h3>
	
	<div id="comments">
		<?php 
			if( have_comments() ){
				echo '<ol id="singlecomments" class="commentlist">';
					wp_list_comments( 'type=comment&callback=ebor_custom_comment' );
				echo '</ol>';
				paginate_comments_links();
			}
		?>
	</div>

</div>

<div class="divide30"></div>

<div class="box">
	<div class="comment-form-wrapper">
	
		<h3><?php echo get_option( 'comments_title', 'Would you like to share your thoughts?' ); ?></h3>
		
		<?php 
			echo wpautop( get_option( 'comments_subtitle', 'Your email address will not be published. Required fields are marked *' ) );
			comment_form( $custom_comment_form ); 
		?>
		
	</div>
</div>