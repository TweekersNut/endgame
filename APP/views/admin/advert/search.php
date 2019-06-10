<?php

use APP\Helpers\IP as IP;
use APP\Helpers\URL_Helper as URL;
use APP\Core\Session as Session;
?>
<div class="outer-w3-agile mt-3 col-md-12">
    <h4 class="tittle-w3-agileits mb-4">Advert Search : <?= $data['search_query'] ?></h4>
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <form class="form-inline" method="post" action="<?= URL::baseURL('admin/advert/search/') ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input class="form-control-sm mr-sm-2" type="search" value="<?= $data['search_query'] ?>" name="query" placeholder="Search" aria-label="Search" required="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button class="btn btn-info btn-sm" type="submit">Search</button>
                        <a class="btn btn-warning btn-sm" href="<?= URL::baseURL('admin/advert') ?>">Reset</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 col-lg-4">
            <form class="form-inline" method='post' action='<?= URL::baseURL('admin/advertFilter') ?>'>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <select class="form-control-sm" name='filter'>
                            <option value="1">Active Advert</option>
                            <option value="2">In-Active Advert</option>
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
                    <th scope="col">Name</th>
                    <th scope="col">Banner</th>
                    <th scope="col">Link</th>
                    <th scope="col">Clicks</th>
                    <th scope="col">Area</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data['all_advert_data']) > 0): ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($data['all_advert_data'] as $advertData): ?>
                        <tr>
                            <th scope="row"><?= $counter ?> (<?= $advertData->id ?>)</th>
                            <td><?= $advertData->name; ?></td>
                            <td><img src="<?= $advertData->img ?>" class="img-thumbnail img-fluid" width="100dp" height="100dp" alt="image" /></td>
                            <td><a href="<?= $advertData->link ?>" target="_blank"><?= $advertData->link ?></a></td>
                            <td><?= $advertData->clicks ?></td>
                            <td><?= ucfirst($advertData->area) ?></td>
                            <td>
                                <?php if ($advertData->status == 1): ?>
                                    <span style="color:green"><b>Active</b></span>
                                <?php else: ?>
                                    <span style="color:red"><b>In-Active</b></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($advertData->status == 1): ?>
                                    <button type="button" class="btn btn-dark btn-sm" onclick="markAdvertInactive(<?= $advertData->id ?>)">Mark Inactive</button>
                                <?php else: ?>
                                    <button type="button" class="btn btn-dark btn-sm" onclick="markAdvertActive(<?= $advertData->id ?>)">Mark Inactive</button>
                                <?php endif; ?>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteAdvert(<?= $advertData->id ?>)">Delete</button>
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
       
    </div>
</div>