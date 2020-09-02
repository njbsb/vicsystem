<h2><?= $activity['activity_name'] ?></h2>

<small>Activity started on <?php echo $activity['datetime_start']; ?></small><br>

<div class="post-body">
    <p><?php echo $activity['activity_desc']; ?></p>
</div>
<hr>
<?php echo form_open('/activity/edit/'.$activity['slug']); ?>
<input type="submit" value="Update" class="btn btn-secondary">
</form>

<?php echo form_open('/activity/delete/'.$activity['id']); ?>
<input type="submit" value="Delete" class="btn btn-danger">
</form>

<!-- <button type="button" class="btn btn-secondary">Edit</button>
<button type="button" class="btn btn-danger">Delete</button> -->