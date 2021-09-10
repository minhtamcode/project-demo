<?php

add_action('wp_head', 'custom_stylesheet_content');

function adaptive_css($typo) {
	if ($typo) {
    $ot_google_fonts = get_theme_mod( 'ot_google_fonts', array() );
    foreach ($typo as  $key => $value) {
      if (isset($value) && !empty($value)) {
				if($key=='font-color') { $key = "color"; }
				if($key=='font-family') { $value = '"'.$ot_google_fonts[$value]['family'].'"'; }
				echo $key.":".$value." !important;";
      }
    }
  }
}

function get_opt($opt) {
	$att = (ot_get_option($opt)) ? ot_get_option($opt) : ''; return $att;
}

function custom_stylesheet_content() {

	$links_color = (isset($_GET["color"])) ? '#'.esc_attr($_GET["color"]) : get_opt('links_color');
	$mainbg_color = (isset($_GET["background"])) ? '#'.esc_attr($_GET["background"]) : get_opt('mainbg_color');
	global $post; ?>

	<style type="text/css">

		<?php if (get_opt('body_font')) { ?>
			body,	.date, .post-meta, .readmore,	.widget, .comment-text,
			.search-results, .post-content p,	.container p {
				<?php adaptive_css(get_opt('body_font')); ?>
			}
		<?php } ?>

		<?php if ($mainbg_color) { ?>
			body { background-color: <?php echo esc_html($mainbg_color); ?>; }
		<?php } ?>

		<?php if ($links_color) { ?>
			.comments a, .project-navigation i.inactive, .comments-container a, .comment-author a,
			a.post-entry, h1.logo a, .columns a, .column a,	.widget ul li a:hover, .testimonials-author,
			#contact-details a:hover,	.contact_links a:hover,	.feature-box.color i,	.widget #twitter-blog li a,
			li.twitter_text a.username,	.latest-post-blog p a:hover, .read-more a, #navigation ul li a:hover,
			#cancel-comment-reply-link:hover,	#cancel-comment-reply-link:hover::before,
			.comment-respond a:hover, a.comment-reply-link:hover, .social_menu_widget a::before,
			.footer-widget .widget-themeworm_social a:hover, .header-contacts .widget-themeworm_social a:hover {
				color: <?php echo esc_html($links_color); ?>;
			}

			.logo-link:hover path, .logo-link path {
				fill: <?php echo esc_html($links_color); ?>;
			}

			.post-date, .post-stroke:hover, .project-navigation a.back-to-blog, .cs-skin-underline > span,
			.project-navigation a.back-to-portfolio, .project-navigation a.back-to-portfolio:after,
			.header-contacts input[type="text"]:focus, .header-contacts input[type="password"]:focus,
			.header-contacts input[type="email"]:focus, .header-contacts textarea:focus,
			.wpcf7 input[type="text"]:focus, .wpcf7 input[type="password"]:focus, .sticky .post-stroke,
			.wpcf7 input[type="email"]:focus, .wpcf7 textarea:focus, .input__field:focus, .input--filled .input__field {
				border-color: <?php echo esc_html($links_color); ?> !important;
			}

			.readmore:hover, .project-navigation a.back-to-blog, input[type="submit"],
			#footer-wrapper, .to-top, .no-touch .to-top:hover, .widget-themeworm_social a:hover,
			.project-navigation a.back-to-portfolio:after, .widget li a.latest-title:hover, .social_menu_widget a:hover,
      .wpcf7 input[type="text"].wpcf7-not-valid, .wpcf7 input[type="email"].wpcf7-not-valid	{
				background: <?php echo esc_html($links_color); ?>;
			}

			#footer-trigger {
				border-color:  transparent transparent <?php echo esc_html($links_color); ?> transparent;
			}

			.footer-bg {
				background: linear-gradient(to top, rgba(<?php echo hex2rgba($links_color); ?>,0.65) 0%,rgba(<?php echo hex2rgba($links_color); ?>,1) 100%);
			}
		<?php } ?>

		h1 { <?php adaptive_css(get_opt('h1_font')); ?> }
		h2 { <?php adaptive_css(get_opt('h2_font')); ?> }
		h3 { <?php adaptive_css(get_opt('h3_font')); ?> }
		h4 { <?php adaptive_css(get_opt('h4_font')); ?> }
		h5 { <?php adaptive_css(get_opt('h5_font')); ?> }
		h6 { <?php adaptive_css(get_opt('h6_font')); ?> }

		h2.logo a, h1.logo a {
			<?php adaptive_css(get_opt('logo_font')); ?>
		}

		#navigation a, .widget_nav_menu a {
			<?php adaptive_css(get_opt('menu_font')); ?>
		}

		<?php if ( get_opt('logo_top_margin')  ||  get_opt('logo_bottom_margin') ) { ?>
			#logo {
				<?php if ( get_opt('logo_top_margin') ) { echo 'margin-top:'.esc_html(get_opt('logo_top_margin')).'px;'; } ?>
				<?php if ( get_opt('logo_bottom_margin') ) { echo 'margin-bottom:'.esc_html(get_opt('logo_bottom_margin')).'px;'; } ?>
			}
		<?php } ?>

		#navigation ul li ul {
			<?php if ( get_opt('submenu_width') ) { echo 'width:'.esc_html(get_opt('submenu_width')).'px;'; } ?>
		}

		#social-wrapper {
			background-image: url('<?php echo esc_url(ot_get_option( 'contacts_bg' )); ?>');
		}

		#footer-wrapper, #footer- {
			background-image: url('<?php echo esc_url(ot_get_option( 'footer_bg' )); ?>');
		}

    <?php if (get_opt('logo_rotate') == 'on') { ?>
      #logo a:nth-of-type(1) {
	      position:relative;
	      z-index:1;
      }

      #logo a:nth-of-type(1):hover img {
	      -webkit-transform: rotate(6deg);
	      transform: rotate(6deg);
      }
    <?php } ?>

    <?php if ( get_opt('logo_width') ) { ?>
      #logo img {
      	width:<?php echo esc_html(get_opt('logo_width')); ?>px;
      }
    <?php } ?>

    #infscr-loading, .load-more a:hover {
			background: <?php echo esc_html($links_color); ?>;
		}

    .load-more a {
			color: <?php echo esc_html($links_color); ?>;
		}

		<?php echo ot_get_option( 'custom_css' ); ?>

	</style>

<?php } ?>
