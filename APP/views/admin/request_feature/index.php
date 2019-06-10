<?php

use APP\Helpers\URL_Helper as URL;
?>
<!-- Forms-1 -->
<div class="outer-w3-agile col-xl mt-3 mr-xl-3">
    <h4 class="tittle-w3-agileits mb-4">Request New Feature For <?= SITE_NAME ?></h4>
    <?php if (isset($_POST['send_feature_request'])): ?>
        <div class="alert alert-dismissible alert-<?= $data['msg_type'] ?>">
            <strong><?= $data['msg_msg'] ?></strong>
        </div>
    <?php endif; ?>
    <form action="<?= URL::baseURL('admin/requestFeature/send') ?>" method="post">
        
        <div class="form-group row">
            <label for="sliderTitle" class="col-sm-2 col-form-label">Feature Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="sliderTitle" placeholder="Feature Name" required="">
            </div>
        </div>

        <div class="form-group row">
            <label for="sliderDesc" class="col-sm-2 col-form-label">Summary</label>
            <div class="col-sm-10">
                <input type="text" id="sliderDesc" name="summary" class="form-control" id="sliderDesc" placeholder="Feature Summary" required="">
            </div>
        </div>

        <div class="form-group row">
            <label for="sliderLink" class="col-sm-2 col-form-label">Feature Components</label>
            <div class="col-sm-10">
                <input type="text" id="sliderLink" name="components" class="form-control" id="sliderLink" value="" placeholder="Feature Components" required="">
            </div>
        </div>

        <div class="form-group row">
            <label for="sliderBtnText" class="col-sm-2 col-form-label">Feature Explanation</label>
            <div class="col-sm-10">
                <textarea name="explain" id="sliderBtnText" class="form-control" placeholder="Feature Explanation"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" name="send_feature_request" class="btn btn-primary">Send Feature Request</button>
            </div>
        </div>
    </form>
</div>

