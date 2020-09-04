<h2 class="text-center"><?php echo $title; ?></h2>

<div class="container-fluid text-center">
    <div class="row">
        <div class="col-lg-4">
            <!-- <div class="card mb-3"> -->
            <div class="card border-light mb-3" style="max-width: 20rem;">
                <!-- <div class="card-header">Student</div> -->
                <!-- <h3 class="card-header">
                    Header
                </h3> -->
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;"
                    src="<?php echo base_url('assets/images/profile/justin.jpg'); ?>" alt="Card image">
                <!-- <div class="card-body">

                </div> -->
                <div class="card-footer text-muted">
                    Joined VIC: 2016
                </div>
            </div>

            <div class="form-group">
                <label>Select profile photo</label>
                <input name="photo_path" type="file" class="form-control-file" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">Choose a proper profile photo.</small>
            </div>

        </div>
        <div class="col-lg-8 text-left">
            <!-- <div class="bs-component">
            </div> -->
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name" value="Khairul Anuar" readonly>
            </div>
            <div class="form-group">
                <label>Select Program</label>
                <select name="sig_id" class="form-control" id="" disabled>
                    <option value="">
                        Video Innovation Club
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label>Program</label>
                <select name="program_code" class="form-control" id="" disabled>
                    <option value="">
                        Software Engineering
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label>Year</label>
                <input class="form-control" name="year" value="3" readonly>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input class="form-control" name="phonenum" value="013-8877343" readonly>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" value="a166666@siswa.ukm.edu.my" readonly>
            </div>
            <div class="form-group">
                <label>Mentor</label>
                <select name="mentor_matric" class="form-control" id="" readonly>
                    <option value="">
                        Pn Masura Rahmat
                    </option>
                </select>
            </div>


        </div>
    </div> <br>

    <!-- <h2>Previous Activity and Roles</h2> <br>
    <div class="card bg-light mb-3" style="">
        <div class="card-header">Treasurer</div>
        <div class="card-body">
            <h4 class="card-title">Short Film Competition 2019</h4>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
        </div>
    </div> -->
</div>