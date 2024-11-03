<?php
include "includes/conn.php";
require("PHPMailer/src/PHPMailer.php");
require("PHPMailer/src/SMTP.php");
require("PHPMailer/src/Exception.php");
session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = trim($_POST['name']);
    $lastName = trim($_POST['last-name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $message = trim($_POST['message']);

    // Validate name
    if (empty($name) || !preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $errors[] = "Please enter a valid first name.";
    }

    // Validate last name
    if (empty($lastName) || !preg_match("/^[a-zA-Z\s]+$/", $lastName)) {
        $errors[] = "Please enter a valid last name.";
    }

    // Validate email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    // Validate phone (10-digit numeric)
    if (empty($phone) || !preg_match("/^09\d{9}$/", $phone)) {
        $errors[] = "Please enter a valid 11-digit phone number starting with 09.";
    }

    // Validate message
    if (empty($message) || strlen($message) < 0) {
        $errors[] = "Please Enter a message.";
    }

    // If there are no errors, proceed to send the email
    if (empty($errors)) {
        // Sanitize output to prevent XSS
        $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        $lastName = htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $phone = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
        $message = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')); 

        // Initialize PHPMailer for user notification
        $mailUser = new PHPMailer\PHPMailer\PHPMailer();
        $mailUser->isSMTP();
        $mailUser->SMTPDebug = 0; 
        $mailUser->Host = 'smtp.gmail.com';
        $mailUser->Port = 587;
        $mailUser->SMTPSecure = 'tls';
        $mailUser->SMTPAuth = true;
        $mailUser->Username = "santillanbsit@gmail.com";
        $mailUser->Password = "svlwwvxfgrbtxqum"; 
        
        // Notify the user
        $mailUser->setFrom('santillanbsit@gmail.com', 'Suprime Student Council');
        $mailUser->addAddress($email); // User's email address
        $mailUser->isHTML(true);
        
        // Email to the user
        $mailUser->Subject = 'New Contact Message from ' . $name . ' ' . $lastName;
        $mailUser->Body = "
            <p>Hi $name $lastName,</p>
            <p>Thank you for reaching out to us! We appreciate your message and will get back to you as soon as possible.</p>
            <p>This message has been received by the Suprime Student Council team.</p>
            <p>We look forward to connecting with you!</p>
            <p>Sincerely,</p>
            <p>Suprime Student Council</p>
        ";

        // Send the email to the user
        if (!$mailUser->send()) {
            $_SESSION['message'] = 'Failed to send email to user. Please try again.';
        }

        // Initialize PHPMailer for council notification
        $mailCouncil = new PHPMailer\PHPMailer\PHPMailer();
        $mailCouncil->isSMTP();
        $mailCouncil->SMTPDebug = 0; 
        $mailCouncil->Host = 'smtp.gmail.com';
        $mailCouncil->Port = 587;
        $mailCouncil->SMTPSecure = 'tls';
        $mailCouncil->SMTPAuth = true;
        $mailCouncil->Username = "santillanbsit@gmail.com";
        $mailCouncil->Password = "svlwwvxfgrbtxqum";

        // Notify the Suprime Student Council
        $councilEmail = "villaceranjerson55@gmail.com";
        $mailCouncil->setFrom('santillanbsit@gmail.com', 'Suprime Student Council');
        $mailCouncil->addAddress($councilEmail);
        $mailCouncil->isHTML(true);
        
        // Email for the council notification
        $mailCouncil->Subject = 'New Contact Message from ' . $name . ' ' . $lastName . ' (Notification)';
        $mailCouncil->Body = "
            <p>You have received a new contact message:</p>
            <p><strong>From:</strong> $name $lastName<br>
               <strong>Email:</strong> $email<br>
               <strong>Phone:</strong> $phone<br>
               <strong>Message:</strong><br>$message</p>
            <p>Please respond to the sender as soon as possible.</p>
        ";

        // Send the email to the council
        if (!$mailCouncil->send()) {
            $_SESSION['message'] = 'Failed to send email to council. Please try again.';
        } else {
            $_SESSION['message'] = 'Messages sent successfully! Please check your email.';
        }
    } else {
        // Display errors
        $_SESSION['message'] = ''; // Reset previous messages
        foreach ($errors as $error) {
            $_SESSION['message'] .= "$error";
        }
    }

    // Redirect to contacts page
    header("Location: ../contacts.php");
    exit();
} else {
    // Handle non-POST requests if needed
}
?>
