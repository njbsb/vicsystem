<h2 class="text-center"><?= $title ?></h2>

<div class="container-fluid text-center">
    <?php $hidden = array('usertype_id' => $usertype) ?>
    <?= form_open_multipart('user/update/' . $student['id'], '', $hidden) ?>
    <div class="row">
        <div class="col-lg-4">

            <div class="card border-primary mb-3" style="max-width: 20rem;">
                <h4 class="card-header text-primary">
                    <b><?= ucfirst($student['usertype']) ?></b>
                </h4>
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= base_url('assets/images/profile/' . 'default.jpg') ?>">
                <div class="card-footer text-muted">
                    <?= $student['id'] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8 text-left">

            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name" value="<?= $student['name'] ?>" readonly>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" value="<?= $student['email'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="superior_id">Superior/Mentor</label>
                <input class="form-control" type="text" name="superior_id" id="superior_id" value="<?= $superior['name'] ?>" disabled>
            </div>
            <div class="form-group">
                <label>Program</label>
                <select name="program_id" class="form-control" id="" required>
                    <option value="" selected disabled>Select program</option>
                    <?php foreach ($programs as $program) : ?>
                    <?php $selected = ($program['code'] == $student['program_id']) ? 'selected readonly' : ''; ?>
                    <option value="<?= $program['code'] ?>" <?= $selected ?>><?= $program['program'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" class="form-control" name="phonenum" value="<?= $student['phonenum'] ?>" placeholder="01#-#######" required>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="parent1">Parent 1 Contact</label>
                        <input type="tel" name="parent1" class="form-control" id="" placeholder="01#-#######" value="<?= $student['parent_num1'] ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="parent2">Parent 2 Contact</label>
                        <input type="tel" name="parent2" class="form-control" id="" placeholder="01#-#######" value="<?= $student['parent_num2'] ?>" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Home address</label>
                <textarea name="address" class="form-control" id="" cols="30" rows="6" placeholder="Enter address" required><?= $student['address'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update profile</button>
        </div>
    </div>
    <?= form_close() ?>
</div>