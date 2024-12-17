<?php

include "includes/conn.php";

if (isset($_POST["btn-forgotpass"])) {
    session_start();


    if (isset($_POST["username"])) {
        $username = $_POST["username"];

        $sql = "SELECT * FROM microsoft WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
           
            $token = bin2hex(random_bytes(32));
            $expiration = date("Y-m-d H:i:s", strtotime("+3 minutes"));

            
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
            $reset_url = "https://mccsscvoting.com/msfunction.php?token=$token&email=$username&firstname=$firstname&lastname=$lastname";
            $mail->Body = "
                <p>Hi $username,</p>
                <p>You're invited to participate in our upcoming vote!</p>
                <p>To cast your vote, please click the link below to register your account:</p>
                <p><a href='$reset_url'>Register</a></p>
                <p><strong>Note:</strong> This link is only valid for 3 minutes.</p>
                <p>Sincerely,</p>
                <p>Suprime Student Council</p>
            ";
            
            if ($mail->send()) {
                $_SESSION['message'] = 'MS365 Account sent successfully. Please check your Outlook inbox!';
            } else {
                $_SESSION['message'] = 'Failed to send email. Please try again.';
            }
        } else {
            $_SESSION['message'] = 'MS365 account not found. Please check and try again.';
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
        
        header("Location: ../verification");
        exit();
    }
}

?>
