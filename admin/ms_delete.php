<?php
include 'includes/session.php'; // Include your session check
include 'includes/conn.php'; // Include your database connection


if (isset($_GET['ids'])) {
    $ids = explode(',', $_GET['ids']);
    $id_list = implode(',', array_map('intval', $ids));

    // Perform the deletion
    $query = "DELETE FROM import_ms365 WHERE id IN ($id_list)";
    if ($conn->query($query) === TRUE) {
        $_SESSION['success'] = 'Selected users deleted successfully.';
    } else {
        $_SESSION['error'] = 'Error deleting selected users: ' . $conn->error;
    }
}

    

    header('location: ../admin/msaccount.php'); // Redirect back to the page after deletion

?>
