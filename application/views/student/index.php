<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Student</li>
</ol>

<h2 class="text-center"><?= $title ?></h2>
<div class="container-fluid text-center">
    <?php if ($students) : ?>
    <div class="row" id="">
        <?php foreach ($students as $student) : ?>
        <div class="col-md-2">
            <div class="card mb2">
                <?php $profileimage = 'default.jpg' ?>
                <img class="card-img-top" src="<?= base_url() . 'assets/images/profile/' . $profileimage ?>" style="padding:6px;" alt="">
                <div class="card-footer text-muted">
                    <a href="<?= site_url('/student/') . $student['id'] ?>"><?= $student['id'] ?></a>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
    <?php else : ?>
    No students data
    <?php endif ?>
</div>
<small>Student that has not been validated won't show here</small>

<script type="text/javascript">
var studentarray = <?= json_encode($students) ?>;
buildCards(studentarray)

function buildCards(data) {

    var table = document.getElementById('card_student')

    for (var i = 0; i < data.length; i++) {
        if (data[i].profile_image == '') {
            data[i].profile_image = 'default.jpg';
        }
        var card = `<div class="col-lg-2">
                        <div class="card mb-2">
                            <img style="max-width:auto; max-height:180px; display: block; object-fit:cover; padding:6px;"
                                src="<?= base_url() . 'assets/images/profile/' ?>${data[i].profile_image}" alt="" srcset="">
                            <div class="card-footer text-muted">
                                <a href="<?= site_url('/student/') ?>${data[i].id}">${data[i].id}</a>
                            </div>
                        </div>
                    </div>`
        // var row = `<tr>
        //                     <td>${data[i].matric}</td>
        //                     <td>${data[i].name}</td>
        //                     <td>${data[i].email}</td>
        //                 </tr>`
        table.innerHTML += card
    }
}
</script>