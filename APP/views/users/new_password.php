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
                    <h3>Setup New Password</h3>
                    <div id="setup_new_password_resp"></div>
                    <form id="setup_new_password" class="contact-form">
                        <input type="password" placeholder="New Password" name="password">
                        <input type="password" placeholder="Confirm Password" name="confirm_password">
                        <input type="hidden" name="acc_key" value="<?= $data['acc_key'] ?>" >
                        <button class="site-btn" type="submit">Setup<img src="<?= URL_ROOT ?>img/icons/double-arrow.png" alt="#" /></button>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>



