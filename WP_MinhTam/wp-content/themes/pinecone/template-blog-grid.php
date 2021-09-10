<?php
/**
 * Template Name: Blog 2 columns
 *
 * Iya:) Custom blog template.
 *
 */

get_header();
$sidebar_offset = "offset-by-right"; ?>

<?php pinecone_title( 'padding-more' ); ?>

<?php add_fancybox(); ?>

<div class="container container-content">

<?php if (ot_get_option('blog_layout') == "left-sidebar") {	get_sidebar(); } ?>

<div id="portfolio-wrapper" class="<?php if (ot_get_option('blog_layout') != "left-sidebar" && ot_get_option('blog_layout') != "right-sidebar") { echo 'fourteen columns blog-nosidebar'; } else { echo 'twelve columns '; } ?>">
<?php

	$paged = 1;
	if ( get_query_var( 'paged' ) ) $paged = get_query_var( 'paged' );
	if ( get_query_var( 'page' ) ) $paged = get_query_var( 'page' );

	$blog_query_args = array(
		'post_type' => 'post',
		'paged' => $paged,
		'posts_per_page' => $posts_per_page
	);

	$blog_query = new WP_Query( $blog_query_args );

	if ($blog_query->have_posts()) {

		echo '<div class="blog-grid">';
		while ( $blog_query->have_posts() ) : $blog_query->the_post();
			get_template_part('blog-loop');
		endwhile;
		echo '</div>';

		wp_reset_postdata(); ?>
	</div>
<?php

	} else { ?>

  	<div class="fourteen columns blog-nosidebar">
      <?php get_template_part( 'content', 'none' ); ?>
  	</div>

  <?php } ?>
<?php	if (ot_get_option('blog_layout') == "right-sidebar") { get_sidebar(); } ?>

<div class="pagination">
  <div class="nav-previous"><?php next_posts_link(esc_html__('Older posts', 'pinecone'), $blog_query->max_num_pages); ?></div>
  <div class="nav-next"><?php previous_posts_link(esc_html__('Newer posts', 'pinecone')); ?></div>
</div>

<?php get_footer(); ?>
