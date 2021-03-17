<?php
require_once 'class/dbConnect.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';

session_start();
$query0 = "SELECT * FROM workshop WHERE workshopId=" . $_SESSION['session_user_id'];
$query1 = "SELECT * FROM workshop_setup WHERE workshopId=" . $_SESSION['session_user_id'];
$row0 = (mysqli_fetch_array(mysqli_query($db, $query0)));
$row1 = (mysqli_fetch_array(mysqli_query($db, $query1)));
?>

<div class="container">
    <br>
    <h4>Update workshop profile.</h4>
    <hr>
    <br>
    <div align="center" style="color: <?= $retVal = ($_SESSION['panel_status'] != "0") ? "green" : "red"; ?>;">
        <?php
        if (isset($_SESSION['msg'])) {
            echo '<p>' . $_SESSION['msg'] . '</p>';
            unset($_SESSION['msg']);
        };
        ?>
    </div>
    <form action="class/input.php" method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="centername">Center Name: </label>
                <input type="text" class="form-control" id="centername" name="centername" value="<?= $row0['centername'] ?>" placeholder="Name of the Workshop">
            </div>
            <div class="form-group col-md-6">
                <label for="address">Center Address: </label>
                <input type="text" class="form-control" id="address" name="address"  value="<?= $row0['address'] ?>" placeholder="Current Address">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="username">Username: </label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $row0['center_username'] ?>" placeholder="Username for Login">
            </div>
            <div class="form-group col-md-6">
                <label for="ownername">Owner's Name: </label>
                <input type="text" class="form-control" id="ownername" name="ownername" value="<?= $row0['ownername'] ?>" placeholder="Name of Workshop Owner">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">Email: </label>
                <input type="text" class="form-control" id="email" name="email" value="<?= $row0['email'] ?>" placeholder="Email Address">
            </div>
            <div class="form-group col-md-6">
                <label for="phone">Phone: </label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= $row0['phone'] ?>" placeholder="Phone Number">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="open-time">Opening Time: </label>
                <input type="text" class="form-control" id="open-time" name="open-time" value="<?= $row1['open_time'] ?>" placeholder="Opening Time of Center">
            </div>
            <div class="form-group col-md-1">
                <label for="open-time-control">AmPm:</label>
                <select class="form-control" id="open-time-control" name="open-time-control">
                    <option value="am">am</option>
                    <option value="pm">pm</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="close-time">Closing Time: </label>
                <input type="text" class="form-control" id="close-time" name="close-time" value="<?= $row1['close_time'] ?>" placeholder="Closing Time of Center">
            </div>
            <div class="form-group col-md-1">
                <label for="close-time-control">AmPm:</label>
                <select class="form-control" id="close-time-control" name="close-time-control">
                    <option value="pm">pm</option>
                    <option value="am">am</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="schedule-time">Scheduling Gap: </label>
                <input type="text" class="form-control" id="schedule-time" name="schedule-time" value="<?= $row1['schedule_time'] ?>" placeholder="Scheduling Time in Center">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="longitude">Longitude: </label>
                <input type="text" class="form-control" id="longitude" name="longitude">
            </div>
            <div class="form-group col-md-6">
                <label for="latitude">Latitude: </label>
                <input type="text" class="form-control" id="latitude" name="latitude">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="vechile_select">Workshop Type: </label>
                <select class="form-control" id="vechile_select" name="vehicle_select">
                    <option value="2">2 Wheeler</option>
                    <option value="4">4 Wheeler</option>
                    <option value="Both">Both</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="pass">Password: </label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
            </div>
        </div>
        <button type="submit" class="btn btn-success" name="btnWSUpdate">Update</button>
        <button class="btn btn-danger" name="btnCancel">Cancel</button>
    </form>
    <!-- </div> -->
</div>

<script>
    var long = document.getElementById("longitude");
    var lati = document.getElementById("latitude");

    window.onload = getLocation();

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            long.value = "Not Supported";
            long.value = "Not Supported";
        }
    }

    function showPosition(position) {
        long.value = position.coords.latitude;
        lati.value = position.coords.longitude;
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert('Allow Location Permissions.')
                break;
            case error.POSITION_UNAVAILABLE:
                alert('Position Unavailable.');
                break;
        }
    }
</script>


<?php
require_once 'includes/footer.php';
