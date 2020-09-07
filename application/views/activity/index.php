<h2><?php echo $title ?> - Activity Index Page</h2><br>
<!-- <div class="container"> -->

<table class="table table-hover" style="text-align:left;">
    <thead>
        <tr class="table-primary">
            <th scope="col"></th>
            <th scope="col">Activity</th>
            <th scope="col">Date</th>
            <th scope="col">Academic Session</th>
            <th scope="col">Semester</th>
            <th scope="col">No of Committees</th>
            <th scope="col">Advisor</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($activities as $activity): ?>
        <tr>
            <td>
                <img style="max-height:100px;" src="<?php echo site_url() ?>assets/images/profile/default.png"
                    class="img-responsive" alt="Image">
            </td>
            <th scope="row"><?= $activity['activity_name'] ?></th>
            <td><?= date('d/m/Y', strtotime($activity['datetime_start'])) ?></td>
            <td><?= $activity['acadsession'] ?></td>
            <td><?= $activity['semester_fk']?></td>
            <td>No of com </td>
            <td><?= $activity['advisorname'] ?></td>
            <td><a class="btn btn-secondary btn-sm"
                    href="<?php echo site_url('/activity/'.$activity['slug']); ?>">Details</a></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<br>
<?php foreach($activities as $activity): ?>
<h3><?php echo $activity['activity_name']; ?></h3>
<small>Date: <?php echo $activity['datetime_start'] ?></small>

<br>
<p>
    <?php echo word_limiter($activity['activity_desc'], 10) ?>
</p>

<a class="btn btn-primary" href="<?php echo site_url('/activity/'.$activity['slug']); ?>">Read more...</a>
<br><br>
<?php endforeach ?>
<!-- </div> -->