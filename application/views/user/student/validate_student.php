<div class="row">
    <div class="col-md-4 text-center">
        <h4><?= ucfirst($user['usertype']) ?> Form</h4>
        <?php if ($user['userstatus'] == 'pending') : ?>
        <span class="badge badge-warning"><?= $user['userstatus'] ?></span>
        <?php elseif ($user['userstatus'] == 'active') : ?>
        <span class="badge badge-success"><?= $user['userstatus'] ?></span>
        <?php endif ?>
        <!-- <h6>Status: <?= $user['userstatus'] ?></h6> -->
    </div>
    <div class="col-md-8 text-left">
        <!-- Phone Num -->
        <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" value="<?= $student['phonenum'] ?>" class="form-control" name="phonenum" placeholder="01X-XXXXXXX" required>
        </div>
        <!-- Program -->
        <div class="form-group">
            <label>Select Program</label>
            <select name="program_code" class="form-control" id="program_code">
                <option value="" selected disabled hidden>Choose program</option>
                <?php foreach ($programs as $program) : ?>
                <?php $programselected = ($student['program_id'] == $program['code']) ? 'selected' : '' ?>
                <option value="<?= $program['code'] ?>" <?= $programselected ?>>
                    <?= $program['program'] ?>
                </option>
                <?php endforeach ?>
            </select>
        </div>
        <!-- Mentor -->
        <div class="form-group">
            <label class="text-danger">*Select Mentor (<?= $user['code'] ?>)</label>
            <select name="mentor_matric" class="form-control" id="sig_mentor">
                <?php if ($sigmentors) : ?>
                <option value="" selected disabled hidden>Choose mentor</option>
                <?php foreach ($sigmentors as $mentor) : ?>
                <?php $mentorselected = ($student['mentor_id'] == $mentor['id']) ? 'selected' : '' ?>
                <option value="<?= $mentor['id'] ?>" <?= $mentorselected ?>>
                    <?= $mentor['name'] ?>
                </option>
                <?php endforeach ?>
                <?php else : ?>
                <option value=null>
                    Error: No mentor under this SIG
                </option>
                <?php endif ?>

            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
<?= form_close() ?>