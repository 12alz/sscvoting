<?php
session_start();

// Check if token and other necessary params are present in the URL
if (isset($_GET['token']) && isset($_GET['email']) && isset($_GET['firstname']) && isset($_GET['lastname'])) {
    $token = $_GET['token'];
    $email = $_GET['email'];
    $firstname = $_GET['firstname'];
    $lastname = $_GET['lastname'];

    // Validate token expiration, etc.
    // (This is where you would add any token expiration checks or other logic)
} else {
    // If parameters are missing, redirect or show an error
    echo "Invalid or expired link.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title>Register for MS365 Voting</title>
    <style>
        /* Your styles here */
    </style>
</head>
<body>
    <div class="container">
        <h2>Register for MS365 Voting</h2>
        <form action="register_process.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
            
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>" readonly>
            
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>" readonly>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

            <button type="submit" name="register">Register</button>
        </form>
    </div>
</body>
</html>
