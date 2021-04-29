<h2><?= $title ?></h2>
<?php if (validation_errors()) : ?>
<div class="alert alert-dismissible alert-warning">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Warning!</h4>
    <p class="mb-0"><?= validation_errors() ?></p>
</div>

<?php endif ?>

<?php $hidden = array(
    'id' => $activity['id']
) ?>
<?= form_open_multipart('activity/update', '', $hidden); ?>
<div class="row">
    <div class="col-md-10 offset-md-1 align-self-center">
        <!-- NAME -->
        <div class="form-group">
            <label>Activity Name</label>
            <input name="activityname" type="text" class="form-control" placeholder="Enter activity name" value="<?= $activity['title'] ?>">
            <small class="form-text text-muted">Please include unique activity name</small>
        </div>
        <!-- DESCRIPTION -->
        <div class="form-group">
            <label>Activity Description</label>
            <textarea name="activitydesc" class="form-control ckeditor" rows="3"><?= $activity['description'] ?></textarea>
            <small class="form-text text-muted">Please include summary of the activity</small>
        </div>
        <div class="form-group">
            <label>Venue</label>
            <input name="venue" type="text" class="form-control" placeholder="Enter venue name" value="<?= $activity['venue'] ?>">
        </div>
        <div class="form-group">
            <label>Theme</label>
            <input name="theme" type="text" class="form-control" placeholder="Enter activity theme" value="<?= $activity['theme'] ?>">
        </div>
        <!-- ACADEMIC SESSION -->
        <div class="form-group">
            <label>Academic session</label>
            <input type="text" class="form-control" value="<?= $academicsession['academicsession'] ?>" readonly>
            <!-- <select name="academicsession_id" class="form-control" readonly>
                <option value="<?= $activity['acadsession_id'] ?>"><?= $academicsession['academicsession'] ?></option>
            </select> -->
        </div>
        <!-- SIG -->
        <!-- <div class="form-group">
            <label>Select SIG</label>
            <select name="sig_id" class="form-control" readonly>
                <option value="<?= $sig['code'] ?>"><?= $sig['namecode'] ?></option>
            </select>
        </div> -->
        <!-- ADVISOR -->
        <div class="form-group">
            <label>Select activity advisor</label>
            <select name="advisor_id" class="form-control">
                <option value="<?= $activity['advisor_id'] ?>" selected readonly><?= $activity['advisorname'] . ' (' . $activity['advisor_id'] . ')' ?></option>
            </select>
        </div>
        <!-- HIGHCOM -->
        <div class="row">
            <?php foreach ($highcoms as $highcom) : ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?= $highcom['rolename'] ?></label>
                    <select name="highcoms[<?= $highcom['role_id'] ?>]" class="form-control" readonly>
                        <option value="<?= $highcom['id'] ?>"><?= $highcom['name'] . ' (' . $highcom['id'] . ')' ?></option>
                    </select>
                </div>
            </div>
            <?php endforeach ?>
        </div>

        <div class="form-group">
            <label for="sp_link">SharePoint URL</label>
            <input type="text" name="sp_link" id="sp_link" value="<?= $activity['sp_link'] ?>" class="form-control">
        </div>

        <!-- Start and end date -->
        <div class="row">
            <div class="form-group col-sm-6">
                <label>Datetime start (DT):</label>
                <input name="datetime_start" value="<?= str_replace(' ', 'T', $activity['datetime_start']) ?>" type="datetime-local" id="datetime_start">
            </div>
            <div class="form-group col-sm-6">
                <label>Datetime end (DT):</label>
                <input name="datetime_end" value="<?= str_replace(' ', 'T', $activity['datetime_end']) ?>" type="datetime-local" id="datatime_end">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-outline-primary">Update</button>
    </div>
</div>
<fieldset>

</fieldset>
<?= form_close() ?>
<br>