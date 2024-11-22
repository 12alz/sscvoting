<?php
include "mailer.php";
include "includes/conn.php";

header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline';");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: no-referrer");
header("Permissions-Policy: geolocation=()");

session_start();
session_regenerate_id(true); // Regenerate session ID for security

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => 'mccsscvoting.com',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict',
]);

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32)); // Generate a secure token
}

// Handle forgot password request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["btn_forgotpass"])) { 
    if (!hash_equals($_SESSION['token'], $_POST['token'])) {
        die(); // Token mismatch, halt further processing
    }

    // Validate email address
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $_SESSION["notify"] = "Invalid email address";
        header("Location: ../forgot_password");
        exit();
    }

    // Hardcoded allowed email address for demonstration purposes (replace as needed)
    $allowed_gmail = "villaceranjerson55@gmail.com";
    if ($email !== $allowed_gmail) {
        $_SESSION["notify"] = "Email not found! Please contact the administrator to reset a password.";
        header("Location: ../forgetpass.php");
        exit();
    }

    // Generate OTP (reset code)
    $reset_code = random_int(100000, 999999);

    // Update reset code in the database using prepared statements
    $sql = "UPDATE `admin` SET `code`=? WHERE email=?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        $_SESSION["notify"] = "Database error: Unable to prepare statement.";
        header("Location: ../forgetpass.php");
        exit();
    }

    $stmt->bind_param("is", $reset_code, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Send OTP to the user's email
        $mail->SetFrom("sscvoting@do-not.reply");
        $mail->AddAddress($email);
        $mail->Subject = "Reset Password OTP";
        $mail->Body = "Use this OTP Code to reset your password: " . $reset_code . "<br/>" .
                      "Click the link to reset password: https://mccsscvoting.com/admin/set-password?reset&email=" . urlencode($email);

        if (!$mail->send()) {
            $_SESSION["notify"] = "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $_SESSION["notify"] = "A reset link has been sent to your email.";
        }

        header("Location: ../forgetpass");
        exit();
    } else {
        $_SESSION["notify"] = "Failed to update the reset code. Please try again.";
        header("Location: ../forgetpass");
        exit();
    }
}

// Handle new password submission
if (isset($_POST["btn-new-password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $otp = $_POST["otp"];

    // Fetch the reset code from the database using prepared statements
    $sql = "SELECT `code` FROM `admin` WHERE email=?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        $_SESSION["notify"] = "Database error: Unable to prepare statement.";
        header("Location: ../sign_in");
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $query = $stmt->get_result();

    if ($query->num_rows > 0) {
        $res = $query->fetch_assoc();
        $get_code = $res["code"];

        // Verify OTP and reset the password if valid
        if ($otp === $get_code) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Securely hash the new password

            // Generate new reset code
            $reset_code = random_int(100000, 999999);

            // Update the password and reset code in the database using prepared statements
            $sql = "UPDATE `admin` SET `password`=?, `code`=? WHERE email=?";
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                $_SESSION["notify"] = "Database error: Unable to prepare statement.";
                header("Location: ../sign_in");
                exit();
            }

            $stmt->bind_param("sis", $hashed_password, $reset_code, $email);
            $stmt->execute();

            $_SESSION["notify"] = "Your password has been reset successfully.";
            header("Location: ../sign_in");
            exit();
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
