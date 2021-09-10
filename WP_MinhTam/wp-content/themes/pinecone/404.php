<?php
/**
 * The 404 page template file.
 * @package WordPress
 */
get_header(); ?>

<div class="container">
	<div class="sixteen columns">
		<div id="page-title" class="padding-more">
			<h1><?php

				$allowed_html = array(
					'strong' => array(),
					'span' => array()
				);

				echo wp_kses( __('404 <span>Page Not Found</span>', 'coffeebean' ), $allowed_html);

			?></h1>
    </div>
	</div>
</div>

<div class="container container-content">

	<?php	$sidebar_offset = "offset-by-right";

	if (ot_get_option('blog_layout') == "left-sidebar") {
		$sidebar_offset = "offset-by-one";
		get_sidebar();
	} ?>

	<div class="<?php if (ot_get_option('blog_layout') != "left-sidebar" && ot_get_option('blog_layout') != "right-sidebar") { echo 'fourteen columns blog-nosidebar'; } else { echo 'twelve columns '.esc_attr($sidebar_offset); } ?>">

    <?php get_template_part( 'content', 'none' ); ?>

	</div>

<?php
if (ot_get_option('blog_layout') == "right-sidebar") { get_sidebar(); }
get_footer(); ?>
