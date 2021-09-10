<?php
/**
 * Video template part
 */

global $wp_embed; ?>

<div class="post_thumb hentry">
	<div class="embed video-cont"><?php echo $wp_embed->run_shortcode('[embed  width="600" height="360"]' . esc_url(get_post_meta($post->ID, 'video_link', true)) . '[/embed]'); ?></div>
</div>
