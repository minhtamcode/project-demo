<?php
/**
 * Initialize the meta boxes.
 */
add_action( 'admin_init', '_custom_meta_boxes' );

/**
 * Meta Boxes code.
 *
 * You can find all the available option types
 * in demo-theme-options.php.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */

function _custom_meta_boxes() {

  $my_meta_box = array(
    'id'        => 'metabox_sidebar',
    'title'     => esc_html__('Layout settings', 'pinecone'),
    'desc'      => '',
    'pages'     => array( 'post','page' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

    	array(
    		'label'       => esc_html__('Show page sidebar', 'pinecone'),
    		'id'          => 'sidebar_on',
    		'type'        => 'on_off',
    		'desc'        => '',
    		'std'         => 'on',
      ),

      array(
        'id'          => 'sidebar_layout',
        'label'       => esc_html__('Sidebar side', 'pinecone'),
        'desc'        => '',
        'std'         => 'right-sidebar',
        'type'        => 'radio',
        'class'       => '',
        'choices'     => array(
          array(
            'value'   => 'left-sidebar',
            'label'   => esc_html__('Left Sidebar', 'pinecone')
          ),
          array(
            'value'   => 'right-sidebar',
            'label'   => esc_html__('Right Sidebar', 'pinecone')
          )
        )
      )
    )
  );


  $my_meta_box3 = array(
    'id'        => 'page_settings',
    'title'     => esc_html__('Page settings', 'pinecone'),
    'desc'      => '',
    'pages'     => array('page','portfolio'),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      array(
      	'label'       => esc_html__('Display title', 'pinecone'),
      	'id'          => 'display_title',
      	'type'        => 'on_off',
      	'desc'        => 'Show title on page',
      	'std'         => 'on'
      )
  	)
  );

  $meta_box_gallery = array(
    'id'        => 'gallery_options',
    'title'     => esc_html__('Gallery & Video options', 'pinecone'),
    'desc'      => '',
    'pages'     => array('portfolio', 'post'),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      array(
      	'label'       => esc_html__('Gallery', 'pinecone'),
      	'id'          => 'pinecone_gallery1',
      	'type'        => 'tab',
      	'desc'        => '',
      	'std'         => '',
      ),

      array(
        'id'          => 'gallery_layout',
        'label'       => esc_html__('Gallery style', 'pinecone'),
        'desc'        => '',
        'std'         => 'slider-gallery',
        'type'        => 'radio',
        'class'       => '',
        'choices'     => array(
          array(
            'value'   => 'slider-gallery',
            'label'   => esc_html__('Slider Gallery', 'pinecone')
          ),
          array(
            'value'   => 'tiled-gallery',
            'label'   => esc_html__('Tiled Gallery', 'pinecone')
          ),
          array(
            'value'   => 'masonry-gallery',
            'label'   => esc_html__('Masonry Gallery', 'pinecone')
          )
        )
      ),

      array(
        'id'          => 'masonry_gallery_layout',
        'label'       => esc_html__('Masonry Gallery settings', 'pinecone'),
        'desc'        => '',
        'std'         => 'four-columns',
        'type'        => 'radio',
        'class'       => '',
        'choices'     => array(
          array(
            'value'   => 'four-columns',
            'label'   => esc_html__('Four columns', 'pinecone')
          ),
          array(
            'value'   => 'three-columns',
            'label'   => esc_html__('Three columns', 'pinecone')
          )
        )
      ),

      array(
        'label' => esc_html__('Gallery images', 'pinecone'),
        'id' => 'gallery_slider',
        'type' => 'gallery',
        'desc' => '',
        'post_type' => 'post'
      ),

      array(
        'label' => esc_html__('Image Options', 'pinecone'),
        'id' => 'disable_resize',
        'type' => 'checkbox',
		    'std'         => '',
        'desc' => esc_html__('Available only for Portfolio project', 'pinecone'),
        'post_type' => 'portfolio',
		    'choices'     => array(
          array(
            'value'   => 'disable',
            'label'   => esc_html__('Disable Resize in Slider', 'pinecone')
          ),
		      array(
            'value'   => 'show',
            'label'   => esc_html__('Show Featured Image or Video (Lightbox) on Click in Portfolio', 'pinecone')
          ),
          array(
            'value'   => 'featured_img',
            'label'   => esc_html__('Do not show Featured image in post page', 'pinecone')
          ),
          array(
            'value'   => 'disable_url',
            'label'   => esc_html__('Disable link', 'pinecone')
          )
        )
	    ),

      array(
      	'label'       => esc_html__('Custom Project URL & Video', 'pinecone'),
      	'id'          => 'pinecone_gallery2',
      	'type'        => 'tab',
        'class'       => 'not-in-post',
      ),

      array(
        'id'          => 'custom_url',
        'label'       => esc_html__('Custom URL', 'pinecone'),
        'desc'        => esc_html__('Available only with checkbox "Show Featured Image or Video"', 'pinecone'),
        'std'         => '',
        'type'        => 'text',
        'class'       => 'not-in-post',
      ),

      array(
        'id'          => 'custom_url_video',
        'label'       => esc_html__('Video URL (for popup videos)', 'pinecone'),
        'desc'        => esc_html__('Available only with checkbox "Show Featured Image or Video"', 'pinecone'),
        'std'         => '',
        'type'        => 'text',
        'class'       => 'not-in-post',
      ),

      array(
      	'label'       => esc_html__('Recent Projects filters', 'pinecone'),
      	'id'          => 'pinecone_gallery3',
      	'type'        => 'tab',
        'class'       => 'not-in-post',
      ),

      array(
        'label' => esc_html__('Recent Projects filters to display', 'pinecone'),
        'id' => 'recent_portfolio_filters',
        'type' => 'taxonomy-checkbox',
        'taxonomy'  => 'filters',
        'desc'      => esc_html__('for Portfolio items only', 'pinecone'),
        'class'       => 'not-in-post',
      )
    )
  );

  $meta_box_filters = array(
    'id'        => 'portfolio_tax',
    'title'     => esc_html__('Portfolio page options', 'pinecone'),
    'desc'      => esc_html__('If you choose page Template as "Portfolio" you can use options here', 'pinecone'),
    'pages'     => array('page'),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      array(
        'label' => esc_html__('Select portfolio categories to display on this page', 'pinecone'),
        'id' => 'portfolio_filters',
        'type' => 'taxonomy-checkbox',
        'desc' => esc_html__('Dispays all categories if not selected.', 'pinecone'),
        'std' => '',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => 'filters',
        'class' => 'filters-checbox'
      ),

      array(
        'id'          => 'filters_on',
        'label'       => esc_html__('Show filters', 'pinecone'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on_off',
        'class'       => '',
        'choices' => array(

          array(
            'label' => esc_html__('Yes', 'pinecone'),
            'value' => 'yes'
          ),
          array(
            'label' => esc_html__('No', 'pinecone'),
            'value' => 'no'
          )
        )
      )
    )
  );

  $video_box = array(
    'id'        => 'metabox_video',
    'title'     => esc_html__('Post video link', 'pinecone'),
    'desc'      => '',
    'pages'     => array( 'post' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

	    array(
        'id'          => 'video_link',
        'label'       => esc_html__('Link to video (Youtube or Vimeo)', 'pinecone'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => ''
      )
    )
  );

  $recent_pf_options = array(
    'id'        => 'recent_pf_options',
    'title'     => esc_html__('Recent Works Options', 'pinecone'),
    'desc'      => '',
    'pages'     => array('portfolio'),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      array(
        'label' => esc_html__('Recent Works section settings', 'pinecone'),
        'id' => 'recent_pofrfolio_textblock',
        'type' => 'textblock',
        'desc' => esc_html__('Under the portfolio post content you can see "Recent Works" section, by default displays 4 latest portfolio posts, here you can configure it to show selected items or filters.', 'pinecone'),
        'post_type' => 'post',
      ),

      array(
        'label' => esc_html__('Recent Works filters to display', 'pinecone'),
        'id' => 'recent_portfolio_filters',
        'type' => 'taxonomy-checkbox',
        'taxonomy'  => 'filters',
      )
    )
  );

  ot_register_meta_box( $my_meta_box );
  ot_register_meta_box( $meta_box_filters );
  ot_register_meta_box( $my_meta_box3 );
  ot_register_meta_box( $meta_box_gallery );
  //ot_register_meta_box( $recent_pf_options );
  ot_register_meta_box( $video_box );

}
