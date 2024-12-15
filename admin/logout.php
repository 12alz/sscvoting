<?php
session_start();

// Destroy the session data
session_unset();
session_destroy();

// Remove the session cookie by setting the expiration date in the past
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000, // Expire in the past
        $params["path"], 
        $params["https://mccsscvoting.com"], 
        $params["secure"], 
        $params["httponly"]
    );
}

// Optionally, you could also remove any custom cookies that you set during login

// Redirect to the homepage or login page
header('Location: ../index');
exit();
?>
