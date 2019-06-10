<?php
use APP\Helpers\URL_Helper as URL;
?>
<div class="outer-w3-agile col-xl ml-xl-3 mt-xl-0 mt-3 text-center">
    <h4 class="tittle-w3-agileits mb-4">Send News Letter</h4>
    <div id="admin_sendnews_resp"></div>
        <form action="<?= URL::baseURL('admin/newsletter/send') ?>" method="post">
            <div class="form-group row">
                <label for="newsEmail" class="col-sm-2 col-form-label">Email(s)</label>
                <div class="col-sm-10">
                    <select id="newsEmail" multiple="" class="form-control" name="news_emails[]">
                        <?php if(count($data['all_subscribers_data']) > 0): ?>
                            <option value="-1">All</option>
                            <?php foreach($data['all_subscribers_data'] as $subData): ?>
                            <option value="<?= $subData->id ?>"><?= $subData->email ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="0">N/A</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="newsSubject" class="col-sm-2 col-form-label">Subject</label>
                <div class="col-sm-10">
                    <input type="text" name="subject" class="form-control" id="newsSubject" placeholder="News Subject" required="">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="newsSubject" class="col-sm-2 col-form-label">Message</label>
                <div class="col-sm-10">
                    <textarea name="message" class="form-control" id="newsSubject" placeholder="News Message" required=""></textarea>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="button" onclick="sendNewsLetter()" class="btn btn-primary">Add New Subscriber</button>
                </div>
            </div>
        </form>
</div>
