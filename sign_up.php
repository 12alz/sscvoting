<?php
session_start();
include 'includes/conn.php';

if (isset($_POST['add'])) {
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $filename = $_FILES['photo']['name'];
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $filename);
    $imageExtension = strtolower(end($imageExtension));

    // Validate image extension
    if (!in_array($imageExtension, $validImageExtension)) {
        $_SESSION['error'] = 'Invalid Image';
        header('Location: sign_in.php');
        exit;
    }

    // Generate a unique filename
    $uniqueFilename = uniqid() . '.' . $imageExtension;

    // Validate image file type
    $imageInfo = getimagesize($_FILES['photo']['tmp_name']);
    if ($imageInfo === false) {
        $_SESSION['error'] = 'The uploaded file is not a valid image.';
        header('Location: sign_in.php');
        exit;
    }

    // Ensure the images folder exists and is writable
    $uploadPath = 'images/' . $uniqueFilename;
    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $uploadPath)) {
        $_SESSION['error'] = 'Failed to upload the image.';
        header('Location: sign_in.php');
        exit;
    }

    // Insert user details into the database
    $course = htmlspecialchars($_POST['course']);
    $status = htmlspecialchars($_POST['status']);
    $voters_id = htmlspecialchars($_POST['voters_id']);
    
    $checkUser = "SELECT * FROM voters WHERE voters_id ='$voters_id' OR email='$email'";
    $result = mysqli_query($conn, $checkUser);
    $count = mysqli_num_rows($result);
    
    if ($count > 0) {
        $_SESSION['error'] = 'ID or MS365 already exists';
        header('Location: sign_in.php');
        exit;
    } else {
        $sql = "INSERT INTO voters (voters_id, password, firstname, lastname, email, course, status, photo) 
                VALUES ('$voters_id', '$password', '$firstname', '$lastname', '$email','$course', '$status', '$uniqueFilename')";
        
        if ($conn->query($sql)) {
            $_SESSION['success'] = 'Voter added successfully';
            header('Location: sign_in.php');
            exit;
        } else {
            $_SESSION['error'] = "Failed to Register";
            header('Location: sign_in.php');
            exit;
        }
    }
} else {
    $_SESSION['error'] = "Failed to Register";
    header('Location: sign_in');
}
?>
