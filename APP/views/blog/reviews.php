<?php
use APP\Helpers\URL_Helper as URL;
?>
<!-- Page top section -->
<section class="page-top-section set-bg" data-setbg="<?= URL_ROOT ?>img/page-top-bg/2.jpg">
    <div class="page-info">
        <h2>Reviews</h2>
        <div class="site-breadcrumb">
            <a href="<?= URL::baseURL('home') ?>">Home</a>  /
            <span>Reviews</span>
        </div>
    </div>
</section>
<!-- Page top end-->


<!-- Review section -->
<section class="review-section">
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

        <?php if (count($data['blog_posts_data']) > 0): ?>
            <?php foreach ($data['blog_posts_data'] as $blgPostData): ?>
                <div class="review-item">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="review-pic">
                                <?php
                                //Parse Image
                                $img = (array) json_decode($blgPostData->img);
                                ?>
                                <img src="<?= $img[0] ?>" alt="">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="review-content text-box text-white">
                                <div class="rating">
                                    <?php
                                    $raiting_data = json_decode($blgPostData->raiting);
                                    //calculating avg
                                    $avg = 0;
                                    foreach($raiting_data as $k => $v){
                                        $avg += $v;
                                    }
                                    $avg = $avg/3;
                                    ?>
                                    <h5><i>Rating</i><span><?= round($avg,1) ?></span> / 5</h5>
                                </div>
                                <div class="top-meta"><?= explode(" ", $blgPostData->added_on)[0]; ?>  /  in <a href="#"><?= $blgPostData->Cat_Name ?></a></div>
                                <h3><?= $blgPostData->title ?></h3>
                                <p><?= $blgPostData->summery ?></p>
                                <a href="<?= URL::baseURL('blog/read/'. $blgPostData->id) ?>" class="read-more">Read More <img src="<?= URL_ROOT ?>img/icons/double-arrow.png" alt="#"/></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="review-item">
                <div class="row text-white">
                    <h2>No Reviews Found.</h2>
                </div>
            </div>
        <?php endif; ?>


        <div class="site-pagination">
           <?= ($data['paginator']); ?>
        </div>
    </div>
</section>
<!-- Review section end-->