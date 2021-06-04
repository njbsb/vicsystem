<?php if (validation_errors()) : ?>
    <div class="alert alert-dismissible alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4 class="alert-heading">Warning!</h4>
        <p class="mb-0"><?= validation_errors() ?></p>
    </div>
<?php endif ?>


<div class="row justify-content-md-center">
    <div class="col-md-6 col-md-offset-3">
        <h3 class="text-center"><?= $title ?></h3>
        <?php $hidden = array('usertype' => $usertype) ?>
        <?= form_open('register', '', $hidden) ?>
        <!-- Usertype -->
        <!-- <div class="form-group">
            <input type="hidden" class="form-control" id='usertype' name="usertype_name" value="<?= ucfirst($usertype) ?>" readonly="" required>
        </div> -->

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
            <label for="programcode">Program</label>
            <select name="programcode" class="form-control" required>
                <option value="" selected disabled hidden>Choose academic program</option>
                <?php foreach ($programs as $prog) : ?>
                    <?php $selected = ($prog['code'] = $program_code) ? 'selected' : '' ?>
                    <option value="<?= $prog['code'] ?>" <?= $selected ?>>
                        <?= $prog['program'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <!-- SIG -->
        <div class="form-group">
            <label>Special Interest Group (SIG)</label>
            <select name="sig_id" class="form-control" id="sig_id" required>
                <option value="" selected disabled hidden>Choose SIG</option>
                <?php foreach ($sigs as $sig) : ?>
                    <?php $selected = ($sig_id == $sig['id']) ? 'selected' : '' ?>
                    <option value="<?= $sig['code'] ?>" <?= $selected ?>>
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
            <input value="" type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label>Confirm password</label>
            <input value="" type="password" class="form-control" name="confirmpassword" placeholder="Confirm password" required>
        </div>

        <!-- SUBMIT BUTTON -->
        <button type="submit" class="btn btn-dark btn-block">Register</button>
        <?= form_close() ?>
    </div>
</div>
<br>