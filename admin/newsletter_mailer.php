<?php
session_start();
include "includes/conn.php";

if (isset($_POST["btn-subscribe"])) {
    session_start();

    if (isset($_POST["email"])) {
        $email = $_POST["email"];

        // Check if the email is already subscribed
        $sql = "SELECT * FROM newsletter_subscribers WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Insert the email into the database
            $insert_sql = "INSERT INTO newsletter_subscribers (email) VALUES (?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("s", $email);
            $insert_stmt->execute();
            $insert_stmt->close();

            // Include PHPMailer classes
            require("PHPMailer/src/PHPMailer.php");
            require("PHPMailer/src/SMTP.php");
            require("PHPMailer/src/Exception.php");

            // Initialize PHPMailer
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = 0; // Set to 0 for no debug output
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = "santillanbsit@gmail.com";
            $mail->Password = "svlwwvxfgrbtxqum"; // Your email password
            $mail->setFrom('santillanbsit@gmail.com', 'Madridejos Community College Newsletter');
            $mail->addAddress($email);
            $mail->isHTML(true);

            $mail->Subject = 'Welcome to Our Newsletter!';
            $mail->Body = "
                <p>Hi there,</p>
                <p>Thank you for subscribing to our newsletter!</p>
                <p>You'll now receive the latest  news, special events, and student activities delivered right to your inbox.</p>
                <p>Sincerely,</p>
                <p>Suprime Student Council</p>
            ";

            if ($mail->send()) {
                $_SESSION['message'] = 'Subscription successful! Please check your inbox.';
            } else {
                $_SESSION['message'] = 'Failed to send confirmation email. Please try again.';
            }
        } else {
            $_SESSION['message'] = 'This email is already subscribed.';
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
        
        header("Location: ../classic-news.php");
        
        exit();
        
       
    }
}
?>
