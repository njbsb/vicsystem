<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Academic Plan</li>
</ol>

<h2><?= $title ?></h2>
<h4>Academic Session: <?= $activesession['academicsession'] ?></h4>
<hr>
<div class="form-group">
    <?= form_open('academicplan/records') ?>
    <label for="">Search records</label>
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
            <button type="submit" class="btn btn-outline-primary"><i class='fas fa-search'></i> Search</button>
        </div>
    </div>
    <?= form_close() ?>
</div>


<?php if ($this->session->flashdata('message')) : ?>
<?= $this->session->flashdata('message') ?>
<?php endif ?>


<?php if ($activesession['endofsession'] == true) : ?>
<hr>
<div class="card">
    <div class="container">
        <?= form_open_multipart('academic/import_result') ?>
        <div class="form-group">
            <!-- <p>It's end of academic session. Upload the students' result here</p> -->
            <label for="formFile" class="form-label mt-4">It's end of academic session. Upload the students' result here</label>
            <input class="form-control" type="file" name="upload_file" id="upload_file" required accept=".csv,.xls,.xlsx">
        </div>
        <div class="form-group">
            <button class="btn btn-info" type="submit"><i class='fas fa-upload'></i> Upload</button>
        </div>
        <?= form_close() ?>
    </div>
</div>
<hr>
<?php else : ?>
<p>You can only upload students' result once it is end of academic session. Set it <a href="<?= site_url('academic') ?>">here</a></p>
<?php endif ?>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="acp_table" class="table display">
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
                        <td>No data</td>
                    </tr>
                    <?php endif ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#acp_table').DataTable();
});
</script>