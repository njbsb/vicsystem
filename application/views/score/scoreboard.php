<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Score Board</li>
</ol>
<br>
<h4 class="text-center">Current Academic Session: <?= $thisacademicsession['academicsession'] ?></h4>
<div class="jumbotron" style="border-radius:1rem;">
    <h2 class="display-3 text-center">Score Board</h2>
    <hr class="my-2">
    <!-- <p>More info</p> -->
    <p class="lead">
        <!-- <?= form_open('score/download') ?>
        <button type="submit" class="btn btn-info">Download</button>
        <?= form_close() ?> -->

        <a class="btn btn-info" href="<?= site_url('score/download') ?>" target="_blank">Download</a>
    </p>
    <table id="scoreboard" class="table">
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

<script>
$(document).ready(function() {
    $('#scoreboard').DataTable();
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
});
</script>