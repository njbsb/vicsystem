<h2 class="text-center"><?= $title ?></h2>
<hr>
<div class="row justify-content-between">
    <div class="col-4">
        <h3>Academic Session</h3>
    </div>
    <div class="col-4">
        <button class="btn btn-outline-primary margin" data-toggle="modal" data-target="#addacademicsession" style="float: right;">Add Academic Session</button>
    </div>
</div>

<!-- <button class="btn btn-outline-primary margin" data-toggle="modal" data-target="#addacademicsession" style="float: right;">Add Academic Session</button> -->
<table id="acs_table" class="table">
    <thead class="table-dark">
        <tr>
            <td>ID</td>
            <td>Academic Year</td>
            <td>Semester</td>
            <td>Status</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($academicsession as $acs) : ?>
            <tr>
                <td><?= $acs['id'] ?></td>
                <td><?= $acs['academicyear'] ?></td>
                <td><?= $acs['semester_id'] ?></td>
                <td><?= $acs['status'] ?></td>
                <td><button class="btn btn-outline-info btn-sm">Set Active</button></td>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>
<hr>
<div class="row justify-content-between">
    <div class="col-4">
        <h3>Academic Year</h3>
    </div>
    <div class="col-4">
        <button class="btn btn-outline-primary margin" data-toggle="modal" data-target="#addacadyear" style="float: right;">Add Academic Year</button>
    </div>
</div>
<table id="acy_table" class="table">
    <thead class="table-dark">
        <tr>
            <td>ID</td>
            <td>Academic Year</td>
            <td>Status</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($academicyear as $acy) : ?>
            <tr>
                <td><?= $acy['id'] ?></td>
                <td><?= $acy['acadyear'] ?></td>
                <td><?= $acy['status'] ?></td>
                <td><a href="#" class="btn btn-info btn-sm">Edit</a></td>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>
<hr>
<div class="row justify-content-between">
    <div class="col-4">
        <h3>Academic Plan</h3>
    </div>
    <div class="col-4">
        <button class="btn btn-outline-primary margin" data-toggle="modal" data-target="#addacademicplan" style="float: right;">Add Academic Plan</button>
    </div>
</div>

<table id="acp_table" class="table display">
    <thead class="table-dark">
        <tr>
            <td>Matric</td>
            <td>Name</td>
            <td>Academic Session</td>
            <td>GPA Target</td>
            <td>GPA Achieved</td>
            <td>Status</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($academicplan as $acp) : ?>
            <tr>
                <td><?= $acp['student_matric'] ?></td>
                <td><?= $acp['name'] ?></td>
                <td><?= $acp['acadyear'] . ' Semester ' . $acp['semester_id'] ?></td>
                <td><?= $acp['cgpa_target'] ?></td>
                <td><?= $acp['cgpa_achieved'] ?></td>

                <?php if ($acp['cgpa_achieved'] > $acp['cgpa_target']) : ?>
                    <td class="text-success">
                        Passed
                    </td>
                <?php else : ?>
                    <td class="text-warning">
                        Not Pass
                    </td>
                <?php endif ?>
            </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <td>Matric</td>
            <td>Name</td>
            <td>Academic Session</td>
            <td>GPA Target</td>
            <td>GPA Achieved</td>
            <td>Status</td>
        </tr>
    </tfoot>
</table>

<div id="addacademicsession" class="modal fade">
    <div class="modal-dialog" role="document">
        <!-- <?= form_open('academic/create_academicsession') ?> -->
        <form method="post" id="acs">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Academic Session</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="acadyear">Select academic year</label>
                        <select name="acadyear_id" id="acadyear_id" class="form-control">
                            <option value="" selected disabled hidden>Select academic year</option>
                            <?php foreach ($academicyear as $acadyear) : ?>
                                <option value="<?= $acadyear['id'] ?>"><?= $acadyear['acadyear'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="semester">Select semester</label>
                        <select name="semester_id" id="semester_id" class="form-control">
                            <option value="" selected disabled hidden>Select semester</option>
                            <?php foreach ($semesters as $sem) : ?>
                                <option value="<?= $sem['id'] ?>"><?= $sem['semester'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status (default):</label>
                        <input type="text" id="status" name="status" readonly value="inactive" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary">Add</button> -->
                    <input type="submit" class="btn btn-primary" value="add">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                </div>
            </div>
        </form>
        <!-- <?= form_close() ?> -->
    </div>
</div>

<div id="addacadyear" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add academic year</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="acadyear_id">Academic Year:</label>
                    <input type="text" placeholder="20XX/20XX" id="acadyear_id" name="acadyear_id" class="form-control">
                </div>
                <div class="form-group">
                    <label for="status">Status (default):</label>
                    <input type="text" id="status" name="status" readonly value="inactive" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
            </div>
        </div>
    </div>
</div>

<div id="addacademicplan" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    var tables = ['#acs_table', '#acy_table', '#acp_table'];
    $(document).ready(function() {
        $('#acs_table').DataTable();
        $('#acy_table').DataTable();
        $('#acp_table').DataTable({
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

    // $(document).on('submit', '#acs', function(event) {
    //     event.preventDefault();
    //     var acadyear_id = $('#acadyear_id').val();
    //     var semester_id = $('#semester_id').val();
    //     if (acadyear_id != '' && semester_id != '') {
    //         $.ajax({
    //             url: <?= base_url() . 'academic/create_academicsession' ?>,
    //             method: 'POST',
    //             data: new FormData(this),
    //             contentType: false,
    //             processData: false,
    //             success: function(data) {
    //                 alert(data);
    //                 $('#acs')[0].reset();
    //                 $('#addacademicsession').modal('hide');
    //                 dataTable.ajax.reload();
    //             }
    //         });
    //     } else {
    //         alert('required fields!');
    //     }
    // });
</script>