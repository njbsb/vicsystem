<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Score Plan</li>
</ol>
<h2><?= $title ?></h2>
<div class="card">
    <div class="card-body">
        <div class="">
            <br>
            <div class="table-responsive">
                <table id="scoreplanindex" class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Session</th>
                            <!-- <th>Year</th> -->
                            <?php foreach ($activitycategory as $actcat) : ?>
                            <!-- <th data-toggle="tooltip" data-placement="top" title="" data-original-title="<?= $actcat['category'] ?> Count"><?= $actcat['category'] ?></th> -->
                            <th data-toggle="tooltip" data-placement="top" title="Percent (Count)"><?= $actcat['category'] ?> %</th>
                            <?php endforeach ?>
                            <th>Component Default</th>
                            <th data-toggle="tooltip" data-placement="top" title="55% Max">Total %</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-light">
                        <?php foreach ($academicsessions as $acs) : ?>
                        <tr>
                            <td><?= $acs['academicsession'] ?></td>
                            <?php foreach ($acs['activitycategories'] as $cat) : ?>
                            <td><?= sprintf('%s%% (%s)', $cat['categorytotalpercent'], $cat['categorycount']) ?></td>
                            <?php endforeach ?>
                            <?php $textclass = ($acs['total'] == 40) ? 'text-success' : 'text-danger' ?>
                            <td>15%</td>
                            <td class="<?= $textclass ?>"><?= $acs['total'] + 15 ?>%</td>
                            <td><a href="<?= site_url('scoreplan/' . $acs['slug']) ?>" class="btn btn-sm btn-outline-primary"><i class='fas fa-pen'></i></a></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

        </div>
        <small>Please make sure total score plans mark percentages add up to 55</small><br>
        <small>*Note: new scoreplan template will only show when you register new academic session</small>
    </div>
</div>
<!-- MODAL -->
<div id="addscoreplan" class="modal fade card">
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
    $('#scoreplanindex').DataTable({
        "order": []
    });
    $('[data-toggle="tooltip"]').tooltip();
});
</script>