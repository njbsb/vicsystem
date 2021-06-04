<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active"><?= $title ?></li>
</ol>

<h4><?= $title ?></h4>

<div class="card">
    <div class="card-body">
        <button data-toggle="modal" data-target="#createlink" class="btn btn-dark"><i class='fab fa-edge'></i> New</button>
        <br>
        <br>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <td>No</td>
                    <td>File Name</td>
                    <td>Edit</td>
                </tr>
            </thead>
            <tbody class="table-active">
                <?php foreach ($templates as $i => $template) : ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td>
                            <?= $template['name'] ?>
                        </td>
                        <td><a href="<?= $template['path'] ?>" target="_blank" class="btn btn-sm btn-outline-dark"><i class='fas fa-search'></i></a> <button data-toggle="modal" data-id="<?= $template['id'] ?>" data-target="#editlink" data-name="<?= $template['name'] ?>" data-path="<?= $template['path'] ?>" class="btn btn-sm btn-outline-dark"><i class='fas fa-pen'></i></button> <a data-toggle="modal" data-target="#deletelink" data-name="<?= $template['name'] ?>" data-id="<?= $template['id'] ?>" href="" class="btn btn-sm btn-outline-dark"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<div id="editlink" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('updatelink') ?>
            <div class="modal-header">
                <h5 class="modal-title">Update Link</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label id="editlabel" for="editname">Title</label>
                    <input id="editname" name="editname" type="text" class="form-control" required>
                    <input id="editid" name="editid" type="text" class="form-control" hidden required>
                </div>
                <div class="form-group">
                    <label for="editpath">Path</label>
                    <input id="editpath" name="editpath" type="text" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark">Update</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<div id="createlink" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('createlink') ?>
            <div class="modal-header">
                <h5 class="modal-title">Create Link</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label id="newname" for="newname">Title</label>
                    <input id="newname" name="newname" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="newpath">Path</label>
                    <input id="newpath" name="newpath" type="text" class="form-control" required>
                </div>
                <small>Please include "https://" before any link</small>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark">Create</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<div id="deletelink" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('deletelink') ?>
            <div class="modal-header">
                <h5 class="modal-title">Delete Link</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Confirm to delete this link?</p>
                <h6 class="text-center" id="deletename"></h6>
                <div class="form-group">
                    <input id="deleteid" name="deleteid" type="text" class="form-control" required hidden>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    var deletename = document.getElementById('deletename');
    $('#editlink').on('show.bs.modal', function(e) {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var path = $(e.relatedTarget).data('path');
        $(e.currentTarget).find('input[name="editid"]').val(id);
        $(e.currentTarget).find('input[name="editname"]').val(name);
        $(e.currentTarget).find('input[name="editpath"]').val(path);
    });
    $('#editlink').on('hide.bs.modal', function(e) {});
    $('#deletelink').on('show.bs.modal', function(e) {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        deletename.innerHTML = name;
        $(e.currentTarget).find('input[name="deleteid"]').val(id);
    });
    $('#deletelink').on('hide.bs.modal', function(e) {
        deletename.innerHTML = '';
    });
</script>