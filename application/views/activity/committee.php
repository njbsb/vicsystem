<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="checkbox_committee" checked="">
        <label class="custom-control-label" for="checkbox_committee">Show committees</label>
    </div>
</div>
<div id="committees" class="card">
    <div class="card-body">
        <?php if ($isHighcom or $this->session->userdata('user_type') == 'mentor') : ?>
        <div class="form-group">
            <a data-toggle="modal" data-target="#add_actcommittee" class="btn btn-info"><i class='fas fa-user-plus'></i> Add</a>
        </div>
        <?php endif ?>

        <div class="table-responsive">
            <table id="tbl_committee" class="table table-hover" style="text-align:left;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Matric</th>
                        <th scope="col">Name</th>
                        <th scope="col">Position</th>
                        <?php if ($isHighcom or ($this->session->userdata('username') == $activity['advisor_id'])) : ?>
                        <th></th>
                        <?php endif ?>
                    </tr>
                </thead>
                <tbody class="list table-active">
                    <?php if ($committees) : ?>
                    <?php foreach ($committees as $com) : ?>
                    <?php $fullrole = ($com['role'] == 'Committee Member') ? sprintf('%s AJK', $com['description'])  : $com['role'] ?>
                    <tr>
                        <td scope="row"><?= $com['student_id'] ?></td>
                        <td scope="row"><?= $com['name'] ?></td>
                        <td scope="row"><?= $fullrole ?></td>
                        <?php if ($isHighcom or ($this->session->userdata('username') == $activity['advisor_id'])) : ?>
                        <!-- only advisor and highcom can see the delete button -->
                        <?php $disabled = ($isHighcom and in_array($com['role_id'], $highcoms_id)) ? 'disabled' : '' ?>
                        <td><button data-toggle="modal" data-target="#delete_committee" data-studentid="<?= $com['student_id'] ?>" data-name="<?= $com['name'] ?>" data-role="<?= $com['role'] ?>"
                                data-roleid="<?= $com['role_id'] ?>" class="btn-sm btn btn-outline-danger" <?= $disabled ?>>
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                        <?php endif ?>
                    </tr>
                    <?php endforeach ?>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="add_actcommittee" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $hidden = array('activity_id' => $activity['id']) ?>
            <?= form_open('/activity/addcommittee/' . $activity['id'], '', $hidden) ?>
            <div class="modal-header">
                <h5 class="modal-title">Add committee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="activity_id">Activity</label>
                    <input value="<?= $activity['title'] ?>" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="role_id">Roles</label>
                    <select name="role_id" class="form-control">
                        <?php foreach ($activity_roles as $acr) : ?>
                        <option value="<?= $acr['id'] ?>"><?= $acr['role'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="role_desc">Role Description</label>
                    <input name="role_desc" type="text" class="form-control">
                    <small>Only fill this field when registering for Committee Member (AJK)</small>
                </div>
                <div class="form-group">
                    <label for="student_matric">Member</label>
                    <select name="student_matric" class="form-control">
                        <?php foreach ($sig_members as $sm) : ?>
                        <option value="<?= $sm['id'] ?>">
                            <?= $sm['name'] ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add committee</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div id="delete_committee" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $hidden = array('activity_id' => $activity['id'], 'slug' => $activity['slug']) ?>
            <?= form_open('activity/delete_committee', '', $hidden) ?>
            <div class="modal-header">
                <h5 class="modal-title">Delete committee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="deletename" readonly>
                    <input type="text" class="form-control" name="deletestudentid" readonly hidden>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <input type="text" name="deleterole" class="form-control" readonly>
                    <input type="text" name="deleteroleid" class="form-control" readonly hidden>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#checkbox_committee').click(function() {
        $('#committees').toggle();
    });
    $('#tbl_committee').DataTable({
        "order": []
    });
});

$('#delete_committee').on('show.bs.modal', function(e) {
    var name = $(e.relatedTarget).data('name');
    var student_id = $(e.relatedTarget).data('studentid');
    var role = $(e.relatedTarget).data('role');
    var role_id = $(e.relatedTarget).data('roleid');
    $(e.currentTarget).find('input[name="deletename"]').val(name);
    $(e.currentTarget).find('input[name="deletestudentid"]').val(student_id);
    $(e.currentTarget).find('input[name="deleterole"]').val(role);
    $(e.currentTarget).find('input[name="deleteroleid"]').val(role_id);
});
</script>