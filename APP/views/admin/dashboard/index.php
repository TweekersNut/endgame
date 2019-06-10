<?php

use APP\Helpers\URL_Helper as URL;
?>

<!-- Stats -->
<div class="outer-w3-agile col-xl">
    <div class="stat-grid p-3 d-flex align-items-center justify-content-between bg-primary">
        <div class="s-l">
            <h5>Total Blog Posts</h5>
            <p class="paragraph-agileits-w3layouts text-white">Category : <?= $data['total_blog_category_count'] ?> | Genre : <?= $data['total_blog_genre_count'] ?> | Platform : <?= $data['total_blog_platform_count'] ?></p>
        </div>
        <div class="s-r">
            <h6><?= $data['total_blog_posts_count']; ?>
                <i class="far fa-edit"></i>
            </h6>
        </div>
    </div>
    <div class="stat-grid p-3 mt-3 d-flex align-items-center justify-content-between bg-success">
        <div class="s-l">
            <h5>Total Users</h5>
            <p class="paragraph-agileits-w3layouts">Active : <?= $data['total_users_active_count'] ?>| In-Active : <?= $data['total_users_inactive_count'] ?></p>
        </div>
        <div class="s-r">
            <h6><?= $data['total_users_count'] ?>
                <i class="far fa-smile"></i>
            </h6>
        </div>
    </div>
    <div class="stat-grid p-3 mt-3 d-flex align-items-center justify-content-between bg-danger">
        <div class="s-l">
            <h5>Newsletter Subscribers</h5>
            <p class="paragraph-agileits-w3layouts">Active : <?= $data['total_newsletter_active_count'] ?> | In-Active : <?= $data['total_newsletter_inactive_count'] ?></p>
        </div>
        <div class="s-r">
            <h6><?= $data['total_newsletter_sub_count'] ?>
                <i class="fas fa-tasks"></i>
            </h6>
        </div>
    </div>
    <div class="stat-grid p-3 mt-3 d-flex align-items-center justify-content-between bg-warning">
        <div class="s-l">
            <h5>Contact Requests</h5>
            <p class="paragraph-agileits-w3layouts">Resolved : <?= $data['total_contact_resolve_count'] ?> | New : <?= $data['total_contact_new_count'] ?></p>
        </div>
        <div class="s-r">
            <h6><?= $data['total_contact_count'] ?>
                <i class="fas fa-users"></i>
            </h6>
        </div>
    </div>
</div>
<!--// Stats -->


