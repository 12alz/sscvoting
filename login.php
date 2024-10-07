<?php
session_start();
include 'includes/conn.php';

if (isset($_POST['login'])) {
    // Verify reCAPTCHA response
    $recaptchaSecret = '6LeFsVkqAAAAADwZFdcBquzrg4nHk8y0bSe6JlE4';
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$recaptchaSecret.'&response='.$recaptchaResponse);
    $responseData = json_decode($verifyResponse);

    if (!$responseData->success) {
        $_SESSION['error'] = 'reCAPTCHA verification failed. Please try again.';
        header('Location: sign_in.php');
        exit();
    }
    $voter = $_POST['voter'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM voters WHERE voters_id = ?");
    $stmt->bind_param("s", $voter);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['recstat'] == '0') {
            if (password_verify($password, $row['password'])) {
                $_SESSION['voter'] = $row['id'];
                header('Location: home.php');
                exit;
            } else {
                $_SESSION['error'] = 'Incorrect password';
            }
        } else {
            $_SESSION['error'] = 'You don’t have permission to login';
        }
    } else {
        $_SESSION['error'] = 'Cannot find voter with the ID';
    }
} else {
    $_SESSION['error'] = 'Input voter credentials first';
}
header('Location: sign_in.php');
exit;
?>
