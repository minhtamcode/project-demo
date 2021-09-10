<?php
/**
 * Blog template part
 */

if (function_exists('get_post_format') && get_post_format($post->ID) == 'link' ) {
	$link = get_the_content();
	$link = strip_tags($link);
} ?>

<div <?php post_class('loop portfolio-item'); ?> id="post-<?php the_ID(); ?>" >

	<div class="post-date">
		<a href="<?php if ( !empty($link)) { echo esc_url($link); } else { the_permalink(); } ?>" rel="bookmark">
			<div class="date-number"><?php echo get_the_date('j').'<span>'.get_the_date('M').'</span>'; ?></div>
		</a>
	</div>

	<?php if (function_exists('get_post_format') && get_post_format($post->ID) != 'link' ) {

		get_template_part('blog', get_post_format());  ?>

		<div class="post-stroke">
			<div class="post-title">
				<h2>
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<?php the_title(); ?>
					</a>
				</h2>
			</div>
			<div class="post-category"><?php the_category( ', ' ); ?></div>
		</div>

		<div class="post-content">

			<?php	if (function_exists('get_post_format') && get_post_format($post->ID) == 'quote') { ?>

				<div class="post-description loop-page"><p><?php echo '<blockquote>'.get_the_content().'</blockquote>'; ?></p></div>

			<?php	} else {

				$word_count = 60;
				if ( ot_get_option('blog_trim') && ot_get_option('blog_trim') != "full" ) { $word_count = ot_get_option('blog_trim'); }
				if (is_single()) { $word_count = 30; }
				$the_content = get_the_content();
				$the_content = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $the_content); ?>

				<div class="post-description loop-page">
					<p><?php if (ot_get_option('blog_trim') == "full") { the_content(); } else { echo wp_trim_words( $the_content, $word_count ); } ?></p>
				</div>

				<?php if ( ot_get_option('blog_trim') && ot_get_option('blog_trim') != "full" ) { ?>
					<a class="readmore" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'pinecone' ); ?></a>
				<?php } ?>

			<?php } ?>

		</div>

	<?php } else { ?>

		<div class="post-stroke">
			<div class="post-title">
				<h2>
					<a href="<?php echo esc_url($link); ?>" rel="bookmark">
						<?php the_title(); ?>
					</a>
				</h2>
			</div>
		</div>

		<div class="post-link"><i class="fa fa-link"></i></div>

	<?php } ?>

</div>
