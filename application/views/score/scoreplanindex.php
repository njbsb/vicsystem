<h2><?= $title ?></h2>
<br>
<div class="">
    <div class="form-group">
        <button data-toggle="modal" data-target="#addscoreplan" class="btn btn-outline-danger" disabled>Add new scoring plan</button>
    </div>

    <table class="table">
        <thead class="table-dark">
            <tr>
                <td>Academic Session</td>
                <?php foreach ($activitycategory as $actcat) : ?>
                    <td><?= $actcat['category'] ?> (<?= $actcat['code'] ?>) Count</td>
                <?php endforeach ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($all_scoreplan as $asp) : ?>
                <tr>
                    <td><a href="<?= site_url('scoreplan/' . $asp['slug']) ?>"><?= $asp['academicsession'] ?></a></td>
                    <?php foreach ($asp['category'] as $cat) : ?>
                        <td><?= $cat['count'] ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </tbody>
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