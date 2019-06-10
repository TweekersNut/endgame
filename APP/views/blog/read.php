<?php
use APP\Helpers\URL_Helper as URL;
?>
<!-- Page top section -->
<section class="page-top-section set-bg" data-setbg="<?= URL_ROOT ?>img/page-top-bg/1.jpg">
    <div class="page-info">
        <h2>Games</h2>
        <div class="site-breadcrumb">
            <a href="<?= URL::baseURL('home') ?>">Home</a>  /
            <a href="<?= URL::baseURL('blog') ?>">Blog</span>  /
            <span>View</span>  /
            <span><?= $data['blog_post_data']-> title ?></span>
        </div>
    </div>
</section>
<!-- Page top end-->


<!-- Games section -->
<section class="games-single-page">
    <div class="container">
        <div class="game-single-preview">
            <?php
                //Parse Image
                $img = (array) json_decode($data['blog_post_data']->img);
            ?>
            <img src="<?= $img[0] ?>" alt="">
        </div>
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-7 game-single-content">
                <div class="gs-meta"><?= explode(' ', $data['blog_post_data']->added_on)[0] ?>  /  in <a href="<?= URL::baseURL('blog/category'.$data['blog_post_data']->Cat_Name) ?>"><?= $data['blog_post_data']->Cat_Name ?></a></div>
                <h2 class="gs-title"><?= $data['blog_post_data']->title ?></h2>
                <h4><?= $data['blog_post_data']->Gen_Name ?></h4>
                <div class="text-white">
                    <?= $data['blog_post_data']->description ?>
                </div>
                <h4>Conclusion</h4>
                <p>
                    <?= $data['blog_post_data']->summery ?>
                </p>
                <div class="geme-social-share pt-5 d-flex">
                    <p>Share:</p>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-behance"></i></a>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-5 sidebar game-page-sideber">
                <div id="stickySidebar">
                    <div class="widget-item">
                        <div class="rating-widget">
                            <h4 class="widget-title">Ratings</h4>
                            <ul>
                                <?php 
                                    $raiting_data  = (array)json_decode($data['blog_post_data']->raiting);
                                    $avg = 0;
                                    foreach($raiting_data as $k => $v):
                                        $avg += $v;
                                ?>
                                <li><?= strtoupper($k) ?><span><?= round($v,1) ?>/5</span></li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="rating">
                                <h5><i>Rating</i><span><?= round(($avg/3),1) ?></span> / 5</h5>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Games end-->

<section class="game-author-section">
    <div class="container">
        <div class="game-author-pic set-bg" data-setbg="<?= $data['user_data']->avatar ?>"></div>
        <div class="game-author-info">
            <h4>Written by: <?= $data['user_data']->username ?></h4>
            <p><?= $data['user_data']->bio ?></p>
        </div>
    </div>
</section>


