<?php
session_start();
include "mailer.php";
include "includes/conn.php";


define('RESET_TIME_LIMIT', 300); // 300 seconds = 5 minutes

if (isset($_POST["btn_forgotpass"])) {
    $email = $_POST["email"];

   
    $sql = "SELECT * FROM voters WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        $_SESSION["notify"] = "Database error: Unable to prepare statement.";
        header("Location: ../forgot_password.php");
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $query = $stmt->get_result();

    if ($query->num_rows === 0) {
        $_SESSION["notify"] = "Email not found! Please contact the administrator to reset a password.";
        header("Location: ../forgot_password.php");
        exit();
    }

    // Check the last reset request time
        $row = $query->fetch_assoc();
        $last_request_time = $row['last_reset_request'] ?? 0; 

        if (time() - $last_request_time < RESET_TIME_LIMIT) {
          
            $remaining_time = RESET_TIME_LIMIT - (time() - $last_request_time);
            
          
            $remaining_minutes = floor($remaining_time / 60);
            $remaining_seconds = $remaining_time % 60;
         

            $_SESSION["notify"] = "Please wait $remaining_minutes minutes and $remaining_seconds seconds before requesting a new password reset link.";
            header("Location: ../forgot_password.php");
            exit();
        }


    
    $reset_code = random_int(100000, 999999);

   
    $sql = "UPDATE `voters` SET `code` = ?, `last_reset_request` = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        $_SESSION["notify"] = "Database error: Unable to prepare statement.";
        header("Location: ../forgot_password.php");
        exit();
    }

    $current_time = time();
    $stmt->bind_param("iis", $reset_code, $current_time, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
       
        $mail->SetFrom("sscvoting@do-not.reply");
        $mail->AddAddress($email);
        $mail->Subject = "Reset Password OTP";
        $mail->Body = "Use this OTP Code to reset your password: " . $reset_code . "<br/>" .
                      "Click the link to reset password: https://mccsscvoting.com/admin/user_reset_pass.php?reset&email=" . urlencode($email);

       
        if (!$mail->send()) {
            $_SESSION["notify"] = "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $_SESSION["notify"] = "Check your email for a link to reset your password.";
        }
    } else {
        $_SESSION["notify"] = "Failed to update the reset code. Please try again.";
    }

    
    header("Location: ../forgot_password.php");
    exit();
}

// Handle new password submission
if (isset($_POST["btn-new-password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $otp = $_POST["otp"];

    // Select the reset code from the database
    $sql = "SELECT `code` FROM `voters` WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        $_SESSION["notify"] = "Database error: Unable to prepare statement.";
        header("Location: ../sign_in.php");
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $query = $stmt->get_result();

    if ($query->num_rows > 0) {
        $res = $query->fetch_assoc();
        $get_code = $res["code"];

      
        if ($otp === $get_code) {
            // Hash the new password securely
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            
            $sql = "UPDATE `voters` SET `password` = ?, `code` = NULL WHERE email = ?";
            $stmt = $conn->prepare($sql);
            
            if (!$stmt) {
                $_SESSION['message'] = "Database error: Unable to prepare statement.";
                header("Location: ../sign_in.php");
                exit();
            }

            $stmt->bind_param("ss", $password_hashed, $email);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $_SESSION['message'] = "Your password has been reset successfully.";
                header("Location: ../sign_in.php");
             
            } else {
                $_SESSION['message'] = "Failed to reset the password. Please try again.";
            }
        } else {
            $_SESSION['message'] = "Invalid OTP. Please try again.";
        }
    } else {
        $_SESSION['message'] = "Email not found.";
    }
    $stmt->close();
    $conn->close();

    header("Location: ../admin/user_reset_pass.php");//huhay kalibug
    exit();
}

?>

