<h2 class="text-center"><?= $title ?></h2>

<div class="container-fluid text-center">
    <?= form_open_multipart('user/update/' . $mentor['id']) ?>
    <div class="row">
        <div class="col-lg-4">
            <!-- <div class="card mb-3"> -->
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <!-- <div class="card-header">Student</div> -->
                <!-- <h3 class="card-header">
                    Header
                </h3> -->
                <?php $profile_image = (isset($mentor['profile_image'])) ? $mentor['profile_image'] : 'default.jpg' ?>
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= base_url('assets/images/profile/' . $profile_image) ?>">
                <div class="card-footer text-muted">
                    <?= $mentor['id'] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8 text-left">
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name" value="<?= $mentor['name'] ?>" readonly>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" value="<?= $mentor['email'] ?>" readonly>
            </div>
            <div class="form-group">
                <label>Role in SIG</label>
                <select name="role_id" class="form-control" required>
                    <option value="" disabled selected>Select a role in SIG</option>
                    <?php foreach ($roles as $role) : ?>
                    <option value="<?= $role['id'] ?>"><?= $role['role'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label>Position</label>
                <input class="form-control" name="position" value="<?= $mentor['position'] ?>" placeholder="e.g: lecturer" required>
            </div>
            <div class="form-group">
                <label>Room Number</label>
                <input class="form-control" name="roomnum" value="<?= $mentor['roomnum'] ?>" placeholder="e.g: E-01-01" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Update profile</button>
        </div>
    </div>
    <br>
    <?= form_close() ?>
</div>