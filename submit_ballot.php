<?php
include 'includes/session.php';
include 'includes/slugify.php';

if (isset($_POST['vote'])) {
    if (count($_POST) == 1) {
        $_SESSION['error'][] = 'Please vote at least one candidate';
    } else {
        $_SESSION['post'] = $_POST;
        $sql = "SELECT * FROM positions";
        $query = $conn->query($sql);
        $error = false;
        $sql_array = array();

        while ($row = $query->fetch_assoc()) {
            $position = slugify($row['description']);
            $pos_id = $row['id'];
            if (isset($_POST[$position])) {
                if ($row['max_vote'] > 1) {
                    if (count($_POST[$position]) > $row['max_vote']) {
                        $error = true;
                        $_SESSION['error'][] = 'You can only choose '.$row['max_vote'].' candidates for '.$row['description'];
                    } else {
                        $values = [];
                        foreach ($_POST[$position] as $key => $values) {
                            $values[] = "('".$voter['id']."', '$values', '$pos_id')";
                        }
                        if (!empty($values)) {
                            $sql = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES " . implode(", ", $values);
                            $conn->query($sql);
                        }
                    }
                } else {
                    $candidate = $_POST[$position];
                    $stmt = $conn->prepare("INSERT INTO votes (voters_id, candidate_id, position_id) VALUES (?, ?, ?)");
                    $stmt->bind_param("iii", $voter['id'], $candidate, $pos_id);
                    $stmt->execute();
                }
            }
        }

        if (!$error) {
            $_SESSION['success'] = 'Ballot Submitted';
            unset($_SESSION['post']);
        }
    }
} else {
    $_SESSION['error'][] = 'Select candidates to vote first';
}

header('location: home');
exit();
?>
