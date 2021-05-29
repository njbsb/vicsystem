<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Score Board</li>
</ol>
<br>
<h4 class="text-center">Current Academic Session: <?= $thisacademicsession['academicsession'] ?></h4>
<div class="card" style="border-radius:1rem; padding-top:0.75rem">
    <div class="card-body">
        <div class="text-center">
            <h2 class="display-4 text-center">Badge Board</h2>
            <p>Cumulative</p>
        </div>

        <hr class="my-2">
        <!-- <p>More info</p> -->
        <p class="lead">
            <a class="btn btn-success" href="<?= site_url('score/download_badgeboard') ?>" target="_blank"><i class='fas fa-file-excel'></i> Download</a>
        </p>
        <table id="badgeboard" class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th>No</th>
                    <th>Matric</th>
                    <th>Name</th>
                    <th>Academic Badge</th>
                    <th>Activity Badge</th>
                    <th>External Badge</th>
                    <th>Total</th>
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
                </tr>
                <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>
<br>
<div class="card" style="border-radius:1rem; padding-top:0.75rem">
    <div class="card-body">
        <div class="text-center">
            <h2 class="display-4 text-center">Score Board</h2>
            <p><?= $thisacademicsession['academicsession'] ?></p>
        </div>
        <hr class="my-2">
        <!-- <p>More info</p> -->
        <p class="lead">
            <!-- <?= form_open('score/download') ?>
        <button type="submit" class="btn btn-info">Download</button>
        <?= form_close() ?> -->

            <a class="btn btn-success" href="<?= site_url('score/download_scoreboard') ?>" target="_blank"><i class='fas fa-file-excel'></i> Download</a>
        </p>
        <table id="scoreboard" class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th>No</th>
                    <th>Matric</th>
                    <th>Name</th>
                    <th>Activity Score</th>
                    <th>Workshop Score</th>
                    <th>Components</th>
                    <th>Total (55%)</th>
                </tr>
            </thead>
            <tbody class="table-active">
                <?php array_multisort(array_column($students, 'totalscore'), SORT_DESC, $students); ?>
                <?php if ($students) : ?>
                <?php foreach ($students as $i => $student) : ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $student['id'] ?></td>
                    <td><?= $student['name'] ?></td>
                    <td><?= $student['activityscore'] ?></td>
                    <td><?= $student['workshopscore'] ?></td>
                    <td><?= $student['componentscore'] ?></td>
                    <td><?= $student['totalscore'] ?></td>
                </tr>
                <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#badgeboard').DataTable();
    $('#scoreboard').DataTable();
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
});
</script>