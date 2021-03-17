<?php
require_once 'includes/header.php';
require_once 'class/dbConnect.php';
require_once 'includes/navbar_center.php';

session_start();
if ($_SESSION['session_user_id'] == '' && $_SESSION['session_user_name'] == '') {
    $_SESSION['msg'] = 'Please login to continue.';
    header('Location: index.php');
}
?>

<div class="container-fluid">
    <h6 class="navbar-dark bg-dark" style="padding:0 0 15px 15px;color:white;">Logged in as: <?= $_SESSION['session_user_name'] ?></h6>
    <br>
    <!-- <hr> -->
    <h4 align="center">Scheduled Services</h4>
    <div align="center" style="color: <?= $retVal = ($_SESSION['panel_status'] != "0") ? "green" : "red"; ?>;">
        <?php
        if (isset($_SESSION['msg'])) {
            echo '<p>' . $_SESSION['msg'] . '</p>';
            unset($_SESSION['msg']);
            // $_SESSION['panel_status'] = "1";
        };
        ?>
    </div>
    <br>
    <table class="table table-striped" id="service_table">
        <thead>
            <tr align="center">
                <th scope="col">#</th>
                <th scope="col">Schedule ID</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Vehicle Number</th>
                <th scope="col">Odometer (KM)</th>
                <!-- <th scope="col">Estimated Mileage</th> -->
                <th scope="col">Problems</th>
                <th scope="col">Schedule Date</th>
                <th scope="col">Schedule Time</th>
                <th scope="col">Remarks</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $scheduleQuery = "SELECT c.name, s.* FROM customer c INNER JOIN all_schedules s ON c.customerId = s.customerId WHERE s.workshopId=" . $_SESSION['session_user_id'] . " ORDER BY scheduleId DESC";
            $scheduleRun = mysqli_query($db, $scheduleQuery);

            if (mysqli_num_rows($scheduleRun) > 0) {
                $serial = 1;
                while ($result = mysqli_fetch_assoc($scheduleRun)) {
                    ?>
                    <tr align="center">
                        <th scope="row"><?= $serial ?></th>
                        <td><?= $result['scheduleId']; ?></td>
                        <td><?= $result['name']; ?></td>
                        <td><?= $result['vehicle_number']; ?></td>
                        <td><?= $result['odometer']; ?></td>
                        <!-- <td><?= $result['est_mileage']; ?></td> -->
                        <td><?= $result['problems']; ?></td>
                        <td><?= $result['schedule_date']; ?></td>
                        <td><?= $result['schedule_time']; ?></td>
                        <td><?= $result['note']; ?></td>
                        <td>
                            <a href="class/input.php?scheduleUID=<?= $result['scheduleId'] ?>"><button class="btn btn-success">Arrived</button></a>
                            <a href="class/input.php?scheduleID=<?= $result['scheduleId'] ?>" name="btnDelSchedule">
                                <button class="btn btn-danger">Unarrived</button></a>
                        </td>
                    <?php
                    }
                    ?>
                </tr>
                <?php $serial++;
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
                <th scope="col">Customer Name</th>
                <th scope="col">Odometer (KM)</th>
                <th scope="col">Next Due (KM)</th>
                <th scope="col">Status</th>
                <th scope="col">Notifications</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $serviceQuery = "SELECT c.name,c.customerId, s.* FROM customer c INNER JOIN service_detail s ON c.customerId = s.customerId WHERE s.workshopId=" . $_SESSION['session_user_id'] . " ORDER BY service_detailId DESC";
            $servRun = mysqli_query($db, $serviceQuery);
            if (mysqli_num_rows($servRun) > 0) {
                $serial = 1;
                while ($result = mysqli_fetch_assoc($servRun)) {
                    ?>
                    <tr align="center">
                        <th scope="row"><?= $serial ?></th>
                        <td><?= $result['service_detailId']; ?></td>
                        <td><?= $result['name']; ?></td>
                        <td><?= $result['odometer']; ?></td>
                        <td><?= $result['next_due']; ?></td>
                        <td><?= $result['service_status']; ?></td>
                        <td><?= $retVal = ($result['notification_status'] == 1) ? "On" : "Off"; ?></td>
                        <?php
                        if ($result['notification_status'] == 1) { ?>
                            <td><a href="notify_user.php?cid=<?= $result['customerId'] ?>"><button class="btn btn-success">Notify</button></a></td>
                        <?php
                        }
                        ?>
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