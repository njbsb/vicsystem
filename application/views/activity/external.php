<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('activity') ?>">Activity</a></li>
    <li class="breadcrumb-item active">External</li>
</ol>

<button class="btn btn-info" data-toggle="modal" data-target="#newexternal">New</button>
<br><br>
<?php if ($externals) : ?>
<?php foreach ($externals as $ext) : ?>
<div class="row">
    <!-- <div class="col-md-4">
        <img src="" alt="" width="200px">
        <div class="card">
            <div class="card-body text-center">
                <h5><?= $ext['title'] ?></h5>
                <span class="badge rounded-pill bg-primary text-white"> <?= $ext['level'] ?> </span>
            </div>
        </div>
    </div> -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4><a href="<?= site_url('activity/external/' . $ext['slug']) ?>"><?= $ext['title'] ?></a></h4>
                <small class="post-date">Level: <?= $ext['level'] ?> | Endorsed by: <?= $ext['mentorname'] ?></small>
                <p><?= sprintf('%s: %s', '<b>' . date_format(date_create($ext['date']), 'M d, Y') . '</b>', $ext['description']) ?></p>
                <a class="btn btn-primary btn-sm" href=""><i class='fas fa-pen'></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col">
                <h6>Participants:</h6>
                <?php if ($ext['participants']) : ?>
                <?php foreach ($ext['participants'] as $participant) : ?>
                <a data-toggle="tooltip" title="<?= $participant['name'] ?>" href="<?= site_url('student/' . $participant['id']) ?>"><img class="rounded-circle" style="object-fit:cover;"
                        src="<?= $participant['userphoto'] ?>" alt="<?= $participant['name'] ?>" width="60px" height="60px"></a>
                <?php endforeach ?>
                <?php endif ?>
            </div>


        </div>
    </div>
</div>
<hr>
<?php endforeach ?>
<?php endif ?>

<div id="newexternal" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new activity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center"><?= $academicsession['academicsession'] ?></h5>
                <?php $hidden = array('acadsession_id' => $academicsession['id']) ?>
                <?= form_open('activity/create_external', '', $hidden) ?>
                <div class="form-group">
                    <label for="">Title</label>
                    <input name="title" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" id="" cols="20" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="">Date</label>
                    <input class="form-control" type="date" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="">Level</label>
                    <select name="activitylevel" id="" class="form-control" required>
                        <option value="" disabled selected>Select activity level</option>
                        <?php foreach ($activitylevels as $level) : ?>
                        <option value="<?= $level['id'] ?>"><?= $level['level'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Endorser Mentor</label>
                    <select class="form-control" name="mentor_id" id="" required>
                        <option value="" selected disabled>Select endorser mentor</option>
                        <?php foreach ($mentors as $mentor) : ?>
                        <option value="<?= $mentor['id'] ?>"><?= $mentor['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <small>You can later add students to be awarded with this badge <a href="">here</a></small>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Submit</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
$('a[data-toggle="tooltip"]').tooltip({
    animated: 'fade',
    placement: 'bottom',
    html: true
});
</script>