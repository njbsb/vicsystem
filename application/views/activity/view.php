<div class="container">
    <p class="text-right">Created on <?= date('jS F Y', strtotime($activity['created_at'])) ?><br>By: <?= $activity['signame'] ?></p>
    <div class="container-fluid text-center">
        <?php $photopath = ($activity['photo_path']) ? $activity['photo_path'] : 'default_2.jpg' ?>
        <img style="max-width: 100%; object-fit: cover; object-position: center; border: 1.5px solid #B1B1B1; box-sizing: border-box; border-radius: 14px; background-position: center center;
  background-repeat: no-repeat;" width="1280" height="330" src="<?= base_url('assets/images/activity/') . $photopath ?>" alt="">
    </div>
    <h2 class="text-primary"><b><?= $activity['activity_name'] ?></b></h2>
    <p class="text-justify"><?= $activity['activity_desc'] ?></p>
    <div class="container h-100">
        <div class="row">
            <div class="col-md-4">
                <div class="row h-100 align-self-center">
                    <span class="iconify" data-icon="ic:outline-place" data-inline="false" style="width:24px; height:24px;"></span>
                    &nbsp;&nbsp;<b><?= $activity['venue'] ?></b>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row h-100 align-self-center">
                    <span class="iconify" data-icon="akar-icons:calendar" data-inline="false" style="width:24px; height:24px;"></span>
                    &nbsp;&nbsp;<b><?= date('jS M Y', strtotime($activity['datetime_start'])) ?> to <?= date('jS M Y', strtotime($activity['datetime_end'])) ?></b>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row h-100 align-self-center">
                    <span class="iconify" data-icon="ic:outline-supervised-user-circle" data-inline="true" style="width:24px; height:24px;"></span>
                    &nbsp;&nbsp;<b><?= $activity['advisorname'] ?></b>
                </div>
            </div>
        </div>
    </div>
    <br>
    <p><b>Theme: </b><?= $activity['theme'] ?></p>
</div>
<hr>
<!-- <hr> -->
<div class="container d-flex justify-content-start">
    <div class="row">
        <?php if ($this->session->userdata('user_type') == 'mentor' or $isHighcom) : ?>
        <?= form_open('activity/edit/' . $activity['slug']) ?>
        <input type="submit" value="Update" class="btn btn-outline-primary">
        <?= form_close() ?>
        &nbsp;
        <?php $disabled = ($this->session->userdata('user_type') == 'mentor') ? '' : 'disabled' ?>
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
                You are about to delete activity: <?= $activity['activity_name'] ?>. You can undo this.
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