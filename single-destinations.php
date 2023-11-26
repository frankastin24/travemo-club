<?php
get_header();
?>
<main>
    <section class="top-image" style="background-image:url(<?= IMG_URL; ?>/experiences.jpg)">
        <div class="top-text title-default title-center">
            <h1>Destinations</h1>
            <p>Explore unique charm of the region of Adriatic coast and neighbouring countries.</p>
        </div>
    </section>
    <section class="pages destinations-page">
        <div class="container">

            <div class="page-wrapper">

                <?php get_template_part('template_parts/destinations/content', 'nav'); ?>



                <div class="page-content destinations-page-content">

                    <?= the_content(); ?>
                    <div class="destinations-slider">

                    </div>
                    <?php get_template_part('template_parts/destinations/content', 'accordian'); ?>
                </div>
            </div>


        </div>
        </div>
        </div>
    </section>


    <section class="cta-section">
        <img src="<?= IMG_URL; ?>/cta4.jpg" alt="Travemo Club">
        <div class="cta-text">
            <div class="container container-sm">
                <h2 class="hidden">Begin your journey here.</h2>
                <a href="" class="btn btn-primary hidden"><span>Contact us</span><img src="<?= IMG_URL; ?>/arrow-right-white.svg" alt="Travemo Club"></a>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
