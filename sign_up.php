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
    
    // Removed image handling
    $filename = $_FILES['photo']['name']; 
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $filename);
    $imageExtension = strtolower(end($imageExtension));
    
    // If no image, assign a default photo or set to NULL.
    $filename = 'default_photo.png';  // Example: Use a default image or NULL for no photo

    // Removed the image validation code
    if (!in_array($imageExtension, $validImageExtension)) {
        $_SESSION['error'] = 'Invalid Image';
        header('Location: sign_in.php');
    } else {
        if (!empty($filename)) {    
            move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $filename);   
        }
    }

    $course = htmlspecialchars($_POST['course']);
    $status = htmlspecialchars($_POST['status']);
    $voters_id = htmlspecialchars($_POST['voters_id']);
    $checkUser = "SELECT * FROM voters WHERE voters_id ='$voters_id' OR email='$email'";
    $result = mysqli_query($conn, $checkUser);
    $count = mysqli_num_rows($result);
    
    if ($count > 0) {
        $_SESSION['error'] = 'ID or email already exists';
        header('Location: sign_in.php');
    } else {
        $ip_adress = getUserIP();
        $username = $email;  
        
        $sql = "INSERT INTO voters (voters_id, password, firstname, lastname, email, course, status, photo) 
                VALUES ('$voters_id', '$password', '$firstname', '$lastname', '$email','$course', '$status', '$filename')";
        
        if ($conn->query($sql)) {
            $log_sql = "INSERT INTO login_logs (ip_adress, timestamp, username) 
                        VALUES ('$ip_adress', NOW(), '$username')";
            
            if ($conn->query($log_sql)) {
                $_SESSION['success'] = 'Voter added successfully';
                header('Location: sign_in.php');
            } else {
                $_SESSION['error'] = 'Failed to log the registration details: ' . $conn->error;
                header('Location: sign_in.php');
            }
        } else {
            $_SESSION['error'] = 'Failed to Register: ' . $conn->error;
            header('Location: sign_in.php');
        }
    }
} else {
    $_SESSION['error'] = 'Failed to Register';
    header('Location: sign_in.php');
}
?>
