<hr>
<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="checkbox_comments" checked="">
        <label class="custom-control-label" for="checkbox_comments">Show comments</label>
    </div>
</div>

<div id="comments">

    <h4>Add comment</h4>
    <?php if (validation_errors()) : ?>
    <div class="alert alert-dismissible alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <p class="mb-0"><?= validation_errors() ?></p>
    </div>
    <?php endif ?>
    <?= form_open('comment/create/' . $activity['id']) ?>
    <div class="form-group">
        <textarea name="comment" class="form-control" rows="3" required="required"></textarea>
    </div>
    <input type="hidden" name="slug" value="<?php echo $activity['slug']; ?>">
    <button class="btn btn-primary" type="submit"><i class='fas fa-paper-plane'></i> Submit</button>
    <?= form_close() ?>
    <br>
    <!-- <h4>Comments</h4> -->
    <?php if ($comments) : ?>
    <?php foreach ($comments as $com) : ?>
    <div class="alert alert-dismissible alert-light card" style="margin-bottom: 4px; padding-bottom:4px;padding-top:4px; border-radius:12px;">
        <?php $textclass = ($this->session->userdata('username') == $com['user_id']) ? 'text-pink' : 'text-primary' ?>
        <div class="row">
            <div class="col-sm-10">
                <?php $userid = ($this->session->userdata('user_type') == 'student') ? substr($com['user_id'], 0, -4) . '****' : $com['user_id'] ?>
                <?php $datatitle = ($this->session->userdata('user_type') != 'student') ? $com['name'] : '' ?>
                <b data-toggle="tooltip" data-title="<?= $datatitle ?>" class="<?= $textclass ?>"><?= $userid ?>:</b> <?= $com['comment'] ?>
                <br><small><?= $com['created_at'] ?></small><br>
            </div>
            <div class="col-sm-2">
                <?php if ($this->session->userdata('username') == $com['user_id']) : ?>
                <a href="#" class="btn btn-sm" style="float: right;"><i class="fa fa-trash"></i></a>
                <?php endif ?>
            </div>
        </div>
    </div>
    <?php endforeach ?>
    <table class="table" id="tablecomment">
        <tbody class="table-active">
            <?php foreach ($comments as $comment) : ?>
            <tr>
                <td><img class="rounded-circle" src="<?= $comment['userphoto'] ?>" width="30px" height="30px" alt=""></td>
                <td><?= $comment['comment'] ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php endif ?>
    <hr>


</div>


<script type="text/javascript">
$(document).ready(function() {
    $('#tablecomment').DataTable();
});

var commentarray = <?= json_encode($comments) ?>;
buildComments(commentarray);
var limit = 3;

function buildComments(array) {
    // var commentcontent = document.getElementById('comment_content');
    // if (jQuery.isEmptyObject(array)) {
    //     commentcontent.innerHTML += `<p>No comments for this activity</p>`
    // } else {
    //     for (var i = 0; i < array.length; i++) {
    //         if (!array[i].student_matric) {
    //             array[i].student_matric = 'deleted user';
    //         }
    //         var comment = `<div class="alert alert-dismissible alert-primary">
    //                             <button type="button" class="close" data-dismiss="alert">&times;</button>
    //                             ${array[i].comment} [by <a href="<?= base_url('student/') ?>${array[i].student_matric}"><strong>${array[i].student_matric}</strong></a>]
    //                             <a href="<?= site_url('category/comments/') ?>${array[i].category_id}"><span class="badge badge-pill badge-primary">${array[i].category}</span></a>
    //                         </div>`
    //         commentcontent.innerHTML += comment;
    //     }
    //     commentcontent.innerHTML += `<ul class="pagination pagination-sm">
    //         <li class="page-item disabled">
    //             <a class="page-link" href="#">&laquo;</a>
    //         </li>
    //         <li class="page-item active">
    //             <a class="page-link" href="#">1</a>
    //         </li>
    //         <li class="page-item">
    //             <a class="page-link" href="#">2</a>
    //         </li>
    //         <li class="page-item">
    //             <a class="page-link" href="#">3</a>
    //         </li>
    //         <li class="page-item">
    //             <a class="page-link" href="#">4</a>
    //         </li>
    //         <li class="page-item">
    //             <a class="page-link" href="#">5</a>
    //         </li>
    //         <li class="page-item">
    //             <a class="page-link" href="#">&raquo;</a>
    //         </li>
    //     </ul>`
    // }
}
$(function() {
    $('[data-toggle="tooltip"]').tooltip();
});


$(document).ready(function() {
    $('#checkbox_comments').click(function() {
        function load_comment(page) {
            $.ajax({})
        }
        $('#comments').toggle();
    });
});
</script>