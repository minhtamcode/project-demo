<?php
/**
 * Gallery template part
 */

$ids = get_post_meta($post->ID, 'gallery_slider', TRUE);

if ( isset($ids) ) {
	$args = array(
		'post_type' => 'attachment',
		'post_status' => 'inherit',
		'post_mime_type' => 'image',
		'post__in' => explode( ",", $ids),
		'posts_per_page' => '-1',
		'orderby' => 'post__in'
	);
	$images_array = get_posts( $args );
}

if (get_post_meta($post->ID, 'gallery_layout', TRUE) != "tiled-gallery" ) {

	if (is_array($images_array)) { ?>

		<div class="owl-carousel owl-theme">

			<?php foreach($images_array as $image){
				$attachment = wp_get_attachment_image_src($image->ID, 'full');
				$thumb = wp_get_attachment_image_src($image->ID, 'full'); ?>

				<a class="slick-slide" href="<?php echo esc_url($attachment[0]); ?>" rel="lightbox" id="group" title="<?php echo esc_html($image->post_title); ?>" >
					<img src="<?php echo esc_url($thumb[0]) ?>" alt="<?php echo esc_html($image->post_title); ?>" />
				</a>

			<?php } ?>

		</div>

	<?php }

} else {

	if (is_array($images_array)) { ?>

		<div class="images-container">
			<div class="justified-gallery-container">
				<div class="justified-gallery">

					<?php foreach($images_array as $image){
						$attachment = wp_get_attachment_image_src($image->ID, 'full');
						$thumb = wp_get_attachment_image_src($image->ID, 'full'); ?>

						<a class="slick-slide" href="<?php esc_url(echo $attachment[0]); ?>" rel="lightbox" id="group" title="<?php echo esc_html($image->post_title); ?>" >
							<img src="<?php echo esc_url($thumb[0]); ?>" alt="<?php echo esc_html($image->post_title); ?>" />
						</a>

					<?php } ?>

				</div>
			</div>
		</div>

	<?php	}
} ?>
