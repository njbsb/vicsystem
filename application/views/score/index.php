<h2 class=" "><?= $title ?></h2>

<table id="scoretable" class="table table-hover" style="text-align:left;">
    <thead class="table-dark">
        <tr>
            <th scope="col" class="Matric">Matric</th>
            <th scope="col" class="sort" data-sort="AcadYear">Academic Session</th>
            <th>Total Score (55%)</th>
            <th scope="col" class="sort" data-sort="Status">Status</th>
            <th scope="">Details</th>
        </tr>
    </thead>
    <tbody class="list">
        <?php foreach ($student_score as $stdscore) : ?>
            <tr>
                <td class="Matric"><?= $stdscore['student_matric'] ?></td>
                <td class="AcadYear"><?= $stdscore['academicsession'] ?></td>
                <td><?= $stdscore['totalpercent'] ?></td>
                <td class="Status">Marked/Not</td>
                <td><a class="badge badge-primary" href="<?= site_url('/score/' . $stdscore['student_matric']) . '/' . $stdscore['acslug'] ?>">Edit score</a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <th scope="col" class="Matric">Matric</th>
        <!-- <th scope="col" class="sort" data-sort="Citra">ACS ID</th> -->
        <th scope="col" class="sort" data-sort="AcadYear">Academic Session</th>
        <th>Total Score (55%)</th>
        <th scope="col" class="sort" data-sort="Status">Status</th>
        <th scope="">Details</th>
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