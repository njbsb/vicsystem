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
        <?= form_open('register') ?>
        <!-- Usertype -->
        <div class="form-group">
            <!-- <label>Usertype</label> -->
            <input type="text" class="form-control" id='usertype_id' name="usertype_name" value="<?= $usertype_name ?>" readonly="" required>
            <input type="hidden" class="form-control" id='usertype_id' name="usertype_id" value="<?= $usertype_id ?>" required>
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

        <!-- PHONE NUM -->
        <div class="form-group">
            <label for="phonenum">Phone Number</label>
            <input name="phonenum" type="text" value="<?= $phonenum ?>" class="form-control" placeholder="01X-XXXXXXX" required>
        </div>

        <!-- PROGRAM -->
        <div class="form-group">
            <label for="program_code">Program</label>
            <select name="program_code" class="form-control" required>
                <option value="" selected disabled hidden>Choose academic program</option>
                <?php foreach ($programs as $prog) : ?>
                    <option value="<?= $prog['code'] ?>" <?php if ($prog['code'] = $program_code) {
                                                                echo 'selected';
                                                            } ?>>
                        <?= $prog['name'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <!-- SIG -->
        <div class="form-group">
            <label>Select SIG</label>
            <select name="sig_id" class="form-control" id="sig_id" required>
                <option value="" selected disabled hidden>Choose SIG</option>
                <?php foreach ($sigs as $sig) : ?>
                    <option value="<?= $sig['id'] ?>" <?php if ($sig_id == $sig['id']) {
                                                            echo 'selected';
                                                        } ?>>
                        <?= $sig['namecode'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <!-- EMAIL -->
        <div class="form-group">
            <label>Email</label>
            <input value="<?= $email ?>" type="email" class="form-control" name="email" placeholder="Email" required>
        </div>

        <!-- PASSWORD -->
        <div class="form-group">
            <label>Password</label>
            <input value="password" type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label>Confirm password</label>
            <input value="password" type="password" class="form-control" name="confirmpassword" placeholder="Confirm password" required>
        </div>

        <!-- SUBMIT BUTTON -->
        <button type="submit" class="btn btn-primary btn-block">Register</button>
        <?= form_close() ?>
    </div>
</div>