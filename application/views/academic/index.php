<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Academic Control</li>
</ol>

<h2 class="text-center"><?= $title ?></h2>
<hr>
<!-- ACADEMIC SESSION -->
<div class="row justify-content-between">
    <div class="col-8">
        <?php if ($activeyear) : ?>
            <h3><?= sprintf('Academic Session: %s', $activeyear['acadyear']) ?></h3>
        <?php else : ?>
            <h3><?= 'Academic Session: -' ?></h3>
        <?php endif ?>

    </div>
    <div class="col-4">
        <button id="btn_acs" class="btn btn-dark margin" data-toggle="modal" data-target="#addacademicsession" style="float: right;">
            <i class='far fa-calendar-plus'></i> New Session
        </button>
    </div>
</div>
<div class="table-responsive">
    <table id="acs_table" class="table table-hover">
        <thead>
            <tr class="table-dark">
                <th>Academic Year</th>
                <th>Semester</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Progress</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($academicsession as $acs) : ?>
                <?php $textclass = ($acs['status'] == 'active') ? 'text-success' : 'text-muted' ?>
                <?php $btnclass = ($acs['status'] == 'active') ? 'btn btn-outline-success btn-sm' : 'btn btn-outline-info btn-sm' ?>
                <tr class="table-light">
                    <td><?= $acs['academicyear'] ?></td>
                    <td><?= $acs['semester'] ?></td>
                    <td><?= date("d-m-Y", strtotime($acs['startdate'])) ?></td>
                    <td><?= date("d-m-Y", strtotime($acs['enddate'])) ?></td>
                    <td class="<?= $textclass ?>"><?= ucfirst($acs['status']) ?></td>
                    <td><?= $acs['progress'] ?></td>
                    <td><button data-toggle="modal" data-toggle="tooltip" title="Edit" data-placement="top" data-target="#edit_acs" data-string="<?= $acs['academicsession'] ?>" data-acsid="<?= $acs['id'] ?>" data-acsstartdate="<?= $acs['startdate'] ?>" data-acsenddate="<?= $acs['enddate'] ?>" class="btn btn-sm btn-outline-dark">
                            <i class='fas fa-pen'></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php if ($activeyear) : ?>
    <small>This table will only show sessions under an active academic year</small>
<?php else : ?>
    <small class="text-black-50">Attention! </small>
    <small>Seems that you do not have an active academic year. Kindly proceed to create a new one</small>
<?php endif ?>

<hr>
<!-- ACADEMIC YEAR -->
<div class="row justify-content-between">
    <div class="col-8">
        <h3>Academic Year</h3>
    </div>
    <div class="col-4">
        <button id="btn_acy" class="btn btn-dark margin" data-toggle="modal" data-target="#addacadyear" style="float: right;">
            <i class='far fa-calendar-plus'></i> New Year
        </button>
    </div>
    <hr>
</div>

<div class="table-responsive">
    <table id="acy_table" class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Academic Year</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php foreach ($academicyear as $acy) : ?>
                <?php $textclass = ($acy['status'] == 'active') ? 'text-success' : 'text-muted' ?>
                <tr>
                    <td><?= $acy['acadyear'] ?></td>
                    <td><?= date("d-m-Y", strtotime($acy['startdate'])) ?></td>
                    <td><?= date("d-m-Y", strtotime($acy['enddate'])) ?></td>
                    <td class="<?= $textclass ?>"><?= ucfirst($acy['status']) ?></td>
                    <td><button data-toggle="modal" data-target="#edit_acy" data-string="<?= $acy['acadyear'] ?>" data-acystartdate="<?= $acy['startdate'] ?>" data-acyenddate="<?= $acy['enddate'] ?>" data-acyid="<?= $acy['id'] ?>" class="btn btn-outline-dark btn-sm">
                            <i class='fas fa-pen'></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

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
                <div id="acsform">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="acadyear">Academic Year</label>
                                <select name="acadyear_id" id="acyselect" class="form-control" required>
                                    <?php if ($activeyear) : ?>
                                        <option value="<?= $activeyear['id'] ?>"><?= $activeyear['acadyear'] ?></option>
                                    <?php endif ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <select name="semester" id="semester" class="form-control" onchange="enableSubmit()" required>
                                    <option value="" selected disabled hidden>Select semester</option>
                                    <?php foreach ($semesters as $sem) : ?>
                                        <option value="<?= $sem ?>"><?= $sem ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Start Date</label>
                                <input type="date" name="acs_startdate" class="form-control" id="acs_startdate" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">End Date</label>
                                <input type="date" name="acs_enddate" class="form-control" id="acs_enddate" required>
                            </div>
                        </div>
                    </div>
                    <div style="line-height: 100%;">
                        <small>Please make sure end date is a day before the upcoming academic session. Date of academic session will affect score pages.</small>
                        <br>
                        <small></small>
                    </div>
                </div>
                <div id="acsmessage">
                    <?php if (empty($semesters)) : ?>
                        <p>There is no more session to add for this academic year</p>
                    <?php endif ?>
                </div>

            </div>
            <div class="modal-footer">
                <button id="submitacs" type="submit" class="btn btn-dark" disabled>Add</button>
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
                <div id="acyform">
                    <div class="form-group">
                        <label for="acadyear">Academic Year:</label>
                        <input name="acadyear" type="text" placeholder="20XX/20XX" readonly value="<?= $new_year ?>" id="acadyear" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="acy_startdate">Start Date</label>
                            <input type="date" name="acy_startdate" id="acy_startdate" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="acy_enddate">Start Date</label>
                            <input type="date" name="acy_enddate" id="acy_enddate" class="form-control" required>
                        </div>
                    </div>
                    <small>You can only create a new academic year after the previous one has ended.</small>
                </div>
                <div id="acymessage">
                    <p>You can only create new academic year when the last academic year has ended.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button id="submitacy" type="submit" class="btn btn-dark">Add</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div id="edit_acs" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('academic/update_academicsession') ?>
            <div class="modal-header">
                <h5 class="modal-title">Edit Academic Session</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="confirmtext">You can only edit the date of this academic session</p>
                <div class="form-group">
                    <label>Session</label>
                    <input name="session_string" readonly type="text" class="form-control" required>
                    <input name="acadsession_id" readonly type="text" class="form-control" required hidden>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Start Date</label>
                            <input type="date" name="acs_editstartdate" id="acs_editstartdate" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">End Date</label>
                            <input type="date" name="acs_editenddate" id="acs_editenddate" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark">Update</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div id="edit_acy" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('academic/update_academicyear') ?>
            <div class="modal-header">
                <h5 class="modal-title">Edit Academic Year</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Year</label>
                    <input name="year_string" readonly type="text" class="form-control">
                    <input type="text" name="acadyear_id" id="acadyear_id" class="form-control" hidden>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Start Date</label>
                            <input type="date" name="acy_editstartdate" id="acy_editstartdate" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">End Date</label>
                            <input type="date" name="acy_editenddate" id="acy_editenddate" class="form-control">
                        </div>
                    </div>
                </div>
                <small>Please make sure the dates do not overlap with other academic years</small>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark">Update</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<br>
<script>
    var tables = ['#acs_table', '#acy_table'];
    tables.forEach(setupTable);
    var acssubmitbtn = document.getElementById("submitacs");
    var acsform = document.getElementById("acsform");
    var acsmessage = document.getElementById("acsmessage");
    var acysubmitbtn = document.getElementById("submitacy");
    var acyform = document.getElementById("acyform");
    var acymessage = document.getElementById("acymessage");
    var semesters = Object.values(JSON.parse(`<?php echo json_encode($semesters) ?>`));

    restrictAcadsession();
    restrictAcadyear();

    function restrictAcadsession() {
        if (semesters.length > 0) {
            acsmessage.remove();
        } else {
            acsform.remove();
            acssubmitbtn.remove();
        }
    }

    function restrictAcadyear() {
        if (`<?= $btn_acy ?>`) {
            acymessage.remove();
        } else {
            acyform.remove();
            acysubmitbtn.remove();
        }
    }

    function setupTable(item, index) {
        $(item).DataTable({
            "order": []
        });
    }

    function enableSubmit() {
        var acyselect = document.getElementById("acyselect");
        var semselect = document.getElementById("semester");
        var acy_id = acyselect.value;
        var sem_id = semselect.value;
        if (sem_id && acy_id) {
            acssubmitbtn.disabled = false;
        } else {
            acssubmitbtn.disabled = true;
        }
    }
    $(document).ready(function() {
        $('#edit_acs').on('show.bs.modal', function(e) {
            var userid = $(e.relatedTarget).data('acsid');
            var acads = $(e.relatedTarget).data('string');
            var acs_startdate = $(e.relatedTarget).data('acsstartdate');
            var acs_enddate = $(e.relatedTarget).data('acsenddate');
            $(e.currentTarget).find('input[name="acadsession_id"]').val(userid);
            $(e.currentTarget).find('input[name="session_string"]').val(acads);
            document.getElementById("acs_editstartdate").value = acs_startdate;
            document.getElementById("acs_editenddate").value = acs_enddate;
        });
        $('#edit_acy').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('acyid');
            var years = $(e.relatedTarget).data('string');
            var acy_startdate = $(e.relatedTarget).data('acystartdate');
            var acy_enddate = $(e.relatedTarget).data('acyenddate');
            $(e.currentTarget).find('input[name="acadyear_id"]').val(id);
            $(e.currentTarget).find('input[name="year_string"]').val(years);
            document.getElementById("acy_editstartdate").value = acy_startdate;
            document.getElementById("acy_editenddate").value = acy_enddate;
        });
    });
</script>