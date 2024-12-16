<?php
include 'includes/session.php'; // Include your session check
include 'includes/conn.php'; // Include your database connection

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];

    // Update the user details in the database
    $query = "UPDATE microsoft SET firstname = ?, lastname = ?, username = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $firstname, $lastname, $username, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'User updated successfully';
    } else {
        $_SESSION['error'] = 'Failed to update user';
    }

    header('location: ../admin/msaccount'); // Redirect back to the page after editing
}
?>
