<?php
include "includes/conn.php";

$showForm = false; // Variable to control whether to show the form

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Retrieve the token and expiration from the database
    $sql = "SELECT * FROM microsoft WHERE reset_token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $expiration = $row['token_expiration'];

        // Check if the token has expired
        if (strtotime($expiration) > time()) {
            // Token is valid, allow the user to proceed
            $showForm = true; // Enable the registration form
        } else {
            echo "<script>alert('This link has expired. Please request a new registration link.');</script>";
        }
    } else {
        echo "<script>alert('Invalid token.');</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('No token provided.');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title>Sign up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background:   #FBF5DF;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 20px;
            max-width: 400px;
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-wrap {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"], input[type="password"], select, input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #555;
        }

        p {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>

<?php if ($showForm): ?>
    <div class="container">
        <form method="POST" action="sign_up.php" enctype="multipart/form-data">
            <div class="form-wrap">
                <label for="voters_id">Student ID</label>
                <input type="text" name="voters_id" required>
            </div>
            <div class="form-wrap">
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" required>
            </div>
            <div class="form-wrap">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" required>
            </div>
            <div class="form-wrap">
                <label for="password">Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-wrap">
                <label for="course">Course</label>
                <select name="course" required>
                    <option value="">-Select-</option>
                    <option value="BSIT">BSIT</option>
                    <option value="BSBA">BSBA</option>
                    <option value="BSED">BSED</option>
                    <option value="BEED">BEED</option>
                    <option value="BSHM">BSHM</option>
                </select>
            </div>
            <div class="form-wrap">
                <label for="photo">Photo</label>
                <input type="file" name="photo" accept=".jpg, .jpeg, .png">
            </div>
            <button class="btn button-primary" type="submit" name="add">Register</button>
        </form>
    </div>
<?php else: ?>
    <p>The registration link has expired or is invalid.</p>
<?php endif; ?>

</body>
</html>
