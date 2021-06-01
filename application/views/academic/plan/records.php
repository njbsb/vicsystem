<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('academic') ?>">Academic</a></li>
    <li class="breadcrumb-item active">Records</li>
</ol>

<h2><?= $title ?></h2>
<h4>Academic Session: <?= $academicsession['academicsession'] ?></h4>
<hr>
<div class="card">
    <div class="card-body">
        <?php if ($academicplans) : ?>
        <div class="form-group">
            <?php $hidden = array('acadyear_id' => $acadyear_id, 'semester' => $semester) ?>
            <?= form_open('academic/download_record', '', $hidden) ?>
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