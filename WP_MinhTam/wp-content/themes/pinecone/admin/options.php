<?php

function thumb_class($classes) {
  global $post;

  if(has_post_thumbnail($post->ID)) {
    $classes[] = "has-thumbnail";
  }
  return $classes;
}

add_filter('post_class','thumb_class');

if ( !function_exists('AddThumbColumn') && function_exists('add_theme_support') ) {

  add_theme_support('post-thumbnails', array( 'post', 'page' ) );
  function AddThumbColumn($cols) {
    $cols['thumbnail'] = esc_html__('Thumbnail','pinecone');
    return $cols;
  }

  function AddThumbValue($column_name, $post_id) {
    $width = (int) 60;
    $height = (int) 60;

    if ( 'thumbnail' == $column_name ) {
      $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
      $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );

      if ($thumbnail_id)
        $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
      elseif ($attachments) {
        foreach ( $attachments as $attachment_id => $attachment ) {
          $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
        }
      }

      if ( isset($thumb) && $thumb ) {
        echo wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
      } else {
        echo esc_html__('None','pinecone');
      }
    }
  }

  add_filter( 'manage_posts_columns', 'AddThumbColumn' );
  add_action( 'manage_posts_custom_column', 'AddThumbValue', 10, 2 );

  add_filter( 'manage_pages_columns', 'AddThumbColumn' );
  add_action( 'manage_pages_custom_column', 'AddThumbValue', 10, 2 );
}

add_filter( 'the_category', 'add_nofollow_cat' );

function add_nofollow_cat( $text) {
  $strings = array('rel="category"', 'rel="category tag"', 'rel="whatever may need"');
  $text = str_replace('rel="category tag"', "", $text);
  return $text;
}

function filter_next_post_link($link) {
  $link = str_replace("rel=", 'class="next" rel=', $link);
  return $link;
}

add_filter('next_post_link', 'filter_next_post_link');

function filter_previous_post_link($link) {
  $link = str_replace("rel=", 'class="prev" rel=', $link);
  return $link;
}

add_filter('previous_post_link', 'filter_previous_post_link');

?>
