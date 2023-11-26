<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package vdtheme
 */

get_header();
?>

<main>
	<section class="top-height"></section>
	<section class="pages page-404">

		<div class="container">
			<div class="wrapper-404">
				<article class="image-404">
					<img src="<?= IMG_URL; ?>404.png" alt="Travemo Club">
				</article>
				<article class="text-404">
					<div class="title-default">
						<p>ERROR 404</p>
						<h2>We're sorry, the page you were looking for isn't here.</h2>
					</div>
					<a href="<?= site_url(); ?>" class="btn btn-primary btn-dark"><span>Go to homepage</span><img src="<?= IMG_URL; ?>/arrow-right-white.svg" alt="Travemo Club"></a>
				</article>
			</div>
		</div>
	</section>

</main>
<?php
get_footer();
