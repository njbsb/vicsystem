<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Collaborator</li>
</ol>

<h2><?= $title ?></h2>
<br>
<a class="btn btn-outline-dark btn-sm" href="<?= base_url('collaborator/create') ?>">Create new collaborator</a>
<br><br>
<!-- <div class="container-fluid">
    <div class="row">
        <?php if ($collaborators) : ?>
        <?php foreach ($collaborators as $collab) : ?>
        <div class="col-md-3">
            <div class="card border-primary mb-3 text-center" style="max-width: 20rem;">
                <div class="card-header"><?= $collab['name'] ?></div>
                <div class="card-body">
                    <?php $collabphoto = ($collab['logo']) ? $collab['logo'] : 'default.jpg' ?>
                    <img class="img-responsive" style="max-height:auto; max-width:100%; object-fit:cover; padding:6px;" src="<?= base_url('assets/images/collaborator/' . $collabphoto) ?>">
                </div>
            </div>
        </div>
        <?php endforeach ?>
        <?php else : ?>
        <p>No collaborators data found.</p>
        <?php endif ?>
    </div>
</div> -->
<div class="card">
    <div class="card-body">
        <table class="table">
            <thead class="table-primary">
                <td>Logo</td>
                <td>Name</td>
                <td>Description</td>
                <td>Action</td>
            </thead>
            <tbody class="table-active">
                <?php if ($collaborators) : ?>
                <?php foreach ($collaborators as $collab) : ?>
                <?php $collabphoto = ($collab['logo']) ? $collab['logo'] : 'default.jpg' ?>
                <tr>
                    <td><img class="img-responsive" style="max-height:50px; max-width:50px; object-fit:cover; padding:6px;" src="<?= base_url('assets/images/collaborator/' . $collabphoto) ?>"></td>
                    <td><?= $collab['name'] ?></td>
                    <td><?= $collab['description'] ?></td>
                    <td><a class="btn btn-sm btn-outline-dark" href=""><i class='fas fa-pen'></i></a></td>
                </tr>
                <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>
<small>This feature has not been made available yet.</small>