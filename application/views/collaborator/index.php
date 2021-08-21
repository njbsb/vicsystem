<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Collaborator</li>
</ol>

<h2><?= $title ?></h2>
<br>
<a class="btn btn-outline-dark btn-sm" href="<?= base_url('collaborator/create') ?>">Create new collaborator</a>
<br><br>
<div class="card">
    <div class="card-body">
        <table class="table">
            <thead class="table-primary">
                <td>Logo</td>
                <td>Name</td>
                <td>Description</td>
                <td>Action</td>
            </thead>
            <tbody class="table-active">
                <?php if ($collaborators) : ?>
                <?php foreach ($collaborators as $collab) : ?>
                <?php $collabphoto = ($collab['logo']) ? $collab['logo'] : base_url('assets/images/collaborator/' . 'default.jpg') ?>
                <tr>
                    <td><img class="img-responsive" style="max-height:50px; max-width:50px; object-fit:cover; padding:6px;" src="<?= $collabphoto ?>"></td>
                    <td><?= $collab['name'] ?></td>
                    <td><?= $collab['description'] ?></td>
                    <td><a class="btn btn-sm btn-outline-dark" data-target="#editCollab" data-collab_name="<?= $collab['name'] ?>" data-collab_id="<?= $collab['id'] ?>"
                            data-collab_desc="<?= $collab['description'] ?>" data-toggle="modal" href=""><i class='fas fa-pen'></i></a></td>
                </tr>
                <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>
<small>This feature has not been made available yet.</small>

<div id="editCollab" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="submitTitle">Update Collaborator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('collaborator/update') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="collab_name" id="collab_name" class="form-control">
                    <input type="hidden" name="collab_id" id="collab_id">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="collab_desc" id="collab_desc" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Logo</label>
                    <input type="file" name="collab_logo" id="collab_logo" class="form-control">
                </div>

            </div>
            <div class="modal-footer">
                <button id="submitcollab" class="btn btn-dark" type="submit">Submit</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
var descTextArea = document.getElementById("collab_desc")
$('#editCollab').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('collab_id');
    var name = $(e.relatedTarget).data('collab_name');
    var desc = $(e.relatedTarget).data('collab_desc');
    descTextArea.innerText = desc;
    $(e.currentTarget).find('input[name="collab_name"]').val(name);
    $(e.currentTarget).find('input[name="collab_id"]').val(id);
});
var uploadField = document.getElementById("collab_logo");
uploadField.onchange = function() {
    if (this.files[0].size > 209715) {
        alert("File exceeds 200kb!");
        this.value = "";
    };
};
</script>