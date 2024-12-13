<?php
include 'includes/session.php';
include 'includes/slugify.php';

if (isset($_POST['vote'])) {
    if (count($_POST) == 1) {
        $_SESSION['error'][] = 'Please vote for at least one candidate.';
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
                $selectedCandidates = $_POST[$position]; // Get the selected candidates

                // Check if the number of selected candidates exceeds max_vote
                if (count($selectedCandidates) > $row['max_vote']) {
                    $error = true;
                    $_SESSION['error'][] = 'You can only choose ' . $row['max_vote'] . ' candidates for ' . $row['description'];
                } else {
                    // Insert the selected candidates into the database
                    foreach ($selectedCandidates as $candidate_id) {
                        $sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('" . $voter['id'] . "', '$candidate_id', '$pos_id')";
                    }
                }
            }
        }

        // If no errors, save the votes
        if (!$error) {
            foreach ($sql_array as $sql_row) {
                $conn->query($sql_row);
            }

            unset($_SESSION['post']);
            $_SESSION['success'] = 'Ballot Submitted';
        }
    }
} else {
    $_SESSION['error'][] = 'Please select candidates to vote for.';
}

header('location: home');
?>
