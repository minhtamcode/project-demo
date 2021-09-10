<?php
/**
 * Standard template part
 */

if ( is_single() ) { $featured_img = get_post_meta($post->ID, 'disable_resize', TRUE); }

if ( has_post_thumbnail() && !isset($featured_img[2]) ) { ?>
	<div class="post_thumb">
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
			<?php the_post_thumbnail('full'); ?>
		</a>
	</div>
<?php } ?>
