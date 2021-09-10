<?php
/*
Simple Page Builder - deBuilder v 2.1
http://themeforest.net/user/mallini
*/

function builder_output( $xml = false, $get_element = false ) {

  $output = $content = $imagesUrl = '';
  $data = $var = array();

  foreach ($xml->item as $element) {

    switch($element['type']) {
      case 'Text':

        $var = getVar($element);

        $var['build_text_padding'] = ($var['build_text_padding']) ? $var['build_text_padding'] . 'px 0' : '0 0 30px 0';

        $output .= '<div class="shortcode-gallery" style="background:'. $var['build_text_background'] .'; padding:'. $var['build_text_padding'] .';"><div class="shortcode-gallery-inner builder_p">';

        $content = ($var['build_text_column'] > 1) ? str_replace('p>', 'span>', $var['build_text']) : explode('</p>', $var['build_text']);

        if ($var['build_text_column'] > 1) {
          $output .= '<div class="double-column" style="font-size:'. $var['build_text_font_size'] .'px; line-height:'. $var['build_text_line_height'] .'px; color:'. $var['build_text_color'] .';">'. $content .'</div>';
        } else {
          foreach ($content as $paragraph) {
            $paragraph = str_replace('<p>', '', $paragraph);
            if ( 'Select' != $var['build_text_font_size'] || 'Select' != $var['build_text_line_height'] || $var['build_text_color'] ) {
              $output .= '<div style="';
              $output .= ( 'Select' != $var['build_text_font_size'] ) ? ' font-size:'. $var['build_text_font_size'] .'px;' : '';
              $output .= ( 'Select' != $var['build_text_line_height'] ) ? 'line-height:'. $var['build_text_line_height'] .'px;' : '';
              $output .= ($var['build_text_color'] ) ? ' color:'. $var['build_text_color'] .';' : '';
              $output .= '">'. $paragraph .'</div>';
            } else {
              $output .= $paragraph;
            }
          }
        }

        $output .= '</div></div>';

      break;

      case 'Gallery':

        $var = getVar($element);

        $images_array = explode(",", $var['build_gallery_images']);
        $full = (isset($var['build_gallery_fullwidth']) && $var['build_gallery_fullwidth'] == 'Yes') ? '-full' : '' ;
        $var['build_gallery_type'] = ($var['build_gallery_type'] != '— Select —') ? $var['build_gallery_type'] : 'Slider';
        $imagesUrl .= $element['id'];

        $var['build_gallery_padding'] = ($var['build_gallery_padding']) ? $var['build_gallery_padding'] . 'px 0' : '0 0 40px 0';

        if ($var['build_gallery_type'] == 'Tiled') {

          $output .= '<div class="shortcode-gallery'. $full .'" style="background:'. /*$var['build_gallery_background'] .*/'; padding:'. $var['build_gallery_padding'] .';"><div class="shortcode-gallery-inner"><div class="justified-gallery-container"><div class="justified-gallery">';

          foreach ($images_array as $imageID) {
            if ($imageID != '') {
              $image = wp_get_attachment_image_src($imageID, 'full');
              $image_thumb = wp_get_attachment_image_src($imageID, 'thumbnail');
              $imagesUrl .= ',' . $image_thumb[0];

              $img_alt = (ot_get_option('fancybox_title') != 'off') ? esc_html(wp_get_attachment_caption($imageID)) : '';
              $output .= '<a class="slick-slide" href="'.esc_url($image[0]).'" rel="lightbox" id="group"><img src="'. esc_url($image[0]).'" alt="' . esc_html($img_alt) . '" title="' . esc_html(get_the_title($imageID)) . '" /></a>';
            }
          }

          $output .= '</div></div></div></div>';
          $imagesUrl .= '|';

        } elseif ($var['build_gallery_type'] == 'Slider') {

          $galleryID = rand (1, 99);
          $output .= '<div class="shortcode-gallery'. $full .'" style="background:'. /*$var['build_gallery_background'] .*/'; padding:'. $var['build_gallery_padding'] .';"><div class="shortcode-gallery-inner"><div class="owl-carousel owl-'.$galleryID.' owl-theme">';

          foreach($images_array as $imageID) {
            if ($imageID != '') {
              $image = wp_get_attachment_image_src($imageID, 'full');
              $image_thumb = wp_get_attachment_image_src($imageID, 'thumbnail');
              $imagesUrl .= ',' . $image_thumb[0];
              list($width, $height) = getimagesize($image[0]);
              $ratio = ($height) ? $width/$height : '';

              $img_alt = (ot_get_option('fancybox_title') != 'off') ? esc_html(wp_get_attachment_caption($imageID)) : '';
              $output .= '<a class="slick-slide" href="'.esc_url($image[0]).'" rel="lightbox" id="group"><img src="'.esc_url($image[0]).'" data-ratio="'.esc_html($ratio).'" alt="' . esc_html($img_alt) . '" title="' . esc_html(get_the_title($imageID)) . '" /></a>';
            }
          }

          $output .= '</div></div></div>';
          $imagesUrl .= '|';

        } else {

          $galleryID = rand (1, 999);
          $output .= '<div class="shortcode-gallery'. $full .'"><div class="shortcode-gallery-inner"><div id="portfolio-gallery-wrapper'. $galleryID .'" style="padding:'. $var['build_gallery_padding'] .'px 0;">';

          foreach ($images_array as $imageID) {
            if ($imageID != '') {
              $image = wp_get_attachment_image_src($imageID, 'full');
              $image_thumb = wp_get_attachment_image_src($imageID, 'thumbnail');
              $imagesUrl .= ',' . $image_thumb[0];
              if (isset($image[0])) {
                list($width, $height) = getimagesize($image[0]);
              }
              $ratio = ($height) ? $width/$height : '';

              $img_alt = (ot_get_option('fancybox_title') != 'off') ? esc_html(wp_get_attachment_caption($imageID)) : '';
      				$output .= '<div class="third-masonry portfolio-gallery-item'. $galleryID .' data-ratio="'. $ratio .'">
      					<a href="'.esc_url($image[0]).'" rel="lightbox" id="group"><img src="'.esc_url($image[0]).'" alt="' . esc_html($img_alt) . '" title="' . esc_html(get_the_title($imageID)) . '" />
      					</a></div>';
            }
      		}

      		$output .= '</div></div></div>';
          $imagesUrl .= '|';

      		$output .= "<script type=\"text/javascript\">
      			( function( $ ) {
      				$(document).ready(function() {
                getMasonryHeight". $galleryID ."();
                getMasonryGallery". $galleryID ."();
      				});

      				$(window).resize(function(){
                getMasonryHeight". $galleryID ."();
                //getMasonryGallery". $galleryID ."();
      				});

      				function getMasonryHeight". $galleryID ."() {
      					$('.portfolio-gallery-item". $galleryID ."').each( function() {
      						var ratio = $( this ).attr( 'data-ratio' );
      						var img_width = $( this ).width();

      						if ( ratio > 1 ) {
      							var div_height = img_width / ratio;
      						} else {
      							var div_height = img_width / ratio;
      						}

      						$( this ).css( { 'height': Math.floor( div_height ) } );
      					});
      				}

              function getMasonryGallery". $galleryID ."() {
                $('#portfolio-gallery-wrapper". $galleryID ."').imagesLoaded().always(function() {
                  $('#portfolio-gallery-wrapper". $galleryID ."').masonry( {
                    itemSelector: '.portfolio-gallery-item". $galleryID ."'
                  });
                });
              }

      			} )( jQuery );
      		</script>
          <style>
            #portfolio-gallery-wrapper". $galleryID ." {
              margin-bottom: 45px;
              overflow: hidden;
            }
          </style>";

        }

      break;

      case 'Video':

        $var = getVar($element);

        $full = (isset($var['build_video_fullwidth']) && $var['build_video_fullwidth'] == 'Yes') ? '-full' : '' ;
        $var['build_video_padding'] = ($var['build_video_padding']) ? $var['build_video_padding'] . 'px 0' : '0 0 40px 0';

        $output .= '<div class="content-self-container'. $full .'" style="background:'. /*$var['build_video_background'] .*/'; padding:'. $var['build_video_padding'] .';"><div class="self-container-inner">';

        if ($var['build_video_external']) {

          global $wp_embed;
          $output .= '<div class="post_thumb hentry"><div class="embed video-cont">'. $wp_embed->run_shortcode('[embed width="600" height="360"]' . esc_url($var['build_video_external']) . '[/embed]') .'</div></div>';

        } else {

          $uploads = wp_upload_dir();
          $uploads_dir =  $uploads['basedir'];
          $video_upload = $var['build_video_selfhosted'];
          $uploads_dir = $uploads_dir . str_replace("uploads", "", strstr($video_upload,"uploads"));
          $videodata = wp_read_video_metadata($uploads_dir);
          $video_ratio = isset($videodata['height']) ? $videodata['width']/$videodata['height'] : '';
          $videodata_width = isset($videodata['width']) ?: '';
          $videodata_height = isset($videodata['height']) ?: '';

          $output .= '<video class="content-video" data-video-ratio="' . $video_ratio .'" data-width="'. $videodata_width.'" data-height="'. $videodata_height .'" preload="auto" loop autoplay><source type="video/mp4" src="'. $video_upload .'"></video>';

        }

        $output .= '</div></div>';

      break;

    }

  }

  if ($get_element == 'Gallery') { echo $imagesUrl; } else { echo $output; }
}
