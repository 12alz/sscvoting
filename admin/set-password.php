<?php
include 'includes/conn.php';
// echo 'connected';

if (isset($_GET["reset"])) {
    $email = $_GET["email"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
        .reset-password-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 100%;
        }
        .reset-password-title {
            color: #34495e;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
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
        .form-control-feedback {
            position: absolute;
            right: 15px;
            top: 10px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="reset-password-box">
        <h2 class="reset-password-title">Reset Password</h2>
        <form action="../admin/function.php" method="post">
            <div class="form-group has-feedback">
                <input type="email" class="form-control input-lg" placeholder="Email" name="email" value="<?php echo $email ?>" required readonly>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control input-lg" placeholder="Set new password" name="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control input-lg" placeholder="OTP Code" name="otp" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat btn-lg" name="btn-new-password">Set Password</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
<?php
} else {
    // handle case when reset is not set
}
?>
