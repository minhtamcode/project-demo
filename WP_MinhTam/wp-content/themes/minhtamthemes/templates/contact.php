<?php
/*
 Template Name: Contact
 */
?>
<?php get_header(); ?>
<div class="content">
    <div id="main-content">
        <div class="contact-info">
            <h4>Địa chỉ liên lạc</h4>
            <p>Ghi địa chỉ vào đây</p>
            <p>090 456 765</p>
        </div>
        <div class="contact-form">
            <?php echo do_shortcode('[contact-form-7 id="66" title="Form liên hệ 1"]'); ?>
        </div>
    </div>
    <div id="sidebar">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>