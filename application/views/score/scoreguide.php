<br>
<h4><b>Marking guide</b></h4>
<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="checkbox_show" checked="">
        <label class="custom-control-label" for="checkbox_show">Show guide</label>
    </div>
</div>
<div id="score_guide" class="row">
    <div class="col-md-3">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Position</th>
                    <th scope="col">Mark</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($guide_position as $gp) : ?>
                    <tr>
                        <td><?= $gp['name'] ?></td>
                        <td><?= $gp['score'] ?></td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
    <div class="col-md-3">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Meeting</th>
                    <th scope="col">Mark</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($guide_meeting as $gm) : ?>
                    <tr>
                        <td><?= $gm['name'] ?></td>
                        <td><?= $gm['score'] ?></td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
    <div class="col-md-3">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Attendance</th>
                    <th scope="col">Mark</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($guide_attendance as $ga) : ?>
                    <tr>
                        <td><?= $ga['name'] ?></td>
                        <td><?= $ga['score'] ?></td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
    <div class="col-md-3">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Involvement</th>
                    <th scope="col">Mark</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($guide_involvement as $gi) : ?>
                    <tr>
                        <td><?= $gi['name'] ?></td>
                        <td><?= $gi['score'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#checkbox_show').click(function() {
            $('#score_guide').toggle();
        });
    });
</script>