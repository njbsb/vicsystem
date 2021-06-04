<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">User</li>
</ol>
<h2 class="text-primary text-center margin"><?= $title ?></h2>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="usertable" class="table table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th class="text-left">ID</th>
                        <th class="text-left">Name</th>
                        <th>User type</th>
                        <th>Uni Status</th>
                        <th>Validation</th>
                        <th>Profile</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-light">
                    <?php if ($users) : ?>
                        <?php foreach ($users as $user) : ?>
                            <?php $statusclass = ($user['validated']) ? 'text-success' : 'text-warning' ?>
                            <?php $profileclass = ($user['profileexist']) ? 'text-success' : 'text-danger' ?>
                            <tr>
                                <td class="text-left"><?= $user['id'] ?></td>
                                <td class="text-left"><?= $user['name'] ?></td>
                                <td><?= $user['usertype'] ?></td>
                                <td><?= $user['unistatus'] ?></td>
                                <td class="<?= $statusclass ?>"><?= $user['validationstatus'] ?></td>
                                <td data-toggle="tooltip" data-placement="left" title="<?= $user['profilestatus'] ?>" class="<?= $profileclass ?> text-center"><?= $user['profileicon'] ?></td>
                                <td class="text-right">
                                    <a class="btn btn-sm btn-outline-dark" href="<?= site_url('validate/') . $user['id'] ?>"><i class='fas fa-pen'></i></a>
                                    <?php if ($user['id'] != $this->session->userdata('username')) : ?>
                                        <a class="btn btn-sm btn-outline-danger" data-toggle="modal" data-profileexist="<?= $user['profileexist'] ?>" data-userid="<?= $user['id'] ?>" onclick="$('#confirmDelete #formDelete').attr('action', '<?= site_url('user/delete/' . $user['id']) ?>')" href="#confirmDelete"><i class='fas fa-trash-alt'></i></a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>User type</td>
                        <td>Status</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <br>
        <?php if ($users) : ?>
            <a class="btn btn-success" href="<?= site_url('user/download') ?>" target="_blank"><i class='fas fa-file-excel'></i> Download</a>
        <?php endif ?>
    </div>
</div>
<br>
<div class="card">
    <div class="container">
        <?= form_open_multipart('user/upload') ?>
        <div class="row">
            <div class="col-md-8 col-lg-6">
                <div class="form-group">
                    <label for="formFile" class="form-label mt-4">Upload new users/students by batch</label>
                    <input class="form-control" type="file" name="upload_file" id="upload_file" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-dark" type="submit"><i class='fas fa-upload'></i> Upload</button>
        </div>
        <small>Get user upload template <a href="<?= site_url('filelink') ?>">here</a></small>
        <?= form_close() ?>
    </div>
</div>

<div id="confirmDelete" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="confirmtext">Are you sure to delete this user?</p>
            </div>
            <div class="modal-footer">
                <form id="formDelete" action="" method="post">
                    <button id="confirmdeletebtn" type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#usertable').DataTable({
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });
    });
    var confirmtext = document.getElementById('confirmtext');
    var confirmdeletebtn = document.getElementById('confirmdeletebtn');
    $('#confirmDelete').on('show.bs.modal', function(e) {
        var profileExist = $(e.relatedTarget).data('profileexist');
        var userid = $(e.relatedTarget).data('userid');
        if (!profileExist) {
            confirmtext.innerHTML = 'Are you sure to delete this user?' + ' <b>(' + userid + ')</b>';
            confirmdeletebtn.disabled = false;
        } else {
            confirmtext.innerHTML = 'This user has completed his/her profile. You can no longer delete this user.';
            confirmdeletebtn.disabled = true;
        }
        // data('userid) is passed from a button
        // confirmtext.innerHTML += ' <b>(' + userid + ')</b>';
    });
    $('#confirmDelete').on('hide.bs.modal', function(e) {
        confirmtext.innerHTML = '';
    });
</script>