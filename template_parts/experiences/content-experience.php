<?php
global $post;
?>
<article id="<?= $post->post_name; ?>" class="experiences-row">
    <div class="experiences-image">
        <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="Travemo Club">
    </div>

    <div class="experiences-text">
        <div class="title-default">
            <p><?= get_post_meta(get_the_ID(), 'location', true); ?></p>
            <h2><?= get_the_title(); ?></h2>
        </div>
        <div class="experiences-inner">

            <div class="experiences-columns">
                <?= get_the_content(); ?>
            </div>

            <a href="<?= get_post_meta(get_the_ID(), 'video', true); ?>" class="video-toggle">Watch the video</a>
            <!-- video popup je dolje u kodu -->
        </div>

    </div>
</article>