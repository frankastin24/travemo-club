<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vdtheme
 */

?>

<footer>
	<div class="container container-sm">
		<div class="footer-wrapper">
			<article class="footer-left">
				<div class="footer-box">
					<h4>Contact</h4>
					<p>T: <a href="tel:+385 91 872 9887">+385 91 872 9887</a><br>
						E: <a href="mailto:info@travemoclub.com">info@travemoclub.com</a>
					</p>
					<p>TRAVEMO CLUB d.o.o.<br>
						Avenija Marina Držića 4<br><br>10000 Zagreb

					</p>
				</div>
				<div class="footer-box">
					<h4>Connect with us</h4>
					<div class="social">
						<a href="" target="_blank">Instagram</a>
						<a href="" target="_blank">Facebook</a>

					</div>
				</div>
			</article>
			<article class="footer-right">
				<h4>Stay up to date with our latest travel destinations and offers</h4>
				<form action="">
					<input type="text" placeholder="Enter email address">
					<button class="btn-arrow"></button>

				</form>
				<p>By submitting this form, I agree to having my personal and contact information processed and used for the purpose of marketing communications. More details at <a href="">Privacy Policy</a> and <a href="">Terms and Conditions</a>.</p>
			</article>

		</div>
		<div class="copyright">
			<ul>
				<li><a href="<? site_url(); ?>/terms-and-conditions"">Terms &amp; conditions</a></li>
				<li><a href=" <? site_url(); ?>/privacy-policy">Privacy policy</a></li>
				<li><a href=" <? site_url(); ?>/impressum">Impressum</a></li>
				<li><a href="<? site_url(); ?>/photo-credit">Photo credits</a></li>
			</ul>
			<div class="copy">
				<span>© 2023 Travemo club, All Rights Reserved</span>
				<a title="Izrada web stranica" href="http://virtus-dizajn.com/izrada-web-stranica/" class="none">Izrada web stranica</a>
				<a title="Web dizajn" href="https://virtus-dizajn.com/web-dizajn/" class="none">Web dizajn</a>
				<!-- <a target="_blank" href="http://virtus-dizajn.com/" class="v text-r" title="Virtus Dizajn"><img alt="Virtus dizajn - internet rješenja" src="images/virtus.svg" width="176" height="11"></a> -->

			</div>
		</div>
	</div>
</footer>


<?php wp_footer(); ?>

</body>

</html>