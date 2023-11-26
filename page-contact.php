<?php
get_header();
?>

<main>

    <?php
    $errors = [
        'form_name' => false,
        'email' => false,
        'inquiry' => false,
    ];
    $form_success = false;

    if (isset($_POST['is_form'])) {
        $is_form_valid = true;
        if (empty($_POST['form_name'])) {
            $errors['form_name'] = true;
            $is_form_valid = false;
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = true;
            $is_form_valid = false;
        }
        if (empty($_POST['inquiry'])) {
            $errors['inquiry'] = true;
            $is_form_valid = false;
        }

        if ($is_form_valid) {

            $blogusers = get_users('role=Administrator');

            foreach ($blogusers as $user) {

                $message = '<h1>New Website Enquiry</h1><table><tr><th>Name</th><td>' . sanitize_text_field($_POST['form_name']) . '</td></tr>';
                $message .= '<tr><th>Email</th><td>' . sanitize_email($_POST['email']) . '</td></tr>';
                $message .= '<tr><th>Purpose of inquiry</th><td>' . sanitize_text_field($_POST['purpose']) . '</td></tr>';
                $message .= '<tr><th>Inquiry</th><td>' . sanitize_text_field($_POST['inquiry']) . '</td></tr>';

                wp_mail($user->user_email, 'New website inquirey', $message);
                $form_success = true;
            }
        }
    }
    ?>


    <section class="top-image" style="background-image:url(<?= IMG_URL; ?>/contact-page.jpg)">
        <div class="top-text title-default title-center">
            <h1>Contact</h1>
        </div>
    </section>
    <section class="pages contact-page">
        <div class="container">
            <?php


            if ($form_success) {


            ?>
                <div class="contact-text">
                    <div class="title-default">
                        <h2>Thank you for your inquiry.</h2>
                    </div>
                    <p>We will be in touch as soon as possible.</p>
                </div>
            <?php
            } else {
            ?>

                <div class="contact-text">
                    <div class="title-default">
                        <h2>Tell us about your perfect travel experience.</h2>
                    </div>
                    <p>Please complete the form and we will reply to you as soon as possible.</p>
                </div>
                <div class="contact-form">
                    <form method="POST" action="<?= site_url() ?>/contact">

                        <fieldset>
                            <input class="<?= $errors['form_name'] ? 'error' : ''; ?>" name="form_name" type="text" value="<?= isset($_POST['form_name']) ? $_POST['form_name'] : ''; ?>" placeholder=" ">
                            <label for="">Your name *</label>
                            <p class="error-message" style="display:<?= $errors['form_name'] ? 'block' : 'none'; ?>">Name is a required field</p>
                        </fieldset>
                        <fieldset>
                            <input class="<?= $errors['email'] ? 'error' : ''; ?>" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>" type="email" placeholder=" ">
                            <label for="">Your email *</label>
                            <p class="error-message" style="display:<?= $errors['email'] ? 'block' : 'none'; ?>">Email is a required field and must be a valid email address</p>
                        </fieldset>
                        <fieldset>
                            <select name="purpose" id="">
                                <option value=" ">Select</option>
                                <option value="proposal">Itinerary proposal</option>
                                <option value="collaboration">Collaboration</option>
                            </select>
                            <label for="">Select purpose of inquiry *</label>
                        </fieldset>
                        <fieldset class="textarea-fieldset">
                            <textarea class="<?= $errors['inquiry'] ? 'error' : ''; ?>" value="<?= isset($_POST['inquiry']) ? $_POST['inquiry'] : ''; ?>" name="inquiry" id="" cols="10" rows="5" placeholder=" "></textarea>
                            <label for="">Your Inquiry *</label>
                            <p class="error-message" style="display:<?= $errors['inquiry'] ? 'block' : 'none'; ?>">Inquiry is a required field</p>
                        </fieldset>
                        <fieldset class="fieldset-text">
                            <p>By submitting this form, I agree to having my personal and contact information processed and used for the purpose of marketing communications. More details at <a href="">Privacy Policy</a> and <a href="">Terms and Conditions</a>.</p>
                        </fieldset>
                        <fieldset class="form-btn">
                            <input type="hidden" name="is_form" value="true" />
                            <button type="submit" class="btn btn-primary btn-dark"><span>Send inquiry</span><img src="<?= IMG_URL; ?>/arrow-right-white.svg" alt="Travemo Club"></button>
                        </fieldset>
                    </form>
                </div>
            <?php

            }
            ?>




        </div>
    </section>
    <section class="contact-info">
        <div class="container">
            <article>
                <h4>Address</h4>
                <p>TRAVEMO CLUB d.o.o. <br> Avenija Marina Držića 4</p>
                <p>10000 Zagreb</p>
            </article>
            <article>
                <h4>Contact</h4>
                <p>
                    T: <a href="tel:+385 91 872 9887">+385 91 872 9887</a><br>
                    E: <a href="mailto:info@travemoclub.com">info@travemoclub.com </a>
                </p>
            </article>
            <article>
                <h4>Working hours</h4>
                <p>
                    Mon - Fri: 8:00 am - 8:00 pm<br>
                    Sat: 8:00 am - 12:00 pm
                </p>
            </article>
        </div>
    </section>
</main>

<?php

get_footer();
?>