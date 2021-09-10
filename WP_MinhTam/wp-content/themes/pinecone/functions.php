<?php

add_filter('widget_text', 'do_shortcode');
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_use_theme_options', '__return_true' );
add_filter( 'ot_meta_boxes', '__return_true' );

require get_template_directory() . '/plugins/option-tree/ot-loader.php';
require get_template_directory() . '/admin/theme-options.php';
require get_template_directory() . '/admin/meta-boxes.php';
require get_template_directory() . '/admin/options.php';
require get_template_directory() . '/admin/widgets.php';
require get_template_directory() . '/admin/customcss.php';
require get_template_directory() . '/admin/builder_output.php';
require get_template_directory() . '/admin/builder_settings.php';
require_once( ABSPATH . 'wp-admin/includes/media.php' );

/* ----------------------------------------------------- */
/* Theme Install */
/* ----------------------------------------------------- */

function new_theme_admin_bar_menu($admin_bar) {
  if (!is_super_admin() || !is_admin_bar_showing())
    return;
  $admin_bar->add_menu(array(
    'id' => 'option_tree_link',
    'title' => esc_html__("Theme Options", 'pinecone'),
    'href' => site_url().'/wp-admin/themes.php?page=ot-theme-options',
    'meta' => array()
  ));
}

add_action('after_setup_theme', 'newtheme_install');
add_action('admin_bar_menu', 'new_theme_admin_bar_menu', 99);

if (!function_exists('newtheme_install')):
  function newtheme_install() {
    add_theme_support('automatic-feed-links');
  	add_theme_support( 'title-tag' );
  	add_theme_support('post-formats', array('gallery', 'video', 'quote', 'link'));
  	add_editor_style( 'css/editor-style.css' );
  	register_nav_menu( 'menu-header', 'Header menu' );
  	load_theme_textdomain( 'pinecone', get_template_directory() . '/languages' );
  }
endif;

if ( !isset($content_width) ) {
	$content_width = 1200;
}

/* ----------------------------------------------------- */
/* Scripts */
/* ----------------------------------------------------- */

function my_scripts() {
	wp_enqueue_script( 'carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'justifiedGallery', get_template_directory_uri() . '/js/jquery.justifiedGallery.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'gallery', get_template_directory_uri() . '/js/gallery.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB6Al0kfTw61rUcdAzesNZOIbX8UOzwgI0&libraries=geometry', 'jquery', '2.1', true );
	wp_enqueue_script( 'maplace', get_template_directory_uri() . '/js/maplace.min.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.min.js', array(), false, true );
  wp_enqueue_script( 'masonry', get_template_directory_uri() . '/js/masonry.min.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'appear', get_template_directory_uri() . '/js/jquery.appear.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'classie', get_template_directory_uri() . '/js/classie.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/fancybox.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/fitvids.js', array( 'jquery' ), false, true );
  wp_localize_script( 'custom', 'infinite_url', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	if (ot_get_option('preloader_on') != "off") {
		wp_enqueue_script( 'lazyload', get_template_directory_uri() . '/js/lazyload.js', array( 'jquery' ), false, true );
	}

	if ( is_singular() && comments_open() ) {
		wp_enqueue_script('comment-reply');
	}

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/font/css/font-awesome.min.css', array(), '4.3' );
	wp_enqueue_style( 'justifiedGallery', get_template_directory_uri() . '/css/justifiedGallery.min.css', array(), '4.3' );
	wp_enqueue_style( 'base', get_template_directory_uri() . '/css/base.css', array(), '4.3' );
	wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/css/fancybox.css', array(), '4.3' );
  wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css', array(), '4.3' );
	wp_enqueue_style( 'Gfonts', 'https://fonts.googleapis.com/css?family=Alegreya+Sans:300,regular,italic,500,700|Roboto:300,300italic,regular,italic,500,700', array(), true );
}

add_action( 'wp_enqueue_scripts', 'my_scripts' );

if (!function_exists('add_scripts')) {
	function add_scripts() {
		wp_register_style('responsive', get_template_directory_uri() . '/css/responsive.css', '', '', 'all');
		wp_enqueue_style('responsive');
    wp_enqueue_style( 'style', get_stylesheet_uri() );
	}
	add_action('wp_enqueue_scripts', 'add_scripts');
}

function manggis_admin_style() {
  wp_enqueue_style('fix-ot-styles', get_template_directory_uri() . '/css/fix-ot-styles.css' );
}
add_action('admin_enqueue_scripts', 'manggis_admin_style');

/* ----------------------------------------------------- */
/* Thumbs */
/* ----------------------------------------------------- */

  add_theme_support('post-thumbnails');
  set_post_thumbnail_size(600, 300, true);
	add_image_size('portfolio-main', 768, 768, true);
	add_image_size('portfolio-masonry', 768, 0, true);
	add_image_size('portfolio-footer', 85, 85, true);

/* ----------------------------------------------------- */
/* Sidebars */
/* ----------------------------------------------------- */

function my_sidebars() {
	register_sidebar( array(
		'name' 			=> esc_html__('Default sidebar', 'pinecone'),
		'id' 			=> 'sidebar1',
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h6 class="widget-title"><span>',
		'after_title'	=> '</span></h6>',
	) );

  register_sidebar( array(
		'name' 			=> esc_html__('Page Top Sidebar', 'pinecone'),
		'id' 			=> 'sidebar_top',
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h6 class="widget-title"><span>',
		'after_title'	=> '</span></h6>',
	) );

	register_sidebar( array(
		'name' 			=> esc_html__('Contact Page Map', 'pinecone'),
		'id' 			=> 'contact_top',
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h6 class="widget-title"><span>',
		'after_title'	=> '</span></h6>',
	) );

	register_sidebar( array(
		'name' 			=> esc_html__('Contact Page sidebar', 'pinecone'),
		'id' 			=> 'sidebar2',
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h6 class="widget-title"><span>',
		'after_title'	=> '</span></h6>',
	) );

	register_sidebar( array(
		'name' 			=> esc_html__('Super-Header - Left', 'pinecone'),
		'id' 			=> 'header_sidebar1',
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h6 class="widget-title"><span>',
		'after_title'	=> '</span></h6>',
	) );

	register_sidebar( array(
		'name' 			=> esc_html__('Super-Header - Right', 'pinecone'),
		'id' 			=> 'header_sidebar2',
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h6 class="widget-title"><span>',
		'after_title'	=> '</span></h6>',
	) );

	register_sidebar( array(
		'name' 			=> esc_html__('Footer sidebar 1 - Left', 'pinecone'),
		'id' 			=> 'footer_sidebar1',
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h6 class="widget-title"><span>',
		'after_title'	=> '</span></h6>',
	) );

	register_sidebar( array(
		'name' 			=> esc_html__('Footer sidebar 2 - Right', 'pinecone'),
		'id' 			=> 'footer_sidebar2',
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h6 class="widget-title"><span>',
		'after_title'	=> '</span></h6>',
	) );

	register_sidebar( array(
		'name' 			=> esc_html__('Super-Footer - 1', 'pinecone'),
		'id' 			=> 'footer_overlay1',
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h6 class="widget-title"><span>',
		'after_title'	=> '</span></h6>',
	) );

	register_sidebar( array(
		'name' 			=> esc_html__('Super-Footer - 2', 'pinecone'),
		'id' 			=> 'footer_overlay2',
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h6 class="widget-title"><span>',
		'after_title'	=> '</span></h6>',
	) );

	register_sidebar( array(
		'name' 			=> esc_html__('Super-Footer - 3', 'pinecone'),
		'id' 			=> 'footer_overlay3',
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h6 class="widget-title"><span>',
		'after_title'	=> '</span></h6>',
	) );
};

add_action( 'widgets_init', 'my_sidebars' );

/* ----------------------------------------------------- */
/* Option Tree Settings */
/* ----------------------------------------------------- */

function ot_recognized_font_families( $field_id = '' ) {
  $families = array();
  return apply_filters( 'ot_recognized_font_families', $families, $field_id );
}

/* ----------------------------------------------------- */
/* Page Title */
/* ----------------------------------------------------- */

function pinecone_title($padding = '') {
$title = get_the_title();
print <<<TITLE
  <div class="container">
    <div class="sixteen columns">
      <div id="page-title" class="$padding">
        <h1>$title</h1>
      </div>
    </div>
  </div>
TITLE;
}

/* ----------------------------------------------------- */
/* Infinite AJAX loading and filtering */
/* ----------------------------------------------------- */

add_action( 'wp_ajax_nopriv_ajax_infinite', 'ajax_infinite' );
add_action( 'wp_ajax_ajax_infinite', 'ajax_infinite' );

function ajax_infinite() {
	$perpage = $_POST['perpage'];
	//$offset = $_POST['offset'];
	$filter = $_POST['filter'];
  global $columns;
  $columns = $_POST['columns'];
  $exclude = $_POST['exclude'];

  $exclude = (isset($exclude)) ? explode(",", substr( $exclude, 0, -1 )) : '';
  $portfolio_sorting = (ot_get_option('portfolio_sorting')) ?: '';
  $filter = ( $filter != 'all' ) ? explode(",", $filter) : $filter;
	$tax_query = ( $filter != 'all' ) ? array( array( 'taxonomy' => 'filters', 'field' => 'slug', 'terms' => $filter, 'operator' => 'IN' ) ) : '';

	$args = array(
		'post_type' => 'portfolio',
		//'offset' => $offset,
    'orderby' => $portfolio_sorting,
		'posts_per_page' => $perpage,
    'post_status' => 'publish',
    'post__not_in' => $exclude,
		'tax_query' => $tax_query,
    'meta_query' => array( array(
			'key' => '_thumbnail_id',
			'compare' => 'EXISTS'
		))
	);

	$portfolio_query = new WP_Query( $args );

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		if ( $portfolio_query->have_posts() ) :
			while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
        if (has_post_thumbnail() && !post_password_required()) {
          get_template_part( 'content-loop' );
          $exclude[] = get_the_ID();
        }
			endwhile;
		endif;
	}
	die();
}

function load_more( $filters_array = '', $columns = 'one-third column', $data_all = false, $posts_per_page = false ) {
  $posts_per_page = (!empty($posts_per_page)) ? $posts_per_page : ot_get_option('portfolio_showpost','6');
  $show_more = ( ot_get_option('infinite_off' ) != 'off' ) ? '&nbsp;' : esc_attr__( 'Show more','pinecone' );
  $data_loading = ( ot_get_option('portfolio_loadmore_animation') != 'off' ) ? '&nbsp;' : esc_attr__( 'Loading...', 'pinecone' );
  $load_svg = get_template_directory_uri() . '/images/three-dots.svg'; $data_all = (!empty($data_all)) ? $data_all : get_tax_filters($filters_array, 'count');

  echo '<div class="load-more">';
  if (ot_get_option('portfolio_loadmore_animation') != 'off' && ot_get_option('portfolio_loadmore_animation' ) != 'off') {
    echo '<img class="loadmore-img" src="'. $load_svg . '" />';
  }
  echo '<a href="#" id="next-projects" data-all="'. $data_all .'" data-perpage="'. $posts_per_page .'" data-filter="'. get_tax_filters($filters_array) .'" data-load="' . $show_more . '" data-loading="' . $data_loading . '" data-columns="'. $columns .'">';
  echo $show_more
    . '</a>'
    . '</div>';
}

function get_appear($selector = '.load-more') {
print <<<END
  <script type="text/javascript">
    jQuery(document).ready(function() {
      jQuery('$selector').appear();
      jQuery(document.body).on('appear', '$selector', function() {
        if ( jQuery( '#next-projects' ).data( 'perpage' ) < jQuery( '#next-projects' ).attr( 'data-all' ) ) {
          jQuery( '#next-projects' ).click();
        }
      });
    });
  </script>
END;
}

/* ----------------------------------------------------- */
/* Get filters list */
/* ----------------------------------------------------- */

function get_tax_filters( $filters_array, $count = '' ) {
  $tax_filters = ''; $tax_count = 0;

  if (is_array( $filters_array )) {
  	foreach ( $filters_array as $filter ) {
  		$term = get_term( $filter, 'filters' );
  		$tax_filters .= $term->slug .",";
  		//$tax_count = $term->count + $tax_count;
  	}
  	$tax_filters = substr( $tax_filters, 0, -1 );

    $query = new WP_Query( array(
    	'post_type' => 'portfolio',
    	'tax_query' => array(	array(
    			'taxonomy' => 'filters',
    			'field'    => 'slug',
    			'terms'    => explode( ",", $tax_filters ),
    	))
    ));

    $tax_count = $query->found_posts;
  }

  $filters = ( $tax_filters ) ? $tax_filters : 'all';
  $data_all = ( $tax_count > 0 ) ? $tax_count : wp_count_posts( 'portfolio' )->publish;

  return $output = ( 'count' == $count ) ? $data_all : $filters;
}

/* ----------------------------------------------------- */
/* Homepage redirect hack WP4 */
/* ----------------------------------------------------- */
/*
add_filter('redirect_canonical','pif_disable_redirect_canonical');
function pif_disable_redirect_canonical($redirect_url) {
  if (is_singular()) $redirect_url = false;
  return $redirect_url;
}
*/
/* ----------------------------------------------------- */
/* Portfolio Gallery Setup */
/* ----------------------------------------------------- */

add_filter( 'use_default_gallery_style', '__return_false' );
add_filter( 'the_content', 'im_add_rel_attribute');
add_filter( 'wp_get_attachment_link', 'rc_add_rel_attribute');

function rc_add_rel_attribute($link) {
	return str_replace('<a href', '<a rel="lightbox" id="group" href', $link);
}

function im_add_rel_attribute($content) {
	$string = '/<a href="(.*?).(jpg|jpeg|png|gif|bmp|ico)"><img(.*?)class="(.*?)wp-image-(.*?)" \/><\/a>/i';
	preg_match_all( $string, $content, $matches, PREG_SET_ORDER);

	//Check which attachment is referenced
	foreach ($matches as $val) {

		$post = get_post($val[5]);

    $string = '<a href="' . $val[1] . '.' . $val[2] . '"><img' . $val[3] . 'class="' . $val[4] . 'wp-image-' . $val[5] . '" /></a>';
		$replace = '<a rel="lightbox" id="group" href="' . $val[1] . '.' . $val[2] . '" ><img' . $val[3] . 'class="' . $val[4] . 'wp-image-' . $val[5] . '" /></a>';

    $content = str_replace( $string, $replace, $content);
	}

	return $content;
}

add_filter('img_caption_shortcode', 'fix_img_caption_shortcode', 10, 3);

function fix_img_caption_shortcode($val, $attr, $content = null) {
  extract(shortcode_atts(array(
    'id'    => '',
    'align' => '',
    'width' => '',
    'caption' => ''
  ), $attr));

  if ( 1 > (int) $width || empty($caption) ) return $val;

  return '<div id="' . esc_html($id) . '" class="wp-caption ' . esc_attr($align) . '" style="width: ' . (0 + (int) $width) . 'px">' . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

/* ----------------------------------------------------- */
/* Fancybox & Video output Function */
/* ----------------------------------------------------- */

function add_fancybox() {
  $title_null = 'null'; $fancybox_title = '';

  if (ot_get_option('fancybox_title') != 'off') {
$fancybox_title = <<<SCRIPT
    beforeShow : function() {
      if ($(this.element).find('.thumb').attr('alt')) {
        this.title = $(this.element).find('.thumb').attr('alt');
      }
      if ($(this.element).find('img').attr('alt')) {
        this.title = $(this.element).find('img').attr('alt');
      }
      if (this.title) {
        this.title =  this.title;
      }
    },
SCRIPT;
$title_null = "{ type : 'inside' }";
  }
print <<<END
  <script type="text/javascript">
  	( function( $ ) {
  		$(document).ready(function() {
  			$("a#group").fancybox({
          $fancybox_title
  				'transitionIn'	:	'elastic',
  				'transitionOut'	:	'elastic',
  				'speedIn'		:	600,
  				'speedOut'		:	200,
  				'overlayShow'	:	false,
  				helpers: {
  					title : $title_null
  				}
  			});
  			$( '.hentry' ).fitVids();
  		});
  	} )( jQuery );
  </script>
END;
}

/* ----------------------------------------------------- */
/* Social Share in posts/portfolio */
/* ----------------------------------------------------- */

function share_me_blog() {
  if (ot_get_option('blog_share')) {
    echo '<div class="widget-themeworm_social social-share"><div class="social-widget-inner">';
    if (ot_get_option('blog_share_title')) {
      echo '<span class="share-title">'. esc_html(ot_get_option('blog_share_title')) .'</span>';
    }
    $blog_share = ot_get_option('blog_share');
    if (isset($blog_share[0])) {
  		echo '<a href="http://twitter.com/home?status='. get_the_title() .'+'. get_the_permalink() .'" target="_blank"><i class="fa fa-twitter"></i></a>';
    }
    if (isset($blog_share[1])) {
  		echo '<a href="http://www.facebook.com/share.php?u='. get_the_permalink() .'&title='. get_the_title() .'" target="_blank"><i class="fa fa-facebook"></i></a>';
    }
    if (isset($blog_share[2])) {
  		echo '<a href="https://plus.google.com/share?url='. get_the_permalink() .'" target="_blank"><i class="fa fa-google-plus"></i></a>';
    }
    if (isset($blog_share[3])) {
      $pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
  		echo '<a href="http://pinterest.com/pin/create/button/?url='. urlencode( get_permalink( get_the_ID() ) ) .'&media='. $pinterestimage[0] .'&description='. get_the_title() .'" target="_blank"><i class="fa fa-pinterest-p"></i></a>';
    }
    if (isset($blog_share[4])) {
  		echo '<a href="https://www.linkedin.com/cws/share?url='. get_the_permalink() .'" target="_blank"><i class="fa fa-linkedin"></i></a>';
    }
    echo '</div></div>';
  }
}

function share_me_portfolio() {
  if (ot_get_option('portfolio_share')) {
    echo '<div class="widget-themeworm_social social-share"><div class="social-widget-inner">';
    if (ot_get_option('portfolio_share_title')) {
      echo '<span class="share-title">'. esc_html(ot_get_option('portfolio_share_title')) .'</span>';
    }
    $portfolio = ot_get_option('portfolio_share');
    if (isset($portfolio[0])) {
  		echo '<a href="http://twitter.com/home?status='. get_the_title() .'+'. get_the_permalink() .'" target="_blank"><i class="fa fa-twitter"></i></a>';
    }
    if (isset($portfolio[1])) {
  		echo '<a href="http://www.facebook.com/share.php?u='. get_the_permalink() .'&title='. get_the_title() .'" target="_blank"><i class="fa fa-facebook"></i></a>';
    }
    if (isset($portfolio[2])) {
  		echo '<a href="https://plus.google.com/share?url='. get_the_permalink() .'" target="_blank"><i class="fa fa-google-plus"></i></a>';
    }
    if (isset($portfolio[3])) {
      $pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
  		echo '<a href="http://pinterest.com/pin/create/button/?url='. urlencode( get_permalink( get_the_ID() ) ) .'&media='. $pinterestimage[0] .'&description='. get_the_title() .'" target="_blank"><i class="fa fa-pinterest-p"></i></a>';
    }
    if (isset($portfolio[4])) {
  		echo '<a href="https://www.linkedin.com/cws/share?url='. get_the_permalink() .'" target="_blank"><i class="fa fa-linkedin"></i></a>';
    }
    echo '</div></div>';
  }
}

/* ----------------------------------------------------- */
/* Comments Setup */
/* ----------------------------------------------------- */

add_filter('comment_form_defaults', 'my_comment_defaults');

function my_comment_defaults($args) {

	$commenter = wp_get_current_commenter();
	$current_user = wp_get_current_user();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$comment_author = esc_attr( $commenter['comment_author'] );
	$comment_author_email = esc_attr( $commenter['comment_author_email'] );
	$comment_author_url = esc_attr( $commenter['comment_author_url'] );

	$name = ($comment_author) ? '' : esc_html__('Name *','pinecone');
	$email = ($comment_author_email) ? '' : esc_html__('Email *','pinecone');
	$website = ($comment_author_url) ? '' : esc_html__('Website','pinecone');

	$fields =  array(
	'author' =>
		'<span class="input comment-form-author">' .
		'<input id="author" name="author" type="text" value="' . $comment_author .
		'" ' . $aria_req . ' class="input__field" />' .
		'<label for="author" class="input__label">' .
		'<span class="input__label-content" data-content="' . esc_html__('Name','pinecone') . '">' . $name . '</span>' .
		'</label>' .
		'</span>',

	'email' =>
		'<span class="input comment-form-email">' .
		'<input id="email" name="email" type="text" value="' . $comment_author_email .
		'" ' . $aria_req . ' class="input__field" />' .
		'<label for="email" class="input__label">' .
		'<span class="input__label-content" data-content="' . esc_html__('Email','pinecone') . '">' . $email . '</span>' .
		'</label>' .
		'</span>',

	'url' =>
		'<span class="input comment-form-url">'.
		'<input id="url" name="url" type="text" value="' . $comment_author_url .
		'" ' . $aria_req . ' class="input__field" />'.
		'<label for="url" class="input__label">' .
		'<span class="input__label-content" data-content="' . esc_html__('Website','pinecone') . '">' . $website . '</span>'.
		'</label>' .
		'</span>'
	);

	$args = array(
		'comment_notes_before' => '<p><em>' . esc_html__( 'Your email address will not be published.', 'pinecone' ) . '</em></p>',
		'comment_notes_after' => '',
		'comment_field' =>

		'<span class="input content-texatrea comment-form-message">
		<textarea name="comment" id="comment" class="required input__field" rows="8"></textarea>
		<label for="comment" class="input__label">
		<span class="input__label-content" data-content="' . esc_html__('Comment','pinecone') . '">' . esc_html__('Comment *','pinecone') . '</span>
		</label>
		</span>',

		'id_form' => 'commentform',
		'label_submit' => esc_html__('Send','pinecone'),
		'name_submit' => 'submit',
		'id_submit' => 'submit',
		'class_submit' => 'submit',
		'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
		'submit_field' => '<span class="form-submit">%1$s %2$s</span>',

		'logged_in_as' => '<p class="logged-in-as">' . sprintf( wp_kses( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'pinecone' ), array(	'a' => array( 'href' => array(),	'title' => array()) ) ), esc_url(admin_url( 'profile.php' )), $current_user->user_login, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',

		'cancel_reply_link' => esc_html__('Cancel Reply','pinecone'),
		'title_reply' => esc_html__('Leave a comment','pinecone'),
		'title_reply_to' => esc_html__('Leave a Reply to %s','pinecone'),
		'fields' => apply_filters('comment_form_default_fields', $fields)
	);

return $args;

}

function custom_comment($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
  switch ($comment->comment_type) :
    case '' :
    ?>
      <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <div class="comments">
          <div class="avatar"><?php  echo get_avatar($comment, 44); ?></div>
          <div class="comment-text">
            <div class="comment-author">
              <?php printf(esc_html__('%s ', 'pinecone'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?>
				    </div>
				    <span class="date">
					    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>"><?php printf(esc_html__('%1$s - %2$s', 'pinecone'), get_comment_date(), get_comment_time()); ?></a>
				    </span>
            <span class="reply">
					    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				    </span>
            <?php if ($comment->comment_approved == '0') : ?>
              <em><?php esc_html_e('Your comment is awaiting for moderation.', 'pinecone'); ?></em>
            <?php endif; ?>
				    <div class="comment-content-text">
					    <?php comment_text(); ?>
				    </div>
          </div>
        </article>
    <?php
    break;
    case 'pingback' :
    case 'trackback' : ?>
      <li class="post pingback">
        <p><?php esc_html_e('Pingback:', 'pinecone'); ?> <?php comment_author_link(); ?><?php edit_comment_link(esc_html__('(Edit)', 'pinecone'), ' '); ?></p>
      <?php
    break;
  endswitch;
}

/* ----------------------------------------------------- */
/* Search Archives Display */
/* ----------------------------------------------------- */

function tw_displayArchives() {

  $search_posts = new WP_Query(
    array(
      'post_type' => 'post',
      'posts_per_page' => 8,
      'post_status' => 'publish',
      'nopaging' => 0,
      'post__not_in' => get_option('sticky_posts')
    )
  );

  echo '<ul class="circle_list">';

  if ($search_posts->have_posts()) : while ($search_posts->have_posts()) : $search_posts->the_post();
    echo '<li><a href="' . get_the_permalink() . '" class="dummy-media-object" >' . get_the_title() . '</a></li>';
  endwhile;
  endif;

  echo '</ul>';

  wp_reset_query();
	wp_reset_postdata();
}

/* ----------------------------------------------------- */
/* Recent Portfolio */
/* ----------------------------------------------------- */

function recent_portfolios() {
  global $post;
  $exclude = $post->ID;
  rewind_posts();
  $filters  = get_post_meta($post->ID, 'recent_portfolio_filters', true);
  $items  = get_post_meta($post->ID, 'recent_portfolio_posts', true);

  $args = array(
    'post_type' => array('portfolio'),
    'post__not_in' => array($exclude),
		'posts_per_page' => '6',
    'orderby' => 'date',
    'order' => 'DESC'
  );

  if(!empty($items)) {
    $args['post__in'] = $items;
  }

  if(!empty($filters)) {
    $newfilters = array();
    foreach ($filters as $key => $value) {
      $newfilters[] = $key;
    }

    $args['tax_query'] = array(
      array(
        'taxonomy' => 'filters',
        'field' => 'id',
        'terms' => $newfilters
      )
    );
  }
  $wpcust = new WP_Query($args); ?>

	<div class="container portfolio_container" style="width:100%;">
		<div id="portfolio-wrapper" class="portfolio-wrapper">
	    <?php if ( $wpcust->have_posts() ):
        while( $wpcust->have_posts() ) : $wpcust->the_post(); ?>

			    <div <?php post_class('full-item-recent portfolio-item'); ?> id="post-<?php the_ID(); ?>" >
				    <div class="picture">
					    <a href="<?php the_permalink(); ?>" class="portfolio-link"><?php the_post_thumbnail('portfolio-main'); ?></a>
				    </div>
				    <div class="item-description alt">
					    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_html__('Link to %s', 'pinecone'), the_title_attribute('echo=0')); ?>" rel="bookmark">
						    <h6><?php the_title(); ?></h6>
					    </a>
				    </div>
			    </div>
    <?php
      endwhile;
      endif; ?>
		</div>
		<div id="next-projects"><?php  next_posts_link(''); ?></div>
	</div>
  <?php wp_reset_query();
}

/* ----------------------------------------------------- */
/* Related posts */
/* ----------------------------------------------------- */

function tw_related_posts() {

  global $post;
  $tags = wp_get_post_tags( $post->ID );
  $tag_arr = ''; $i = 0;

  if($tags) {

    foreach( $tags as $tag ) {
      $tag_arr .= $tag->slug . ',';
    }

    $numberposts = 2;
    if (ot_get_option('related_postcount')) {$numberposts = ot_get_option('related_postcount');}

    $args = array(
		  'post_type' => 'post',
      'tag' => $tag_arr,
      'numberposts' => $numberposts,
      'post__not_in' => array($post->ID)
    );

    $related_posts = get_posts( $args );

    if ($related_posts) {
      echo '<div class="related-posts">';
		  echo '<div id="page-title" class="recent-title"><h3 id="related-posts">'. esc_html__('Related Posts', 'pinecone').'</h3></div><ul>';
      foreach ( $related_posts as $post ) : setup_postdata( $post ); $i++; ?>
        <li class="one-post">
          <?php get_template_part('blog-loop'); ?>
        </li>
      <?php endforeach;
      echo '</ul></div>';
      if ($i == 1) { ?>
        <style>
          .one-post {
            margin: 0;
            width: 100%;
          }
        </style>
      <?php }
    }
  }
	wp_reset_postdata();
}

/* ----------------------------------------------------- */
/* HEX to RGBA color */
/* ----------------------------------------------------- */

function hex2rgba($color, $opacity = false) {

 $default = 'rgb(0,0,0)';

 //Return default if no color provided
 if(empty($color))
    return $default;
 //Sanitize $color if "#" is provided
  if ($color[0] == '#' ) {
    $color = substr( $color, 1 );
  }

  //Check if color has 6 or 3 characters and get values
  if (strlen($color) == 6) {
    $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
  } elseif ( strlen( $color ) == 3 ) {
    $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
  } else {
    return $default;
  }
  //Convert hexadec to rgb
  $rgb =  array_map('hexdec', $hex);
  //Check if opacity is set(rgba or rgb)
  if ($opacity) {
    if (abs($opacity) > 1)
      $opacity = 1.0;
      $output = ''.implode(",",$rgb).','.$opacity.'';
  } else {
      $output = ''.implode(",",$rgb).'';
  }
  //Return rgb(a) color string
  return esc_html($output);
}

/* ----------------------------------------------------- */
/* TGM */
/* ----------------------------------------------------- */

require_once dirname( __FILE__ ) . '/plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

if (!function_exists('my_theme_register_required_plugins')) {
function my_theme_register_required_plugins() {

	$plugins = array(
		array(
			'name'               => 'Portfolio Installer', // The plugin name.
			'slug'               => 'portfolio-installer', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/plugins/portfolio-installer.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '2.1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
		),
    array(
			'name'               => 'Page builder by Themeworm',
			'slug'               => 'themeworm-pagebuilder',
      'source'             => get_stylesheet_directory() . '/plugins/themeworm-pagebuilder.zip',
			'required'           => false,
			'version'            => '3',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => ''
		),
		array(
			'name'               => 'Contact Form 7',
			'slug'               => 'contact-form-7',
			'required'           => false,
			'version'            => '4.3',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => ''
		)

	);

  $config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'pinecone' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'pinecone' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'pinecone' ), // %s = plugin name.
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'pinecone' ),
			'notice_can_install_required'     => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'pinecone'
			), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'pinecone'
			), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop(
				'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
				'pinecone'
			), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'pinecone'
			), // %1$s = plugin name(s).
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'pinecone'
			), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop(
				'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
				'pinecone'
			), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'pinecone'
			), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'pinecone'
			), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop(
				'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
				'pinecone'
			), // %1$s = plugin name(s).
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'pinecone'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'pinecone'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'pinecone'
			),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'pinecone' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'pinecone' ),
			'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'pinecone' ),
			'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'pinecone' ),  // %1$s = plugin name(s).
			'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'pinecone' ),  // %1$s = plugin name(s).
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'pinecone' ), // %s = dashboard link.
			'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'pinecone' ),

			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

	tgmpa( $plugins, $config );

} }
?>
