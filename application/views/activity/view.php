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
            <p class="text-justify"><?= $activity['description'] ?></p>
            <!-- <div class="container h-100"> -->
            <div class="row">
                <div class="col-md-4">
                    <span class="iconify" data-icon="ic:outline-place" data-inline="false" style="width:24px; height:24px;"></span>
                    &nbsp;&nbsp;
                    <?php $venue = is_null($activity['venue']) ? 'No data' : $activity['venue']; ?>
                    <b><?= $venue ?></b>
                </div>
                <div class="col-md-4">
                    <?php if (is_null($activity['datetime_start']) and is_null($activity['datetime_end'])) : ?>
                    <span class="iconify" data-icon="akar-icons:calendar" data-inline="false" style="width:24px; height:24px;"></span>
                    &nbsp;&nbsp;<b>No date</b>
                    <?php else : ?>
                    <?php $dateStart = (is_null($activity['datetime_start']) or $activity['datetime_start'] == '0000-00-00 00:00:00') ? '?' : date('jS M Y', strtotime($activity['datetime_start'])) ?>
                    <?php $dateEnd = (is_null($activity['datetime_end']) or $activity['datetime_end'] == '0000-00-00 00:00:00') ? '?' : date('jS M Y', strtotime($activity['datetime_end'])) ?>
                    <span class="iconify" data-icon="akar-icons:calendar" data-inline="false" style="width:24px; height:24px;"></span>
                    &nbsp;&nbsp;<?= $dateStart ?> to <?= $dateEnd ?>
                    <?php endif ?>
                </div>
                <div class="col-md-4">
                    <span class="iconify" data-icon="ic:outline-supervised-user-circle" data-inline="true" style="width:24px; height:24px;"></span>
                    &nbsp;&nbsp;<a href="<?= base_url('mentor/' . $activity['advisor_id']) ?>"><?= $activity['advisorname'] ?></a>
                </div>
            </div>
            <!-- </div> -->
            <br>
            <p><b>Theme: </b><?= $activity['theme'] ?></p>
            <?php if ($activity['sp_link']) : ?>
            <div class="form-group">
                <a class="btn btn-success btn-sm" target="_blank" href="<?= $activity['sp_link'] ?>"><i class='fas fa-box-open'></i> SharePoint</a>
            </div>
            <hr>
            <?php endif ?>
        </div>
        <div class="card-footer">
            <div class="row">
                <?php if ($this->session->userdata('user_type') == 'mentor' or $isHighcom) : ?>
                <?= form_open('activity/edit/' . $activity['slug']) ?>
                <button type="submit" class="btn btn-primary"><i class='fas fa-edit'></i> Update</button>
                <?= form_close() ?>
                &nbsp;
                <?php $disabled = ($this->session->userdata('user_type') == 'mentor') ? '' : 'disabled' ?>
                <button data-toggle="modal" data-target="#confirmdelete" class="btn btn-outline-danger" <?= $disabled ?>>
                    <i class="fa fa-trash"></i> Delete
                </button>
                <?php endif ?>

            </div>
        </div>
    </div>
</div>
<hr>

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
                You are about to delete activity: <?= $activity['title'] ?>. You cannot undo this.
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