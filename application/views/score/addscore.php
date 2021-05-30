<h2><?= $title ?>: <?= $matric ?></h2>

<div class="table-responsive">
    <table class="table">
        <thead class="table-dark">
            <tr>
                <td>Session</td>
                <td>A1</td>
                <td>A2</td>
                <td>B</td>
                <td>COMP</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>20162017 Sem 1</td>
                <td>15</td>
                <td>15</td>
                <td>15</td>
                <td>15</td>
            </tr>
        </tbody>
    </table>
</div>

<ul class="nav nav-tabs">
    <?php foreach ($levelscores as $ls) : ?>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#<?= $ls['level'] ?>">Level <?= $ls['level'] ?></a>
    </li>
    <?php endforeach ?>
</ul>
<br>
<div id="myTabContent" class="tab-content">
    <?php foreach ($levelscores as $ls) : ?>
    <div class="tab-pane fade" id="<?= $ls['level'] ?>">
        <?php echo form_open('score/addscore/' . $matric); ?>
        <div class="form-group">
            <!-- <label for="">Level ID</label> -->
            <input name="level_id" type="hidden" value="<?= $ls['id'] ?>" class="form-control form-control-sm" readonly>
        </div>
        <div class="form-group">
            <fieldset>
                <label class="control-label">Student</label>
                <input value="<?= $matric  ?>" class="form-control" id="student_matric" type="text" placeholder="Readonly input here…" readonly="">
            </fieldset>
        </div>

        <div class="form-group">
            <label for="activity_id">Select Activity</label>
            <select class="form-control" id="activity_id">
                <?php foreach ($activities as $act) : ?>
                <option value="<?= $act['id'] ?>"><?= $act['activity_name'] ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="row">
            <div class="col col-6">
                <div class="form-group">
                    <fieldset>
                        <label class="control-label" for="sc_">Score Position</label>
                        <input class="form-control" type="number" id="sc_position" name="sc_position" min="2" max="5">
                    </fieldset>
                </div>
            </div>
            <div class="col col-6">
                <div class="form-group">
                    <fieldset>
                        <label class="control-label" for="sc_">Score Meeting</label>
                        <input class="form-control" type="number" id="sc_meeting" name="sc_position" min="1" max="3">
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <fieldset>
                        <label class="control-label" for="sc_">Score Attendance</label>
                        <input class="form-control" type="number" id="sc_attendance" name="sc_position" min="0" max="5">
                    </fieldset>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="form-group">
                    <fieldset>
                        <label class="control-label" for="sc_">Score Involvement</label>
                        <input class="form-control" type="number" id="sc_involvement" name="sc_position" min="0" max="7">
                    </fieldset>
                </div>
            </div>
        </div>
        <button class="btn btn-primary">Submit</button>
        <?php echo form_close(); ?>
    </div>

    <?php endforeach ?>
</div>