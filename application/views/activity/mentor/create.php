<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('activity') ?>">Activity</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>
<?php $hidden = array(
    'author_id' => $this->session->userdata('username'),
    'activitycategory_id' => $activitycategory['code']
);
if ($activesession) {
    $hidden['acadsession_id'] = $activesession['id'];
} ?>
<?= form_open('activity/create', '', $hidden) ?>
<fieldset class="">
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img style="max-width: 100%; object-fit: cover; object-position: center; box-sizing: border-box; border-radius: 12px; background-position: center center;
  background-repeat: no-repeat;" width="50%" height="100%" src="<?= base_url('assets/images/activity.png') ?>" alt="">
                    </div>
                    <br>
                    <div class="form-group">
                        <?php $acadsession = ($activesession) ? $activesession['academicsession'] : '?' ?>
                        <h4><?= $activitycategory['category'] . ' @ ' . $acadsession ?></h4>
                    </div>
                    <div class="form-group">
                        <label><?= $activitycategory['category'] ?> Title</label>
                        <input name="activityname" type="text" class="form-control" placeholder="<?= $activitycategory['category'] ?> Title" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="datetime_start">Start date</label>
                                <input type="datetime-local" name="datetime_start" class="form-control" id="" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="datetime_end">End date</label>
                                <input type="datetime-local" name="datetime_end" class="form-control" id="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label><?= $activitycategory['category'] ?> Advisor</label>
                                <select name="advisor_id" class="form-control" required>
                                    <option value="" selected disabled hidden>Choose Advisor</option>
                                    <?php foreach ($mentors as $mentor) : ?>
                                    <option value="<?= $mentor['id'] ?>">
                                        <?= $mentor['name'] . ' (' . $mentor['id'] . ')' ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <small>You can only add activity in the currently active academic session.</small>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <h4>Committee</h4>
                    </div>
                    <div class="row">
                        <?php foreach ($highcoms as $highcom) : ?>
                        <div class="col-lg-12">
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
                    <div style="line-height: 100%;">
                        <small>If you don't see any specific student, you might have not enrolled them into the current academic session.</small>
                    </div>
                    <br>
                    <hr>
                    <div class="form-group">
                        <button id="submitbtn" type="submit" class="btn btn-primary">Submit</button>

                        <div id="errormessage" style="line-height: 100%;">
                            <br>
                            <small>Seems that you are not in any active academic session. Please configure the session date properly <a href="<?= site_url('academic/control') ?>">here</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

</fieldset>
<?= form_close() ?>

<script>
var btnsubmit = document.getElementById("submitbtn");
var errormessage = document.getElementById("errormessage");
var activesession = <?= json_encode($activesession) ?>;
if (!activesession) {
    btnsubmit.disabled = true;
} else {
    errormessage.remove();
}
</script>