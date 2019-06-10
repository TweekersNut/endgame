<?php

use APP\Helpers\URL_Helper as URL;
?>
<div class="col-xl-3 col-lg-4 col-md-5 sidebar">
    <div id="stickySidebar">
        <div class="widget-item">
            <form class="search-widget" action="<?= URL::baseURL('blog/search/') ?>" method="post">
                <input type="text" value="<?= isset($data['search_name']) ? $data['search_name'] : '' ?>" placeholder="Search Posts" name="post_title">
                <button type="submit">search</button>
            </form>
        </div>
        <div class="widget-item">
            <h4 class="widget-title">Trending</h4>
            <div class="trending-widget">
                <?php if (count($data['trending_posts_data']) > 0): ?>
                    <?php foreach ($data['trending_posts_data'] as $trendData): ?>
                        <a href="<?= URL::baseURL('blog/read/' . $trendData->id) ?>">
                            <div class="tw-item">
                                <div class="tw-thumb">
                                    <?php
                                    $img = (array) json_decode($trendData->img);
                                    ?>
                                    <img width="80px" height="80px" src="<?= $img[0] ?>" alt="#">
                                </div>
                                <div class="tw-text">
                                    <div class="tw-meta"><?= explode(' ', $trendData->added_on)[0] ?>  /  in <a href="<?= URL::baseURL('blog/category/' . $trendData->Cat_Name) ?>"><?= $trendData->Cat_Name ?></a></a></div>
                                    <h5><?= $trendData->title ?></h5>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="tw-item">
                        <h3 class="text-white">No Posts Found.</h3>
                    </div>
                <?php endif; ?>

            </div>
        </div>
        <div class="widget-item">
            <div class="categories-widget">
                <h4 class="widget-title">platform</h4>
                <ul>
                    <?php if (count($data['platform_data']) > 0): ?>
                        <?php foreach ($data['platform_data'] as $blgPlatData): ?>
                            <li><a href="<?= URL::baseURL("blog/platform/" . strtolower($blgPlatData->name)) ?>"><?= $blgPlatData->name ?></a></li>    
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li><a href="#">No Platform Found.</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
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

        <?php if (count($data['adverts_banners']) > 0): ?>
            <?php foreach ($data['adverts_banners'] as $advrtData): ?>
                <div class="widget-item">
                    <a target="_blank" href="<?= URL::baseURL('advert/redirect/' . $advrtData->id) ?>" class="add">
                        <img src="<?= $advrtData->img ?>" alt="<?= $advrtData->name ?>">
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>