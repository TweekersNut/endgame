<?php

use APP\Helpers\IP as IP;
use APP\Helpers\URL_Helper as URL;
use APP\Core\Session as Session;
?>
<div class="outer-w3-agile mt-3 col-md-12">
    <h4 class="tittle-w3-agileits mb-4">All Slider Data</h4>
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <form class="form-inline" method="post" action="<?= URL::baseURL('admin/slider/search/') ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input class="form-control-sm mr-sm-2" type="search" name="query" placeholder="Search" aria-label="Search" required="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button class="btn btn-info btn-sm" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 col-lg-4">
            <form class="form-inline" method='post' action='<?= URL::baseURL('admin/sliderFilter') ?>'>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <select class="form-control-sm" name='filter'>
                            <option value="1">Active Slider</option>
                            <option value="2">In-Active Slider</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button class="btn btn-info btn-sm" type="submit">Apply</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 col-lg-4">

        </div>
    </div>

    <div class="clearfix">
        <br />
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Link</th>
                    <th scope="col">Button Text</th>
                    <th scope="col">Type</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data['all_slider_data']) > 0): ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($data['all_slider_data'] as $sliderData): ?>
                        <tr>
                            <th scope="row"><?= $counter ?> (<?= $sliderData->id ?>)</th>
                            <td><img src="<?= $sliderData->img ?>" class="img-thumbnail img-fluid" width="100dp" height="100dp" alt="image" /></td>
                            <td><?= $sliderData->title ?></td>
                            <td><?= $sliderData->description ?></td>
                            <td><?= $sliderData->link ?></td>
                            <td><?= $sliderData->btn_text ?></td>
                            <td>
                                <?php if ($sliderData->type == 0): ?>
                                    Image
                                <?php else: ?>
                                    Video
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($sliderData->status == 1): ?>
                                    <span style="color:green"><b>Active</b></span>
                                <?php else: ?>
                                    <span style="color:red"><b>In-Active</b></span>
                                <?php endif; ?>
                            </td>
                        <td>
                            <?php if ($sliderData->status == 1): ?>
                                <button type="button" onclick="markSliderInactive(<?= $sliderData->id ?>)" class="btn btn-dark btn-sm">Mark Inactive</button>
                            <?php else: ?>
                                <button type="button" onclick="markSliderActive(<?= $sliderData->id ?>)" class="btn btn-dark btn-sm">Mark active</button>
                            <?php endif; ?>
                            <button type="button" onclick="deleteSlider(<?= $sliderData->id ?>)" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    <?php $counter++; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <th scope="row">1</th>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <?= $data['paginator']->toHtmlAdmin(); ?>
    </div>
</div>