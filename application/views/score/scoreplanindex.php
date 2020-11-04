<h2><?= $title ?></h2>
<br>
<div class="">
    <div class="form-group">
        <button data-toggle="modal" data-target="#addscoreplan" class="btn btn-outline-danger" disabled>Add new scoring plan</button>
    </div>

    <table id="scoreplanindex" class="table">
        <thead class="table-dark">
            <tr>
                <td>Academic Session</td>
                <td>Academic Year</td>
                <?php foreach ($activitycategory as $actcat) : ?>
                    <td data-toggle="tooltip" data-placement="top" title="" data-original-title="<?= $actcat['category'] ?> Count"><?= $actcat['category'] ?> (<?= $actcat['code'] ?>)</td>
                    <td>Total Percent (<?= $actcat['code'] ?>)</td>
                <?php endforeach ?>
                <td>Total Percent</td>
            </tr>
        </thead>
        <tbody>
            <!-- <?php foreach ($all_scoreplan as $asp) : ?>
                <tr>
                    <td><a href="<?= site_url('scoreplan/' . $asp['slug']) ?>"><?= $asp['academicsession'] ?></a></td>
                    <td><?= $asp['academicyear'] ?></td>
                    <?php foreach ($asp['category'] as $cat) : ?>
                        <td><?= $cat['count'] ?></td>
                        <td>?</td>
                    <?php endforeach ?>
                    <td>?</td>
                </tr>
            <?php endforeach ?> -->
            <?php foreach ($summarytable as $row) : ?>
                <tr>
                    <td><a href="<?= site_url('scoreplan/' . $row['slug']) ?>"><?= $row['academicsession'] ?></a></td>
                    <td><?= $row['academicyear'] ?></td>
                    <?php foreach ($row['categories'] as $category) : ?>
                        <td><?= $category['count'] ?></td>
                        <td><?= $category['categorytotalpercent'] ?> %</td>
                    <?php endforeach ?>
                    <td><?= $row['totalpercent'] ?> %</td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot class="table-dark">
            <tr>
                <td>Academic Session</td>
                <td>Academic Year</td>
                <?php foreach ($activitycategory as $actcat) : ?>
                    <td data-toggle="tooltip" data-placement="top" title="" data-original-title="<?= $actcat['category'] ?> Count"><?= $actcat['category'] ?> (<?= $actcat['code'] ?>)</td>
                    <td>Total Percent (<?= $actcat['code'] ?>)</td>
                <?php endforeach ?>
                <td>Total Percent</td>
            </tr>
        </tfoot>
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
                        <option readonly value="<?= $activeacadsession['id'] ?>"><?= $activeacadsession['activeacademicsession'] ?></option>
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
                                <input name="count<?= $actcat['code'] ?>" value="<?= $actcat['count'] ?>" type="text" class="form-control" readonly>
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
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>