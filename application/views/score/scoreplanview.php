<h2><?= $title ?></h2>

<ul class="nav nav-tabs">
    <?php foreach ($activitycategory as $actcat) : ?>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#<?= $actcat['code'] ?>"><?= $actcat['category'] . ' (' . $actcat['code'] . ')' ?></a>
        </li>
    <?php endforeach ?>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#c">Components (C)</a>
    </li>


</ul>
<div id="myTabContent" class="tab-content">
    <?php foreach ($activitycategory as $actcat) : ?>
        <div class="tab-pane fade show" id="<?= $actcat['code'] ?>">
            <br>
            <div class="form-group">
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#addscoreplan<?= $actcat['code'] ?>">Add Score Plan</button>
            </div>

            <table class="table ">
                <thead class="table-dark">
                    <tr>
                        <td>Label</td>
                        <td>Activity</td>
                        <td>Weightage</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($actcat['scoreplan']) : ?>
                        <?php foreach ($actcat['scoreplan'] as $scp) : ?>
                            <tr>
                                <td><?= $scp['label'] ?></td>
                                <td><?= $scp['activity_name'] ?></td>
                                <td><?= $scp['weightage'] ?></td>
                                <td><a type="button" data-toggle="modal" data-target="#editscoreplan<?= $actcat['id'] ?>" class="badge badge-dark">edit score plan</a></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td>No data</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>

            <p></p>
        </div>

        <!-- ADD SCORE PLAN -->
        <div id="addscoreplan<?= $actcat['code'] ?>" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Score Plan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?= form_open('score/addscoreplan') ?>
                    <div class="modal-body">
                        <!-- ACADEMIC SESSION -->
                        <div class="form-group">
                            <label for="acadsession_id">Academic Session</label>
                            <input name="" type="text" value="<?= $acadsession['academicsession'] ?>" class="form-control" readonly>
                            <input type="hidden" name="acadsession_id" value="<?= $acadsession['id'] ?>">
                        </div>
                        <!-- ACTIVITY CATEGORY -->
                        <div class="form-group">
                            <label for="activitycategory_id">Activity Category</label>
                            <input name="" type="text" value="<?= $actcat['categorycode'] ?>" class="form-control" readonly>
                            <input type="hidden" name="activitycategory_id" value="<?= $actcat['id'] ?>">
                        </div>
                        <!-- ACTIVITY -->
                        <div class="form-group">
                            <label for="activity_id">Activity</label>
                            <select name="activity_id" class="form-control" required>
                                <?php if ($actcat['notactivities']) : ?>
                                    <?php foreach ($actcat['notactivities'] as $notact) : ?>
                                        <option value="<?= $notact['id'] ?>"><?= $notact['activity_name'] ?></option>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <option value="" readonly>No activity available to be added</option>
                                <?php endif ?>
                            </select>
                        </div>
                        <!-- LABEL -->
                        <div class="form-group">
                            <label for="label">Label</label>
                            <input type="text" class="form-control" placeholder="<?= $actcat['code'] ?>" required>
                        </div>
                        <!-- WEIGHTAGE -->
                        <div class="form-group">
                            <label for="weightage">Weightage</label>
                            <input type="number" name="weightage" min="0" max="30" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- BUTTON -->
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>

        <!-- EDIT SCORE PLAN -->
        <?php $no = 0;
        foreach ($actcat['scoreplan'] as $scp) : $no++; ?>
            <div id="editscoreplan<?= $scp['id'] ?>" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Score Plan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?= form_open('score/updatescoreplan/' . $scp['id']) ?>
                        <div class="modal-body">
                            <input name="acslug" type="hidden" value="<?= $acslug ?>">
                            <div class="form-group">
                                <label for="label">Scoreplan Label</label>
                                <input name="label" type="text" class="form-control" value="<?= $scp['label'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="activity_id">Activity</label>
                                <select name="activity_id" class="form-control">
                                    <option value="<?= $scp['activity_id'] ?>"><?= $scp['activity_name'] ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="weightage">Weightage</label>
                                <input name="weightage" type="text" class="form-control" value="<?= $scp['weightage'] ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    <?php endforeach ?>
    <!-- COMPONENTS -->
    <div class="tab-pane fade show" id="c">
        <br>
        <p>C</p>
    </div>
</div>