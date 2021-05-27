<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Activity</li>
</ol>

<!-- <h2><?= $sig['name'], "'s ", $title ?></h2> -->
<?php if ($this->session->userdata('user_type') == 'mentor') : ?>
<br>
<button class="btn btn-info" data-toggle="modal" data-target="#activity_type">New Activity</button>
<?php endif ?>
<hr>
<table id="activitytable" class="table table-hover" style="text-align:left;">
    <thead class="table-dark">
        <tr>
            <th scope="col">Activity</th>
            <th scope="col">Date</th>
            <th scope="col">Academic Session</th>
            <th scope="col">No of Committees</th>
            <th scope="col">Advisor</th>
        </tr>
    </thead>
    <tbody class="list">
        <?php foreach ($activities as $activity) : ?>
        <tr>
            <td class="Activity" scope="row"><a href="<?= site_url('/activity/' . $activity['slug']) ?>"><?= $activity['title'] ?></a></t>
            <td class="Date"><?= date('d/m/Y', strtotime($activity['datetime_start'])) ?></td>
            <td><?= $activity['academicsession'] ?></td>
            <td><?= $activity['committeenum'] ?></td>
            <td><?= $activity['advisorname'] ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
    <!-- <tfoot>
        <tr>
            <th scope="col">Activity</th>
            <th scope="col">Date</th>
            <th scope="col">Academic Session</th>
            <th scope="col">No of Committees</th>
            <th scope="col">Advisor</th>
        </tr>
    </tfoot> -->
</table>

<?php if ($activities) : ?>
<?php foreach ($activities as $act) : ?>

<div class="row">
    <div class="col-md-3">
        <?php $photo = (isset($act['photo_path'])) ? $act['photo_path'] : 'default_2.jpg' ?>
        <img src="<?= base_url('assets/images/activity/' . $photo) ?>" alt="" style="max-width:280px; display: block; object-fit:cover; padding:10px;">
    </div>
    <div class="col-md-9">
        <h3><a href="<?= site_url('activity/' . $act['slug']) ?>"><?= $act['title'] ?></a></h3>
        <small class="post-date">Created on: <?= date('d/m/Y', strtotime($act['created_at'])) ?></small>
        <p><?= word_limiter($act['description'], 60) ?></p>
    </div>
</div>

<hr>
<?php endforeach ?>
<?php endif ?>

<div id="activity_type" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create new activity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Choose category of activity</p>
                <?= form_open('activity/create') ?>
                <?php foreach ($activitycategory as $actcat) : ?>
                <button name="activity_cat" type="submit" class="btn btn-primary" value="<?= $actcat['code'] ?>"><?= $actcat['category'] . ' (' . $actcat['code'] . ')' ?></button>&nbsp;
                <?php endforeach ?>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#activitytable').DataTable();
});
</script>