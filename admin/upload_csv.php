<?php
include 'includes/session.php';
include "includes/conn.php";

if (isset($_FILES['csv_file'])) {
    $file = $_FILES['csv_file']['tmp_name'];
    
    if (($handle = fopen($file, 'r')) !== FALSE) {
        fgetcsv($handle); // Skip the header row if necessary
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $firstname = $data[0];
            $lastname = $data[1];
            $username = $data[2];

            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO microsoft (Firstname, Lastname, Username) VALUES (?, ?, ?)");
            
            // Check if the statement was prepared correctly
            if ($stmt === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }

            $stmt->bind_param("sss", $firstname, $lastname, $username);
            $stmt->execute();
        }
        fclose($handle);
        $_SESSION['success'] = 'CSV imported successfully.';
    } else {
        $_SESSION['error'] = 'Error opening the CSV file.';
    }
}

header('Location: msaccount');
?>
