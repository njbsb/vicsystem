<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Academic Control</li>
</ol>

<h2 class="text-center"><?= $title ?></h2>
<hr>
<!-- ACADEMIC SESSION -->
<div class="row justify-content-between">
    <div class="col-8">
        <h3>Academic Session</h3>
    </div>
    <div class="col-4">
        <button class="btn btn-info margin" data-toggle="modal" data-target="#addacademicsession" style="float: right;">
            <i class='far fa-calendar-plus'></i> New Session
        </button>
    </div>
</div>
<table id="acs_table" class="table table-hover">
    <thead>
        <tr class="table-dark">
            <th>ID</th>
            <th>Academic Year</th>
            <th>Semester</th>
            <th>Status</th>
            <th>Progress</th>
            <th>Active</th>
            <th>End</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($academicsession as $acs) : ?>
        <?php $textclass = ($acs['status'] == 'active') ? 'text-success' : 'text-muted' ?>
        <?php $activedisabled = ($acs['status'] == 'active') ? 'disabled' : '' ?>
        <?php $btnclass = ($acs['status'] == 'active') ? 'btn btn-outline-success btn-sm' : 'btn btn-outline-info btn-sm' ?>
        <?php $enddisabled = ($acs['endofsession'] == 1) ? 'disabled' : '' ?>
        <tr class="table-light">
            <td><?= $acs['id'] ?></td>
            <td><?= $acs['academicyear'] ?></td>
            <td><?= $acs['semester'] ?></td>
            <td class="<?= $textclass ?>"><?= ucfirst($acs['status']) ?></td>
            <?php $progress = ($acs['endofsession']) ? 'Ending' : 'On Going' ?>
            <td><?= $progress ?></td>
            <td><button <?= $activedisabled ?> data-toggle="modal" data-toggle="tooltip" data-placement="top" title="Hooray!" data-target="#setactive_acs" data-string="<?= $acs['academicsession'] ?>"
                    data-acsid="<?= $acs['id'] ?>" class="<?= $btnclass ?>">Activate <i class='fas fa-power-off'></i></button>&nbsp;</td>
            <td><button <?= $enddisabled ?> data-toggle="modal" data-target="#setendsession" data-string="<?= $acs['academicsession'] ?>" data-acsid="<?= $acs['id'] ?>"
                    class="btn btn-outline-primary btn-sm">End <i class='fas fa-stop'></i></button></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<small>End session enables you to upload student's academic result in academic page</small>
<hr>
<!-- ACADEMIC YEAR -->
<div class="row justify-content-between">
    <div class="col-8">
        <h3>Academic Year</h3>
    </div>
    <div class="col-4">
        <button class="btn btn-info margin" data-toggle="modal" data-target="#addacadyear" style="float: right;">
            <i class='far fa-calendar-plus'></i> New Year
        </button>
    </div>
    <hr>
</div>

<table id="acy_table" class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>Academic Year</th>
            <th>Status</th>
            <th>Active</th>
        </tr>
    </thead>
    <tbody class="table-light">
        <?php foreach ($academicyear as $acy) : ?>
        <?php $textclass = ($acy['status'] == 'active') ? 'text-success' : 'text-muted' ?>
        <?php $disabled = ($acy['status'] == 'active') ? 'disabled' : '' ?>
        <tr>
            <!-- <td><?= $acy['id'] ?></td> -->
            <td><?= $acy['acadyear'] ?></td>
            <td class="<?= $textclass ?>"><?= ucfirst($acy['status']) ?></td>
            <td><button <?= $disabled ?> data-toggle="modal" data-target="#setactive_acy" data-string="<?= $acy['acadyear'] ?>" data-acyid="<?= $acy['id'] ?>"
                    class="btn btn-outline-primary btn-sm">Activate <i class='fas fa-power-off'></i></button></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<small>You should only add and activate a year when it's the new academic year.</small>

<div id="addacademicsession" class="modal fade card">
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
                        <?php foreach (array_slice($academicyear, 0, 5) as $acadyear) : ?>
                        <option value="<?= $acadyear['id'] ?>"><?= $acadyear['acadyear'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester">Select semester</label>
                    <select name="semester" id="semester" class="form-control" required>
                        <option value="" selected disabled hidden>Select semester</option>
                        <?php foreach ($semesters as $sem) : ?>
                        <option value="<?= $sem ?>"><?= $sem ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div id="addacadyear" class="modal fade card">
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
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div id="setactive_acs" class="modal fade card">
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
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<div id="setendsession" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('academic/set_endsession') ?>
            <div class="modal-header">
                <h5 class="modal-title">Confirm action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="confirmtext">This will set this academic session to end. Mentor will be able to update students' academic plans with their actual result.</p>
                <div class="form-group">
                    <label hidden>ID</label>
                    <input name="session_id" readonly type="text" class="form-control" hidden>
                </div>
                <div class="form-group">
                    <h5 id="academicsession" class="text-center text-lg-center"></h5>
                </div>
                <small>You will be able to change this only once. Please be careful</small>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">End Session</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div id="setactive_acy" class="modal fade card">
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
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
var tables = ['#acs_table', '#acy_table', '#acp_table'];
$(document).ready(function() {
    $('#acs_table').DataTable({
        "order": []
    });
    $('#acy_table').DataTable({
        "order": []
    });
    var confirmtext = document.getElementById('confirmtext');
    var academicsession = document.getElementById('academicsession');
    $('#setactive_acs').on('show.bs.modal', function(e) {
        var userid = $(e.relatedTarget).data('acsid');
        var acads = $(e.relatedTarget).data('string');
        confirmtext.innerHTML += ' <b>(' + acads + ')</b>';
        $(e.currentTarget).find('input[name="session_id"]').val(userid);
        $(e.currentTarget).find('input[name="session_string"]').val(acads);
    });
    $('#setactive_acs').on('hide.bs.modal', function(e) {
        confirmtext.innerHTML = 'This will set this academic session to active.';
    }); // required to set the value back
    $('#setactive_acy').on('show.bs.modal', function(e) {
        var id = $(e.relatedTarget).data('acyid');
        var years = $(e.relatedTarget).data('string');
        confirmtext.innerHTML += ' <b>(' + years + ')</b>';
        $(e.currentTarget).find('input[name="acadyear_id"]').val(id);
        $(e.currentTarget).find('input[name="year_string"]').val(years);
    });
    $('#setactive_acy').on('hide.bs.modal', function(e) {
        confirmtext.innerHTML = 'This will set this academic year to active.';
    }); // required to set the value back
    $('#setendsession').on('show.bs.modal', function(e) {
        var acsid = $(e.relatedTarget).data('acsid');
        var acads = $(e.relatedTarget).data('string');
        confirmtext.innerHTML += ' <b>(' + acads + ')</b>';
        academicsession.innerHTML = ' <b>(' + acads + ')</b>';
        $(e.currentTarget).find('input[name="session_id"]').val(acsid);
    });
    $('#setendsession').on('hide.bs.modal', function(e) {
        confirmtext.innerHTML = '';
    });
});
</script>