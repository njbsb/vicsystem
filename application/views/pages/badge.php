<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Badges</li>
</ol>
<hr>
<!-- <div class="container">
    <?php if ($images) : ?>
    <?php foreach ($images as $image) : ?>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body"></div>
        </div>
    </div>
    <?php endforeach ?>
    <?php endif ?>
</div> -->
<div class="card">
    <div class="card-body">
        <button data-toggle="modal" data-target="#addimage" class="btn btn-info"><i class='fab fa-edge'></i> New</button>
        <br>
        <br>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <td>No</td>
                    <td></td>
                    <td>File Name</td>
                    <td>Edit</td>
                </tr>
            </thead>
            <tbody class="table-active">
                <?php foreach ($images as $i => $image) : ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><img src="<?= $image['photo'] ?>" alt="" width="40" height="40"></td>
                        <td>
                            <?= $image['title'] ?>
                        </td>
                        <td><button data-toggle="modal" data-id="<?= $image['id'] ?>" data-target="#editimage" data-name="<?= $image['title'] ?>" data-photo="<?= $image['photo'] ?>" class="btn btn-sm btn-outline-dark"><i class='fas fa-pen'></i></button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<div id="addimage" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open_multipart('createimage') ?>
            <div class="modal-header">
                <h5 class="modal-title">Create Badge</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label id="" for="newtitle">Title</label>
                    <input id="newtitle" name="newtitle" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="newfile">Image</label>
                    <input id="newfile" name="newfile" type="file" class="form-control" accept="image/*" required>
                </div>
                <small>Please use file less than 200kb</small>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Create</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<div id="editimage" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open_multipart('updateimage') ?>
            <div class="modal-header">
                <h5 class="modal-title">Edit Badge</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label id="" for="edittitle">Title</label>
                    <input id="editid" name="editid" type="" id="editid" hidden>
                    <input id="edittitle" name="edittitle" value="" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="editfile">Image</label>
                    <input id="editfile" name="editfile" type="file" class="form-control" accept="image/*">
                </div>
                <small>Please use file less than 200kb</small>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $('#editimage').on('show.bs.modal', function(e) {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var photo = $(e.relatedTarget).data('photo');
        $(e.currentTarget).find('input[name="editid"]').val(id);
        $(e.currentTarget).find('input[name="edittitle"]').val(name);
        // $(e.currentTarget).find('input[name="editfile"]').val(photo);
    });
    $('#editimage').on('hide.bs.modal', function(e) {});

    var editfile = document.getElementById("editfile");
    var newfile = document.getElementById("newfile");

    newfile.onchange = function() {
        if (this.files[0].size > 209715) {
            alert("File exceeds 200kb!");
            this.value = "";
        };
    };
    editfile.onchange = function() {
        if (this.files[0].size > 209715) {
            alert("File exceeds 200kb!");
            this.value = "";
        };
    };
</script>