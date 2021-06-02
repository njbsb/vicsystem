<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('activity') ?>">Activity</a></li>
    <li class="breadcrumb-item active">External</li>
</ol>

<?php $usertype =  $this->session->userdata('user_type') ?>

<?php if ($usertype != 'student') : ?>
<button class="btn btn-info" data-toggle="modal" data-target="#newexternal"><i class='far fa-calendar-plus'></i> New</button>
<br>
<?php endif ?>
<br>
<?php if ($externals) : ?>
<?php foreach ($externals as $i => $ext) : ?>
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <h4><a href="<?= site_url('activity/external/' . $ext['slug']) ?>"><?= $ext['title'] ?></a></h4>
                <span class="badge rounded-pill bg-warning"><?= $ext['level'] ?></span><small class="post-date">Endorsed by: <?= $ext['mentorname'] ?></small>
                <p><?= sprintf('%s: %s', '<b>' . date_format(date_create($ext['date']), 'M d, Y') . '</b>', $ext['description']) ?></p>
                <?php if ($usertype != 'student') : ?>
                <a data-toggle="modal" data-target="#editexternal" data-id="<?= $ext['id'] ?>" data-title="<?= $ext['title'] ?>" data-description="<?= $ext['description'] ?>"
                    data-date="<?= $ext['date'] ?>" class="btn btn-primary btn-sm" href=""><i data-toggle="tooltip" title="Edit Activity" class='fas fa-pen'></i></a>
                <a data-toggle="modal" data-target="#addparticipant" data-externalid="<?= $ext['id'] ?>" data-title="<?= $ext['title'] ?>" class="btn btn-primary btn-sm" href=""><i
                        data-toggle="tooltip" title="Add Participant" class='fas fa-user-plus'></i></a>
                <a data-toggle="modal" data-target="#deleteexternal" data-externalid="<?= $ext['id'] ?>" data-externaltitle="<?= $ext['title'] ?>" class="btn btn-primary btn-sm" href=""><i
                        data-toggle="tooltip" title="Delete Activity" class='fa fa-trash'></i></a>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="row">
            <div class="col">
                <h6>Participants:</h6>
                <?php if ($ext['participants']) : ?>
                <?php foreach ($ext['participants'] as $participant) : ?>
                <div class="img-wrap">
                    <?php if ($usertype != 'student') : ?>
                    <a data-toggle="modal" data-target="#deleteparticipant" data-title="<?= $ext['title'] ?>" data-name="<?= $participant['name'] ?>" data-userid="<?= $participant['id'] ?>"
                        data-externalid="<?= $ext['id'] ?>" class="close">&times;</a>
                    <?php endif ?>
                    <a data-name="<?= $participant['name'] ?>" href="<?= site_url('student/' . $participant['id']) ?>"><img data-toggle="tooltip" title="<?= $participant['name'] ?>"
                            class="rounded-circle" style="object-fit:cover;" src="<?= $participant['userphoto'] ?>" alt="<?= $participant['name'] ?>" width="60px" height="60px"></a>
                </div>
                <?php endforeach ?>
                <?php endif ?>
            </div>


        </div>
    </div>
</div>
<hr>
<?php endforeach ?>
<?php endif ?>

<?php if ($usertype != 'student') : ?>
<div id="newexternal" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new activity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $sessiontext = ($academicsession) ? $academicsession['academicsession'] : '?' ?>
                <h5 class="text-center"><?= $sessiontext ?></h5>
                <?php $hidden = ($academicsession) ? array('acadsession_id' => $academicsession['id']) : array() ?>
                <?= form_open('activity/create_external', '', $hidden) ?>
                <div id="externalformdiv">
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
                </div>
                <small>You can only add external activity within the currently active academic session</small>
            </div>
            <div class="modal-footer">
                <div id="externalbtndiv">
                    <button id="btnaddexternal" class="btn btn-primary" type="submit">Submit</button>
                </div>

                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div id="editexternal" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('activity/update_external') ?>
            <div class="modal-header">
                <h5 class="modal-title">Edit External Activity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Title</label>
                    <input name="edittitle" id="edittitle" type=" text" class="form-control" required>
                    <input type="text" id="editid" name="editid" class="form-control" required hidden>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="editdescription" id="editdescription" cols="20" rows="3" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input class="form-control" type="date" id="editdate" name="editdate" required>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btneditexternal" type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div id="addparticipant" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('activity/add_externalparticipant') ?>
            <div class="modal-header">
                <h5 class="modal-title">Add Participant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <h5 id="texttitle" class="text-center text-pink"></h5>
                    <!-- <input type="text" class="form-control" name="title" readonly> -->
                </div>
                <div class="form-group">
                    <select name="student_id" id="student_id" class="form-control" data-live-search="true" onchange="enablebtnadd()" required>
                        <option value="" selected disabled>Select student</option>
                        <?php if ($students) : ?>
                        <?php foreach ($students as $student) : ?>
                        <option data-tokens="<?= $student['name'] ?>" value="<?= $student['matric'] ?>"><?= $student['name'] ?></option>
                        <?php endforeach ?>
                        <?php endif ?>
                    </select>
                    <input type="text" class="form-control" name="external_id" hidden>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnaddparticipant" type="submit" class="btn btn-primary" disabled>Add</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<div id="deleteparticipant" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('activity/delete_externalparticipant') ?>
            <div class="modal-header">
                <h5 class="modal-title">Delete Participant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <h5 id="texttitle" class="text-center text-pink"></h5>
                    <input type="text" class="form-control" name="deleteexternalid" readonly hidden required>
                </div>
                <div class="form-group">
                    <img src="" alt="">
                    <label for="">Student</label>
                    <input type="text" class="form-control" name="deletename" readonly>
                    <input type="text" class="form-control" name="deleteuserid" readonly hidden required>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btndeleteparticipant" type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<div id="deleteexternal" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('activity/delete_externalactivity') ?>
            <div class="modal-header">
                <h5 class="modal-title">Delete Activity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <h5 id="deletetitle" class="text-center text-pink"></h5>
                    <input type="text" class="form-control" name="deleteexternalid" readonly required hidden>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btndeleteexternal" type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?php endif ?>



<script>
var externalformdiv = document.getElementById("externalformdiv");
var externalbtndiv = document.getElementById("externalbtndiv");
var btnaddparticipant = document.getElementById("btnaddparticipant");
var btnaddexternal = document.getElementById("btnaddexternal");
var selectstudent = document.getElementById("student_id");
var student_id = selectstudent.value;
var activesession = <?= json_encode($academicsession) ?>;
if (!activesession) {
    externalbtndiv.remove();
    externalformdiv.remove();
}
if (student_id) {
    btnaddparticipant.disabled = false;
} else {
    btnaddparticipant.disabled = true;
}

$('#editexternal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    var title = $(e.relatedTarget).data('title');
    var description = $(e.relatedTarget).data('description');
    var date = $(e.relatedTarget).data('date');
    $(e.currentTarget).find('input[name="editid"]').val(id);
    $(e.currentTarget).find('input[name="edittitle"]').val(title);
    $(e.currentTarget).find('textarea[name="editdescription"]').val(description);
    $(e.currentTarget).find('input[name="editdate"]').val(date);
});
var texttitle = document.getElementById('texttitle');
$('#addparticipant').on('show.bs.modal', function(e) {
    var title = $(e.relatedTarget).data('title');
    var external_id = $(e.relatedTarget).data('externalid');
    $(e.currentTarget).find('input[name="external_id"]').val(external_id);
    $(e.currentTarget).find('input[name="title"]').val(title);
    texttitle.innerHTML += title;
});
$('#addparticipant').on('hide.bs.modal', function(e) {
    texttitle.innerHTML = '';
});
//
$('#deleteparticipant').on('show.bs.modal', function(e) {
    var title = $(e.relatedTarget).data('title');
    var external_id = $(e.relatedTarget).data('externalid');
    var name = $(e.relatedTarget).data('name');
    var userid = $(e.relatedTarget).data('userid');
    $(e.currentTarget).find('input[name="deleteexternalid"]').val(external_id);
    $(e.currentTarget).find('input[name="deletename"]').val(name);
    $(e.currentTarget).find('input[name="deleteuserid"]').val(userid);
    texttitle.innerHTML += title;
});
$('#deleteparticipant').on('hide.bs.modal', function(e) {
    texttitle.innerHTML = '';
});
//
var deletetext = document.getElementById("deletetitle");
$('#deleteexternal').on('show.bs.modal', function(e) {
    var externalid = $(e.relatedTarget).data('externalid');
    var externaltitle = $(e.relatedTarget).data('externaltitle');
    $(e.currentTarget).find('input[name="deleteexternalid"]').val(externalid);
    deletetext.innerHTML += externaltitle;
});
$('#deleteexternal').on('hide.bs.modal', function(e) {
    deletetext.innerHTML = '';
});
$('[data-toggle="tooltip"]').tooltip({
    animated: 'fade',
    placement: 'bottom',
    html: true
});
</script>