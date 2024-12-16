<?php
session_start();
include 'includes/conn.php';

// Check if the user is logged in and retrieve their role
$isBSITRepresentative = false;
$isBSEDRepresentative = false;
$isBEEDRepresentative = false;
$isBSHMRepresentative = false;

// Assuming the user is logged in and their user_id is stored in the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT status FROM voters WHERE voters_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Assuming 'representative' status indicates a representative
        if ($row['status'] == 'representative') {
            // Check what courses the representative can manage
            $isBSITRepresentative = true;  // For BSIT
            $isBSEDRepresentative = true;  // For BSED
            $isBEEDRepresentative = true; // For BEED
            $isBSHMRepresentative = true; // For BSHM
        }
    }
}

// Filter the courses available based on the user's role
$coursesAvailable = [];

if ($isBSITRepresentative) {
    $coursesAvailable[] = 'BSIT';
}
if ($isBSEDRepresentative) {
    $coursesAvailable[] = 'BSED';
}
if ($isBEEDRepresentative) {
    $coursesAvailable[] = 'BEED';
}
if ($isBSHMRepresentative) {
    $coursesAvailable[] = 'BSHM';
}

// If no courses are available for the user, prevent them from accessing the sign-up form
if (empty($coursesAvailable)) {
    $_SESSION['error'] = 'You do not have permission to register students for any course.';
    header('Location: sign_in.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title>Sign Up</title>
    <style>
        /* Styles omitted for brevity */
    </style>
</head>
<body>

<?php if ($_SESSION['user_id'] && !empty($coursesAvailable)): ?>
    <div class="container">
        <h2 style="text-align: center; color: #333;">Register</h2>
        <form method="POST" action="sign_up.php" enctype="multipart/form-data" onsubmit="return validateForm()">
            <!-- Other form fields like student ID, name, etc. -->

            <div class="form-wrap">
                <label for="course">Course</label>
                <select name="course" required>
                    <option value="">-Select-</option>
                    <?php
                    // Dynamically display only allowed courses
                    foreach ($coursesAvailable as $course) {
                        echo "<option value=\"$course\">$course</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Other form fields like password, photo upload, etc. -->
            
            <button class="btn button-primary" type="submit" name="add">Register</button>
        </form>
    </div>
<?php else: ?>
    <p>You do not have permission to register students.</p>
<?php endif; ?>

<script>
    function validateForm() {
        // Validate password matching and other fields if necessary
        return true;
    }
</script>

</body>
</html>

<?php

// Now processing the form submission to validate the course based on the user's role

if (isset($_POST['add'])) {
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $filename = $_FILES['photo']['name'];
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $filename);
    $imageExtension = strtolower(end($imageExtension));

    if (!in_array($imageExtension, $validImageExtension)) {
        $_SESSION['error'] = 'Invalid Image';
        header('Location: sign_up.php');
        exit();
    }

    // Validate course based on the user's role
    $selectedCourse = $_POST['course'];
    if (!in_array($selectedCourse, $coursesAvailable)) {
        $_SESSION['error'] = 'You do not have permission to register for this course.';
        header('Location: sign_up.php');
        exit();
    }

    if (!empty($filename)) {
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $filename);   
    }

    $voters_id = htmlspecialchars($_POST['voters_id']);
    $checkUser = "SELECT * FROM voters WHERE voters_id ='$voters_id' OR email='$email'";
    $result = mysqli_query($conn, $checkUser);
    $count = mysqli_num_rows($result);
    
    if ($count > 0) {
        $_SESSION['error'] = 'ID or email already exists';
        header('Location: sign_up.php');
        exit();
    } else {
        $sql = "INSERT INTO voters (voters_id, password, firstname, lastname, email, course, status, photo) 
                VALUES ('$voters_id', '$password', '$firstname', '$lastname', '$email','$selectedCourse', 'student', '$filename')";
        
        if ($conn->query($sql)) {
            $_SESSION['success'] = 'Voter added successfully';
            header('Location: sign_in.php');
        } else {
            $_SESSION['error'] = "Failed to Register";
            header('Location: sign_up.php');
        }
    }
} else {
    $_SESSION['error'] = "Failed to Register";
    header('Location: sign_up.php');
}

