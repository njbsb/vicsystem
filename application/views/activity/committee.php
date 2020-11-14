<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="checkbox_committee" checked="">
        <label class="custom-control-label" for="checkbox_committee">Show committees</label>
    </div>
</div>
<div id="committees" class="">
    <?php if ($isHighcom or $this->session->userdata('isMentor')) : ?>
        <div class="form-group">
            <a data-toggle="modal" data-target="#add_actcommittee" class="btn btn-outline-primary">Add committee</a>
        </div>
    <?php endif ?>

    <table id="tbl_committee" class="table" style="text-align:left;">
        <thead class="table-dark">
            <tr>
                <th scope="col">Position</th>
                <th scope="col">Name</th>
                <?php if ($isHighcom or $this->session->userdata('isMentor')) : ?>
                    <th></th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody class="list">
            <?php if ($committees) : ?>
                <?php foreach ($committees as $com) : ?>
                    <?php $disabled = (in_array($com['role_id'], $highcoms_id) and !$this->session->userdata('isMentor')) ? 'disabled' : ''; ?>
                    <?php $disabled_nothighcom = ($isHighcom) ? '' : 'disabled' ?>
                    <tr>
                        <td scope="row"><?= $com['rolename'] ?></td>
                        <td scope="row"><?= $com['name'] ?></td>
                        <?php if ($isHighcom or $this->session->userdata('isMentor')) : ?>
                            <td><button data-toggle="modal" data-target="#delete_committee" data-roleid="<?= $com['role_id'] ?>" class="btn-sm btn btn-outline-danger" <?= $disabled ?> <?= $disabled_nothighcom ?>>Delete</button></td>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</div>

<div id="add_actcommittee" class="modal fade">
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
                    <input value="<?= $activity['activity_name'] ?>" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="role_id">Roles</label>
                    <select name="role_id" class="form-control">
                        <?php foreach ($activity_roles as $acr) : ?>
                            <option value="<?= $acr['id'] ?>"><?= $acr['rolename'] ?></option>
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
                            <option value="<?= $sm['id'] ?>"><?= $sm['name'] ?></option>
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

<div id="delete_committee" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('activity/delete_committee') ?>
            <div class="modal-header">
                <h5 class="modal-title">Delete committee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Committee</label>
                    <input type="text" readonly class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Delete committee</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
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
        $('#tbl_committee').DataTable();
    });
</script>