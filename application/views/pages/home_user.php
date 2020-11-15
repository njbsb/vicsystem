<!-- <h2><?= $title ?></h2> -->
<!-- <p>Welcome to SIG Integrated System</p> -->

<div class="jumbotron">
    <h1 class="display-3">Welcome to VIC System, <?= $user_name ?>!</h1>
    <p class="lead">This is a website to manage VIC System.</p>
    <hr class="my-4">
    <!-- <p>Insert Leaderboard/Dashboard here.</p> -->
    <p class="lead">
        <!-- <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> -->
    </p>

</div>
<!-- <blockquote class="blockquote text-center">
    <p class="mb-0">Biar orang buat kita, kita buat coding.</p>
    <footer class="blockquote-footer">NajibS</footer>
</blockquote> -->
<div class="jumbotron">
    <h4 class="text-center">Information Analytics</h4>
    <div class="row">
        <div class="col-sm-6">
            <label>Chart 1</label>
            <canvas id="myChart" responsive="true"></canvas>
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