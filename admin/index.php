<?php
    session_start();
    if (isset($_SESSION['admin'])) {
        header('location:home.php');
    }
?>
<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<style>
    body {
        background: url('../images/mcc.jpg') no-repeat center center fixed;
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
        width: 320px;
        max-width: 100%;
        margin-left: auto;
        margin-right: auto;
    }
    .login-logo img {
        max-width: 100px; 
        height: auto;
        margin-bottom: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 50%;
    }
    .login-logo h2 {
        color: #34495e;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }
    .login-box-body {
        margin-top: 20px;
    }
    .login-box-msg {
        margin: 0;
        text-align: center;
        font-weight: bold;
        color: #34495e;
    }
    .form-group .form-control {
        border-radius: 5px;
    }
    .btn {
        border-radius: 5px;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s;
    }
    .btn-primary:hover {
        background-color: #2c3e50;
    }
    .btn a {
        color: white;
    }
    .callout-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        padding: 10px;
        border-radius: 5px;
        margin-top: 20px;
        text-align: center;
    }
    .box-header .btn {
        margin: 5px;
    }
    .form-control-feedback {
        position: absolute;
        right: 15px;
        top: 10px;
        color: #999;
    }
</style>

<body>
<div class="login-box">
        <div class="login-logo">
        <img src="../images/2.png" alt="Logo">
        <h2>Supreme Student Council Voting System </h2>
        </div>
      
        <div class="login-box-body">
            <form action="login.php" method="POST">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                    <span class="fas fa-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <span class="fas fa-lock form-control-feedback"></span>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in-alt"></i> Sign In</button>
                </div>
                <br>
                <center>
                    <div class="box-header with-border">
                        <a href="index.php" class="btn btn-secondary"><i class="fa fa-user"></i> Admin</a>
                        <a href="https://mccsscvoting.com/" class="btn btn-secondary"><i class="fa fa-users"></i> Student Voters</a>
                    </div>
                </center>
            </form>
        </div>

        <?php
            if (isset($_SESSION['error'])) {
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Failed',
                            text: '{$_SESSION['error']}',
                        });
                    </script>
                ";
                unset($_SESSION['error']);
            }

            if (isset($_SESSION['success'])) {
                echo "
                    <script>
                        Swal.fire({
                        timer: '1500', 
                            icon: 'success',
                            title: 'Login Successful',
                            text: '{$_SESSION['success']}',
                        }).then(function() {
                            window.location = 'home.php';
                        });
                    </script>
                ";
                unset($_SESSION['success']);
            }
        ?>
    </div>

    <?php include 'includes/scripts.php'; ?>
</body>
</html>
