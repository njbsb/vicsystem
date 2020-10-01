<h2 class="text-center"><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('activity/create'); ?>
<fieldset class="col-md-auto">
    <!-- <legend>Author</legend> -->

    <!-- load current user data here -->
    <div class="form-group">
        <label>User name</label>
        <input name="author_id" type="text" readonly="" class="form-control" id="author" value="A161010/K001" readonly>
    </div>
    <!-- Form fields start here -->

    <!-- Activity Name -->
    <div class="form-group">
        <label>Activity Name</label>
        <input name="activityname" type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter activity name" required>
        <small class="form-text text-muted">Please include unique activity name</small>
    </div>

    <!-- Activity Description -->
    <div class="form-group">
        <label>Activity Description</label>
        <textarea name="activitydesc" class="form-control ckeditor" rows="3"></textarea>
        <small class="form-text text-muted">Please include summary report of the activity</small>
    </div>

    <!-- Venue -->
    <div class="form-group">
        <label>Venue</label>
        <input name="venue" type="text" class="form-control" placeholder="Enter venue name">
        <!-- <small class="form-text text-muted">Venue of the activity</small> -->
    </div>
    <!-- Theme -->
    <div class="form-group">
        <label>Theme</label>
        <input name="theme" type="text" class="form-control" placeholder="Enter activity theme">
        <!-- <small class="form-text text-muted">Theme</small> -->
    </div>

    <!-- Academic Session -->
    <div class="form-group">
        <label>Select academic session</label>
        <select name="academicsession_id" class="form-control">
            <?php foreach ($academicsessions as $academicsession) : ?>
                <option value="<?php echo $academicsession['id']; ?>">
                    <?= $academicsession['academicyear'] . ' Sem ' . $academicsession['semester_id']; ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <!-- SIG -->
    <div class="form-group">
        <label>Select involved SIG</label>
        <select name="sig_id" class="form-control">
            <option value="" selected disabled hidden>Choose sig</option>
            <?php foreach ($sigs as $sig) : ?>
                <option value="<?= $sig['id'] ?>">
                    <?php echo $sig['signame'] . ' (' . $sig['code'] . ')'; ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <!-- Activity Advisor (Mentor) -->
    <div class="form-group">
        <label>Select activity advisor</label>
        <select name="advisor_matric" class="form-control">
            <?php foreach ($mentors as $mentor) : ?>
                <option value="<?php echo $mentor['id']; ?>">
                    <?php echo $mentor['name'] . ' (' . $mentor['id'] . ')'; ?>
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
                    <?php foreach ($sigstudents as $ss) : ?>
                        <option value="<?= $ss['id'] ?>">
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
                    <?php foreach ($sigstudents as $ss) : ?>
                        <option value="<?= $ss['id'] ?>">
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
                    <?php foreach ($sigstudents as $ss) : ?>
                        <option value="<?= $ss['id'] ?>">
                            <?= $ss['id'] . ' ' . $ss['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>
    <hr>

    <!-- Activity File and Image -->
    <div class="row">
        <div class="form-group col-sm-4">
            <label>Choose a file (Paperwork)</label>
            <input name="paperwork_file" type="file" class="form-control-file" id="paperwork_file" aria-describedby="fileHelp">
            <small id="fileHelp" class="form-text text-muted">Insert the paperwork of the activity.</small>
        </div>
        <div class="form-group col-sm-4">
            <label>Choose a photo (Activity Image)</label>
            <input name="photo_path" type="file" class="form-control-file" id="photo_path" aria-describedby="fileHelp">
            <small id="fileHelp" class="form-text text-muted">Insert the image of the activity.</small>
        </div>
    </div>

    <!-- Start and end date -->
    <div class="row">
        <div class="form-group col-sm-4">
            <label>Datetime start (date and time):</label>
            <input name="datetime_start" type="datetime-local" id="datetime_start" name="datetime_start">
        </div>

        <div class="form-group col-sm-4">
            <label>Datetime end (date and time):</label>
            <input name="datetime_end" type="datetime-local" id="datatime_end" name="datetime_end">
        </div>
    </div>
    <br>
    <button type="submit" class="btn btn-primary btn-block">Submit</button>
</fieldset>
</form>