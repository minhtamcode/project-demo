<?php
/**
 * The template for Comments.
 *
 */
?>

<div class="comments-inner">

	<h4 id="comments-title">
		<?php $post_comments = esc_html__('Comments', 'pinecone');
		printf($post_comments.' <em>(%1$s)</em>', get_comments_number(), number_format_i18n(get_comments_number()), '' . get_the_title() . ''); ?>
	</h4>

<?php if ( have_comments() ) : ?>

	<a name="comments"></a>

	<div class="comments-container">

		<?php if ( post_password_required() ) : ?>
			<p><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'pinecone' ); ?></p>
		<?php
			return;
			endif;

		if ( have_comments() ) :

			if ( get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>

				<div id="pagination" class="pagination">
					<?php paginate_comments_links( array( 'prev_text' => '', 'next_text' => '' ) ); ?>
				</div>

			<?php endif; ?>

			<ol class="commentlist">
				<?php wp_list_comments( array('callback' => 'custom_comment', 'avatar_size' => 96) ); ?>
			</ol>

			<?php

		else :

			if ( !comments_open() ) : ?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'pinecone' ); ?></p>
			<?php endif;

		endif; ?>

	</div>

<?php endif; ?>

	<div class="comments-container">
		<?php comment_form(); ?>
	</div>

</div>
