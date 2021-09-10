<?php
/**
 * Portfolio template part Content
 */

add_fancybox(); ?>

<div class="container">
	<div class="fourteen columns hentry portfolio-text blog-nosidebar">

		<?php while (have_posts()) : the_post();
			get_template_part('content-gallery');
			the_content();
			if (function_exists('themeworm_page_builder')) { themeworm_page_builder(); }
		endwhile; ?>

	</div>
</div>
