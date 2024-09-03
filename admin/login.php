<?php
session_start();
include 'includes/conn.php';

if (isset($_POST['login'])) {
    // Sanitize input
    $username = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['username']); 
    $password = $_POST['password'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param('s', $username); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows < 1) {
        $_SESSION['error'] = 'Incorrect username or password';
    } else {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $row['id'];
			header('location: ../sign_in.php');
            exit();
        } else {
            $_SESSION['error'] = 'Incorrect username or password';
        }
    }
    $stmt->close();
} else {
    $_SESSION['error'] = 'Input admin credentials ssssfirst';
}

header('location: ../sign_in.php');
exit();
?>
