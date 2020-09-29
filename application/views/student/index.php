<h2><?= $title ?></h2>
<div class="container-fluid text-center">
    <div class="row" id="card_student">
    </div>
</div>


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
                                src="<?php echo base_url() . 'assets/images/profile/'; ?>${data[i].profile_image}" alt="" srcset="">
                            <div class="card-footer text-muted">
                                <a href="<?php echo site_url('/student/'); ?>${data[i].id}">${data[i].id}</a>
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