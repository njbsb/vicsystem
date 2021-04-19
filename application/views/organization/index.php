<h2 class="text-center"><?= $title ?></h2>
<h4 class="text-center"><?= $sig['name'] ?></h4>
<h4 class="text-center"><?= $activeacadyear['acadyear'] ?></h4>

<?php if ($president) : ?>
<div class="row text-center">
    <div class="col-md-4 offset-md-4">
        <div class="card mb-4">
            <h4 class="card-header text-white bg-dark">
                <?= $president['rolename'] ?>
            </h4>
            <img style="max-height:240px; max-width:auto; display: block; object-fit:cover;  padding:10px;" src="<?= base_url('assets/images/profile/' . $president['profile_image']); ?>"
                alt="<?= $president['profile_image']; ?>">
            <div class="card-body">
                <h5 class="card-title">
                    <?php if ($president['name'] == '-') : ?>
                    <a href="#"><?= $president['name'] ?></a>
                    <?php else : ?>
                    <a href="<?= site_url('/student/' . $president['student_matric']) ?>"><?= $president['name'] ?></a>
                    <?php endif ?>
                </h5>
                <h6 class="card-subtitle text-muted"><?= $president['student_matric']; ?></h6>
            </div>
            <div class="card-footer text-muted">
                <?= $president['email'] ?>
            </div>
        </div>
    </div>
</div>
<?php endif ?>

<div class="row text-center">
    <?php foreach ($secondrows as $rows) : ?>
    <div class="col-md-4">
        <div class="card mb-4">
            <h4 class="card-header text-white bg-dark">
                <?= $rows['rolename'] ?>
            </h4>
            <img style="max-height:240px; max-width:auto; display: block; object-fit:cover;  padding:10px;" src="<?= base_url('assets/images/profile/' . $rows['profile_image']); ?>"
                alt="<?= $rows['profile_image']; ?>">
            <div class="card-body">
                <h5 class="card-title">
                    <?php if ($rows['name'] != '-') : ?>
                    <a href="<?= site_url('/student/' . $rows['student_matric']) ?>"><?= $rows['name'] ?></a>
                    <?php else : ?>
                    <a href="#"><?= $rows['name'] ?></a>
                    <?php endif ?>

                </h5>
                <h6 class="card-subtitle text-muted"><?= $rows['student_matric']; ?></h6>
            </div>
            <div class="card-footer text-muted">
                <?= $rows['email'] ?>
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
            <div class="card-header bg-dark">
                <h4 class="text-white ">
                    <?= $ajk['rolename']; ?>
                </h4>
                <span class="badge badge-pill badge-light"><?= $ajk['role_desc'] ?></span>
            </div>
            <img style="max-height:240px; max-width:auto; display: block; object-fit:cover;  padding:10px;" src="<?= base_url('assets/images/profile/' . $ajk['profile_image']); ?>"
                alt="<?= $ajk['profile_image']; ?>">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="<?= site_url('/student/' . $ajk['student_id']) ?>">
                        <?= $ajk['name'] ?>
                    </a>
                </h5>
                <h6 class="card-subtitle text-muted"><?= $ajk['student_id']; ?></h6>
            </div>
            <div class="card-footer text-muted">
                <?= $ajk['email'] ?>
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
<?php if ($isMentor) : ?>
<button data-toggle="modal" data-target="#registercommittee" class="btn btn-outline-primary margin">Add new committee</button>
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
    <tbody>
        <?php foreach ($sigcommittees as $sigcom) : ?>
        <tr>
            <td><?= $sigcom['student_matric'] ?></td>
            <td><?= $sigcom['name'] ?></td>
            <td><?= $sigcom['rolename'] ?></td>
            <?php if ($this->session->userdata('user_type') == 'mentor') : ?>
            <td><a class="btn btn-outline-warning btn-sm" data-stdrole="<?= $sigcom['rolename'] ?>" data-stdname="<?= $sigcom['name'] ?>" data-stdmatric="<?= $sigcom['student_matric'] ?>"
                    data-toggle="modal" data-target="#delete_orgcom">Delete</a></td>
            <?php endif ?>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<div id="delete_orgcom" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $hidden = array('sig_id' => $sig['code']) ?>
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
                </div>
                <p>Confirm to delete this committee?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Delete role</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div id="registercommittee" class="modal fade">
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
                    <label for="role_desc">Description</label>
                    <input name="role_desc" type="text" class="form-control">
                    <small>Only necessary when registering AJK</small>
                </div>
                <div class="form-group">
                    <label for="student_id">Member</label>
                    <select name="student_id" id="student_id" class="form-control" required>
                        <?php foreach ($sig_member as $sm) : ?>
                        <option value="<?= $sm['id'] ?>"><?= $sm['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Register</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#orgcom_table').DataTable();
});
var confirmtext = document.getElementById('confirmtext');
$('#delete_orgcom').on('show.bs.modal', function(e) {
    var matric = $(e.relatedTarget).data('stdmatric');
    var name = $(e.relatedTarget).data('stdname');
    var rolename = $(e.relatedTarget).data('stdrole');
    $(e.currentTarget).find('input[name="stdmatric"]').val(matric);
    $(e.currentTarget).find('input[name="stdname"]').val(name);
    $(e.currentTarget).find('input[name="stdrole"]').val(rolename);
});
</script>