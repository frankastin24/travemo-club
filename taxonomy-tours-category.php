<?php
get_header();

get_template_part('template_parts/tours/content', 'banner');

$categories = get_terms(array(
    'taxonomy'   => 'tours-category',
    'hide_empty' => false,
    'orderby' => 'term_order'
));

?>
<section class="pages">
    <div class="container">
        <div class="page-wrapper">
            <aside class="page-aside">
                <ul>
                    <li><a href="<?= site_url(); ?>/tour-collection">All</a></li>
                    <?php
                    foreach ($categories as $category) {


                    ?>

                        <li><a href="<?= site_url(); ?>/tour-categories/<?= $category->slug; ?>"><?= $category->name; ?></a></li>
                    <?php
                    }
                    ?>


                </ul>
            </aside>
            <div class="page-content">
                <?php
                if (have_posts()) : while (have_posts()) : the_post();
                        get_template_part('template_parts/tours/content', 'tour');
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
<?php
get_template_part('template_parts/tours/content', 'experiences');
get_footer();
