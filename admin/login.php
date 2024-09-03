'-<?php
session_start();
include 'includes/conn.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param('s', $username); // 's' specifies the type => 'string'
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows < 1) {
        $_SESSION['error'] = 'Incorrect username or passwordssss';
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
    $_SESSION['error'] = 'Input admin credentials first';
}

header('location: ../sign_in.php');
exit();
?>
