<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('mentor') ?>">Mentor</a></li>
    <li class="breadcrumb-item active"><?= $mentor['name'] ?></li>
</ol>

<div class="container-fluid text-center">
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= $mentor['userphoto'] ?>">
                <div class="card-footer text-muted">
                    <?= $mentor['id'] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-left">
            <h3><b><?= $mentor['name'] ?></b></h3>
            <h6><b>Position: </b><?= $mentor['position'] ?></h6>
            <h6><b>Email:</b> <a href="mailto:<?= $mentor['email'] ?>"><?= $mentor['email'] ?></a></h6>
            <h6><b>Club name:</b> <?= $mentor['signame'] ?></h6>
            <h6><b>Role:</b> <?= $mentor['role'] ?></h6>
            <h6><b>Room:</b> <?= $mentor['roomnum'] ?></h6>
        </div>
        <?php if ($isMentor) : ?>
        <div class="col-lg-4">
            <?= form_open('/mentor/edit/' . $mentor['id']) ?>
            <input type="submit" value="Edit Mentor" class="btn btn-outline-secondary">
            <?= form_close() ?>
        </div>
        <?php endif ?>

    </div>
    <hr>
    <div class="text-center">
        <h2>Previous Activities and Roles</h2>
        <br>
        <h4 class="text-secondary"><b>Activity Level</b></h4>
    </div>
    <?php if ($activity_roles) : ?>
    <table id="acttable" class="table">
        <thead>
            <tr class="table-primary">
                <th>Session</th>
                <th>Activity</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activity_roles as $actrole) : ?>
            <tr class="table-active">
                <td><?= $actrole['academicsession'] ?></td>
                <td><?= $actrole['title'] ?></td>
                <td>Activity Advisor</td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php else : ?>
    <p>No data of activity roles found</p>
    <?php endif ?>
</div>

<script>
$(document).ready(function() {
    $('#acttable').DataTable();
});
</script>