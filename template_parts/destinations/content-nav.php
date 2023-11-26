<aside class="page-aside">
    <ul>
        <?php
        $destinations = new WP_Query(['post_type' => 'destinations', 'posts_per_page' => -1]);

        foreach ($destinations->posts as $destination) {


        ?>
            <li><a href="<?= get_the_permalink($destination->ID); ?>"><?= $destination->post_title; ?></a></li>
        <?php
        }
        ?>
    </ul>
</aside>