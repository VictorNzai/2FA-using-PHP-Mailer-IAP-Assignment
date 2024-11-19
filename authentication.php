<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('includes/dbcon.php');

if(!isset($_SESSION['authenticated']))
{
    $_SESSION['status'] = "You need to login first";
    header('Location: login.php');
    exit(0);
}



?>