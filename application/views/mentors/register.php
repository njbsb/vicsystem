<h2><?php echo $title; ?></h2>
<?php echo validation_errors(); ?>

<?php echo form_open('mentors/register'); ?>
<div class="form-group">
    <label>Matric</label>
    <input type="text" class="form-control" name="matric" placeholder="Matric/Student No" required>
</div>
<div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" name="name" placeholder="Name">
</div>
<div class="form-group">
    <label>Email</label>
    <input type="text" class="form-control" name="email" placeholder="Email">
</div>
<div class="form-group">
    <label>Password</label>
    <input type="text" class="form-control" name="password" placeholder="Password">
</div>
<div class="form-group">
    <label>Confirm password</label>
    <input type="text" class="form-control" name="passwordconfirm" placeholder="Confirm password">
</div>
<div class="form-group">
    <label>Position</label>
    <input type="text" class="form-control" name="position" placeholder="Position">
</div>

<div class="form-group">
    <label>Select SIG</label>
    <select class="form-control" id="">
        <?php foreach($sigs as $sig): ?>
        <option>
            <?php echo $sig['signame'].' ('.$sig['code'].')'; ?>
        </option>
        <?php endforeach ?>
    </select>
</div>

<div class="form-group">
    <label>Select Role</label>
    <select class="form-control" id="">
        <?php foreach($mentor_roles as $role): ?>
        <option>
            <?php echo $role['role_name']; ?>
        </option>
        <?php endforeach ?>
    </select>
</div>

<!-- Profile Image -->
<div class="form-group">
    <label>Choose profile image</label>
    <input type="file" class="form-control-file" id="" aria-describedby="fileHelp">
    <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the
        above input. It's a bit lighter and easily wraps to a new line.</small>
</div>

<button type="submit" class="btn btn-primary btn-block">Register</button>

<?php echo form_close(); ?>