<?php
include 'includes/session.php';

if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $course = $_POST['course'];

    $sql = "UPDATE voters SET firstname = '$firstname', lastname = '$lastname', password = '$password', course = '$course' WHERE id = '$id'";
    if($conn->query($sql)){
        $_SESSION['success'] = 'Voter updated successfully';

        // Use SweetAlert for success message
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Voter updated successfully.',
                }).then(function() {
                    window.location = 'voters.php'; // Redirect to voters.php after closing alert
                });
              </script>";
    }
    else{
        $_SESSION['error'] = $conn->error;

        // Use SweetAlert for error message
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
    $_SESSION['error'] = 'Voter update error';

    // Use SweetAlert for error message
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'An error occurred during the voter update process.',
            }).then(function() {
                window.location = 'voters.php'; // Redirect to voters.php after closing alert
            });
          </script>";
}

?>
