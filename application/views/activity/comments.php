<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="checkbox_comments" checked="">
        <label class="custom-control-label" for="checkbox_comments">Show comments</label>
    </div>
</div>

<div id="comments">
    <h4>Comments</h4>
    <div id="comment_content">
        <div>
            <ul class="pagination pagination-sm">
                <li class="page-item disabled">
                    <a class="page-link" href="#">&laquo;</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">4</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">5</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">&raquo;</a>
                </li>
            </ul>
        </div>

    </div>
    <hr>

    <h4>Add comment</h4>
    <!-- <?php if (validation_errors()) {
                echo '<div class="alert alert-dismissible alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <p class="mb-0">' . validation_errors() . '</p>
        </div>';
            }
            ?> -->
    <?php if (validation_errors()) : ?>
        <div class="alert alert-dismissible alert-warning">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p class="mb-0"><?= validation_errors() ?></p>
        </div>
    <?php endif ?>
    <?php echo form_open('comment/create/' . $activity['id']); ?>
    <input type="hidden" name="id" value="A160000" class="form-control" readonly>
    <div class="form-group">
        <!-- <label>Comment</label> -->
        <textarea name="comment" class="form-control" rows="3" required="required"></textarea>
    </div>
    <div class="form-group">
        <label for="comment_category">Select a category</label>
        <select name="category_id" id="category_id" class="form-control">
            <option value="" selected disabled hidden>Choose category</option>
            <?php foreach ($categories as $cat) : ?>
                <option value="<?= $cat['id'] ?>">
                    <?= $cat['category'] ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
    <input type="hidden" name="slug" value="<?php echo $activity['slug']; ?>">
    <button class="btn btn-primary" type="submit">Submit</button>
    <?php echo form_close() ?>
</div>

<script type="text/javascript">
    var commentarray = <?= json_encode($comments) ?>;
    buildComments(commentarray);
    var limit = 3;

    function buildComments(array) {
        var commentcontent = document.getElementById('comment_content');
        if (jQuery.isEmptyObject(array)) {
            commentcontent.innerHTML += `<p>No comments for this activity</p>`
        } else {
            for (var i = 0; i < array.length; i++) {
                if (!array[i].student_matric) {
                    array[i].student_matric = 'deleted user';
                }
                var comment = `<div class="alert alert-dismissible alert-primary">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    ${array[i].comment} [by <a href="<?= base_url('student/') ?>${array[i].student_matric}"><strong>${array[i].student_matric}</strong></a>]
                                    <a href="<?= site_url('category/comments/') ?>${array[i].category_id}"><span class="badge badge-pill badge-primary">${array[i].category}</span></a>
                                </div>`
                commentcontent.innerHTML += comment;
            }
            commentcontent.innerHTML += `<ul class="pagination pagination-sm">
                <li class="page-item disabled">
                    <a class="page-link" href="#">&laquo;</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">4</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">5</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">&raquo;</a>
                </li>
            </ul>`
        }
    }

    $(document).ready(function() {
        $('#checkbox_comments').click(function() {
            $('#comments').toggle();
        });
    });
</script>