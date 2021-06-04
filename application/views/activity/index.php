<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Activity</li>
</ol>

<?php if ($this->session->userdata('user_type') == 'mentor') : ?>
    <br>
    <button class="btn btn-dark" data-toggle="modal" data-target="#activity_type"><i class='far fa-calendar-plus'></i> New Activity</button>
    <!-- <a class="btn btn-dark" href="<?= site_url('activity/external') ?>">External</a> -->
<?php endif ?>

<?php if ($this->session->userdata('user_type') != 'student') : ?>
    <hr>
    <div class="text-center">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <label class="btn btn-outline-dark" for="btnradio1">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked=""> Table</label>
            <label class="btn btn-outline-dark" for="btnradio2">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" checked=""> Posts</label>
        </div>
    </div>
    <div id="tableview" class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="activitytable" class="table table-hover" style="text-align:left;">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Activity/Workshop</th>
                            <th scope="col">Date</th>
                            <th scope="col">Academic Session</th>
                            <th scope="col">No of Committees</th>
                        </tr>
                    </thead>
                    <tbody class="list table-active">
                        <?php foreach ($activities as $activity) : ?>
                            <tr>
                                <td class="Activity"><a class="text-dark" href="<?= site_url('/activity/' . $activity['slug']) ?>"><?= $activity['title'] ?></a></t>
                                <td class="Date"><?= date('d/m/Y', strtotime($activity['datetime_start'])) ?></td>
                                <td><?= $activity['academicsession'] ?></td>
                                <td><?= $activity['committeenum'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif ?>
<br>
<?php if ($activities) : ?>
    <?php foreach ($activities as $act) : ?>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="<?= site_url('activity/' . $act['slug']) ?>"><?= $act['title'] ?></a></h4>
                        <span class="badge rounded-pill bg-dark text-white"><?= $act['academicsession'] ?></span>&nbsp;<span class="badge rounded-pill bg-warning"><?= $act['category'] ?></span><small class="post-date">Date:
                            <?= date('d/m/Y', strtotime($act['datetime_start'])) ?></small>
                        <p><?= word_limiter($act['description'], 10) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-6">
                <div class="row">
                    <div class="col">
                        <div class="container">
                            <h6>Committees: <?= $act['committeenum'] ?></h6>
                            <?php if ($act['committees']) : ?>
                                <?php foreach ($act['committees'] as $committee) : ?>
                                    <div class="img-wrap" style="margin:2px;">
                                        <a data-name="<?= $committee['name'] ?>" href="<?= site_url('student/' . $committee['id']) ?>"><img data-toggle="tooltip" data-placement="bottom" title="<?= $committee['role'] ?>" class="rounded-circle" style="object-fit:cover;" src="<?= $committee['userphoto'] ?>" alt="<?= $committee['name'] ?>" width="60px" height="60px"></a>
                                    </div>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <hr>
    <?php endforeach ?>
<?php endif ?>

<div id="activity_type" class="modal fade card">
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
                    <button name="activity_cat" type="submit" class="btn btn-dark" value="<?= $actcat['code'] ?>"><?= $actcat['category'] . ' (' . $actcat['code'] . ')' ?></button>&nbsp;
                <?php endforeach ?>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#activitytable').DataTable({
            "order": []
        });
    });
    var tableradio = document.getElementById('btnradio1');
    var postradio = document.getElementById('btnradio2');

    var radios = document.getElementsByName('btnradio');

    for (var i = 0; i < radios.length; i++) {
        radios[i].onchange = function() {
            radios[i].className = 'btn btn-dark';
        }
    }
</script>