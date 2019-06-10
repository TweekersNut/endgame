<!-- Forms-1 -->
<div class="outer-w3-agile col-xl mt-3 mr-xl-3">
    <h4 class="tittle-w3-agileits mb-4">Add New User Form</h4>
    <div id="admin_add_user_resp"></div>
    <form action="#" id="admin_add_new_user" method="post">
        <div class="form-group row">
            <label for="userUsername" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" name="username" class="form-control" id="userUsername" placeholder="Username" required="">
            </div>
            <div class="admin_user_check"></div>
        </div>
        
        <div class="form-group row">
            <label for="userEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="userEmail" placeholder="Email" required="">
            </div>
        </div>
        
        <div class="form-group row">
            <label for="userPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="userPassword" value="" placeholder="Password" required="">
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Add New User</button>
            </div>
        </div>
    </form>
</div>

