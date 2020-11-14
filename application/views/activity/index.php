<h2><?= $title ?></h2>
<br>
<button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#activity_type">Create Activity</button>
<hr>
<table id="activitytable" class="table table-hover" style="text-align:left;">
    <thead class="table-dark">
        <tr>
            <th scope="col">Activity</th>
            <th scope="col">Date</th>
            <th scope="col">Academic Session</th>
            <th scope="col">SIG</th>
            <th scope="col">No of Committees</th>
            <th scope="col">Advisor</th>
        </tr>
    </thead>
    <tbody class="list">
        <?php foreach ($activities as $activity) : ?>
            <tr>
                <td class="Activity" scope="row"><a href="<?= site_url('/activity/' . $activity['slug']) ?>"><?= $activity['activity_name'] ?></a></t>
                <td class="Date"><?= date('d/m/Y', strtotime($activity['datetime_start'])) ?></td>
                <td><?= $activity['academicsession'] ?></td>
                <td><?= $activity['code'] ?></td>
                <td><?= $activity['committeenum'] ?></td>
                <td><?= $activity['advisorname'] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
    <!-- <tfoot>
        <tr>
            <th scope="col">Activity</th>
            <th scope="col">Date</th>
            <th scope="col">Academic Session</th>
            <th scope="col">SIG</th>
            <th scope="col">No of Committees</th>
            <th scope="col">Advisor</th>
        </tr>
    </tfoot> -->
</table>

<div id="activity_type" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create new activity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Choose category of activity</p>
                <?= form_open('activity/create') ?>
                <?php foreach ($activitycategory as $actcat) : ?>
                    <button name="activity_cat" type="submit" class="btn btn-primary" value="<?= $actcat['id'] ?>"><?= $actcat['category'] . ' (' . $actcat['code'] . ')' ?></button>&nbsp;
                <?php endforeach ?>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#activitytable').DataTable();
    });
</script>