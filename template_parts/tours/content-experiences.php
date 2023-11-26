<section class="tours-section recommended">

    <div class="container container-sm">
        <div class="title-default title-center hidden visible animate__animated animate__fadeInUp full-visible">
            <h2>Recommended experiences</h2>
            <p>Discover the essence of a destination with our tailored experiences</p>
        </div>
    </div>

    <div class="tours-touch">
        <div class="tours-cursor">
            <p>Drag</p>
            <img src="<?= IMG_URL; ?>/arrow-right.svg" alt="Travemo Club">
        </div>
        <div class="tours-wrapper hidden visible animate__animated animate__fadeIn">
            <div class="tours-wrapper-inner">
                <?php
                $home = get_post(6);
                echo $home->post_content;
                ?>
            </div>

        </div>


    </div>
    </div>

</section>