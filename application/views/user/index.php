<h4><?= $title ?></h4>

<div>
    <table id="usertable" class="table">
        <thead class="table-dark">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Usertype</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?php
                        if ($user['mtrname']) {
                            echo $user['mtrname'];
                        } elseif ($user['stdname']) {
                            echo $user['stdname'];
                        } else {
                            echo $user['admname'];
                        } ?></td>
                    <td><?= $user['usertype'] ?></td>
                    <td>
                        <!-- <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#confirmDelete">
                            Delete
                        </button> -->
                        <?php echo form_open('/user/delete/' . $user['id']); ?>
                        <input type="submit" value="Delete" class="btn btn-primary" data-toggle="modal" data-target=" #confirmDelete">
                        <?php echo form_close(); ?>
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
                <p>Are you sure to delete this user?</p>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-primary">Delete</button> -->
                <?php echo form_open('/user/delete/' . $user['id']); ?>
                <input type="submit" value="Delete" class="btn btn-primary">
                <?php echo form_close(); ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#usertable').DataTable();
    });
</script>