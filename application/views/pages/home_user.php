<!-- <h2><?= $title ?></h2> -->
<!-- <p>Welcome to SIG Integrated System</p> -->
<div class="jumbotron bg-white">
    <h5 class="text-right text-muted"><b>Today is <?= date("jS F Y (l)") ?></b></h5>
    <h1 class="display-3">Welcome to VIC System, <?= $user_name ?>!</h1>
    <p class="lead">This is a website to manage VIC System.</p>
    <hr class="my-4">
    <p class="lead">
    </p>
</div>
<h3 class="text-center">Information Analytics</h3>
<div class="jumbotron bg-muted" style="border-radius: 16px">
    <div class="row">
        <div class="col-sm-6">
            <h5>Current Academic Session: <?= $activesession['academicsession'] ?></h5>
        </div>
        <div class="col-sm-6">
            <label>Chart 1</label>
            <canvas id="myChart" responsive="true"></canvas>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="jumbotron jumbotron-fluid" style="border-radius: 12px; padding-top: 20px;">
            <div class="container">
                <h5 class="text-center text-primary"><b>&#127881; &#127882; Member's Birthday &#127874; &#127873;</b></h5>
                <hr class="my-2">
                <p>Celebrating our <b><?= date("F") ?></b> babies! &#127874; &#127873;</p>
                <p>
                    <?php foreach($birthdaymembers as $index=>$member): ?>
                    <?= $index+1 ?>. <?= $member['name'] ?> (<?= date_format(date_create($member['dob']),'j/n') ?>)<br>
                    <?php endforeach ?>
                </p>
                <p class="lead">
                    <a class="btn btn-primary btn-sm" href="Jumbo action link" role="button">Jumbo action name</a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="jumbotron jumbotron-fluid" style="border-radius: 12px; padding-top: 20px;">
            <div class="container">
                <h5 class="text-left text-dark"><b>Academic Year: <?= $activesession['academicsession'] ?></b></h5>
                <hr class="my-2">
                <p><b>Upcoming activities this semester:</b></p>
                <p>
                    <?php foreach($upcomingactivities as $key => $activity): ?>
                    <?= $key+1 ?>. <?= $activity['activity_name'] ?> (<?= date_format(date_create($activity['datetime_start']),'j/n') ?>) <br>
                    <?php endforeach ?>
                </p>
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
                        <?php foreach($upcomingactivities as $key => $activity): ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $activity['activity_name'] ?></td>
                            <td><?= date_format(date_create($activity['datetime_start']),'j-n-Y') ?></td>
                            <td><?= $activity['diff'] ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <p class="lead">
                    <a class="btn btn-primary btn-md btn-hover" href="activity" role="button">Go to activities</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
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
</script>