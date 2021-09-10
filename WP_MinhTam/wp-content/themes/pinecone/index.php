<?php
/**
 * The main template file.
 * @package WordPress
 */

get_header();

$sidebar_offset = "offset-by-right"; ?>

<div class="container">
	<div class="sixteen columns">
		<div id="page-title" class="padding-more">
				<h1>
					<?php
					if (is_search()) {
						$post_search_result = esc_html__('Search Results for:', 'pinecone');
						echo $post_search_result.' <span>'.get_search_query().'</span>';
					} else {
						 echo esc_attr( ot_get_option('blog_title', 'Blog') );
					} ?>
				</h1>
		</div>
	</div>
</div>

<?php add_fancybox(); ?>

<div class="container container-content">

<?php if (have_posts()) {

	if (ot_get_option('blog_layout') == "left-sidebar") {
		$sidebar_offset = "offset-by-one";
		get_sidebar();
	} ?>

	<div class="<?php if (ot_get_option('blog_layout') != "left-sidebar" && ot_get_option('blog_layout') != "right-sidebar") { echo 'fourteen columns blog-nosidebar'; } else { echo 'twelve columns '.esc_html($sidebar_offset); } ?>">

		<?php while (have_posts()) : the_post();

			get_template_part('blog-loop');

		endwhile; ?>

			<div class="pagination">
				<div class="nav-previous"><?php next_posts_link(esc_html__('Older posts', 'pinecone')); ?></div>
				<div class="nav-next"><?php previous_posts_link(esc_html__('Newer posts', 'pinecone')); ?></div>
			</div>

	</div>

<?php } else { ?>

	<div class="<?php if (ot_get_option('blog_layout') != "left-sidebar" && ot_get_option('blog_layout') != "right-sidebar") { echo 'fourteen columns blog-nosidebar'; } else { echo 'twelve columns '.esc_html($sidebar_offset); } ?>">

    <?php get_template_part( 'content', 'none' ); ?>

	</div>

<?php } ?>

<?php
if (ot_get_option('blog_layout') == "right-sidebar") { get_sidebar(); }
get_footer(); ?>
