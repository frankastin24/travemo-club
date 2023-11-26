<?php
get_header();

get_template_part('template_parts/experiences/content', 'banner');



?>
<section class="pages experiences-page">
    <div class="container">

        <div class="experiences-wrapper">
            <?php

            if (have_posts()) : while (have_posts()) : the_post();

                    get_template_part('template_parts/experiences/content', 'experience');

                endwhile;
            endif;
            ?>

        </div>
    </div>
</section>
<?php
get_template_part('template_parts/experiences/content', 'cta');
get_footer();
