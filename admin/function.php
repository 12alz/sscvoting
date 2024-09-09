<?php
include "mailer.php";
include "includes/conn.php";
if (isset($_POST["btn-forgotpass"])) {

    $email = $_POST["email"];
    $reset_code = random_int(100000, 999999);
    
    $sql = "UPDATE `admin` SET `code`='$reset_code' WHERE email='$email'";
 
    $query = mysqli_query($conn, $sql);
 
    if ($query) {
        
        //Set Params 
        $mail->SetFrom("sscvoting@do-not.reply");
        $mail->AddAddress("$email");
        $mail->Subject = "Reset Password OTP";
        $mail->Body = "Use this OTP Code to reset your password: ".$reset_code."<br/>".
        "Click the link to reset password: http://localhost/jerson/admin/set-password.php?reset&email=$email"  //pulihan $reset_coede
        ;


        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message has been sent";
        }

        //OTP has been sent please check your email
        $_SESSION["notify"] = "success";
 
         header("location: ../sign_in.php");
    }else {
 
        $_SESSION["notify"] = "failed";
 
        header("location: ../sign_in.php");
 
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

            $_SESSION["notify"] = "success";

            header("location: ../sign_in.php");
 
        }else {

            $_SESSION["notify"] = "invalid";

            header("location: ../sign_in.php");
            

        }

    }else {

            $_SESSION["notify"] = "invalid";

            header("location: ../sign_in.php");
 

    }
}


?>