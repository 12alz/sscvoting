<?php
// DO NOT TOUCH THIS SECTION ~ 
// These must be at the top of your script, not inside a function
require("PHPMailer/src/PHPMailer.php");
require("PHPMailer/src/SMTP.php");
require("PHPMailer/src/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);  // Create PHPMailer instance

$mail->CharSet = "UTF-8";
$mail->IsSMTP();  // Set mailer to use SMTP
$mail->Host = "smtp.gmail.com";  // Set the SMTP server to Gmail's SMTP
$mail->Port = 587;  // Port number for TLS (alternative: 465 for SSL)
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption
$mail->SMTPAuth = true;  // Enable SMTP authentication

$mail->Username = "santillanbsit@gmail.com";  // SMTP username (use environment variable or .env file for security)
$mail->Password = "svlwwvxfgrbtxqum";  // SMTP password (use environment variable or .env file for security)

// It is highly recommended to store your sensitive credentials (username/password) in environment variables or an encrypted config file.
// Example: getenv('SMTP_USERNAME') and getenv('SMTP_PASSWORD') for security reasons.

// Set email format to HTML
$mail->IsHTML(true);