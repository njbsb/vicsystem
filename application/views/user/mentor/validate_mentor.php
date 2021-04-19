<div class="row">
    <div class="col-md-4 text-center">
        <h4><?= ucfirst($user['usertype']) ?> Form</h4>
        <?php $badgetype = ($user['userstatus'] == 'pending') ? 'badge-warning' : 'badge-success' ?>
        <span class="badge <?= $badgetype ?>"><?= $user['userstatus'] ?></span>
    </div>
    <div class="col-md-8 text-left">
        <!-- POSITION -->
        <div class="form-group">
            <label>Position</label>
            <input name="position" value="<?= $mentor['position'] ?>" type="text" class="form-control" placeholder="Dr of some sorts" required>
        </div>
        <!-- ROOMNUM -->
        <div class="form-group">
            <label for="roomnum">Room No</label>
            <input name="roomnum" value="<?= $mentor['roomnum'] ?>" type="text" class="form-control" placeholder="E-0-0" required>
        </div>
        <!-- ORG ROLE -->
        <div class="form-group">
            <label>Select Role in SIG</label>
            <select name="orgrole_id" class="form-control">
                <option value="" selected disabled hidden>Choose mentor role</option>
                <?php foreach ($mentorroles as $role) : ?>
                <?php $roleselected = ($mentor['role_id'] == $role['id']) ? 'selected' : '' ?>
                <option value="<?= $role['id'] ?>" <?= $roleselected ?>>
                    <?= $role['role'] ?>
                </option>
                <?php endforeach ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
<?= form_close() ?>