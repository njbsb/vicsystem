<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Score</li>
</ol>

<h2 class="margin text-white"><?= $title ?></h2>
<div class="card">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover" id="scoretable">
                <thead class="table-dark">
                    <tr>
                        <th>Academic Year</th>
                        <th>Academic Session</th>
                        <th>Students Enrolling</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-active">
                    <?php if ($academicsessions) : ?>
                        <?php foreach ($academicsessions as $acs) : ?>
                            <tr>
                                <td><?= $acs['academicyear'] ?></td>
                                <td><?= $acs['academicsession'] ?></td>
                                <td><?= $acs['enrolling'] ?></td>
                                <td><a class="btn btn-sm btn-dark" href="<?= site_url('score/' . $acs['slug']) ?>"><i class='fas fa-search'></i></a></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td>No data</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
        <small>*Click view on any academic session below to view students' score in each session</small>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#scoretable').DataTable({
            "order": []
        });
    });
</script>