<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Loop through all courses and update the switch status
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'switch_') === 0) {  // Identify the switch keys
            $course_name = str_replace('switch_', '', $key);  // Extract the course name
            $switch_status = isset($_POST[$key]) ? 1 : 0;

            // Update the switch status for the specific course
            $sql = "UPDATE course_switches SET switch = ? WHERE course_name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $switch_status, $course_name);
            $stmt->execute();
            $stmt->close();
        }
    }
    $_SESSION['success'] = 'Course voting status updated successfully!';
    header('Location: admin_page.php');
    exit();
}
?>
