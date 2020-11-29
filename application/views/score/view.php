<h2 class="margin"><?= $title ?></h2>
<!-- <hr> -->
<table class="table text-center">
    <thead class="table-primary">
        <tr>
            <td>Academic Session</td>
            <?php foreach ($scoreplans as $scoreplan) : ?>
                <td class="text-warning" data-toggle="tooltip" data-placement="top" title="<?= $scoreplan['percentweightage'] ?>%">Level <?= ucfirst($scoreplan['label']) ?></td>
            <?php endforeach ?>
            <td class="text-info" data-toggle="tooltip" data-placement="top" title="15%">Components</td>
            <td data-toggle="tooltip" data-placement="top" title="55%">Total</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $academicsession['academicsession'] ?></td>
            <?php foreach ($scoreplans as $scoreplan) : ?>
                <td><?= $scoreplan['totalpercent'] ?> %</td>
            <?php endforeach ?>
            <td><?= $scorecomps['totalpercent'] ?> %</td>
            <td><?= $totalwhole ?> %</td>
        </tr>
    </tbody>
</table>
<hr>
<ul class="nav nav-tabs">
    <?php foreach ($scoreplans as $scoreplan) : ?>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#<?= $scoreplan['label'] ?>">Level <?= $scoreplan['label'] ?></a>
        </li>
    <?php endforeach ?>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#comp">Components</a>
    </li>
</ul>
<div id="myTabContent" class="tab-content">
    <?php foreach ($scoreplans as $scoreplan) : ?>
        <div class="tab-pane fade show" id="<?= $scoreplan['label'] ?>">
            <br>
            <div class="form-group">
                <label for="activity">Activity/Workshop</label>
                <input name="activity" value="<?= $scoreplan['activity_name'] ?>" readonly type="text" class="form-control">
            </div>
            <div class="row">
                <?php if ($scoreplan['scores']) : ?>
                    <?php foreach ($scoreplan['scores'] as $key => $score) : ?>
                        <div class="col-6">
                            <label><?= ucfirst($key) ?></label>
                            <div class="form-group">
                                <select name="<?= $key ?>" class="custom-select" readonly>
                                    <option value="" disabled hidden selected>Select <?= $key ?> score</option>
                                    <?php foreach ($guide[$key] as $scoreguide) : ?>
                                        <?php $selected = ($scoreguide['score'] == $score) ? 'selected' : '' ?>
                                        <option disabled value="<?= $scoreguide['score'] ?>" <?= $selected ?>><?= $scoreguide['concat'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    <?php endforeach ?>
                    <div class="col">
                        <button data-toggle="modal" data-target="#edit<?= $scoreplan['label'] ?>" class="btn btn-outline-primary">Edit Score</button>
                    </div>
                <?php else : ?>
                    <div class="col">
                        <p>You have not added score for <?= $student['name'] ?> on this level</p>
                        <button data-toggle="modal" data-target="#add<?= $scoreplan['label'] ?>" class="btn btn-outline-primary">Add Score</button>
                    </div>
                <?php endif ?>

            </div>
        </div>
        <!-- ADD -->
        <div id="add<?= $scoreplan['label'] ?>" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Score: Level <?= $scoreplan['label'] ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php $hidden = array(
                        'acslug' => $academicsession['slug'],
                        'scoreplan_id' => $scoreplan['id'],
                        'student_id' => $student_id
                    );
                    ?>
                    <?= form_open('score/add_scorelevel', '', $hidden) ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="activity">Activity</label>
                            <input name='activity' type="text" class="form-control" value="<?= $scoreplan['activity_name'] ?>" readonly>
                        </div>

                        <?php foreach ($levelrubrics as $key => $value) : ?>
                            <div class="form-group">
                                <label><?= ucfirst($key) ?></label>
                                <select name="keys[<?= $key ?>]" id="<?= $key ?>" class="custom-select" required>
                                    <option value="" disabled selected>Select <?= $key ?> score</option>
                                    <?php foreach ($guide[$key] as $scoreguide) : ?>
                                        <option value="<?= $scoreguide['score'] ?>"><?= $scoreguide['concat'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit Score</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
        <!-- EDIT -->
        <div id="edit<?= $scoreplan['label'] ?>" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Score: Level <?= $scoreplan['label'] ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php $hidden = array(
                        'acslug' => $academicsession['slug'],
                        'scoreplan_id' => $scoreplan['id'],
                        'student_id' => $student_id
                    );
                    ?>
                    <?= form_open('score/edit_scorelevel', '', $hidden) ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="activity">Activity</label>
                            <input type="text" class="form-control" value="<?= $scoreplan['activity_name'] ?>" readonly>
                        </div>
                        <?php foreach ($scoreplan['scores'] as $key => $value) : ?>
                            <div class="form-group">
                                <label><?= ucfirst($key) ?></label>
                                <select name="keys[<?= $key ?>]" id="<?= $key ?>" class="custom-select" required>
                                    <option value="" disabled selected>Select <?= $key ?> score</option>
                                    <?php foreach ($guide[$key] as $scoreguide) : ?>
                                        <?php $selected = ($scoreguide['score'] == $value) ? 'selected' : '' ?>
                                        <option value="<?= $scoreguide['score'] ?>" <?php echo $selected ?>><?= $scoreguide['concat'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        <?php endforeach ?>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit Score</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>

    <div class="tab-pane fade" id="comp">
        <br>
        <div class="row">
            <?php if ($scorecomps['scores']) : ?>
                <?php foreach ($scorecomps['scores'] as $key => $value) : ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?= ucfirst($key) ?></label>
                            <?php if ($key == 'volunteer') : ?>
                                <input name="<?= $key ?>" value="<?= $value ?>" type="number" max="15" class="form-control" readonly>
                            <?php else : ?>
                                <select name="<?= $key ?>" class="custom-select">
                                    <?php foreach ($guide[$key] as $scoreguide) : ?>
                                        <?php $selected = ($scoreguide['score'] == $value) ? 'selected' : ''; ?>
                                        <option disabled value="<?= $scoreguide['score'] ?>" <?= $selected ?>><?= $scoreguide['concat'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endforeach ?>
                <div class="col">
                    <button data-toggle="modal" data-target="#editcomp" class="btn btn-outline-primary">Edit Score</button>
                </div>
            <?php else : ?>
                <div class="col">
                    <p>You have not added components score for <?= $student['name'] ?></p>
                    <button data-toggle="modal" data-target="#addcomp" class="btn btn-outline-primary">Add Score</button>
                </div>
            <?php endif ?>

            <div id="addcomp" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Component Score</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php $hidden = array(
                            'student_id' => $student_id,
                            'acadsession_id' => $academicsession['id'],
                            'acslug' => $academicsession['slug']
                        ); ?>
                        <?= form_open('score/add_scorecomp', '', $hidden) ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Digital CV</label>
                                <select name="digitalcv" class="custom-select" required>
                                    <option value="" selected disabled>Select digital CV score</option>
                                    <?php foreach ($guide['digitalcv'] as $scoreguide) : ?>
                                        <?php $selected = ($scoreguide['score'] == $component) ? 'selected' : ''; ?>
                                        <option value="<?= $scoreguide['score'] ?>" <?= $selected ?>><?= $scoreguide['concat'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Leadership</label>
                                <select name="leadership" class="custom-select" required>
                                    <option value="" selected disabled>Select digital CV score</option>
                                    <?php foreach ($guide['leadership'] as $scoreguide) : ?>
                                        <?php $selected = ($scoreguide['score'] == $component) ? 'selected' : ''; ?>
                                        <option value="<?= $scoreguide['score'] ?>" <?= $selected ?>><?= $scoreguide['concat'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Volunteer</label>
                                <input name="volunteer" type="number" min="0" max="5" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit data</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>

            <div id="editcomp" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Component Score</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php $hidden = array(
                            'student_id' => $student_id,
                            'acadsession_id' => $academicsession['id'],
                            'acslug' => $academicsession['slug']
                        ); ?>
                        <?= form_open('score/edit_scorecomp', '', $hidden) ?>
                        <div class="modal-body">
                            <?php foreach ($scorecomps['scores'] as $key => $component) : ?>
                                <div class="form-group">
                                    <label><?= ucfirst($key) ?></label>
                                    <?php if ($key == 'volunteer') : ?>
                                        <input name="keys[<?= $key ?>]" value="<?= $component ?>" type="number" min="0" max="5" class="form-control" required>
                                    <?php else : ?>
                                        <select name="keys[<?= $key ?>]" class="custom-select" required>
                                            <option value="" selected disabled>Select <?= $key ?> score</option>
                                            <?php foreach ($guide[$key] as $scoreguide) : ?>
                                                <?php $selected = ($scoreguide['score'] == $component) ? 'selected' : ''; ?>
                                                <option value="<?= $scoreguide['score'] ?>" <?= $selected ?>><?= $scoreguide['concat'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    <?php endif ?>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit data</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>