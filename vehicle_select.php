<?php
require_once 'includes/header.php';
require_once 'includes/navbar_user.php';
session_start();
if ($_SESSION['session_user_id'] == '' && $_SESSION['session_user_name'] == '') {
    $_SESSION['msg'] = 'Please login to continue.';
    header('Location: index.php');
}
?>

<div class="container">
    <br>
    <div class="row">
        <div class="col-sm-6">
            <a href="active_location.php?vehicle=2" class="card-links" onclick="wheel2Session()" name="vehicle2">
                <div class="card">
                    <img class="card-img-top" src="images/pngimage-2wheeler.png" alt="image-2wheeler-load-failed">
                    <div class="card-body">
                        <h5 class="card-title">Two Wheeler</h5>
                        <p class="card-text">Choose this to maintain a two wheeler. A motorbike and scooter owners can choose this.</p>
                    </div>
                </div>
        </div>
        </a>
        <div class="col-sm-6">
            <a href="active_location.php?vehicle=4" class="card-links" onclick="wheel4Session()" name="vehicle4">
                <div class="card">
                    <img class="card-img-top" src="images/pngimage-4wheeler.png" alt="image-2wheeler-load-failed">
                    <div class="card-body">
                        <h5 class="card-title">Four Wheeler</h5>
                        <p class="card-text">Choose this to maintain a four wheeler. A car and jeep owners can choose this.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>


<?php
require_once 'includes/footer.php';
