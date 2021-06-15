<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('scoreplan') ?>">Score Plan</a></li>
    <li class="breadcrumb-item active"><?= $acadsession['academicsession'] ?></li>
</ol>
<h2>Score Plan: <?= $acadsession['academicsession'] ?></h2>
<br>
<div class="card">
    <div class="card-body">
        <?php if ($sessionactive) : ?>
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                New Score Plan
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php foreach ($activitycategories as $category) : ?>
                <button class="dropdown-item" data-toggle="modal" data-target="#addscoreplan<?= $category['code'] ?>" href="#"><?= $category['category'] ?></button>
                <?php endforeach ?>
            </div>
        </div>
        <br>
        Cannot see any available activity? Create a new one <a href="<?= site_url('activity') ?>">here</a>
        <div style="line-height:100%;">
            <small>You can only add a new score plan from activities created on the same academic session.</small>
        </div>
        <br>
        <?php else : ?>
        <p>You can only update score plan of the current academic session.</p>
        <?php endif ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Label</th>
                        <th>Activity/Workshop Title</th>
                        <th>Percent Weightage</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-active">
                    <?php $totalpercent = 0; ?>
                    <?php foreach ($scoreplans as $plan) :
                        $totalpercent += $plan['percentweightage'] ?>
                    <tr>
                        <td><?= $plan['label'] ?></td>
                        <td><?= $plan['title'] ?></td>
                        <td><?= $plan['percentweightage'] ?> %</td>
                        <td>
                            <?php if ($sessionactive) : ?>
                            <a type="button" data-label="<?= $plan['label'] ?>" data-activityid="<?= $plan['activity_id'] ?>" data-id="<?= $plan['id'] ?>" data-title="<?= $plan['title'] ?>"
                                data-weightage="<?= $plan['percentweightage'] ?>" data-toggle="modal" data-target="#editscoreplan" class="btn btn-dark btn-sm"><i class='fas fa-pen'></i> </a>
                            <a type="button" data-id="<?= $plan['id'] ?>" data-title="<?= $plan['title'] ?>" data-label="<?= $plan['label'] ?>" data-toggle="modal" data-target="#deletescoreplan"
                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                            <?php else : ?>
                            <?php endif ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                    <tr>
                        <td>C</td>
                        <td>Components (default)</td>
                        <td>15 %</td>
                        <td></td>
                    </tr>
                </tbody>
                <tfoot class="table-active">
                    <tr>
                        <th>Total</th>
                        <td></td>
                        <th><?= $totalpercent + 15 ?> %</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div id="editscoreplan" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Score Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $hidden = array(
                'scoreplan_id' => '',
                'activity_id' => '',
                'acslug' => $acslug
            ) ?>
            <?= form_open('score/updatescoreplan', '', $hidden) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="label">Label</label>
                    <input name="label" type="text" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="activitytitle">Activity</label>
                    <input name="activitytitle" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="percentweightage">Percentage Weightage</label>
                    <input name="percentweightage" type="text" class="form-control" value="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark">Update</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<?php foreach ($activitycategories as $category) : ?>
<div id="addscoreplan<?= $category['code'] ?>" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Score Plan (<?= $category['code'] ?>)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $hidden = array(
                    'acadsession_id' => $acadsession['id'],
                    'acslug' => $acadsession['slug']
                ); ?>
            <?= form_open('score/addscoreplan', '', $hidden) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Academic Session</label>
                    <input name="" type="text" value="<?= $acadsession['academicsession'] ?>" class="form-control" readonly>
                </div>
                <!-- ACTIVITY -->
                <div class="form-group">
                    <label for="activity_id">Activity</label>
                    <select name="activity_id" class="form-control" required>
                        <?php if ($category['unregistered']) : ?>
                        <?php foreach ($category['unregistered'] as $notact) : ?>
                        <option value="<?= $notact['id'] ?>"><?= $notact['title'] ?></option>
                        <?php endforeach ?>
                        <?php else : ?>
                        <option value="" readonly>No activity available to be added</option>
                        <?php endif ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="label">Label</label>
                    <input name="label" type="text" class="form-control" placeholder="<?= $category['code'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="percentweightage">Weightage</label>
                    <input type="number" name="percentweightage" min="0" max="30" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <!-- BUTTON -->
                <?php $disabledbutton = ($category['unregistered']) ? '' : 'disabled' ?>
                <button type="submit" class="btn btn-dark" <?= $disabledbutton ?>>Add</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?php endforeach ?>

<div id="deletescoreplan" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Score Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $hidden = array(
                'scoreplan_id' => $plan['id'],
                'acslug' => $acslug
            ) ?>
            <?= form_open('score/deletescoreplan', '', $hidden) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label id="labeltitle" for="label">Score Plan: </label><br>
                    <label id="activitytitle">Activity: </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
$('#editscoreplan').on('show.bs.modal', function(e) {
    var scoreplanid = $(e.relatedTarget).data('id');
    var activityid = $(e.relatedTarget).data('activityid');
    var activitytitle = $(e.relatedTarget).data('title');
    var label = $(e.relatedTarget).data('label');
    var weightage = $(e.relatedTarget).data('weightage');
    $(e.currentTarget).find('input[name="scoreplan_id"]').val(scoreplanid);
    $(e.currentTarget).find('input[name="activityid"]').val(activityid);
    $(e.currentTarget).find('input[name="activitytitle"]').val(activitytitle);
    $(e.currentTarget).find('input[name="label"]').val(label);
    $(e.currentTarget).find('input[name="percentweightage"]').val(weightage);
});
$('#editscoreplan').on('hide.bs.modal', function(e) {
    var scoreplanid = $(e.relatedTarget).data('id');
    var activitytitle = $(e.relatedTarget).data('title');
    var label = $(e.relatedTarget).data('label');
    var weightage = $(e.relatedTarget).data('weightage');
    $(e.currentTarget).find('input[name="scoreplan_id"]').val('');
    $(e.currentTarget).find('input[name="activitytitle"]').val('');
    $(e.currentTarget).find('input[name="label"]').val('');
    $(e.currentTarget).find('input[name="percentweightage"]').val('');
});

$('#deletescoreplan').on('show.bs.modal', function(e) {
    var scoreplanid = $(e.relatedTarget).data('id');
    var activitytitle = $(e.relatedTarget).data('title');
    var label = $(e.relatedTarget).data('label');
    var labeltitle = document.getElementById("labeltitle");
    var labelactivitytitle = document.getElementById("activitytitle");
    $(e.currentTarget).find('input[name="scoreplan_id"]').val(scoreplanid);
    labeltitle.innerHTML += label;
    labelactivitytitle.innerHTML += activitytitle;
});
$('#deletescoreplan').on('hide.bs.modal', function(e) {
    var labeltitle = document.getElementById("labeltitle");
    var labelactivitytitle = document.getElementById("activitytitle");
    labeltitle.innerHTML = 'Score Plan: ';
    labelactivitytitle.innerHTML = 'Activity: ';
});
</script>