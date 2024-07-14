<?php
    session_start();
    if(isset($_SESSION['admin'])){
        header('location: admin/home.php');
        exit(); // Ensure no further execution after redirection
    }

    if(isset($_SESSION['voter'])){
        header('location: home.php');
        exit(); // Ensure no further execution after redirection
    }
?>

<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<style>
    body {
        background: url('images/mcc.jpg') no-repeat center center fixed;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: 'Arial', sans-serif;
    }
    .login-box {
        background: white;
        padding: 20px;
        border-radius: 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 320px; /* Adjusted width */
        max-width: 100%; /* Ensure it doesn't exceed the viewport width */
        margin-left: auto; /* Center horizontally */
        margin-right: auto; /* Center horizontally */
    }
    .login-logo {
        text-align: center;
        margin-bottom: 20px;
    }
    .login-logo h2 {
        color: #333;
        font-weight: bold;
        font-size: 24px;
    }
    .login-box-body {
        margin-top: 20px;
    }
    .login-box-msg {
        text-align: center;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }
    .form-group .form-control {
        border-radius: 5px;
    }
    .btn {
        border-radius: 5px;
    }
    .btn-primary {
        background-color: #blue;
        border: none;
        transition: background-color 0.3s;
    }
    
    .btn-primary:hover {
        background-color: #2c3e50;
    }
    .btn a {
        color: white;
    }
    .box-header {
        margin-top: 20px;
        text-align: center;
    }
    .box-header .btn {
        margin: 5px;
    }
    .alert {
        margin-top: 20px;
    }
    footer {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
        color: #777;
        position: absolute;
        bottom: 10px;
        width: 100%;
    }
</style>

<body>
    <div class="login-box">
        <div class="login-logo">
            <h2>Supreme Student Council Voting System V2</h2>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="login.php" method="POST">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="voter" placeholder="Student's ID" required oninput="formatStudentID(this)">
                    <span class="fas fa-user form-control-feedback"></span> <!-- Assuming this is for an icon -->
                </div>

                <script>
                function formatStudentID(input) {
                    // Remove any non-numeric characters
                    var formatted = input.value.replace(/\D/g, '');

                    // Limit to 8 numeric characters total
                    formatted = formatted.slice(0, 8);

                    // Insert a dash after the first 4 characters if there are more than 4 characters
                    if (formatted.length > 4) {
                        formatted = formatted.slice(0, 4) + '-' + formatted.slice(4);
                    }

                    // Update the input value
                    input.value = formatted;
                }
                </script>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <span class="fas fa-lock form-control-feedback"></span> <!-- Updated icon class to Font Awesome -->
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-block" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
                </div>
                <br>
                <div>
                    <p class="text-center">Don't have an account? <a href="#addnew" data-toggle="modal" class="btn">Register Here</a></p>
                </div>
                <div class="box-header">
                    <a href="admin/index.php" class="btn btn-secondary"><i class="fa fa-user"></i> Admin</a>
                    <a href="index.php" class="btn btn-secondary"><i class="fa fa-users"></i> Student voters</a>
                </div>
            </form>
        </div>

        <?php
            if(isset($_SESSION['error'])){
                echo "
                    <div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-warning'></i> Error!</h4>
                        ".$_SESSION['error']."
                    </div>
                ";
                unset($_SESSION['error']);
            }
            if(isset($_SESSION['success'])){
                echo "
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check'></i> Success!</h4>
                        ".$_SESSION['success']."
                    </div>
                ";
                unset($_SESSION['success']);
            }
        ?>
    </div>
    
    <?php include 'register.php' ?>
    <?php include 'includes/scripts.php' ?>
    
    <footer>
        <p><b>NOTE:</b> Vote Wisely</p>
    </footer>
</body>
</html>
