<section class="testimonials">
    <div class="container">
        <div class="testimonials-slider">
            <?php
            $testimonials = new WP_Query(['post_type' => 'testimonials']);
            foreach ($testimonials->posts as $index => $post) :
            ?>
                <article class="testimonial-slide <?= $index == 0 ? 'active' : ''; ?>">
                    <p class="hidden   "><?= $post->post_content ?></p>
                    <p class="author hidden    full-visible"><span class="line-author"></span><?= $post->post_title ?></p>
                </article>
            <?php
            endforeach;
            ?>
        </div>
    </div>





    <div class="testimonials-arrows">
        <div class="custom-prev"></div>
        <div class="custom-next"></div>
    </div>


</section>