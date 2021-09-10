<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-thumbnail">
    <?php minhtam_thumbnail('thumbnail'); ?>
  </div>
  <header class="entry-header">
    <?php minhtam_entry_header(); ?>
    <?php minhtam_entry_meta() ?>
  </header>
  <div class="entry-content">
    <?php minhtam_entry_content(); ?>
    <?php (is_single() ? minhtam_entry_tag() : ''); ?>
  </div>
</article>