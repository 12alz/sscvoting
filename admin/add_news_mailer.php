<?php
include "includes/conn.php";
session_start(); // Start the session

if (isset($_POST["btn-add-news"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];

    $sql = "INSERT INTO news (title, content) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $title, $content);
    
    if ($stmt->execute()) {
        // Notify subscribers
        if (notifySubscribers($title, $content)) {
            $_SESSION['success'] = "News added successfully!";
        } else {
            $_SESSION['error'] = "Failed to notify subscribers.";
        }
    } else {
        $_SESSION['error'] = "Failed to add news.";
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the same page to display messages
    header("Location: ../admin/add_news");
    exit();
}

function notifySubscribers($title, $content) {
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
    $mail->Password = "svlwwvxfgrbtxqum"; // Your email password
    $mail->setFrom('santillanbsit@gmail.com', 'Madridejos Community College Newsletter');

    // Fetch subscribers
    global $conn; // Use the global connection
    $sql = "SELECT email FROM newsletter_subscribers";
    $result = $conn->query($sql);

    // Collect emails for BCC
    $bccEmails = [];
    while ($row = $result->fetch_assoc()) {
        $bccEmails[] = $row['email'];
    }

    // Add BCC addresses
    foreach ($bccEmails as $email) {
        $mail->addBCC($email);
    }

    $mail->isHTML(true);
    $mail->Subject = "News Update: $title";
    $mail->Body = "<h1>$title</h1><p>$content</p>";

    if (!$mail->send()) {
        return false; // Return false if email fails
    }
    
    return true; // Return true if email sent successfully
}
?>
