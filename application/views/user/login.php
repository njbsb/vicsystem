<?php if (validation_errors()) : ?>
<div class="alert alert-dismissible alert-secondary">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h6 class="alert-heading">Oops!</h6>
    <p class="mb-0"><?= validation_errors() ?></p>
</div>
<?php endif ?>
<div class="row justify-content-md-center">
    <div class="col-md-4 col-md-offset-4 text-center">
        <?= form_open('user/login') ?>
        <h3 class="text-center"><?= $title ?></h3>
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Enter ID" required autofocus>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Enter Password" required autofocus>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
        <?= form_close() ?>
        <a href="#chooseUser" data-toggle="modal" class="">
            Register here
        </a>
    </div>
</div>

<div id="chooseUser" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Choose user type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>You are a:</p>
                <?= form_open('register') ?>
                <button name="usertype" type="submit" class="btn btn-primary" value="student">Student</button>&nbsp;
                <button name="usertype" type="submit" class="btn btn-primary" value="mentor">Mentor</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>