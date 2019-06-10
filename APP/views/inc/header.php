<?php
use APP\Helpers\URL_Helper as URL; 
use APP\Core\Session as Session;
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

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i" rel="stylesheet">


	<!-- Stylesheets -->
	<!--link rel="stylesheet" href="<?= URL_ROOT ?>css/bootstrap.min.css"/-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= URL_ROOT ?>css/slicknav.min.css"/>
	<link rel="stylesheet" href="<?= URL_ROOT ?>css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="<?= URL_ROOT ?>css/magnific-popup.css"/>
	<link rel="stylesheet" href="<?= URL_ROOT ?>css/animate.css"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="<?= URL_ROOT ?>css/style.css"/>


	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section">
		<div class="header-warp">
			<div class="header-social d-flex justify-content-end">
				<!--p></p>
				<a href="#"><i class="fa fa-facebook"></i></a>
				<a href="#"><i class="fa fa-twitter"></i></a-->
				
			</div>
			<div class="header-bar-warp d-flex">
				<!-- site logo -->
				<a href="#" class="site-logo">
                                        <img src="<?= (new Settings)->getValue('site.logo')->_val ?>" alt="">
				</a>
				<nav class="top-nav-area w-100">
					<div class="user-panel">
                                                <?php if(Session::exists('isLoggedIn')): ?>
                                            <a href="<?= URL::baseURL('users/logout') ?>">Logout?</a>  <a href="<?= URL::baseURL('admin/index') ?>">/ Admin. Area</a>
                                                <?php else: ?>
                                                    <a href="<?= URL::baseURL('users/login') ?>">Login</a>  <!--a href="">/ Register</a-->
                                                <?php endif; ?>
						
					</div>
					<!-- Menu -->
					<ul class="main-menu primary-menu">
						<li><a href="<?= URL::baseURL('home') ?>">Home</a></li>
						<li><a href="<?= URL::baseURL('blog/games') ?>">Games</a>
							<!--ul class="sub-menu">
								<li><a href="game-single.html">Game Singel</a></li>
							</ul-->
						</li>
						<li><a href="<?= URL::baseURL('blog/reviews') ?>">Reviews</a></li>
						<li><a href="<?= URL::baseURL('blog/') ?>">Blog</a></li>
						<li><a href="<?= URL::baseURL('contact') ?>">Contact</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</header>
	<!-- Header section end -->
