<?php

use APP\Helpers\URL_Helper as URL;
?>
<!-- Page top section -->
<section class="page-top-section set-bg" data-setbg="<?= URL_ROOT ?>img/page-top-bg/4.jpg">
    <div class="page-info">
        <h2>Login</h2>
        <div class="site-breadcrumb">
            <a href="<?= URL::baseURL('home') ?>">Home</a> /
            <a href="#">Users</a> /
            <span>Login</span>
        </div>
    </div>
</section>
<!-- Page top end-->

<!-- Login page -->
<section class="contact-page">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xl-3 col-lg-3">

            </div>

            <div class="col-md-6 col-xl-6 col-lg-6 text-center">
                <div class="row">
                    <div class="col-md-2 col-lg-2 col-xl-2"></div>
                    <div class="col-md-8 col-lg-8 col-xl-8 text-white text-center">
                        <h3>Please Login</h3>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2"></div>
                </div>

                <div id="login_form_resp"></div>
                <form class="contact-form" id="login_form">
                    <input type="email" placeholder="Your e-mail" name="email">
                    <input type="password" placeholder="Password" name="password">
                    <button class="site-btn" type="submit">Login<img src="<?= URL_ROOT ?>img/icons/double-arrow.png" alt="#" /></button>
                </form>
                <br /><br />
                <!-- Forgot Password -->
                <!-- Modal -->
                <div id="forgot_password" class="modal fade contact-page" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Forgot Password?</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row text-center">
                                    <div class="col-md4"></div>
                                    <div class="col-md4">
                                        <h4>Please enter your email.</h4>
                                        <br />
                                        <b>Password reset instructions will be email to your register account.</b>
                                        <div id="forgot_password_resp"></div>
                                        <form id="forgot_password">
                                            <div class="input-group">
                                                <input type="email" class="form-control" name="email" placeholder="E-mail">
                                            </div>
                                    </div>
                                    <div class="col-md4"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="site-btn" type="submit">Forgot<img src="<?= URL_ROOT ?>img/icons/double-arrow.png" alt="#" /></button>
                                </form>
                                <button class="site-btn" type="button" data-dismiss="modal">Close<img src="<?= URL_ROOT ?>img/icons/double-arrow.png" alt="#" /></button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Modal End -->
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-xl-4"></div>
                    <div class="col-md-4 col-lg-4 col-xl-4">
                        <a href="#" data-toggle="modal" data-target="#forgot_password">Forgot password?</a>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4"></div>
                </div>
                <!-- //Forgot Password -->
            </div>

            <div class="col-md-3 col-xl-3 col-lg-3">

            </div>
        </div>
    </div>
</section>