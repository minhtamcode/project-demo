<?php
/**
 * Masonry portfolio template part
 */

global $columns, $full_width;
$posts_per_page = ot_get_option('portfolio_showpost','10');

$paged = 1;
$exclude = '';

if ( get_query_var( 'paged' ) ) $paged = get_query_var( 'paged' );
if ( get_query_var( 'page' ) ) $paged = get_query_var( 'page' );

$filters = is_page() ? get_post_meta($post->ID, 'portfolio_filters', true) : get_post_meta($post->ID, 'recent_portfolio_filters', true);
$portfolio_sorting = (ot_get_option('portfolio_sorting')) ?: '';

if (is_single()) { $exclude = $post->ID; $posts_per_page = ot_get_option('recent_showpost'); $nopaging = true; }

if ( empty($filters) ) {

	query_posts(array (
		'post_type' => 'portfolio',
		//'post__not_in' => array($exclude),
		'orderby' => $portfolio_sorting,
		'paged' => $paged,
		'page' => 1,
		//'nopaging' => $nopaging,
		'posts_per_page' => $posts_per_page,
		'meta_query' => array( array(
			'key' => '_thumbnail_id',
			'compare' => 'EXISTS'
		))
	));

} else {

	query_posts(array (
		'post_type' => 'portfolio',
		'post__not_in' => array($exclude),
		'orderby' => $portfolio_sorting,
		'paged' => $paged,
		'posts_per_page' => $posts_per_page,
		'tax_query' => array( array(
			'taxonomy' => 'filters',
			'field' => 'id',
			'terms' => $filters,
			'operator' => 'IN',
			'include_children' => false
		)),
		'meta_query' => array( array(
			'key' => '_thumbnail_id',
			'compare' => 'EXISTS'
		))
	));

}

//$masonry = get_post_meta($post->ID, 'masonry_off', true);
$image_size = (get_post_meta($post->ID, 'masonry_off', true) != "off" ) ? "portfolio-masonry" : "portfolio-main"; ?>

<?php add_fancybox(); ?>

<div class="container portfolio_container" <?php if (!empty($full_width)) echo 'style="width:100%;"' ?>>
	<div id="ajax-loader"><div id="ajax-spinner"></div></div>
	<div id="portfolio-wrapper" class="portfolio-wrapper">

		<?php if ( have_posts() ) { while (have_posts()) : the_post();

			$ratio = $image_url = '';

			if (has_post_thumbnail() && !post_password_required()) {
				$portfolio_main = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $image_size );
				$ratio = ($portfolio_main[2] > 0) ? $portfolio_main[1]/$portfolio_main[2] : '';
				$image_url = $portfolio_main[0];
			}

			$thumbnail_url = get_the_permalink();

			if (get_post_meta($post->ID, 'disable_resize', TRUE)) {

				$disable_resize = get_post_meta($post->ID, 'disable_resize', TRUE);

				if (isset($disable_resize[1])) {
					$thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
					$thumbnail_url = $thumbnail_data[0];

					if (get_post_meta($post->ID, 'custom_url_video', TRUE)) { $thumbnail_url = get_post_meta($post->ID, 'custom_url_video', TRUE); }
				}

				if (isset($disable_resize[3])) {
					$thumbnail_url = "javascript:void(0)";
				}
			}

			if (get_post_meta($post->ID, 'custom_url', TRUE)) { $thumbnail_url = get_post_meta($post->ID, 'custom_url', TRUE); }

			if (has_post_thumbnail() && !post_password_required()) {
				get_template_part( 'content-loop' );
			}

		endwhile; } ?>
	</div>

</div>
