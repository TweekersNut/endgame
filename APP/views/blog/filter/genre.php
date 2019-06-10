<?php
use APP\Helpers\URL_Helper as URL;
?>
<!-- Page top section -->
<section class="page-top-section set-bg" data-setbg="<?= URL_ROOT ?>img/page-top-bg/2.jpg">
    <div class="page-info">
        <h2>Blog</h2>
        <div class="site-breadcrumb">
            <a href="<?= URL::baseURL('home') ?>">Home</a>  /
            <a href="<?= URL::baseURL('blog') ?>">Blog</a>  /
            <a href="#">Filter</span>  /
                <span><?= $data['gen_name'] ?></span>
        </div>
    </div>
</section>
<!-- Page top end-->

<!-- Genre page -->
<section class="blog-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-7">
                <ul class="blog-filter">
                </ul>
                <?php if (count($data['blog_posts_data']) > 0): ?>
                    <?php foreach ($data['blog_posts_data'] as $blgPostData): ?>
                        <div class="big-blog-item">
                            <?php
                            //process avatar
                            $img = (array) json_decode($blgPostData->img);
                            ?>
                            <img src="<?= $img[0] ?>" alt="#" class="blog-thumbnail">
                            <div class="blog-content text-box text-white">
                                <div class="top-meta"><?= explode(" ", $blgPostData->added_on)[0]; ?>  /  in <a href="#"><?= $blgPostData->Cat_Name ?></a></div>
                                <h3><?= $blgPostData->title ?></h3>
                                <p><?= $blgPostData->summery ?></p>
                                <a href="<?= URL::baseURL('blog/read/'. $blgPostData->id) ?>" class="read-more">Read More <img src="<?= URL_ROOT ?>img/icons/double-arrow.png" alt="#"/></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                <div class="big-blog-item">
                    <h3 class="text-white">No Posts Found.</h3>
                </div>
                <?php endif; ?>

                <div class="site-pagination">
                   
                </div>
            </div>
            <!-- Append Sidebar -->
            <?php $this->view('blog/sidebar_blog', $data) ?>
            <!-- //Append Sidebar -->
        </div>
    </div>
</section>
<!-- Genre page end-->


