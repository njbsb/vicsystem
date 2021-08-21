<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Academic</li>
</ol>

<h2><?= $title ?></h2>
<hr>
<?php if (!$thisacademicplan) : ?>
<?php if ($activesession) : ?>
<p>You are not enrolled in the current academic session (<?= $activesession['academicsession'] ?>). Please contact your mentor.</p>
<?php else : ?>
<p>There is not any active session at the moment. Your mentor will update the system accordingly</p>
<?php endif ?>

<?php else : ?>

<?php if (empty($thisacademicplan['gpa_target'])) : ?>
<?php if ($today < strtotime($examdate) and $examdate) : ?>
<button class="btn btn-dark" data-toggle="modal" data-target="#setGPA">Set GPA</button>
<br>
<small class="text-white">Attention! </small><small>Seems that you have not set your GPA for the current semester. Please set it first.</small>
<?php else : ?>
<small class="text-white">Attention! </small><small>You missed the dateline to set your gpa :(</small>
<?php endif ?>
<br>
<?php else : ?>
<h6>You have registered this session's GPA target!</h6>
<div style="line-height:100%">
    <?php if ($today >= strtotime($examdate) and $examdate) : ?>
    <small>It's end of academic session. Your result will soon be updated by your mentor</small><br>
    <?php else : ?>
    <small>Study week on going.</small>
    <?php endif ?>
</div>
<?php endif ?>
<?php endif ?>
<br>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="tableacademicplan" class="table display table-hover">
                <thead class="table-dark">
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
                    <?php $sign = (is_numeric($acp['difference']) and $acp['difference'] > 0) ? '+' : '' ?>
                    <?php $textclass = (is_numeric($acp['difference']) and $acp['difference'] >= 0) ? 'text-success' : 'text-danger' ?>
                    <tr>
                        <td><?= $acp['academicsession'] ?></td>
                        <td><?= $acp['gpa_target'] ?></td>
                        <td><?= $acp['gpa_achieved'] ?></td>
                        <td class="<?= $textclass ?>"><?= $sign ?><?= $acp['difference'] ?></td>
                        <td>
                            <?php $hidden = array('student_id' => $student['id'], 'acadsession_id' => $acp['acadsession_id']) ?>
                            <?= form_open('academic/record', '', $hidden) ?>
                            <button type="submit" class="btn btn-sm btn-dark"><i class='fas fa-search'></i> Score</button>&nbsp;
                            <?php $limitdate = date('Y-m-d', strtotime("+2 weeks", strtotime($activesession['startdate']))); ?>
                            <?php if ($acp['gpa_achieved'] == '' and $daydiff < 14) : ?>
                            <a class="btn btn-sm btn-dark" data-gparesult="<?= $acp['gpa_achieved'] ?>" data-selectedsession="<?= $acp['academicsession'] ?>" data-toggle="modal"
                                data-target="#submitResult">Submit</a>
                            <?php endif ?>
                            <?= form_close() ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
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
                    <input name="gpa_target" id="gpa_target" min="2" max="4" maxlength="4" size="4" type="number" placeholder="3.00" class="form-control" step="0.01" required>
                    <small>Note: GPA target must be bigger than 2.00</small><br>
                    <small>Carefully fill in your target GPA. You cannot change your target GPA in the future.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button id="submitgpa" type="submit" class="btn btn-dark" disabled>Add</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div id="submitResult" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="submitTitle">Submit Result</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $hidden = array('student_id' => $student_id, 'acadsession_id' => $activesession['id']) ?>
            <?= form_open('academic/submitresult', '', $hidden) ?>
            <div class="modal-body">

                <div class="form-group">
                    <label for="">Result</label>
                    <input type="number" name="gparesult" id="gparesult" class="form-control">
                </div>

            </div>
            <div class="modal-footer">
                <button disabled id="submitresultbtn" class="btn btn-dark" type="submit">Submit</button>
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
    var gpainput = document.getElementById("gpa_target");
    var submitgpa = document.getElementById("submitgpa");
    var submitresultbtn = document.getElementById("submitresultbtn");
    var submitTitle = document.getElementById("submitTitle");
    $('#submitResult').on('show.bs.modal', function(e) {
        var selectedSession = $(e.relatedTarget).data('selectedsession');
        var gparesult = $(e.relatedTarget).data('gparesult');
        $(e.currentTarget).find('input[name="gparesult"]').val(gparesult);
        submitTitle.innerHTML = "Submit Result (" + selectedSession + ")";
    });

    function checkGPA() {
        var gpa = $('#gpa_target').val();
        if (gpa > 3) {
            submitgpa.disabled = false;
        } else {
            submitgpa.disabled = true;
        }
    }

    function checkgparesult() {
        var result = $('#gparesult').val();
        if (result > 0) {
            submitresultbtn.disabled = false;
        } else {
            submitresultbtn.disabled = true;
        }
    }
    $("#gpa_target").keyup(checkGPA);
    $("#gparesult").keyup(checkgparesult);
});
</script>