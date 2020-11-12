<h2 class="text-center margin"><?= $title ?></h2>

<h3>Score Records</h3>
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
            <button type="submit" class="btn btn-outline-primary">Get score record</button>
        </div>
    </div>
</div>
<hr>
<?= form_close() ?>


<!-- <?php if ($thisacademicplan) : ?>
    <h6>You have registered the latest academic plan</h6>
<?php else : ?>
    <h6>Please register your academic plan</h6>
<?php endif ?>
-->

<?php $hidden = array(
    'student_id' => $student_id,
    'acadsession_id' => $activeacadsession['id']
); ?>
<?= form_open('academic/create_academicplan/' . $student_id) ?>
<fieldset class="col-md-auto">
    <h4>Register academic plan</h4>
    <div class="form-group">
        <label for="acadsession_id">Academic Session</label>
        <input name="activeacademicsession" value="<?= $activeacadsession['academicsession'] ?>" type="text" class="form-control" readonly>
    </div>
    <div class="row">
        <div class="form-group col-3">
            <label for="gpa_target">GPA Target</label>
            <input name="gpa_target" min="0" max="4" type="number" placeholder="3.00" class="form-control" step="0.01">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</fieldset>
<?= form_close() ?>
<br>
<h3 class="text-left">Academic Plan</h3>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#academicplan">Academic Plan</a>
    </li>

</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade show active" id="academicplan">
        <br>
        <table id="tableacademicplan" class="table display">
            <thead class="table-dark">
                <tr>
                    <td>Academic Session</td>
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
</div>

<div id="addacademicplan" class="modal fade">
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