<h2>Activity: <?= $activity['activity_name'] ?></h2>

<small>Activity created on <?= $activity['created_at']; ?></small><br>
<br>
<div class="container-fluid text-center">
    <img style="width:auto" src="<?= base_url('assets/images/activity/') . $activity['photo_path'] ?>">
</div>
<h6>Desc</h6>
<?= $activity['activity_desc'] ?>

<!-- <div class="container"> -->
<h6>SIG</h6>
<p><?= $activity['signame'] ?></p>
<h6>Venue</h6>
<p><?= $activity['venue'] ?></p>
<h6>Theme</h6>
<p><?= $activity['theme'] ?></p>
<h6>Date</h6>
<p><?= $activity['datetime_start'] ?> to <?= $activity['datetime_end'] ?></p>
<h6>Advisor</h6>
<p><?= $activity['advisorname'] ?></p>
<!-- </div> -->

<hr>
<div class="row">
    <?= form_open('/activity/edit/' . $activity['slug']); ?>
    <input type="submit" value="Update" class="btn btn-outline-secondary">
    <?= form_close() ?>
    &nbsp;
    <a data-toggle="modal" data-target="#confirmdelete" class="btn btn-outline-danger">Delete activity</a>
</div>
<hr>

<div id="confirmdelete" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('/activity/delete/' . $activity['id']) ?>
            <div class="modal-header">
                <h5 class="modal-title">Confirm delete?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="activityname">Activity:</label>
                    <input value="<?= $activity['activity_name'] ?>" name="activityname" type="text" class="form-control">
                    <input value="<?= $activity['id'] ?>" type="hidden" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete anyway</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>