<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>VIC System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/lux.bootstrap.min.css') ?>" media="screen">
    <link rel="stylesheet" href="<?= base_url('assets/css/jquery.dataTables.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dataTables.bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/sticky-footer.css') ?>" rel="stylesheet">
    <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.min.css"> -->

    <script src="http://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>
    <script src="<?= base_url('assets/js/dataTables.bootstrap.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/list.js') ?>"></script>

    <style>
        body {
            font: 14px Montserrat, sans-serif;
            line-height: 1.8;
            background-color: #cfcfc4;
        }

        table {
            max-width: 100%;
        }

        .btn {
            font: 12px Montserrat, sans-serif;
            text-transform: none;
        }

        input {
            font: 14px Montserrat, sans-serif;
        }

        /* h2 {
            font: 20px Montserrat, sans-serif;
        } */

        .margin {
            margin-bottom: 35px;
        }

        .container-fluid {
            /* padding-top: 25px;
            padding-bottom: 25px; */
            margin-top: 25px;
            margin-bottom: 25px;
        }
    </style>


</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url(); ?>">VIC System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('profile') ?>">Profile <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('mentor') ?>">Mentors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('student') ?>">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('organization') ?>">SIG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('activity') ?>">Activity</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Academic</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= site_url('academic') ?>">Academic ControlPanel</a>
                            <a class="dropdown-item" href="<?= site_url('academicplan') ?>">Academic Plan</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url() ?>user">Users</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Scoring</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= site_url('score') ?>">Score</a>
                            <a class="dropdown-item" href="<?= site_url('scoreplan') ?>">Scoring Plan</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Register</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= site_url('activity/create') ?>">Activity</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= site_url('collaborator') ?>">Collaborator</a>
                            <a class="dropdown-item" href="<?= site_url('citra') ?>">Citra</a>
                            <a class="dropdown-item" href="<?= site_url('category') ?>">Comment Category</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url() ?>login">Login <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Account</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= site_url('academicplan') ?>">Academic Plan</a>
                    <a class="dropdown-item" href="<?= site_url('profile/update') ?>">Update Profile</a>
                    <a class="dropdown-item" href="#">Log Out</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Switch Account</a>
                </div>
            </li>
        </ul>

    </nav>

    <div class="container">
        <br>