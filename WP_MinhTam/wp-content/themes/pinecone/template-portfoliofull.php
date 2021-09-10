<?php
/**
 * Template Name: Portfolio Full Width
 *
 * Iya:) Custom portfolio template.
 */

get_header();

if (get_post_meta($post->ID, 'display_title', true) != "off") { pinecone_title(); } ?>

<div class="container container-content">
	<div class="sixteen columns">
		<?php while (have_posts()) : the_post(); ?>
			<?php the_content() ?>
		<?php endwhile; ?>
	</div>
</div>

<?php
$columns = 'full-item';
$full_width = 'style="width:100%;"';
$filters_array = (get_post_meta($post->ID, 'portfolio_filters', true)) ? get_post_meta($post->ID, 'portfolio_filters', true) : '';

get_template_part('content-filter');
get_template_part('content-masonry');

load_more($filters_array,$columns);

if (ot_get_option('infinite_off') != 'off') { get_appear('#footer'); }

get_footer(); ?>
