<?php

use APP\Helpers\URL_Helper as URL;
?>
<!-- Contact Settings -->
<div class="outer-w3-agile col-xl ml-xl-3 mt-xl-0 mt-3">
    <h4 class="tittle-w3-agileits mb-4">Contact Settings</h4>
    <?php if (count($data['contact_settings']) > 0): ?>
        <?php foreach ($data['contact_settings'] as $Settings): ?>
            <?php
            $formTitle = explode(".", $Settings->_key);
            ?>
            <div class="form-group row">
                <label for="_key_<?= $Settings->id ?>" class="col-sm-2 col-form-label"><?= strtoupper($formTitle[1]); ?></label>
                <div class="col-sm-10">
                    <input style="width:95%" type="text" value="<?= $Settings->_val ?>" name="<?= strtolower($formTitle[1]) ?>" class="" id="_key_<?= $Settings->id ?>" placeholder="Title" required="">
                    <button style="float:right" type="button" onclick="saveSettings(<?= $Settings->id ?>)" class="btn btn-success btn-sm">Save</button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Email Settings -->
<div class="outer-w3-agile col-xl ml-xl-3 mt-xl-0 mt-3">
    <h4 class="tittle-w3-agileits mb-4">Email Settings</h4>
    <?php if (count($data['email_settings']) > 0): ?>
        <?php foreach ($data['email_settings'] as $Settings): ?>
            <?php
            $formTitle = explode(".", $Settings->_key);
            ?>
            <div class="form-group row">
                <label for="_key_<?= $Settings->id ?>" class="col-sm-2 col-form-label"><?= strtoupper($formTitle[1]); ?></label>
                <div class="col-sm-10">
                    <input style="width:95%" type="text" value="<?= $Settings->_val ?>" name="<?= strtolower($formTitle[1]) ?>" class="" id="_key_<?= $Settings->id ?>" placeholder="Title" required="">
                    <button style="float:right" type="button" onclick="saveSettings(<?= $Settings->id ?>)" class="btn btn-success btn-sm">Save</button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</div> <!-- First ROw End -->

<br />

<div class="row">
    <!-- Site Settings -->
    <div class="outer-w3-agile col-xl ml-xl-3 mt-xl-0 mt-3">
        <h4 class="tittle-w3-agileits mb-4">Site Settings</h4>
        <?php if (count($data['site_settings']) > 0): ?>
            <?php foreach ($data['site_settings'] as $Settings): ?>
                <?php
                $formTitle = explode(".", $Settings->_key);
                ?>
                <div class="form-group row">
                    <label for="_key_<?= $Settings->id ?>" class="col-sm-2 col-form-label"><?= strtoupper($formTitle[1]); ?></label>
                    <div class="col-sm-10">
                        <input style="width:95%" type="text" value="<?= $Settings->_val ?>" name="<?= strtolower($formTitle[1]) ?>" class="" id="_key_<?= $Settings->id ?>" placeholder="Title" required="">
                        <button style="float:right" type="button" onclick="saveSettings(<?= $Settings->id ?>)" class="btn btn-success btn-sm">Save</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="outer-w3-agile col-xl ml-xl-3 mt-xl-0 mt-3">
        <h4 class="tittle-w3-agileits mb-4">Upload Settings</h4>
        <?php if (count($data['upload_settings']) > 0): ?>
            <?php foreach ($data['upload_settings'] as $Settings): ?>
                <?php
                $formTitle = explode(".", $Settings->_key);
                ?>
                <div class="form-group row">
                    <label for="_key_<?= $Settings->id ?>" class="col-sm-2 col-form-label"><?= strtoupper($formTitle[1]); ?></label>
                    <div class="col-sm-10">
                        <input style="width:95%" type="text" value="<?= $Settings->_val ?>" name="<?= strtolower($formTitle[1]) ?>" class="" id="_key_<?= $Settings->id ?>" placeholder="Title" required="">
                        <button style="float:right" type="button" onclick="saveSettings(<?= $Settings->id ?>)" class="btn btn-success btn-sm">Save</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div><!-- row 2 end -->

<br />

<div class="row">
    <div class="outer-w3-agile col-xl ml-xl-3 mt-xl-0 mt-3">
        <h4 class="tittle-w3-agileits mb-4">Pagination Settings</h4>
        <?php if (count($data['pagi_settings']) > 0): ?>
            <?php foreach ($data['pagi_settings'] as $Settings): ?>
                <?php
                $formTitle = explode(".", $Settings->_key);
                ?>
                <div class="form-group row">
                    <label for="_key_<?= $Settings->id ?>" class="col-sm-2 col-form-label"><?= strtoupper($formTitle[1]); ?></label>
                    <div class="col-sm-10">
                        <input style="width:95%" type="text" value="<?= $Settings->_val ?>" name="<?= strtolower($formTitle[1]) ?>" class="" id="_key_<?= $Settings->id ?>" placeholder="Title" required="">
                        <button style="float:right" type="button" onclick="saveSettings(<?= $Settings->id ?>)" class="btn btn-success btn-sm">Save</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
     <div class="outer-w3-agile col-xl ml-xl-3 mt-xl-0 mt-3">
        <h4 class="tittle-w3-agileits mb-4">Text Editor Settings</h4>
        <?php if (count($data['editor_settings']) > 0): ?>
            <?php foreach ($data['editor_settings'] as $Settings): ?>
                <?php
                $formTitle = explode(".", $Settings->_key);
                ?>
                <div class="form-group row">
                    <label for="_key_<?= $Settings->id ?>" class="col-sm-2 col-form-label"><?= strtoupper($formTitle[1]); ?></label>
                    <div class="col-sm-10">
                        <input style="width:95%" type="text" value="<?= $Settings->_val ?>" name="<?= strtolower($formTitle[1]) ?>" class="" id="_key_<?= $Settings->id ?>" placeholder="Title" required="">
                        <button style="float:right" type="button" onclick="saveSettings(<?= $Settings->id ?>)" class="btn btn-success btn-sm">Save</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

