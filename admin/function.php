<?php
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: no-referrer");
header("Permissions-Policy: geolocation=()");


session_start();
include "mailer.php";
include "includes/conn.php";
if (isset($_POST["btn-forgotpass"])) {
    $email = $_POST["email"];
    
    $allowed_gmail = "villaceranjerson55@gmail.com";
    if ($email !== $allowed_gmail) {
        // If the email doesn't match, show a message or redirect
        $_SESSION["notify"] = "Email not found! Please contact the administrator to reset a password.";
        header("location: ../forgetpass.php");
        exit();
    }

    $reset_code = random_int(100000, 999999);
    
    $sql = "UPDATE `admin` SET `code`='$reset_code' WHERE email='$email'";
 
    $query = mysqli_query($conn, $sql);
 
    if ($query) {
        
        //Set Params 
        $mail->SetFrom("sscvoting@do-not.reply");
        $mail->AddAddress("$email");
        $mail->Subject = "Reset Password OTP";
        $mail->Body = "Use this OTP Code to reset your password: ".$reset_code."<br/>".
        "Click the link to reset password:  https://mccsscvoting.com/admin/set-password?reset&email=$email"  //pulihan $reset_coede
        ;


        if (!$mail->send()) {
            $_SESSION["notify"] = "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $_SESSION["notify"] = "A reset link has been sent to your email.";
        }

        // Redirect to the forgot password page
        header("Location: ../forgetpass");
        exit();
    } else {
        $_SESSION["notify"] = "Failed to update the reset code. Please try again.";
        header("Location: ../forgetpass");
        exit();
    }
}
 // new password 
 if (isset($_POST["btn-new-password"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];
    $otp = $_POST["otp"];



    $sql = "SELECT `code` FROM `admin` WHERE email='$email'";

    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {

        while ($res = mysqli_fetch_assoc($query)) {

            $get_code = $res["code"];

        }

        if ($otp === $get_code) {

           

            $reset = random_int(100000, 999999);
             $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE `admin` SET `password`='$password', `code`=$reset  WHERE email='$email'";

            $query = mysqli_query($conn, $sql);

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