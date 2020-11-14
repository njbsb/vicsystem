<div style="text-align: center;">
    <?php if ($activity['photo_path']) : ?>
        <div class="container-fluid text-center">
            <img style="width:auto" src="<?= base_url('assets/images/activity/') . $activity['photo_path'] ?>">
        </div>
    <?php else : ?>
        <small>This activity does not have any photo uploaded</small>
    <?php endif ?>
    <h1>Activity: <?= $activity['activity_name'] ?></h1>
    <small>Activity created on <?= date('jS F Y', strtotime($activity['created_at'])) ?></small><br>
    <br>
    <h6>Desc</h6>
    <?= $activity['activity_desc'] ?>
    <h6>SIG</h6>
    <p><?= $activity['signame'] ?></p>
    <h6>Venue</h6>
    <?php if ($activity['venue']) : ?>
        <p><?= $activity['venue'] ?></p>
    <?php else : ?>
        <p><small>No venue data recorded</small></p>
    <?php endif ?>
    <h6>Theme</h6>
    <?php if ($activity['theme']) : ?>
        <p><?= $activity['theme'] ?></p>
    <?php else : ?>
        <p><small>No theme data recorded</small></p>
    <?php endif ?>
    <h6>Date</h6>
    <p><?= date('jS F Y \a\t H:i a', strtotime($activity['datetime_start'])) ?>
        <br>to<br>
        <?= date('jS F Y \a\t H:i a', strtotime($activity['datetime_end'])) ?></p>
    <h6>Advisor</h6>
    <p><?= $activity['advisorname'] ?></p>
</div>
<hr>
<div class="container d-flex justify-content-center">
    <div class="row">
        <?php if ($this->session->userdata('isMentor') or $isHighcom) : ?>
            <?= form_open('activity/edit/' . $activity['slug']) ?>
            <input type="submit" value="Update" class="btn btn-outline-primary">
            <?= form_close() ?>
            &nbsp;
            <?php $disabled = ($this->session->userdata('isMentor')) ? '' : 'disabled' ?>
            <button data-toggle="modal" data-target="#confirmdelete" class="btn btn-outline-danger" <?= $disabled ?>>Delete activity</button>
        <?php endif ?>

    </div>
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
                You are about to delete activity: <?= $activity['activity_name'] ?>.
                Proceed?
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete anyway</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>