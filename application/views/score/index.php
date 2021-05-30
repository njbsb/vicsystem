<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Score</li>
</ol>

<h2 class="margin text-primary"><?= $title ?></h2>
<div class="card">
    <div class="card-body">
        <small>*Click view on any academic session below to view students' score in each session</small>
        <!-- <hr> -->
        <div class="table-responsive">
            <table class="table table-hover" id="scoretable">
                <thead class="table-primary">
                    <tr>
                        <th>Academic Year</th>
                        <th>Academic Session</th>
                        <th>Students Enrolling</th>
                        <th>Students Marked</th>
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
                        <td>0</td>
                        <td><a class="btn btn-sm btn-primary" href="<?= site_url('score/' . $acs['slug']) ?>"><i class='fas fa-search'></i></a></td>
                    </tr>
                    <?php endforeach ?>
                    <?php else : ?>
                    <tr>
                        <td>No data</td>
                    </tr>
                    <?php endif ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Academic Year</td>
                        <td>Academic Session</td>
                        <td>Students Enrolling</td>
                        <td>Students Marked</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#scoretable').DataTable({
        initComplete: function() {
            this.api().columns().every(function() {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });
                column.data().unique().sort().each(function(d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        }
    });
});
</script>