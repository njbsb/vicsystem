<h3><?= $title ?></h3>

<h1><?= $academicsession['academicsession'] ?></h1>
<br>
<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Academic Session</th>
            <th>GPA Target</th>
            <th>GPA Achieved</th>
            <th>Increment</th>
        </tr>
    </thead>
    <tbody class="table-light">
        <?php if ($academicplan) : ?>
        <tr>
            <td><?= $academicplan['academicsession'] ?></td>
            <td><?= $academicplan['gpa_target'] ?></td>
            <td><?= $academicplan['gpa_achieved'] ?></td>
            <?php $class = ($academicplan['increment'] > 0) ? 'text-success' : 'text-danger' ?>
            <td class="<?= $class ?>"><?= $academicplan['increment'] ?></td>
        </tr>
        <?php else : ?>
        <tr>
            <td>No data of academic plan in record</td>
        </tr>
        <?php endif ?>
    </tbody>
</table>
<br>
<h4>Citra Registered</h4>
<?php if (isset($citras)) : ?>
<?php foreach ($citras as $citra) : ?>
<span data-toggle="tooltip" data-placement="top" title="<?= $citra['citraname'] ?>" class="badge badge-pill badge-primary"><?= $citra['citra_code'] ?></span>
<?php endforeach ?>
<?php else : ?>
<p>No data of Citra course registered</p>
<?php endif ?>
<hr>
<h4>Scores</h4>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#overall">Overall</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#level">Level</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#comp">Comp</a>
    </li>

</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade show active" id="overall">
        <br>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Academic Session</th>
                    <?php if ($scoreplans) : ?>
                    <?php foreach ($scoreplans as $scoreplan) : ?>
                    <th class="text-warning"><?= $scoreplan['label'] ?></th>
                    <?php endforeach ?>
                    <?php endif ?>
                    <th>Components</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody class="table-default">
                <tr>
                    <td><?= $academicsession['academicsession'] ?></td>
                    <?php if ($scoreplans) : ?>
                    <?php foreach ($scoreplans as $scoreplan) : ?>
                    <td><?= $scoreplan['totalpercent'] ?></td>
                    <?php endforeach ?>
                    <?php endif ?>
                    <?php if ($scorecomp) : ?>
                    <td><?= $scorecomp['total'] ?> %</td>
                    <?php else : ?>
                    <td>?</td>
                    <?php endif ?>
                    <td><?= $total_all ?> %</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="level">
        <br>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Activity Name</th>
                    <th>Level</th>
                    <?php foreach ($levelrubrics as $rubric => $val) : ?>
                    <th class="text-warning"><?= ucfirst($rubric) ?></th>
                    <?php endforeach ?>
                    <th>Total Score</th>
                    <th>Total Percent</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($scoreplans) : ?>
                <?php foreach ($scoreplans as $scoreplan) : ?>
                <tr>
                    <td><?= $scoreplan['activity_name'] ?></td>
                    <td><?= $scoreplan['label'] ?></td>
                    <?php foreach ($scoreplan['scores'] as $rubric => $val) : ?>
                    <td><?= $val ?></td>
                    <?php endforeach ?>
                    <td><?= $scoreplan['total'] ?></td>
                    <td><?= $scoreplan['totalpercent'] ?>/<?= $scoreplan['percentweightage'] ?> %</td>
                </tr>
                <?php endforeach ?>
                <?php else : ?>
                <tr>
                    <td>No data found</td>
                </tr>
                <?php endif ?>

            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="comp">
        <br>
        <table class="table"">
            <thead class=" table-dark">
            <tr>
                <th>Digital CV</th>
                <th>Leadership</th>
                <th>Volunteer</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <?php if ($scorecomp) : ?>
                    <td><?= $scorecomp['digitalcv'] ?> %</td>
                    <td><?= $scorecomp['leadership'] ?> %</td>
                    <td><?= $scorecomp['volunteer'] ?> %</td>
                    <td><?= $scorecomp['total'] ?> %</td>
                    <?php else : ?>
                    <td>No data found</td>
                    <?php endif ?>
                </tr>
            </tbody>
        </table>
        <p>*Total score for components is 15%</p>
    </div>
</div>

<script>
$(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>