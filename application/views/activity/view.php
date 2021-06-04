<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('activity') ?>">Activity</a></li>
    <li class="breadcrumb-item active"><?= $activity['title'] ?></li>
</ol>

<div class="">
    <p class="text-right">Created on <?= date('jS F Y', strtotime($activity['created_at'])) ?><br>By: <?= $activity['signame'] ?></p>
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <img style="max-width: 100%; object-fit: cover; object-position: center; box-sizing: border-box; border-radius: 12px; background-position: center center;
  background-repeat: no-repeat;" width="50%" height="100%" src="<?= base_url('assets/images/activity.png') ?>" alt="">
            </div>
            <br>
            <h2 class="text-primary"><b><?= $activity['title'] ?></b></h2>
            <small>Session: <?= $activitysession['academicsession'] ?></small>
            <hr>
            <?php if ($activity['description']) : ?>
                <div class="card">
                    <div class="container">
                        <p class="text-justify"><?= $activity['description'] ?></p>
                    </div>
                </div>
                <br>
            <?php endif ?>
            <div class="row">
                <div class="col-lg-4">
                    <div style='font-size:20px'>
                        <i class='fas fa-map-marker-alt'></i> Location
                    </div>
                    <?php $venue = is_null($activity['venue']) ? 'No data' : $activity['venue']; ?>
                    <div style="margin-top:0%">
                        <p class="fs-3"><?= $venue ?></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div style='font-size:20px'>
                        <i class='fas fa-calendar-check'></i> Date
                    </div>
                    <?php $dateStart = (is_null($activity['datetime_start']) or $activity['datetime_start'] == '0000-00-00 00:00:00') ? '' : date('jS M Y', strtotime($activity['datetime_start'])) ?>
                    <?php $dateEnd = (is_null($activity['datetime_end']) or $activity['datetime_end'] == '0000-00-00 00:00:00') ? '' : ' to ' . date('jS M Y', strtotime($activity['datetime_end'])) ?>
                    <div style="margin-top:0%">
                        <p class="fs-3"><?= sprintf('%s %s', $dateStart, $dateEnd) ?></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div style='font-size:20px'>
                        <i class='fas fa-user-cog'></i> Advisor
                    </div>
                    <div style="margin-top:0%">
                        <p class="fs-3"><?= $activity['advisorname'] ?></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div style='font-size:20px'>
                        <i class='fas fa-layer-group'></i> Theme
                    </div>
                    <div>
                        <?php $theme = ($activity['theme']) ? $activity['theme'] : 'No data' ?>
                        <p class="fs-3"><?= $theme ?></p>
                    </div>
                </div>
            </div>

            <?php if ($activity['sp_link']) : ?>
                <div class="form-group">
                    <a data-toggle="tooltip" title="SharePoint folder" target="_blank" href="<?= $activity['sp_link'] ?>"><i class='fas fa-box-open'></i> SharePoint folder</a>
                </div>
            <?php endif ?>
        </div>
        <div class="card-footer">
            <div class="row">
                <?php if ($usertype != 'student' or $isHighcom) : ?>
                    <?php $disableupdatebtn = ($disableupdate) ? 'disabled' : '' ?>
                    <?= form_open('activity/edit/' . $activity['slug']) ?>
                    <button id="editbtn" type="submit" class="btn btn-dark" <?= $disableupdatebtn ?>><i class='fas fa-pen'></i> Edit</button>
                    <?= form_close() ?>
                <?php endif ?>
                &nbsp;
                <?php if ($usertype != 'student') : ?>
                    <?php $disabledeletebtn = ($disabledelete) ? 'disabled' : '' ?>
                    <button id="deletebtn" data-toggle="modal" data-target="#confirmdelete" class="btn btn-outline-danger" <?= $disabledeletebtn ?>>
                        <i class="fa fa-trash"></i> Delete
                    </button>
                <?php endif ?>
            </div>
            <?php if ($oldsession) : ?>
                <div class="row">
                    <small>You can no longer activity that was done in the previous academic session</small>
                </div>
            <?php endif ?>

        </div>
    </div>

</div>

<div id="confirmdelete" class="modal fade card">
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
                <div id="deletemessage">
                    You are about to delete activity: <?= $activity['title'] ?>. You cannot undo this.
                    Proceed?
                </div>
            </div>
            <div class="modal-footer">
                <?php if (!$scoreplan) : ?>
                    <button id="confirmdeletebtn" type="submit" class="btn btn-danger">Delete anyway</button>
                <?php endif ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    var editbtn = document.getElementById("editbtn");
    var deletebtn = document.getElementById("deletebtn");
    // var confirmdeletebtn = document.getElementById("confirmdeletebtn");
    var deletemessage = document.getElementById("deletemessage");
    var scoreplan = JSON.parse(`<?= json_encode($scoreplan) ?>`);
    $('#confirmdelete').on('show.bs.modal', function(e) {
        if (Object.keys(scoreplan).length === 0) {
            deletemessage.innerHTML = 'You are about to delete activity <?= $activity['title'] ?>. You cannot undo this. Proceed?';
            // confirmdeletebtn.remove();
        } else {
            deletemessage.innerHTML = 'You cannot delete an activity that has a score plan registered with it';
        }
    });
</script>