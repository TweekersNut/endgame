<?php

use APP\Helpers\URL_Helper as URL;
?>
<!-- Forms-1 -->
<div class="outer-w3-agile col-xl mt-3 mr-xl-3">
    <h4 class="tittle-w3-agileits mb-4">Add New Advert Banner</h4>
<?php if (isset($_POST['add_new_banner'])): ?>
        <div class="alert alert-dismissible alert-<?= $data['advert_add_type'] ?>">
            <strong><?= $data['advert_add_msg'] ?></strong>
        </div>
<?php endif; ?>
    <form action="<?= URL::baseURL('admin/advert/add') ?>" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="advertAvatar" class="col-sm-2 col-form-label">Banner</label>
            <div class="col-sm-10">
                <input type="file" name="banner_img" id="advertAvatar" />
            </div>
        </div>

        <div class="form-group row">
            <label for="advertTitle" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="advertTitle" placeholder="Name" required="">
            </div>
            <div class="admin_user_check"></div>
        </div>

        <div class="form-group row">
            <label for="advertLink" class="col-sm-2 col-form-label">Link</label>
            <div class="col-sm-10">
                <input type="text" name="link" class="form-control" id="advertLink" placeholder="Advert Link" required="">
            </div>
        </div>

        <div class="form-group row">
            <label for="advertArea" class="col-sm-2 col-form-label">Banner Area</label>
            <div class="col-sm-10">
                <select id="advertArea" class="form-control" name="area">
                    <option value="home">Home</option>
                    <option value="blog">Blog</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="advertStatus" class="col-sm-2 col-form-label">Banner Status</label>
            <div class="col-sm-10">
                <select class="form-control" id="advertStatus" name="status">
                    <option value="1">Active</option>
                    <option value="0">In-Active</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" name="add_new_banner" class="btn btn-primary">Add New Banner</button>
            </div>
        </div>
    </form>
</div>

