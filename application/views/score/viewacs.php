<h2>Score: <?= $academicsession['academicsession'] ?></h2>
<hr>
<table class="table" id="scoreacs">
    <thead class="table-dark">
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th data-toggle="tooltip" data-placement="top" title="55%">Score (55%)</th>
            <th data-toggle="tooltip" data-placement="top" title="+36%">Expected (100%)</th>
            <th>Badge count</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($enrolling) : ?>
            <?php foreach ($enrolling as $std) : ?>
                <tr>
                    <td><?= $std['matric'] ?></td>
                    <td><?= $std['name'] ?></td>
                    <td><?= $std['score'] ?>%</td>
                    <td><?= $std['score'] + 36 ?>%</td>
                    <?php $badge = ($std['badgecount'] > 0) ? '<i class="fas fa-award"></i>' : '' ?>
                    <td><?= $std['badgecount'] ?> <?= $badge ?></td>
                    <td><a class="badge badge-pill badge-primary" href="<?= site_url('score/' . $academicsession['slug'] . '/' . $std['matric']) ?>">edit</a></td>
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
        $('#scoreacs').DataTable();
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    });
</script>