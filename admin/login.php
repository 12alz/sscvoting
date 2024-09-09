<?php
session_start();
include 'includes/conn.php';


$max_attempts = 10;
$delay_time = 1000; 

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_attempt_time'] = 0;
}

if (time() - $_SESSION['last_attempt_time'] < $delay_time && $_SESSION['login_attempts'] >= $max_attempts) {
    $_SESSION['error'] = 'Too many failed login attempts. Please try again after ' . ($delay_time - (time() - $_SESSION['last_attempt_time'])) . ' seconds.';
    header('location: ../sign_in.php');
    exit();
}

if (isset($_POST['login'])) {


    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param('s', $username); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows < 1) {

        $_SESSION['login_attempts']++;
        $_SESSION['last_attempt_time'] = time();
        $_SESSION['error'] = 'Could Not find account with username';
    } else {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Reset login attempts on successful login
            $_SESSION['login_attempts'] = 0;
            $_SESSION['admin'] = $row['id'];
            header('location: ../sign_in.php');
            exit();
        } else {
            // Increment login attempts
            $_SESSION['login_attempts']++;
            $_SESSION['last_attempt_time'] = time();
            $_SESSION['error'] = 'Incorrect username or password';
        }
    }
    $stmt->close();
} else {
    $_SESSION['error'] = 'Input admin credentials first';
}

header('location: ../sign_in.php');
exit();
?>
