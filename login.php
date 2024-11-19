<?php
session_start(); // Start the session

if (isset($_SESSION['authenticated'])) {
    
    $_SESSION['status'] = "You are already logged in";
    header('Location: dashboard.php');
    exit(0);
}




$page_title = "Login";
include('includes/header.php');
include('includes/navbar.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

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

                <div class="card shadow">
                    <div class="card-header">
                        <h5>Login Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="login_code.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <!-- <div class="form-group mb-3">
    <label for="verification_code">Verification Code</label>
    <input type="text" name="verification_code" id="verification_code" class="form-control" required>
</div> -->
                            <div class="form-group">
                                <button type="submit" name="login_now_btn" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
