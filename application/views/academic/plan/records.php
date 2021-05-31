<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('academicplan/mentor') ?>">Academic Plan</a></li>
    <li class="breadcrumb-item active">Records</li>
</ol>


<h2><?= $title ?></h2>
<h4>Academic Session: <?= $academicsession['academicsession'] ?></h4>
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
            <select name="semester_id" id="" class="form-control" required>
                <option value="" disabled selected>Select semester</option>
                <?php foreach ($semesters as $sem) : ?>
                <option value="<?= $sem ?>"><?= $sem ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-outline-primary"><i class='fas fa-search'></i> Search</button>
        </div>
    </div>
    <?= form_close() ?>
</div>
<div class="card">
    <div class="card-body">
        <?php if ($academicplans) : ?>
        <div class="form-group">
            <?php $hidden = array('acadyear_id' => $acadyear_id, 'semester' => $semester) ?>
            <?= form_open('academicplan/download_record', '', $hidden) ?>
            <button type="submit" class="btn btn-success" target="_blank"><i class='fas fa-file-excel'></i> Download</button>
            <?= form_close() ?>
        </div>
        <?php endif ?>
        <div class="table-responsive">
            <table id="acp_table" class="table">
                <thead class="table-dark">
                    <tr>
                        <th>Matric</th>
                        <th>Name</th>
                        <th>GPA Target</th>
                        <th>GPA Achieved</th>
                        <th>Status</th>
                        <th>Increment</th>
                    </tr>
                </thead>
                <tbody class="table-light">
                    <?php if ($academicplans) : ?>
                    <?php foreach ($academicplans as $acp) : ?>
                    <?php $resultclass = ($acp['gpa_achieved'] < 2.3) ? 'text-danger' : '' ?>
                    <tr>
                        <td><?= $acp['student_id'] ?></td>
                        <td><?= $acp['name'] ?></td>
                        <td><?= $acp['gpa_target'] ?></td>
                        <td class="<?= $resultclass ?>"><?= $acp['gpa_achieved'] ?></td>
                        <td class="<?= $acp['textclass'] ?>"><?= $acp['status'] ?></td>
                        <td class="<?= $acp['textclass'] ?>"><?= $acp['difference'] ?></td>
                    </tr>
                    <?php endforeach ?>
                    <?php else : ?>
                    <tr>
                        <!-- <td>No data</td> -->
                    </tr>
                    <?php endif ?>

                </tbody>
            </table>
        </div>

    </div>
</div>
<br>
<script>
$(document).ready(function() {
    $('#acp_table').DataTable({
        "order": []
    });
});
</script>