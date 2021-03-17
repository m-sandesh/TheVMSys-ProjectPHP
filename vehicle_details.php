<?php
require_once 'class/dbConnect.php';
require_once 'includes/header.php';
require_once 'includes/navbar_user.php';

session_start();
if ($_SESSION['session_user_id'] == '' && $_SESSION['session_user_name'] == '') {
    $_SESSION['msg'] = 'Please login to continue.';
    header('Location: index.php');
}

$_SESSION['session_selected_center_id'] = $_GET['shopid'];

$query0 = "SELECT * FROM workshop WHERE workshopId=" . $_SESSION['session_selected_center_id'];
$row = mysqli_fetch_array(mysqli_query($db, $query0));
$_SESSION['session_selected_center'] = $row['centername'];

?>

<div class="container">
    <br>
    <h3>Schedule for: <?php echo $_SESSION['selected_vehicle'] ?> wheeler</h3>
    <h3>Choosen center: <?php echo $_SESSION['session_selected_center'] ?> </h3>
    <br>
    <div align="center" style="color: <?= $retVal = ($_SESSION['panel_status'] != "0") ? "green" : "red"; ?>;">
        <?php
        if (isset($_SESSION['msg'])) {
            echo '<p>' . $_SESSION['msg'] . '</p>';
            unset($_SESSION['msg']);
        };
        ?>
    </div>
    <br>
    <h5>Fill the details of the vehicle.</h5>
    <hr>
    <form action="class/input.php" method="post">

        <div class="form-row">
            <div class="col-4">
                <label for="vehiclenumber">Vehicle Number: </label>
                <input type="text" class="form-control" name="vehiclenumber" placeholder="Ex. BA 14 1234">
            </div>
            <div class="col-4">
                <label for="odometer">Odometer: </label>
                <input type="text" class="form-control" name="odometer" placeholder="Current Odometer">
            </div>
            <div class="col-4">
                <label for="mileage">Mileage: </label>
                <input type="text" class="form-control" name="mileage" placeholder="Estimated Mileage">
            </div>
        </div>

        <br>
        <div class="form-group">
            <label for="problems">Description: </label>
            <textarea class="form-control" id="problems" name="problems" rows="3" placeholder="A description about problems facing (if any) during the travel, or any maintainance to be done."></textarea>
        </div>
        <br>
        <h5>Choose a schedule.</h5>
        <hr>

        <div class="form-row">
            <div class="col-4">
                <label for="scheduledate">Choose a Date: </label>
                <input type="date" class="form-control" name="scheduledate">
            </div>
            <div class="col-4">
                <label for="scheduletime">Choose a Time: </label>
                <select class="form-control" id="scheduletime" name="scheduletime">
                    <option value="10">10 am</option>
                    <option value="12">12 pm</option>
                    <option value="14">2 pm</option>
                    <option value="16">4 pm</option>
                </select>
            </div>
            <div class="col-4">
                <label for="">Note: </label>
                <input type="text" class="form-control" name="note" placeholder="Any message to service center.">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-success" name="btnSchedule">Register</button>
        <button class="btn btn-danger" name="btnCancel">Cancel</button>
    </form>
    <br>
</div>


<?php
require_once 'includes/footer.php';
