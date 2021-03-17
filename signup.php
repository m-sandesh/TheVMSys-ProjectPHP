<?php
require_once 'core/init.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<div class="container">
    <div class="login-box">
        <h4>Signup for general users.</h4>
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
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username for Login">
                </div>
                <div class="form-group col-md-5">
                    <label for="fullname">Full Name: </label>
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="email">Email: </label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email Address">
                </div>
                <div class="form-group col-md-3">
                    <label for="phone">Phone: </label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                </div>
                <div class="form-group col-md-3">
                    <label for="pass">Password: </label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                </div>
            </div>
            <button type="submit" name="btnReg" class="btn btn-success">Register</button>
            <button class="btn btn-danger" name="btnCancel">Cancel</button>
        </form>
    </div>
</div>

<?php
require_once 'includes/footer.php';
