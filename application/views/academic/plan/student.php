<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Academic Plan</li>
</ol>

<h2><?= $title ?></h2>
<hr>
<?php if (!$thisacademicplan) : ?>
<p>You are not enrolled in the current academic session (<?= $activeacadsession['academicsession'] ?>). Please contact your mentor.</p>
<?php else : ?>

<?php if (empty($thisacademicplan['gpa_target'])) : ?>
<small class="text-warning">Attention!</small>
<small>Seems that you have not set your GPA for the current semester. Please set it first.</small>
<br>
<button class="btn btn-primary" data-toggle="modal" data-target="#setGPA">Set GPA</button>

<?php else : ?>
<h6>You have registered this session's GPA target!</h6>
<?php if ($activeacadsession['endofsession'] == true) : ?>
<small>It's end of academic session. Your result will soon be updated by your mentor</small><br>
<!-- <button class="btn btn-info">Set Result</button> -->
<?php else : ?>
<small>Long way to go, sir</small>
<?php endif ?>
<?php endif ?>
<?php endif ?>
<br><br>
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
        <?php $textclass = ($acp['difference'] >= 0) ? 'text-success' : 'text-danger' ?>
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
<hr>

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
                <option value="<?= $sem ?>"><?= $sem ?></option>
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

<div id="setGPA" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register GPA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $hidden = array(
                'student_id' => $student_id,
                'acadsession_id' => $activeacadsession['id']
            ); ?>
            <?= form_open('academic/set_gpatarget', '', $hidden) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="acadsession_id">Academic Session</label>
                    <input name="activeacademicsession" value="<?= $activeacadsession['academicsession'] ?>" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="gpa_target">GPA Target</label>
                    <input name="gpa_target" min="2" max="4" type="number" placeholder="3.00" class="form-control" step="0.01" required>
                    <small>Note: GPA target must be bigger than 2.00</small><br>
                    <small>Carefully fill in your target GPA. You cannot change your target GPA in the future.</small>
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

<script>
$(document).ready(function() {
    $('#tableacademicplan').DataTable();
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
});
</script>