<h2><?= $title ?></h2><br>
<!-- <div class="container"> -->

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
                    <img style="max-height:100px;" src="<?php echo site_url() ?>assets/images/profile/default.png" class="img-responsive" alt="Image">
                </td> -->
                <td class="Activity" scope="row"><a href="<?php echo site_url('/activity/' . $activity['slug']); ?>"><?= $activity['activity_name'] ?></a></t>
                <td class="Date"><?= date('d/m/Y', strtotime($activity['datetime_start'])) ?></td>
                <td><?= $activity['acadyear'] . ' Sem ' . $activity['semester_id'] ?></td>
                <td><?= $activity['code'] ?></td>
                <td>Null</td>
                <td><?= $activity['advisorname'] ?></td>
                <!-- <td><a class="btn btn-secondary btn-sm" href="<?php echo site_url('/activity/' . $activity['slug']); ?>">Details</a></td> -->
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>