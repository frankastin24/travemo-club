<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vdtheme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<header class="nav-down">
		<div class="container">
			<a href="<?= site_url(); ?>" class="header-logo"><img src="<?= IMG_URL; ?>logo.svg" alt="Travemo Club"></a>
			<div class="menu-toggle"><img src="<?= IMG_URL; ?>/menu.svg" alt="Travemo Club"></div>
			<nav>
				<span class="menu-close"><img src="<?= IMG_URL; ?>/menu-close.svg" alt="Travemo Club"></span>
				<ul>
					<?php

					$nav_items = wp_get_nav_menu_items('header-menu');

					foreach ($nav_items as $nav_item) {
					?>
						<li><a href="<?= $nav_item->url ?>"><?= $nav_item->title ?></a></li>

					<?php
					}

					?>
				</ul>
				<a href="<?= site_url(); ?>/contact" class="btn btn-primary btn-dark"><span>Contact us</span><img src="<?= IMG_URL; ?>arrow-right-white.svg" alt="Travemo Club"></a>
				<div class="lang-mobile">
					<a href="">English</a>
					<a href="">Deutsch</a>
					<a href="">Español</a>
				</div>
			</nav>
			<div class="lang">
				<ul>
					<li class="has-lang-sub"><a href="">EN</a>
						<ul class="lang-sub">
							<li><a href="">DE</a></li>
							<li><a href="">ESP</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<a href="<?= site_url(); ?>/contact" class="btn btn-primary"><span>Contact us</span><img src="<?= IMG_URL; ?>arrow-right-white.svg" alt="Travemo Club"></a>
		</div>
	</header>