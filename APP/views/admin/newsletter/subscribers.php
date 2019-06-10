<div class="outer-w3-agile col-xl ml-xl-3 mt-xl-0 mt-3">
    <h4 class="tittle-w3-agileits mb-4">Subscriber List</h4>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data['all_newsletter_data']) > 0): ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($data['all_newsletter_data'] as $newsData): ?>
                        <tr>
                            <th scope="row"><?= $counter ?> (<?= $newsData->id ?>)</th>
                            <td><?= $newsData->email; ?></td>
                            <td>
                                <?php if ($newsData->status == 1): ?>
                                    <span style="color:green"><b>Subscribed</b></span>
                                <?php else: ?>
                                    <span style="color:red"><b>Un-Subscribed</b></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($newsData->status == 1): ?>
                                    <button type="button" class="btn btn-dark btn-sm" onclick="markUnsubscriberSubs(<?= $newsData->id ?>)">Mark Un-Subscribed</button>
                                <?php else: ?>
                                    <button type="button" class="btn btn-dark btn-sm" onclick="markSubscriberSubs(<?= $newsData->id ?>)">Mark Subscribed</button>
                                <?php endif; ?>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteSubscriber(<?= $newsData->id ?>)">Delete</button>
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


<div class="outer-w3-agile col-xl ml-xl-3 mt-xl-0 mt-3">
    <h4 class="tittle-w3-agileits mb-4">Add New Subscriber</h4>
    <div id="admin_new_subscriber_resp"></div>
    <form>
        <div class="form-group row">
            <label for="newsEmail" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="email" class="form-control" id="newsEmail" placeholder="E-Mail" required="">
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="button" onclick="addNewSubscriber()" class="btn btn-primary">Add New Subscriber</button>
            </div>
        </div>
    </form>
</div>