<?php
use APP\Helpers\URL_Helper as URL;
?>
<!-- Forms-1 -->
<div class="outer-w3-agile col-xl mt-3 mr-xl-3">
    <h4 class="tittle-w3-agileits mb-4">Edit <?= $data['user_data']->username ?> Profile</h4>
    
    <?php if(isset($_POST['user_editprofile'])): ?>
        <div class="alert alert-dismissible alert-dark">
            <strong><?= $data['update_status'] ?></strong>
        </div>
    <?php endif; ?>
    
    <form action="<?= URL::baseURL('admin/users/editprofile') ?>" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="userUsername" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" name="username" value="<?= $data['user_data']->username ?>" class="form-control" id="userUsername" placeholder="Username" required="">
            </div>
            <div class="admin_user_check"></div>
        </div>

        <div class="form-group row">
            <label for="userEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="email" value="<?= $data['user_data']->email ?>" class="form-control" id="userEmail" placeholder="Email" required="">
            </div>
        </div>

        <div class="form-group row">
            <label for="userPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="password" value="<?= decrypt($data['user_data']->password) ?>" class="form-control" id="userPassword" value="" placeholder="Password" required="">
            </div>
        </div>
         
        <div class="form-group row">
            <label for="userBio" class="col-sm-2 col-form-label">Bio.</label>
            <div class="col-sm-10">
                <textarea id="userBio" class="form-control" rows="10" name="bio"><?= $data['user_data']->bio ?></textarea>
            </div>
        </div>
        
        <div class="form-group row">
            <label for="userCurrentAvatar" class="col-sm-2 col-form-label">Current Avatar</label>
            <div class="col-sm-10">
                <img id="userCurrentAvatar" src="<?= $data['user_data']->avatar ?>" width="150px" height="150px" alt="User_Avatar" />
            </div>
        </div>
        
        <div class="form-group row">
            <label for="userAvatar" class="col-sm-2 col-form-label">Avatar</label>
            <div class="col-sm-10">
                <input type="file" name="avatar" id="userAvatar" />
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" name="user_editprofile" class="btn btn-primary">Update Profile</button>
            </div>
        </div>
    </form>
</div>

