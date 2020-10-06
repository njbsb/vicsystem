<h2 class="margin"><?= $title ?></h2>

<button class="btn btn-outline-info btn-sm">Add score</button>
<hr>
<table class="table text-center">
    <thead class="table-dark">
        <tr>
            <td>Session</td>
            <?php foreach ($levels as $ls) : ?>
                <td data-toggle="tooltip" data-placement="top" title="<?= $ls['percentage'] ?>%">Level <?= ucfirst($ls['level']) ?></td>
            <?php endforeach ?>
            <td data-toggle="tooltip" data-placement="top" title="15%">COMP</td>
            <td>Status</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>20162017 Sem 1</td>
            <td>15</td>
            <td>15</td>
            <td>15</td>
            <td>15</td>
            <td>Done</td>
        </tr>
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
        <div class="tab-pane fade show" id="<?= $ls['level'] ?>">
            <br>
            <?= form_open('score/addscore') ?>
            <fieldset class="col-md-auto">
                <div class="form-group">
                    <label for="level_id">Level</label>
                    <input name="level_id" value="<?= ucfirst($ls['id']) ?>" type="text" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="student_id">Matric</label>
                    <input name="student_id" value="<?= $student_id ?>" type="text" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="activity_id">Activity</label>
                    <select name="activity_id" class="form-control">
                        <option value="" selected disabled hidden>Choose activity</option>
                        <?php foreach ($sigactivity as $sigact) : ?>
                            <option value="<?= $sigact['id'] ?>"><?= $sigact['activity_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col col-6">
                        <div class="form-group">
                            <fieldset>
                                <label class="control-label" for="sc_">Score Position</label>
                                <input class="form-control" type="number" id="sc_position" name="sc_position" min="2" max="5" required>
                            </fieldset>
                        </div>
                    </div>
                    <div class="col col-6">
                        <div class="form-group">
                            <fieldset>
                                <label class="control-label" for="sc_">Score Meeting</label>
                                <input class="form-control" type="number" id="sc_meeting" name="sc_position" min="1" max="3" required>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-6">
                        <div class="form-group">
                            <fieldset>
                                <label class="control-label" for="sc_">Score Attendance</label>
                                <input class="form-control" type="number" id="sc_attendance" name="sc_position" min="0" max="5" required>
                            </fieldset>
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <!-- <div class="form-group">
                            <fieldset>
                                <label class="control-label" for="sc_">Score Involvement</label>
                                <input class="form-control" type="number" id="sc_involvement" name="sc_position" min="0" max="7" required>
                            </fieldset>
                        </div> -->
                        <div class="form-group">
                            <label class="control-label" for="sc_">Score Involvement</label>
                            <select name="sc_involvement" class="custom-select">
                                <option value="" disabled hidden selected>Select involvement score</option>
                                <?php foreach ($guide_involvement as $inv) : ?>
                                    <option value="<?= $inv['score'] ?>"><?= $inv['score'] . ' - ' . $inv['description'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary">Submit</button>
            </fieldset>
            <?= form_close() ?>
        </div>
    <?php endforeach ?>

    <div class="tab-pane fade" id="comp">
        <br>
        <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater.</p>
    </div>
</div>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>