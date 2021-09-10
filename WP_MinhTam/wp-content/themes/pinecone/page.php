<?php
/**
 * The page template file.
 * @package WordPress
 */
get_header();

if (get_post_meta($post->ID, 'display_title', true) != "off") { pinecone_title( 'padding-more' ); } ?>

<?php add_fancybox(); ?>

<div class="container container-content">

<?php

	$sidebar_side = get_post_meta($post->ID, 'sidebar_layout', true);
	$sidebar_offset = "offset-by-right";

	if (get_post_meta($post->ID, 'sidebar_on', true) != "off" && $sidebar_side == "left-sidebar") {
		$sidebar_offset = "offset-by-one";
		get_sidebar();
	}

?>

	<div class="<?php if(get_post_meta($post->ID, 'sidebar_on', true) != "off") { echo "twelve ".esc_attr($sidebar_offset);} else { echo "fourteen blog-nosidebar ";} ?> columns">

		<?php while (have_posts()) : the_post(); ?>
			<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>" >
				<?php the_content() ?>
				<?php if (function_exists('themeworm_page_builder')) { themeworm_page_builder(); } ?>
			</div>
		<?php endwhile; ?>

		<?php if ( have_comments() && comments_open() && ot_get_option('hide_comments') != "yes" ) { comments_template('', true); } ?>

	</div>

<?php
if (get_post_meta($post->ID, 'sidebar_on', true) != "off" && $sidebar_side == "right-sidebar" || $sidebar_side == "" ) { get_sidebar(); }
get_footer(); ?>
