<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Badge Board</li>
</ol>
<br>
<div class="text-center">
    <?php if ($thisacademicsession) : ?>
    <h4>Current Academic Session: <?= $thisacademicsession['academicsession'] ?></h4>
    <?php else : ?>
    <h4>Current Academic Session: -</h4>
    <small>You do not have any active academic session</small>
    <?php endif ?>
</div>
<div class="card" style="border-radius:1rem; padding-top:0.75rem">
    <div class="card-body">
        <div class="text-center">
            <h2 class="display-4 text-center">Badge Board</h2>
            <p>Cumulative</p>
        </div>
        <hr class="my-2">
        <?php if ($usertype != 'student') : ?>
        <p class="lead">
            <a class="btn btn-success" href="<?= site_url('score/download_badgeboard') ?>" target="_blank"><i class='fas fa-file-excel'></i> Download</a>
        </p>
        <?php endif ?>
        <div class="table-responsive">
            <table id="badgeboard" class="table table-hover">
                <thead>
                    <tr class="table-dark">
                        <th>No</th>
                        <th>Matric</th>
                        <th>Name</th>
                        <th>Academic Badge</th>
                        <th>Activity Badge</th>
                        <th>External Badge</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-active">
                    <?php array_multisort(array_column($students, 'totalbadge'), SORT_DESC, $students); ?>
                    <?php if ($students) : ?>
                    <?php foreach ($students as $i => $student) : ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $student['id'] ?></td>
                        <td><?= $student['name'] ?></td>
                        <td><?= $student['academicbadge'] ?></td>
                        <td><?= $student['activitybadge'] ?></td>
                        <td><?= $student['externalbadge'] ?></td>
                        <td><?= $student['totalbadge'] ?></td>
                        <td><a class="btn btn-outline-dark btn-sm" href="<?= site_url('badgeboard/' . $student['id']) ?>"><i class='fas fa-search'></i></a></td>
                    </tr>
                    <?php endforeach ?>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
        <small>This badge board will only show records from active students</small>
    </div>
</div>
<br>

<script>
$(document).ready(function() {
    $('#badgeboard').DataTable();
});
</script>