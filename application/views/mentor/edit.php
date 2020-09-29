<h2><?= 'Mentor: ' . $mentor['name'] ?></h2>

<div class="container-fluid text-center">
    <div class="row">
        <div class="col-lg-4">
            <!-- <div class="card mb-3"> -->
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <!-- <div class="card-header">Student</div> -->
                <!-- <h3 class="card-header">
                    Header
                </h3> -->
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?php echo base_url('assets/images/profile/') . $mentor['profile_image']; ?>" alt="<?= $mentor['profile_image'] ?>">
                <!-- <div class="card-body">

                </div> -->
                <div class="card-footer text-muted">
                    Some text
                </div>
            </div>
        </div>
        <div class="col-lg-8 text-left">
            <?php echo validation_errors(); ?>
            <?php echo form_open('mentor/update/' . $mentor['matric']); ?>
            <input type="hidden" name="id" value="<?php echo $mentor['matric']; ?>" readonly>
            <fieldset>
                <!-- Mentor Name -->
                <div class="form-group">
                    <label>Mentor Name</label>
                    <input name="name" type="text" class="form-control form-control-lg" aria-describedby="" placeholder="Enter mentor name" value="<?php echo $mentor['name']; ?>">
                </div>
                <!-- Position -->
                <div class="form-group">
                    <label>Position</label>
                    <input name="position" type="text" class="form-control form-control-sm" aria-describedby="" placeholder="Enter position" value="<?php echo $mentor['position']; ?>">
                </div>
                <!-- Email -->
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control form-control-sm" aria-describedby="" placeholder="Enter position" value="<?php echo $mentor['email']; ?>">
                </div>
                <!-- SIG -->
                <div class="form-group">
                    <label>SIG</label>
                    <select name="sig_id" class="form-control form-control-sm">
                        <option value="" selected disabled hidden>Choose mentor</option>
                        <?php foreach ($sigs as $sig) : ?>
                            <option value="<?php echo $sig['id']; ?>" <?php
                                                                        if ($sig['id'] == $mentor['sig_id']) {
                                                                            echo 'selected';
                                                                        } ?>>
                                <?php echo $sig['signame'] . ' (' . $sig['code'] . ')'; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="orgrole_id" class="form-control form-control-sm">
                        <?php foreach ($roles as $role) : ?>
                            <option value="<?php echo $role['id']; ?>" <?php
                                                                        if ($role['id'] == $mentor['orgrole_id']) {
                                                                            echo 'selected';
                                                                        } ?>>
                                <?php echo $role['rolename']; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <!-- Room -->
                <div class="form-group">
                    <label>Room</label>
                    <input name="room" type="text" class="form-control form-control-sm" aria-describedby="" placeholder="Enter room" value="<?php echo $mentor['roomnum']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </fieldset>
            </form>
        </div>
        <div class="col-lg-4">
            <!-- <button type="submit" class="btn btn-primary">Update profile 2</button> -->
        </div>
        <div class="col-lg-8 text-left">
            <!-- <button type="submit" class="btn btn-primary">Update profile 2</button> -->
        </div>

    </div> <br>

    <!-- <h2>Previous Activities and Roles</h2> <br>
    <div class="card bg-light mb-3" style="">
        <div class="card-header">Advisor</div>
        <div class="card-body">
            <h4 class="card-title">Short Film Competition 2019</h4>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
        </div>
    </div> -->
</div>