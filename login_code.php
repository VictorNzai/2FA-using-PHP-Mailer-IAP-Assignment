<?php
session_start();
include('includes/dbcon.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(isset($_POST['login_now_btn']))
{
    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) // Check if email and password are not empty
    {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $login_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $login_query_run = mysqli_query($con, $login_query);

        if(mysqli_num_rows($login_query_run) > 0)
        {
            $row = mysqli_fetch_array($login_query_run);
            
            if($row['verify_status'] == "1"){
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth_user'] = [
                    'username' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                ];
                $_SESSION['status'] = "You are successfully logged in";
                header('Location: dashboard.php');
                exit(0);
            } else {
                $_SESSION['status'] = "Please Verify your email first";
                header('Location: login.php');
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "Email or Password is invalid";
            header('Location: login.php');
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "Email and Password fields are required";
        header('Location: login.php');
        exit(0);
    }
}



?>