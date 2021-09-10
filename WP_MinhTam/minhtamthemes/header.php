<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <link rel="profile" href="http://gmgp.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div id="container">
    <header id="header">
		<?php minhtam_logo(); ?>
		<?php minhtam_menu( 'primary-menu' ); ?>
	</header>