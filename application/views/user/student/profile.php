<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Profile</li>
</ol>

<!-- <h2 class="text-center"><?= $title; ?></h2> -->

<div class="container-fluid text-center">
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= $student['userphoto'] ?>">
                <div class="card-footer text-muted">
                    <?= $student['id'] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8 text-left">
            <h3><b><?= $student['name'] ?></b></h3>
            <div class="row">
                <div class="col-md-3">
                    <h6><b>Club name</b></h6>
                    <h6><b>Program</b></h6>
                    <h6><b>Year</b></h6>
                    <h6><b>Phone Num</b></h6>
                    <h6><b>Email</b></h6>
                    <h6><b>Mentor</b></h6>
                </div>
                <div class="col-md-9">
                    <h6><?= $student['signamecode'] ?></h6>
                    <h6><?= $student['program_name'] ?></h6>
                    <h6><?= $student['year'] ?></h6>
                    <h6><a href="#"><?= $student['phonenum'] ?></a></h6>
                    <h6><a href="mailto:<?= $student['email'] ?>"><?= $student['email'] ?></a></h6>
                    <h6><?= $student['mentor_name'] ?></h6>
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
    <div class="text-center">
        <h2>Previous Activity and Roles</h2>
        <br>
        <h4 class="text-secondary"><b>Activity Level</b></h4>
        <br>
    </div>
    <?php if ($activity_roles) : ?>
    <table id="acttable" class="table">
        <thead>
            <tr class="table-primary">
                <th>Year</th>
                <th>Activity</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activity_roles as $actrole) : ?>
            <?php $desc = (isset($actrole['description'])) ? sprintf(' (%s)', $actrole['description']) : '' ?>
            <tr class="table-light">
                <td><?= $actrole['acadyear'] . ' Semester ' . $actrole['semester'] ?></td>
                <td><?= $actrole['activity_name'] ?></td>
                <td><?= $actrole['role'] . $desc ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php else : ?>
    <p>No data of roles in activity found</p>
    <?php endif ?>

    <hr>
    <h4 class="text-secondary text-center"><b>Organization Level</b></h4>
    <br>
    <?php if ($org_roles) : ?>
    <table id="orgtable" class="table">
        <thead>
            <tr class="table-primary">
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
    <?php else : ?>
    <p>No data of roles in SIG found</p>
    <?php endif ?>
</div>

<script>
$(document).ready(function() {
    $('#acttable').DataTable();
    $('#orgtable').DataTable();
});
</script>