<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('activity') ?>">Activity</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>

<!-- <h2 class="text-center"><?= $title ?></h2> -->
<?php $hidden = array(
    'author_id' => $this->session->userdata('username'),
    'activitycategory_id' => $activitycategory['code'],
    'acadsession_id' => $activesession['id']
); ?>
<?= form_open('activity/create', '', $hidden) ?>
<fieldset class="">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <h4><?= $activitycategory['category'] ?></h4>
            </div>
            <div class="form-group">
                <label><?= $activitycategory['category'] ?> Title</label>
                <input name="activityname" type="text" class="form-control" placeholder="<?= $activitycategory['category'] ?> Title" required>
            </div>
            <div class="form-group">
                <label>Select academic session</label>
                <input value="<?= $activesession['academicsession'] ?>" readonly type="text" class="form-control">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="datetime_start">Start date</label>
                        <input type="datetime-local" name="datetime_start" class="form-control" id="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="datetime_end">End date</label>
                        <input type="datetime-local" name="datetime_end" class="form-control" id="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <h4>Committee</h4>
            </div>
            <div class="form-group">
                <label>Select activity advisor</label>
                <select name="advisor_id" class="form-control" required>
                    <option value="" selected disabled hidden>Choose Advisor</option>
                    <?php foreach ($mentors as $mentor) : ?>
                    <option value="<?= $mentor['id'] ?>">
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
            <small>If you don't see any specific student, you might have not enrolled them into the current academic session.</small>

        </div>
    </div>
    <!-- <hr> -->
    <br>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</fieldset>
<?= form_close() ?>