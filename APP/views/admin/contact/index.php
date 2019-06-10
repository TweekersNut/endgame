<?php

use APP\Helpers\IP as IP;
use APP\Helpers\URL_Helper as URL;
use APP\Core\Session as Session;
?>
<div class="outer-w3-agile mt-3 col-md-12">
    <h4 class="tittle-w3-agileits mb-4">All Contact Quaries</h4>
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <form class="form-inline" method="post" action="<?= URL::baseURL('admin/contact/search/') ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input class="form-control-sm mr-sm-2" type="search" name="query" placeholder="Search" aria-label="Search" required="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button class="btn btn-info btn-sm" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 col-lg-4">
            
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
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Message</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data['all_contact_data']) > 0): ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($data['all_contact_data'] as $contactData): ?>
                        <tr>
                            <th scope="row"><?= $counter ?> (<?= $contactData->id ?>)</th>
                            <td><?= $contactData->name ?></td>
                            <td><a href="mailto:<?= $contactData->email ?>"><?= $contactData->email ?> </a></td>
                            <td><?= $contactData->subject ?></td>
                            <td><?= $contactData->message ?></td>
                            <td>
                                <?php if ($contactData->status == 1): ?>
                                    <span style="color:red"><b>New</b></span>
                                <?php else: ?>
                                    <span style="color:green"><b>Resolved</b></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($contactData->status == 1): ?>
                                    <button type="button" class="btn btn-info btn-sm" onclick="markContactQueryClose(<?= $contactData->id ?>)">Close Query</button>
                                <?php else: ?>
                                    <button type="button" class="btn btn-info btn-sm" onclick="markContactQueryOpen(<?= $contactData->id ?>)">Open Query</button>
                                <?php endif; ?>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteContactQuery(<?= $contactData->id ?>)">Delete</button>
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
        <?= $data['paginator']->toHtmlAdmin(); ?>
    </div>
</div>