<?php 
$page_title = "Homepage";
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
            <?php
            // Check if the status exists in the session
            if (isset($_SESSION['status'])) {
                ?>
                <div class="alert alert-success">
                    <h5><?= $_SESSION['status']; ?></h5>
                </div>
                <?php
                // Unset the status message after displaying it
                unset($_SESSION['status']);
            }
            ?>




                <div class="card">
                    <div class="card-header">
                    <h2>User Dashboard</h2>
                    </div>
               
                <div class="card-body">
                <h4>Access when you are logged in</h4>
                <hr>
                <h5>Welcome, <?php echo $_SESSION['auth_user']['username']; ?></h5>
                <h6>Your email is: <?php echo $_SESSION['auth_user']['email']; ?></h6>
                <h6>Your phone number is: <?php echo $_SESSION['auth_user']['phone']; ?></h6>
                </div>
               
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
