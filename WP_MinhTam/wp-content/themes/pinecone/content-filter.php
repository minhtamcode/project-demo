<?php
/**
 * Filter template part
 */
 ?>

<div class="page container filter-container">
	<div class="sixteen columns">

<?php
$filterswitcher = get_post_meta($post->ID, 'filters_on', true);
$all = wp_count_posts( 'portfolio' )->publish;

if ($filterswitcher != 'off') {

	if (is_page()) { $filters = get_post_meta($post->ID, 'portfolio_filters', true); } else { $filters = get_post_meta($post->ID, 'recent_portfolio_filters', true); }
	$terms = get_terms( 'filters', array( 'include' => $filters, 'orderby' => 'slug' ) ); ?>

	<section id="filter">
		<select class="cs-select cs-skin-underline">
			<option value="" disabled selected><?php esc_html_e( 'Filter', 'pinecone' ); ?></option>
			<option value="all" data-filter="all" data-count="<?php echo $all; ?>"><?php esc_html_e( 'View All', 'pinecone' ); ?></option>

			<?php
			foreach ( $terms as $term ) {
				echo '<option value="'.esc_html($term->slug).'" data-filter="'.esc_html($term->slug).'" data-count="' .$term->count. '">'.esc_html($term->name).'</option>';
			} ?>
		</select>
	</section>

	<script type='text/javascript' src='<?php echo get_template_directory_uri().'/js/selectFx.js' ?>'></script>

	<script>
		(function() {
			[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
				new SelectFx(el);
			} );
		})();
	</script>

	<?php } ?>

	</div>
</div>
