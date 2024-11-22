<?php

include "mailer.php";
include "includes/conn.php";

header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline';");
session_start();
session_regenerate_id(true);

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => 'mccsscvoting.com',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict',
]);

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

// Handle password reset request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["btn-forgotpass"])) { 
    if (!hash_equals($_SESSION['token'], $_POST['token'])) {
        die("Invalid token"); 
    }

    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL); 
    if (!$email) {
        $_SESSION["notify"] = "Invalid email address";
        header("Location: ../forgot_password");
        exit();
    }

    $allowed_gmail = "villaceranjerson55@gmail.com"; 
    if ($email !== $allowed_gmail) {
        $_SESSION["notify"] = "Email not found! Please contact the administrator to reset a password.";
        header("location: ../forgotpass");
        exit();
    }

    // Generate OTP
    $reset_code = random_int(100000, 999999);
    
    // Update the reset code in the database
    $sql = "UPDATE `admin` SET `code`='$reset_code' WHERE email='$email'";

    if (mysqli_query($conn, $sql)) {
        // Send OTP email
        $mail->SetFrom("sscvoting@do-not.reply");
        $mail->AddAddress($email);
        $mail->Subject = "Reset Password OTP";
        $mail->Body = "Use this OTP Code to reset your password: $reset_code<br/>".
                      "Click the link to reset your password: https://mccsscvoting.com/admin/set-password?reset&email=$email";

        if (!$mail->send()) {
            $_SESSION["notify"] = "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $_SESSION["notify"] = "A reset link has been sent to your email.";
        }

        // Redirect to the forgot password page
        header("Location: ../forgotpass");
        exit();
    } else {
        $_SESSION["notify"] = "Failed to update the reset code. Please try again.";
        header("Location: ../forgotpass");
        exit();
    }
}

// Handle new password set
if (isset($_POST["btn-new-password"])) {
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];
    $otp = $_POST["otp"];

    if (!$email) {
        $_SESSION["notify"] = "Invalid email address";
        header("Location: ../sign_in");
        exit();
    }

    // Check if the email exists in the database
    $sql = "SELECT `code` FROM `admin` WHERE email='$email'";

    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $res = mysqli_fetch_assoc($query);
        $get_code = $res["code"];

        // Verify OTP
        if ($otp === $get_code) {
            // Hash the new password
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $reset_code = random_int(100000, 999999);

            // Update the password and reset code in the database
            $sql = "UPDATE `admin` SET `password`='$password_hashed', `code`='$reset_code' WHERE email='$email'";

            if (mysqli_query($conn, $sql)) {
                $_SESSION["notify"] = "Your password has been reset successfully.";
                header("Location: ../sign_in");
                exit();
            } else {
                $_SESSION["notify"] = "Failed to update password. Please try again.";
                header("Location: ../sign_in");
                exit();
            }
        } else {
            $_SESSION["notify"] = "Invalid OTP. Please try again.";
            header("Location: ../sign_in");
            exit();
        }
    } else {
        $_SESSION["notify"] = "Email not found.";
        header("Location: ../sign_in");
        exit();
    }
}

?>
