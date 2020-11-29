<h2 class="margin"><?= $title ?></h2>

<h3>Score Records</h3>
<?php $hidden = array(
    'student_id' => $student['id']
); ?>
<?= form_open('academic/records', '', $hidden) ?>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
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
<?php if (!$thisacademicplan) : ?>
    <p>You are not enrolled in the current academic session (<?= $activeacadsession['academicsession'] ?>). Please contact your mentor.</p>
<?php else : ?>
    <?php if (empty($thisacademicplan['gpa_target'])) : ?>
        <h6>Please set your GPA target for current academic session (<?= $activeacadsession['academicsession'] ?>)!</h6>
        <?php $hidden = array(
            'student_id' => $student_id,
            'acadsession_id' => $activeacadsession['id']
        ); ?>
        <?= form_open('academic/set_gpatarget', '', $hidden) ?>
        <div class="form-group">
            <label for="acadsession_id">Academic Session</label>
            <input name="activeacademicsession" value="<?= $activeacadsession['academicsession'] ?>" type="text" class="form-control" readonly>
        </div>
        <div class="row">
            <div class="form-group col-3">
                <label for="gpa_target">GPA Target</label>
                <input name="gpa_target" min="2" max="4" type="number" placeholder="3.00" class="form-control" step="0.01" required>
                <small>GPA target must be bigger than 2.00</small>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-primary">Submit</button>
        <?= form_close() ?>
    <?php else : ?>
        <h6>You have registered this session's GPA target!</h6>
    <?php endif ?>
<?php endif ?>
<hr>

<h3 class="text-left">Academic Plan</h3>
<table id="tableacademicplan" class="table display">
    <thead class="table-dark">
        <tr>
            <th>Academic Session</th>
            <th>GPA Target</th>
            <th>GPA Achieved</th>
            <th>Increment</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($academicplans) : ?>
            <?php foreach ($academicplans as $acp) : ?>
                <?php $sign = ($acp['difference'] > 0) ? '+' : '' ?>
                <?php $textclass = ($acp['difference'] > 0) ? 'text-success' : 'text-danger' ?>
                <tr>
                    <td><?= $acp['academicsession'] ?></td>
                    <td><?= $acp['gpa_target'] ?></td>
                    <td><?= $acp['gpa_achieved'] ?></td>
                    <td class="<?= $textclass ?>"><?= $sign ?><?= $acp['difference'] ?></td>
                </tr>
            <?php endforeach ?>
        <?php else : ?>
            <tr>
                <td>No data found</td>
            </tr>
        <?php endif ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#tableacademicplan').DataTable();
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    });
</script>