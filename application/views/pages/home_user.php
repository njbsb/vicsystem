<ol class="breadcrumb">
    <li class="breadcrumb-item active">Home</li>
</ol>

<div class="card" style="padding-bottom: 0px; padding-top: 1rem;">
    <div class="card-body">
        <h5 class="text-right text-white"><b>Today is <?= date("jS F Y (l)") ?></b></h5>
        <h1 class="display-4">Welcome, <?= $user_name ?>!</h1>
        <!-- <?php if (!$profileComplete) : ?>
    <p>We have detected that you have not completed your profile. Update your profile information <a href="<?= base_url("/profile/update") ?>">here</a></p>
    <?php endif ?> -->
        <hr class="my-4">
        <p class="lead">
        </p>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-3 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                    <img class="rounded-circle img-circle" src="<?= $user['userphoto'] ?>" alt="" width="150" height="150">
                    <div class="mt-3">
                        <h4><?= $this->session->userdata('username') ?></h4>
                        <p class="text-primary mb-1"><?= $user_name ?></p>
                        <p class="text-primary font-size-sm">Video Innovation Club</p>
                        <a class="btn btn-primary" href="<?= site_url('profile') ?>">Profile</a>
                        <a class="btn btn-outline-primary" href="<?= site_url('profile/update') ?>">Edit</a>
                    </div>

                </div>
            </div>
        </div>
        <?php if (!$profileComplete) : ?>
        <br>
        <p class="text-center text-warning"><b>Attention</b></p>
        <p>We have detected that you have not completed your <?= $this->session->userdata('user_type') ?> profile. Go to Profile -> Edit to update.</p>
        <?php endif ?>
        <br>
        <div class="card" style="border-radius: 12px">
            <div class="card-body text-center">
                <p>Link to VIC SharePoint site</p>
                <a class="btn btn-success" target="_blank" href="https://ukmedumy.sharepoint.com/sites/vicftsm">SharePoint</a>
            </div>
        </div>
        <hr>
    </div>
    <div class="col-md-9 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="">VIC Member Count: <?= $total_count ?></label>
                        <canvas responsive="true" id="pieChart"></canvas>
                        <small>*All students in record</small>
                    </div>
                    <div class="col-sm-6">
                        <label>VIC Intake by Year</label>
                        <canvas id="barChart" responsive="true"></canvas>
                        <small>*4 years back only</small>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center text-primary"><b>&#127881; Birthdays &#127873;</b></h5>
                        <hr class="my-2">
                        <p>Celebrating our <b><?= date("F") ?></b> babies! &#127874; &#127873;</p>
                        <p>
                            <?php foreach ($birthdaymembers as $index => $member) : ?>
                            <?= $index + 1 ?>. <?= $member['name'] ?> (<?= date_format(date_create($member['dob']), 'j/n') ?>)<br>
                            <?php endforeach ?>
                        </p>
                        <p class="lead">
                            <a class="btn btn-primary btn-sm" href="#" role="button">Send a wish!</a>
                        </p>
                    </div>
                </div>
                <br>
            </div>
            <div class="col-md-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <?php $academicsession = ($activesession) ? $activesession['academicsession'] : '?' ?>
                        <h5 class="text-left text-primary"><b>Current Academic Session: <?= $academicsession ?></b></h5>
                        <hr class="my-2">
                        <p>Upcoming activities this semester:</p>
                        <div class="table-responsive">
                            <table id="upcomingactivity" class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Activity</th>
                                        <th>Date</th>
                                        <th>Days left</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($upcomingactivities as $key => $activity) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $activity['title'] ?></td>
                                        <td><?= date_format(date_create($activity['datetime_start']), 'j-n-Y') ?></td>
                                        <td><?= $activity['diff'] ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <p class="lead">
                            <a class="btn btn-primary btn-md btn-hover" href="activity" role="button">Go to activities</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="defaultpassword" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Welcome!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <h5 class="text-warning">But Warning</h5> -->
                <p>You just logged in using the default password. Kindly proceed to change your password first.</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="<?= site_url('changepassword') ?>" class="btn btn-primary">Change my password</a>
            </div>
        </div>
    </div>
</div>

<script>
var defaultpassword = <?= json_encode($defaultpassword) ?>;
if (defaultpassword) {
    $("#defaultpassword").modal()
}
var pieC = document.getElementById('pieChart').getContext('2d');
var bData = JSON.parse(`<?php echo $barchart_data; ?>`);
var btx = document.getElementById('barChart').getContext('2d');
var barChart = new Chart(btx, {
    type: 'bar',
    data: {
        labels: bData.label,
        datasets: [{
            label: '# of Intake',
            data: bData.data,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

$(function() {
    //get the pie chart canvas
    var cData = JSON.parse(`<?php echo $chart_data; ?>`);
    // var ctx = $("#pie-chart");
    var ctx = document.getElementById('pieChart').getContext('2d');

    //pie chart data
    var data = {
        labels: cData.label,
        datasets: [{
            label: "Users Count",
            data: cData.data,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: [1, 1, 1, 1, 1, 1, 1]
        }]
    };

    //options
    var options = {
        responsive: true,
        // title: {
        //     display: true,
        //     position: "top",
        //     text: "Program Count",
        //     fontSize: 18,
        //     fontColor: "#404040"
        // },
        legend: {
            display: true,
            position: "bottom",
            labels: {
                fontColor: "#333",
                fontSize: 12
            }
        }
    };

    //create Pie Chart class object
    var chart1 = new Chart(ctx, {
        type: "doughnut",
        data: data,
        options: options
    });

});
</script>