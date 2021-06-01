<ol class="breadcrumb">
    <li class="breadcrumb-item active">Home</li>
</ol>

<div class="card">
    <div class="card-body">
        <h5>Hello</h5>
    </div>
</div>

<div class="jumbotron bg-white" style="padding-bottom: 0px;">
    <h5 class="text-right text-muted"><b>Today is <?= date("jS F Y (l)") ?></b></h5>
    <h1 class="display-3">Welcome, <?= $user_name ?>!</h1>
    <p class="lead">This is a website to manage VIC Information and Activities</p>
    <?php if (!$profileComplete) : ?>
    <p>We have detected that you have not completed your profile. Update your profile information <a href="<?= base_url("/profile/update") ?>">here</a></p>
    <?php endif ?>
    <hr class="my-4">
    <p class="lead">
    </p>
</div>
<h3 class="text-center">Information Analytics</h3>
<br>
<div class="jumbotron bg-muted" style="border-radius: 16px">
    <div class="row">
        <div class="col-sm-6">
            <label for=""><b>VIC Member Count: <?= $total_count ?></b></label>
            <canvas responsive="true" id="pieChart"></canvas>
        </div>
        <div class="col-sm-6">
            <label>VIC Intake by Year</label>
            <canvas id="barChart" responsive="true"></canvas>
        </div>
        <!-- <div class="col-sm-6">
            <div id="apexchart">

            </div>
        </div> -->
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="jumbotron jumbotron-fluid" style="border-radius: 12px; padding-top: 20px; padding-bottom: 20px;">
            <div class="container">
                <h5 class="text-center text-primary"><b>&#127881; &#127882; Member's Birthday &#127874; &#127873;</b></h5>
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
    </div>
    <div class="col-md-8">
        <div class="jumbotron jumbotron-fluid" style="border-radius: 12px; padding-top: 20px; padding-bottom: 20px;">
            <div class="container">
                <h5 class="text-left text-primary"><b>Current Academic Session: <?= $activesession['academicsession'] ?></b></h5>
                <hr class="my-2">
                <p>Upcoming activities this semester:</p>
                <!-- <p>
                    <?php foreach ($upcomingactivities as $key => $activity) : ?>
                    <?= $key + 1 ?>. <?= $activity['title'] ?> (<?= date_format(date_create($activity['datetime_start']), 'j/n') ?>) <br>
                    <?php endforeach ?>
                </p> -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-primary">
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

<script>
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
<script>
var apexoptions = {
    series: [44, 55, 41, 17, 15],
    chart: {
        type: 'donut',
    },
    colors: ['rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
    ],
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
};

var apexchart = new ApexCharts(document.querySelector("#apexchart"), apexoptions);
apexchart.render();
</script>