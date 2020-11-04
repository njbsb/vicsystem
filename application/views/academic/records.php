<h3><?= $title ?></h3>

<h1><?= $academicsession['academicsession'] ?></h1>
<br>
<table class="table">
    <thead class="table-dark">
        <tr>
            <td>Academic Session</td>
            <td>GPA Target</td>
            <td>GPA Achieved</td>
            <td>Increment</td>
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
<?php if ($citras) : ?>
    <?php foreach ($citras as $citra) : ?>
        <span class="badge badge-pill badge-primary"><?= $citra['citra_code'] ?></span>
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
                    <td>Academic Session</td>
                    <?php if ($scorelevels) : ?>
                        <?php foreach ($scorelevels as $scorelevel) : ?>
                            <td><?= $scorelevel['label'] ?></td>
                        <?php endforeach ?>
                    <?php endif ?>
                    <td>Components</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody class="table-default">
                <tr>
                    <td><?= $academicsession['academicsession'] ?></td>
                    <?php if ($scorelevels) : ?>
                        <?php foreach ($scorelevels as $scorelevel) : ?>
                            <td><?= $scorelevel['totalpercent'] ?></td>
                        <?php endforeach ?>
                    <?php endif ?>
                    <?php if ($scorecomp) : ?>
                        <td><?= $scorecomp['total'] ?></td>
                    <?php else : ?>
                        <td>?</td>
                    <?php endif ?>
                    <td><?= $overall['total_all'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="level">
        <br>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <td>Activity Name</td>
                    <td>Level</td>
                    <?php foreach ($levelrubrics as $rubric => $val) : ?>
                        <td><?= ucfirst($rubric) ?></td>
                    <?php endforeach ?>
                    <td>Total Score</td>
                    <td>Total Percent</td>
                </tr>
            </thead>
            <tbody>
                <?php if ($scorelevels) : ?>
                    <?php foreach ($scorelevels as $scorelevel) : ?>
                        <tr>
                            <td><?= $scorelevel['activity_name'] ?></td>
                            <td><?= $scorelevel['label'] ?></td>
                            <?php foreach ($levelrubrics as $rubric => $val) : ?>
                                <td><?= $scorelevel[$rubric] ?></td>
                            <?php endforeach ?>
                            <td><?= $scorelevel['total'] ?></td>
                            <td><?= $scorelevel['totalpercent'] ?>/<?= $scorelevel['percentweightage'] ?></td>
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
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <td>Digital CV</td>
                    <td>Leadership</td>
                    <td>Volunteer</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $scorecomp['digitalcv'] ?></td>
                    <td><?= $scorecomp['leadership'] ?></td>
                    <td><?= $scorecomp['volunteer'] ?></td>
                    <td><?= $scorecomp['total'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>