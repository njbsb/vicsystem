<!-- <h2 class="text-center"><?= $title ?></h2> -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('profile') ?>">Profile</a></li>
    <li class="breadcrumb-item active">Update</li>
</ol>
<div class="container-fluid">
    <?= form_open_multipart('user/update/' . $mentor['id']) ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card border-dark mb-3 text-center" style="max-width: 20rem;">
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= $mentor['userphoto'] ?>">
                <div class="card-footer text-muted">
                    <?= $mentor['id'] ?>
                </div>
            </div>

            <div class="form-group">
                <label for="formFile" class="form-label mt-4">Upload photo</label>
                <input name="userphoto" class="form-control" type="file" id="userphoto" accept="image/*">
            </div>
            <small>Please use square cropped photo less than 200kb</small>
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
                    <?php $selected = ($role['id'] == $mentor['role_id']) ? 'selected' : '' ?>
                    <option value="<?= $role['id'] ?>" <?= $selected ?>><?= $role['role'] ?></option>
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
            <div class="form-group">
                <label>Phone Number</label>
                <input class="form-control" name="phonenum" value="<?= $mentor['phonenum'] ?>" placeholder="e.g: 012-3456789" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
    <br>
    <?= form_close() ?>
</div>

<script>
var uploadField = document.getElementById("userphoto");

uploadField.onchange = function() {
    if (this.files[0].size > 209715) {
        alert("File exceeds 200kb!");
        this.value = "";
    };
};
</script>