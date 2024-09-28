<?php
include '../includes/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'mark_as_read') {
  
  $sql_update = "UPDATE voters SET  notified = 1 WHERE  notified= 0";
  if (mysqli_query($conn, $sql_update)) {
   
    echo json_encode(['success' => true]);
  } else {
   
    echo json_encode(['success' => false]);
  }
}
?>
