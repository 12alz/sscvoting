<?php
    include 'includes/session.php';

    if (isset($_POST['delete'])) {
        $id = $_POST['id'];

        // First, get the voters_id (or the field you are using to link the tables) to find the corresponding user in the microsoft table
        $sql = "SELECT voters_id FROM voters WHERE id = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $voters_id = $row['voters_id']; // Assuming voters_id is the field linking to microsoft table

            // Update the voters table to archive the record
            $update_voters_sql = "UPDATE voters SET recstat = 1 WHERE id = '$id'";

            if ($conn->query($update_voters_sql)) {
                // Now, update the is_registered field in the microsoft table to 0
                $update_microsoft_sql = "UPDATE microsoft SET is_registered = 0 WHERE voters_id = '$voters_id'";

                if ($conn->query($update_microsoft_sql)) {
                    $_SESSION['success'] = 'The record was successfully archived, and registration reset.';
                } else {
                    $_SESSION['error'] = 'Failed to reset registration in the microsoft table: ' . $conn->error;
                }
            } else {
                $_SESSION['error'] = 'Failed to archive the record in the voters table: ' . $conn->error;
            }
        } else {
            $_SESSION['error'] = 'No matching voter found for deletion.';
        }
    } else {
        $_SESSION['error'] = 'An error occurred during the archiving process.';
    }

    header('location: voters');
?>
