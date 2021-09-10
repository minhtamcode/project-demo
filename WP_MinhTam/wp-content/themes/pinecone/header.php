<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url(ot_get_option('favicon_upload', get_template_directory_uri().'/images/favicon.png')); ?>" />
	<?php } ?>
	<?php	wp_head(); ?>
</head>

<body <?php body_class(); ?> >

<?php if (ot_get_option('preloader_on') != "off") { ?>
	<div id="loader">
		<?php if (has_post_thumbnail()) { $loader_img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'portfolio-footer' );	$loader_image_url = $loader_img[0]; ?>
			<img class="loader-img" src="<?php echo esc_url($loader_image_url); ?>" />
		<?php } ?>
		<div id="spinner"></div>
	</div>
<?php } ?>

<div id="social-wrapper">
	<div class="social-bg">
		<div class="social-height">
			<div class="container">

				<div class="eight columns">
					<div class="header-contacts header-contacts-left">
					<?php if ( is_active_sidebar('header_sidebar1') ) : ?>
						<?php dynamic_sidebar('header_sidebar1'); ?>
					<?php endif; ?>
					</div>
				</div>

				<div class="eight columns">
					<div class="header-contacts header-contacts-right">
						<?php if ( is_active_sidebar('header_sidebar2') ) : ?>
							<?php dynamic_sidebar('header_sidebar2'); ?>
						<?php endif; ?>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<div id="social-trigger" class="toggled-up" <?php if (ot_get_option('super_header') == "off") { ?>style="display:none;"<?php } ?>></div>

<div id="wrapper">

	<div id="site-navigation">
		<div class="container">
			<div class="sixteen columns">
				<div id="logo">

					<?php
					if (ot_get_option('logo_upload')) { ?>
						<a href="<?php echo esc_url( home_url('/') ); ?>" title="<?php esc_attr(bloginfo('name')); ?>" rel="home">
							<img src="<?php echo esc_url( ot_get_option('logo_upload') ); ?>" alt="<?php esc_attr(bloginfo('name')); ?>" />
						</a>
					<?php } else { ?>

						<a href="<?php echo esc_url( home_url('/') ); ?>" title="<?php esc_attr(bloginfo('name')); ?>" rel="home"  class="pine">
							<img src="<?php echo esc_url(get_template_directory_uri()  . '/images/pine.svg'); ?>" alt="<?php esc_attr(bloginfo('name')); ?>" width="200" height="200" class="svg logo-link" />
						</a>

					<?php }

					if (ot_get_option('logo_text')) { ?>
						<h1 class="logo">
							<a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php echo esc_attr( ot_get_option('logo_text', 'PineCone') ); ?></a>
						</h1>
					<?php } ?>

				</div>
			</div>

			<?php if (ot_get_option('enable_mainmenu') != 'off') { ?>
				<div class="sixteen columns">
					<div id="navigation" class="top-navigation">

						<?php if ( has_nav_menu( 'menu-header' ) ) { ?>
							<?php wp_nav_menu( array( 'theme_location' => 'menu-header', 'menu_class' => 'nav-menu' ) ); ?>
						<?php } else { ?>
							<div class="nav-menu"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_attr_e( 'Setup a navigation menu in Admin panel', 'pinecone' );?></a></div>
						<?php } ?>

						<div class="menu-dropdown"><span></span></div>

					</div>
				</div>
			<?php } ?>

			<?php if ( is_active_sidebar('sidebar_top') ) : ?>
				<div class="sixteen columns">
					<div class="header-sidebar">
						<?php dynamic_sidebar('sidebar_top'); ?>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>
