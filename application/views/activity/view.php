<h2><?= $activity['activity_name'] ?></h2>

<small>Activity created on <?php echo $activity['created_at']; ?></small><br>

<div class="post-body">
    <p><?php echo $activity['activity_desc']; ?></p>
</div>
<hr>
<div class="row">
    <?php echo form_open('/activity/edit/'.$activity['slug']); ?>
    <input type="submit" value="Update" class="btn btn-secondary">
    </form>
    &nbsp;
    <?php echo form_open('/activity/delete/'.$activity['id']); ?>
    <input type="submit" value="Delete" class="btn btn-danger" disabled>
    </form>
</div>
<hr>

<h4>Comments</h4>

<?php if($comments): ?>
<?php foreach($comments as $comment): ?>
<div class="alert alert-dismissible alert-light">
    <h6><?php echo $comment['comment'] ?> [by <strong><?php echo $comment['student_matric_fk']; ?></strong>]</h6>
</div>
<?php endforeach ?>
<?php else: ?>
<p>No comments for this activity</p>
<?php endif ?>
<hr>

<h4>Add comment</h4>
<?php echo validation_errors(); ?>
<?php echo form_open('comment/create/'.$activity['id']); ?>

<div class="form-group">
    <label>Name/Matric</label>
    <input type="text" name="matric" value="A166666" class="form-control" readonly>
</div>
<div class="form-group">
    <label>Comment</label>
    <textarea name="comment" class="form-control" rows="3" required="required"></textarea>
</div>
<input type="hidden" name="slug" value="<?php echo $activity['slug']; ?>">
<button class="btn btn-primary" type="submit">Submit comment</button>