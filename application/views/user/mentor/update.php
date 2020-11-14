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
                <?php $profile_image = ($mentor['profile_image']) ? $mentor['profile_image'] : 'default.jpg' ?>
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= base_url('assets/images/profile/' . $profile_image) ?>">
                <div class="card-footer text-muted">
                    <?= $mentor['id'] ?>
                </div>
            </div>

            <div class="form-group">
                <label>Select profile photo</label>
                <input name="profile_image" type="file" class="form-control-file" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted"><?= $profile_image ?></small>
            </div>

        </div>
        <div class="col-lg-8 text-left">
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name" value="<?= $mentor['name'] ?>" readonly>
            </div>
            <div class="form-group">
                <label>Position</label>
                <input class="form-control" name="name" value="<?= $mentor['position'] ?>" readonly>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="name" value="<?= $mentor['email'] ?>" readonly>
            </div>

            <div class="form-group">
                <label>SIG</label>
                <select name="sig_id" class="form-control" readonly>
                    <option value="<?= $mentor['sig_id'] ?>"><?= $mentor['signame'] ?></option>
                </select>
            </div>

            <div class="form-group">
                <label>Role in SIG</label>
                <select name="sigrole_id" class="form-control" readonly>
                    <option value="<?= $mentor['orgrole_id'] ?>"><?= $mentor['rolename'] ?></option>
                </select>
            </div>

            <div class="form-group">
                <label>Room Number</label>
                <input class="form-control" name="roomnum" value="<?= $mentor['roomnum'] ?>">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Update profile</button>
        </div>
    </div>
    <br>
    <?= form_close() ?>
</div>