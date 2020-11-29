<h2><?= $title ?></h2>

<?php if (validation_errors()) : ?>
    <div class="alert alert-dismissible alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4 class="alert-heading">Warning!</h4>
        <p class="mb-0"><?= validation_errors() ?></p>
    </div>
<?php endif ?>
<hr>
<div class="form-group">
    <legend>Active Session</legend>
    <select name="acadsession_id" class="form-control">
        <option value="<?= $activesession['id'] ?>"><?= $activesession['academicsession'] ?></option>
    </select>
    <small>You can only enroll students in an active academic session!</small>
</div>
<hr>

<?php $hidden = array('acadsession_id' => $activesession['id']); ?>
<?= form_open('enroll', '', $hidden) ?>
<h3>Non Enrolled Students</h3>
<table id="studenttable" class="table" style="text-align:center;">
    <thead class="table-dark">
        <tr>
            <th>Pick</th>
            <th>Intake</th>
            <th>Matric</th>
            <th>Name</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($availablestudents as $std) : ?>
            <?php $checked = 'selected'; ?>
            <tr>
                <td><input name="students[]" value="<?= $std['matric'] ?>" type="checkbox" /></td>
                <td><?= $std['year_joined'] ?></td>
                <td><?= $std['matric'] ?></td>
                <td><?= $std['name'] ?></td>
                <td></td>
            </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td>Joined Year</td>
            <td>Matric</td>
            <td>Name</td>
            <td>Status</td>
        </tr>
    </tfoot>
</table>
<button class="btn btn-outline-primary" type="submit">Add Students</button>
<?= form_close() ?>
<hr>

<h3 class="margin">Enrolled Students</h3>
<?php $hidden = array('acadsession_id' => $activesession['id']) ?>
<?= form_open('unenroll', '', $hidden) ?>
<table id="enrolledtable" class="table" style="text-align:center;">
    <thead class="table-success">
        <tr>
            <th>Pick</th>
            <th>Matric</th>
            <th>Name</th>
            <th>GPA Target</th>
            <th>GPA Achieved</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($enrolledstudents) : ?>
            <?php foreach ($enrolledstudents as $std) : ?>
                <tr>
                    <td><input name="students[]" value="<?= $std['matric'] ?>" type="checkbox" /></td>
                    <td><?= $std['matric'] ?></td>
                    <td><?= $std['name'] ?></td>
                    <td><?= $std['gpa_target'] ?></td>
                    <td><?= $std['gpa_achieved'] ?></td>
                </tr>
            <?php endforeach ?>
        <?php else : ?>
            <tr>
                <td>No data</td>
            </tr>
        <?php endif ?>
    </tbody>
</table>
<div class="form-group">
    <button class="btn btn-outline-danger">Un-Enroll</button>
</div>
<?= form_close() ?>

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
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
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
            }
        });
    });
</script>