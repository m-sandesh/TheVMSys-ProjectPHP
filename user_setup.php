<?php
require_once 'core/init.php';
require_once 'class/dbConnect.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';

$query = "SELECT * FROM customer WHERE customerId=" . $_SESSION['session_user_id'];

    $run = mysqli_query($db, $query);
    $row = mysqli_fetch_array($run);

?>

<div class="container">
    <div class="login-box">
        <br>
        <h4>Update your information</h4>
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
                <div class="form-group col-md-4">
                    <label for="username">Username: </label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $row['username'] ?>">
                </div>
                <div class="form-group col-md-5">
                    <label for="fullname">Full Name: </label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $row['name']?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="email">Email: </label>
                    <input type="text" class="form-control" id="email" name="email"  value="<?= $row['email'] ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="phone">Phone: </label>
                    <input type="text" class="form-control" id="phone" name="phone"  value="<?= $row['phone'] ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="pass">Password: </label>
                    <input type="password" class="form-control" id="pass" name="pass">
                </div>
            </div>
            <button type="submit" name="btnUpdate" class="btn btn-success">Update</button>
            <button class="btn btn-danger" name="btnCancel">Cancel</button>
        </form>
    </div>
</div>

<?php
require_once 'includes/footer.php';
