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
        <?php $hidden = array('usertype_id' => $usertype_id) ?>
        <?= form_open('register', '', $hidden) ?>
        <!-- Usertype -->
        <div class="form-group">
            <input type="text" class="form-control" id='usertype_id' name="usertype_name" value="<?= $usertype_name ?>" readonly="" required>
        </div>

        <!-- ID -->
        <div class="form-group">
            <label>ID/Matric</label>
            <input name="id" value="<?= $id ?>" type="text" class="form-control" id='id' placeholder="Matric/ID No" required>
        </div>

        <!-- NAME -->
        <div class="form-group">
            <label>Name</label>
            <input name="name" value="<?= $name ?>" type="text" class="form-control" placeholder="Name" required>
        </div>

        <!-- DOB -->
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input name="dob" class="form-control" type="date" value="<?= $dob ?>" id="dob" required>
        </div>

        <!-- POSITION -->
        <div class="form-group">
            <label for="position">Position</label>
            <input name="position" value="<?= $position ?>" placeholder="Position" type="text" class="form-control" required>
        </div>

        <!-- ROOM NUMBER -->
        <div class="form-group">
            <label for="roomnum">Room Number</label>
            <input name="roomnum" value="<?= $roomnum ?>" placeholder="E-0-0" type="text" class="form-control" required>
        </div>

        <!-- SIG -->
        <div class="form-group">
            <label>Special Interest Group (SIG)</label>
            <select name="sig_id" class="form-control" id="sig_id">
                <option value="" selected disabled hidden>Choose SIG</option>
                <?php foreach ($sigs as $sig) : ?>
                    <?php $selected = ($sig_id == $sig['id']) ? 'selected' : '' ?>
                    <option value="<?= $sig['id'] ?>" <?= $selected ?>>
                        <?= $sig['namecode'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="form-group">
            <label for="orgrole_id">Role in SIG</label>
            <select name="orgrole_id" class="form-control" required>
                <option value="" selected disabled hidden>Choose role in SIG</option>
                <?php foreach ($mentorroles as $mr) : ?>
                    <?php $selected = ($orgrole_id == $mr['id']) ? 'selected' : '' ?>
                    <option value="<?= $mr['id'] ?>" <?= $selected ?>><?= $mr['rolename'] ?></option>
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
        <button type="submit" class="btn btn-primary btn-block">Register</button>
        <?= form_close() ?>
    </div>
</div>
<br>