<?php

use APP\Helpers\URL_Helper as URL;
?>
<!-- Hero section -->
<section class="hero-section overflow-hidden">
    <div class="hero-slider owl-carousel">
        <?php if (count($data['slider_data']) > 0): ?>
            <?php foreach ($data['slider_data'] as $sliderData): ?>
                <div class="hero-item set-bg d-flex align-items-center justify-content-center text-center" data-setbg="<?= $sliderData->img ?>">
                    <div class="container">
                        <h2><?= $sliderData->title ?></h2>
                        <p><?= $sliderData->description ?></p>
                        <a href="<?= $sliderData->link ?>" class="site-btn"><?= $sliderData->btn_text ?> <img src="<?= URL_ROOT ?>img/icons/double-arrow.png" alt="#" /></a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
<!-- Hero section end-->


<!-- Intro section -->
<section class="intro-section">
    <div class="container">
        <div class="row">
            <?php if (count($data['featured_posts']) > 0): ?>
                <?php foreach ($data['featured_posts'] as $featurePostData): ?>
                    <div class="col-md-4">
                        <div class="intro-text-box text-box text-white">
                            <div class="top-meta"><?= explode(" ", $featurePostData->added_on)[0]; ?>  /  in <a href="<?= URL::baseURL('blog/category/' . strtolower($featurePostData->Cat_Name)) ?>"><?= $featurePostData->Cat_Name ?></a></div>
                            <h3><?= $featurePostData->title ?></h3>
                            <p><?= $featurePostData->summery ?></p>
                            <a href="<?= URL::baseURL('blog/read/' . $featurePostData->id) ?>" class="read-more">Read More <img src="<?= URL_ROOT ?>img/icons/double-arrow.png" alt="#"/></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</section>
<!-- Intro section end -->


<!-- Blog section -->
<section class="blog-section spad">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-7">
                <div class="section-title text-white">
                    <h2>Latest News</h2>
                </div>
                <ul class="blog-filter">
                    <?php if (count($data['genre_data']) > 0): ?>
                        <?php foreach ($data['genre_data'] as $blgGebData): ?>
                            <li><a href="<?= URL::baseURL("blog/genre/" . strtolower($blgGebData->name)) ?>"><?= $blgGebData->name ?></a></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
                <?php if (count($data['latest_posts']) > 0): ?>
                    <?php foreach ($data['latest_posts'] as $latstData): ?>
                        <!-- Blog item -->
                        <div class="blog-item">
                            <div class="blog-thumb">
                                <?php
                                $img = (array) json_decode($latstData->img);
                                ?>
                                <img src="<?= $img[0] ?>" alt="">
                            </div>
                            <div class="blog-text text-box text-white">
                                <div class="top-meta"><?= explode(' ', $latstData->added_on)[0] ?>  /  in <a href="<?= URL::baseURL('blog/category/' . strtolower($latstData->Cat_Name)) ?>"><?= $latstData->Cat_Name ?></a></div>
                                <h3><?= $latstData->title ?></h3>
                                <p><?= $latstData->summery ?></p>
                                <a href="<?= URL::baseURL('blog/read/' . $latstData->id) ?>" class="read-more">Read More  <img src="<?= URL_ROOT ?>img/icons/double-arrow.png" alt="#"/></a>
                            </div>
                        </div>
                        <!-- Blog item -->

                    <?php endforeach; ?>
                <?php else: ?>
                    <h2 class="text-white">No Posts Found!</h2>
                <?php endif; ?>

            </div>
            <div class="col-xl-3 col-lg-4 col-md-5 sidebar">
                <div id="stickySidebar">

                    <div class="widget-item">
                        <div class="categories-widget">
                            <h4 class="widget-title">categories</h4>
                            <ul>
                                <?php if (count($data['blog_sidebar_cat_data']) > 0): ?>
                                    <?php foreach ($data['blog_sidebar_cat_data'] as $blgCatData): ?>
                                        <li><a href="<?= URL::baseURL('blog/category/' . strtolower($blgCatData->name)) ?>"><?= $blgCatData->name ?></a></li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li><a href="#">No Categories Found.</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <!-- Adverts Banners -->
                    <?php if (count($data['adverts_banners']) > 0): ?>
                        <?php foreach($data['adverts_banners'] as $advrtData): ?>
                            <div class="widget-item">
                                <a target="_blank" href="<?= URL::baseURL('advert/redirect/'.$advrtData->id) ?>" class="add">
                                    <img src="<?= $advrtData->img ?>" alt="<?= $advrtData->name ?>">
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog section end -->


<?php if (count($data['video_slider']) > 0): ?>
    <?php foreach ($data['video_slider'] as $sliderData): ?>
        <!-- Intro section -->
        <section class="intro-video-section set-bg d-flex align-items-end " data-setbg="<?= $sliderData->img ?>">
            <a target="_blank" href="<?= $sliderData->link ?>" class="video-play-btn video-popup"><img src="<?= URL_ROOT ?>img/icons/solid-right-arrow.png" alt="#"></a>
            <div class="container">
                <div class="video-text">
                    <h2><?= $sliderData->title ?></h2>
                    <p><?= $sliderData->description ?></p>
                </div>
            </div>
        </section>
        <!-- Intro section end -->
    <?php endforeach; ?>
<?php endif; ?>



<!-- Featured section -->
<?php foreach ($data['blog_featured_posts_data'] as $featuredData): ?>
    <section class="featured-section">
        <?php
        $img = (array) json_decode($featuredData->img);
        ?>
        <div class="featured-bg set-bg" data-setbg="<?= $img[0] ?>"></div>
        <div class="featured-box">
            <div class="text-box">
                <div class="top-meta"><?= explode(' ', $featuredData->added_on)[0] ?>  /  in <a href="<?= URL::baseURL('blog/category/' . $featuredData->Cat_Name) ?>"><?= $featuredData->Cat_Name ?></a></div>
                <h3><?= $featuredData->title ?></h3>
                <p><?= $featuredData->summery ?></p>
                <a href="<?= URL::baseURL('blog/read/' . $featuredData->id) ?>" class="read-more">Read More <img src="<?= URL_ROOT ?>img/icons/double-arrow.png" alt="#"/></a>
            </div>
        </div>

    </section>
<?php endforeach; ?>

<!-- Featured section end-->