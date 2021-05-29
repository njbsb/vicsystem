<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Organization</li>
</ol>

<h2 class="text-center"><?= $title ?></h2>
<h4 class="text-center"><?= $sig['name'] ?></h4>
<h4 class="text-center"><?= $activeacadyear['acadyear'] ?></h4>

<?php if ($president) : ?>
<div class="row text-center">
    <div class="col-md-4 offset-md-4">
        <div class="card mb-4">
            <h6 class="card-header text-white bg-dark">
                <?= $president['role'] ?>
            </h6>
            <div class="card-body" style="padding-top:0.5rem; padding-bottom:0.5rem;">
                <?php if ($president['userphoto']) : ?>
                <a data-toggle="tooltip" title="<?= $president['name'] ?>" href="<?= site_url('student/' . $president['student_id']) ?>"><img class="rounded-circle" style="object-fit:cover;"
                        src="<?= $president['userphoto'] ?>" alt="" width="150" height="150"></a>
                <?php endif ?>
                <h5 class="card-title" style="margin-bottom: 0.3rem; margin-top:0.4rem;">
                    <?php if ($president['name'] == '-') : ?>
                    <a href="#"><?= $president['name'] ?></a>
                    <?php else : ?>
                    <a href="<?= site_url('/student/' . $president['student_id']) ?>"><?= $president['name'] ?></a>
                    <?php endif ?>
                </h5>
                <p class="card-subtitle text-muted">Year <?= $president['year'] ?></p>
            </div>
        </div>
    </div>
</div>
<?php endif ?>

<div class="row text-center">
    <?php foreach ($secondrows as $rows) : ?>
    <div class="col-md-4">
        <div class="card mb-4">
            <h6 class="card-header text-white bg-dark">
                <?= $rows['role'] ?>
            </h6>
            <div class="card-body" style="padding-top:0.5rem; padding-bottom:0.5rem;">
                <?php if ($rows['userphoto']) : ?>
                <a data-toggle="tooltip" title="<?= $rows['name'] ?>" href="<?= site_url('student/' . $rows['student_id']) ?>"><img class="rounded-circle" style="object-fit:cover;"
                        src="<?= $rows['userphoto'] ?>" alt="" width="150" height="150"></a>
                <?php endif ?>
                <h5 class="card-title" style="margin-bottom: 0.3rem; margin-top:0.4rem;">
                    <?php if ($rows['name'] != '-') : ?>
                    <a href="<?= site_url('/student/' . $rows['student_id']) ?>"><?= $rows['name'] ?></a>
                    <?php else : ?>
                    <a href="#"><?= $rows['name'] ?></a>
                    <?php endif ?>
                </h5>
                <?php if ($rows['year'] != '') : ?>
                <p class="card-subtitle text-muted">Year <?= $rows['year']; ?></p>
                <?php endif ?>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</div>
<hr>
<div class="row text-center justify-content-center">
    <?php if ($orgajks) : ?>
    <?php foreach ($orgajks as $ajk) : ?>
    <div class="col-md-3">
        <div class="card mb-3">
            <div class="card-header bg-dark text-white">
                <h6><?= $ajk['description'] ?> AJK</h6>
            </div>
            <div class="card-body" style="padding-top:0.5rem; padding-bottom:0.5rem;">
                <?php if ($ajk['userphoto']) : ?>
                <a data-toggle="tooltip" title="<?= $ajk['name'] ?>" href="<?= site_url('student/' . $ajk['student_id']) ?>"><img class="rounded-circle" style="object-fit:cover;"
                        src="<?= $ajk['userphoto'] ?>" alt="" width="100" height="100"></a>
                <?php endif ?>
                <h5 class="card-title" style="margin-bottom: 0.3rem; margin-top:0.4rem;">
                    <a href="<?= site_url('/student/' . $ajk['student_id']) ?>">
                        <?= $ajk['name'] ?>
                    </a>
                </h5>
                <?php if ($ajk['year'] != '') : ?>
                <p class="card-subtitle text-muted">Year <?= $ajk['year']; ?></p>
                <?php endif ?>
            </div>
        </div>
    </div>
    <?php endforeach ?>
    <?php else : ?>
    <div class="col align-self-center">
        <p class="">No AJK for the current year</p>
    </div>
    <?php endif ?>
</div>
<hr>
<div class="row justify-content-center">
    <!-- insert members here -->
</div>
<div class="card">
    <div class="card-body">
        <?php if ($isMentor) : ?>
        <button data-toggle="modal" data-target="#registercommittee" class="btn btn-info margin"><i class='fas fa-user-plus'></i> Committee</button>
        <?php endif ?>
        <table id="orgcom_table" class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Matric</th>
                    <th>Name</th>
                    <th>Role</th>
                    <?php if ($this->session->userdata('user_type') == 'mentor') : ?>
                    <th>Action</th>
                    <?php endif ?>
                </tr>
            </thead>
            <tbody class="table-active">
                <?php foreach ($sigcommittees as $sigcom) : ?>
                <tr>
                    <td><?= $sigcom['student_id'] ?></td>
                    <td><?= $sigcom['name'] ?></td>
                    <td><?= $sigcom['role'] ?></td>
                    <?php if ($this->session->userdata('user_type') == 'mentor') : ?>
                    <td><a class="btn btn-outline-danger btn-sm" data-stdrole="<?= $sigcom['role'] ?>" data-roleid="<?= $sigcom['role_id'] ?>" data-stdname="<?= $sigcom['name'] ?>"
                            data-stdmatric="<?= $sigcom['student_id'] ?>" data-toggle="modal" data-target="#delete_orgcom"><i class="fa fa-trash"></i></a></td>
                    <?php endif ?>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<div id="delete_orgcom" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $hidden = array('acadyear_id' => $activeacadyear['id']) ?>
            <?= form_open('organization/delete_committee', '', $hidden) ?>
            <div class="modal-header">
                <h5 class="modal-title">Delete organization committee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Matric</label>
                    <input name="stdmatric" type=" text" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input name="stdname" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Position/Role</label>
                    <input name="stdrole" type="text" class="form-control" readonly>
                    <input name="role_id" type="text" class="form-control" hidden>
                </div>
                <p>Confirm to delete this committee?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete role</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div id="registercommittee" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $hidden = array(
                'acadyear_id' => $activeacadyear['id'],
                'sig_id' => $sig['code']
            ); ?>
            <?= form_open('organization/register_committee', '', $hidden) ?>
            <div class="modal-header">
                <h5 class="modal-title">Register new committee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="acadyear_id">Current Academic Year</label>
                    <input name="acadyear" type="text" value="<?= $activeacadyear['acadyear'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role_id" class="form-control" required>
                        <?php foreach ($roles_org as $rorg) : ?>
                        <option value="<?= $rorg['id'] ?>"><?= $rorg['role'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input name="description" type="text" class="form-control">
                    <small>Only necessary when registering AJK</small>
                </div>
                <div class="form-group">
                    <label for="student_id">Member</label>
                    <select name="student_id" id="student_id" class="form-control" required>
                        <?php foreach ($sig_member as $sm) : ?>
                        <option value="<?= $sm['id'] ?>"><?= $sm['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <small>You can only select students who joined 4 years back</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Register</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#orgcom_table').DataTable({
        "order": []
    });
});
var confirmtext = document.getElementById('confirmtext');
$('#delete_orgcom').on('show.bs.modal', function(e) {
    var matric = $(e.relatedTarget).data('stdmatric');
    var name = $(e.relatedTarget).data('stdname');
    var rolename = $(e.relatedTarget).data('stdrole');
    var roleid = $(e.relatedTarget).data('roleid');
    $(e.currentTarget).find('input[name="stdmatric"]').val(matric);
    $(e.currentTarget).find('input[name="stdname"]').val(name);
    $(e.currentTarget).find('input[name="stdrole"]').val(rolename);
    $(e.currentTarget).find('input[name="role_id"]').val(roleid);
});

$('a[data-toggle="tooltip"]').tooltip({
    animated: 'fade',
    placement: 'bottom',
    html: true
});
</script>