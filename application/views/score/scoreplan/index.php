<h2><?= $title ?></h2>
<br>
<div class="">
    <!-- <div class="form-group">
        <button data-toggle="modal" data-target="#addscoreplan" class="btn btn-outline-danger" disabled>Add new scoring plan</button>
    </div> -->
    <h6>Please make sure total score plans mark percentages add up to 55%</h6>
    <table id="scoreplanindex" class="table">
        <thead class="table-dark">
            <tr>
                <th>Session</th>
                <!-- <th>Year</th> -->
                <?php foreach ($activitycategory as $actcat) : ?>
                <th data-toggle="tooltip" data-placement="top" title="" data-original-title="<?= $actcat['category'] ?> Count"><?= $actcat['category'] ?></th>
                <th data-toggle="tooltip" data-placement="top" title="Cumulative Percent"><?= $actcat['category'] ?> %</th>
                <?php endforeach ?>
                <th data-toggle="tooltip" data-placement="top" title="55% Max">Total %</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($academicsessions as $acs) : ?>
            <tr>
                <td><?= $acs['academicsession'] ?></td>
                <!-- <td><?= $acs['academicyear'] ?></td> -->
                <?php foreach ($acs['activitycategories'] as $cat) : ?>
                <td><?= $cat['categorycount'] ?></td>
                <td><?= $cat['categorytotalpercent'] ?>%</td>
                <?php endforeach ?>
                <?php $textclass = ($acs['total'] == 55) ? 'text-success' : 'text-danger' ?>
                <td class="<?= $textclass ?>"><?= $acs['total'] ?>%</td>
                <td><a href="<?= site_url('scoreplan/' . $acs['slug']) ?>" class="badge badge-pill badge-dark">view</a></td>
            </tr>
            <?php endforeach ?>
        </tbody>
        <!-- <tfoot class="table-dark">
            <tr>
                <td>Session</td>
                <td>Year</td>
                <?php foreach ($activitycategory as $actcat) : ?>
                    <td data-toggle="tooltip" data-placement="top" title="" data-original-title="<?= $actcat['category'] ?> Count"><?= $actcat['category'] ?></td>
                    <td>Total % (<?= $actcat['code'] ?>)</td>
                <?php endforeach ?>
                <td>Total %</td>
                <td></td>
            </tr>
        </tfoot> -->
    </table>

</div>
<!-- MODAL -->
<div id="addscoreplan" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('score/addscoreplan') ?>
            <div class="modal-header">
                <h5 class="modal-title">New scoring plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="acadsession_id">Current academic session</label>
                    <select name="acadsession_id" id="" class="form-control">
                        <option readonly value="<?= $activeacadsession['id'] ?>"><?= $activeacadsession['academicsession'] ?></option>
                    </select>
                </div>
                <div class="row">
                    <?php foreach ($activitycategory as $actcat) : ?>
                    <div class="col-sm-6">
                        <label for="a">No of <?= $actcat['category'] ?></label>
                    </div>
                    <?php endforeach ?>
                </div>
                <div class="row">
                    <?php foreach ($activitycategory as $actcat) : ?>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input name="count<?= $actcat['code'] ?>" value="<?= $actcat['categorycount'] ?>" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
                <p><small>Please confirm the numbers before adding the scoreplan!</small></p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#scoreplanindex').DataTable();
    // $('#scoreplanindex').DataTable({
    //     initComplete: function() {
    //         this.api().columns().every(function() {
    //             var column = this;
    //             var select = $('<select><option value=""></option></select>')
    //                 .appendTo($(column.footer()).empty())
    //                 .on('change', function() {
    //                     var val = $.fn.dataTable.util.escapeRegex(
    //                         $(this).val()
    //                     );
    //                     column
    //                         .search(val ? '^' + val + '$' : '', true, false)
    //                         .draw();
    //                 });
    //             column.data().unique().sort().each(function(d, j) {
    //                 select.append('<option value="' + d + '">' + d + '</option>')
    //             });
    //         });
    //     }
    // });
    $('[data-toggle="tooltip"]').tooltip();
});
</script>