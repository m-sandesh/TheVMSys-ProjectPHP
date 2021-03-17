<?php
// require_once 'core/init.php';
require_once 'dbConnect.php';
require_once '../MailSys/PHPMailerAutoload.php';
session_start();


if (isset($_POST['btnCancel'])) {
    header('Location: index.php');
}

if (isset($_POST['btnLogin'])) {
    $user_name = $_POST['username'];
    $user_pass = $_POST['pass'];

    if ($user_name == '' && $user_pass == '') {
        $_SESSION['msg'] = 'Please fill all the login details.';
        $_SESSION['panel_status'] = "0";
        header('Location: ../index.php');
    } else {
        $customer_query = "SELECT * FROM customer WHERE username='$user_name' and password='$user_pass'";
        $center_query = "SELECT * FROM workshop WHERE center_username='$user_name' and password='$user_pass'";

        $run1 = mysqli_query($db, $customer_query);
        $run2 = mysqli_query($db, $center_query);

        if (mysqli_num_rows($run1) > 0) {
            $row = mysqli_fetch_array($run1);
            if ($row['username'] == $user_name && $row['password'] = $user_pass) {
                $_SESSION['session_user_id'] = $row['customerId'];
                $_SESSION['session_user_name'] = $row['name'];
                $_SESSION['account_state'] = "1";
                header('Location: ../user_dashboard.php?loggedUser=' . $_SESSION['session_user_name']);
            }
        } elseif (mysqli_num_rows($run2) > 0) {
            $row = mysqli_fetch_array($run2);
            if ($row['center_username'] == $user_name && $row['password'] = $user_pass) {
                $_SESSION['session_user_id'] = $row['workshopId'];
                $_SESSION['session_user_name'] = $row['centername'];
                $_SESSION['account_state'] = "2";
                header('Location: ../center_dashboard.php?loggedUser=' . $_SESSION['session_user_name']);
            }
        } else {
            $_SESSION['msg'] = 'Username or Password does not match.';
            $_SESSION['panel_status'] = "0";
            header('Location: ../index.php');
        }
    }
} else {
    $_SESSION['msg'] = 'Please login to continue.';
    $_SESSION['panel_status'] = "0";
    header('Location: ../index.php');
}

if (isset($_POST['btnReg'])) {
    $user_username = $_POST['username'];
    $user_fullname = $_POST['fullname'];
    $user_email = $_POST['email'];
    $user_phone = $_POST['phone'];
    $user_pass = $_POST['pass'];

    if ($user_username != '' && $user_fullname != '' && $user_email != '' && $user_phone != '' && $user_pass != '') {
        $query = "INSERT INTO customer (username,name,email,phone,password) VALUES('$user_username','$user_fullname','$user_email','$user_phone','$user_pass');";
        $run = mysqli_query($db, $query);
        if ($run) {
            $_SESSION['msg'] = "Account Created for Customers. Please login to continue.";
            $_SESSION['panel_status'] = "1";
            header('Location: ../index.php');
        } else {
            $_SESSION['msg'] = "Account Creation Failed !! Please try again.";
            $_SESSION['panel_status'] = "0";
            header('Location: ../index.php');
        }
    } else {
        $_SESSION['msg'] = 'Please fill all the details.';
        $_SESSION['panel_status'] = "0";
        header('Location: ../signup.php');
    }
}

if (isset($_POST['btnUpdate'])) {
    $user_username = $_POST['username'];
    $user_fullname = $_POST['fullname'];
    $user_email = $_POST['email'];
    $user_phone = $_POST['phone'];
    $user_pass = $_POST['pass'];

    if ($user_username != '' && $user_fullname != '' && $user_email != '' && $user_phone != '' && $user_pass != '') {
        $query = "UPDATE customer SET username='$user_username',name='$user_fullname',email='$user_email',phone='$user_phone',password='$user_pass' WHERE customerId=" . $_SESSION['session_user_id'];
        $run = mysqli_query($db, $query);
        if ($run) {
            $_SESSION['msg'] = "Profile Updated";
            $_SESSION['panel_status'] = "1";
            header('Location: ../user_dashboard.php');
        } else {
            $_SESSION['msg'] = "Profile Update Failed !! Please try again.";
            $_SESSION['panel_status'] = "0";
            header('Location: ../user_dashboard.php');
        }
    } else {
        $_SESSION['msg'] = 'Please fill all the details.';
        $_SESSION['panel_status'] = "0";
        header('Location: ../user_setup.php');
    }
}

if (isset($_POST['btnWSReg'])) {
    $center_username = $_POST['username'];
    $center_name = $_POST['centername'];
    $center_address = $_POST['address'];
    $center_ownername = $_POST['ownername'];
    $center_email = $_POST['email'];
    $center_phone = $_POST['phone'];
    $center_open_time_control = $_POST['open-time-control'];
    $center_close_time_control = $_POST['close-time-control'];
    $center_open_time = $_POST['open-time'] . " " . $center_open_time_control;
    $center_close_time = $_POST['close-time'] . " " . $center_close_time_control;
    $center_schedule_time = $_POST['schedule-time'];
    $center_logitude = $_POST['longitude'];
    $center_latitude = $_POST['latitude'];
    $center_type = $_POST['vehicle_select'];
    $center_pass = $_POST['pass'];

    if ($center_username != '' && $center_name != '' && $center_address != '' && $center_ownername != '' && $center_email != '' && $center_phone != '' && $center_open_time != '' && $center_close_time != '' && $center_schedule_time != '' && $center_logitude != '' && $center_latitude != '' && $center_pass != '') {
        $query = "INSERT INTO workshop (center_username,centername,address,ownername,email,phone,center_type,password) VALUES('$center_username','$center_name','$center_address','$center_ownername','$center_email','$center_phone','$center_type','$center_pass');";
        $run = mysqli_query($db, $query);
        if ($run) {
            $select_query = "SELECT workshopId FROM workshop WHERE email='$center_email'";
            $run_select = mysqli_query($db, $select_query);

            if (mysqli_num_rows($run_select) > 0) {
                $row = mysqli_fetch_array($run_select);

                $setup_query1 = "INSERT INTO workshop_setup (workshopId,open_time,close_time,schedule_time) VALUES('" . $row['workshopId'] . "','$center_open_time','$center_close_time','$center_schedule_time');";
                $setup_query2 = "INSERT INTO workshop_location (workshopId,longitude_cord,latitude_cord) VALUES('" . $row['workshopId'] . "','$center_logitude','$center_latitude');";


                $run1 = mysqli_query($db, $setup_query1);
                $run2 = mysqli_query($db, $setup_query2);

                if ($run1 && $run2) {
                    // $_SESSION['name'] = $center_name;
                    $_SESSION['msg'] = "Account Created for Workshop. Please login to continue.";
                    $_SESSION['panel_status'] = "1";
                    header('Location: ../index.php');
                } else {
                    $_SESSION['msg'] = 'Internal Error 1';
                    $_SESSION['panel_status'] = "0";
                    header('Location: ../ws_signup.php');
                }
            } else {
                $_SESSION['msg'] = "Internal Error 2";
                $_SESSION['panel_status'] = "0";
                header('Location: ../ws_signup.php');
            }
        } else {
            $_SESSION['msg'] = 'Internal Error 3';
            $_SESSION['panel_status'] = "0";
            header('Location: ../ws_signup.php');
        }
    } else {
        $_SESSION['msg'] = 'Please fill all the details.';
        $_SESSION['panel_status'] = "0";
        header('Location: ../ws_signup.php');
    }
}

if (isset($_POST['btnWSUpdate'])) {
    $center_username = $_POST['username'];
    $center_name = $_POST['centername'];
    $center_address = $_POST['address'];
    $center_ownername = $_POST['ownername'];
    $center_email = $_POST['email'];
    $center_phone = $_POST['phone'];
    $center_open_time_control = $_POST['open-time-control'];
    $center_close_time_control = $_POST['close-time-control'];
    $center_open_time = $_POST['open-time'] . " " . $center_open_time_control;
    $center_close_time = $_POST['close-time'] . " " . $center_close_time_control;
    $center_schedule_time = $_POST['schedule-time'];
    $center_logitude = $_POST['longitude'];
    $center_latitude = $_POST['latitude'];
    $center_type = $_POST['vehicle_select'];
    $center_pass = $_POST['pass'];

    if ($center_username != '' && $center_name != '' && $center_address != '' && $center_ownername != '' && $center_email != '' && $center_phone != '' && $center_open_time != '' && $center_close_time != '' && $center_schedule_time != '' && $center_logitude != '' && $center_latitude != '' && $center_pass != '') {
        $query = "UPDATE workshop SET center_username='$center_username',centername='$center_name',address='$center_address',ownername='$center_ownername',email='$center_email',phone='$center_phone',center_type='$center_type',password='$center_pass' WHERE workshopId=" . $_SESSION['session_user_id'];
        $run = mysqli_query($db, $query);
        if ($run) {
            $select_query = "SELECT workshopId FROM workshop WHERE email='$center_email';";
            $run_select = mysqli_query($db, $select_query);

            if (mysqli_num_rows($run_select) > 0) {
                $row = mysqli_fetch_array($run_select);

                $setup_query1 = "UPDATE workshop_setup SET open_time='$center_open_time',close_time='$center_close_time',schedule_time='$center_schedule_time' WHERE workshopId=" . $row['workshopId'];
                $setup_query2 = "UPDATE workshop_location SET longitude_cord='$center_logitude',latitude_cord='$center_latitude' WHERE workshopId=" . $row['workshopId'];


                $run1 = mysqli_query($db, $setup_query1);
                $run2 = mysqli_query($db, $setup_query2);

                if ($run1 && $run2) {
                    // $_SESSION['name'] = $center_name;
                    $_SESSION['msg'] = "Workshop Profile Updated.";
                    $_SESSION['panel_status'] = "1";
                    header('Location: ../center_dashboard.php');
                } else {
                    $_SESSION['msg'] = 'Internal Error 1';
                    $_SESSION['panel_status'] = "0";
                    header('Location: ../ws_setup.php');
                }
            } else {
                $_SESSION['msg'] = "Internal Error 2";
                $_SESSION['panel_status'] = "0";
                header('Location: ../ws_setup.php');
            }
        } else {
            $_SESSION['msg'] = 'Internal Error 3';
            $_SESSION['panel_status'] = "0";
            header('Location: ../ws_setup.php');
        }
    } else {
        $_SESSION['msg'] = 'Please fill all the details.';
        $_SESSION['panel_status'] = "0";
        header('Location: ../ws_setup.php');
    }
}

if (isset($_POST['btnSchedule'])) {
    $vehicle_type = $_SESSION['selected_vehicle'];
    $vehicle_number = $_POST['vehiclenumber'];
    $odometer = $_POST['odometer'];
    $mileage = $_POST['mileage'];
    $problems = $_POST['problems'];
    $schedule_date = strval($_POST['scheduledate']);
    $schedule_time = $_POST['scheduletime'];
    $note = $_POST['note'];

    if ($vehicle_type != '' && $vehicle_number != '' && $odometer != '' && $mileage != '' && $problems != '' && $schedule_date != '' && $schedule_time != '' && $note != '') {

        $matchCheck = "SELECT schedule_date,schedule_time FROM all_schedules WHERE workshopId=" . $_SESSION['session_selected_center_id'];
        $row = mysqli_fetch_array($run = mysqli_query($db, $matchCheck));

        if ($schedule_date == $row['schedule_date'] && $schedule_time == $row['schedule_time']) {
            $_SESSION['msg'] = 'Schedule is already taken. Please change the date, and time.';
            $_SESSION['panel_status'] = "0";
            header('Location: ../vehicle_details.php?shopid=' . $_SESSION['session_selected_center_id']);
        } else {
            $query = "INSERT INTO all_schedules (customerId,workshopId,vehicle_type,vehicle_number,odometer,est_mileage,problems,schedule_date,schedule_time,note) VALUES('" . $_SESSION[session_user_id] . "','" . $_SESSION[session_selected_center_id] . "','$vehicle_type','$vehicle_number','$odometer','$mileage','$problems','$schedule_date','$schedule_time','$note');";
            $run = mysqli_query($db, $query);
            if ($run) {
                $_SESSION['msg'] = "Schedule Success.";
                $_SESSION['panel_status'] = "1";
                header('Location: ../user_dashboard.php');
            } else
                echo 'Error: ';
        }
    } else {
        $_SESSION['msg'] = 'Please fill all the details.';
        $_SESSION['panel_status'] = "0";
        header('Location: ../vehicle_details.php?shopid=' . $_SESSION['session_selected_center_id']);
    }
} else {
    echo 'bad';
}

if (isset($_GET['scheduleID'])) {
    $scheduleID = $_GET['scheduleID'];
    $query = "DELETE FROM all_schedules WHERE scheduleId=" . $scheduleID;
    $run = mysqli_query($db, $query);
    if ($run) {
        $_SESSION['msg'] = 'Schedule Deleted.';
        $_SESSION['panel_status'] = "1";
        header('Location: ../user_dashboard.php');
    } else {
        $_SESSION['msg'] = 'Unable to delete.';
        $_SESSION['panel_status'] = "1";
        header('Location: ../user_dashboard.php');
    }
}

//clone schedule to schedule storage
if (isset($_GET['scheduleUID'])) {
    $scheduleID = $_GET['scheduleUID'];
    $selectSc = "SELECT * FROM all_schedules WHERE scheduleId=" . $scheduleID;
    $run = mysqli_query($db, $selectSc);
    if ($run) {
        if (mysqli_num_rows($run) > 0) {
            $row = mysqli_fetch_array($run);
            $scheduleId = $row['scheduleId'];
            $customerId = $row['customerId'];
            $workshopId = $row['workshopId'];
            $vehicle_number = $row['vehicle_number'];
            $odometer = $row['odometer'];
            $next_due = $row['odometer'] + 1500;
            $notification_status = "1";
            $service_status = "Empty";

            $insQuery = "INSERT INTO schedule_storage SELECT s.* FROM all_schedules s WHERE scheduleId =" . $scheduleId;
            $insRun = mysqli_query($db, $insQuery);
            if ($insRun) {
                $query = "INSERT INTO service_detail (customerId,workshopId,vehicle_number,odometer,next_due,notification_status,service_status,scheduleId) VALUES('$customerId','$workshopId','$vehicle_number','$odometer','$next_due','$notification_status','$service_status','$scheduleId');";
                $run = mysqli_query($db, $query);
                if ($run) {
                    $queryDel = "DELETE FROM all_schedules WHERE scheduleId=" . $scheduleId;
                    $runDel = mysqli_query($db, $queryDel);
                    if ($runDel) {
                        $_SESSION['msg'] = "Marked as arrived. ";
                        $_SESSION['panel_status'] = "1";
                        header('Location: ../center_dashboard.php');
                    } else {
                        $_SESSION['msg'] = "Error: Mark Error" . $queryDel;
                        $_SESSION['panel_status'] = "0";
                        header('Location: ../center_dashboard.php');
                    }
                } else {
                    $_SESSION['msg'] = "Error: Move Error";
                    $_SESSION['panel_status'] = "0";
                    header('Location: ../center_dashboard.php');
                }
            } else {
                $_SESSION['msg'] = "Error: Clone Error";
                $_SESSION['panel_status'] = "0";
                header('Location: ../center_dashboard.php');
            }
        }
    }
}

if (isset($_POST['btnNotify'])) {
    $mailto = $_POST['email-to'];
    $mailSub = $_POST['email-sub'] . " - TheVMSys";
    $mailMsg = $_POST['email-msg'];
    $center_emailAddr = $_POST['email-addr'];
    $center_emailPwd = $_POST['email-pwd'];

    $mail = new PHPMailer();
    $mail->IsSmtp();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = $center_emailAddr;
    $mail->Password = $center_emailPwd;
    $mail->SetFrom("$center_emailAddr");
    $mail->Subject = $mailSub;
    $mail->Body = $mailMsg;
    $mail->AddAddress($mailto);

    if (!$mail->Send()) {
        $_SESSION['msg'] = "Email not sent: Check your internet connectivity, or Login credentials.";
        $_SESSION['panel_status'] = "0";
        header('Location: ../center_dashboard.php');
    } else {
        $_SESSION['msg'] = "Email notification sent success.";
        $_SESSION['panel_status'] = "1";
        header('Location: ../center_dashboard.php');
    }
}
