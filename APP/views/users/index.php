<?php
use APP\Helpers\URL_Helper as URL;
use APP\Core\Session as Session;
?>
<!-- Page top section -->
<section class="page-top-section set-bg" data-setbg="<?= URL_ROOT ?>img/page-top-bg/4.jpg">
    <div class="page-info">
        <h2>Welcome, <?= Session::get('email') ?></h2>
        <div class="site-breadcrumb">
            <a href="<?= URL::baseURL('home') ?>">Home</a> /
            <a href="#">Users</a> /
            <span><?= Session::get('email') ?> Index</span>
        </div>
    </div>
</section>
<!-- Page top end-->

<section class="contact-page">
    <div class="container">
        <div class="row">
            <div class="text-white">
                  Welcome 
            </div>
        </div>
    </div>
</section>
