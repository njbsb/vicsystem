<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('activity') ?>">Activity</a></li>
    <li class="breadcrumb-item active"><?= sprintf('Record @ %s', $academicsession['academicsession']) ?></li>
</ol>

<?php if ($activities) : ?>
    <?php foreach ($activities as $act) : ?>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="<?= site_url('activity/' . $act['slug']) ?>"><?= $act['title'] ?></a></h4>
                        <span class="badge rounded-pill bg-dark text-white"><?= $act['academicsession'] ?></span>&nbsp;<span class="badge rounded-pill bg-warning"><?= $act['category'] ?></span><small class="post-date">Date:
                            <?= date('d/m/Y', strtotime($act['datetime_start'])) ?></small>
                        <p><?= word_limiter($act['description'], 10) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-6">
                <div class="row">
                    <div class="col">
                        <div class="container">
                            <h6>Committees: <?= $act['committeenum'] ?></h6>
                            <?php if ($act['committees']) : ?>
                                <?php foreach ($act['committees'] as $committee) : ?>
                                    <div class="img-wrap" style="margin:2px;">
                                        <a data-name="<?= $committee['name'] ?>" href="<?= site_url('student/' . $committee['id']) ?>"><img data-toggle="tooltip" data-placement="bottom" title="<?= $committee['role'] ?>" class="rounded-circle" style="object-fit:cover;" src="<?= $committee['userphoto'] ?>" alt="<?= $committee['name'] ?>" width="60px" height="60px"></a>
                                    </div>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <hr>
    <?php endforeach ?>
<?php endif ?>