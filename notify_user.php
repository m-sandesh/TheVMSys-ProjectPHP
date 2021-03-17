<?php
require_once 'class/dbConnect.php';
require_once 'includes/header.php';
require_once 'includes/navbar_center.php';

session_start();

$customer_id = $_GET['cid'];
$query = "SELECT email FROM customer WHERE customerId=" . $customer_id;
$row = mysqli_fetch_array(mysqli_query($db, $query));
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
                    <label for="email-to">Email to: </label>
                    <input type="text" class="form-control" id="email-to" name="email-to" value="<?=$row['email'] ?>" placeholder="Email to receiver">
                </div>
                <div class="form-group col-md-4"></div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="email-sub">Subject: </label>
                    <input type="text" class="form-control" id="email-sub" name="email-sub" value="Maintenance Time" placeholder="Subject for Email">
                </div>
                <div class="form-group col-md-4"></div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="email-msg">Message: </label>
                    <textarea class="form-control rounded-0" id="email-msg" name="email-msg" rows="3" placeholder="Your message here..."></textarea>
                </div>
                <div class="form-group col-md-4"></div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="email-addr">Your Email Address: </label>
                    <input type="text" class="form-control" id="email-addr" name="email-addr" placeholder="Your email address">
                </div>
                <div class="form-group col-md-4"></div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="email-pwd">Your Email Password: </label>
                    <input type="password" class="form-control" id="email-pwd" name="email-pwd" placeholder="Your email password">
                </div>
                <div class="form-group col-md-4"></div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4"></div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-success" name="btnNotify">Notify</button>
                    <button class="btn btn-danger" name="btnCancel">Cancel</button>
                </div>
                <div class="form-group col-md-4"></div>
            </div>
        </form>
    </div>
</div>