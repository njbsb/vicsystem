<h2><?= $title ?></h2><br>
<!-- <div class="container"> -->
<a href="<?= site_url('activity/create') ?>" class="btn btn-outline-primary btn-sm">Create activity</a>
<hr>
<table id="myTable" class="table table-hover" style="text-align:left;">
    <thead class="table-dark">
        <tr>
            <!-- <th scope="col"></th> -->
            <th scope="col">Activity</th>
            <th scope="col">Date</th>
            <th scope="col">Academic Session</th>
            <th scope="col">SIG</th>
            <th scope="col">No of Committees</th>
            <th scope="col">Advisor</th>
            <!-- <th scope="col">Action</th> -->
        </tr>
    </thead>
    <tbody class="list">
        <?php foreach ($activities as $activity) : ?>
            <tr>
                <!-- <td>
                    <img style="max-height:80px;" src="<?php echo site_url('assets/images/activity/' . $activity['photo_path']) ?>" class="img-responsive" alt="Activity Image">
                </td> -->
                <td class="Activity" scope="row"><a href="<?= site_url('/activity/' . $activity['slug']) ?>"><?= $activity['activity_name'] ?></a></t>
                <td class="Date"><?= date('d/m/Y', strtotime($activity['datetime_start'])) ?></td>
                <td><?= $activity['acadyear'] . ' Sem ' . $activity['semester_id'] ?></td>
                <td><?= $activity['code'] ?></td>
                <td>Null</td>
                <td><?= $activity['advisorname'] ?></td>
                <!-- <td><a class="btn btn-secondary btn-sm" href="<?= site_url('/activity/' . $activity['slug']) ?>">Details</a></td> -->
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>