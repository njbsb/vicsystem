<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('academic') ?>">Academic</a></li>
    <li class="breadcrumb-item active">Alter Plan</li>
</ol>

<h3><?= sprintf('Alter Plan: % s', $academicsession['academicsession']) ?></h3>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <td>Matric</td>
                        <td>Name</td>
                        <td>GPA Target</td>
                        <td>GPA Achieved</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($academicplans) : ?>
                    <?php foreach ($academicplans as $plan) : ?>
                    <tr>
                        <td><?= $plan['student_id'] ?></td>
                        <td><?= $plan['name'] ?></td>
                        <td><?= $plan['gpa_target'] ?></td>
                        <td><?= $plan['gpa_achieved'] ?></td>
                        <td><a data-toggle="modal" data-target="#alterplan" data-studentid="<?= $plan['student_id'] ?>" data-acadsessionid="<?= $plan['acadsession_id'] ?>"
                                data-gpatarget="<?= $plan['gpa_target'] ?>" data-gpaachieved="<?= $plan['gpa_achieved'] ?>" class="btn btn-outline-dark btn-sm" href=""><i class='fas fa-pen'></i></a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="alterplan" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('academic/updateplan') ?>
            <div class="modal-header">
                <h5 class="modal-title">Alter Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label id=""">Student</label>
                    <input id=" acadsession_id" name="acadsession_id" type="text" class="form-control" hidden required>
                        <input id="student_id" name="student_id" type="text" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="gpa_target">GPA Target</label>
                            <input id="gpa_target" name="gpa_target" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="gpa_achieved">GPA Achieved</label>
                            <input id="gpa_achieved" name="gpa_achieved" type="text" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark"><i class='fas fa-save'></i> Update</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
var deletename = document.getElementById('deletename');
$('#alterplan').on('show.bs.modal', function(e) {
    var acadsessionid = $(e.relatedTarget).data('acadsessionid');
    var gpatarget = $(e.relatedTarget).data('gpatarget');
    var gpaachieved = $(e.relatedTarget).data('gpaachieved');
    var studentid = $(e.relatedTarget).data('studentid');
    // var gpaachieved = $(e.relatedTarget).data('gpaachieved');
    $(e.currentTarget).find('input[name="acadsession_id"]').val(acadsessionid);
    $(e.currentTarget).find('input[name="student_id"]').val(studentid);
    $(e.currentTarget).find('input[name="gpa_target"]').val(gpatarget);
    $(e.currentTarget).find('input[name="gpa_achieved"]').val(gpaachieved);
});
$('#alterplan').on('hide.bs.modal', function(e) {});
</script>