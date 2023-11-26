<?php

get_header();
?>

<section style="background-size:cover;background-position:center;background-image:url('')" class="single-tour-top">

    <img src="<?= get_post_meta(get_the_ID(), 'headerImage', true); ?>" />

</section>

<section class="pages single-tour-page">
    <div class="container">
        <div class="single-tour-container">
            <div class="title-default">
                <h1><?= the_title(); ?></h1>
            </div>
            <p class="duration">Suggested duration: 11 days / 10 nights</p>
            <div class="single-tour-icons">
                <img src="<?= IMG_URL; ?>/" />
            </div>
            <div class="single-tour-text">
                <?= the_content(); ?>
            </div>

        </div>
        <div class="tour-gallery-container">
            <div class="tour-gallery">



            </div>
        </div>


    </div>
</section>
<section class="itinerary-plan">

    <article class="itinerary-text">
        <div class="container">
            <div class="itinerary-inner">

                <div class="title-default">
                    <h2>Itinerary plan</h2>
                </div>

                <ul>

                    <li>2 nights in Split</li>

                </ul>

            </div>
            <?php
            global $post;
            ?>
            <div class="itinerary-map-mobile">
                <img src="<?= IMG_URL; ?>/<?= sanitize_title($post->post_name); ?>-mobile-map.svg" alt="Travemo Club">
            </div>
        </div>
    </article>
    <article class="itinerary-map">
        <img src="<?= IMG_URL; ?>/<?= sanitize_title($post->post_name); ?>-map.svg" alt="Travemo Club">
    </article>

</section>
<section class="similar-tours">
    <div class="container">
        <div class="title-default title-center">
            <h2>Similar tours</h2>
        </div>
        <div class="similar-wrapper">

            <?php

            $tour_category = wp_get_post_terms(get_the_ID(), 'tours-category');

            if (count($tour_category) > 0) {
                $similar_tours = new WP_Query(['tax_query' => array(
                    array(
                        'taxonomy' => 'tours-category',
                        'field' => 'slug',
                        'terms' => $tour_category[0]->slug,

                    )
                ), 'post__not_in' => [get_the_ID()]]);

                foreach ($similar_tours->posts as $similar_tour) {

            ?>

                    <article>
                        <a href="<?= get_the_permalink($similar_tour->ID); ?>" class="tours-image"><img src="<?= get_the_post_thumbnail_url($similar_tour->ID, 'full'); ?>" alt="Travemo Club"></a>
                        <h4><a href="<?= get_the_permalink($similar_tour->ID); ?>"><span> <?= $similar_tour->post_title ?></span><img src="<?= IMG_URL; ?>/arrow-right.svg" alt="Travemo Club"></a></h4>
                        <p><?= get_post_meta($similar_tour->ID, 'locations', true); ?></p>
                    </article>
            <?php

                }
            }



            ?>
        </div>
    </div>
</section>
<section class="cta-section">
    <img src="<?= IMG_URL; ?>/cta2.jpg" alt="Travemo Club" />
    <div class="cta-text">
        <div class="container container-sm">
            <h2 class="hidden">Begin your journey here.</h2>
            <a href="" class="btn btn-primary hidden"><span>Contact us</span><img src="<?= IMG_URL; ?>/arrow-right-white.svg" alt="Travemo Club" /></a>
        </div>
    </div>
</section>
</main>

<?php

get_footer();
