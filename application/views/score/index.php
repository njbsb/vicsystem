<h2 class=""><?= $title ?></h2>

<table id="scoretable" class="table table-hover" style="text-align:left;">
    <thead class="table-dark">
        <tr>
            <th scope="col" class="Matric">Matric</th>
            <!-- <th scope="col" class="sort" data-sort="Matric">Matric</th> -->
            <th scope="col" class="sort" data-sort="Citra">Citra taken</th>
            <th scope="col" class="sort" data-sort="AcadYear">Academic Year</th>
            <th scope="col" class="sort" data-sort="Semester">Semester</th>
            <th scope="col" class="sort" data-sort="Status">Status</th>
            <th scope="">Details</th>
        </tr>
    </thead>
    <tbody class="list">
        <?php foreach ($citra_registered as $citreg) : ?>
            <tr>
                <td class="Matric"><?= $citreg['student_matric'] ?></td>
                <td class="Citra"><?= $citreg['citra_code'] ?></td>
                <td class="AcadYear"><?= $citreg['acadyear'] ?></td>
                <td class="Semester"><?= $citreg['semester_id'] ?></td>
                <td class="Status">
                    <?php // check if  
                    ?>
                </td>
                <td><a class="badge badge-primary" href="<?= site_url('/score/' . $citreg['student_matric']) ?>">Edit score</a></td>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {
        $('#scoretable').DataTable();
    });
</script>