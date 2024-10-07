<?php
if (isset($_POST['login'])) {
    // Verify reCAPTCHA response
    $recaptchaSecret = '6LeFsVkqAAAAADwZFdcBquzrg4nHk8y0bSe6JlE4'; 
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$recaptchaSecret.'&response='.$recaptchaResponse);
    $responseData = json_decode($verifyResponse);

    if (!$responseData->success) {
        $_SESSION['error'] = 'reCAPTCHA verification failed. Please try again.';
        header('location: ../sign_in.php');
        exit();
    };

    // Check login attempts
    $loginAttempts = "SELECT attempts, last_attempt_time FROM login_attempts WHERE username = ?";
    $stmt = $conn->prepare($loginAttempts);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_Assoc();

    $attemptsCount = $row['attempts'];
    $lastAttempts = $row['last_attempt_time'];
    $nowTimestamp = time();
    $timeoutDuration = 30; // in seconds

    if($attemptsCount >= 3 && ($nowTimestamp - $lastAttempts) < $timeoutDuration){
        $timeWait = ($nowTimestamp - $lastAttempts);
        $_SESSION['error'] = 'Too many login attempts. Please try again later."\n"'.'Wait: '.$timeWait; 
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
