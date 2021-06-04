<h2><?= $title ?></h2>
<?php echo validation_errors(); ?>

<?php echo form_open('student/register'); ?>
<div class="form-group">
    <label>Matric</label>
    <input type="text" class="form-control" id='matric' name="matric" placeholder="Matric/Staff No" required>
    <span id='matric_result'></span>
</div>
<div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" name="name" placeholder="Name">
</div>
<div class="form-group">
    <label>Phone Number</label>
    <input type="tel" class="form-control" name="phonenum" placeholder="01X-XXXXXXX">
</div>
<div class="form-group">
    <label>Email</label>
    <input type="email" class="form-control" name="email" placeholder="Email">
</div>
<div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password">
</div>
<div class="form-group">
    <label>Confirm password</label>
    <input type="password" class="form-control" name="passwordconfirm" placeholder="Confirm password">
</div>
<!-- select program -->
<div class="form-group">
    <label>Select Program</label>
    <select name="program_code" class="form-control" id="program_code">
        <?php foreach ($programs as $program) : ?>
            <option value="<?php echo $program['code']; ?>">
                <?php echo $program['name']; ?>
            </option>
        <?php endforeach ?>
    </select>
</div>
<!-- select sig -->
<div class="form-group">
    <label>Select SIG</label>
    <select name="sig_id" class="form-control" id="sig_id">
        <?php foreach ($sigs as $sig) : ?>
            <option value="<?php echo $sig['id']; ?>">
                <?php echo $sig['signame'] . ' (' . $sig['code'] . ')'; ?>
            </option>
        <?php endforeach ?>
    </select>
</div>

<!-- select mentor -->
<div class="form-group">
    <label>Select Mentor</label>
    <select name="sig_mentor_matric" class="form-control" id="sig_mentor">
        <?php foreach ($mentors as $mentor) : ?>
            <option value="<?php echo $mentor['id']; ?>">
                <?php echo $mentor['name']; ?>
            </option>
        <?php endforeach ?>
    </select>
</div>

<!-- Profile Image -->
<div class="form-group">
    <label>Choose profile image</label>
    <input name="photo_path" type="file" class="form-control-file" id="" aria-describedby="fileHelp">
    <small id="fileHelp" class="form-text text-muted">Choose a proper profile image.</small>
</div>

<button type="submit" class="btn btn-dark btn-block">Register</button>

<?php echo form_close(); ?>

<script type="text/javascript">
</script>