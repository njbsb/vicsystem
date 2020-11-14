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
                    <option value="<?= $sem['id'] ?>"><?= $sem['id'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-outline-primary">Search record</button>
        </div>
    </div>
    <?= form_close() ?>
</div>


<!-- ACADEMIC PLAN -->
<!-- <div class="row justify-content-between">
    <div class="col-4">
        <h3>Academic Plan</h3>
    </div>
    <div class="col-4">
        <button class="btn btn-outline-primary margin" data-toggle="modal" data-target="#addacademicplan" style="float: right;">Add Academic Plan</button>
    </div>
</div> -->
<table id="acp_table" class="table display">
    <thead class="table-dark">
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <!-- <td>Academic Session</td> -->
            <th>GPA Target</th>
            <th>GPA Achieved</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($academicplans) : ?>
            <?php foreach ($academicplans as $acp) : ?>
                <tr>
                    <td><?= $acp['student_matric'] ?></td>
                    <td><?= $acp['name'] ?></td>
                    <!-- <td><?= $acp['acadyear'] . ' Semester ' . $acp['semester_id'] ?></td> -->
                    <td><?= $acp['gpa_target'] ?></td>
                    <td><?= $acp['gpa_achieved'] ?></td>

                    <?php if ($acp['gpa_achieved'] > $acp['gpa_target']) : ?>
                        <td class="text-success">
                            Passed
                        </td>
                    <?php else : ?>
                        <td class="text-warning">
                            Not Pass
                        </td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
        <?php else : ?>
            <tr>
                <td>No data</td>
            </tr>
        <?php endif ?>

    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#acp_table').DataTable();
    });
</script>