<h2><?= $title ?></h2>


<table class="table table-hover" style="text-align:center;">
    <thead>
        <tr class="table-primary">
            <th scope="col"></th>
            <th scope="col">Matric</th>
            <th scope="col">Full Name</th>
            <!-- <th scope="col">Phone</th> -->
            <th scope="col">Email</th>
            <th scope="col">Program</th>
            <th scope="col">Mentor</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($students as $student): ?>
        <tr>
            <td>
                <img style="max-height:100px; max-width:100px; "
                    src="<?php echo site_url() ?>assets/images/profile/<?php echo $student['photo_path']; ?>"
                    class="img-responsive" alt="<?php echo $student['photo_path']; ?>">
            </td>
            <th scope="row"><?= $student['matric'] ?></th>
            <td><a href="<?php echo site_url('/student/'.$student['matric']); ?>"><?= $student['name'] ?></a></td>
            <!-- <td><?= $student['phonenum'] ?></td> -->
            <td><?= $student['email'] ?></td>
            <td><?= $student['program_name'] ?></td>
            <td><?= $student['mentor_name'] ?></td>
            <td><a class="btn btn-secondary btn-sm"
                    href="<?php echo site_url('/student/'.$student['matric']); ?>">Details</a>
            </td>
        </tr>
        <?php endforeach ?>

    </tbody>
</table>