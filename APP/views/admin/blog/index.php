<?php

use APP\Helpers\IP as IP;
use APP\Helpers\URL_Helper as URL;
use APP\Core\Session as Session;
?>
<div class="outer-w3-agile mt-3 col-md-12">
    <h4 class="tittle-w3-agileits mb-4">All Blog Posts Data</h4>
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <form class="form-inline" method="post" action="<?= URL::baseURL('admin/blog/search/') ?>">
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
            <form class="form-inline" method='post' action='<?= URL::baseURL('admin/blogFilter') ?>'>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <select class="form-control-sm" name='filter'>
                            <option value="1">Published Posts</option>
                            <option value="2">Draft Posts</option>
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
                    <th scope="col">Title</th>
                    <th scope="col">Featured Image</th>
                    <th scope="col">Summary</th>
                    <th scope="col">Description</th>
                    <th scope="col">Created on</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Average Rating</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Platform</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Featured</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data['all_blog_posts_data']) > 0): ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($data['all_blog_posts_data'] as $blgPostData): ?>
                        <tr>
                            <th scope="row"><?= $counter ?> (<?= $blgPostData->id ?>)</th>
                            <th scope="row"><?= $blgPostData->title ?></th>
                            <th scope="row">
                                <?php $avatar = (array) json_decode($blgPostData->img); ?>
                                <img src="<?= $avatar[0] ?>" width="150dp" height="150dp" class="img-fluid img-thumbnail" alt="blog_post_image" />
                            </th>
                            <!-- Complete summary modal -->
                        <div id="read_summary_<?= $blgPostData->id ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?= $blgPostData->title ?> Summary :</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <?= $blgPostData->summery ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <th scope="row"><?= readMoreHelper($blgPostData->summery,50,$blgPostData->id) ?></th>
                    <!-- Complete Description Modal -->
                    <div id="read_desc_<?= $blgPostData->id ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?= $blgPostData->title ?> Description :</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <?= $blgPostData->description ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <th scope="row">
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#read_desc_<?= $blgPostData->id ?>">Read Description</button>
                    </th>
                    <th scope="row">
                        <?= $blgPostData->added_on ?> (<?= timeElapsedString($blgPostData->added_on) ?>)
                    </th>
                    <th scope="row">
                        <?= $blgPostData->Cat_Name; ?>
                    </th>
                    <th scope="row">
                        <?php
                        $raiting_data = json_decode($blgPostData->raiting);
                        //calculating avg
                        $avg = 0;
                        foreach ($raiting_data as $k => $v) {
                            $avg += $v;
                        }
                        $avg = $avg / 3;
                        ?>
                        <?= round($avg, 1) ?>
                    </th>
                    <th scope="row">
                        <?= $blgPostData->username ?>
                    </th>
                    <th scope="row">
                        <?= $blgPostData->Plat_Name ?>
                    </th>
                    <th scope="row">
                        <?= $blgPostData->Gen_Name ?>
                    </th>
                    <th scope="row">
                        <?php if ($blgPostData->featured == 1): ?>
                            <span style="color:green">Featured</span>
                        <?php else: ?>
                            <span style="color:orange">Not Featured</span>
                        <?php endif; ?>
                    </th>
                    <th scope="row">
                        <?php if ($blgPostData->status == 1): ?>
                            <span style="color:green">Published</span>
                        <?php else: ?>
                            <span style="color:red">Draft</span>
                        <?php endif; ?>
                    </th>
                    <th scope="row">
                        <?php if($blgPostData->status == 1): ?>
                            <button type="button" class="btn btn-dark btn-sm" onclick="markBlogPostDraft(<?= $blgPostData->id ?>)">Draft Post</button>
                        <?php else: ?>
                            <button type="button" class="btn btn-dark btn-sm" onclick="markBlogPostPublish(<?= $blgPostData->id ?>)">Publish Post</button>
                        <?php endif; ?>
                            <a href="<?= URL::baseURL('admin/blog/edit/'. $blgPostData->id) ?>" class="btn btn-info btn-sm">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteBlogPost(<?= $blgPostData->id ?>)">Delete Post</button>
                    </th>
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