<?php

use APP\Models\Settings as Settings;
use APP\Helpers\URL_Helper as URL;
use APP\Core\Redirect as Redirect;
?>
<div class="outer-w3-agile col-xl ml-xl-3 mt-xl-0 mt-3">
    <h4 class="tittle-w3-agileits mb-4">Create New Post</h4>
    <?php if(isset($_POST['createPost'])): ?>
            <div class="alert alert-dismissible alert-<?= $data['msg_type'] ?>">
                <?php if(is_array($data['msg_msg'])): ?>
                    <?php foreach($data['msg_msg'] as $msg): ?>
                        <strong><?= $msg ?></strong>
                    <?php endforeach; ?>
                <?php else: ?>
                    <strong><?= $data['msg_msg'] ?></strong>
                <?php endif; ?>
            </div>
            <div class="alert alert-dismissible alert-<?= $data['msg_type'] ?>">
                <strong>Data refresh in 3 sec.</strong>
            </div>
            <script>
                setTimeout(function () {    
                    window.location.href = '<?= URL_ROOT . "admin/blog/add" ?>'; 
                },3000); 
            </script>
        <?php endif; ?>
    <div class="row">
        <div class="col-md-8 col-lg-8 col-xl-8">
            <form action="<?= URL::baseURL('admin/blog/createPost') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="postTitle" class="col-sm-2 col-form-label">Post Title</label>
                    <div class="col-sm-10">
                        <input id="postTitle" required="" type="text" class="form-control" name="title" placeholder="Post Title" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="postDesc" class="col-sm-2 col-form-label">Post Description</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control" placeholder="Post Description" id="postDesc"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="postSummary" class="col-sm-2 col-form-label">Post Summary</label>
                    <div class="col-sm-10">
                        <textarea name="summary" required="" class="form-control" placeholder="Post Summary" id="postSummary"></textarea>
                    </div>
                </div>

        </div>
        <div class="col-md-4 col-lg-4 col-xl-4">
            <button type="submit" name="createPost" value="create" class="btn btn-dark btn-sm">Create Post</button>
            <button type="submit" name="draftPost" value="draft" class="btn btn-secondary btn-sm">Draft Post</button>

            <div class="clearfix"><br /></div>

            <div class="card p-xl-3 p-1">
                <!-- Print Avail Cats -->
                <div class="form-group row">
                    <label for="postCat" class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select name="category" id="postCat" class="form-control">
                            <?php if (count($data['all_blog_cat_data']) > 0): ?>
                                <?php foreach ($data['all_blog_cat_data'] as $catData): ?>
                                    <option value="<?= $catData->id ?>"><?= $catData->name ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="0">N/A</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <!-- Print Platforms -->
                <div class="form-group row">
                    <label for="postPlat" class="col-sm-3 col-form-label">Platform</label>
                    <div class="col-sm-10">
                        <select name="platform" id="postPlat" class="form-control">
                            <?php if (count($data['all_blog_platform_data']) > 0): ?>
                                <?php foreach ($data['all_blog_platform_data'] as $platData): ?>
                                    <option value="<?= $platData->id ?>"><?= $platData->name ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="0">N/A</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <!-- Print Genre -->
                <div class="form-group row">
                    <label for="postGenre" class="col-sm-3 col-form-label">Genre</label>
                    <div class="col-sm-10">
                        <select name="genre" id="postGenre" class="form-control">
                            <?php if (count($data['all_blog_gen_data']) > 0): ?>
                                <?php foreach ($data['all_blog_gen_data'] as $genData): ?>
                                    <option value="<?= $genData->id ?>"><?= $genData->name ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="0">N/A</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

            </div>

            <div class="clearfix"><br /></div>

            <div class="card p-xl-3 p-1">
                <h4>Rating</h4>
                <div class="form-group row">
                    <label for="raitPrice" class="col-sm-3 col-form-label">Price</label>
                    <div class="col-sm-10">
                        <input type="number" required="" id="raitPrice" class="form-control" min="0" max="5" name="rating_price" placeholder="Price Rating"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="raitGraphics" class="col-sm-3 col-form-label">Graphics</label>
                    <div class="col-sm-10">
                        <input type="number" required="" id="raitGraphics" class="form-control" min="0" max="5" name="rating_graphics" placeholder="Graphics Rating"/>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="raitDifficulty" class="col-sm-3 col-form-label">Difficulty</label>
                    <div class="col-sm-10">
                        <input type="number" required="" id="raitDifficulty" class="form-control" min="0" max="5" name="rating_difficulty" placeholder="Difficulty Rating"/>
                    </div>
                </div>

            </div>
            
            <div class="clearfix"><br /></div>
            
            <div class="card p-xl-3 p-1">
                <h4>Featured Image</h4>
                <div id="post_feature_img_resp"></div>
                <div class="form-group row">
                    <label for="postImg" class="col-sm-3 col-form-label">Featured Image</label>
                    <div class="col-sm-10">
                        <input type="file" name="featuredImg" class="form-control" />
                    </div>
                    <small>Valid Formats : <?php
                        foreach (explode(",", (new Settings)->getValue('upload.allowed_mime')->_val) as $validForms) {
                            echo $validForms . ",";
                        }
                        ?></small>
                </div>
                
                <div class="form-group row">
                    <label for="postFeatured" class="col-sm-3 col-form-label">Set Post Featured</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="postFeatured" name="featured">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
        </form>
    </div>
</div>
