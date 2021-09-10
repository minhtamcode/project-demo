<?php
/**
 * The single page template file.
 * @package WordPress
 */
get_header(); ?>

<?php pinecone_title( 'no-padding' ); ?>

<?php echo '<div class="project-navigation" role="navigation"><span>';

if ( get_adjacent_post( false, '', false ) ) {
	next_post_link( '%link', '<i class="fa fa-angle-left"></i>' );
} else {
	echo '<i class="inactive fa fa-angle-left"></i>';
}
echo '</span>'; ?>

<a href="<?php echo esc_url(get_page_link(ot_get_option('blog_main_page'))); ?>" class="back-to-blog"></a>

<?php
echo '<span>';

if ( get_adjacent_post( false, '', true ) ) {
	previous_post_link( '%link', '<i class="fa fa-angle-right"></i>' );
} else {
	echo '<i class="inactive fa fa-angle-right"></i>';
};
echo '</span></div>'; ?>

<?php add_fancybox(); ?>

<div class="container">

	<?php	$sidebar_offset = "offset-by-right";

	if (ot_get_option('blog_layout') == "left-sidebar") {
		$sidebar_offset = "offset-by-one";
		get_sidebar();
	}	?>

	<div class="<?php if (ot_get_option('blog_layout') != "left-sidebar" && ot_get_option('blog_layout') != "right-sidebar") { echo 'fourteen columns blog-nosidebar'; } else { echo 'twelve columns '.esc_html($sidebar_offset); } ?>">

		<?php while (have_posts()) : the_post(); ?>

		<?php get_template_part('blog', get_post_format());  ?>

				<div class="post-meta">
					<div class="single-date">

						<span class="single-number"><?php echo get_the_date('F j, Y'); ?></span>
						<span class="single-cats"><?php esc_html_e('Category: ', 'pinecone'); the_category( ', ' ); ?></span>
						<?php if (has_tag()) { ?><span class="single-tags"> <?php the_tags(esc_html__( 'Tags: ', 'pinecone' ),', '); ?></span><?php } ?>

					</div>

				</div>

			<div <?php post_class('post-page'); ?> id="post-<?php the_ID(); ?>" >
				<div class="post-content">
					<div class="post-description">
						<?php
						if (function_exists('get_post_format') && get_post_format($post->ID) == 'quote') {
							echo '<blockquote>'; the_content(); echo '</blockquote>';
						} else {
							the_content();
						}
						if (function_exists('themeworm_page_builder')) { themeworm_page_builder(); }
						?>
					</div>
				</div>
			</div>

		<?php share_me_blog(); ?>

		<?php wp_link_pages(); ?>

		<?php endwhile; ?>

		<?php if (ot_get_option('show_recent') != "off" ) { tw_related_posts(); } ?>
		<?php if (ot_get_option('hide_comments') != "yes" ) { comments_template('', true); } ?>

	</div>

<?php
if (ot_get_option('blog_layout') == "right-sidebar") {
	get_sidebar();
}

get_footer(); ?>
