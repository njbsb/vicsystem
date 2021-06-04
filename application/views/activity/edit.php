<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('activity') ?>">Activity</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('activity/' . $activity['slug']) ?>"><?= $activity['title'] ?></a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>
<br>
<?php if (validation_errors()) : ?>
<div class="alert alert-dismissible alert-warning">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Warning!</h4>
    <p class="mb-0"><?= validation_errors() ?></p>
</div>
<?php endif ?>

<?php $hidden = array('id' => $activity['id']) ?>
<?= form_open_multipart('activity/update', '', $hidden); ?>
<div class="row">
    <div class="col-md-12 col-sm-6">
        <div class="card">
            <div class="card-body">
                <!-- NAME -->
                <div class="form-group">
                    <label>Activity Name</label>
                    <input name="title" type="text" class="form-control form-control-lg" placeholder="Enter activity name" value="<?= $activity['title'] ?>" required>
                    <small class="form-text text-muted">Please include unique activity name</small>
                </div>
                <!-- DESCRIPTION -->
                <div class="form-group">
                    <label>Activity Description</label>
                    <textarea name="description" class="form-control ckeditor" rows="2"><?= $activity['description'] ?></textarea>
                    <small class="form-text text-muted">Please include summary of the activity</small>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-5 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>Venue</label>
                    <input name="venue" type="text" class="form-control" placeholder="Enter venue name" value="<?= $activity['venue'] ?>">
                </div>
                <div class="form-group">
                    <label>Theme</label>
                    <input name="theme" type="text" class="form-control" placeholder="Enter activity theme" value="<?= $activity['theme'] ?>">
                </div>
                <!-- Start and end date -->
                <div class="form-group">
                    <label>Datetime start:</label><br>
                    <input class="form-control" name="datetime_start" value="<?= str_replace(' ', 'T', $activity['datetime_start']) ?>" type="datetime-local" id="datetime_start" required>
                </div>
                <div class="form-group">
                    <label>Datetime end:</label><br>
                    <input class="form-control" name="datetime_end" value="<?= str_replace(' ', 'T', $activity['datetime_end']) ?>" type="datetime-local" id="datatime_end" required>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>Activity Advisor</label>
                    <select name="advisor_id" class="form-control" required>
                        <option value="<?= $activity['advisor_id'] ?>" selected readonly><?= $activity['advisorname'] . ' (' . $activity['advisor_id'] . ')' ?></option>
                    </select>
                </div>
                <div class="row">
                    <?php foreach ($highcomroles as $role) : ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""><?= $role['role'] ?></label>
                            <select name="highcoms[<?= $role['id'] ?>]" id="" class="form-control" required>
                                <?php if ($role['student']) : ?>
                                <option value="<?= $role['student']['student_id'] ?>" selected><?= $role['student']['name'] ?></option>
                                <?php else : ?>
                                <option value="" disabled hidden selected>Please select a student</option>
                                <?php if ($activestudents) : ?>
                                <?php foreach ($activestudents as $student) : ?>
                                <?php $selected = ($student['id'] == $role['student']['student_id'] and $role['student']) ? 'selected' : '' ?>
                                <option value="<?= $student['id'] ?>" <?= $selected ?>>
                                    <?= $student['name'] ?>
                                </option>
                                <?php endforeach ?>
                                <?php endif ?>
                                <?php endif ?>
                            </select>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>

                <div class="form-group">
                    <label for="sp_link">SharePoint URL</label>
                    <input type="text" name="sp_link" id="sp_link" value="<?= $activity['sp_link'] ?>" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>

<hr>

<button type="submit" class="btn btn-primary"><i class='fas fa-save'></i> Update</button>
<?= form_close() ?>
<br>