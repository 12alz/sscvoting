<?php

// Start session to use session variables
session_start();

// Include database connection
include "includes/conn.php";

// Check if the form is submitted
if (isset($_POST["btn-forgotpass"])) {
    
    // Ensure the username field is set
    if (isset($_POST["username"])) {
        $username = $_POST["username"];

        // Check if the email is already registered
        $sql = "SELECT * FROM microsoft WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // If the username is found in the database (email already registered)
        if ($result->num_rows > 0) {
            $_SESSION['message'] = 'Your MS365 is already registered!';
        } else {
            // If username is not found, proceed to generate the reset token
            $token = bin2hex(random_bytes(32)); // Generate a random token
            $expiration = date("Y-m-d H:i:s", strtotime("+3 minutes")); // Set expiration time

            // Update the token and expiration date in the database
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
            $mail->SMTPDebug = 0;  // Disable debugging output
            $mail->Host = 'smtp.gmail.com';  // SMTP server (Gmail)
            $mail->Port = 587;  // SMTP port
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Use TLS encryption
            $mail->SMTPAuth = true;
            $mail->Username = "santillanbsit@gmail.com";  // SMTP username (your email)
            $mail->Password = "svlwwvxfgrbtxqum";  // SMTP password (app password or normal password)
            $mail->setFrom('santillanbsit@gmail.com', 'Suprime Student Council');  // Sender email address and name
            $mail->addAddress($username);  // Recipient email address (the username entered by the user)
            $mail->isHTML(true);  // Send email as HTML

            // Email subject and body
            $mail->Subject = 'Register for MS365 Voting';
            $reset_url = "https://mccsscvoting.com/msfunction?token=$token";  // URL with token
            $mail->Body = "
                <p>Hi $username,</p>
                <p>You're invited to participate in our upcoming vote!</p>
                <p>To cast your vote, please click the link below to register your account:</p>
                <p><a href='$reset_url'>Register</a></p>
                <p><strong>Note:</strong> This link is only valid for 3 minutes.</p>
                <p>Sincerely,</p>
                <p>Suprime Student Council</p>
            ";

            // Send email and check if it was successful
            if ($mail->send()) {
                $_SESSION['message'] = 'MS365 Account sent successfully. Please check your Outlook inbox!';
            } else {
                $_SESSION['message'] = 'Failed to send email. Please try again.';
            }
        }

        // Close the database connection and statement
        $stmt->close();
        $conn->close();

        // Redirect to the verification page
        header("Location: ../verification");
        exit();
    }
}
?>
