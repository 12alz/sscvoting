<?php
include "includes/conn.php";

if (isset($_POST["btn-forgotpass"])) {
    session_start();

    // Ensure the username field is set
    if (isset($_POST["username"]) && !empty($_POST["username"])) {
        $username = $_POST["username"];

        // Sanitize the username input to avoid any injection
        $username = htmlspecialchars($username);

        // Check if the user is already registered by looking up the username in the database
        $check_user_sql = "SELECT * FROM microsoft WHERE username = ?";
        $check_user_stmt = $conn->prepare($check_user_sql);
        $check_user_stmt->bind_param("s", $username);
        $check_user_stmt->execute();
        $result = $check_user_stmt->get_result();

        if ($result->num_rows > 0) {
          
            $user = $result->fetch_assoc();

            if ($user['is_registered'] == 1) {
             
                $_SESSION['message'] = 'You have already registered. Please check your email for further instructions.';
            } else {
              

            
                $token = bin2hex(random_bytes(32));
                $expiration = date("Y-m-d H:i:s", strtotime("+15 minutes"));

          
                $update_sql = "UPDATE microsoft SET reset_token = ?, token_expiration = ?, is_registered = 1 WHERE username = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("sss", $token, $expiration, $username);
                $update_stmt->execute();
                $update_stmt->close();

                
                require("PHPMailer/src/PHPMailer.php");
                require("PHPMailer/src/SMTP.php");
                require("PHPMailer/src/Exception.php");

         
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Username = "santillanbsit@gmail.com";
                $mail->Password = "svlwwvxfgrbtxqum";
                $mail->setFrom('santillanbsit@gmail.com', 'Suprime Student Council');
                $mail->addAddress($username);
                $mail->isHTML(true);

                $mail->Subject = 'Register';
                $reset_url = "https://mccsscvoting.com/msfunction?token=$token";
                $mail->Body = "
                    <p>Hi $username,</p>
                    <p>You're invited to participate in our upcoming vote!</p>
                    <p>To cast your vote, please click the link below to register your account:</p>
                    <p><a href='$reset_url'>Register</a></p>
                    <p><strong>Note:</strong> This link is only valid for 15 minutes.</p>
                    <p>Sincerely,</p>
                    <p>Suprime Student Council</p>
                ";

                if ($mail->send()) {
                    $_SESSION['message'] = 'MS365 Account email sent successfully. Please check your Outlook inbox!';
                } else {
                    $_SESSION['message'] = 'Failed to send email. Please try again.';
                }
            }
        } else {
           
            $_SESSION['message'] = 'MS365 account not found. Please check and try again.';
        }

       
        $check_user_stmt->close();
        $conn->close();
        
       
        header("Location: ../verification");
        exit();
    } else {
        $_SESSION['message'] = 'Please provide a valid username!';
        header("Location: ../verification");
        exit();
    }
}
?>
