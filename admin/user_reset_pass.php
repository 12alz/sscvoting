<?php
session_start();
include 'includes/conn.php';

// Check if reset and email parameters are set
if (isset($_GET["reset"]) && isset($_GET["email"])) {
    $email = htmlspecialchars($_GET["email"]); 
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["notify"] = "Invalid email format.";
        header("Location: ../sign_in.php");
        exit();
    }
    
    // Check if email exists in the database (optional)
    $sql = "SELECT * FROM voters WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        $_SESSION["notify"] = "Email not found.";
        header("Location: ../sign_in.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #FBF5DF;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .reset-password-box {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #d32f2f;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #b71c1c;
        }
    </style>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="reset-password-box">
        <h2 class="reset-password-title">Reset Password</h2>
        <form action="../admin/user_mailer.php" method="POST">
            <div class="form-group has-feedback">
            <input type="hidden" name="email" value="<?= htmlspecialchars($email); ?>">
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Set new password" name="password" required>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="OTP Code" name="otp" required>
            </div>
            <button type="submit" name="btn-new-password">Set Password</button>
        </form>
    </div>
    <script>
        <?php
        // Check if there's a session message to display
        if (isset($_SESSION['message'])) {
            $message = addslashes($_SESSION['message']);
            if (strpos($message, 'Your password has been reset successfully') !== false) {
                echo "Swal.fire({
                    title: 'Success',
                    text: '$message',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });";
            } else {
                echo "Swal.fire({
                    title: 'Error',
                    text: '$message',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });";
            }
            // Unset the message after displaying it
            unset($_SESSION['message']);
        }
        ?>
    </script>
</body>
</html>

