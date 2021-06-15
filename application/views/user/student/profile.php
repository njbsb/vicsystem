<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Profile</li>
</ol>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 text-center">
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= $student['userphoto'] ?>">
                <div class="card-footer text-white text-center">
                    <?= $student['id'] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8 text-left">
            <div class="row">
                <div class="col-6">
                    <h3><b><?= $student['name'] ?></b></h3>
                </div>
                <div class="col-6">
                    <a href="<?= site_url('profile/update') ?>" class="btn btn-outline-dark" style="float:right;"><i class='fas fa-pen'></i> Edit</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <h6><b>Club name</b></h6>
                    <h6><b>Program</b></h6>
                    <h6><b>Year Joined</b></h6>
                    <h6><b>Year</b></h6>
                    <h6><b>Phone Num</b></h6>
                    <h6><b>Email</b></h6>
                    <h6><b>Mentor</b></h6>
                </div>
                <div class="col-md-9">
                    <h6><?= $student['signamecode'] ?></h6>
                    <h6><?= $student['program_name'] ?></h6>
                    <h6><?= $student['year'] ?></h6>
                    <h6><?= $student['yearjoined'] ?></h6>
                    <h6><?= $student['phonenum'] ?></h6>
                    <h6><a href="mailto:<?= $student['email'] ?>"><?= $student['email'] ?></a></h6>
                    <?php $mentorname = ($student['mentor_name']) ? $student['mentor_name'] : '-' ?>
                    <h6><?= $mentorname ?></h6>
                </div>
            </div>
            <hr>
            <h5>Personal Information</h5>
            <div class="row">
                <div class="col-md-3">
                    <h6><b>Parent Contact 1</b></h6>
                    <h6><b>Parent Contact 2</b></h6>
                    <h6><b>Address</b></h6>
                </div>
                <div class="col-md-9">
                    <h6><?= $student['parent_num1'] ?></h6>
                    <h6><?= $student['parent_num2'] ?></h6>
                    <h6><?= $student['address'] ?></h6>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h2 class="text-center">Previous Activity and Roles</h2>
    <br>
    <?php if ($activity_roles) : ?>
    <div class="card">
        <div class="card-body">
            <h4 class="text-white text-center"><b>Activity Level</b></h4>
            <br>
            <div class="table-responsive">
                <table id="acttable" class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Year</th>
                            <th>Activity</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody class="table-active">
                        <?php foreach ($activity_roles as $actrole) : ?>
                        <?php $desc = (isset($actrole['description'])) ? sprintf(' (%s)', $actrole['description']) : '' ?>
                        <tr>
                            <td><?= $actrole['acadyear'] . ' Semester ' . $actrole['semester'] ?></td>
                            <td><?= $actrole['activity_name'] ?></td>
                            <td><?= $actrole['role'] . $desc ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php else : ?>
    <p class="text-center">No data of roles in activity found</p>
    <?php endif ?>

    <hr>

    <?php if ($org_roles) : ?>
    <div class="card">
        <div class="card-body">
            <h4 class="text-white text-center"><b>Organization Level</b></h4>
            <br>
            <div class="table-responsive">
                <table id="orgtable" class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Academic Year</th>
                            <th>Role</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($org_roles as $orgrole) : ?>
                        <?php $desc = (isset($orgrole['description']) or $orgrole['description']) ? sprintf(' (%s)', $orgrole['description']) : '' ?>
                        <tr class="table-light">
                            <td><?= $orgrole['acadyear'] ?></td>
                            <td><?= $orgrole['role'] ?></td>
                            <td><?= $orgrole['description'] ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php else : ?>
    <p class="text-center">No data of roles in SIG found</p>
    <?php endif ?>
</div>

<script>
$(document).ready(function() {
    $('#acttable').DataTable({
        "order": []
    });
    $('#orgtable').DataTable({
        "order": []
    });
});
</script>