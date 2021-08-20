<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="<?= base_url('assets/images/vicicon.ico') ?>" type="image/ico">
    <meta charset="utf-8">
    <title>VIC System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/flatly.bootstrap.min.css') ?>">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.23.0/themes/prism-okaidia.min.css"
        integrity="sha512-mIs9kKbaw6JZFfSuo+MovjU+Ntggfoj8RwAmJbVXQ5mkAX5LlgETQEweFPI18humSPHymTb5iikEOKWF7I8ncQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/dff01397e8.js" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <!-- CK Editor -->
    <script src="http://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
        crossorigin="anonymous"></script>
    <!-- HighChart JS -->
    <script src="https://code.highcharts.com/highcharts.src.js"></script>

    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="<?= base_url('assets/js/paging.js') ?>"></script>

    <!-- Datatable JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

</head>

<body>
    <?php $usertype =  $this->session->userdata('user_type') ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a href="<?= site_url() ?>"><img class="" style="object-fit:cover;" height="40px" width="40px" src="<?= base_url('assets/images/logo.png') ?>" alt=""></a>
            <?php if ($this->session->userdata('logged_in')) : ?>
            <a class="navbar-brand" href="<?= site_url() ?>">VIC System</a>
            <?php endif ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php if ($this->session->userdata('logged_in')) : ?>
            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">SIG</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= site_url('organization') ?>">Organization</a>
                            <a class="dropdown-item" href="<?= site_url('mentor') ?>">Mentors</a>
                            <?php if ($usertype == 'student') : ?>
                            <?php else : ?>
                            <a class="dropdown-item" href="<?= site_url('student') ?>">Students</a>
                            <?php endif ?>
                            <a class="dropdown-item" href="<?= site_url('activity') ?>">Activities</a>
                            <a class="dropdown-item" href="<?= site_url('activity/external') ?>">External Activity</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Academic</a>
                        <div class="dropdown-menu">
                            <?php if ($usertype != 'student') : ?>
                            <a class="dropdown-item" href="<?= site_url('enroll') ?>">Enroll Students</a>
                            <?php endif ?>
                            <?php $academictitle = ($usertype !=  'student') ? 'Academic Records' : 'Academic Plan' ?>
                            <a class="dropdown-item" href="<?= site_url('academic') ?>"><?= $academictitle ?></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">Score</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= site_url('scoreboard') ?>">Score Board</a>
                            <a class="dropdown-item" href="<?= site_url('badgeboard') ?>">Badge Board</a>
                            <?php if ($usertype != 'student') : ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= site_url('scoreplan') ?>">Score Plan</a>
                            <a class="dropdown-item" href="<?= site_url('score') ?>">Submit Score</a>
                            <?php endif ?>
                        </div>
                    </li>
                    <?php if ($usertype != 'student') : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">Admin</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= site_url('user') ?>">Users</a>
                            <a class="dropdown-item" href="<?= site_url('academic/control') ?>">Academic</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Others</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= site_url('citra') ?>">Citra</a>
                            <a class="dropdown-item" href="<?= site_url('collaborator') ?>">Collaborator</a>
                            <a class="dropdown-item" href="<?= site_url('filelink') ?>">File Links</a>
                            <a class="dropdown-item" href="<?= site_url('badge') ?>">Badges</a>
                        </div>
                    </li>
                    <?php endif ?>
                </ul>
            </div>
            <?php endif ?>
        </div>

        <ul class="navbar-nav mr-auto">
            <?php if ($this->session->userdata('logged_in')) : ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?= $this->session->userdata('username') ?></a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= site_url('profile') ?>">Profile <span class="sr-only">(current)</span></a>
                    <a class="dropdown-item" href="<?= site_url('changepassword') ?>">Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= site_url('logout') ?>">Log Out</a>
                </div>
            </li>
            <li>
                <img class="rounded-circle" style="object-fit:cover;" height="40px" width="40px" src="<?= $this->session->userdata('userphoto') ?>" alt="">
            </li>
            <?php else : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('login') ?>">Sign In<span class="sr-only">(current)</span></a>
            </li>
            <?php endif ?>

        </ul>

    </nav>

    <div id="main" class="container">
        <br>
        <?php if ($this->session->flashdata('login_failed')) : ?>
        <!-- <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Oh snap!</strong> <?= $this->session->flashdata('login_failed') ?>
        </div> -->
        <?php endif ?>
        <?php if ($this->session->flashdata('user_loggedin')) : ?>
        <!-- <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Welcome!</strong> <?= $this->session->flashdata('user_loggedin') ?>
        </div> -->
        <?php endif ?>
        <?php if ($this->session->flashdata('logged_out')) : ?>
        <!-- <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong></strong> <?= $this->session->flashdata('logged_out') ?>
        </div> -->
        <?php endif ?>