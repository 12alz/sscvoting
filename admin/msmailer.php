<?php

include "includes/conn.php";

if (isset($_POST["btn-forgotpass"])) {
    session_start(); // Start session to use session variables

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
            $mail->SMTPDebug = 0; // Set to 0 for no debug output
            $mail->Host = 'smtp.office365.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = 'kamatyanun@outlook.com'; // Your email address
            $mail->Password = 'alexandre@123'; // Your email password
            $mail->setFrom('kamatyanun@outlook.com');
            $mail->addAddress($username); // Email address to send to
            $mail->isHTML(true);

            $mail->Subject = 'Register';
            $reset_url = "https://mccsscvoting.com/msfunction.php";
            $mail->Body = "
                         <p>Hi $username,</p>
                <p>You're invited to participate in our upcoming vote!</p>
                <p>Please click the link below to register your account:</p>
                <p><a href='$reset_url'>Register</a></p>
                <p>Please note that voting is only available for a limited time. Don't miss out on your chance to make a difference!</p>
                <p>Sincerely,</p>
                <p>Suprime Student Council</p>
                        ";

            if ($mail->send()) {
                header("Location: ../verification.php?status=success&message=Registration link sent successfully. Please Check your Outlook inbox!");
            } else {
                header("Location: ../verification.php?status=error&message=Failed to send registration link.");
            }
        } else {
            header("Location: ../verification.php?status=error&message=Email not found.");
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        header("Location: ../verification.php?status=error&message=Username is required.");
    }

    exit();
}
?>
