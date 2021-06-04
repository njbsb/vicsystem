<h4><?= $title ?></h4>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart('category/create'); ?>
<div class="form-group">
    <label for="category">Category Name</label>
    <input class="form-control" type="text" name="category" id="category" placeholder="Enter category name">
</div>
<button type="submit" class="btn btn-dark btn-default">Submit</button>
</form>