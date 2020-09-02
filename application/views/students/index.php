<h2><?= $title ?></h2>


<table class="table table-hover">
    <thead>
        <tr class="table-primary">
            <th scope="col">Matric</th>
            <th scope="col">Name</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($students as $student): ?>
        <tr>
            <th scope="row"><?= $student['matric'] ?></th>
            <td><?= $student['name'] ?></td>
            <td><?= $student['phonenum'] ?></td>
            <td><?= $student['email'] ?></td>
        </tr>
        <?php endforeach ?>

    </tbody>
</table>