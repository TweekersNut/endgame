<?php
use APP\Helpers\URL_Helper as URL;
use APP\Helpers\Pagination as Pagi;
?>
<!-- Page top section -->
<section class="page-top-section set-bg" data-setbg="<?= URL_ROOT ?>img/page-top-bg/1.jpg">
    <div class="page-info">
        <h2>Games</h2>
        <div class="site-breadcrumb">
            <a href="<?= URL::baseURL('home') ?>">Home</a>  /
            <span>Games</span>
        </div>
    </div>
</section>
<!-- Page top end-->




<!-- Games section -->
<section class="games-section">
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
            <div class="col-xl-7 col-lg-8 col-md-7">
                <div class="row">


                    <?php if (count($data['blog_posts_data']) > 0): ?>
                        <?php foreach ($data['blog_posts_data'] as $blgPostData): ?>
                            <div class="col-lg-4 col-md-6">
                                <?php
                                //Parse Image
                                $img = (array) json_decode($blgPostData->img);
                                ?>
                                <div class="game-item">
                                    <img src="<?= $img[0] ?>" alt="#">
                                    <h5><?= $blgPostData->title ?></h5>
                                    <a href="<?= URL::baseURL('blog/read/'. $blgPostData->id) ?>" class="read-more">Read More  <img src="<?= URL_ROOT ?>img/icons/double-arrow.png" alt="#"/></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h2 class="text-white">No Posts Found.</h2>
                    <?php endif; ?>


                </div>
                <div class="site-pagination">
                    <?= ($data['paginator']); ?>
                </div>
            </div>
            <!-- Append Sidebar -->
            <?php $this->view('blog/sidebar', $data) ?>
            <!-- //Append Sidebar -->
        </div>
    </div>
</section>
<!-- Games end-->


<!-- Featured section -->
<?php foreach ($data['blog_featured_posts_data'] as $featuredData): ?>
    <section class="featured-section">
        <?php
        $img = (array) json_decode($featuredData->img);
        ?>
        <div class="featured-bg set-bg" data-setbg="<?= $img[0] ?>"></div>
        <div class="featured-box">
            <div class="text-box">
                <div class="top-meta"><?= explode(' ', $featuredData->added_on)[0] ?>  /  in <a href="<?= URL::baseURL('blog/category/'.$featuredData->Cat_Name) ?>"><?= $featuredData->Cat_Name ?></a></div>
                <h3><?= $featuredData->title ?></h3>
                <p><?= $featuredData->summery ?></p>
                <a href="<?= URL::baseURL('blog/read/'. $blgPostData->id) ?>" class="read-more">Read More <img src="<?= URL_ROOT ?>img/icons/double-arrow.png" alt="#"/></a>
            </div>
        </div>

    </section>
<?php endforeach; ?>

<!-- Featured section end-->