<?php

get_header();
?>

<main>

    <section class="top-image" style="background-image:url(<?= IMG_URL; ?>about-us.jpg)">
        <div class="top-text title-default title-center">
            <h1>About us</h1>
        </div>
    </section>

    <section class="pages about-page">
        <div class="container">

            <div class="about-title">
                <h2>We are your destination management trusted partner here to design unforgettable travel experiences for our clients.</h2>
            </div>

            <div class="about-text">
                <p>TRAVEMO CLUB was founded by a team of travel multilingual enthusiasts who wanted to provide unique travel experiences to clients around the world. With years of experience working in travel industry, our team has developed insider knowledge and expertise to curate customized travel itineraries that suit our clients' specific needs and desires.</p>
            </div>

            <div class="team">
                <article>
                    <div class="team-image">
                        <img src="<?= IMG_URL; ?>/ivana.jpg" alt="Travemo Club">
                    </div>
                    <h4>Ivana Mikec</h4>
                    <p>Founder &amp; president</p>
                </article>
                <article>
                    <div class="team-image">
                        <img src="<?= IMG_URL; ?>/marijan.jpg" alt="Travemo Club">
                    </div>
                    <h4>Marijan Mikec</h4>
                    <p>Founder &amp; president</p>
                </article>
                <article>
                    <div class="team-image">
                        <img src="<?= IMG_URL; ?>/ana.jpg" alt="Travemo Club">
                    </div>
                    <h4>Ana Anic</h4>
                    <p>Marketing</p>
                </article>
            </div>
            <div class="about-text">
                <p>At our agency, we offer a range of services to ensure that every aspect of your travel experience is taken care of. We pride ourselves on putting the new hot spots on the travel map, including the immaculate Mediterranean hubs of Croatia and Montenegro, the picturesque alpine settings of Slovenia, and new and exotic destinations such as Bosnia and Herzegovina, Serbia, Kosovo, Albania and North Macedonia.</p>
                <p>At TRAVEMO CLUB, we pride ourselves on being a one-stop shop for our partners, carefully crafting personalized programs to ensure that our clients get the absolute best from their trip. So why not join us for the experience of a lifetime? </p>
                <p> Let us show you the magic of the West Balkans and create unforgettable memories that will last a lifetime.</p>
            </div>
        </div>
    </section>
    <section class="cta-section">
        <img src="<?= IMG_URL; ?>/cta5.jpg" alt="Travemo Club">
        <div class="cta-text">
            <div class="container container-sm">
                <h2 class="hidden">Create unforgettable memories.</h2>
                <a href="<?= site_url(); ?>/contact" class="btn btn-primary hidden"><span>Contact us</span><img src="<?= IMG_URL; ?>/arrow-right-white.svg" alt="Travemo Club"></a>
            </div>
        </div>
    </section>
</main>
<?php

get_footer();
?>