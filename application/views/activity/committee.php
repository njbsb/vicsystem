<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="checkbox_committee" checked="">
        <label class="custom-control-label" for="checkbox_committee">Show committees</label>
    </div>
</div>
<div id="committees" class="col-sm-6">
    <div class="form-group">
        <button class="btn btn-primary">Add committee</button>
    </div>
    <table id=" tbl_committee" class="table table-hover" style="text-align:left;">
        <thead class="table-dark">
            <tr>
                <!-- <th scope="col">No</th> -->
                <th scope="col">Position</th>
                <th scope="col">Name</th>
            </tr>
        </thead>
        <tbody class="list">
            <?php foreach ($committees as $com) : ?>
                <tr>
                    <td scope="row"><?= $com['rolename'] ?></td>
                    <td scope="row"><?= $com['name'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#checkbox_committee').click(function() {
            $('#committees').toggle();
        });
    });
</script>