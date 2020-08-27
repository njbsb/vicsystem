<h2><?php echo $title ?> - Activity Index Page</h2>
<div class="container">

    <?php foreach($activities as $activity): ?>
    <h3>
        <?php echo $activity['activity_name']; ?>
    </h3>
    <small>
        Date: <?php echo $activity['datetime_start'] ?>
    </small>
    <br>
    <p>
        <?php echo $activity['activity_desc'] ?>
    </p>

    <a href="#">Read more...</a>
    <br><br>
    <?php endforeach ?>
</div>