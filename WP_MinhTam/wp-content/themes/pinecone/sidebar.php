<?php

if (is_page()) {
	$position = (get_post_meta($post->ID, 'sidebar_layout', true) == 'left-sidebar') ? '' : 'omega';
} else {
	$position = (ot_get_option('blog_layout') == 'left-sidebar') ? '' : 'omega';
}

$sidebar_name = (is_page_template('template-contact.php')) ? "sidebar2" : "sidebar1"; 

?>

<div class="four columns <?php echo esc_html($position); ?>">

	<?php if ( is_active_sidebar( $sidebar_name ) ) : ?>

		<div class="blog-sidebar">
			<?php dynamic_sidebar( $sidebar_name ); ?>
		</div>

	<?php endif; ?>

</div>
