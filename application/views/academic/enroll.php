<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Enrollment</li>
</ol>
<?php $academicsession = ($activesession) ? $activesession['academicsession'] : '?' ?>
<h2><?= $title . ': ' . $academicsession  ?></h2>
<small><?= $text ?></small>
<?php if (validation_errors()) : ?>
<div class="alert alert-dismissible alert-warning">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Warning!</h4>
    <p class="mb-0"><?= validation_errors() ?></p>
</div>
<?php endif ?>

<hr>
<div class="card">
    <div class="card-body">

        <?php $hidden = ($activesession) ? array('acadsession_id' => $activesession['id']) : array() ?>
        <?php $attribute = array('id' => 'enrollform') ?>
        <?= form_open('enroll', $attribute, $hidden) ?>
        <h3 class="margin">Non Enrolled Students</h3>
        <div class="table-responsive">
            <table id="studenttable" class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th style="text-align:center;">Pick</th>
                        <th>Intake</th>
                        <th>Matric</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody class="table-active">
                    <?php foreach ($availablestudents as $std) : ?>
                    <?php $checked = 'selected'; ?>
                    <tr>
                        <td style="text-align:center;"><input id="enrollstudents" name="unenrollstudents[]" value="<?= $std['id'] ?>" type="checkbox" /></td>
                        <td><?= $std['intake'] ?></td>
                        <td><?= $std['id'] ?></td>
                        <td><?= $std['name'] ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td>Joined Year</td>
                        <td>Matric</td>
                        <td>Name</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <br>
        <?php if ($activesession) : ?>
        <a data-toggle="modal" id="enrollbtn" data-target="#enrollconfirm" class="btn btn-outline-dark"><i class='fas fa-upload'></i> Enroll</a>
        <?php endif ?>
        <?= form_close() ?>
    </div>
</div>
<hr>
<div class="card">
    <div class="card-body">
        <h3 class="margin">Enrolled Students</h3>
        <?php $hidden = ($activesession) ? array('acadsession_id' => $activesession['id']) : array() ?>
        <?php $attribute = array('id' => 'unenrollform') ?>
        <?= form_open('unenroll', $attribute, $hidden) ?>
        <div class="table-responsive">
            <table id="enrolledtable" class="table table-hover">
                <thead class="table-success">
                    <tr>
                        <th style="text-align:center;">Pick</th>
                        <th>Matric</th>
                        <th>Name</th>
                        <th>GPA Target</th>
                        <th>GPA Achieved</th>
                    </tr>
                </thead>
                <tbody class="table-active">
                    <?php if ($enrolledstudents) : ?>
                    <?php foreach ($enrolledstudents as $std) : ?>
                    <tr>
                        <td style="text-align:center;"><input id="unenrollstudents" name="enrollstudents[]" value="<?= $std['matric'] ?>" type="checkbox" /></td>
                        <td><?= $std['matric'] ?></td>
                        <td><?= $std['name'] ?></td>
                        <td><?= $std['gpa_target'] ?></td>
                        <td><?= $std['gpa_achieved'] ?></td>
                    </tr>
                    <?php endforeach ?>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
        <br>
        <?php if ($activesession) : ?>
        <a data-toggle="modal" id="unenrollbtn" data-target="#unenrollconfirm" class="btn btn-outline-danger"><i class='fas fa-download'></i> Un-Enroll</a>
        <?php endif ?>
        <?= form_close() ?>
    </div>
</div>

<div id="enrollconfirm" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Action check!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="enrollconfirmtext"></p>
                <small>Enrolling students would create default academic plan for this semester.</small>
            </div>
            <div class="modal-footer">
                <button type="button" id="enrollconfirmbtn" class="btn btn-dark">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div id="unenrollconfirm" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Action check!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="unenrollconfirmtext"></p>
                <small>Un-enroll students would delete their academic plan and GPA target if exist.</small>
            </div>
            <div class="modal-footer">
                <button type="button" id="unenrollconfirmbtn" class="btn btn-dark">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#studenttable').DataTable({
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
                    select.append("<option value='" + d + "'>" + d + "</option>")
                });
            });
        },
        "order": []
    });
    $('#enrolledtable').DataTable({
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
        },
        "order": []
    });
});

var enrollconfirmtext = document.getElementById('enrollconfirmtext');
var unenrollconfirmtext = document.getElementById('unenrollconfirmtext');
$('#enrollbtn').click(function() {
    var count = $('input[name="unenrollstudents[]"]:checked').length;
    if (count < 1) {
        enrollconfirmtext.innerHTML = 'You did not choose any student. Please check some students first!';
        document.getElementById("enrollconfirmbtn").disabled = true;
    } else {
        enrollconfirmtext.innerHTML = 'You are about to enroll ' + $("input[type='checkbox']:checked").length + ' students. Proceed?';
        document.getElementById("enrollconfirmbtn").disabled = false;
    }
});
$('#enrollconfirmbtn').click(function() {
    $('#enrollform').submit();
});
$('#unenrollbtn').click(function() {
    var count = $('input[name="enrollstudents[]"]:checked').length;
    if (count < 1) {
        unenrollconfirmtext.innerHTML = 'You did not choose any student. Please check some students first!';
        document.getElementById("unenrollconfirmbtn").disabled = true;
    } else {
        unenrollconfirmtext.innerHTML = 'You are about to unenroll ' + $("input[type='checkbox']:checked").length + ' students. Proceed?';
        document.getElementById("unenrollconfirmbtn").disabled = false;
    }
});
$('#unenrollconfirmbtn').click(function() {
    $('#unenrollform').submit();
});
</script>