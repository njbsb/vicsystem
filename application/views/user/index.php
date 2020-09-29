<h4><?= $title ?></h4>

<div>
    <table id="usertable" class="table table-hover">
        <thead class="table-dark">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>User type</td>
                <td>Status</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['usertype'] ?></td>
                    <?php if ($user['userstatus'] == 'pending') : ?>
                        <td><span class="badge badge-warning"><?= $user['userstatus'] ?></span></td>
                    <?php elseif ($user['userstatus'] == 'active') : ?>
                        <td><span class="badge badge-success"><?= $user['userstatus'] ?></span></td>
                    <?php else : ?>
                        <td><span class="badge badge-light"><?= $user['userstatus'] ?></span></td>
                    <?php endif ?>

                    <td>
                        <a class="badge badge-info" href="<?= site_url('validate/') . $user['id'] ?>">Review</a>
                        <a class="badge badge-danger" data-toggle="modal" data-userid="<?= $user['id'] ?>" onclick="$('#confirmDelete #formDelete').attr('action', '<?= site_url('user/delete/' . $user['id']) ?>')" href="#confirmDelete">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<div id="confirmDelete" class="modal">
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
        $('#usertable').DataTable();
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