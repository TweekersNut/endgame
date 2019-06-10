<?php

use APP\Helpers\URL_Helper as URL;
?>
<div class="outer-w3-agile col-xl ml-xl-3 mt-xl-0 mt-3">
    <h4 class="tittle-w3-agileits mb-4">Blog Categories Data</h4>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data['all_category_data']) > 0): ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($data['all_category_data'] as $blogCatData): ?>
                        <tr>
                            <th scope="row"><?= $counter ?> (<?= $blogCatData->id ?>)</th>
                            <td><?= $blogCatData->name; ?></td>
                            <td><?= $blogCatData->desc ?></td>
                            <td>
                                <?php if ($blogCatData->status == 1): ?>
                                    <span style="color:green"><b>Active</b></span>
                                <?php else: ?>
                                    <span style="color:red"><b>In-Active</b></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($blogCatData->status == 1): ?>
                                    <button type="button" class="btn btn-dark btn-sm" onclick="markInactiveBlogCategory(<?= $blogCatData->id ?>)">Mark In-Active</button>
                                <?php else: ?>
                                    <button type="button" class="btn btn-dark btn-sm" onclick="markActiveBlogCategory(<?= $blogCatData->id ?>)">Mark Active</button>
                                <?php endif; ?>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteBlogCategory(<?= $blogCatData->id ?>)">Delete</button>
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
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?= $data['paginator']->toHtmlAdmin(); ?>
    </div>
</div>

<!-- Email Settings -->
<div class="outer-w3-agile col-xl ml-xl-3 mt-xl-0 mt-3">
    <h4 class="tittle-w3-agileits mb-4">Add New Category</h4>
    <div id="admin_add_blog_cat_resp"></div>
    <form>
        
        <div class="form-group row">
            <label for="blogCatName" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="blogCatName" placeholder="Category Name" required="">
            </div>
        </div>
        
        <div class="form-group row">
            <label for="blogCatDesc" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <input type="text" name="desc" class="form-control" id="blogCatDesc" placeholder="Category Description" required="">
            </div>
        </div>
        
        <div class="form-group row">
            <label for="blogCatStatus" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                <select name="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">In-Active</option>
                </select>
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="button" onclick="addNewBlogCategory()" class="btn btn-primary">Add New Category</button>
            </div>
        </div>
        
    </form>
</div>