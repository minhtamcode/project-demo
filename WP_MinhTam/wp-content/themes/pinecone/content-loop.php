<?php
/**
 * Masonry portfolio loop template part
 */

//$columns = 'one-third column';
global $columns;
$ratio = $image_url = '';
$image_size = (get_post_meta($post->ID, 'masonry_off', true) != "off" ) ? "portfolio-masonry" : "portfolio-main";

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
		$thumbnail_url = esc_url($thumbnail_data[0]);
		if (get_post_meta($post->ID, 'custom_url_video', TRUE)) { $thumbnail_url = esc_url(get_post_meta($post->ID, 'custom_url_video', TRUE)); }
	}

	if (isset($disable_resize[3])) {
		$thumbnail_url = "javascript:void(0)";
	}

	if (isset($disable_resize[0])) {
		$portfolio_main = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
		$image_url = $portfolio_main[0];
	}

}

if (get_post_meta($post->ID, 'custom_url', true)) { $thumbnail_url = esc_url(get_post_meta($post->ID, 'custom_url', true)); } ?>

<div <?php post_class(esc_html($columns).' portfolio-item'); ?> id="post-<?php the_ID(); ?>" data-id="<?php the_ID(); ?>" >

	<div class="picture">
		<a href="<?php echo $thumbnail_url; ?>" class="portfolio-link <?php if (get_post_meta(get_the_ID(), 'custom_url_video', TRUE) && isset($disable_resize[1])) { echo 'video-popup'; } ?>" <?php if (isset($disable_resize[1])) {echo 'id="group"'; } ?> data-fancybox-group="examples">

			<div class="thumb" data-ratio="<?php echo esc_html($ratio) ?>" style="background-image:url('<?php echo esc_url($image_url); ?>');" alt="<?php the_title(); ?>" ></div>

		</a>
	</div>

	<div class="item-description alt">
		<h6><?php the_title();?></h6>
		<span>
			<?php $terms = get_the_terms( $post->ID, 'filters');
			 //$terms = wp_get_object_terms( $post->ID, 'filters', array('orderby' => 'slug', 'order' => 'ASC'));
			if ( $terms ) {
				foreach ( $terms as $term ) {
					echo esc_html( $term->name ) .' ';
				}
			} ?>
		</span>
	</div>

</div>

<?php if (get_post_meta(get_the_ID(), 'custom_url_video', TRUE) && isset($disable_resize[1])) { ?>
	<script type="text/javascript">
		( function( $ ) {
			$(document).ready(function() {
				$('.video-popup').magnificPopup({type:'iframe'});
			});
		} )( jQuery );
	</script>
<?php } ?>
