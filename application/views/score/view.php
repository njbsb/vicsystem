<h2 class="margin"><?= $title ?></h2>

<!-- <button class="btn btn-outline-info btn-sm">Add score</button> -->
<hr>
<table class="table text-center">
    <thead class="table-dark">
        <tr>
            <td>Academic Session</td>
            <?php foreach ($levels as $ls) : ?>
                <td data-toggle="tooltip" data-placement="top" title="<?= $ls['percentage'] ?>%">Level <?= ucfirst($ls['level']) ?></td>
            <?php endforeach ?>
            <td data-toggle="tooltip" data-placement="top" title="15%">COMP</td>
            <td data-toggle="tooltip" data-placement="top" title="55%">Total</td>
        </tr>
    </thead>
    <tbody>
        <?php if ($tabletotals) : ?>
            <?php foreach ($tabletotals as $tt) : ?>
                <tr>
                    <td><?= $tt['academicsession'] ?></td>
                    <td><?= $tt['a1'] ?></td>
                    <td><?= $tt['a2'] ?></td>
                    <td><?= $tt['b1'] ?></td>
                    <td><?= $tt['comp'] ?></td>
                    <td><?= $tt['total'] ?></td>
                </tr>
            <?php endforeach ?>
        <?php else : ?>
            <tr>
                <td>No data found</td>
            </tr>
        <?php endif ?>
    </tbody>
</table>

<ul class="nav nav-tabs">
    <?php foreach ($levels as $ls) : ?>
        <li class="nav-item">
            <a class="nav-link btn-warning" data-toggle="tab" href="#<?= $ls['level'] ?>">Level <?= $ls['level'] ?></a>
        </li>
    <?php endforeach ?>
    <li class="nav-item">
        <a class="nav-link btn-info" data-toggle="tab" href="#comp">Components</a>
    </li>
</ul>
<div id="myTabContent" class="tab-content">
    <?php foreach ($levels as $ls) : ?>
        <?php $eachlevel = $active_scorebylevels[array_search($ls['id'], array_column($active_scorebylevels, 'levelscore_id'))]; ?>
        <div class="tab-pane fade show" id="<?= $ls['level'] ?>">
            <br>
            <?php if ($eachlevel['allhasvalue']) : ?>
                <p>This level's score has been submitted</p>
            <?php else : ?>
                <?= form_open('score/setscorelevel/' . $student_id) ?>
                <fieldset class="col-md-auto">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="acadsession_id">Academic Session</label>
                                <input type="acadsession_name" value="<?= $activeacadsession['activeacademicsession'] ?>" class="form-control" readonly>
                                <input name="acadsession_id" value="<?= $activeacadsession['id'] ?>" type="hidden" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="levelscore_id">Level</label>
                                <input name="levelscore_code" value="<?= ucfirst($ls['level']) ?>" type="text" class="form-control" readonly>
                                <input name="levelscore_id" type="hidden" value="<?= ucfirst($ls['id']) ?>" class="form-control" name="levelscore_id" readonly>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="student_id">Matric</label>
                        <input name="student_id" value="<?= $student_id ?>" type="text" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="activity_id">Activity</label>
                        <select name="activity_id" class="form-control" required>
                            <option value="" selected disabled hidden>Choose activity</option>
                            <?php foreach ($sigactivity as $sigact) : ?>
                                <option value="<?= $sigact['id'] ?>"><?= $sigact['activity_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col col-6">
                            <div class="form-group">
                                <label class="control-label" for="sc_iposition">Score Position</label>
                                <select name="sc_position" class="custom-select" required>
                                    <option value="" disabled hidden selected>Select position score</option>
                                    <?php foreach ($guide_position as $pos) : ?>
                                        <option value="<?= $pos['score'] ?>"><?= $pos['score'] . ' - ' . $pos['description'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col col-6">
                            <div class="form-group">
                                <label class="control-label" for="sc_meeting">Score Meeting</label>
                                <select name="sc_meeting" class="custom-select" required>
                                    <option value="" disabled hidden selected>Select meeting score</option>
                                    <?php foreach ($guide_meeting as $met) : ?>
                                        <option value="<?= $met['score'] ?>"><?= $met['score'] . ' - ' . $met['description'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="sc_attendance">Score Attendance</label>
                                <select name="sc_attendance" class="custom-select" required>
                                    <option value="" disabled hidden selected>Select attendance score</option>
                                    <?php foreach ($guide_attendance as $att) : ?>
                                        <option value="<?= $att['score'] ?>"><?= $att['score'] . ' - ' . $att['description'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="sc_involvement">Score Involvement</label>
                                <select name="sc_involvement" class="custom-select" required>
                                    <option value="" disabled hidden selected>Select involvement score</option>
                                    <?php foreach ($guide_involvement as $inv) : ?>
                                        <option value="<?= $inv['score'] ?>"><?= $inv['score'] . ' - ' . $inv['description'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </fieldset>
                <?= form_close() ?>
            <?php endif ?>

        </div>
    <?php endforeach ?>

    <div class="tab-pane fade" id="comp">
        <br>
        <?php if ($active_scorebycomps['allhasvalue']) : ?>
            <p>This components scores has been submitted</p>
        <?php else : ?>
            <?= form_open('score/setscorecomp/' . $student_id) ?>
            <fieldset>
                <div class="form-group">
                    <input type="text" value="<?= $activeacadsession['activeacademicsession'] ?>" class="form-control" readonly>
                    <input name="acadsession_id" value="<?= $activeacadsession['id'] ?>" type="hidden" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="student_id">Matric</label>
                    <input name="student_id" value="<?= $student_id ?>" type="text" class="form-control" readonly>
                </div>

                <div class="row">
                    <div class="col col-md-4">
                        <div class="form-group">
                            <label for="sc_digitalcv">Digital CV</label>
                            <select name="sc_digitalcv" class="custom-select" required>
                                <option value="" disabled hidden selected>Select digital CV score</option>
                                <?php foreach ($guide_digitalcv as $cv) : ?>
                                    <option value="<?= $cv['score'] ?>"><?= $cv['score'] . ' - ' . $cv['description'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <div class="form-group">
                            <label for="sc_leadership">Leadership</label>
                            <select name="sc_leadership" class="custom-select" required>
                                <option value="" disabled hidden selected>Select leadership score</option>
                                <?php foreach ($guide_leadership as $led) : ?>
                                    <option value="<?= $led['score'] ?>"><?= $led['score'] . ' - ' . $led['description'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <div class="form-group">
                            <label for="sc_volunteer">Volunteerism</label>
                            <input name="sc_volunteer" type="number" min="0" max="5" class="form-control" step="1" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </fieldset>
            <?= form_close() ?>
        <?php endif ?>

    </div>
</div>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>