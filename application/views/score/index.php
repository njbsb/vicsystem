<h2 class="margin text-primary"><?= $title ?></h2>
<small>*Click view on any academic session below to view students' score in each session</small>
<!-- <hr> -->
<table class="table" id="scoretable">
    <thead class="table-dark">
        <tr>
            <th>Academic Year</th>
            <th>Academic Session</th>
            <th>Students Enrolling</th>
            <th>Students Marked</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($academicsessions) : ?>
        <?php foreach ($academicsessions as $acs) : ?>
        <tr>
            <td><?= $acs['academicyear'] ?></td>
            <td><?= $acs['academicsession'] ?></td>
            <td><?= $acs['enrolling'] ?></td>
            <td>0</td>
            <td><a class="badge badge-pill badge-dark" href="<?= site_url('score/' . $acs['slug']) ?>">view</a></td>
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