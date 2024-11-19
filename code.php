<?php
session_start();
include('includes/dbcon.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function sendemail_verify($name, $email, $verify_token)
{
   $mail = new PHPMailer(true);

   $mail->isSMTP();  
   $mail -> SMTPAuth = true;
   
   //Send using SMTP
   $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through                                 //Enable SMTP authentication
   $mail->Username   = 'victormusembi5@gmail.com';                     //SMTP username
   $mail->Password   = 'gpnr uvyl jrim tmvy';  
                                //SMTP password
   $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
   $mail->Port       = 465; 

    $mail->setFrom('victormusembi5@gmail.com', 'Victor Musembi');
    $mail->addAddress($email, $name);     //Add a recipient

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verification';

    $email_template = "
          <h2>Verify your email address</h2>

        <p>Click the link below to verify your email address</p>

         <p>Verification Code: <strong>$verify_token</strong></p>

          <a href='http://localhost/Database%20Folder/Registration%20form%20with%20email%20verification/verify-email.php?token=$verify_token'>Verify Email</a>

        ";

    // <a href='http://localhost/Database%20Folder/Registration%20form%20with%20email%20verification/verify-email.php?token=$verify_token'>Verify Email</a>
    

$mail-> Body = $email_template;
    
        $mail->send();
        echo 'Message has been sent';

}


if(isset($_POST['register_btn']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $verify_token = mt_rand(100000, 999999);

    // sendemail_verify( "$name", "$email", "$verify_token");
    // echo "Email sent";
}


     $con = mysqli_connect('localhost', 'root', 'rehanais2cool', 'iap_assignment');


    //Checking if email already exists
    $check_email_query = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
    $check_email = mysqli_query($con, $check_email_query);

    if(mysqli_num_rows($check_email) > 0)
    {
$_SESSION['status'] = "Email already exists";
 header('Location: register.php');
     }
     else
     {
    //    Inserting data into the database
    $query = "INSERT INTO users (name, email, phone, password, verify_token) VALUES ('$name', '$email', '$phone', '$password', '$verify_token')";
      $query_run = mysqli_query($con, $query);

       if($query_run)
     {
             sendemail_verify( "$name", "$email", "$verify_token");

            $_SESSION['status'] = "User registered successfully and verification email sent";
            header('Location: register.php');
        }
        else
        {
            $_SESSION['status'] = "User registration failed";
            header('Location: register.php');
        } 

    }
    

?>