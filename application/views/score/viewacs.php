<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active"><a href="<?= site_url('score') ?>">Score</a></li>
    <li class="breadcrumb-item active"><?= $academicsession['academicsession'] ?></li>
</ol>

<h2>Score: <?= $academicsession['academicsession'] ?></h2>

<hr>
<div class="card">
    <div class="card-body">
        <?php if ($fullscore < 55) : ?>
            <div class="form-group">
                <small class="text-danger">Attention!</small>
                <small>Seems that your score plan is not configured properly (<?= $fullscore ?>/55).</small>
                <small>To edit current score plan, go <a href="<?= site_url('scoreplan/' . $academicsession['slug']) ?>">here</a></small>
            </div>
        <?php endif ?>
        <?php if ($this->session->userdata('user_type') != 'student' and $enrolling) : ?>
            <div class="form-group">
                <a class="btn btn-success" href="<?= site_url('score/download_scoreboard/' . $academicsession['id'])  ?>" target="_blank"><i class='fas fa-file-excel'></i> Download</a>
            </div>
        <?php endif ?>
        <div class="table-responsive">
            <table class="table table-hover text-center" id="scoreacs">
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
                <tbody class="table-active">
                    <?php if ($enrolling) : ?>
                        <?php foreach ($enrolling as $std) : ?>
                            <tr>
                                <td><?= $std['matric'] ?></td>
                                <td><?= $std['name'] ?></td>
                                <td><?= $std['score'] ?>%</td>
                                <td><?= $std['score'] + 36 ?>%</td>
                                <?php $badge = ($std['badgecount'] > 0) ? '<i class="fas fa-award"></i>' : '' ?>
                                <td><?= $std['badgecount'] ?> <?= $badge ?></td>
                                <td><a class="btn btn-outline-dark btn-sm" href="<?= site_url('score/' . $academicsession['slug'] . '/' . $std['matric']) ?>"><i class='fas fa-pen'></i> Edit</a></td>
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
        $('#scoreacs').DataTable({
            "order": []
        });
    });
</script>