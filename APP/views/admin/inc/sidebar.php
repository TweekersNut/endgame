<?php

use APP\Helpers\URL_Helper as URL;
use APP\Models\Settings as Settings;
?>
<!-- Sidebar Holder -->
<nav id="sidebar">
    <div class="sidebar-header">
        <h1>
            <a href="<?= URL::baseURL('admin/index') ?>"><?= SITE_NAME ?> C.P</a>
        </h1>
        <span>T</span>
    </div>

    <div>
        <img src="<?= (new Settings)->getValue('site.logo')->_val ?>" width="100%" height="100px" alt="logo" />
    </div>

    <ul class="list-unstyled components">
        <li class="<?php if(URL::check('admin/index')){echo "active";} ?> ">
            <a href="<?= URL::baseURL('admin/index') ?>">
                <i class="fas fa-th-large"></i>
                Dashboard
            </a>
        </li>

        <li class="<?php if(URL::check('admin/users') || URL::check('admin/users/add')){echo "active";} ?> ">
            <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false">
                <i class="fas fa-users"></i>
                User
                <i class="fas fa-angle-down fa-pull-right"></i>
            </a>
            <ul class="collapse list-unstyled" id="userSubmenu">
                <li>
                    <a href="<?= URL::baseURL('admin/users') ?>">View</a>
                </li>
                <li>
                    <a href="<?= URL::baseURL('admin/users/add') ?>">Add</a>
                </li>
            </ul>
        </li>
        
        <li class="<?php if(URL::check('admin/slider') || URL::check('admin/slider/add')){echo "active";} ?>">
            <a href="#sliderSubmenu" data-toggle="collapse" aria-expanded="false">
                <i class="fas fa-desktop"></i>
                Slider
                <i class="fas fa-angle-down fa-pull-right"></i>
            </a>
            <ul class="collapse list-unstyled" id="sliderSubmenu">
                <li>
                    <a href="<?= URL::baseURL('admin/slider') ?>">View</a>
                </li>
                <li>
                    <a href="<?= URL::baseURL('admin/slider/add') ?>">Add</a>
                </li>
            </ul>
        </li>
        
        <li class="<?php if(URL::check('admin/advert') || URL::check('admin/advert/add')){echo "active";} ?>">
            <a href="#advertSubmenu" data-toggle="collapse" aria-expanded="false">
                <i class="far fa-window-restore"></i>
                Advertisement Banners
                <i class="fas fa-angle-down fa-pull-right"></i>
            </a>
            <ul class="collapse list-unstyled" id="advertSubmenu">
                <li>
                    <a href="<?= URL::baseURL('admin/advert') ?>">View</a>
                </li>
                <li>
                    <a href="<?= URL::baseURL('admin/advert/add') ?>">Add</a>
                </li>
            </ul>
        </li>
        
        <li class="<?php if(URL::check('admin/blog') || URL::check('admin/blog/add') || URL::check('admin/blog/category') || URL::check('admin/blog/genre') || URL::check('admin/blog/platform') ){echo "active";} ?>">
            <a href="#blogSubmenu" data-toggle="collapse" aria-expanded="false">
                <i class="fab fa-blogger-b"></i>
                    Blog
                <i class="fas fa-angle-down fa-pull-right"></i>
            </a>
            <ul class="collapse list-unstyled" id="blogSubmenu">
                <li>
                    <a href="<?= URL::baseURL('admin/blog') ?>">View Posts</a>
                </li>
                <li>
                    <a href="<?= URL::baseURL('admin/blog/add') ?>">Create Posts</a>
                </li>
                <li>
                    <a href="<?= URL::baseURL('admin/blog/category') ?>">Categories</a>
                </li>
                <li>
                    <a href="<?= URL::baseURL('admin/blog/genre') ?>">Genre</a>
                </li>
                <li>
                    <a href="<?= URL::baseURL('admin/blog/platform') ?>">Platform</a>
                </li>
            </ul>
        </li>
        
        <li class="<?php if(URL::check('admin/newsletter') || URL::check('admin/newsletter/subscribers') || URL::check('admin/newsletter/send') || URL::check('admin/newsletter/add')){echo "active";} ?>">
            <a href="#newsletterSubmenu" data-toggle="collapse" aria-expanded="false">
                <i class="fas fa-newspaper"></i>
                    Newsletter
                <i class="fas fa-angle-down fa-pull-right"></i>
            </a>
            <ul class="collapse list-unstyled" id="newsletterSubmenu">
                <li>
                    <a href="<?= URL::baseURL('admin/newsletter/subscribers') ?>">Subscribers</a>
                </li>
                <li>
                    <a href="<?= URL::baseURL('admin/newsletter/send') ?>">Send News</a>
                </li>
            </ul>
        </li>
        
        
        <li class="<?php if(URL::check('admin/contact')){echo "active";} ?> ">
            <a href="<?= URL::baseURL('admin/contact') ?>">
                <i class="fas fa-phone"></i>
                Contact Queries
            </a>
        </li>
        
        <li class="<?php if(URL::check('admin/settings')){echo "active";} ?> ">
            <a href="<?= URL::baseURL('admin/settings') ?>">
                <i class="fas fa-cogs"></i>
                Settings
            </a>
        </li>
        
        <hr />
        <li class="<?php if(URL::check('admin/bugreport')){echo "active";} ?> ">
            <a href="<?= URL::baseURL('admin/bugreport') ?>">
                <i class="fas fa-bug"></i>
                Bug Reporting
            </a>
        </li>
        
        <li class="<?php if(URL::check('admin/requestFeature') || URL::check('admin/requestFeature/send')){echo "active";} ?> ">
            <a href="<?= URL::baseURL('admin/requestFeature') ?>">
                <i class="fas fa-code"></i>
                Request Feature
            </a>
        </li>

    </ul>
</nav>

<!-- Page Content Holder -->
<div id="content">
    <!-- top-bar -->
    <nav class="navbar navbar-default mb-xl-5 mb-4">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <ul class="top-icons-agileits-w3layouts float-right">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <i class="far fa-user"></i>
                    </a>
                    <div class="dropdown-menu drop-3">
                        <div class="profile d-flex mr-o">
                            <div class="profile-l align-self-center">
                                <img src="<?= $data['user_data']->avatar ?>" class="img-fluid mb-3" alt="Responsive image">
                            </div>
                            <div class="profile-r align-self-center">
                                <h3 class="sub-title-w3-agileits"><?= $data['user_data']->username ?></h3>
                                <a href="mailto:<?= $data['user_data']->email ?>"><?= $data['user_data']->email ?></a>
                            </div>
                        </div>
                        <a href="<?= URL::baseURL('admin/users/editprofile'); ?>" class="dropdown-item mt-3">
                            <h4>
                                <i class="far fa-user mr-3"></i>My Profile</h4>
                        </a>
                        
                        <a href="#" class="dropdown-item mt-3">
                            <h4>
                                <i class="far fa-thumbs-up mr-3"></i>Support</h4>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= URL::baseURL('users/logout') ?>">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!--// top-bar -->

    <div class="container-fluid">
        <div class="row">
