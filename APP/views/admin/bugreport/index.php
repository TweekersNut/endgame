<?php

use APP\Helpers\URL_Helper as URL;
?>
<!-- Forms-1 -->
<div class="outer-w3-agile col-xl mt-3 mr-xl-3">
    <h4 class="tittle-w3-agileits mb-4"></h4>
    <?php if (isset($_POST['send_bug_report'])): ?>
        <div class="alert alert-dismissible alert-<?= $data['msg_type'] ?>">
            <strong><?= $data['msg_msg'] ?></strong>
        </div>
    <?php endif; ?>
    <form action="<?= URL::baseURL('admin/bugreport/send') ?>" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="sliderAvatar" class="col-sm-2 col-form-label">Bug Images</label>
            <div class="col-sm-10">
                <input type="file" name="bug_img" id="sliderAvatar" />
            </div>
        </div>

        <div class="form-group row">
            <label for="sliderTitle" class="col-sm-2 col-form-label">Bug Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="sliderTitle" placeholder="Bug Name" required="">
            </div>
        </div>

        <div class="form-group row">
            <label for="sliderDesc" class="col-sm-2 col-form-label">Summary</label>
            <div class="col-sm-10">
                <input type="text" name="summary" class="form-control" id="sliderDesc" placeholder="Bug Summary" required="">
            </div>
        </div>

        <div class="form-group row">
            <label for="sliderLink" class="col-sm-2 col-form-label">Bug Components</label>
            <div class="col-sm-10">
                <input type="text" name="components" class="form-control" id="sliderLink" value="" placeholder="Bug Components" required="">
            </div>
        </div>

        <div class="form-group row">
            <label for="sliderBtnText" class="col-sm-2 col-form-label">Bug Explanation</label>
            <div class="col-sm-10">
                <textarea name="explain" class="form-control" placeholder="Bug Explanation | Help us identify the problem and fix ASAP."></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="sliderType" class="col-sm-2 col-form-label">Bug Type</label>
            <div class="col-sm-10">
                <select class="form-control" name="type">
                    <option value="Bug">Bug</option>
                    <option value="Glitch">Glitch</option>
                    <option value="Critical">Critical</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" name="send_bug_report" class="btn btn-primary">Send Bug Report</button>
            </div>
        </div>
    </form>
</div>

