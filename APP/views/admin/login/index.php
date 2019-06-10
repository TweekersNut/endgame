<?php

use APP\Helpers\URL_Helper as URL;
use APP\Models\Settings as Settings;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title><?= $data['page_title'] ? $data['page_title'] : SITE_NAME ?></title>
	<meta charset="UTF-8">
	<meta name="description" content="<?= isset($data['page_desc'])  ? $data['page_desc'] : 'Developed By TweekersNut Network' ?>">
	<meta name="keywords" content="<?= isset($data['page_key']) ? $data['page_key'] : 'TweekersNut,Network' ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
        <link href="<?= (new Settings)->getValue('site.favicon')->_val ?>" rel="shortcut icon"/>
        <script>
            addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>
        <!-- //Meta Tags -->

        <!-- Style-sheets -->
        <!-- Bootstrap Css -->
        <link href="<?= URL_ROOT ?>admin/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <!-- Bootstrap Css -->
        <!-- Common Css -->
        <link href="<?= URL_ROOT ?>admin/css/style.css" rel="stylesheet" type="text/css" media="all" />
        <!--// Common Css -->
        <!-- Fontawesome Css -->
        <link href="<?= URL_ROOT ?>admin/css/fontawesome-all.css" rel="stylesheet">
        <!--// Fontawesome Css -->
        <!--// Style-sheets -->

        <!--web-fonts-->
        <link href="//fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!--//web-fonts-->
    </head>

    <body>
        <div class="bg-page py-5">
            <div class="container">
                <!-- main-heading -->
                <h2 class="main-title-w3layouts mb-2 text-center text-white"><?= SITE_NAME ?> Admin. Login</h2>
                <!--// main-heading -->
                <div class="form-body-w3-agile text-center w-lg-50 w-sm-75 w-100 mx-auto mt-5">
                    <!-- Responce -->
                    <div id="admin_login_resp"></div>
                    
                    <form id="admin_login" action="#" method="post">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email" required="">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required="">
                        </div>
                        <div class="d-sm-flex justify-content-between">
                            <div class="form-check col-md-6 text-sm-left text-center">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Remember me</label>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-primary error-w3l-btn mt-sm-5 mt-3 px-4">Login</button>
                    </form>
                    
                    <h1 class="paragraph-agileits-w3layouts mt-2">
                        <a href="<?= URL::baseURL('home') ?>">Back to Home</a>
                    </h1>
                </div>

                <!-- Copyright -->
                <div class="copyright-w3layouts py-xl-3 py-2 mt-xl-5 mt-4 text-center">
                    <p>&copy; <?= date('Y') ?> <?= SITE_NAME ?> . All Rights Reserved | Develop By 
                        <a href="https://tweekersnut.com">TweekersNut Network</a>
                    </p>
                </div>
                <!--// Copyright -->
            </div>
        </div>

        <script type='text/javascript'>var URL_ROOT = "<?= URL_ROOT ?>";</script>
        <!-- Required common Js -->
        <script src='<?= URL_ROOT ?>admin/js/jquery-2.2.3.min.js'></script>
        <!-- //Required common Js -->

        <!-- Js for bootstrap working-->
        <script src="<?= URL_ROOT ?>admin/js/bootstrap.min.js"></script>
        <!-- //Js for bootstrap working -->
        
        <!-- Js For Core working -->
        <script src="<?= URL_ROOT ?>admin/js/core.js"></script>

    </body>

</html>
