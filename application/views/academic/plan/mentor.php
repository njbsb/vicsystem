<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Academic</li>
</ol>

<h2><?= $title ?></h2>
<?php $session = ($activesession) ? $activesession['academicsession'] : '?' ?>
<h4><?= sprintf('Academic Session: %s', $session) ?></h4>
<?php if (!$activesession) : ?>
<small>You are not within any active academic session. Please configure the academic session's date properly <a href="<?= site_url('academic/control') ?>">here</a></small>
<?php endif ?>
<hr>
<div class="form-group">
    <?= form_open('academic/record') ?>
    <label for="">Search records</label>
    <div class="row">
        <div class="col-md-3">
            <select name="acadyear_id" id="acadyear_id" class="form-control" required>
                <option value="" disabled selected>Select academic year</option>
                <?php foreach ($academicyears as $acadyear) : ?>
                <option value="<?= $acadyear['id'] ?>"><?= $acadyear['acadyear'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="semester" id="semester" class="form-control" required>
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

<?php if ($this->session->flashdata('message')) : ?>
<?= $this->session->flashdata('message') ?>
<?php endif ?>

<hr>
<div class="card">
    <div class="container">
        <?= form_open_multipart('academic/import_result') ?>
        <div class="row">
            <div class="col-lg-6 col-md-8">
                <div class="form-group">
                    <?php $label = ($today >= strtotime($examdate) and $examdate) ? "It's end of academic session. Upload the students' result here" : '' ?>
                    <?php $disabled = ($today >= strtotime($examdate) and $examdate) ? "" : 'disabled' ?>
                    <label for="upload_file" class="form-label mt-4"><?= $label ?></label>
                    <input class="form-control" type="file" name="upload_file" id="upload_file" required accept=".csv,.xls,.xlsx" <?= $disabled ?>>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button <?= $disabled ?> class="btn btn-info" type="submit"><i class='fas fa-upload'></i> Upload</button>
        </div>
        <?php if ($today >= strtotime($examdate) and $examdate) : ?>
        <?php $id = ($activesession) ? $activesession['id'] : '?' ?>
        <small>Get result upload template <a href="<?= site_url('filelink') ?>">here</a>. ID of current session: <?= $id ?></small>
        <?php else : ?>
        <small>You are able to upload your students' result after week 14</small>
        <?php endif ?>
        <?= form_close() ?>
    </div>
</div>
<hr>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="acp_table" class="table display table-hover">
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
                    <?php endif ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#acp_table').DataTable({
        "order": []
    });
});
</script>