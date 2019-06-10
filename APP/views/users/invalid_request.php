<?php

use APP\Helpers\URL_Helper as URL;
use APP\Core\Session as Session;
?>
<!-- Page top section -->
<section class="page-top-section set-bg" data-setbg="<?= URL_ROOT ?>img/page-top-bg/1.jpg">
    <div class="page-info">
        <h2>Set Password, <?= $data['user_data']->email ?></h2>
        <div class="site-breadcrumb">
            <a href="<?= URL::baseURL('home') ?>">Home</a> /
            <a href="#">Users</a> /
            <span>Set New Password</span>
        </div>
    </div>
</section>
<!-- Page top end-->

<section class="contact-page">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-5">
                <div class="text-white text-center">
                    <h3>INVALID REQUEST</h3>
                    <h4><a style="color:#cc00cc" href="<?= URL::baseURL('home') ?>">Back to Home?</a></h4>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>




