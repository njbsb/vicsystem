<hr>
<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="checkbox_comments" checked="">
        <label class="custom-control-label" for="checkbox_comments">Show comments</label>
    </div>
</div>
<div id="comments">
    <div class="card">
        <div class="card-body">
            <h4>Add comment</h4>
            <?php if (validation_errors()) : ?>
                <div class="alert alert-dismissible alert-warning">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <p class="mb-0"><?= validation_errors() ?></p>
                </div>
            <?php endif ?>
            <?php $hidden = array('slug' => $activity['slug']) ?>
            <?= form_open('comment/create/' . $activity['id'], '', $hidden) ?>
            <div class="form-group">
                <textarea name="comment" class="form-control" rows="3" required="required"></textarea>
            </div>
            <button class="btn btn-dark" type="submit"><i class='fas fa-paper-plane'></i> Submit</button>
            <?= form_close() ?>
        </div>
    </div>
    <br>
    <?php if ($comments) : ?>
        <ul id="listPage">
            <?php foreach ($comments as $com) : ?>
                <li>
                    <div class="alert alert-dismissible alert-light card" style="margin-bottom: 4px; border-radius:12px;">
                        <div class="container">
                            <?php $textclass = ($this->session->userdata('username') == $com['user_id']) ? 'text-pink' : 'text-primary' ?>
                            <div class="row">
                                <!-- <div class="col-sm-1">
                            <img class="rounded-circle" style="object-fit:cover;" src="<?= $com['userphoto'] ?>" width="50px" height="50px" alt="">
                        </div> -->
                                <div class="col-sm-10">
                                    <?php $userid = ($this->session->userdata('user_type') == 'student') ? substr($com['user_id'], 0, -4) . '****' : $com['user_id'] ?>
                                    <?php $datatitle = ($this->session->userdata('user_type') != 'student') ? $com['name'] : '' ?>
                                    <b data-toggle="tooltip" data-title="<?= $datatitle ?>" class="<?= $textclass ?>"><?= $userid ?>:</b> <?= $com['comment'] ?>
                                    <br><small><?= $com['created_at'] ?></small><br>
                                </div>
                                <div class="col-sm-2">
                                    <?php if ($this->session->userdata('username') == $com['user_id'] or $this->session->userdata('user_type') != 'student') : ?>
                                        <a data-toggle="modal" data-target="#delete_comment" data-userid="<?= $com['user_id'] ?>" data-commentid="<?= $com['id'] ?>" data-comment="<?= $com['comment'] ?>" class="btn btn-sm" style="float: right;"><i class="fa fa-trash"></i></a>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>
</div>

<div id="delete_comment" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $hidden = array('activity_id' => $activity['id'], 'slug' => $activity['slug']) ?>
            <?= form_open('comment/delete', '', $hidden) ?>
            <div class="modal-header">
                <h5 class="modal-title">Delete this comment?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="deletecomment" id="deleteuserid"></label> said:
                    <p id="deletecomment"></p>
                    <input type="text" class="form-control" name="deletecommentid" readonly hidden>
                </div>
                <?php if ($this->session->userdata('user_type') != 'student') : ?>
                    <small>Only mentor is able to delete students' comments</small>
                <?php endif ?>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Dismiss</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {
        $("#listPage").JPaging({
            pageSize: 3,
            visiblePageSize: 3
        });
    });
    $(document).ready(function() {
        $('#tablecomment').DataTable();
    });
    var deleteuserid = document.getElementById('deleteuserid');
    var deletecomment = document.getElementById('deletecomment');
    $('#delete_comment').on('show.bs.modal', function(e) {
        var commentid = $(e.relatedTarget).data('commentid');
        var comment = $(e.relatedTarget).data('comment');
        var userid = $(e.relatedTarget).data('userid');
        $(e.currentTarget).find('input[name="deletecommentid"]').val(commentid);
        deletecomment.innerHTML = comment;
        deleteuserid.innerHTML = userid;
    });
    $('#delete_comment').on('hide.bs.modal', function(e) {
        deleteuserid.innerHTML = '';
    });
    var commentarray = <?= json_encode($comments) ?>;
    buildComments(commentarray);
    var limit = 3;

    function buildComments(array) {}


    $(document).ready(function() {
        $('#checkbox_comments').click(function() {
            function load_comment(page) {
                $.ajax({})
            }
            $('#comments').toggle();
        });
    });
</script>