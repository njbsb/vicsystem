<h2><?= $title ?></h2>
<?php if (validation_errors()) : ?>
    <?= validation_errors() ?>
<?php endif ?>


<?php echo form_open('activity/update'); ?>
<input type="hidden" name="id" value="<?= $activity['id'] ?>">
<fieldset class="col-md-auto">

    <!-- load current user data here -->
    <div class="form-group">
        <label>User name</label>
        <input name="author_id" type="text" readonly="" class="form-control" id="author_id" value="A161010/K001" readonly>
    </div>
    <!-- Form fields start here -->

    <!-- Activity Name -->
    <div class="form-group">
        <label>Activity Name</label>
        <input name="activityname" type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter activity name" value="<?php echo $activity['activity_name']; ?>">
        <small id="emailHelp" class="form-text text-muted">Please include unique activity name</small>
    </div>

    <!-- Activity Description -->
    <div class="form-group">
        <label>Activity Description</label>
        <textarea name="activitydesc" class="form-control ckeditor" rows="3"><?php echo $activity['activity_desc']; ?></textarea>
        <small class="form-text text-muted">Please include summary report of the activity</small>
    </div>

    <!-- Venue -->
    <div class="form-group">
        <label>Venue</label>
        <input name="venue" type="text" class="form-control" placeholder="Enter venue name" value="<?= $activity['venue'] ?>">
        <!-- <small class="form-text text-muted">Venue of the activity</small> -->
    </div>
    <!-- Theme -->
    <div class="form-group">
        <label>Theme</label>
        <input name="theme" type="text" class="form-control" placeholder="Enter activity theme" value="<?= $activity['theme'] ?>">
        <!-- <small class="form-text text-muted">Theme</small> -->
    </div>

    <!-- Academic Session -->
    <div class="row">

    </div>
    <div class="form-group">
        <label>Select academic session</label>
        <select name="academicsession_id" class="form-control">
            <?php foreach ($academicsessions as $academicsession) : ?>
                <option value="<?= $academicsession['id'] ?>" <?php
                                                                if ($academicsession['id'] == $activity['acadsession_id']) {
                                                                    echo 'selected';
                                                                }
                                                                ?>>
                    <?= $academicsession['academicyear'] . ' Sem ' . $academicsession['semester_id']; ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <!-- Select SIG -->
    <div class="form-group">
        <label>Select SIG</label>
        <select name="sig_id" class="form-control">
            <option value="" selected disabled hidden>Choose SIG</option>
            <?php foreach ($sigs as $sig) : ?>
                <option value="<?php echo $sig['id']; ?>" <?php
                                                            if ($sig['id'] == $activity['sig_id']) {
                                                                echo 'selected';
                                                            } ?>>
                    <?= $sig['signame'] . ' (' . $sig['code'] . ')'; ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <!-- Activity Advisor (Mentor) -->
    <div class="form-group">
        <label>Select activity advisor</label>
        <select name="advisor_matric" class="form-control">
            <option value="" selected disabled hidden>Choose Advisor</option>
            <?php foreach ($mentors as $mentor) : ?>
                <option value="<?= $mentor['id'] ?>" <?php
                                                        if ($mentor['id'] == $activity['advisor_matric']) {
                                                            echo 'selected';
                                                        } else {
                                                            echo 'disabled';
                                                        }
                                                        ?>>
                    <?= $mentor['name'] . ' (' . $mentor['id'] . ')' ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <!-- HIGHCOM -->
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="director">Project Director</label>
                <select name="projectdirector" id="projectdirector" class="form-control">
                    <option value="" selected disabled hidden>Choose Project Director</option>
                    <?php foreach ($sigstudents as $ss) : ?>
                        <option value="<?= $ss['id'] ?>" <?php if ($ss['id'] == $director['id']) {
                                                                echo 'selected';
                                                            } else {
                                                                echo 'disabled';
                                                            } ?>>
                            <?= $ss['id'] . ' ' . $ss['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="deputydirector">Deputy Project Director</label>
                <select name="deputydirector" id="deputydirector" class="form-control">
                    <option value="" selected disabled hidden>Choose Deputy Director</option>
                    <?php foreach ($sigstudents as $ss) : ?>
                        <option value="<?= $ss['id'] ?>" <?php if ($ss['id'] == $deputy['id']) {
                                                                echo 'selected';
                                                            } else {
                                                                echo 'disabled';
                                                            } ?>>
                            <?= $ss['id'] . ' ' . $ss['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="secretary">Secretary</label>
                <select name="secretary" id="secretary" class="form-control">
                    <option value="" selected disabled hidden>Choose Secretary</option>
                    <?php foreach ($sigstudents as $ss) : ?>
                        <option value="<?= $ss['id'] ?>" <?php if ($ss['id'] == $secretary['id']) {
                                                                echo 'selected';
                                                            } else {
                                                                echo 'disabled';
                                                            } ?>>
                            <?= $ss['id'] . ' ' . $ss['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>

    <!-- Activity File and Image -->
    <div class="row">
        <div class="form-group col-sm-4">
            <label>Choose a file (Paperwork)</label>
            <input name="paperwork_file" type="file" class="form-control-file" id="paperwork_file" aria-describedby="fileHelp">
            <small id="fileHelp" class="form-text text-muted"><?= $activity['paperwork_file'] ?></small>
        </div>
        <div class="form-group col-sm-4">
            <label>Choose a photo (Activity Image)</label>
            <input name="photo_path" type="file" class="form-control-file" id="photo_path" aria-describedby="fileHelp">
            <small id="fileHelp" class="form-text text-muted"><?= $activity['photo_path'] ?></small>
        </div>
    </div>

    <!-- Start and end date -->
    <div class="row">
        <div class="form-group col-sm-4">
            <label>Datetime start (DT):</label>
            <input name="datetime_start" value="<?= str_replace(' ', 'T', $activity['datetime_start']); ?>" type="datetime-local" id="datetime_start">
        </div>

        <div class="form-group col-sm-4">
            <label>Datetime end (DT):</label>
            <input name="datetime_end" value="<?= str_replace(' ', 'T', $activity['datetime_end']); ?>" type="datetime-local" id="datatime_end">
        </div>
    </div>
    <br>
    <button type="submit" class="btn btn-primary btn-block">Update</button>
</fieldset>
</form>