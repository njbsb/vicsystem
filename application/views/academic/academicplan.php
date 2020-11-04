<h2 class="text-center margin"><?= $title ?></h2>

<?php $hidden = array(
    'student_id' => $student['id']
); ?>
<?= form_open('academic/records', '', $hidden) ?>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <!-- <label for="acadyear_id">Academic Year</label> -->
            <select name="acadyear_id" class="form-control" required>
                <option value="" selected disabled>Select academic year</option>
                <?php foreach ($academicyears as $acadyear) :  ?>
                    <option value="<?= $acadyear['id'] ?>"><?= $acadyear['acadyear'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <!-- <label for="semester_id">Semester</label> -->
            <select name="semester_id" class="form-control" required>
                <option value="" selected disabled>Select semester</option>
                <?php foreach ($semesters as $sem) : ?>
                    <option value="<?= $sem['id'] ?>"><?= $sem['semester'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <button type="submit" class="btn btn-outline-primary">Get record</button>
        </div>
    </div>
</div>

<?= form_close() ?>


<!-- <?php if ($thisacademicplan) : ?>
    <h6>You have registered the latest academic plan</h6>
<?php else : ?>
    <h6>Please register your academic plan</h6>
<?php endif ?>
<?php $hidden = array(); ?>
<?= form_open('academic/create_academicplan/' . $student_id) ?>
<fieldset class="col-md-auto">
    <h4>Register academic plan</h4>
    <div class="form-group">
        <label for="id">Student Matric</label>
        <input name="id" type="text" class="form-control" value="<?= $student_id ?>" readonly>
    </div>
    <div class="form-group">
        <label for="acadsession_id">Academic Session</label>
        <input name="activeacademicsession" value="<?= $activeacadsession['academicsession'] ?>" type="text" class="form-control">
        <input name="activeacadsession_id" value="<?= $activeacadsession['id'] ?>" type="hidden">
    </div>
    <div class="row">
        <div class="form-group col-3">
            <label for="gpa_target">GPA Target</label>
            <input name="gpa_target" min="1" max="4" type="number" placeholder="3.00" class="form-control" step="0.01">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</fieldset>
<?= form_close() ?> -->


<br>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#academicplan">Academic Plan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#overallscore">Overall Score</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#levelscore">Score by Levels</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#componentscore">Score by Components</a>
    </li>
</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade show active" id="academicplan">
        <br>
        <!-- ACADEMIC PLAN -->
        <h2 class="text-left">Academic Plan</h2>
        <table id="tableacademicplan" class="table display">
            <thead class="table-dark">
                <tr>
                    <td>Academic Session</td>
                    <td>Citra Registered</td>
                    <td>GPA Target</td>
                    <td>GPA Achieved</td>
                    <td>Increment</td>
                </tr>
            </thead>
            <tbody>
                <?php if ($academicplans) : ?>
                    <?php foreach ($academicplans as $acp) : ?>
                        <tr>
                            <td><?= $acp['academicsession'] ?></td>
                            <td><?= $acp['citra_reg'] ?></td>
                            <td><?= $acp['gpa_target'] ?></td>
                            <td><?= $acp['gpa_achieved'] ?></td>
                            <?php if ($acp['difference'] > 0) : ?>
                                <td class="text-success">+<?= $acp['difference'] ?></td>
                            <?php else : ?>
                                <td class="text-danger"><?= $acp['difference'] ?></td>
                            <?php endif ?>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr>
                        <td>No data found</td>
                    </tr>
                <?php endif ?>

            </tbody>
        </table>
        <hr>
    </div>
    <div class="tab-pane fade" id="overallscore">
        <br>
        <!-- SCORE OVERALL -->
        <h2 class="text-left">Overall score</h2>
        <table id="tablescoreoverall" class="table display">
            <thead class="table-dark">
                <tr>
                    <td>Academic Session</td>
                    <td data-toggle="tooltip" data-placement="top" title="15%">Level A1 (%)</td>
                    <td data-toggle="tooltip" data-placement="top" title="15%">Level A2 (%)</td>
                    <td data-toggle="tooltip" data-placement="top" title="10%">Level B1 (%)</td>
                    <td data-toggle="tooltip" data-placement="top" title="15%">Components (%)</td>
                    <td data-toggle="tooltip" data-placement="top" title="55%">Total (%)</td>
                </tr>
            </thead>
            <tbody>
                <?php ?>
                <?php  ?>
                <tr>
                    <td><?php ?></td>
                    <td><?php ?>%</td>
                    <td><?php ?>%</td>
                    <td><?php ?>%</td>
                    <td><?php ?>%</td>
                    <td><?php ?>%</td>
                </tr>
                <?php  ?>
                <?php ?>
                <!-- <tr>
                    <td>No data found</td>
                </tr> -->
                <?php ?>
            </tbody>
        </table>
        <hr>
    </div>
    <div class="tab-pane fade" id="levelscore">
        <br>
        <!-- SCORE BY LEVEL -->
        <h2 class="text-left">Score by Levels</h2>
        <p>Note: this will be based on table scoring plan</p>
        <table id="tablescorelevel" class="table display">
            <thead class="table-dark">
                <tr>
                    <td>Academic Session</td>
                    <td data-toggle="tooltip" data-placement="top" title="Score Level">Level</td>
                    <td class="text-warning" data-toggle="tooltip" data-placement="top" title="Maximum 5 marks">Position</td>
                    <td class="text-warning" data-toggle="tooltip" data-placement="top" title="Maximum 3 marks">Meeting</td>
                    <td class="text-warning" data-toggle="tooltip" data-placement="top" title="Maximum 5 marks">Attendance</td>
                    <td class="text-warning" data-toggle="tooltip" data-placement="top" title="Maximum 7 marks">Involvement</td>
                    <td data-toggle="tooltip" data-placement="top" title="Maximum 20 marks">Total Score</td>
                    <td>Total (%)</td>
                </tr>
            </thead>
            <tbody>
                <!-- <?php if ($score_levels) : ?>
                    <?php foreach ($score_levels as $scl) : ?>
                        <tr>
                            <td><?= $scl['academicsession'] ?></td>
                            <td><?= $scl['level'] ?></td>
                            <td><?= $scl['sc_position'] ?></td>
                            <td><?= $scl['sc_meeting'] ?></td>
                            <td><?= $scl['sc_attendance'] ?></td>
                            <td><?= $scl['sc_involvement'] ?></td>
                            <td><?= $scl['total'] ?></td>
                            <td><?= $scl['totalpercent'] ?>%</td>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?> -->
                <tr>
                    <td>No data found</td>
                </tr>
                <!-- <?php endif ?> -->
            </tbody>
            <tfoot>
                <tr>
                    <td>Academic Session</td>
                    <td>Level</td>
                    <td>Position</td>
                    <td>Meeting</td>
                    <td>Attendance</td>
                    <td>Involvement</td>
                    <td>Total Score</td>
                    <td>Total (%)</td>
                </tr>
            </tfoot>
        </table>
        <hr>
    </div>
    <div class="tab-pane fade" id="componentscore">
        <!-- SCORE BY COMPONENT -->
        <br>
        <h2 class="text-left">Score by Components</h2>
        <table id="tablescorecomponent" class="table display">
            <thead class="table-dark">
                <tr>
                    <td>Academic Session</td>
                    <td data-toggle="tooltip" data-placement="top" title="Maximum 5%">Leadership</td>
                    <td data-toggle="tooltip" data-placement="top" title="Maximum 5%">Volunteerism</td>
                    <td data-toggle="tooltip" data-placement="top" title="Maximum 5%">Digital CV</td>
                    <td data-toggle="tooltip" data-placement="top" title="Maximum Total 15%">Total Mark</td>
                </tr>
            </thead>
            <tbody>
                <?php if ($score_comp) : ?>
                    <?php foreach ($score_comp as $scomp) : ?>
                        <tr>
                            <td><?= $scomp['academicsession'] ?></td>
                            <td><?= $scomp['leadership'] ?></td>
                            <td><?= $scomp['volunteer'] ?></td>
                            <td><?= $scomp['digitalcv'] ?></td>
                            <td><?= $scomp['total'] ?>%</td>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr>
                        <td>No data</td>
                    </tr>
                <?php endif ?>

            </tbody>
        </table>
        <hr>
    </div>
</div>

<div id="scorelevel" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#tablescorelevel').DataTable({
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });

    });
    $('#tablescorecomponent').DataTable();
    $('#tablescoreoverall').DataTable();
    $('#tableacademicplan').DataTable();
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>