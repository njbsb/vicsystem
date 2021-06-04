<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Profile</li>
</ol>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card border-dark mb-3 text-center" style="max-width: 20rem;">
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= $mentor['userphoto'] ?>">
                <div class="card-footer text-white">
                    <?= $mentor['id'] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-6 text-left">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <h3><b><?= $mentor['name'] ?></b></h3>
                </div>
                <div class="col-lg-6 col-md-6">
                    <a href="<?= site_url('profile/update') ?>" class="btn btn-outline-dark" style="float:right;"><i class='fas fa-pen'></i> Edit</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h6><b>Email</b></h6>
                    <h6><b>Phone Number</b></h6>
                </div>
                <div class="col-lg-9 col-md-6 col-sm-6">
                    <h6><a href="mailto:<?= $mentor['email'] ?>"><?= $mentor['email'] ?></a></h6>
                    <h6><?= $mentor['phonenum'] ?></h6>
                </div>
            </div>
            <hr>
            <h5>Mentor Information</h5>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h6><b>Role</b></h6>
                    <h6><b>Position</b></h6>
                    <h6><b>Room Num</b></h6>
                </div>
                <div class="col-lg-9 col-md-6 col-sm-6">
                    <h6><?= $mentor['role'] ?></h6>
                    <h6><?= $mentor['position'] ?></h6>
                    <h6><?= $mentor['roomnum'] ?></h6>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h2 class="text-center">Previous Activity and Roles</h2> <br>
    <?php if ($activity_roles) : ?>
        <div class="card">
            <div class="card-body">
                <h4 class="text-center text-white"><b>Activity Roles</b></h4>
                <br>
                <div class="table-responsive">
                    <table id="tablerole" class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <td>Academic Session</td>
                                <td>Activity</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($activity_roles as $role) : ?>
                                <tr>
                                    <td><?= $role['academicsession'] ?></td>
                                    <td><?= $role['title'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else : ?>
        <p>No data of activity roles found</p>
    <?php endif ?>
</div>

<script>
    $(document).ready(function() {
        $('#tablerole').DataTable({
            "order": []
        });
    });
</script>