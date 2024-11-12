<?php
session_start();
include 'includes/conn.php';

if (isset($_POST['add'])) {
    // Sanitize and validate input data
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $voters_id = htmlspecialchars($_POST['voters_id']);
    $course = htmlspecialchars($_POST['course']);
    $status = htmlspecialchars($_POST['status']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email format';
        header('Location: sign_up.php');
        exit;
    }

    // Validate password (should have at least 8 characters, 1 letter, 1 number, and 1 special character)
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        $_SESSION['error'] = 'Password must be at least 8 characters long and include a letter, number, and special character';
        header('Location: sign_up.php');
        exit;
    }

    // Hash password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // File upload handling
    $filename = $_FILES['photo']['name'];
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // Check if the file extension is valid
    if (!in_array($imageExtension, $validImageExtension)) {
        $_SESSION['error'] = 'Invalid image. Only JPG, JPEG, and PNG are allowed.';
        header('Location: sign_up.php');
        exit;
    }

    // Check if the image file is uploaded without errors
    if ($_FILES['photo']['error'] != 0) {
        $_SESSION['error'] = 'Error uploading the image';
        header('Location: sign_up.php');
        exit;
    }

    // Check if the image is not too large (max 5MB)
    if ($_FILES['photo']['size'] > 5000000) {
        $_SESSION['error'] = 'Image size is too large. Maximum size is 5MB.';
        header('Location: sign_up.php');
        exit;
    }

    // Set a unique name for the image to avoid overwriting
    $newFileName = uniqid('', true) . '.' . $imageExtension;
    $uploadPath = '../images/' . $newFileName;

    // Move uploaded file to the server's image folder
    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $uploadPath)) {
        $_SESSION['error'] = 'Failed to upload image';
        header('Location: sign_up.php');
        exit;
    }

    // Check if the user already exists
    $checkUser = $conn->prepare("SELECT * FROM voters WHERE voters_id = ? OR email = ?");
    $checkUser->bind_param('ss', $voters_id, $email);
    $checkUser->execute();
    $result = $checkUser->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['error'] = 'ID or email already exists';
        header('Location: sign_up.php');
        exit;
    }

    // Prepare SQL query to insert new user
    $sql = "INSERT INTO voters (voters_id, password, firstname, lastname, email, course, status, photo) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssss', $voters_id, $password, $firstname, $lastname, $email, $course, $status, $newFileName);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Voter added successfully';
        header('Location: sign_in.php');
        exit;
    } else {
        $_SESSION['error'] = 'Failed to register. Please try again.';
        header('Location: sign_up.php');
        exit;
    }
} else {
    $_SESSION['error'] = 'Invalid request';
    header('Location: sign_up.php');
    exit;
}
?>
