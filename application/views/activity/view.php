<h2>Activity: <?= $activity['activity_name'] ?></h2>

<small>Activity created on <?= $activity['created_at']; ?></small><br>
<br>
<h6>Desc</h6>
<?= $activity['activity_desc'] ?>


<div class="container">

    <h6>SIG</h6>
    <p><?= $activity['signame'] ?></p>
    <h6>Venue</h6>
    <p><?= $activity['venue'] ?></p>
    <h6>Theme</h6>
    <p><?= $activity['theme'] ?></p>
    <h6>Date</h6>
    <p><?= $activity['datetime_start'] ?> to <?= $activity['datetime_end'] ?></p>
    <h6>Advisor</h6>
    <p><?= $activity['advisorname'] ?></p>
</div>

<hr>
<div class="row">
    <?= form_open('/activity/edit/' . $activity['slug']); ?>
    <input type="submit" value="Update" class="btn btn-outline-secondary">
    <?= form_close() ?>
    &nbsp;
    <?= form_open('/activity/delete/' . $activity['id']); ?>
    <input type="submit" value="Delete" class="btn btn-outline-danger" disabled>
    <?= form_close() ?>
</div>
<hr>

<div>

</div>