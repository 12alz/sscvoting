<?php

include "includes/conn.php";

if (isset($_POST["btn-forgotpass"])) {
    session_start();

    if (isset($_POST["username"])) {
        $username = $_POST["username"];

        // Check if the user is already registered by looking up the username in the database
        $check_user_sql = "SELECT * FROM microsoft WHERE username = ?";
        $check_user_stmt = $conn->prepare($check_user_sql);
        $check_user_stmt->bind_param("s", $username);
        $check_user_stmt->execute();
        $result = $check_user_stmt->get_result();

        if ($result->num_rows > 0) {
            // User already registered, show an alert message
            $_SESSION['message'] = 'You have already registered. Please check your email for further instructions.';
        } else {
            // Proceed with the registration process if the user is not registered
            // Generate a token for the password reset
            $token = bin2hex(random_bytes(32));
            $expiration = date("Y-m-d H:i:s", strtotime("+15 minutes"));

            // Update the database with the reset token and expiration
            $update_sql = "UPDATE microsoft SET reset_token = ?, token_expiration = ? WHERE username = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("sss", $token, $expiration, $username);
            $update_stmt->execute();
            $update_stmt->close();

            // Include PHPMailer classes
            require("PHPMailer/src/PHPMailer.php");
            require("PHPMailer/src/SMTP.php");
            require("PHPMailer/src/Exception.php");

            // Initialize PHPMailer
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

            // Check if the email was sent
            if ($mail->send()) {
                $_SESSION['message'] = 'MS365 Account email sent successfully. Please check your Outlook inbox!';
            } else {
                $_SESSION['message'] = 'Failed to send email. Please try again.';
            }
        }

        // Close the statement and connection
        $check_user_stmt->close();
        $conn->close();
        
        // Redirect to the verification page
        header("Location: ../verification");
        exit();
    }
}

?>
