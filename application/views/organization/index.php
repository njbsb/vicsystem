<h2 class="text-center"><?= $title ?></h2>
<h4 class="text-center"><?= $sig['signame'] ?></h4>
<h4 class="text-center"><?= $activeacadyear['acadyear'] ?></h4>

<?php if ($president) : ?>
    <div class="row text-center">
        <div class="col-md-4 offset-md-4">
            <div class="card mb-4">
                <h4 class="card-header text-white bg-dark">
                    <?= $president['rolename'] ?>
                </h4>
                <img style="max-height:240px; max-width:auto; display: block; object-fit:cover;  padding:10px;" src="<?= base_url('assets/images/profile/' . $president['profile_image']); ?>" alt="<?= $president['profile_image']; ?>">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="<?= site_url('/student/' . $president['student_matric']) ?>"><?= $president['name'] ?></a>
                    </h5>
                    <h6 class="card-subtitle text-muted"><?= $president['student_matric']; ?></h6>
                </div>
                <div class="card-footer text-muted">
                    <?= $president['email'] ?>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <p class="text-center">No President for the current year</p>
<?php endif ?>

<div class="row text-center">
    <div class="col-md-4">
        <?php if ($secretary) : ?>
            <div class="card mb-4">
                <h4 class="card-header text-white bg-dark">
                    <?= $secretary['rolename'] ?>
                </h4>
                <img style="max-height:240px; max-width:auto; display: block; object-fit:cover;  padding:10px;" src="<?= base_url('assets/images/profile/' . $secretary['profile_image']); ?>" alt="<?= $secretary['profile_image']; ?>">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="<?= site_url('/student/' . $secretary['student_matric']) ?>"><?= $secretary['name'] ?></a>
                    </h5>
                    <h6 class="card-subtitle text-muted"><?= $secretary['student_matric']; ?></h6>
                </div>
                <div class="card-footer text-muted">
                    <?= $secretary['email'] ?>
                </div>
            </div>
        <?php else : ?>
            <p class="text-center">No secretary for the current year</p>
        <?php endif ?>
    </div>
    <div class="col-md-4">
        <?php if ($deputypresident) : ?>
            <div class="card mb-4">
                <h4 class="card-header text-white bg-dark">
                    <?= $deputypresident['rolename']; ?>
                </h4>
                <img style="max-height:240px; max-width:auto; display: block; object-fit:cover;  padding:10px;" src="<?= base_url('assets/images/profile/' . $deputypresident['profile_image']); ?>" alt="<?= $deputypresident['profile_image']; ?>">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="<?= site_url('/student/' . $deputypresident['student_matric']) ?>"><?= $deputypresident['name'] ?></a>
                    </h5>
                    <h6 class="card-subtitle text-muted"><?= $deputypresident['student_matric']; ?></h6>
                </div>
                <div class="card-footer text-muted">
                    <?= $deputypresident['email'] ?>
                </div>
            </div>
        <?php else : ?>
            <p class="text-center">No deputy president for the current year</p>
        <?php endif ?>
    </div>
    <div class="col-md-4">
        <?php if ($treasurer) : ?>
            <div class="card mb-4">
                <h4 class="card-header text-white bg-dark">
                    <?= $treasurer['rolename']; ?>
                </h4>
                <img style="max-height:240px; max-width:auto; display: block; object-fit:cover;  padding:10px;" src="<?= base_url('assets/images/profile/' . $treasurer['profile_image']); ?>" alt="<?= $treasurer['profile_image']; ?>">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="<?= site_url('/student/' . $treasurer['student_matric']) ?>">
                            <?= $treasurer['name'] ?>
                        </a>
                    </h5>
                    <h6 class="card-subtitle text-muted"><?= $treasurer['student_matric']; ?></h6>
                </div>
                <div class="card-footer text-muted">
                    <?= $treasurer['email'] ?>
                </div>
            </div>
        <?php else : ?>
            <p class="text-center">No treasurer for the current year</p>
        <?php endif ?>
    </div>
</div>
<hr>
<div class="row text-center justify-content-center">
    <?php if ($orgajks) : ?>
        <?php foreach ($orgajks as $ajk) : ?>
            <div class="col-md-3">
                <div class="card mb-3">
                    <h4 class="card-header text-white bg-dark">
                        <?= $ajk['rolename']; ?>
                    </h4>
                    <img style="max-height:240px; max-width:auto; display: block; object-fit:cover;  padding:10px;" src="<?= base_url('assets/images/profile/' . $ajk['profile_image']); ?>" alt="<?= $ajk['profile_image']; ?>">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="<?= site_url('/student/' . $ajk['student_matric']) ?>">
                                <?= $ajk['name'] ?>
                            </a>
                        </h5>
                        <h6 class="card-subtitle text-muted"><?= $ajk['student_matric']; ?></h6>
                    </div>
                    <div class="card-footer text-muted">
                        <?= $ajk['email'] ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    <?php else : ?>
        <div class="col-md-4 offset-md-4">
            <p class="text-center">No AJK for the current year</p>
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
            <?php if ($this->session->userdata('isMentor')) : ?>
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
                <?php if ($this->session->userdata('isMentor')) : ?>
                    <td><a class="btn btn-outline-warning btn-sm" data-stdrole="<?= $sigcom['rolename'] ?>" data-stdname="<?= $sigcom['name'] ?>" data-stdmatric="<?= $sigcom['student_matric'] ?>" data-toggle="modal" data-target="#delete_orgcom">Delete</a></td>
                <?php endif ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<div id="delete_orgcom" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $hidden = array('sig_id' => $sig['id']) ?>
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
                'sig_id' => $sig['id']
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
                            <option value="<?= $rorg['id'] ?>"><?= $rorg['rolename'] ?></option>
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