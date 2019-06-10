<?php
use APP\Helpers\URL_Helper as URL;
?>
<!-- Forms-1 -->
<div class="outer-w3-agile col-xl mt-3 mr-xl-3">
    <h4 class="tittle-w3-agileits mb-4">Add New Slider</h4>
    <?php if(isset($_POST['add_new_slider'])): ?>
        <div class="alert alert-dismissible alert-<?= $data['slider_add_type'] ?>">
            <strong><?= $data['slider_add_msg'] ?></strong>
        </div>
    <?php endif; ?>
    <form action="<?= URL::baseURL('admin/slider/add') ?>" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="sliderAvatar" class="col-sm-2 col-form-label">Image</label>
            <div class="col-sm-10">
                <input type="file" name="slider_img" id="sliderAvatar" />
            </div>
        </div>
        
        <div class="form-group row">
            <label for="sliderTitle" class="col-sm-2 col-form-label">Title/Heading</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control" id="sliderTitle" placeholder="Title" required="">
            </div>
            <div class="admin_user_check"></div>
        </div>
        
        <div class="form-group row">
            <label for="sliderDesc" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <input type="text" name="desc" class="form-control" id="sliderDesc" placeholder="Description" required="">
            </div>
        </div>
        
        <div class="form-group row">
            <label for="sliderLink" class="col-sm-2 col-form-label">Link</label>
            <div class="col-sm-10">
                <input type="text" name="link" class="form-control" id="sliderLink" value="#" placeholder="Link" required="">
                (NOTE: If slider is of video type then please enter video link.<br /> Example : https://www.youtube.com/watch?v=xxx)
            </div>
        </div>
        
        <div class="form-group row">
            <label for="sliderBtnText" class="col-sm-2 col-form-label">Button Text</label>
            <div class="col-sm-10">
                <input type="text" name="btn" class="form-control" id="sliderBtnText" value="" placeholder="Button Text" required="">
            </div>
        </div>
        
        <div class="form-group row">
            <label for="sliderType" class="col-sm-2 col-form-label">Type</label>
            <div class="col-sm-10">
                <select class="form-control" name="type">
                    <option value="0">Image</option>
                    <option value="1">Video</option>
                </select>
            </div>
        </div>
        
         <div class="form-group row">
            <label for="sliderType" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                <select class="form-control" name="status">
                    <option value="0">In-Active</option>
                    <option value="1">Active</option>
                </select>
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" name="add_new_slider" class="btn btn-primary">Add New Slider</button>
            </div>
        </div>
    </form>
</div>

