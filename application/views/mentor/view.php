<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('mentor') ?>">Mentor</a></li>
    <li class="breadcrumb-item active"><?= $mentor['name'] ?></li>
</ol>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card border-dark mb-3 text-center" style="max-width: 20rem;">
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= $mentor['userphoto'] ?>">
                <div class="card-footer text-muted">
                    <?= $mentor['id'] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12 text-left">
            <h3><b><?= $mentor['name'] ?></b></h3>
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <h6><b>Position</b></h6>
                    <h6><b>Email</b></h6>
                    <!-- <h6><b>Club name</b></h6> -->
                    <h6><b>Role</b></h6>
                    <h6><b>Room No</b></h6>
                    <h6><b>Phone No</b></h6>
                </div>
                <div class="col-sm-6 col-md-8 col-lg-9">
                    <h6><?= $mentor['position'] ?></h6>
                    <h6><a href="mailto:<?= $mentor['email'] ?>"><?= $mentor['email'] ?></a></h6>
                    <!-- <h6><?= $mentor['signame'] ?></h6> -->
                    <h6><?= $mentor['role'] ?></h6>
                    <h6><?= $mentor['roomnum'] ?></h6>
                    <h6><?= $mentor['phonenum'] ?></h6>
                </div>
            </div>


        </div>
        <!-- <?php if ($isMentor) : ?>
        <div class="col-lg-4">
            <?= form_open('/mentor/edit/' . $mentor['id']) ?>
            <input type="submit" value="Edit Mentor" class="btn btn-outline-secondary">
            <?= form_close() ?>
        </div>
        <?php endif ?> -->

    </div>
    <hr>
    <div class="text-center">
        <h2>Previous Activities and Roles</h2>
        <br>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="text-secondary text-center"><b>Activity Level</b></h4>
            <?php if ($activity_roles) : ?>
            <div class="table-responsive">
                <table id="acttable" class="table">
                    <thead>
                        <tr class="table-dark">
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
            </div>
            <?php else : ?>
            <p>No data of activity roles found</p>
            <?php endif ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#acttable').DataTable({
        "order": []
    });
});
</script>