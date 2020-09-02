<h2><?php echo $title; ?></h2>

<?php echo validation_errors();?>

<?php echo form_open('activity/create'); ?>
<fieldset>
    <legend>Author</legend>

    <!-- load current user data here -->
    <!-- <div class="form-group row">
        <label class="col-sm-2 col-form-label">User name</label>
        <div class="col-sm-10">
            <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="user@example.com">
        </div>
    </div> -->
    <!-- Form fields start here -->

    <!-- Activity Name -->
    <div class="form-group">
        <label>Activity Name</label>
        <input name="activityname" type="text" class="form-control" aria-describedby="emailHelp"
            placeholder="Enter activity name">
        <small id="emailHelp" class="form-text text-muted">Please include unique activity name</small>
    </div>

    <!-- Activity Description -->
    <div class="form-group">
        <label>Activity Description</label>
        <textarea name="activitydesc" class="form-control" rows="3"></textarea>
        <small id="emailHelp" class="form-text text-muted">Please include summary report of the activity</small>
    </div>

    <!-- Academic Session -->
    <div class="form-group">
        <label>Select academic session</label>
        <select name="academicsession_id" class="form-control">
            <?php foreach($academicsessions as $academicsession): ?>
            <option value="<?php echo $academicsession['id']; ?>">
                <?php echo $academicsession['session']; ?>
            </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label>Select semester</label>
        <select name="semester" class="form-control" id="exampleSelect1">
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
    </div>

    <!-- Semester -->
    <div class="form-group">
        <label>Select involved SIG</label>
        <select name="sig_id" class="form-control" id="exampleSelect1">
            <?php foreach($sigs as $sig): ?>
            <option value="<?= $sig['id'] ?>">
                <?php echo $sig['signame'].' ('.$sig['code'].')'; ?>
            </option>
            <?php endforeach ?>
        </select>
    </div>

    <!-- Activity Advisor (Mentor) -->
    <div class="form-group">
        <label>Select activity advisor</label>
        <select name="advisor_matric" class="form-control">
            <?php foreach($mentors as $mentor): ?>
            <option value="<?php echo $mentor['matric']; ?>">
                <?php echo $mentor['name'].' ('.$mentor['matric'].')'; ?>
            </option>
            <?php endforeach ?>
        </select>
    </div>

    <!-- Activity Image -->
    <div class="form-group">
        <label>Choose an image</label>
        <input name="photo_path" type="file" class="form-control-file" id="exampleInputFile"
            aria-describedby="fileHelp">
        <small id="fileHelp" class="form-text text-muted">Insert an image of the activity.</small>
    </div>

    <!-- Start and end date -->
    <div class="row">
        <div class="form-group col-sm-6">
            <label>Datetime start (date and time):</label>
            <input name="datetime_start" type="datetime-local" id="datetime_start" name="datetime_start">
        </div>

        <div class="form-group col-sm-6">
            <label>Datetime end (date and time):</label>
            <input name="datetime_end" type="datetime-local" id="datatime_end" name="datetime_end">
        </div>
    </div>


    <br>
    <button type="submit" class="btn btn-primary btn-block">Submit</button>
</fieldset>
</form>