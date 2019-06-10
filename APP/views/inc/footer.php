<?php 
use APP\Helpers\URL_Helper as URL;
use APP\Models\Settings as Settings;
?>
<!-- Newsletter section -->
<section class="newsletter-section">
    <div class="container">
        <h2>Subscribe to our newsletter</h2>
        <div id="newsletter_form_resp"></div>
        <form class="newsletter-form" id="newsletter_form">
            <input type="email" name="email" placeholder="ENTER YOUR E-MAIL">
            <button class="site-btn" type="submit">subscribe <img src="<?= URL_ROOT ?>img/icons/double-arrow.png" alt="#" /></button>
        </form>
    </div>
</section>
<!-- Newsletter section end -->


<!-- Footer section -->
<footer class="footer-section">
    <div class="container">
        <div class="footer-left-pic">
            <img src="<?= URL_ROOT ?>img/footer-left-pic.png" alt="">
        </div>
        <div class="footer-right-pic">
            <img src="<?= URL_ROOT ?>img/footer-right-pic.png" alt="">
        </div>
        <a href="#" class="footer-logo">
            <img src="<?= (new Settings)->getValue('site.logo')->_val ?>" alt="">
        </a>
        <ul class="main-menu footer-menu">
            <li><a href="<?= URL::baseURL('home') ?>">Home</a></li>
            <li><a href="<?= URL::baseURL('blog/games') ?>">Games</a></li>
            <li><a href="<?= URL::baseURL('blog/reviews') ?>">Reviews</a></li>
            <li><a href="<?= URL::baseURL('blog/') ?>">Blog</a></li>
            <li><a href="<?= URL::baseURL('contact') ?>">Contact</a></li>
        </ul>
        <div class="footer-social d-flex justify-content-center">
            <a href="https://facebook.com/tweekersnut"><i class="fa fa-facebook"></i></a>
            <a href="https://twitter.com/tweekersnut"><i class="fa fa-twitter"></i></a>
        </div>
        <div class="copyright"><a href="#"><?= SITE_NAME ?></a> <?= date('Y') ?>  All rights reserved(By TweekersNut Network)</div>
    </div>
</footer>
<!-- Footer section end -->


<!--====== Javascripts & Jquery ======-->
<script>var URL_ROOT = "<?= URL_ROOT ?>"</script>
<script src="<?= URL_ROOT ?>js/jquery-3.2.1.min.js"></script>
<script src="<?= URL_ROOT ?>js/bootstrap.min.js"></script>
<script src="<?= URL_ROOT ?>js/jquery.slicknav.min.js"></script>
<script src="<?= URL_ROOT ?>js/owl.carousel.min.js"></script>
<script src="<?= URL_ROOT ?>js/jquery.sticky-sidebar.min.js"></script>
<script src="<?= URL_ROOT ?>js/jquery.magnific-popup.min.js"></script>
<script src="<?= URL_ROOT ?>js/main.js"></script>

</body>

</html>