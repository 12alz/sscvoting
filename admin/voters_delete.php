<?php
include 'includes/session.php';

if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $sql = "UPDATE voters SET recstat = 1 WHERE id = '$id'";
    if($conn->query($sql)){
        $_SESSION['success'] = 'The record was successfully archived';
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'The record was successfully archived.',
                }).then(function() {
                    window.location = 'voters.php'; // Redirect to voters.php after closing alert
                });
              </script>";
    }
    else{
        $_SESSION['error'] = $conn->error;
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Error occurred: " . $conn->error . "',
                }).then(function() {
                    window.location = 'voters.php'; // Redirect to voters.php after closing alert
                });
              </script>";
    }
}
else{
    $_SESSION['error'] = 'An error occurred during the archiving process.';
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'An error occurred during the archiving process.',
            }).then(function() {
                window.location = 'voters.php'; // Redirect to voters.php after closing alert
            });
          </script>";
}

?>
