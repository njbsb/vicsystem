<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('academicplan/student') ?>">Academic Plan</a></li>
    <li class="breadcrumb-item active">Records <?= $academicsession['academicsession'] ?></li>
</ol>

<h4><?= $title ?></h4>
<br>
<!-- <h1><?= $academicsession['academicsession'] ?></h1> -->
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
<?php if (!$academicplan['gpa_target']) : ?>
<small class="text-warning">Attention!</small>
<small>You have not registered your target GPA for this semester yet! Set your current target GPA in Academic Plan page.</small>
<?php endif ?>
<hr>
<div class="jumbotron" style="border-radius: 12px; padding-top: 20px; padding-bottom: 20px;">
    <div class="container">
    </div>
    <h4>Citra Registered</h4>
    <?php if (isset($citras)) : ?>
    <?php foreach ($citras as $citra) : ?>
    <span data-toggle="tooltip" data-placement="top" title="<?= $citra['citraname'] ?>" class="badge badge-pill badge-primary"><?= $citra['citra_code'] ?></span>
    <?php endforeach ?>
    <?php else : ?>
    <p>No data of Citra course registered</p>
    <?php endif ?>
    <small>This feature has not been made available yet.</small>
</div>

<hr>
<h3>Activity Records</h3>
<br>
<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Academic Session</th>
            <?php if ($scoreplans) : ?>
            <?php foreach ($scoreplans as $scoreplan) : ?>
            <th><?= sprintf('%s (%s%%)', $scoreplan['label'], $scoreplan['percentweightage']) ?></th>
            <?php endforeach ?>
            <?php endif ?>
            <th>Components (15%)</th>
            <th>Total (55%)</th>
        </tr>
    </thead>
    <tbody>
        <tr class="table-light">
            <td><?= $academicsession['academicsession'] ?></td>
            <?php if ($scoreplans) : ?>
            <?php foreach ($scoreplans as $scoreplan) : ?>
            <td><?= $scoreplan['totalpercent'] ?></td>
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

<div class="row">
    <?php foreach ($scoreplans as $scoreplan) : ?>
    <div class="col-lg-6">
        <div class="jumbotron jumbotron-fluid" style="border-radius: 12px; padding-top: 20px; padding-bottom: 20px; background-color: rgba(141, 207, 240,0.5);">
            <div class="container">
                <h5 class="text-primary text-center"><b><?= sprintf('%s (%s)', $scoreplan['title'], $scoreplan['label']) ?></b></h5>
                <div class="form-group">
                    <?php $textclass = (array_sum($scoreplan['scores']) > 18) ? 'text-info' : '' ?>
                    <?php $scpbadge = (array_sum($scoreplan['scores']) > 18 and $scoreplan['activitycategory_id'] == 'A') ? '<i class="fas fa-award" style="color: #3498db;"></i>' : '' ?>
                    <h3 class="<?= $textclass ?> text-center"><?= array_sum($scoreplan['scores']) ?>/<?= $scoreleveltotal ?> <?= $scpbadge ?></h3>
                    <!-- <?php if (array_sum($scoreplan['scores']) > 18) : ?>
                    <small><?= $student['name'] ?> earned a badge!</small>
                    <?php endif ?> -->
                </div>
                <div class="row">
                    <?php if ($scoreplan['scores']) : ?>
                    <?php foreach ($scoreplan['scores'] as $key => $score) :  ?>
                    <div class="col-sm-3 text-center">
                        <div class="form-group" style="background: white; padding: 4px; border-radius: 10px">
                            <p class="text-info"><b><?= ucfirst($key) ?></b></p>
                            <h3><?= $score ?></h3>
                            <?php foreach ($guide[$key] as $scoreguide) : ?>
                            <?php if ($scoreguide['score'] == $score) : ?>
                            <small class="text-secondary"><?= $scoreguide['description']  ?></small>
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
        <div class="jumbotron jumbotron-fluid" style="border-radius: 12px; padding-top: 20px; padding-bottom: 20px; background-color: rgba(141, 207, 240,0.5)">
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
                <!-- <?php $status = ($scorecomps['scores']) ? 'Complete &#9989;' : 'Incomplete &#10060;' ?>
                <label>Component: <?= $status ?></label> -->
                <div class="row justify-content-center">
                    <?php if ($scorecomps['scores']) : ?>
                    <?php foreach ($scorecomps['scores'] as $key => $value) : ?>
                    <div class="col-sm-4 text-center">
                        <div class="form-group" style="background: white; padding: 4px; border-radius: 10px">
                            <p class="text-info"><b><?= ucfirst($key) ?></b></p>
                            <h3><?= $value ?></h3>
                            <!-- <?php if ($key != 'volunteer') : ?>
                            <?php foreach ($guide[$key] as $scoreguide) : ?>
                            <?php if ($scoreguide['id'] = $value) : ?>
                            <small><?= $scoreguide['description'] ?></small>
                            <?php endif ?>
                            <?php endforeach ?>
                            <?php endif ?> -->

                        </div>
                    </div>
                    <?php endforeach ?>
                    <?php else : ?>
                    <div class="col">
                        <!-- <button data-toggle="modal" data-target="#addcomp" class="btn btn-info">Add Score</button> -->
                        <br><small>Your mentor has not marked score for this academic session</small>
                    </div>
                    <?php endif ?>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
$(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>