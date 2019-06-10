<?php

use APP\Helpers\IP as IP;
use APP\Helpers\URL_Helper as URL;
use APP\Core\Session as Session;
?>
<div class="outer-w3-agile mt-3 col-md-12">
    <h4 class="tittle-w3-agileits mb-4">Search Users : <?= $data['search_query'] ?></h4>
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <form class="form-inline" method="post" action="<?= URL::baseURL('admin/users/search/') ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input class="form-control-sm mr-sm-2" value="<?= $data['search_query'] ?>" type="search" name="query" placeholder="Search" aria-label="Search" required="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button class="btn btn-info btn-sm" type="submit">Search</button>
                        <a class="btn btn-warning btn-sm" href="<?= URL::baseURL('admin/users') ?>">Reset</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 col-lg-4">
            <form class="form-inline" method='post' action='<?= URL::baseURL('admin/usersFilter') ?>'>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <select class="form-control-sm" name='filter'>
                            <option value="1">I.D Ascending</option>
                            <option value="2">I.D Descending</option>
                            <option value="3">Email Ascending</option>
                            <option value="4">Email Descending</option>
                            <option value="5">Username Ascending</option>
                            <option value="6">Username Descending</option>
                            <option value="7">Active User</option>
                            <option value="8">In-Active User</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button class="btn btn-info btn-sm" type="submit">Arrange</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 col-lg-4">
            <button class="btn btn-success btn-sm" type="button">Export C.S.V</button> 
            <button class="btn btn-primary btn-sm" type="button">Export Excel</button> 
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
                    <th scope="col">Username</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Added On</th>
                    <th scope="col">I.P</th>
                    <th scope="col">Account Secret</th>
                    <th scope="col">Bio</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data['all_user_data']) > 0): ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($data['all_user_data'] as $usrData): ?>
                        <tr>
                            <th scope="row"><?= $counter ?> (<?= $usrData->id ?>)</th>
                            <td><?= $usrData->username ?></td>
                            <td><?= $usrData->email ?></td>
                            <td><img class="img-thumbnail img-fluid" src="<?= $usrData->avatar ?>" alt="user_avatar" width="100dp" height="100dp" /></td>
                            <td><?= $usrData->added_on; ?>(<?= timeElapsedString($usrData->added_on) ?>)</td>
                            <!-- IP Lookup Modal -->
                    <div class="modal fade" id="IP_lookup_<?= $usrData->id ?>" tabindex="-1" role="dialog" aria-labelledby="ipLookupLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="ipLookupLabel">I.P Lookup</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="paragraph-agileits-w3layouts">
                                        <?php $data['ip_data'] = IP::lookup($usrData->IP); ?>
                                        <b>City : </b><?= $data['ip_data']->city ?>
                                        <br />
                                        <b>Continent : </b><?= $data['ip_data']->continent ?>
                                        <br />
                                        <b>Country : </b><?= $data['ip_data']->country ?>
                                        <br />
                                        <b>Country Code : </b><?= $data['ip_data']->countryCode ?>
                                        <br />
                                        <b>IP Name : </b><?= $data['ip_data']->ipName ?>
                                        <br />
                                        <b>IP Type : </b><?= $data['ip_data']->ipType ?>
                                        <br />
                                        <b>ISP : </b><?= $data['ip_data']->isp ?>
                                        <br />
                                        <b>Location : </b><?= $data['ip_data']->lat ?>,<?= $data['ip_data']->lon ?>
                                    <div id="map">
                                        <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA2sAgPDTazz55bt5gc-bhSW60QiygAXRc&amp;q=<?= $data['ip_data']->lat ?>%2C<?= $data['ip_data']->lon ?>&amp;zoom=12" width="100%" height="400" frameborder="0" style="border:1px solid silver;" allowfullscreen=""></iframe>
                                    </div>
                                    <br />
                                    <b>Organization : </b><?= $data['ip_data']->org ?>
                                    <br />
                                    <b>Query : </b><?= $data['ip_data']->query ?>
                                    <br />
                                    <b>Region : </b><?= $data['ip_data']->region ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //IP Lookup Modal -->
                    <td>
                        <?= $usrData->IP; ?>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#IP_lookup_<?= $usrData->id ?>">Lookup?</button>
                    </td>
                    <td><?= $usrData->acc_key ?></td>
                    <!-- Read Bio Modal -->
                    <div class="modal fade" id="read_bio_<?= $usrData->id ?>" tabindex="-1" role="dialog" aria-labelledby="readBio" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4 class="modal-title" id="readBio">Read <?= $usrData->username ?> Bio.</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="paragraph-agileits-w3layouts"><?= $usrData->bio ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //Read Bio Modal -->
                    <td>
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#read_bio_<?= $usrData->id ?>">Read Bio</button>
                    </td>
                    <td>
                        <?php if ($usrData->status == 1): ?>
                            <span style="color:green"><b>Active</b></span>
                        <?php else: ?>
                            <span style="color:red"><b>In-Active</b></span>
                        <?php endif; ?>
                    </td>
                    <!-- Edit User Modal -->
                    <div class="modal fade" id="edit_user_<?= $usrData->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4 class="modal-title">Edit :  <?= $usrData->username ?> Bio.</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="username_<?= $usrData->id ?>" value="<?= $usrData->username ?>" class="form-control" placeholder="Username" required="">
                                            </div>
                                            <div class="admin_user_check"></div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" name="email_<?= $usrData->id ?>" value="<?= $usrData->email ?>" class="form-control" placeholder="Email" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="password_<?= $usrData->id ?>" value="<?= decrypt($usrData->password) ?>" class="form-control" value="" placeholder="Password" required="">
                                            </div>
                                        </div>
                                                <input type="hidden" name="id" value="<?= $usrData->id ?>" />
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="button" onclick="editUser(<?= $usrData->id ?>)" class="btn btn-primary">Edit <?= $usrData->username ?></button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //Edit User Modal -->
                    <td>
                        <?php if ($usrData->status == 1 && $usrData->id != Session::get('U_ID')): ?>
                            <button type="button" class="btn btn-primary btn-sm" onclick="markUserInactive(<?= $usrData->id ?>)">Mark In-Active</button>
                        <?php else: ?>
                            <?php if ($usrData->id != Session::get('U_ID')): ?>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="markUserActive(<?= $usrData->id ?>)">Mark Active</button>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($usrData->id != Session::get('U_ID')): ?>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit_user_<?= $usrData->id ?>">Edit</button>
                        <?php else: ?>
                            <a href="<?= URL::baseURL('admin/users/editprofile') ?>"  class="btn btn-success btn-sm">Edit Profile</a>
                        <?php endif; ?>
                        <?php if ($usrData->id != Session::get('U_ID')): ?>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteUser(<?= $usrData->id ?>)">Delete</button>
                        <?php endif; ?>
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
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        
    </div>
</div>