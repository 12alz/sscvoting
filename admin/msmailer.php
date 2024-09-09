<?php

include "includes/conn.php";

if (isset($_POST["btn-forgotpass"])) {
    if (isset($_POST["username"])) {
        $username = $_POST["username"];

        
        $sql = "SELECT * FROM microsoft WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Include PHPMailer classes
            require("PHPMailer/src/PHPMailer.php");
            require("PHPMailer/src/SMTP.php");
            require("PHPMailer/src/Exception.php");

            // Initialize PHPMailer
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = 1; // Set to 1 for debug output
            $mail->Host = 'smtp.office365.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = 'alevillaceran@outlook.com'; // Your email address
            $mail->Password = 'alexandre1234'; // Your email password
            $mail->setFrom('alevillaceran@outlook.com');
            $mail->addAddress($username); // Email address to send to
            $mail->isHTML(true);

            $mail->Subject = 'Register';
            $mail->Body = "Use this link to register your account: <br/>".
                          "<a href='http://localhost/jerson/msfunction.php'>Click here to register</a>"; // Use an anchor tag for a clickable link

            if ($mail->send()) {
                header('Location: ../verification.php?status=success&message=' . urlencode('Message has been sent please check your ms365 account.'));
                exit(); // Ensure no further code is executed
            } else {
                header('Location: ../verification.php?status=error&message=' . urlencode('Message could not be sent.'));
                exit(); // Ensure no further code is executed
            }
        } else {
            header('Location: ../verification.php?status=error&message=' . urlencode('Please enter an email address with the mcclawis.edu.ph'));
            exit(); // Ensure no further code is executed
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        header('Location: ../verification.php?status=error&message=' . urlencode('Username field is missing.'));
        exit(); // Ensure no further code is executed
    }
}
?>
