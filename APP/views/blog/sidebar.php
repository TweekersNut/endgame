<?php
use APP\Helpers\URL_Helper as URL;
?>
<div class="col-xl-3 col-lg-4 col-md-5 sidebar game-page-sideber">
    <div id="stickySidebar">
        <div class="widget-item">
            <div class="categories-widget">
                <h4 class="widget-title">Categories</h4>
                <ul>
                    <?php if(count($data['blog_sidebar_cat_data']) > 0): ?>
                        <?php foreach($data['blog_sidebar_cat_data'] as $blgCatData): ?>
                            <li><a href="<?= URL::baseURL('blog/category/'. strtolower($blgCatData->name)) ?>"><?= $blgCatData->name ?></a></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li><a href="#">No Categories Found.</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="widget-item">
            <div class="categories-widget">
                <h4 class="widget-title">Platform</h4>
                <ul>
                    <?php if(count($data['platform_data']) > 0): ?>
                        <?php foreach($data['platform_data'] as $blgPlatData): ?>
                            <li><a href="<?= URL::baseURL("blog/platform/". strtolower($blgPlatData->name)) ?>"><?= $blgPlatData->name ?></a></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li><a href="#">No Platform Found.</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="widget-item">
            <div class="categories-widget">
                <h4 class="widget-title">Genre</h4>
                <ul>
                    <?php if(count($data['genre_data']) > 0): ?>
                        <?php foreach($data['genre_data'] as $blgGebData): ?>
                            <li><a href="<?= URL::baseURL("blog/genre/". strtolower($blgGebData->name)) ?>"><?= $blgGebData->name ?></a></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li><a href="#">No Genre Found.</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>