<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('academic') ?>">Academic</a></li>
    <li class="breadcrumb-item active">Records <?= $academicsession['academicsession'] ?></li>
</ol>

<h4><?= $title ?></h4>
<br>
<!-- <h1><?= $academicsession['academicsession'] ?></h1> -->
<div class="table-responsive">
    <table class="table table-hover">
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
                    <?php $class = ($academicplan['increment'] >= 0) ? 'text-success' : 'text-danger' ?>
                    <td class="<?= $class ?>"><?= $academicplan['increment'] ?></td>
                </tr>
            <?php else : ?>
                <tr>
                    <td>No data of academic plan in record</td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
</div>
<?php if (!$academicplan['gpa_target']) : ?>
    <small class="text-white">Attention!</small>
    <small>You have not registered your target GPA for this semester yet! Set your current target GPA in Academic Plan page.</small>
<?php endif ?>

<hr>
<h3>Activity Scores</h3>
<br>
<!-- <div class="card">
    <div class="card-body"> -->
<div class="table-responsive">
    <table class="table table-hover text-center ">
        <thead class="table-dark">
            <tr>
                <th>Academic Session</th>
                <?php if ($scoreplans) : ?>
                    <?php foreach ($scoreplans as $scoreplan) : ?>
                        <th data-toggle="tooltip" data-placement="top" title="<?= $scoreplan['percentweightage'] ?>%">
                            <?= $scoreplan['label'] ?>
                        </th>
                    <?php endforeach ?>
                <?php endif ?>
                <th data-toggle="tooltip" title="15%">Components</th>
                <th>Total (55%)</th>
            </tr>
        </thead>
        <tbody class="table-active">
            <tr>
                <td><?= $academicsession['academicsession'] ?></td>
                <?php if ($scoreplans) : ?>
                    <?php foreach ($scoreplans as $scoreplan) : ?>
                        <td><?= $scoreplan['totalpercent'] ?> %</td>
                    <?php endforeach ?>
                <?php endif ?>
                <?php if ($totalcomp) : ?>
                    <td><?= $totalcomp ?> %</td>
                <?php else : ?>
                    <td>?</td>
                <?php endif ?>
                <td><?= $total_all ?> %</td>
            </tr>
        </tbody>
    </table>
</div>
<!-- </div>
</div> -->
<hr>
<div class="row">
    <?php foreach ($scoreplans as $scoreplan) : ?>
        <div class="col-lg-6 col-md-6">
            <div class="card" style="margin-bottom:20px;">
                <div class="card-body">
                    <h5 class="text-primary text-center"><b><?= sprintf('Level %s', $scoreplan['label']) ?></b></h5>
                    <hr>
                    <div class="form-group">
                        <?php $textclass = (array_sum($scoreplan['scores']) > 18 and $scoreplan['activitycategory_id'] == 'A') ? 'text-info' : '' ?>
                        <?php $scpbadge = (array_sum($scoreplan['scores']) > 18 and $scoreplan['activitycategory_id'] == 'A') ? '<i class="fas fa-award" style="color: #3498db;"></i>' : '' ?>
                        <h3 class="<?= $textclass ?> text-center"><?= array_sum($scoreplan['scores']) ?>/<?= $scoreleveltotal ?> <?= $scpbadge ?></h3>
                    </div>
                    <div class="form-group">
                        <h6><?= $scoreplan['category'] . ': ' . $scoreplan['title'] ?></h6>
                    </div>
                    <div class="row">
                        <?php if ($scoreplan['scores']) : ?>
                            <?php foreach ($scoreplan['scores'] as $key => $score) :  ?>
                                <div class="col-sm-6 col-md-6 col-lg-3 text-center">
                                    <div class="form-group card" style="padding:4px;border-radius: 10px">
                                        <p class="text-info"><?= ucfirst($key) ?></p>
                                        <h3><?= $score ?></h3>
                                        <?php foreach ($guide[$key] as $scoreguide) : ?>
                                            <?php if ($scoreguide['score'] == $score) : ?>
                                                <small><?= $scoreguide['description']  ?></small>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else : ?>
                            <div class="col">
                                <br><small>Your mentor has not marked score for this activity</small>
                            </div>
                        <?php endif ?>

                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <div class="col-md 6">
        <div class="card" style="padding-top: 20px; padding-bottom: 20px;">
            <div class="container">
                <h5 class="text-primary text-center"><b>Components</b></h5>
                <div class="form-group">
                    <!-- <h6>Total:</h6> -->
                    <?php $sum = $scorecomps['scores'] ? array_sum($scorecomps['scores']) : 0 ?>
                    <h3 class="text-center"><?= $sum ?>/15</h3>
                    <?php if ($sum == 15) : ?>
                        <small>Full score!</small>
                    <?php endif ?>

                </div>
                <div class="row justify-content-center">
                    <?php if ($scorecomps['scores']) : ?>
                        <?php foreach ($scorecomps['scores'] as $key => $value) : ?>
                            <div class="col-sm-4 col-md-4 col-lg-4 text-center">
                                <div class="form-group card" style="padding: 4px; border-radius: 10px">
                                    <p class="text-info"><?= ucfirst($key) ?></p>
                                    <h3><?= $value ?></h3>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php else : ?>
                        <div class="col">
                            <br><small>Your mentor has not marked score for this academic session</small>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>