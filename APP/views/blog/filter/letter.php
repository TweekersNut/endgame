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
            <span><?= strtoupper($data['filter']) ?></span>
        </div>
    </div>
</section>
<!-- Page top end-->

<!-- Genre page -->
<section class="blog-page">
    <div class="container">
        <ul class="game-filter">
            <li><a href="<?= URL::baseURL('blog/filter/a') ?>">A</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/b') ?>">B</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/c') ?>">C</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/d') ?>">D</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/e') ?>">E</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/f') ?>">F</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/g') ?>">G</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/h') ?>">H</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/i') ?>">I</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/j') ?>">J</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/k') ?>">K</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/l') ?>">L</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/m') ?>">M</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/n') ?>">N</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/o') ?>">O</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/p') ?>">P</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/q') ?>">Q</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/r') ?>">R</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/s') ?>">S</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/t') ?>">T</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/u') ?>">U</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/v') ?>">V</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/w') ?>">W</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/x') ?>">X</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/y') ?>">Y</a></li>
            <li><a href="<?= URL::baseURL('blog/filter/z') ?>">Z</a></li>
        </ul>
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-7">
                
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



