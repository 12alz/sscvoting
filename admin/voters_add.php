<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
    // Properly using htmlspecialchars to prevent XSS attacks
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $filename = $_FILES['photo']['name'];
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $filename);
    $imageExtension = strtolower(end($imageExtension));

    // Check if the image extension is valid
    if (!in_array($imageExtension, $validImageExtension)) {
        $_SESSION['error'] = 'Invalid Image Extension';
    } else {
        // Process image upload if it exists
        if (!empty($filename)) {
            // Sanitize filename to avoid potential issues with special characters
            $filename = uniqid() . '.' . $imageExtension;  // Create a unique filename

            // Move the uploaded file to the images directory
            if (move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $filename)) {
                // Continue with the rest of the form processing
            } else {
                $_SESSION['error'] = 'Failed to upload image.';
                header('location: voters');
                exit();
            }
        }

        // Capture other form values
        $course = $_POST['course'];
        $voters_id = $_POST['voters_id'];

        // Check if the voter ID already exists in the database
        $checkUser = "SELECT * FROM voters WHERE voters_id = '$voters_id'";
        $result = mysqli_query($conn, $checkUser);
        $count = mysqli_num_rows($result);

        // If voter ID exists, show an error message
        if ($count > 0) {
            $_SESSION['error'] = 'Voter already exists with this ID.';
        } else {
            // Insert the new voter data into the database
            $sql = "INSERT INTO voters (voters_id, password, firstname, lastname, email, course, status, photo) 
                    VALUES ('$voters_id', '$password', '$firstname', '$lastname', '$course', 'active', '$filename')";

            // Execute the SQL query and handle errors
            if ($conn->query($sql)) {
                $_SESSION['success'] = 'Voter added successfully';
            } else {
                $_SESSION['error'] = $conn->error;
            }
        }
    }
}

// Redirect back to the voters page
header('location: voters');
exit();
?>
