<?php
include "includes/conn.php"; // Your database connection file

// Function to get the user's IP address
function getUserIP() {
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_list = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ip_list[0]);
    }
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    return $_SERVER['REMOTE_ADDR'];
}

// Function to log user IP address to the database
function logUserIPToDB($conn, $ip, $username) {
    $timestamp = date("Y-m-d H:i:s"); // Current timestamp

    // Prepare and execute the SQL statement using mysqli
    $sql = "INSERT INTO login_logs (ip_address, timestamp, username) VALUES (?, ?, ?)";
    
    // Use prepared statements in MySQLi to avoid SQL injection
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the prepared statement
        $stmt->bind_param("sss", $ip, $timestamp, $username);

        // Execute the statement
        $stmt->execute();

        // Close the statement
        $stmt->close();
    } else {
        // Handle errors if prepare fails
        echo "Error preparing query: " . $conn->error;
    }
}

// Simulate a login check (this should be part of your login logic)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['voter']) && isset($_POST['password'])) {
    // Get the username and password from the form
    $username = $_POST['voter'];

    // Get the user's IP address
    $user_ip = getUserIP();

    // Log the user's IP address to the database
    logUserIPToDB($conn, $user_ip, $username);
    
    // Proceed with your login logic (authentication, session creation, redirection, etc.)
    echo "Login attempt from IP: " . $user_ip;
}

?>
