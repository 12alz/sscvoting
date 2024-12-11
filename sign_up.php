<?php 
session_start();
include 'includes/conn.php';

function getUserIP() {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipArray = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($ipArray as $ip) {
            $ip = trim($ip);  
            if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                return $ip;  
            }
        }
    }

    if (!empty($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR'];
    }

    return 'UNKNOWN';  
}

if (isset($_POST['add'])) {
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Image upload logic
    $filename = $_FILES['photo']['name']; 
    $validImageExtensions = ['jpg', 'jpeg', 'png'];
    $imageExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // Check if the file is a valid image type
    if (!in_array($imageExtension, $validImageExtensions)) {
        $_SESSION['error'] = 'Invalid Image. Only JPG, JPEG, and PNG files are allowed.';
        header('Location: sign_in.php');
        exit();
    }

    // Create a unique filename to avoid overwriting existing files
    $newFilename = uniqid('photo_') . '.' . $imageExtension;

    // Check if the upload directory exists, create it if not
    $uploadDir = '../images/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create directory with write permissions
    }

    // Move the uploaded file to the server
    if ($_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $uploadedFilePath = $uploadDir . $newFilename;
        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $uploadedFilePath)) {
            $_SESSION['error'] = 'File upload failed. Please try again.';
            header('Location: sign_in');
            exit();
        }
    } else {
        $_SESSION['error'] = 'File upload error. Please try again.';
        header('Location: sign_in');
        exit();
    }

    $course = htmlspecialchars($_POST['course']);
    $status = htmlspecialchars($_POST['status']);
    $voters_id = htmlspecialchars($_POST['voters_id']);
    
    // Check if the user already exists
    $checkUser = "SELECT * FROM voters WHERE voters_id ='$voters_id' OR email='$email'";
    $result = mysqli_query($conn, $checkUser);
    $count = mysqli_num_rows($result);
    
    if ($count > 0) {
        $_SESSION['error'] = 'ID or email already exists';
        header('Location: sign_in');
        exit();
    } else {
        $ip_address = getUserIP();
        $username = $email;  

        // Insert the user data into the database
        $sql = "INSERT INTO voters (voters_id, password, firstname, lastname, email, course, status, photo) 
                VALUES ('$voters_id', '$password', '$firstname', '$lastname', '$email', '$course', '$status', '$newFilename')";
        
        if ($conn->query($sql)) {
            // Log the login attempt
            $log_sql = "INSERT INTO login_logs (ip_address, timestamp, username) 
                        VALUES ('$ip_address', NOW(), '$username')";
            
            if ($conn->query($log_sql)) {
                $_SESSION['success'] = 'Voter added successfully';
                header('Location: sign_in');
                exit();
            } else {
                $_SESSION['error'] = 'Failed to log the registration details: ' . $conn->error;
                header('Location: sign_in');
                exit();
            }
        } else {
            $_SESSION['error'] = 'Failed to Register: ' . $conn->error;
            header('Location: sign_in');
            exit();
        }
    }
} else {
    $_SESSION['error'] = 'Failed to Register';
    header('Location: sign_in');
    exit();
}
?>
