<h2><?= $title ?></h2>
<?php if (validation_errors()) : ?>
    <div class="alert alert-dismissible alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4 class="alert-heading">Warning!</h4>
        <p class="mb-0"><?= validation_errors() ?></p>
    </div>

<?php endif ?>

<?php $hidden = array(
    'id' => $activity['id'],
    'photo_path_hidden' => $activity['photo_path'],
    'paperwork_file_hidden' => $activity['paperwork_file']
) ?>
<?= form_open_multipart('activity/update', '', $hidden); ?>
<div class="row">
    <div class="col-md-10 offset-md-1 align-self-center">
        <!-- NAME -->
        <div class="form-group">
            <label>Activity Name</label>
            <input name="activityname" type="text" class="form-control" placeholder="Enter activity name" value="<?= $activity['activity_name'] ?>" readonly>
            <small class="form-text text-muted">Please include unique activity name</small>
        </div>
        <!-- DESCRIPTION -->
        <div class="form-group">
            <label>Activity Description</label>
            <textarea name="activitydesc" class="form-control ckeditor" rows="3"><?= $activity['activity_desc'] ?></textarea>
            <small class="form-text text-muted">Please include summary report of the activity</small>
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
            <label>Select academic session</label>
            <select name="academicsession_id" class="form-control" readonly>
                <option value="<?= $activity['acadsession_id'] ?>"><?= $academicsession['academicsession'] ?></option>
            </select>
        </div>
        <!-- SIG -->
        <div class="form-group">
            <label>Select SIG</label>
            <select name="sig_id" class="form-control" readonly>
                <option value="<?= $sig['id'] ?>"><?= $sig['namecode'] ?></option>
            </select>
        </div>
        <!-- ADVISOR -->
        <div class="form-group">
            <label>Select activity advisor</label>
            <select name="advisor_matric" class="form-control">
                <option value="<?= $activity['advisor_matric'] ?>" selected readonly><?= $activity['advisorname'] . ' (' . $activity['advisor_matric'] . ')' ?></option>
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
        <!-- Activity File and Image -->
        <div class="row">
            <div class="form-group col-sm-6">
                <label>Choose a file (Paperwork)</label>
                <input name="paperwork_file" type="file" class="form-control-file" id="paperwork_file" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">Existing: <?= $activity['paperwork_file'] ? $activity['paperwork_file'] : 'none' ?></small>
            </div>
            <div class="form-group col-sm-6">
                <label>Choose a photo (Activity Image)</label>
                <input name="photo_path" type="file" class="form-control-file" id="photo_path" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">Existing: <?= $activity['photo_path'] ? $activity['photo_path'] : 'none' ?></small>
            </div>
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