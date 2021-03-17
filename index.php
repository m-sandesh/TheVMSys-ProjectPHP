<!DOCTYPE html>
<html lang="en">
<?php
require_once 'includes/header.php';
require_once "core/init.php";
dbConnect::getInstance();

if (isset($_SESSION['account_state'])) {
    if ($_SESSION['account_state'] == 1) {
        header('location: user_dashboard.php');
    }
    if ($_SESSION['account_state'] == 2) {
        header('location: center_dashboard.php');
    }
}
?>

<?php
require 'includes/navbar.php';
require 'login.php';
require 'includes/footer.php';
?>

</body>

</html>