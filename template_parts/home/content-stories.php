<section class="stories">
    <div class="container container-sm">
        <div class="title-default title-center hidden visible animate__animated animate__fadeInUp full-visible">
            <h2>Travel stories</h2>
        </div>
        <div class="stories-mobile-wrapper">
            <div class="stories-wrapper hidden   ">
                <?php
                $blogposts = new WP_Query(['post_type' => 'post']);
                foreach ($blogposts->posts as $index => $post) :
                ?>
                    <article>
                        <a href="<?= get_the_permalink($post->ID); ?>" class="stories-image"><img src="<?= get_the_post_thumbnail_url($post->ID); ?>" alt="Travemo Club"></a>
                        <div class="stories-date"><?= get_the_date('F j, Y', $post->ID) ?>.</div>
                        <h3><a href="<?= get_the_permalink($post->ID); ?>"><?= $post->post_title ?></a></h3>
                        <a href="" class="btn-sm"></a>
                    </article>
                <?php

                endforeach;
                ?>

            </div>
        </div>
    </div>
</section>