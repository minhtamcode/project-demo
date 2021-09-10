<?php if ( ! defined( 'OT_VERSION') ) exit( 'No direct script access allowed' );
/**
 * Builds the Setting & Documentation UI.
 *
 * @uses      ot_register_settings()
 *
 * @package   OptionTree
 * @author    Derek Herman <derek@valendesigns.com>
 * @copyright Copyright (c) 2012, Derek Herman
 */
if ( function_exists( 'ot_register_settings' ) ) {

  ot_register_settings( array(
      array(
        'id'                  => 'option_tree_settings',
        'pages'               => apply_filters( 'ot_register_pages_array', array( 
          array( 
            'id'              => 'ot',
            'page_title'      => esc_html__( 'OptionTree', 'pinecone' ),
            'menu_title'      => esc_html__( 'OptionTree', 'pinecone' ),
            'capability'      => 'manage_options',
            'menu_slug'       => 'ot-settings',
            'icon_url'        => OT_URL . '/assets/images/ot-logo-mini.png',
            'position'        => 61,
            'hidden_page'     => true
          ),
          array(
            'id'              => 'settings',
            'parent_slug'     => 'ot-settings',
            'page_title'      => esc_html__( 'Settings', 'pinecone' ),
            'menu_title'      => esc_html__( 'Settings', 'pinecone' ),
            'capability'      => 'edit_theme_options',
            'menu_slug'       => 'ot-settings',
            'icon_url'        => null,
            'position'        => null,
            'updated_message' => esc_html__( 'Theme Options updated.', 'pinecone' ),
            'reset_message'   => esc_html__( 'Theme Options reset.', 'pinecone' ),
            'button_text'     => esc_html__( 'Save Settings', 'pinecone' ),
            'show_buttons'    => false,
            'screen_icon'     => 'themes',
            'sections'        => array(
              array(
                'id'          => 'create_setting',
                'title'       => esc_html__( 'Theme Options UI', 'pinecone' )
              ),
              array(
                'id'          => 'import',
                'title'       => esc_html__( 'Import', 'pinecone' )
              ),
              array(
                'id'          => 'export',
                'title'       => esc_html__( 'Export', 'pinecone' )
              ),
              array(
                'id'          => 'layouts',
                'title'       => esc_html__( 'Layouts', 'pinecone' )
              )
            ),
            'settings'        => array(
              array(
                'id'          => 'theme_options_ui_text',
                'label'       => esc_html__( 'Theme Options UI Builder', 'pinecone' ),
                'type'        => 'theme_options_ui',
                'section'     => 'create_setting'
              ),
              array(
                'id'          => 'import_xml_text',
                'label'       => esc_html__( 'Settings XML', 'pinecone' ),
                'type'        => 'import-xml',
                'section'     => 'import'
              ),
              array(
                'id'          => 'import_settings_text',
                'label'       => esc_html__( 'Settings', 'pinecone' ),
                'type'        => 'import-settings',
                'section'     => 'import'
              ),
              array(
                'id'          => 'import_data_text',
                'label'       => esc_html__( 'Theme Options', 'pinecone' ),
                'type'        => 'import-data',
                'section'     => 'import'
              ),
              array(
                'id'          => 'import_layouts_text',
                'label'       => esc_html__( 'Layouts', 'pinecone' ),
                'type'        => 'import-layouts',
                'section'     => 'import'
              ),
              array(
                'id'          => 'export_settings_file_text',
                'label'       => esc_html__( 'Settings PHP File', 'pinecone' ),
                'type'        => 'export-settings-file',
                'section'     => 'export'
              ),
              array(
                'id'          => 'export_settings_text',
                'label'       => esc_html__( 'Settings', 'pinecone' ),
                'type'        => 'export-settings',
                'section'     => 'export'
              ),
              array(
                'id'          => 'export_data_text',
                'label'       => esc_html__( 'Theme Options', 'pinecone' ),
                'type'        => 'export-data',
                'section'     => 'export'
              ),
              array(
                'id'          => 'export_layout_text',
                'label'       => esc_html__( 'Layouts', 'pinecone' ),
                'type'        => 'export-layouts',
                'section'     => 'export'
              ),
              array(
                'id'          => 'modify_layouts_text',
                'label'       => esc_html__( 'Add, Activate, & Remove Layouts', 'pinecone' ),
                'type'        => 'modify-layouts',
                'section'     => 'layouts'
              )
            )
          ),
          array(
            'id'              => 'documentation',
            'parent_slug'     => 'ot-settings',
            'page_title'      => esc_html__( 'Documentation', 'pinecone' ),
            'menu_title'      => esc_html__( 'Documentation', 'pinecone' ),
            'capability'      => 'edit_theme_options',
            'menu_slug'       => 'ot-documentation',
            'icon_url'        => null,
            'position'        => null,
            'updated_message' => esc_html__( 'Theme Options updated.', 'pinecone' ),
            'reset_message'   => esc_html__( 'Theme Options reset.', 'pinecone' ),
            'button_text'     => esc_html__( 'Save Settings', 'pinecone' ),
            'show_buttons'    => false,
            'screen_icon'     => 'themes',
            'sections'        => array(
              array(
                'id'          => 'creating_options',
                'title'       => esc_html__( 'Creating Options', 'pinecone' )
              ),
              array(
                'id'          => 'option_types',
                'title'       => esc_html__( 'Option Types', 'pinecone' )
              ),
              array(
                'id'          => 'functions',
                'title'       => esc_html__( 'Function References', 'pinecone' )
              ),
              array(
                'id'          => 'theme_mode',
                'title'       => esc_html__( 'Theme Mode', 'pinecone' )
              ),
              array(
                'id'          => 'meta_boxes',
                'title'       => esc_html__( 'Meta Boxes', 'pinecone' )
              ),
              array(
                'id'          => 'examples',
                'title'       => esc_html__( 'Code Examples', 'pinecone' )
              ),
              array(
                'id'          => 'layouts_overview',
                'title'       => esc_html__( 'Layouts Overview', 'pinecone' )
              )
            ),
            'settings'        => array(
              array(
                'id'          => 'creating_options_text',
                'label'       => esc_html__( 'Overview of available Theme Option fields.', 'pinecone' ),
                'type'        => 'creating-options',
                'section'     => 'creating_options'
              ),
              array(
                'id'          => 'option_types_text',
                'label'       => esc_html__( 'Option types in alphabetical order & hooks to filter them.', 'pinecone' ),
                'type'        => 'option-types',
                'section'     => 'option_types'
              ),
              array(
                'id'          => 'functions_ot_get_option',
                'label'       => esc_html__( 'Function Reference:ot_get_option()', 'pinecone' ),
                'type'        => 'ot-get-option',
                'section'     => 'functions'
              ),
              array(
                'id'          => 'functions_get_option_tree',
                'label'       => esc_html__( 'Function Reference:get_option_tree()', 'pinecone' ),
                'type'        => 'get-option-tree',
                'section'     => 'functions'
              ),
              array(
                'id'          => 'theme_mode_text',
                'label'       => esc_html__( 'Theme Mode', 'pinecone' ),
                'type'        => 'theme-mode',
                'section'     => 'theme_mode'
              ),
              array(
                'id'          => 'meta_boxes_text',
                'label'       => esc_html__( 'Meta Boxes', 'pinecone' ),
                'type'        => 'meta-boxes',
                'section'     => 'meta_boxes'
              ),
              array(
                'id'          => 'example_text',
                'label'       => esc_html__( 'Code examples for front-end development.', 'pinecone' ),
                'type'        => 'examples',
                'section'     => 'examples'
              ),
              array(
                'id'          => 'layouts_overview_text',
                'label'       => esc_html__( 'What\'s a layout anyhow?', 'pinecone' ),
                'type'        => 'layouts-overview',
                'section'     => 'layouts_overview'
              )
            )
          )
        ) )
      )
    )
  );

}

/* End of file ot-ui-admin.php */
/* Location: ./option-tree/ot-ui-admin.php */