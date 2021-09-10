<?php
/**
 *
 * Template Name: Contacts
 * The page template file.
 * @package WordPress
 */
get_header();

$display_title = get_post_meta($post->ID, 'display_title', true);

if ($display_title != "off") { ?>

	<div class="container">
		<div class="sixteen columns">
			<div id="page-title" class="padding-more">
				<h1>
					<?php the_title(); ?>
				</h1>
			</div>
		</div>
	</div>

<?php } ?>

<?php add_fancybox(); ?>

<?php if (have_posts()) { ?>

<div class="container container-content">

<?php

	$sidebar_side = get_post_meta($post->ID, 'sidebar_layout', true);
	$sidebar_offset = "offset-by-right";

	if (get_post_meta($post->ID, 'sidebar_on', true) != "off" && $sidebar_side == "left-sidebar") {
		$sidebar_offset = "offset-by-one";
		get_sidebar();
	}

?>

	<div class="<?php if(get_post_meta($post->ID, 'sidebar_on', true) != "off") { echo "twelve " . esc_attr($sidebar_offset); } else { echo "fourteen blog-nosidebar "; } ?> columns">

	<?php if ( is_active_sidebar('contact_top') ) : ?>

		<div class="top-sidebar">
			<?php dynamic_sidebar('contact_top'); ?>
		</div>

	<?php endif; ?>

		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>" >
				<?php the_content() ?>
			</div>

		<?php endwhile; ?>

	</div>

<?php } else {

	get_template_part( 'content', 'none' );

} ?>

<?php
if (get_post_meta($post->ID, 'sidebar_on', true) != "off" && $sidebar_side == "right-sidebar") { get_sidebar(); }
get_footer();
?>
