<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Academic</li>
</ol>

<h2><?= $title ?></h2>
<hr>
<?php if (!$thisacademicplan) : ?>
<p>You are not enrolled in the current academic session (<?= $activesession['academicsession'] ?>). Please contact your mentor.</p>
<?php else : ?>

<?php if (empty($thisacademicplan['gpa_target'])) : ?>
<small class="text-warning">Attention!</small>
<small>Seems that you have not set your GPA for the current semester. Please set it first.</small>
<br>
<button class="btn btn-primary" data-toggle="modal" data-target="#setGPA">Set GPA</button>
<?php else : ?>
<h6>You have registered this session's GPA target!</h6>
<?php if ($today >= strtotime($examdate)) : ?>
<small>It's end of academic session. Your result will soon be updated by your mentor</small><br>
<?php else : ?>
<small>Study week on going.</small>
<?php endif ?>
<?php endif ?>
<?php endif ?>
<br>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="tableacademicplan" class="table display table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Academic Session</th>
                        <th>GPA Target</th>
                        <th>GPA Achieved</th>
                        <th>Increment</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-light">
                    <?php if ($academicplans) : ?>
                    <?php foreach ($academicplans as $acp) : ?>
                    <?php $sign = ($acp['difference'] > 0) ? '+' : '' ?>
                    <?php $textclass = ($acp['difference'] >= 0) ? 'text-success' : 'text-danger' ?>
                    <tr>
                        <td><?= $acp['academicsession'] ?></td>
                        <td><?= $acp['gpa_target'] ?></td>
                        <td><?= $acp['gpa_achieved'] ?></td>
                        <td class="<?= $textclass ?>"><?= $sign ?><?= $acp['difference'] ?></td>
                        <?php $hidden = array('student_id' => $student['id'], 'acadsession_id' => $acp['acadsession_id']) ?>
                        <?= form_open('academic/record', '', $hidden) ?>
                        <td><button type="submit" class="btn btn-sm btn-primary"><i class='fas fa-search'></i> Score</button></td>
                        <?= form_close() ?>
                    </tr>
                    <?php endforeach ?>
                    <?php else : ?>
                    <tr>
                        <td>No data found</td>
                    </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
        <small>Click <i class='fas fa-search'></i> Score to view your score</small>
    </div>
</div>

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
                'acadsession_id' => $activesession['id']
            ); ?>
            <?= form_open('academic/set_gpatarget', '', $hidden) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="acadsession_id">Academic Session</label>
                    <input name="activeacademicsession" value="<?= $activesession['academicsession'] ?>" type="text" class="form-control" readonly>
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
    $('#tableacademicplan').DataTable({
        "order": []
    });
});
</script>