<?php
/**
 * Gallery template part
 */

$ids = get_post_meta($post->ID, 'gallery_slider', TRUE);
$args = array(
	'post_type' => 'attachment',
	'post_status' => 'inherit',
	'post_mime_type' => 'image',
	'post__in' => explode( ",", $ids),
	'posts_per_page' => '-1',
	'orderby' => 'post__in'
);

$images_array = get_posts( $args );

if (get_post_meta($post->ID, 'gallery_layout', TRUE) == "slider-gallery" && get_post_meta($post->ID, 'gallery_slider', TRUE) ||   is_page_template( 'template-blog-grid.php' )) {

	if ($images_array) { ?>

		<div class="owl-carousel owl-theme">

			<?php foreach($images_array as $image){
				$attachment = wp_get_attachment_image_src($image->ID, 'full');
				$thumb = wp_get_attachment_image_src($image->ID, 'full'); ?>

				<a class="slick-slide" href="<?php echo esc_url($attachment[0]); ?>" rel="lightbox" id="group" title="<?php echo esc_html($image->post_title); ?>" data-caption="<?php echo esc_html($image->post_excerpt); ?>" >
					<img src="<?php echo esc_url($thumb[0]); ?>" alt="<?php echo esc_html($image->post_title); ?>" />
				</a>

			<?php } ?>

		</div>

	<?php	}

} elseif (get_post_meta($post->ID, 'gallery_layout', TRUE) == "tiled-gallery" && get_post_meta($post->ID, 'gallery_slider', TRUE) ||   is_page_template( 'template-blog-grid.php' )) {

	if ($images_array) { ?>

		<div class="images-container">
			<div class="justified-gallery-container">
				<div class="justified-gallery">

					<?php foreach($images_array as $image){
						$attachment = wp_get_attachment_image_src($image->ID, 'full');
						$thumb = wp_get_attachment_image_src($image->ID, 'full'); ?>

						<a class="slick-slide" href="<?php echo esc_url($attachment[0]); ?>" rel="lightbox" id="group" title="<?php echo esc_html($image->post_title); ?>" data-caption="<?php echo esc_html($image->post_excerpt); ?>" >
							<img src="<?php echo esc_url($thumb[0]); ?>" alt="<?php echo esc_html($image->post_title); ?>" />
						</a>

					<?php } ?>

				</div>
			</div>
		</div>

	<?php }
} else {

	if ($images_array) {

		$masonry_columns = (get_post_meta($post->ID, 'masonry_gallery_layout', TRUE) != "three-columns") ? 'full-item-recent' : 'third-masonry'; ?>

		<div id="portfolio-gallery-wrapper">
			<?php foreach($images_array as $image){
				$attachment = wp_get_attachment_image_src($image->ID, 'full');
				$ratio = ($attachment[2] > 0) ? $attachment[1]/$attachment[2] : '';
				$thumb = wp_get_attachment_image_src($image->ID, 'full'); ?>
				<div class="<?php echo $masonry_columns; ?> portfolio-gallery-item" data-ratio="<?php echo esc_html($ratio) ?>">
					<a href="<?php echo esc_url($attachment[0]); ?>" rel="lightbox" id="group" title="<?php echo esc_html($image->post_title); ?>" data-caption="<?php echo esc_html($image->post_excerpt); ?>" >
						<img src="<?php echo esc_url($thumb[0]); ?>" alt="<?php echo esc_html($image->post_title); ?>" />
					</a>
				</div>
			<?php } ?>
		</div>

		<script type="text/javascript">
			( function( $ ) {
				$(document).ready(function() {
					getMasonryHeight();
				});

				$(window).resize(function(){
					getMasonryHeight();
				});

				function getMasonryHeight() {
					$('.portfolio-gallery-item').each( function() {
						var ratio = $( this ).attr( 'data-ratio' );
						var img_width = $( this ).width();

						if ( ratio > 1 ) {
							var div_height = img_width / ratio;
						} else {
							var div_height = img_width / ratio;
						}

						$( this ).css( { 'height': Math.floor( div_height ) } );
					});
				}

			} )( jQuery );
		</script>

	<?php }
} ?>
