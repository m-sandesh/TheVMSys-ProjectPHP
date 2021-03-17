<?php
require_once 'includes/header.php';
require_once 'includes/navbar_user.php';
require_once 'class/dbConnect.php';

session_start();
if ($_SESSION['session_user_id'] == '' && $_SESSION['session_user_name'] == '') {
    $_SESSION['msg'] = 'Please login to continue.';
    header('Location: index.php');
}
?>

<div class="container-fluid">
    <h6 class="navbar-dark bg-dark" style="padding:0 0 15px 15px;color:white;">Logged in as: <?= $_SESSION['session_user_name'] ?></h6>
    <br>
    <div align="center" style="color: <?= $retVal = ($_SESSION['panel_status'] != "0") ? "green" : "red"; ?>;">
        <?php
        if (isset($_SESSION['msg'])) {
            echo '<p>' . $_SESSION['msg'] . '</p>';
            unset($_SESSION['msg']);
        };
        ?>
    </div>
    <h4 align="center">Scheduled Services</h4>
    <br>
    <table class="table table-striped" id="service_table">
        <thead>
            <tr align="center">
                <th scope="col">#</th>
                <th scope="col">Schedule ID</th>
                <th scope="col">Center Name</th>
                <th scope="col">Vehicle Number</th>
                <th scope="col">Odometer (KM)</th>
                <th scope="col">Estimated Mileage</th>
                <th scope="col">Problems</th>
                <th scope="col">Schedule Date</th>
                <th scope="col">Schedule Time</th>
                <th scope="col">Remarks</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $serviceQuery = "SELECT w.centername, s.* FROM workshop w INNER JOIN all_schedules s ON w.workshopId = s.workshopId WHERE s.customerId=" . $_SESSION['session_user_id'] . " ORDER BY scheduleId DESC";
            $serviceRun = mysqli_query($db, $serviceQuery);
            if (mysqli_num_rows($serviceRun) > 0) {
                $serial = 1;
                while ($result = mysqli_fetch_assoc($serviceRun)) {
                    ?>
                    <tr align="center">
                        <th scope="row"><?= $serial ?></th>
                        <td><?= $result['scheduleId']; ?></td>
                        <td><?= $result['centername']; ?></td>
                        <td><?= $result['vehicle_number']; ?></td>
                        <td><?= $result['odometer']; ?></td>
                        <td><?= $result['est_mileage']; ?></td>
                        <td><?= $result['problems']; ?></td>
                        <td><?= $result['schedule_date']; ?></td>
                        <td><?= $result['schedule_time']; ?></td>
                        <td><?= $result['note']; ?></td>
                        <td><a href="class/input.php?scheduleID=<?= $result['scheduleId'] ?>" name="btnDelSchedule">
                                <button class="btn btn-success">Delete</button></a>
                        </td>
                    </tr>
                    <?php $serial++;
                }
            } else { ?>
                <tr>
                    <td colspan="20" align="center">No Schedules Made.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <hr>
    <h4 align="center">Previous Services</h4>
    <br>
    <table class="table table-striped" id="service_table">
        <thead>
            <tr align="center">
                <th scope="col">#</th>
                <th scope="col">Service ID</th>
                <th scope="col">Workshop Name</th>
                <th scope="col">Odometer (KM)</th>
                <th scope="col">Next Due (KM)</th>
                <th scope="col">Status</th>
                <th scope="col">Notifications</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $serviceQuery = "SELECT w.centername, s.* FROM workshop w INNER JOIN service_detail s ON w.workshopId = s.workshopId WHERE s.customerId=" . $_SESSION['session_user_id'] . " ORDER BY service_detailId DESC";
            $serviceRun = mysqli_query($db, $serviceQuery);
            if (mysqli_num_rows($serviceRun) > 0) {
                $serial = 1;
                while ($result = mysqli_fetch_assoc($serviceRun)) {
                    ?>
                    <tr align="center">
                        <th scope="row"><?= $serial ?></th>
                        <td><?= $result['service_detailId']; ?></td>
                        <td><?= $result['centername']; ?></td>
                        <td><?= $result['odometer']; ?></td>
                        <td><?= $result['next_due']; ?></td>
                        <td><?= $result['service_status']; ?></td>
                        <td><?= $result['notification_status']; ?></td>
                    </tr>
                    <?php $serial++;
                }
            } else { ?>
                <tr>
                    <td colspan="20" align="center">No Services Made.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>