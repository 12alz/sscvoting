<?php
include 'includes/session.php'; // Include your session check
include 'includes/conn.php'; // Include your database connection

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Delete the user from the database
    $query = "DELETE FROM import_ms365 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'User deleted successfully';
    } else {
        $_SESSION['error'] = 'Failed to delete user';
    }

    header('location: ../admin/msaccount.php'); // Redirect back to the page after deletion
}
?>
