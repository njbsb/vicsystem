<h2><?= 'Mentor: ' . $mentor['name'] ?></h2>

<div class="container-fluid text-center">
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <?php if ($mentor['profile_image']) : ?>
                    <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= base_url('assets/images/profile/') . $mentor['profile_image'] ?>">
                <?php else : ?>
                    <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= base_url('assets/images/profile/') . 'default.jpg' ?>">
                <?php endif ?>
                <div class="card-footer text-muted">
                    <?= $mentor['id'] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8 text-left">
            <?= validation_errors() ?>
            <?= form_open('mentor/update/' . $mentor['id']) ?>
            <input type="hidden" name="id" value="<?= $mentor['id'] ?>" readonly>
            <fieldset>
                <!-- Mentor Name -->
                <div class="form-group">
                    <label>Mentor Name</label>
                    <input name="name" type="text" class="form-control form-control-lg" aria-describedby="" placeholder="Enter mentor name" value="<?= $mentor['name'] ?>">
                </div>
                <!-- Position -->
                <div class="form-group">
                    <label>Position</label>
                    <input name="position" type="text" class="form-control form-control-sm" aria-describedby="" placeholder="Enter position" value="<?= $mentor['position'] ?>">
                </div>
                <!-- Email -->
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control form-control-sm" aria-describedby="" placeholder="Enter position" value="<?= $mentor['email'] ?>">
                </div>
                <!-- SIG -->
                <div class="form-group">
                    <label>SIG</label>
                    <select name="sig_id" class="form-control form-control-sm">
                        <option value="" selected disabled hidden>Choose mentor</option>
                        <?php foreach ($sigs as $sig) : ?>
                            <option value="<?= $sig['id'] ?>" <?php
                                                                if ($sig['id'] == $mentor['sig_id']) {
                                                                    echo 'selected';
                                                                } ?>>
                                <?= $sig['signame'] . ' (' . $sig['code'] . ')'; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="orgrole_id" class="form-control form-control-sm">
                        <?php foreach ($roles as $role) : ?>
                            <option value="<?= $role['id'] ?>" <?php
                                                                if ($role['id'] == $mentor['orgrole_id']) {
                                                                    echo 'selected';
                                                                } ?>>
                                <?= $role['rolename'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <!-- Room -->
                <div class="form-group">
                    <label>Room</label>
                    <input name="roomnum" type="text" class="form-control form-control-sm" aria-describedby="" placeholder="Enter room" value="<?= $mentor['roomnum'] ?>">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </fieldset>
            <?= form_close() ?>
        </div>
        <div class="col-lg-4">
            <!-- <button type="submit" class="btn btn-primary">Update profile 2</button> -->
        </div>
        <div class="col-lg-8 text-left">
            <!-- <button type="submit" class="btn btn-primary">Update profile 2</button> -->
        </div>
    </div> <br>
</div>