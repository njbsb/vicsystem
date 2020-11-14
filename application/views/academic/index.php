<h2 class="text-center"><?= $title ?></h2>
<hr>
<!-- ACADEMIC SESSION -->
<div class="row justify-content-between">
    <div class="col-4">
        <h3>Academic Session</h3>
    </div>
    <div class="col-4">
        <button class="btn btn-outline-primary margin" data-toggle="modal" data-target="#addacademicsession" style="float: right;">Add Academic Session</button>
    </div>
</div>
<table id="acs_table" class="table text-center">
    <thead class="table-dark">
        <tr>
            <td>ID</td>
            <td>Academic Year</td>
            <td>Semester</td>
            <td>Status</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($academicsession as $acs) : ?>
            <tr>
                <td><?= $acs['id'] ?></td>
                <td><?= $acs['academicyear'] ?></td>
                <td><?= $acs['semester_id'] ?></td>
                <?php if ($acs['status'] == 'active') : ?>
                    <td class="text-success"><?= $acs['status'] ?></td>
                <?php else : ?>
                    <td class="text-muted"><?= $acs['status'] ?></td>
                <?php endif ?>
                <!-- <td><?= $acs['status'] ?></td> -->
                <td><a data-toggle="modal" data-target="#setactive_acs" data-string="<?= $acs['academicyear'] . ' Sem ' . $acs['semester_id'] ?>" data-acsid="<?= $acs['id'] ?>" class="btn btn-outline-primary btn-sm" href="#setactive_acs">Toggle Active</a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<hr>
<!-- ACADEMIC YEAR -->
<div class="row justify-content-between">
    <div class="col-4">
        <h3>Academic Year</h3>
    </div>
    <div class="col-4">
        <button class="btn btn-outline-primary margin" data-toggle="modal" data-target="#addacadyear" style="float: right;">Add Academic Year</button>
    </div>
</div>
<table id="acy_table" class="table text-center">
    <thead class="table-dark">
        <tr>
            <td>ID</td>
            <td>Academic Year</td>
            <td>Status</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($academicyear as $acy) : ?>
            <tr>
                <td><?= $acy['id'] ?></td>
                <td><?= $acy['acadyear'] ?></td>
                <?php if ($acy['status'] == 'active') : ?>
                    <td class="text-success"><?= $acy['status'] ?></td>
                <?php else : ?>
                    <td class="text-muted"><?= $acy['status'] ?></td>
                <?php endif ?>

                <td><a data-toggle="modal" data-target="#setactive_acy" data-string="<?= $acy['acadyear'] ?>" data-acyid="<?= $acy['id'] ?>" class="btn btn-outline-primary btn-sm" href="#setactive_acy">Toggle Active</a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<hr>


<div id="addacademicsession" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Academic Session</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('academic/create_academicsession') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="acadyear">Select academic year</label>
                    <select name="acadyear_id" id="acadyear_id" class="form-control" required>
                        <option value="" selected disabled hidden>Select academic year</option>
                        <?php foreach ($academicyear as $acadyear) : ?>
                            <option value="<?= $acadyear['id'] ?>"><?= $acadyear['acadyear'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester">Select semester</label>
                    <select name="semester_id" id="semester_id" class="form-control" required>
                        <option value="" selected disabled hidden>Select semester</option>
                        <?php foreach ($semesters as $sem) : ?>
                            <option value="<?= $sem['id'] ?>"><?= $sem['semester'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div id="addacadyear" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('academic/create_academicyear') ?>
            <div class="modal-header">
                <h5 class="modal-title">Add academic year</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="acadyear">Academic Year:</label>
                    <input name="acadyear" type="text" placeholder="20XX/20XX" readonly value="<?= $new_year ?>" id="acadyear" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div id="setactive_acs" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('academic/set_activesession') ?>
            <div class="modal-header">
                <h5 class="modal-title">Confirm action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="confirmtext">This will set this academic session to active: </p>
                <div class="form-group">
                    <label>ID</label>
                    <input name="session_id" readonly type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Session</label>
                    <input name="session_string" readonly type="text" class="form-control">
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Set active</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div id="setactive_acy" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('academic/set_activeyear') ?>
            <div class="modal-header">
                <h5 class="modal-title">Confirm action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="confirmtext">This will set this academic year to active.</p>
                <div class="form-group">
                    <Label>ID</Label>
                    <input name="acadyear_id" readonly type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Year</label>
                    <input name="year_string" readonly type="text" class="form-control">
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Set active</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    var tables = ['#acs_table', '#acy_table', '#acp_table'];
    $(document).ready(function() {
        $('#acs_table').DataTable();
        $('#acy_table').DataTable();
        var confirmtext = document.getElementById('confirmtext');
        $('#setactive_acs').on('show.bs.modal', function(e) {
            var userid = $(e.relatedTarget).data('acsid');
            var acads = $(e.relatedTarget).data('string');
            confirmtext.innerHTML += ' <b>(' + acads + ')</b>';
            $(e.currentTarget).find('input[name="session_id"]').val(userid);
            $(e.currentTarget).find('input[name="session_string"]').val(acads);
        });
        $('#setactive_acs').on('hide.bs.modal', function(e) {
            confirmtext.innerHTML = 'This will set this academic session to active.';
        });
        $('#setactive_acy').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('acyid');
            var years = $(e.relatedTarget).data('string');
            confirmtext.innerHTML += ' <b>(' + years + ')</b>';
            $(e.currentTarget).find('input[name="acadyear_id"]').val(id);
            $(e.currentTarget).find('input[name="year_string"]').val(years);
        });
        $('#setactive_acy').on('hide.bs.modal', function(e) {
            confirmtext.innerHTML = 'This will set this academic year to active.';
        });
    });
</script>