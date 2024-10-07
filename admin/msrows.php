<?php
include 'includes/session.php'; 
include 'includes/conn.php'; 

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Fetch the voter details using the provided ID
    $query = "SELECT id, firstname, lastname, username FROM import_ms365 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    // Return the fetched row as a JSON response
    echo json_encode($row);
}
?>
