<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">User</li>
</ol>
<h2 class="text-primary text-center margin"><?= $title ?></h2>
<div class="card">
    <div class="card-body">
        <table id="usertable" class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>User type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-active">
                <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['usertype'] ?></td>
                    <?php if ($user['userstatus'] == 'pending') : ?>
                    <td class="text-warning"><?= $user['userstatus'] ?></td>
                    <?php elseif ($user['userstatus'] == 'active') : ?>
                    <td class="text-success"><?= $user['userstatus'] ?></td>
                    <?php else : ?>
                    <td class="text-secondary"><?= $user['userstatus'] ?></td>
                    <?php endif ?>
                    <td>
                        <a class="btn btn-sm btn-outline-primary" href="<?= site_url('validate/') . $user['id'] ?>"><i class='fas fa-pen'></i></a>
                        <?php if ($user['id'] != $this->session->userdata('username')) : ?>
                        <a class="btn btn-sm btn-outline-danger" data-toggle="modal" data-userid="<?= $user['id'] ?>"
                            onclick="$('#confirmDelete #formDelete').attr('action', '<?= site_url('user/delete/' . $user['id']) ?>')" href="#confirmDelete"><i class='fas fa-trash-alt'></i></a>
                        <?php endif ?>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>User type</td>
                    <td>Status</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <a class="btn btn-success" href="<?= site_url('user/download') ?>" target="_blank"><i class='fas fa-file-excel'></i> Download</a>
    </div>
</div>
<br>
<div class="card">
    <div class="container">
        <?= form_open_multipart('user/upload') ?>
        <div class="form-group">
            <!-- <p>It's end of academic session. Upload the students' result here</p> -->
            <label for="formFile" class="form-label mt-4">Upload new users/students by batch</label>
            <input class="form-control" type="file" name="upload_file" id="upload_file" required>
        </div>
        <div class="form-group">
            <button class="btn btn-info" type="submit"><i class='fas fa-upload'></i> Upload</button>
        </div>
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
                    <button type="submit" class="btn btn-danger">Delete</button>
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
$('#confirmDelete').on('show.bs.modal', function(e) {
    var userid = $(e.relatedTarget).data('userid');
    // data('userid) is passed from a button
    confirmtext.innerHTML += ' <b>(' + userid + ')</b>';
});
$('#confirmDelete').on('hide.bs.modal', function(e) {
    confirmtext.innerHTML = 'Are you sure to delete this user?';
});
</script>