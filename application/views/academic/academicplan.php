<h2 class="text-center margin"><?= $title ?></h2>
<div class="form-group">
    <label for="id">Student Matric</label>
    <input name="id" type="text" class="form-control" value="A160000" readonly>
</div>
<h2 class="text-center">Academic Plan</h2>
<table class="table display">
    <thead class="table-dark">
        <tr>
            <td>Academic Session</td>
            <td>Citra Registered</td>
            <td>GPA Target</td>
            <td>GPA Achieved</td>
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

<!-- SCORE OVERALL PER ACADEMIC SESSION -->
<h2 class="text-center">SCORE OVERALL PER ACADSESSION</h2>
<table class="table display">
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
        <tr>
            <td><?= $tabletotal['academicsession'] ?></td>
            <td><?= $tabletotal['a1'] ?></td>
            <td><?= $tabletotal['a2'] ?></td>
            <td><?= $tabletotal['b1'] ?></td>
            <td><?= $tabletotal['comp'] ?></td>
            <td><?= $tabletotal['total'] ?></td>
        </tr>
    </tbody>
</table>
<hr>

<!-- SCORE BY LEVEL -->
<h2 class="text-center">Score by Level</h2>
<table class="table display">
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
        <?php if ($score_levels) : ?>
            <?php foreach ($score_levels as $scl) : ?>
                <tr>
                    <td><?= $scl['academicsession'] ?></td>
                    <td><?= $scl['level'] ?></td>
                    <td><?= $scl['sc_position'] ?></td>
                    <td><?= $scl['sc_meeting'] ?></td>
                    <td><?= $scl['sc_attendance'] ?></td>
                    <td><?= $scl['sc_involvement'] ?></td>
                    <td><?= $scl['total'] ?></td>
                    <td><?= $scl['totalpercent'] ?></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </tbody>
    <!-- <tfoot class="table-dark">
        <tr>
            <td>Academic Session</td>
            <td>Activity</td>
            <td>Score Level</td>
            <td>Total Score</td>
        </tr>
    </tfoot> -->
</table>
<hr>

<!-- SCORE BY COMPONENT -->
<h2 class="text-center">Score by Components</h2>
<table class="table display">
    <thead class="table-dark">
        <tr>
            <td>Academic Session</td>
            <td>Leadership (5%)</td>
            <td>Volunteering (5%)</td>
            <td>Digital CV (5%)</td>
            <td>Total (15%)</td>
        </tr>
    </thead>
    <tbody>
        <?php if ($score_comp) : ?>
            <tr>
                <td><?= $score_comp['academicsession'] ?></td>
                <td><?= $score_comp['sc_leadership'] ?></td>
                <td><?= $score_comp['sc_volunteer'] ?></td>
                <td><?= $score_comp['sc_digitalcv'] ?></td>
                <td><?= $score_comp['total'] ?></td>
            </tr>
        <?php else : ?>
            <tr>
                <td>No data</td>
            </tr>
        <?php endif ?>

    </tbody>
</table>
<hr>

<?= form_open('academic/academicplan') ?>
<fieldset class="col-md-auto">
    <h4>Register academic plan</h4>
    <div class="form-group">
        <label for="acadsession_id">Academic Session</label>
        <select class="form-control" name="acadsession_id" id="acadsession_id">
            <?php ?>
            <option value="<?php ?>"></option>
            <?php ?>
        </select>
    </div>

</fieldset>
<?= form_close() ?>

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
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>