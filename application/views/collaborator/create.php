<h2><?= $title ?></h2>

<?php if (validation_errors()) : ?>
    <div class="alert alert-dismissible alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4 class="alert-heading">Warning!</h4>
        <p class="mb-0"><?= validation_errors() ?></p>
        <p class="mb-0"><?= $error  ?></p>
    </div>
<?php endif ?>

<?= form_open_multipart('collaborator/create') ?>
<div class="form-group">
    <label for="name">Collaborator Name</label>
    <input name="name" type="text" class="form-control">
</div>
<div class="form-group">
    <label for="background">Background</label>
    <textarea name="background" type="text" class="form-control"></textarea>
</div>
<div class="form-group">
    <label for="logo">Logo</label>
    <input type="file" class="form-control-file" id="logo" name="logo" aria-describedby="fileHelp"=>
    <small id="fileHelp" class="form-text text-muted">Insert collaborator logo if available</small>
</div>

<input type="submit" value="Create" class="btn btn-dark">
<?= form_close() ?>