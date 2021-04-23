<h2 class="text-center"><?= $title; ?></h2>

<?php $hidden = array(
    'author_id' => $this->session->userdata('username'),
    'activitycategory_id' => $activitycategory['code'],
    'acadsession_id' => $activesession['id']
); ?>
<?= form_open('activity/create', '', $hidden) ?>
<fieldset class="col-md-auto">
    <div class="form-group">
        <h3><?= $activitycategory['categorycode'] ?></h3>
    </div>
    <div class="form-group">
        <label>Activity Name</label>
        <input name="activityname" type="text" class="form-control" placeholder="Activity Name" required>
    </div>

    <!-- <div class="form-group">
        <label for="activitytype_id">Activity type</label>
        <select name="activitytype_id" class="form-control" required>
            <option value="" selected disabled hidden>Select activity type</option>
            <?php foreach ($activitytype as $acttype) : ?>
                <option value="<?= $acttype['id'] ?>"><?= $acttype['type'] ?></option>
            <?php endforeach ?>
        </select>
    </div> -->
    <div class="form-group">
        <label>Select academic session</label>
        <input value="<?= $activesession['academicsession'] ?>" readonly type="text" class="form-control">
    </div>
    <div class="form-group">
        <label>Select activity advisor</label>
        <select name="advisor_matric" class="form-control" required>
            <option value="" selected disabled hidden>Choose Advisor</option>
            <?php foreach ($mentors as $mentor) : ?>
            <option value="<?php echo $mentor['id']; ?>">
                <?= $mentor['name'] . ' (' . $mentor['id'] . ')' ?>
            </option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="row">
        <?php foreach ($highcoms as $highcom) : ?>
        <div class="col-md-6">
            <div class="form-group">
                <label><?= $highcom['role'] ?></label>
                <select name="highcoms[<?= $highcom['id'] ?>]" id="" class="form-control" required>
                    <option value="" disabled selected hidden>Select <?= strtolower($highcom['role']) ?></option>
                    <?php foreach ($sigstudents as $std) : ?>
                    <option value="<?= $std['id'] ?>">
                        <?= $std['id'] . ' ' . $std['name'] ?>
                    </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <?php endforeach ?>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-outline-primary">Submit</button>
    </div>

</fieldset>
<?= form_close() ?>