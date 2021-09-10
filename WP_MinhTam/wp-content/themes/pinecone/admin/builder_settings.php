<?php
/*
Simple Page Builder - deBuilder v 3.0
http://themeforest.net/user/mallini
*/

$structure = array(

  array(
    'type'			=> 'Text',
    'title'			=> esc_attr__('Text', 'coffeebean'),
    'fields'    => array(
      array(
        'name'   		=> 'build_text',
        'label'   	=> esc_attr__('Text', 'coffeebean'),
        'type'   		=> 'textarea'
      ),
      array(
        'name'   		=> 'build_text_column',
        'label'   	=> esc_attr__('Text columns count', 'coffeebean'),
        'options'   => '1,2',
        'type'   		=> 'select'
      ),
      array(
        'name'   		=> 'build_text_font_size',
        'label'  		=> esc_attr__('Font size', 'coffeebean'),
        'type'   		=> 'select'
      ),
      array(
        'name'   		=> 'build_text_line_height',
        'label'  		=> esc_attr__('Line height', 'coffeebean'),
        'type'   		=> 'select'
      ),
      array(
        'name'   		=> 'build_text_color',
        'label'  		=> esc_attr__('Font Color', 'coffeebean'),
        'type'   		=> 'colorpicker'
      ),
      array(
        'name'   		=> 'build_text_background',
        'label'  		=> esc_attr__('Background Color', 'coffeebean'),
        'type'   		=> 'colorpicker'
      ),
      array(
        'name'   		=> 'build_text_padding',
        'label'  		=> esc_attr__('Padding', 'coffeebean'),
        'type'   		=> 'number'
      )
    )
  ),

  array(
    'type'			=> 'Gallery',
    'title'			=> esc_attr__('Gallery', 'coffeebean'),
    'fields'    => array(
      array(
        'name'   		=> 'build_gallery_type',
        'label'			=> esc_attr__('Gallery Type', 'coffeebean'),
        'options'   => 'Slider,Tiled,Masonry',
        'type'   		=> 'select'
      ),
      array(
        'name'   		=> 'build_gallery_images',
        'label' 		=> esc_attr__('Gallery images', 'coffeebean'),
        'type'   		=> 'gallery'
      ),
      array(
        'name'   		=> 'build_gallery_fullwidth',
        'label'  		=> 'Full width',
        'options'  	=> 'Yes,No',
        'type'   		=> 'select'
      ),/*
      array(
        'name'   		=> 'build_gallery_background',
        'label'  		=> 'Background Color',
        'type'   		=> 'colorpicker'
      ),*/
      array(
        'name'   		=> 'build_gallery_padding',
        'label'  		=> esc_attr__('Padding', 'coffeebean'),
        'type'   		=> 'number'
      )
    )
  ),

  array(
    'type'			=> 'Video',
    'title'			=> esc_attr__('Video', 'coffeebean'),
    'fields'    => array(
      array(
        'name'   		=> 'build_video_selfhosted',
        'label'			=> esc_attr__('Selfhosted video', 'coffeebean'),
        'type'   		=> 'media'
      ),
      array(
        'name'   		=> 'build_video_external',
        'label' 		=> esc_attr__('Vimeo or Youtube video link', 'coffeebean'),
        'type'   		=> 'text'
      ),
      array(
        'name'   		=> 'build_video_fullwidth',
        'label'  		=> 'Full width',
        'options'  	=> 'Yes,No',
        'type'   		=> 'select'
      ),/*
      array(
        'name'   		=> 'build_video_background',
        'label'  		=> 'Background Color',
        'type'   		=> 'colorpicker'
      ),*/
      array(
        'name'   		=> 'build_video_padding',
        'label'  		=> esc_attr__('Padding', 'coffeebean'),
        'type'   		=> 'number'
      )
    )
  )
);

$translate = array(
  'button_save'  		=> esc_attr__('Save', 'coffeebean'),
  'button_saving'  		=> esc_attr__('Saving', 'coffeebean'),
  'button_saveandclose'  	=> esc_attr__('Save & Close', 'coffeebean'),
  'button_showeditor'  		=> esc_attr__('Show Visual Editor', 'coffeebean'),
  'button_hideeditor'  		=> esc_attr__('Hide Visual Editor', 'coffeebean')
);
