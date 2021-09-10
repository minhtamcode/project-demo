<?php
/**
 * The sinple page portfolio template file.
 * @package WordPress
 */

get_header();

if (get_post_meta($post->ID, 'display_title', true) != "off") { pinecone_title( 'no-padding' ); }

if (ot_get_option('display_portfolio_nav') != "off") { ?>

	<?php echo '<div class="project-navigation" role="navigation"><span>';
		if ( get_adjacent_post( false, '', false ) ) {
			next_post_link( '%link', '<i class="fa fa-angle-left"></i>' );
		} else {
			echo '<i class="inactive fa fa-angle-left"></i>';
		}
		echo '</span>'; ?>

		<a href="<?php echo esc_url(get_page_link(ot_get_option('portfolio_main_page'))); ?>" class="back-to-portfolio"></a>

	<?php
		echo '<span>';
		if ( get_adjacent_post( false, '', true ) ) {
			previous_post_link( '%link', '<i class="fa fa-angle-right"></i>' );
		} else {
			echo '<i class="inactive fa fa-angle-right"></i>';
		};
		echo '</span></div>'; ?>

<?php }

get_template_part('content-portfolio');

share_me_portfolio(); ?>

<?php if (ot_get_option('recent_portfolio','on') != 'off') { ?>

	<div class="container container-content">
		<div class="sixteen columns">
			<div id="page-title" class="recent-title">
				<h3>
					<?php echo esc_attr(ot_get_option('recent_portfolio_text','Recent Works')); ?>
				</h3>
			</div>
		</div>
	</div>

	<?php if (ot_get_option('recent_thumbs') == 'on') { ?>

		<div class="container portfolio_container thumbs_container" style="width:100%;">
			<?php $image_url = $exclude = '';

			$paged = 1;
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
					'posts_per_page' => 10,
					'meta_query' => array( array(
						'key' => '_thumbnail_id',
						'compare' => 'EXISTS'
					))
				));

			} else {

				query_posts(array (
					'post_type' => 'portfolio',
					'post__not_in' => array($exclude),
					'paged' => $paged,
					'posts_per_page' => 10,
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

			if ( have_posts() ) { while (have_posts()) : the_post();
				if (has_post_thumbnail() && !post_password_required()) {
					$portfolio_main = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'portfolio-footer' );
					$ratio = ($portfolio_main[2] > 0) ? $portfolio_main[1]/$portfolio_main[2] : '';
					$image_url = $portfolio_main[0];
				}

				$thumbnail_url = get_the_permalink();
				if (get_post_meta($post->ID, 'custom_url', true)) { $thumbnail_url = esc_url(get_post_meta($post->ID, 'custom_url', true)); } ?>
				<a href="<?php echo $thumbnail_url; ?>">
					<img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
				</a>
			<?php endwhile; } ?>
		</div>

	<?php } else { ?>

		<?php
		$columns = 'full-item-recent';
		$full_width = (ot_get_option('recent_fullwidth') == 'off' || ot_get_option('recent_columns') != 4) ? '' : 'style="width:100%;"';

		if (ot_get_option('recent_columns')) {
			switch (ot_get_option('recent_columns')) {

				case 2: $columns = 'eight columns';
				break;

				case 3: $columns = 'one-third column';
				break;

				case 4: $columns = 'full-item-recent';
				break;
			}
		}

		get_template_part('content-filter');
		get_template_part('content-masonry');

		load_more('', $columns, ot_get_option('recent_showpost','4'), ot_get_option('portfolio_showpost','6'));

		if (ot_get_option('infinite_off') != 'off') { get_appear('#footer'); }

	}

}

get_footer(); ?>
