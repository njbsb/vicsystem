<html>

<head>
    <title>SIG System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/flatly.bootstrap.min.css">
    <style>
    /* body {
        font: 20px Montserrat, sans-serif;
        line-height: 1.8;
    }

    p {
        font-size: 16px;
    } */

    .margin {
        margin-bottom: 35px;
    }

    .container-fluid {
        padding-top: 50px;
        padding-bottom: 50px;
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">SIG Integrated System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03"
                aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url(); ?>profile">My Profile <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>mentors">My Mentors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>students">My Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>organization">My SIG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>activity">Activity</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>citra">Citra</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">Register</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo base_url(); ?>students/register">Student</a>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>mentors/register">Mentor</a>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>activity/create">Activity</a>
                            <!-- <a class="dropdown-item" href="#">Score</a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>score">Score</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>

            </div>
        </div>

        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">Account</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Update Profile</a>
                    <a class="dropdown-item" href="#">Log Out</a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Switch Account</a>
                </div>
            </li>
        </ul>

    </nav>

    <div class="container">
        <br>