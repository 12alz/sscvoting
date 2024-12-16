<?php
include 'includes/session.php'; 
include 'includes/conn.php'; 
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname =htmlspecialchars($_POST['lastname']);
    $username = htmlspecialchars($_POST['username']);

    // Update the user details in the database
    $query = "UPDATE microsoft SET firstname = ?, lastname = ?, username = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $firstname, $lastname, $username, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'User updated successfully';
    } else {
        $_SESSION['error'] = 'Failed to update user';
    }

    header('location: ../admin/msaccount'); 
    exit();
}
?>
