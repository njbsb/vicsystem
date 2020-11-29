<?php if (validation_errors()) : ?>
    <div class="alert alert-dismissible alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4 class="alert-heading">Warning!</h4>
        <p class="mb-0"><?= validation_errors() ?></p>
    </div>
<?php endif ?>


<div class="row justify-content-md-center">
    <div class="col-md-4 col-md-offset-4">
        <h3 class="text-center"><?= $title ?></h3>
        <?php echo form_open('register'); ?>
        <!-- Usertype -->
        <div class="form-group">
            <!-- <label>Usertype</label> -->
            <input type="text" class="form-control" id='usertype_id' name="usertype_name" value="<?= $usertype_name ?>" readonly="" required>
            <input type="hidden" class="form-control" id='usertype_id' name="usertype_id" value="<?= $usertype_id ?>" readonly="" required>
        </div>

        <!-- ID -->
        <div class="form-group">
            <label>ID/Matric</label>
            <input value="<?= $id ?>" type="text" class="form-control" id='id' name="id" placeholder="Matric/ID No" required>
        </div>

        <!-- NAME -->
        <div class="form-group">
            <label>Name</label>
            <input value="<?= $name ?>" type="text" class="form-control" name="name" placeholder="Name">
        </div>

        <!-- DOB -->
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input name="dob" class="form-control" type="date" value="<?= $dob ?>" id="dob" required>
        </div>

        <!-- EMAIL -->
        <div class="form-group">
            <label>Email</label>
            <input value="<?= $email ?>" type="email" class="form-control" name="email" placeholder="Email">
        </div>

        <!-- PASSWORD -->
        <div class="form-group">
            <label>Password</label>
            <input value="password" type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <!-- <label>Confirm password</label> -->
            <input value="password" type="password" class="form-control" name="confirmpassword" placeholder="Confirm password">
        </div>

        <!-- SIG -->
        <div class="form-group">
            <!-- <label>Select SIG</label> -->
            <select name="sig_id" class="form-control" id="sig_id">
                <?php foreach ($sigs as $sig) : ?>
                    <?php $selected = ($sig_id == $sig['id']) ? 'selected' : '' ?>
                    <option value="<?= $sig['id'] ?>" <?= $selected ?>>
                        <?= $sig['namecode'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button>

        <?php echo form_close(); ?>
    </div>
</div>