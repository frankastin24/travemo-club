<?php
get_header();
?>
<main>
    <section class="top-height"></section>
    <section class="space blog-post-page">
        <div class="container">
            <div class="title-default title-center">
                <?php

                $post_categories = wp_get_post_categories(get_the_ID(), ['fields' => 'all']);

                foreach ($post_categories as $post_category) {
                ?>
                    <a href="<?= site_url() . '/category/' . $post_category->slug; ?>" class="tag"><?= $post_category->name; ?></a>
                <?php
                }

                ?>

                <h1><?= the_title(); ?></h1>
                <div class="blog-date-post"><?= get_the_date('F j, Y') ?> | 7 min read</div>
            </div>
            <div class="blog-post-image">
                <img src="<?= get_the_post_thumbnail_url(); ?>" alt="Travemo Club">
            </div>
            <?= the_content(); ?>
        </div>
    </section>
</main>

<?php
get_footer();
?>