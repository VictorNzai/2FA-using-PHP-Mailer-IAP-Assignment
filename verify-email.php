<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('includes/dbcon.php');

if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($con, $_GET['token']); // Added sanitization
    $verify_query = "SELECT verify_token, verify_status FROM users WHERE verify_token = '$token' LIMIT 1";
    $verify_query_run = mysqli_query($con, $verify_query);

    if (mysqli_num_rows($verify_query_run) > 0) {
        $row = mysqli_fetch_array($verify_query_run);

        if ($row['verify_status'] == 0) {
            $clicked_token = mysqli_real_escape_string($con, $row['verify_token']); // Ensure safety
            $update_query = "UPDATE users SET verify_status = 1 WHERE verify_token = '$clicked_token' LIMIT 1";
            $update_query_run = mysqli_query($con, $update_query);

            if ($update_query_run) {
                $_SESSION['status'] = "Email verified successfully";
                header('Location: login.php');
            } else {
                $_SESSION['status'] = "Email verification failed";
                header('Location: login.php');
            }
        } else {
            $_SESSION['status'] = "Email already verified. Please continue to login.";
            header('Location: login.php');
            exit();
        }
    } else {
        $_SESSION['status'] = "Token not found";
        header('Location: login.php');
    }
} else {
    $_SESSION['status'] = "Please verify your email first";
    header('Location: login.php');
}
?>
