<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Student</li>
</ol>
<small>Student that has not been validated won't show here</small>
<div class="container-fluid text-center">
    <?php if ($students) : ?>
    <div class="row">
        <?php foreach ($students as $student) : ?>
        <div class="col-sm-6 col-md-4 col-lg-2">
            <div class="card mb2">
                <div class="container d-flex flex-column align-items-center">
                    <img class="rounded-circle" src="<?= $student['userphoto'] ?>" style="padding:10px; object-fit: cover;" alt="" width="130" height="130">
                </div>
                <div class="card-footer text-muted">
                    <a href="<?= site_url('student/') . $student['id'] ?>"><?= $student['id'] ?></a>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
    <?php else : ?>
    No data of students
    <?php endif ?>
</div>