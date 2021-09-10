<?php
/**
 * The template for search form
 */
?>

<div class="search-form search-side">
	<form id="searchform" method="get" action="<?php echo esc_url( home_url('/') ); ?>">
		<span class="input contact-form-author">
			<input class="search-box input__field" type="text" name="s">
			<label for="s" class="input__label">
				<span class="input__label-content" data-content="<?php esc_html_e('Search','pinecone'); ?>"><?php esc_html_e('Search','pinecone'); ?></span>
			</label>
		</span>
	</form>
</div>