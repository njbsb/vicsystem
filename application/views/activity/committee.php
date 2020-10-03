<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="checkbox_committee" checked="">
        <label class="custom-control-label" for="checkbox_committee">Show committees</label>
    </div>
</div>
<div id="committees" class="col-sm-6">
    <div class="form-group">
        <a data-toggle="modal" data-target="#add_actcommittee" class="btn btn-outline-primary">Add committee</a>
    </div>
    <table id="tbl_committee" class="table table-hover" style="text-align:left;">
        <thead class="table-dark">
            <tr>
                <!-- <th scope="col">No</th> -->
                <th scope="col">Position</th>
                <th scope="col">Name</th>
            </tr>
        </thead>
        <tbody class="list">
            <?php if ($committees) : ?>
                <?php foreach ($committees as $com) : ?>
                    <tr>
                        <td scope="row"><?= $com['rolename'] ?></td>
                        <td scope="row"><?= $com['name'] ?></td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</div>

<div id="add_actcommittee" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- INSERT URL TO ADD ACTIVITY COMMITTEE HERE -->
            <?= form_open('/activity/addcommittee/' . $activity['id']) ?>
            <div class="modal-header">
                <h5 class="modal-title">Add committee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="activity_id">Activity ID</label>
                    <input value="<?= $activity['id'] ?>" type="text" class="form-control" readonly>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#checkbox_committee').click(function() {
            $('#committees').toggle();
        });
    });
</script>