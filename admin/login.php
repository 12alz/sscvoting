<?php
session_start();
include 'includes/conn.php';

if (isset($_POST['login'])) {
    // Sanitize input
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL); 
    $password = $_POST['password'];

    // Check login attempts
    $loginAttempts = "SELECT attempts, last_attempt_time FROM login_attempts WHERE username = ?";
    $stmt = $conn->prepare($loginAttempts);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_Assoc();

    $attemptsCount = $row['attempts'];
    $lastAttempts = strtotime($row['last_attempt_time']);
    $nowTimestamp = time();
    $timeoutDuration = 300; // in seconds

    //$attemptsCount >= 3 &&
    if(($nowTimestamp - $lastAttempts) < $timeoutDuration){
        $timeWait = ($nowTimestamp - $lastAttempts);
        $timeRemaining = ceil(($timeoutDuration - $timeWait) / 60);
        $_SESSION['error'] = 'Too many login attempts. Please try again later."\n"'.'Wait: '. $timeRemaining; 
    }else{
        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?"); 
        $stmt->bind_param('s', $email); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows < 1) {
            $_SESSION['error'] = 'Incorrect email or password'; 
        } else {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Reset login attempts on successful login
                $_SESSION['admin'] = $row['id'];
                $updateLoginAttempts = "UPDATE login_attempts SET attempts = 0, last_attempt_time = NULL 
                WHERE username = ?";
                $stmt = $conn->prepare($updateLoginAttempts);
                $stmt->bind_param('s', $email);
                $stmt->execute();
                header('location: ../sign_in.php');
                exit();
            } else {
                $_SESSION['error'] = 'Incorrect email or password'; 
                $updateLoginAttempts = "INSERT INTO login_attempts (username, attempts, last_attempt_time)
                VALUE (?, 1, NOW()) ON DUPLICATE KEY UPDATE attempts = attempts + 1, last_attempt_time = NOW()";
                // $updateLoginAttempts = "UPDATE login_attempts SET attempts = attempts+1, last_attempt_time = NOW() 
                // WHERE username = ?";
                $stmt = $conn->prepare($updateLoginAttempts);
                $stmt->bind_param('s', $email);
                $stmt->execute();
            }
        }
    }
    $stmt->close();
} else {
    $_SESSION['error'] = 'Input admin credentials first';
}

header('location: ../sign_in.php');
exit();
?>
