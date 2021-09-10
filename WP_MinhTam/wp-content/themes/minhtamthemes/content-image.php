<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-thumbnail">
        <?php minhtam_thumbnail('thumbnail'); ?>
    </div>
    <header class="entry-header">
        <?php minhtam_entry_header(); ?>
        <?php
        /*
* Đếm số lượng attachment có trong post
*/
        $attachments = get_children(array('post_parent' => $post->ID));
        $attachment_number = count($attachments);
        printf(__('Có %1$s ảnh trong bài viết', 'minhtam'), $attachment_number);
        ?>
    </header>
    <div class="entry-content">
    <?php minhtam_entry_content(); ?>
                <?php ( is_single() ? minhtam_entry_tag() : '' ); ?>
    </div>
</article>