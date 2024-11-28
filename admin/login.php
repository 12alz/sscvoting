<?php
session_start();
include 'includes/conn.php';

if (isset($_POST['login'])) {
    // Sanitize input
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL); 
    $password = $_POST['password'];

    // Check login attempts
    $loginAttemptsQuery = "SELECT attempts, last_attempt_time FROM login_attempts WHERE username = ?";
    $stmt = $conn->prepare($loginAttemptsQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();  // Corrected method: fetch_assoc() instead of fetch_Assoc()

    // Default values if no record found
    $attemptsCount = $row ? $row['attempts'] : 0;
    $lastAttempts = $row ? strtotime($row['last_attempt_time']) : 0;
    $nowTimestamp = time();
    $timeoutDuration = 300; // Timeout in seconds (5 minutes)

    // Check if too many attempts have been made within the timeout period
    if ($attemptsCount >= 3 && ($nowTimestamp - $lastAttempts) < $timeoutDuration) {
        $timeWait = ($nowTimestamp - $lastAttempts);
        $remainMin = ceil(($timeoutDuration - $timeWait) / 60);

        $_SESSION['error'] = "Too many login attempts. Please try again later. Wait: $remainMin minutes.";
        $stmt->close();
        $conn->close(); // Close the database connection to avoid further actions
        die();  // Terminate script execution
    } else {
        // Check user credentials
        $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows < 1) {
            // No user found
            $_SESSION['error'] = 'Incorrect email or password';
            updateLoginAttempts($conn, $email);
            $stmt->close();
            $conn->close(); // Close the database connection to avoid further actions
            die();  // Terminate script execution
        } else {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Reset login attempts on successful login
                $_SESSION['admin'] = $row['id'];
                resetLoginAttempts($conn, $email);
                $stmt->close();
                $conn->close(); // Close the database connection to avoid further actions
                header('Location: ../home');  // Redirect to home after successful login
                exit();
            } else {
                // Incorrect password
                $_SESSION['error'] = 'Incorrect email or password';
                updateLoginAttempts($conn, $email);
                $stmt->close();
                $conn->close(); // Close the database connection to avoid further actions
                die();  // Terminate script execution
            }
        }
    }
} else {
    $_SESSION['error'] = 'Input admin credentials first';
    $conn->close(); // Close the database connection to avoid further actions
    die();  // Terminate script execution
}

header('Location: ../sign_in');  // Redirect back to login page if not logged in or an error occurred
exit();

// Helper function to update login attempts in database
function updateLoginAttempts($conn, $email) {
    $updateQuery = "INSERT INTO login_attempts (username, attempts, last_attempt_time)
                    VALUES (?, 1, NOW()) 
                    ON DUPLICATE KEY UPDATE attempts = attempts + 1, last_attempt_time = NOW()";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->close();
}

// Helper function to reset login attempts in database
function resetLoginAttempts($conn, $email) {
    $updateQuery = "UPDATE login_attempts SET attempts = 0, last_attempt_time = NULL WHERE username = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->close();
}
?>
