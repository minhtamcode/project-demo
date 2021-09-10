<?php

/**
 * Initialize the options before anything else.
 */
add_action( 'admin_init', '_custom_theme_options', 1 );

/**
 * Theme Mode demo code of all the available option types.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function _custom_theme_options() {

  $layers = array();
  global $wpdb;
  // Table name

  /**
   * Get a copy of the saved settings array.
   */
  $saved_settings = get_option( 'option_tree_settings', array() );

  /**
   * Create a custom settings array that we pass to
   * the OptionTree Settings API Class.
   */
  $custom_settings = array(
   'contextual_help' => array(
      'content'       => array(
        array(
          'id'        => 'general_help',
          'title'     => esc_html__('General', 'pinecone'),
          'content'   => esc_html__('Help content goes here!', 'pinecone')
          )
        ),
      'sidebar'       => esc_html__('Sidebar content goes here!', 'pinecone')
      ),
    'sections'        => array(

      array(
        'title'       => esc_html__('Header', 'pinecone'),
        'id'          => 'header'
      ),

      array(
        'title'       => esc_html__('Blog options', 'pinecone'),
        'id'          => 'blog'
      ),

      array(
        'title'       => esc_html__('Portfolio options', 'pinecone'),
        'id'          => 'portfolio'
      ),

      array(
        'id'          => 'typo',
        'title'       => esc_html__('Typography & Colors', 'pinecone')
      ),

		  array(
        'title'       => esc_html__('General Options', 'pinecone'),
        'id'          => 'general'
      )
    ),

    'settings'        => array(

  array(
    'label'       => esc_html__('Header logo', 'pinecone'),
    'id'          => 'logo_upload',
    'type'        => 'upload',
    'desc'        => esc_html__('Better use transparent png', 'pinecone'),
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'header'
  ),

  array(
    'label'       => esc_html__('Logo text', 'pinecone'),
    'id'          => 'logo_text',
    'type'        => 'text',
    'desc'        => esc_html__('Text in Logo', 'pinecone'),
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'header'
  ),

  array(
    'label'       => esc_html__('Enable logo animation on hover', 'pinecone'),
    'id'          => 'logo_rotate',
    'type'        => 'on_off',
    'desc'        => '',
    'std'         => 'off',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'header'
  ),

  array(
    'label'       => esc_html__('Favicon ', 'pinecone'),
    'id'          => 'favicon_upload',
    'type'        => 'upload',
    'desc'        => esc_html__('Upload favicon here - PNG or ICO 16x16px', 'pinecone'),
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'header'
  ),

  array(
    'label'       => esc_html__('Logo top margin', 'pinecone'),
    'id'          => 'logo_top_margin',
    'type'        => 'text',
    'desc'        => esc_html__('px', 'pinecone'),
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'header'
  ),

  array(
    'label'       => esc_html__('Logo bottom margin', 'pinecone'),
    'id'          => 'logo_bottom_margin',
    'type'        => 'text',
    'desc'        => esc_html__('px', 'pinecone'),
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'header'
  ),

  array(
    'label'       => esc_html__('Logo width', 'pinecone'),
    'id'          => 'logo_width',
    'type'        => 'text',
    'desc'        => esc_html__('px', 'pinecone'),
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'header'
  ),

  array(
    'label'       => esc_html__('Enable Header Menu', 'pinecone'),
    'id'          => 'enable_mainmenu',
    'type'        => 'on_off',
    'desc'        => '',
    'std'         => 'on',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'header'
  ),

  array(
    'label'       => esc_html__('Submenu width in Header menu', 'pinecone'),
    'id'          => 'submenu_width',
    'type'        => 'numeric-slider',
    'desc'        => '',
    'std'         => '190',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'min_max_step'=> '100,400,10',
    'section'     => 'header'
  ),

  array(
    'label'       => esc_html__('Super Header Backgound', 'pinecone'),
    'id'          => 'contacts_bg',
    'type'        => 'upload',
    'desc'        => esc_html__('Backgound image in header contacts overlay', 'pinecone'),
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'header'
  ),

	array(
    'label'       => esc_html__('Super Footer Backgound', 'pinecone'),
    'id'          => 'footer_bg',
    'type'        => 'upload',
    'desc'        => esc_html__('Backgound image in footer overlay', 'pinecone'),
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'header'
  ),

  array(
    'label'       => esc_html__('Blog main page', 'pinecone'),
    'id'          => 'blog_main_page',
    'type'        => 'page-select',
    'desc'        => '',
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'blog'
  ),

  array(
    'label'       => esc_html__('Blog page title', 'pinecone'),
    'id'          => 'blog_title',
    'type'        => 'text',
    'desc'        => '',
    'std'         => 'Blog',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'blog'
  ),

  array(
    'label'       => esc_html__('Blog layout', 'pinecone'),
    'id'          => 'blog_layout',
    'type'        => 'radio',
    'desc'        => esc_html__('Choose sidebar side on blog.', 'pinecone'),
    'std'         => 'no-sidebar',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'choices'     => array(
      array(
        'value'   => 'left-sidebar',
        'label'   => esc_html__('Left Sidebar', 'pinecone'),
      ),
      array(
        'value'   => 'right-sidebar',
        'label'   => esc_html__('Right Sidebar', 'pinecone'),
      ),
		  array(
        'value'   => 'no-sidebar',
        'label'   => esc_html__('No Sidebar', 'pinecone'),
      )
    ),
    'class'       => '',
    'section'     => 'blog'
  ),

  array(
    'label'       => esc_html__('Blog Page post words trim', 'pinecone'),
    'id'          => 'blog_trim',
    'type'        => 'select',
    'desc'        => 'Standard is 60. Note! Full option show all content text with formatting, it can damage blog layout',
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'blog',
    'choices'     => array(
      array(
        'label'       => '10',
        'value'       => '10'
      ),
      array(
        'label'       => '20',
        'value'       => '20'
      ),
      array(
        'label'       => '40',
        'value'       => '40'
      ),
      array(
        'label'       => '60',
        'value'       => '60'
      ),
      array(
        'label'       => '80',
        'value'       => '80'
      ),
      array(
        'label'       => '100',
        'value'       => '100'
      ),
      array(
        'label'       => '150',
        'value'       => '150'
      ),
      array(
        'label'       => '200',
        'value'       => '200'
      ),
      array(
        'label'       => '300',
        'value'       => '300'
      ),
      array(
        'label'       => 'Full',
        'value'       => 'full'
      ),
    ),
  ),

  array(
    'id'          => 'show_recent',
    'label'       => esc_html__('Relates Posts', 'pinecone'),
    'desc'        => '',
    'std'         => 'on',
    'section'     => 'blog',
    'type'        => 'on_off',
    'desc'        => esc_html__('Enable/disable related posts on blog single page', 'pinecone'),
  ),

  array(
    'id'          => 'hide_comments',
    'label'       => esc_html__('Hide comments for all posts', 'pinecone'),
    'desc'        => '',
    'std'         => 'no',
    'section'     => 'blog',
    'type'        => 'select',
    'desc'        => esc_html__('Enable/disable comments on blog pages', 'pinecone'),
    'choices'     => array(
      array(
        'label'       => 'No',
        'value'       => 'no'
        ),
      array(
        'label'       => 'Yes',
        'value'       => 'yes'
        )
    ),
  ),

  array(
    'id'          => 'blog_share',
    'label'       => esc_html__('Share buttons in post page', 'pinecone'),
    'desc'        => '',
    'std'         => '',
    'section'     => 'blog',
    'type'        => 'checkbox',
    'desc'        => '',
    'choices'     => array(
      array(
        'label'       => 'Twitter',
        'value'       => 'twitter'
        ),
      array(
        'label'       => 'Facebook',
        'value'       => 'facebook'
      ),
      array(
        'label'       => 'Google+',
        'value'       => 'google'
      ),
      array(
        'label'       => 'Pinterest',
        'value'       => 'pinterest'
      ),
      array(
        'label'       => 'LinkedIn',
        'value'       => 'linkedin'
      )
    )
  ),

  array(
    'label'       => esc_html__('Share buttons title', 'pinecone'),
    'id'          => 'blog_share_title',
    'type'        => 'text',
    'desc'        => esc_html__('Example: Share this post', 'pinecone'),
    'std'         => '',
    'section'     => 'blog'
  ),

  array(
    'label'       => esc_html__('Portfolio main page', 'pinecone'),
    'id'          => 'portfolio_main_page',
    'type'        => 'page-select',
    'desc'        => '',
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'portfolio'
  ),

  array(
    'label'       => esc_html__('Portfolio items sorting', 'pinecone'),
    'id'          => 'portfolio_sorting',
    'type'        => 'select',
    'desc'        => esc_html__('Choose order of items on portfolio page', 'pinecone'),
    'choices'     => array(
      array('label'=> esc_html__('Default (by Date)', 'pinecone'),'value'=> 'date'),
      array('label'=> esc_html__('by Title', 'pinecone'),'value'=> 'title'),
      array('label'=> esc_html__('by Name (slug)', 'pinecone'),'value'=> 'name'),
      array('label'=> esc_html__('Random', 'pinecone'),'value'=> 'rand')
    ),
    'std'         => 'date',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'portfolio'
  ),

  array(
    'label'       => esc_html__('Portfolio number of items to display', 'pinecone'),
    'id'          => 'portfolio_showpost',
    'type'        => 'select',
    'desc'        => esc_html__('Choose how many items to display on portfolio page', 'pinecone'),
    'choices'     => array(
      array('label'=> '6','value'=> '6'),
      array('label'=> '7','value'=> '7'),
      array('label'=> '8','value'=> '8'),
      array('label'=> '9','value'=> '9'),
      array('label'=> '10','value'=> '10'),
      array('label'=> '11','value'=> '11'),
      array('label'=> '12','value'=> '12'),
      array('label'=> '13','value'=> '13'),
      array('label'=> '14','value'=> '14'),
      array('label'=> '15','value'=> '15'),
      array('label'=> '16','value'=> '16'),
      array('label'=> '32','value'=> '32'),
      array('label'=> 'All','value'=> '999')
      ),
    'std'         => '12',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'portfolio'
  ),

  array(
    'label'       => esc_html__('Portfolio navigation on single Page', 'pinecone'),
    'id'          => 'display_portfolio_nav',
    'type'        => 'on_off',
    'desc'        => '',
    'std'         => 'on',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'portfolio'
    ),

  array(
    'label'       => esc_html__('Recent Projects on single Page', 'pinecone'),
    'id'          => 'recent_portfolio',
    'type'        => 'on_off',
    'desc'        => '',
    'std'         => 'on',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'portfolio'
  ),

  array(
    'label'       => esc_html__('Recent Projects as small thumbnails', 'pinecone'),
    'id'          => 'recent_thumbs',
    'type'        => 'on_off',
    'desc'        => '',
    'std'         => 'off',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'portfolio'
  ),

  array(
    'label'       => esc_html__('Recent Projects title', 'pinecone'),
    'id'          => 'recent_portfolio_text',
    'type'        => 'text',
    'desc'        => esc_html__('Title of recent work secion on single portfolio view', 'pinecone'),
    'std'         => 'Recent Projects',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'portfolio'
  ),

  array(
    'label'       => esc_html__('Portfolio Recent Projects number of items to display', 'pinecone'),
    'id'          => 'recent_showpost',
    'type'        => 'select',
    'desc'        => esc_html__('Choose how many Recent items to display on portfolio page', 'pinecone'),
    'choices'     => array(
      array('label'=> '4','value'=> '4'),
      array('label'=> '8','value'=> '8'),
      array('label'=> '12','value'=> '12'),
      array('label'=> '16','value'=> '16'),
  	  array('label'=> '24','value'=> '24'),
      array('label'=> '32','value'=> '32'),
  	  array('label'=> '48','value'=> '48')
      ),
    'std'         => '32',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'portfolio'
  ),

  array(
    'label'       => esc_html__('Recent Projects Full Width', 'pinecone'),
    'id'          => 'recent_fullwidth',
    'type'        => 'on_off',
    'desc'        => '',
    'std'         => 'on',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'portfolio'
  ),

  array(
    'label'       => esc_html__('Portfolio Recent Projects Columns Number', 'pinecone'),
    'id'          => 'recent_columns',
    'type'        => 'select',
    'choices'     => array(
      array('label'=> '4','value'=> '4'),
      array('label'=> '3','value'=> '3'),
      array('label'=> '2','value'=> '2')
      ),
    'std'         => '4',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'portfolio'
  ),

  array(
   'label'       => esc_html__('Infinite scroll', 'pinecone'),
   'id'          => 'infinite_off',
   'type'        => 'on_off',
   'desc'        => '',
   'std'         => 'on',
   'class'       => '',
   'section'     => 'portfolio'
  ),

  array(
   'label'       => esc_html__('Enable Loadmore animation image', 'pinecone'),
   'id'          => 'portfolio_loadmore_animation',
   'type'        => 'on_off',
   'desc'        => '',
   'std'         => 'on',
   'class'       => '',
   'section'     => 'portfolio'
  ),

 array(
   'id'          => 'portfolio_share',
   'label'       => esc_html__('Share buttons in portfolio page', 'pinecone'),
   'desc'        => '',
   'std'         => '',
   'section'     => 'portfolio',
   'type'        => 'checkbox',
   'desc'        => '',
   'choices'     => array(
     array(
       'label'       => 'Twitter',
       'value'       => 'twitter'
       ),
     array(
       'label'       => 'Facebook',
       'value'       => 'facebook'
     ),
     array(
       'label'       => 'Google+',
       'value'       => 'google'
     ),
     array(
       'label'       => 'Pinterest',
       'value'       => 'pinterest'
     ),
     array(
       'label'       => 'LinkedIn',
       'value'       => 'linkedin'
     )
   )
 ),

 array(
   'label'       => esc_html__('Share buttons title', 'pinecone'),
   'id'          => 'portfolio_share_title',
   'type'        => 'text',
   'desc'        => esc_html__('Example: Share this project', 'pinecone'),
   'std'         => '',
   'section'     => 'portfolio'
  ),

  array(
    'label'       => esc_html__('Page preloader', 'pinecone'),
    'id'          => 'preloader_on',
    'type'        => 'on_off',
    'desc'        => '',
    'std'         => 'off',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'general'
  ),

  array(
    'label'       => esc_html__('Lightbox caption', 'pinecone'),
    'id'          => 'fancybox_title',
    'type'        => 'on_off',
    'desc'        => '',
    'std'         => 'on',
    'class'       => '',
    'section'     => 'general'
  ),

  array(
    'label'       => esc_html__('Super Header', 'pinecone'),
    'id'          => 'super_header',
    'type'        => 'on_off',
    'desc'        => '',
    'std'         => 'on',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'general'
  ),

  array(
    'label'       => esc_html__('Super Footer', 'pinecone'),
    'id'          => 'super_footer',
    'type'        => 'on_off',
    'desc'        => '',
    'std'         => 'on',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'general'
  ),

  array(
    'label'       => esc_html__('Super Footer always open', 'pinecone'),
    'id'          => 'show_footer',
    'type'        => 'on_off',
    'desc'        => '',
    'std'         => 'off',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'general'
  ),

  array(
    'id'          => 'custom_css',
    'label'       => esc_html__('Custom CSS', 'pinecone'),
    'desc'        => esc_html__('To prevent problems with theme update write here custom CSS code', 'pinecone'),
    'std'         => '',
    'type'        => 'css',
    'section'     => 'general',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
  ),

  /*array(
   'id'          => 'google_analytics',
   'label'       => esc_html__('Analytics code', 'pinecone'),
   'desc'        => esc_html__('Put here your Analytics script code or Java Script', 'pinecone'),
   'std'         => '',
   'type'        => 'javascript',
   'section'     => 'general',
   'rows'        => '',
   'post_type'   => '',
   'taxonomy'    => '',
   'class'       => ''
 ),*/

  array(
    'id'          => 'google_fonts',
    'label'       => esc_html__('Google Fonts', 'pinecone'),
    'desc'        => '',
    'std'         => '',
    'type'        => 'google-fonts',
    'section'     => 'typo',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'min_max_step'=> '',
    'class'       => '',
    'condition'   => '',
    'operator'    => 'and'
  ),

  array(
    'label'       => esc_html__('Background Color', 'pinecone'),
    'id'          => 'mainbg_color',
    'type'        => 'colorpicker',
    'desc'        => '',
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'typo'
  ),

  array(
    'label'       => esc_html__('Main and Links Color', 'pinecone'),
    'id'          => 'links_color',
    'type'        => 'colorpicker',
    'desc'        => '',
    'std'         => '#8abeb2',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'typo'
  ),

  array(
    'label'       => esc_html__('Body Font', 'pinecone'),
    'id'          => 'body_font',
    'type'        => 'typography',
    'desc'        => '',
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'typo'
  ),

  array(
    'label'       => esc_html__('Menu Font', 'pinecone'),
    'id'          => 'menu_font',
    'type'        => 'typography',
    'desc'        => '',
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'typo'
  ),

  array(
    'label'       => esc_html__('Logo Font', 'pinecone'),
    'id'          => 'logo_font',
    'type'        => 'typography',
    'desc'        => '',
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'typo'
  ),

  array(
    'label'       => esc_html__('H1 Headers Font', 'pinecone'),
    'id'          => 'h1_font',
    'type'        => 'typography',
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'typo'
  ),

  array(
    'label'       => esc_html__('H2 Headers Font', 'pinecone'),
    'id'          => 'h2_font',
    'type'        => 'typography',
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'typo'
  ),

  array(
    'label'       => esc_html__('H3 Headers Font', 'pinecone'),
    'id'          => 'h3_font',
    'type'        => 'typography',
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'typo'
  ),

  array(
    'label'       => esc_html__('H4 Headers Font', 'pinecone'),
    'id'          => 'h4_font',
    'type'        => 'typography',
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'typo'
  ),

  array(
    'label'       => esc_html__('H5 Headers Font', 'pinecone'),
    'id'          => 'h5_font',
    'type'        => 'typography',
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'typo'
  ),

  array(
    'label'       => esc_html__('H6 Headers Font', 'pinecone'),
    'id'          => 'h6_font',
    'type'        => 'typography',
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => '',
    'section'     => 'typo'
  )
  )
);

  if ( $saved_settings !== $custom_settings ) {
	  update_option( 'option_tree_settings', $custom_settings );
	}

}
