<?php
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>



<div class="container">
    <br>
    <div class="login-box">
        <form action="class/input.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-4"></div>
                <div class="form-group col-md-4" align="center" style="color: <?= $retVal = ($_SESSION['panel_status'] != "0") ? "green" : "red"; ?>;">
                    <?php
                    if (isset($_SESSION['msg'])) {
                        echo '<p>' . $_SESSION['msg'] . '</p>';
                        unset($_SESSION['msg']);
                    };
                    ?>
                </div>
                <div class="form-group col-md-4"></div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="username">Username: </label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group col-md-4"></div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="pass">Password: </label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                </div>
                <div class="form-group col-md-4"></div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4"></div>
                <!-- <div class="form-group col-md-4"></div> -->
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-success" name="btnLogin">Login</button>
                </div>
                <div class="form-group col-md-2">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
                    <ul class="nav nav-pills nav-stacked private-css">
                        <li class="dropdown">
                            <a class="dropdown" data-toggle="dropdown" href="#">or Signup.
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="signup.php">User Sign Up</a></li>
                                <li><a href="ws_signup.php">Workshop Sign up</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="form-group col-md-4"></div>
            </div>
        </form>
    </div>
</div>