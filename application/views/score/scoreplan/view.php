<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('scoreplan') ?>">Score Plan</a></li>
    <li class="breadcrumb-item active"><?= $acadsession['academicsession'] ?></li>
</ol>
<h2>Score Plan: <?= $acadsession['academicsession'] ?></h2>
<br>
<div class="dropdown">
    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        New Scoreplan
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <?php foreach ($activitycategories as $category) : ?>
        <button class="dropdown-item" data-toggle="modal" data-target="#addscoreplan<?= $category['code'] ?>" href="#"><?= $category['category'] ?></button>
        <?php endforeach ?>
    </div>
</div>
<br>
<p>Cannot see any available activity? Create a new one <a href="<?= site_url('activity') ?>">here</a><br><small>You can only add a new score plan from activities created on the same academic
        session.</small></p>

<table class="table">
    <thead>
        <tr class="table-primary">
            <th>Label</th>
            <th>Activity/Workshop Title</th>
            <th>Percent Weightage</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $totalpercent = 0; ?>
        <?php foreach ($scoreplans as $plan) :
            $totalpercent += $plan['percentweightage'] ?>
        <tr class="table-light">
            <td><?= $plan['label'] ?></td>
            <td><?= $plan['title'] ?></td>
            <td><?= $plan['percentweightage'] ?> %</td>
            <td><a type="button" data-toggle="modal" data-target="#editscoreplan<?= $plan['id'] ?>" class="btn btn-outline-primary btn-sm">Edit</a></td>
        </tr>
        <?php endforeach ?>
        <tr class="table-light">
            <td>C</td>
            <td>Components (default)</td>
            <td>15%</td>
            <td></td>
        </tr>
    </tbody>
    <tfoot>
        <tr class="table-light">
            <th>Total</th>
            <td></td>
            <th><?= $totalpercent + 15 ?> %</th>
            <th></th>
        </tr>
    </tfoot>
</table>

<?php $index = 0;
foreach ($scoreplans as $plan) : $index++; ?>
<div id="editscoreplan<?= $plan['id'] ?>" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Score Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $hidden = array(
                    'scoreplan_id' => $plan['id'],
                    'acslug' => $acslug
                ) ?>
            <?= form_open('score/updatescoreplan', '', $hidden) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="label">Scoreplan Label</label>
                    <input name="label" type="text" class="form-control" value="<?= $plan['label'] ?>">
                </div>
                <div class="form-group">
                    <label for="activity_id">Activity</label>
                    <select name="activity_id" class="form-control">
                        <option value="<?= $plan['activity_id'] ?>"><?= $plan['title'] ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="percentweightage">Percentage Weightage</label>
                    <input name="percentweightage" type="text" class="form-control" value="<?= $plan['percentweightage'] ?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?php endforeach ?>

<?php foreach ($activitycategories as $category) : ?>
<div id="addscoreplan<?= $category['code'] ?>" class="modal fade">
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
                    'activitycategory_id' => $category['code'],
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
                <button type="submit" class="btn btn-primary" <?= $disabledbutton ?>>Add</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?php endforeach ?>