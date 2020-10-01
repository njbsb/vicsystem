<h4><b>Category:</b> <?= $title ?></h4>
<div class="container-fluid row">
    <?php if ($comments) : ?>
        <?php foreach ($comments as $com) : ?>
            <div class="col-md-4 margin">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="mr-auto"><?= $com['student_matric'] ?></strong>
                        <small><?= $com['commented_at'] ?></small>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        <?= $com['comment'] ?> on
                        <p><small><?= $com['activity_name'] ?></small></p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    <?php endif ?>
</div>