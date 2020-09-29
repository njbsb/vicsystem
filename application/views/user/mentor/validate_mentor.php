<div class="row">
    <div class="col-md-4 text-center">
        <h4><?= ucfirst($user['usertype']) ?> Form</h4>
        <?php if ($user['userstatus_id'] == 1) : ?>
            <span class="badge badge-warning"><?= $user['userstatus'] ?></span>
        <?php elseif ($user['userstatus_id'] == 2) : ?>
            <span class="badge badge-success"><?= $user['userstatus'] ?></span>
        <?php endif ?>
    </div>
    <div class="col-md-8 text-left">
        <!-- Position -->
        <div class="form-group">
            <label>Position</label>
            <input name="position" value="<?= $mentor['position'] ?>" type="text" class="form-control" placeholder="Dr of some sorts" required>
        </div>
        <!-- Room -->
        <div class="form-group">
            <label for="roomnum">Room No</label>
            <input name="roomnum" value="<?= $mentor['roomnum'] ?>" type="text" class="form-control" placeholder="E-0-0" required>
        </div>
        <!-- Role -->
        <div class="form-group">
            <label>Select Role in SIG</label>
            <select name="orgrole_id" class="form-control">
                <option value="" selected disabled hidden>Choose mentor role</option>
                <?php foreach ($mentorroles as $role) : ?>
                    <option value="<?= $role['id'] ?>" <?php if ($mentor['orgrole_id'] == $role['id']) {
                                                            echo 'selected';
                                                        } ?>>
                        <?= $role['rolename'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
<?= form_close() ?>