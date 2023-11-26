<article>
    <a href="<?= get_the_permalink(); ?>" class="tours-image"><img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="Travemo Club"></a>
    <h4><a href="<?= get_the_permalink(); ?>"><span><?= get_the_title(); ?> </span><img src="<?= IMG_URL; ?>/arrow-right.svg" alt="Travemo Club"></a></h4>
    <p><?= get_post_meta(get_the_ID(), 'locations', true); ?></p>
</article>