<?php
/**
 * The Archive template file.
 * @package WordPress
 */
get_header(); ?>

<div class="container">
	<div class="sixteen columns">
		<div id="page-title" class="padding-more">
			<h1><?php
				if (is_category()) {
					printf(esc_html__('Category', 'pinecone').':<span> %s</span>', '' . single_cat_title('', false) . ''); }

				if (is_tag()) {
					printf(esc_html__('Tag', 'pinecone').':<span> %s</span>', '' . single_cat_title('', false) . ''); }

				if (is_author()) {
					printf(esc_html__('By', 'pinecone').':<span> '.get_the_author().'</span>', '' . single_cat_title('', false) . ''); }

				if (is_day()) {
					printf(esc_html__('Daily Archives', 'pinecone').':<span> %s </span>', get_the_date()); }

				if (is_month()) {
					printf(esc_html__('Monthly Archives','pinecone').':<span> %s</span>', get_the_date('F Y')); }

				if (is_year()) {
					printf(esc_html__('Yearly Archives', 'pinecone').':<span> %s</span>', get_the_date('Y')); } ?>
			</h1>
		</div>
	</div>
</div>

<?php add_fancybox(); ?>

<div class="container container-content">

	<?php	$sidebar_offset = "offset-by-right";

	if (ot_get_option('blog_layout') == "left-sidebar") {
		$sidebar_offset = "offset-by-one";
		get_sidebar();
	} ?>

	<div class="<?php if (ot_get_option('blog_layout') != "left-sidebar" && ot_get_option('blog_layout') != "right-sidebar") { echo 'fourteen columns blog-nosidebar'; } else { echo 'twelve columns '.esc_attr($sidebar_offset); } ?>">

		<?php while (have_posts()) : the_post();
			get_template_part('blog-loop');
		 endwhile; ?>

		<div class="pagination">
			<div class="nav-previous"><?php next_posts_link(esc_html__('Older posts', 'pinecone')); ?></div>
			<div class="nav-next"><?php previous_posts_link(esc_html__('Newer posts', 'pinecone')); ?></div>
		</div>

	</div>

<?php
if (ot_get_option('blog_layout') == "right-sidebar") { get_sidebar(); }
get_footer(); ?>
