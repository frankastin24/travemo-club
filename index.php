<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vdtheme
 */

get_header();

$categories = get_categories();

?>
<main>
	<section class="top-image" style="background-image:url('<?= IMG_URL; ?>/blog-page.jpg')">
		<div class="top-text title-default title-center">
			<h1>Blog</h1>
		</div>
	</section>
	<section class="pages blog-page">
		<div class="container">
			<div class="page-wrapper">
				<aside class="page-aside">
					<ul>
						<?php

						$all_post_query = new WP_Query(['post_type' => 'post']);
						$num_all_posts = $all_post_query->found_posts;

						?>
						<li><a href="<?= site_url() ?>/blog">All <span>(<?= $num_all_posts; ?>)</span></a></li>
						<?php
						foreach ($categories as $category) {
							$query = new WP_Query(['post_type' => 'post', 'category_name' => $category->slug]);
							$num_posts = $query->found_posts;
						?>

							<li><a href="<?= site_url() . '/category/' . $category->slug; ?>"><?= $category->name; ?> <span>(<?= $num_posts; ?>)</span></a></li>
						<?php
						}

						?>

					</ul>
				</aside>
				<div class="page-content blog-content">
					<div class="blog-wrap">

						<?php

						if (have_posts()) : while (have_posts()) : the_post();

						?>
								<article class="show">
									<a href="<?= the_permalink(); ?>" class="blog-image"><img src="<?= get_the_post_thumbnail_url(); ?>" alt="Travemo Club"></a>
									<div class="blog-text">

										<div class="blog-date"><?= get_the_date('F j, Y') ?></div>

										<h3><a href="<?= the_permalink(); ?>"><?= the_title(); ?></a></h3>

										<a href="<?= the_permalink(); ?>" class="btn-sm"></a>

										<?php

										$post_categories = wp_get_post_categories(get_the_ID(), ['fields' => 'all']);

										foreach ($post_categories as $post_category) {
										?>
											<a href="<?= site_url() . '/category/' .  $post_category->slug; ?>" class="tag"><?= $post_category->name; ?></a>
										<?php
										}

										?>
									</div>
								</article>
						<?php

							endwhile;



						endif;
						?>
					</div>
					<?php
					//if ($num_all_posts > 4) :
					?>
					<div class="blog-btn">
						<button id="load-more" class="btn btn-primary btn-dark toggle-more">Load more</button>
					</div>
					<?php
					//endif;
					?>
				</div>
			</div>
		</div>
	</section>
</main>



<?php




get_footer();
