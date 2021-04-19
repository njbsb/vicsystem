<h2><?= $title ?></h2>
<h4>Academic Session: <?= $activesession['academicsession'] ?></h4>
<hr>
<div class="form-group">
    <?= form_open('academicplan/records') ?>
    <div class="row">
        <div class="col-md-3">
            <select name="acadyear_id" id="" class="form-control" required>
                <option value="" disabled selected>Select academic year</option>
                <?php foreach ($academicyears as $acadyear) : ?>
                <option value="<?= $acadyear['id'] ?>"><?= $acadyear['acadyear'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="semester" id="" class="form-control" required>
                <option value="" disabled selected>Select semester</option>
                <?php foreach ($semesters as $sem) : ?>
                <option value="<?= $sem ?>"><?= $sem ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-outline-primary">Search record</button>
        </div>
    </div>
    <?= form_close() ?>
</div>


<!-- ACADEMIC PLAN -->
<!-- <div class="row justify-content-between">
    <div class="col-4">
        <h3>Academic Plan</h3>
    </div>
    <div class="col-4">
        <button class="btn btn-outline-primary margin" data-toggle="modal" data-target="#addacademicplan" style="float: right;">Add Academic Plan</button>
    </div>
</div> -->
<table id="acp_table" class="table display">
    <thead class="table-dark">
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>GPA Target</th>
            <th>GPA Achieved</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($academicplans) : ?>
        <?php foreach ($academicplans as $acp) : ?>
        <?php $text = ($acp['gpa_achieved'] > $acp['gpa_target']) ? 'Passed' : 'Not pass' ?>
        <?php $textclass = ($acp['gpa_achieved'] > $acp['gpa_target']) ? 'text-success' : 'text-warning' ?>
        <tr>
            <td><?= $acp['student_matric'] ?></td>
            <td><?= $acp['name'] ?></td>
            <td><?= $acp['gpa_target'] ?></td>
            <td><?= $acp['gpa_achieved'] ?></td>
            <td class="<?= $textclass ?>"><?= $text ?></td>
        </tr>
        <?php endforeach ?>
        <?php else : ?>
        <tr>
            <td>No data</td>
        </tr>
        <?php endif ?>

    </tbody>
</table>

<script>
$(document).ready(function() {
    $('#acp_table').DataTable();
});
</script>