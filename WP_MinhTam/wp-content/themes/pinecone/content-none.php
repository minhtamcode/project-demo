<?php
/**
 * The template part for displaying a message that posts cannot be found
 */
?>
<h6><?php esc_attr_e( 'Oops! No results for you, try to search', 'pinecone' ); ?></h6>

<div class="search-form">
	<form id="searchform" method="get" action="<?php echo esc_url( home_url('/') ); ?>">
		<span class="input contact-form-author last-field">
			<input class="search-box input__field" type="text" name="s">
			<label for="s" class="input__label">
				<span class="input__label-content" data-content="<?php esc_attr_e( 'Search', 'pinecone' ); ?>"><?php esc_attr_e( 'Search', 'pinecone' ); ?></span>
			</label>
		</span>
	</form>
</div>

<div class="search404_post">
	<h6 class="widget-title"><span><?php esc_attr_e( 'Latest Posts', 'pinecone' ); ?></span></h6>
	<div class="nosearch-results">
		<?php tw_displayArchives(); ?>
	</div>
</div>

<div class="search404_post">
	<h6 class="widget-title"><span><?php esc_attr_e( 'Tags', 'pinecone' ); ?></span></h6>
	<div class="nosearch-results tags-cloud">
		<?php wp_tag_cloud( 'smallest=11&largest=11' ); ?>
	</div>
</div>

<div class="search404_post">
	<h6 class="widget-title"><span><?php esc_attr_e( 'Categories', 'pinecone' ); ?></span></h6>
	<div class="nosearch-results">
		<ul>
			<?php wp_list_categories('title_li='); ?>
		</ul>
	</div>
</div>
